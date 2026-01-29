<?php
$title = 'THÔNG TIN CÁ NHÂN | ' . $TN->site('title');
$body['header'] = '

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
        <div class="col-span-8 mb-4">
            <div class="v-infomation relative h-40 lg:h-48" style="margin: 0px 0.15rem;">
                <div class="w-full relative text-center">
                    <img class="mx-auto shadow border-2 border-gray-800 w-32 h-32 object-cover object-center"
                        src="https://i.imgur.com/8mNasA5.png" alt="DICHVULIGHT.VN">
                    <h4 class="my-1 font-bold text-lg lg:text-2xl flex justify-center px-5 text-gray-900">
                        <span class="inline-block truncate mr-1"
                            style="max-width: 9.5rem;"><?=$getUser['username'];?></span> - ( ID:
                        <?=$getUser['id'];?> )
                    </h4>
                </div>
            </div>
            <div class="my-1"><span class="block mx-auto w-1/5 border-b border-gray-200"></span></div>
        </div>

        <?php require_once('sidebar.php');?>

        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-5">
                <h2
                    class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    THÔNG TIN TÀI KHOẢN</h2>
                <div class="v-table-content-2">
                    <div class="py-3 px-4">
                        <table class="table-auto w-full">
                            <tbody class="text-sm select-text">
                                <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
                                    <td class="v-account-text py-2 font-bold text-gray-800">ID TÀI KHOẢN</td>
                                    <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"><span
                                            class="py-1 px-3 bg-blue-500 text-white rounded"><?=$getUser['id'];?></span>
                                    </td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
                                    <td class="v-account-text py-2 font-bold text-gray-800">TÊN TÀI KHOẢN</td>
                                    <td class="v-table-title px-2 py-2 text-gray-800"><?=$getUser['username'];?></td>
                                </tr>
                                <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
                                    <td class="v-account-text py-2 font-bold text-gray-800">SỐ DƯ</td>
                                    <td class="px-2 py-2 text-gray-800"><b
                                            class="text-blue-500"><?=format_cash($getUser['money']);?> VNĐ</b></td>
                                </tr>
<tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
    <td class="v-account-text py-2 font-bold text-gray-800">NHÓM TÀI KHOẢN</td>
    <td class="v-table-title px-2 py-2 text-gray-800">
        <?php 
            if($getUser['level'] == '1'){
                echo 'QUẢN TRỊ VIÊN';
            } else {
                echo 'THÀNH VIÊN';
            }
        ?>
    </td>
</tr>
                                <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10">
                                    <td class="v-account-text py-2 font-bold text-gray-800">NGÀY THAM GIA</td>
                                    <td class="v-table-title px-2 py-2 text-gray-800">
                                        <?=$getUser['create_date'];?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $("#changePass").on("click", function() {
        $('#changePass').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
            'disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL('ajaxs/client/changePassword.php');?>",
            method: "POST",
            dataType: "JSON",
            data: {
                token: $("#token").val(),
                action: "ChangePassword",
                password: $("#old_password").val(),
                newpassword: $("#new_password").val(),
                renewpassword: $("#confirm_new_password").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                    setTimeout("location.href = '<?=BASE_URL('client/user-profile');?>';", 100);
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#changePass').html('<i class="fas fa-lock"></i> THAY ĐỔI').prop('disabled',
                    false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#changePass').html('<i class="fas fa-lock"></i> THAY ĐỔI').prop('disabled',
                    false);
            }

        });
    });

    $("#changeEmail").on("click", function() {
        $('#changeEmail').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
            'disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL('ajaxs/client/changeInfo.php');?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: "ChangeEmail",
                token: $("#token").val(),
                email: $("#email").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                    setTimeout("location.href = '<?=BASE_URL('client/user-profile');?>';", 100);
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#changeEmail').html('<i class="fas fa-sync"></i> THAY ĐỔI').prop('disabled',
                    false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#changeEmail').html('<i class="fas fa-sync"></i> THAY ĐỔI').prop('disabled',
                    false);
            }

        });
    });
    
    $("#changeIdTelegram").on("click", function() {
        $('#changeIdTelegram').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
            'disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL('ajaxs/client/changeInfo.php');?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: "ChangeIdTelegram",
                token: $("#token").val(),
                id_telegram: $("#id_telegram").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                    setTimeout("location.href = '<?=BASE_URL('client/user-profile');?>';", 100);
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#changeIdTelegram').html('<i class="fas fa-sync"></i> THAY ĐỔI').prop('disabled',
                    false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#changeIdTelegram').html('<i class="fas fa-sync"></i> THAY ĐỔI').prop('disabled',
                    false);
            }

        });
    });
    </script>
<?php require_once __DIR__ . '/footer.php'; ?>