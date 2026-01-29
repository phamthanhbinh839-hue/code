<?php
define("IN_SITE", true);
require_once("../../core/DB.php");
require_once("../../core/helpers.php");

if ($_POST['action'] == 'total') {
    $server = xss($_POST['server']);
    if (empty($server)) {
        die('Vui lòng chọn máy chủ');
    }
    $tnguyn = $TN->get_row(" SELECT * FROM `server_cron_auto` WHERE `id` = '$server' AND `status` = 'ON' ");
    if ($tnguyn) {
        $total_phi = $tnguyn['rate'];
    } else {
        $total_phi = 0;
    }
    die(number_format($total_phi));
}
if ($_POST['action'] == 'totalgiahan') {
    if (empty($_POST['token'])) {
        die('Vui lòng đăng nhập');
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die('Vui lòng đăng nhập');
    }
    $magd = xss($_POST['magd']);
    $thoigian = xss($_POST['thoigian']);
    if (empty($magd)) {
        die('Thiếu trường mã giao dịch');
    }
    if (empty($thoigian)) {
        die('Thiếu trường thời gian');
    }
    $isCron = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `magd` = '$magd' ");
    if(!$isCron)
    {
      die('Đơn cron không tồn tại');
    }
    $code_server = $isCron['id_server'];
    $tnguynz = $TN->get_row(" SELECT * FROM `server_cron_auto` WHERE `id` = '$code_server' AND `status` = 'ON' ");
    if ($tnguynz) {
        $total_phi = $thoigian * $tnguynz['rate'];
    } else {
        $total_phi = 0;
    }
    die(number_format($total_phi));
}
if ($_POST['action'] == 'buy') {
    $server = xss($_POST['server']);
    $url = xss($_POST['url']);
    $sogiay = xss((int)$_POST['sogiay']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($server)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn máy chủ!']));
    }
    if (empty($url)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng nhập link cron!']));
    }
    if ($sogiay < 1) {
        die(json_encode(['status' => '1', 'msg' => 'Số giây không hợp lệ rồi!']));
    }
    $getdata = $TN->get_row(" SELECT * FROM `server_cron_auto` WHERE `id` = '$server' AND `status` = 'ON' ");
    if (!$getdata) {
        die(json_encode(['status' => '1', 'msg' => 'Máy chủ không hợp lệ!']));
    }
    if ($getUser['money'] < $getdata['rate']) {
        die(json_encode(['status' => '1', 'msg' => 'Số dư không đủ để thực hiện giao dịch!']));
    }
    if ($getdata['count'] >= $getdata['limit']) {
        die(json_encode(['status' => '1', 'msg' => 'Máy chủ đã đầy, vui lòng liên hệ admin để xử lý!']));
    }

    $isBuy = RemoveCredits($getUser['id'], $getdata['rate'], "Thuê Cron #" . $getdata['rate']);
    if ($isBuy) {
        if (getRowRealtime("users", $getUser['id'], "money") < 0) {
            Banned($getUser['id'], 'Gian lận khi thuê cron');
            die(json_encode(['status' => '1', 'msg' => 'Bạn đã bị khoá tài khoản vì gian lận']));
        }
        /* LƯU HOẠT ĐỘNG LẠI */
        $TN->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $_SERVER['HTTP_USER_AGENT'],
            'create_date'    => gettime(),
            'action'        => 'Thuê cron thành công (#' . $getdata['rate'] . ')'
        ]);
        $TN->insert("list_url_cron", [
            'chunhan'  => $getUser['username'],
            'id_server' => $server,
            'url' => $url,
            'trangthai' => 'hoatdong',
            'sogiay' => $sogiay,
            'magd' => random('QWERTYUIOPASDFGHJKZXCVBNM', 2) . time(),
            'ngay_mua' => time(),
            'ngay_het' => time() + 2592000,
            'time_his' => time()
        ]);
        sendTele(templateTele($getUser['username']." thuê cron thành công (#" . $getdata['rate'] . ")"));

        die(json_encode(['status' => '2', 'msg' => 'Thuê cron thành công']));
    }
}
if ($_POST['action'] == 'edit') {
    $magd = xss($_POST['magd']);
    $url = xss($_POST['url']);
    $sogiay = xss((int)$_POST['sogiay']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($magd)) {
        die(json_encode(['status' => '1', 'msg' => 'Không hợp lệ!']));
    }
    if (empty($url)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng nhập link cron!']));
    }
    if ($sogiay < 1) {
        die(json_encode(['status' => '1', 'msg' => 'Số giây không hợp lệ rồi!']));
    }
    
    $TN->update("list_url_cron", array(
            'url' => $url,
            'sogiay' => $sogiay
        ), " `magd` = '".$magd."' ");
    sendTele(templateTele($getUser['username']." chỉnh sửa cron (#" . $magd . ")"));
 
    die(json_encode(['status' => '2', 'msg' => 'Thay đổi thành công']));
    
}
if ($_POST['action'] == 'stop') {
    $magd = xss($_POST['magd']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($magd)) {
        die(json_encode(['status' => '1', 'msg' => 'Không hợp lệ!']));
    }
    
    $zencms = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `magd` = '$magd' ");
    if($zencms['trangthai'] == 'tamdung')
    {
        die(json_encode(['status' => '1', 'msg' => 'Đơn cron này đã được bị tạm dừng !']));
    }
    if($zencms['trangthai'] == 'hethan')
    {
      die(json_encode(['status' => '1', 'msg' => 'Đơn cron này đã hết thời hạn sử dụng !']));
    }
        $TN->update("list_url_cron", array(
            'trangthai' => 'tamdung',
        ), " `magd` = '".$magd."' ");
    sendTele(templateTele($getUser['username']." tạm dừng cron (#" . $magd . ")"));

    die(json_encode(['status' => '2', 'msg' => 'Tạm ngưng cron thành công']));
    
}
if ($_POST['action'] == 'active') {
    $magd = xss($_POST['magd']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($magd)) {
        die(json_encode(['status' => '1', 'msg' => 'Không hợp lệ!']));
    }
    
     $zencms = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `magd` = '$magd' ");
    if($zencms['trangthai'] == 'hoatdong')
    {
        die(json_encode(['status' => '1', 'msg' => 'Đơn cron này đã được kích hoạt !']));
    }
    if($zencms['trangthai'] == 'hethan')
    {
      die(json_encode(['status' => '1', 'msg' => 'Đơn cron này đã hết thời hạn sử dụng !']));
    }
        $TN->update("list_url_cron", array(
            'trangthai' => 'hoatdong',
        ), " `magd` = '".$magd."' ");
    sendTele(templateTele($getUser['username']." kích hoạt cron (#" . $magd . ")"));

    die(json_encode(['status' => '2', 'msg' => 'Kích hoạt cron thành công']));
    
}

