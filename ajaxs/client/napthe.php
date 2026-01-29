<?php 
define("IN_SITE", true);
require_once("../../core/DB.php");
require_once("../../core/helpers.php");

    $loaithe = check_string($_POST['loaithe']);
    $menhgia = check_string($_POST['menhgia']);
    $seri = check_string($_POST['seri']);
    $pin = check_string($_POST['pin']);

    if (empty($_POST['token'])) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if (!$getUser = $TN->get_row("SELECT * FROM `users` WHERE `token` = '" . xss($_POST['token']) . "' AND `banned` = '0' ")) {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng đăng nhập']));
    }
    if(empty($loaithe))
    {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn loại thẻ']));
    }
    if(empty($menhgia))
    {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn mệnh giá']));
    }
    if(empty($seri))
    {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn seri thẻ']));
    }
    if(empty($pin))
    {
        die(json_encode(['status' => '1', 'msg' => 'Vui lòng chọn mã thẻ']));
    }
    if (strlen($seri) < 5 || strlen($pin) < 5)
    {
        die(json_encode(['status' => '1', 'msg' => 'Mã thẻ hoặc seri không đúng định dạng!']));
    }
    $code = random('1234567890', 32);
    $data = nt_tss_v1($TN->site('api_card'), $loaithe, $menhgia, $seri, $pin, $code);
    if (isset($data['data']))
    {
        if ($data['data']['status'] == 'error')
        {
            die(json_encode(['status' => '1', 'msg' => $data['data']['msg']]));
        }
        if ($data['data']['status'] == 'success')
        {
            $TN->insert("cards", array(
                'code' => $code,
                'seri' => $seri,
                'pin'  => $pin,
                'loaithe' => $loaithe,
                'menhgia' => $menhgia,
                'thucnhan' => '0',
                'username' => $getUser['username'],
                'status' => 'xuly',
                'note' => '',
                'createdate' => gettime()
            ));
            die(json_encode(['status' => '2', 'msg' => 'Gửi thẻ thành công, vui lòng đợi kết quả']));
        }
    }
    else
    {
        die(json_encode(['status' => '1', 'msg' => 'Không thể nhập dữ liệu vào API']));
    }