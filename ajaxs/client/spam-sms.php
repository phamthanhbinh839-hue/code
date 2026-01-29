<?php
define("IN_SITE", true);
require_once("../../core/DB.php");
require_once("../../core/helpers.php");

if ($_POST['action'] == 'total') {
    $server = xss($_POST['server']);
    if (empty($server)) {
        die('Vui lòng chọn máy chủ');
    }
    $tnguyn = $TN->get_row(" SELECT * FROM `server_spam_sms` WHERE `id` = '$server' AND `status` = '1' ");
    if ($tnguyn) {
        $total_phi = $tnguyn['price'];
    } else {
        $total_phi = 0;
    }
    die(number_format($total_phi));
}
if ($_POST['action'] == 'buy') {
    $server = xss($_POST['server']);
    $phone = xss($_POST['phone']);
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (empty($server)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn máy chủ!']));
    }
    if (empty($phone)) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng nhập số điện thoại!']));
    }
    if (strlen($phone) < 10) {
        die(json_encode(['status' => '1', 'msg' => 'Số điện thoại không đúng định dạng!']));
    }
    $block_list = [
    "0907376977",
    "0706655307",
    "0813955448"
    ];
    if (in_array($phone, $block_list))
    {
        die(json_encode(['status' => '1', 'msg' => 'Spam kon cẹt!']));
    }
    $getdata = $TN->get_row(" SELECT * FROM `server_spam_sms` WHERE `id` = '$server' AND `status` = '1' ");
    if (!$getdata) {
        die(json_encode(['status' => '1', 'msg' => 'Máy chủ không hợp lệ!']));
    }
    if ($getUser['money'] < $getdata['price']) {
        die(json_encode(['status' => '1', 'msg' => 'Số dư không đủ để thực hiện giao dịch!']));
    }
    $checkDonEx = $TN->get_row("SELECT * FROM `history_spam_sms` WHERE `phone` = '$phone' AND `status` = 'tientrinh' ");
    if($checkDonEx)
    {
        die(json_encode(['status' => '1', 'msg' => 'Số điện thoại đang chạy trên đơn khác!']));
    }
    $checkLimit = $TN->num_rows("SELECT * FROM `history_spam_sms` WHERE `username` = '" . $getUser['username'] . "' AND `status` = 'tientrinh' ");
    if($checkLimit >= 3)
    {
        die(json_encode(['status' => '1', 'msg' => 'Mỗi người chỉ có thể chạy 3 đơn một lúc!']));
    }
    $checkTongDon = $TN->num_rows("SELECT * FROM `history_spam_sms` WHERE `status` = 'tientrinh' ");
    if($checkTongDon >= 25)
    {
        die(json_encode(['status' => '1', 'msg' => 'Số lượng đơn trên hệ thống quá nhiều!']));
    }

    $isBuy = RemoveCredits($getUser['id'], $getdata['price'], "Thuê Spam Sms #" . $getdata['price']);
    if ($isBuy) {
        if (getRowRealtime("users", $getUser['id'], "money") < 0) {
            Banned($getUser['id'], 'Gian lận khi thuê spam sms');
            die(json_encode(['status' => '1', 'msg' => 'Bạn đã bị khoá tài khoản vì gian lận']));
        }
        /* LƯU HOẠT ĐỘNG LẠI */
        $TN->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $_SERVER['HTTP_USER_AGENT'],
            'create_date'    => gettime(),
            'action'        => 'Thuê spam sms thành công (#' . $getdata['price'] . ')'
        ]);
        $TN->insert("history_spam_sms", [
            'username'  => $getUser['username'],
            'magd'        => random('QWERTYUIOPASDFGHJKZXCVBNM', 2).time(),
            'id_server' => $server,
            'phone' => $phone,
            'status' => 'tientrinh',
            'time' => time()
        ]);
        sendTele(templateTele($getUser['username']." thuê spam sms thành công (#" . $getdata['price'] . ")"));

        die(json_encode(['status' => '2', 'msg' => 'Thuê spam sms thành công']));
    }
}