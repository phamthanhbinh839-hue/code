<?php
define("IN_SITE", true);
require_once("../../core/DB.php");
require_once("../../core/helpers.php");
require_once("../../core/cart.php");
$Cart = new Cart();
if ($_POST['action'] == 'add') {
    $id_product = check_string($_POST['id_product']);
    $row = $TN->get_row("SELECT * FROM `tbl_list_code` WHERE `id` = '$id_product' ");
    if (!$row) {
        $data = json_encode([
            'status'    => '0',
            'msg'       => 'Mã nguồn không tồn tại trong hệ thống'
        ]);
        die($data);
    }
    $CreateCart = $Cart->addToCart($id_product, $row['price'], $row['name'], $row['images']);
    if($CreateCart)
    {
        $data = json_encode([
            'status'    => '2',
            'msg'       => 'Đã thêm sản phẩm vào giỏ hàng'
        ]);
        die($data);
    }
    else
    {
        $data = json_encode([
            'status'    => '1',
            'msg'       => 'Sản phẩm đã tồn tại trong giỏ hàng'
        ]);
        die($data);
    }
}

if ($_POST['action'] == 'pay') {
    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
if (empty($_SESSION['cart'])) {
die(json_encode(['status' => '1', 'msg' => 'Không có gì trong giỏ hàng']));
}
foreach ($_SESSION['cart'] as $id => $item) {
    $row = $TN->get_row("SELECT * FROM `tbl_list_code` WHERE `id` = '$id' ");
    if (!$row) {
        die(json_encode(['status' => '1', 'msg' => 'Mã nguồn không tồn tại trong hệ thống']));
    }
    if ($getUser['money'] < $row['price']) {
        die(json_encode(['status' => '1', 'msg' => 'Số dư không đủ để thực hiện giao dịch']));
    }
    $isBuy = RemoveCredits($getUser['id'], $row['price'], "Mua Mã Nguồn (#".$id.")");
    if ($isBuy) {
        if (getRowRealtime("users", $getUser['id'], "money") < 0) {
            Banned($getUser['id'], 'Gian lận khi mua mã nguồn');
            die(json_encode(['status' => '1', 'msg' => 'Bạn đã bị khoá tài khoản vì gian lận']));
        }
        $TN->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $_SERVER['HTTP_USER_AGENT'],
            'create_date'    => gettime(),
            'action'        => 'Mua Mã Nguồn (#' . $id . ')'
         ]);
        $TN->cong("tbl_list_code", "sold", 1, " `id` = '".$id."' ");
        $TN->insert("tbl_his_code", [
            'user_id'            => $getUser['id'],
            'product_id'        => $id,
            'magd'        => random('QWERTYUIOPASDFGHJKZXCVBNM', 2).time(),
            'price'    => $row['price'],
            'create_date'    => gettime()
         ]);
        unset($_SESSION['cart'][$id]);
}
}
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        die(json_encode(['status' => '2', 'msg' => 'Thanh toán thành công']));
}