if ($_POST['action'] == 'giahan') {
    $thoigian = xss($_POST['thoigian']);
    $magd = xss($_POST['magd']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($thoigian)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn thời gian gia hạn!']));
    }
    if (empty($magd)) {
        die(json_encode(['status' => '1', 'msg' => 'Không hợp lệ!']));
    }
    if ($thoigian < 1) {
        die(json_encode(['status' => '1', 'msg' => 'Thời gian không hợp lệ rồi!']));
    }
    $isCron = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `magd` = '$magd' ");
    if(!$isCron)
    {
      die(json_encode(['status' => '1', 'msg' => 'Không hợp lệ!']));
    }
    $code_server = $isCron['id_server'];
    $getdata = $TN->get_row(" SELECT * FROM `server_cron_auto` WHERE `id` = '$code_server' AND `status` = 'ON' ");
    if (!$getdata) {
        die(json_encode(['status' => '1', 'msg' => 'Máy chủ không hợp lệ!']));
    }
    $total = $thoigian * $getdata['rate'];
    $thoigianmoi = $thoigian * 2592000;
    if($isCron['ngay_het'] < time())
    {
        $thoigiancong = time() + $thoigianmoi;
    }else{
        $thoigiancong = $isCron['ngay_het'] + $thoigianmoi;
    }
    if ($getUser['money'] < $total) {
        die(json_encode(['status' => '1', 'msg' => 'Số dư không đủ để thực hiện giao dịch!']));
    }
    

    $isBuy = RemoveCredits($getUser['id'], $total, "Gia hạn cron #" . $total);
    if ($isBuy) {
        if (getRowRealtime("users", $getUser['id'], "money") < 0) {
            Banned($getUser['id'], 'Gian lận khi gia hạn cron');
            die(json_encode(['status' => '1', 'msg' => 'Bạn đã bị khoá tài khoản vì gian lận']));
        }
        /* LƯU HOẠT ĐỘNG LẠI */
        $TN->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $_SERVER['HTTP_USER_AGENT'],
            'create_date'    => gettime(),
            'action'        => 'Gia hạn cron thành công (#' . $total . ')'
        ]);
         $TN->update("list_url_cron", array(
                'ngay_het' => $thoigiancong,
                'trangthai' => 'hoatdong'
            ), " `magd` = '".$magd."' ");
         sendTele(templateTele($getUser['username']." gia hạn cron (#" . $magd . ")"));

        die(json_encode(['status' => '2', 'msg' => 'Gia hạn thành công']));
    }
}

