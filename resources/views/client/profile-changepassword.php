<?php
$title = 'THAY ĐỔI MẬT KHẨU | ' . $TN->site('title');
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
        <?php require_once('sidebar.php');?>
        <div class="col-span-8 sm:col-span-5 md:col-span-6 lg:col-span-6 xl:col-span-6 px-2 md:px-0">
            <div class="v-bg w-full mb-5">
                <h2
                    class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
                    ĐỔI MẬT KHẨU</h2>
                <div class="v-table-content">
                    <div class="py-3 pt-5">
                        <form accept-charset="UTF-8" class="form-charge">
                            <input id="old_password" type="password" placeholder="Mật khẩu cũ" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                            <input type="hidden" class="form-control" id="token" value="<?= $getUser['token'] ?>" readonly>
                            <input id="new_password" type="password" placeholder="Nhập mật khẩu mới" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                            <input id="confirm_new_password" type="password" placeholder="Nhập lại mật khẩu mới" required="required"
                                class="mb-2 py-1 rounded-sm px-3 text-gray-800 focus:outline-none font-semibold border border-gray-500 bg-white" />
                            <button type="button" id="changePass"
                                class="py-1 text-white border border-red-600 px-3 bg-red-600 hover:bg-red-500 hover:border-red-500 font-semibold focus:outline-none"
                                data-loading-text="<box-icon name='loader'></box-icon>">
                                ĐỔI MẬT KHẨU
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.TN.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
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
                    setTimeout("location.href = '<?=BASE_URL('client/profile-changepassword');?>';", 100);
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#changePass').html('ĐỔI MẬT KHẨU').prop('disabled',
                    false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#changePass').html('ĐỔI MẬT KHẨU').prop('disabled',
                    false);
            }

        });
    });
</script>
<?php require_once __DIR__ . '/footer.php'; ?>