<?php
define("IN_SITE", true);
ini_set('max_execution_time', '300');
require_once("../core/DB.php");
require_once("../core/helpers.php");

if (!isset($_GET['code'])) {
    die("Protected by Thai Nguyen !");
}
if (isset($_GET['code'])) {
    $code = xss($_GET['code']); // Nhận thông tin server
    // Tiến hành lấy danh sách đơn cron theo server
    foreach ($TN->get_list("SELECT * FROM `list_url_cron` WHERE `id_server` = '$code' AND `trangthai` = 'hoatdong' ") as $row) {
        if ($row['ngay_het'] < time()) {
            $TN->update("list_url_cron", array(
                'trangthai' => 'hethan',
                'time_his' => time()
            ), " `magd` = '" . $row['magd'] . "' ");
        }
        if (time() - $row['sogiay'] >= $row['time_his']) { // Tính thời gian cron gần nhất để tiếp tục cron
            $url = $row['url'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $httpcode = $info["http_code"]; //Tách http code
    $timeout = $info['total_time']; // Tách thời gian chờ kết nối
    if($timeout > 30) // Kiểm tra thời gian lớn hơn 30s thì set đơn cron lỗi
    {
                $TN->update("list_url_cron", array(
                    'response' => 522,
                    'trangthai' => 'loi',
                    'time_his' => time()
                ), " `magd` = '" . $row['magd'] . "' ");
    }
            $results[] = array(
                'chunhan' => $row['chunhan'],
                'sogiay' => $row['sogiay'],
                'url' => $url,
                'response' => $httpcode,
                'time_out' => $timeout
            );
            if ($httpcode == 200) { // Kiểm tra http code trả về 200 thì set đơn cron hoạt động
                $TN->update("list_url_cron", array(
                    'response' => $httpcode,
                    'trangthai' => 'hoatdong',
                    'time_his' => time()
                ), " `magd` = '" . $row['magd'] . "' ");
            }
            if ($httpcode != 200) { // Kiểm tra http code trả về khác 200 thì set đơn cron lỗi
                $TN->update("list_url_cron", array(
                    'response' => $httpcode,
                    'trangthai' => 'loi',
                    'time_his' => time()
                ), " `magd` = '" . $row['magd'] . "' ");
            }
        }
    }
    echo json_encode($results);
}