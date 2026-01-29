<?php
define("IN_SITE", true);
require_once("../core/DB.php");
require_once("../core/helpers.php");

$token = $TN->site('token_vcb'); // token API VCB (bạn lưu trong setting)
$curl = curl_init();

$dataPost = array(
    "type"  => "history",
    "token" => $token,
);

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://thueapibank.vn/historyapivcb/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $dataPost,
));

$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);

// VCB: danh sách thường nằm ở 'transactions' (theo JSON bạn gửi)
foreach (($result['transactions'] ?? []) as $data) {

    // Chỉ xử lý giao dịch vào (C/+)
    if (($data['DorCCode'] ?? null) !== 'C' && ($data['CD'] ?? null) !== '+') {
        continue;
    }

    $tranId    = $data['Reference'] ?? ($data['SeqNo'] ?? null); // mã tham chiếu
    $comment   = $data['Description'] ?? ($data['Remark'] ?? '');
    $amountRaw = $data['Amount'] ?? '0';
    $amount    = (int)str_replace([',',' '], '', $amountRaw);

    $user_id = parse_order_id($comment, $TN->site('noidungnap_vcb'));

    if ($getUser = $TN->get_row(" SELECT * FROM `users` WHERE `id` = '$user_id' ")) {
        if ($TN->num_rows(" SELECT * FROM `invoices` WHERE `trans_id` = '$tranId' ") == 0) {

            $insertSv2 = $TN->insert("invoices", array(
                'trans_id'        => $tranId,
                'payment_method'  => "VCB",
                'user_id'         => $getUser['id'],
                'description'     => $comment,
                'amount'          => $amount,
                'status'          => 1,
                'create_time'     => time()
            ));

            if ($insertSv2) {
                $isCong = PlusCredits($getUser['id'], $amount, "Nạp tiền tự động qua VCB (#$tranId - $comment - $amount)");
                if ($isCong) {
                    sendTele(templateTele($getUser['username']." nạp tiền tự động ".format_cash($amount)."đ qua VCB (".$tranId.")"));
                    echo '[<b style="color:green">-</b>] Xử lý thành công 1 hoá đơn.' . PHP_EOL;
                }
            }
        }
    }
}
