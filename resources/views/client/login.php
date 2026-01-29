<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$title = 'ĐĂNG NHẬP | ' . $TN->site('title');
$body['header'] = '

';
$body['footer'] = '

';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/nav.php';
?>
<div class="flex justify-center items-center px-4 py-8 md:px-0 md:py-0" style="height: calc(100vh - 80px)">
    <div class="w-full max-w-sm">
        <form class="w-full border border-gray-400 shadow rounded bg-white py-4 px-6">
            <div class="text-gray-800 text-center text-2xl font-extrabold">
                ĐĂNG NHẬP TÀI KHOẢN
            </div>
            <div class="border-t border-gray-600 w-32 mx-auto mt-1"></div>
            <span>
                <div class="mt-4">
                    <label class="block text-gray-800 text-sm font-semibold mb-1">Tên tài khoản</label>
                    <input type="text" placeholder="Nhập tài khoản" id="username"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-blue-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <label class="block text-gray-800 text-sm font-semibold mb-1">Mật khẩu</label>
                    <input autocomplete="" type="password" id="password" placeholder="Nhập mật khẩu"
                        class="border border-gray-400 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-blue-500 text-xs"></span>
                </div>
            </span>

            <span>
                <div class="my-2">
                    <label class="block text-gray-800 text-sm font-semibold mb-1">Xác minh captcha</label>
                    <div class="g-recaptcha" data-sitekey="6LcI8ognAAAAAIhNpecP1NeuFL7r-RdmmFJs6fpe"></div>
                    <span class="mt-1 flex items-center font-semibold tracking-wide text-blue-500 text-xs"></span>
                </div>
            </span>

            <div class="mt-4 mb-2 flex justify-center flex-col">
                <button type="button" id="btnLogin"
                    class="focus:outline-none h-10 bg-blue-500 text-white flex items-center justify-center rounded w-full p-1 px-8 text-xl">
                    Đăng Nhập
                </button>
                <a href="<?=BASE_URL('client/register');?>"
                    class="mt-2 py-1 rounded border border-gray-400 bg-white text-gray-800 text-xl flex items-center justify-center relative"><i
                        class="absolute bx bxs-user-plus" style="left: 10px; top: 9px;"></i> Tạo Tài Khoản</a>
            </div>
        </form>
    </div>
</div>
</div>

    <script type="text/javascript">
    $("#btnLogin").on("click", function() {
        $('#btnLogin').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop(
            'disabled',
            true);
        $.ajax({
            url: "<?=base_url('ajaxs/client/login.php');?>",
            method: "POST",
            dataType: "JSON",
            data: {
                username: $("#username").val(),
                password: $("#password").val(),
                captcha: grecaptcha.getResponse()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire("Thành Công",
                    respone.msg,
                    "success"
                    );
                    setTimeout("location.href = '<?=BASE_URL('');?>';", 500);
                } else {
                    Swal.fire("Thất Bại",
                    respone.msg,
                    "error"
                    );
                }
                $('#btnLogin').html('<i class="fas fa-sign-in-alt"></i> Đăng Nhập').prop('disabled',
                    false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#btnLogin').html('<i class="fas fa-sign-in-alt"></i> Đăng Nhập').prop('disabled',
                    false);
            }

        });
    });
    </script>
<?php require_once __DIR__ . '/footer.php';?>