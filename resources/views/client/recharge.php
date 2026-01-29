<?php
$title = 'NẠP ATM | ' . $TN->site('title');
$body['header'] = '
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
';
$body['footer'] = '
    
';
require_once __DIR__ . '/../../../core/is_user.php';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/nav.php';
CheckLogin();
?>
<div class="w-full max-w-6xl mx-auto pt-6 md:pt-8 pb-8">
    <div class="grid grid-cols-8 gap-4">
        <?php require_once('sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="w-full mb-10">
                <h2
                    class="v-title uppercase border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    Nạp tiền qua ATM
                </h2>
                <div class="mt-4 text-gray-900">
                    <div class="p-2 border border-gray-300 mb-4">
                        <div class="flex justify-between items-center cursor-pointer">
                            <div class="flex select-none"><img src="https://i.imgur.com/25ApNxA.png"
                                    class="h-10 w-10 rounded">
                                <div class="ml-2 text-left">
                                    <h2 class="font-bold text-base">
                                        Chuyển khoản qua Ngân hàng & Ví điện tử
                                    </h2>
                                    <p class="text-xs">Chuyển khoản ngân hàng online.</p>
                                </div>
                            </div> <button
                                class="select-none focus:outline-none bg-pink-600 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded">
                                Auto
                            </button>
                        </div>
                        <div>
                            <div class="border-t border-gray-200 mt-2 p-2 select-text">
                                <div class="relative">
            <p><span class="text-big" style="color: rgb(153, 77, 230);"><strong>* Nạp ATM</strong></span></p>
            <p><span class="text-big" style="color: rgb(0, 200, 0);"><strong>Nạp tối thiểu là 5.001đ</strong></span></p>
            <p><span class="text-big" style="color: rgb(230, 153, 77);"><strong>Ví Dụ:</strong></span></p>
            <p><span class="text-big" style="color: rgb(230, 77, 77);"><strong>100k ATM</strong></span><span class="text-big"><strong> = </strong></span><span class="text-big" style="color: rgb(230, 77, 77);"><strong>100k Trên Shop</strong></span></p> 
            <p style="margin-left: 0px;">&nbsp;</p> 
            <p>&nbsp;</p> 
                                    <p><strong>THÔNG TIN TÀI KHOẢN NGÂN HÀNG</strong></p>
                                    <?php foreach($TN->get_list("SELECT * FROM `bank` ") as $bank) { ?>
                                    <p style="margin-left: 0px;"><span style="color: rgb(43, 0, 254);"><strong>✔ :&nbsp;
                                                <?=$bank['short_name'];?></strong></span></p>
                                    <p style="margin-left: 0px;"><strong>Chủ tài khoản:
                                            <?=$bank['accountName'];?></strong>
                                    </p>
                                    <p style="margin-left: 0px;"><strong>STK/SDT: </strong><span
                                            style="color: red;"><strong><?=$bank['accountNumber'];?></strong></span></p>
                                    <p style="margin-left: 0px;"><strong>Chuyển khoản đúng nội dung, hệ thống sẽ tự động cộng tiền</strong></p>
                                    <p style="margin-left: 0px;">&nbsp;</p>
                                    <?php }?>

                                </div>
                            </div>
                            <div class="border-t border-gray-200 w-full select-text">
                                <div class="p-2">
                                    <div>Nội dung chuyển khoản của bạn:</div>
                                    <div class="my-2 items-center w-full text-center"><span
                                            class="font-bold border-dashed border border-red-600 rounded inline-flex justify-center text-center text-red-500 py-1 rounded px-4">
                                            <b id="copyNoiDung"><?=$TN->site('noidungnap_vcb').$getUser['id'];?></b>
                                        </span> <button type="button"
                                            class="copy ml-1 bg-gray-500 font-semibold text-white rounded focus:outline-none py-1 px-3" data-clipboard-target="#copyNoiDung" >
                                            Sao chép
                                        </button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

            <div class="v-bg w-full mb-2 px-2">
                <h2
                    class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    LỊCH SỬ NẠP ATM
                </h2>
                <div class="v-table-content select-text">
                    <div class="py-2 overflow-x-auto scrolling-touch max-w-400">
                        <table id="datatable" class="table-auto w-full scrolling-touch min-w-850">
                            <thead>
                                <tr class="v-border-hr select-none border-b-2 border-gray-300">
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        STT
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        THỜI GIAN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        PHƯƠNG THỨC
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        MÃ GIAO DỊCH
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        SỐ TIỀN
                                    </th>
                                    <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1">
                                        TRẠNG THÁI
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-sm font-semibold">
                            <?php $i = 0; foreach($TN->get_list("SELECT * FROM `invoices` WHERE `user_id` = '".$getUser['id']."' ") as $row) { ?>
                                <tr>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$i++;?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=date('d-m-Y H:i:s',$row['create_time'])?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['payment_method'];?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['trans_id'];?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=format_cash($row['amount']);?> VND</td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                    Thành Công
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                    <div class="v-table-note mt-1 py-1 font-semibold text-gray-800 text-sm">
                        Dùng điện thoại <i class="bx bxs-mobile"></i>, hãy vuốt bảng từ phải qua trái (<i
                            class="bx bxs-arrow-from-right"></i>) để xem đầy đủ thông tin!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable').DataTable();
});
</script>
<script>
    new ClipboardJS(".copy");

    function copy() {
        cuteToast({
            type: "success",
            message: "Đã sao chép vào bộ nhớ tạm",
            timer: 5000
        });
    }
</script>
<?php require_once(__DIR__ . '/footer.php'); ?>