<div class="col-span-8 sm:col-span-3 md:col-span-2 lg:col-span-2 xl:col-span-2 lg:px-0 px-2">
    <div class="mb-4 v-menu-account">
        <h2 class="mb-2 border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
            Tài khoản</h2>
        <ul class="pl-2 text-gray-800">
            <li class="py-1 border-b border-gray-200"><a href="<?=BASE_URL('client/user-profile');?>" class=""><span
                        class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-user-circle"></i></span>Thông
                    tin tài khoản</a></li>
            <li class="py-1"><a href="<?=BASE_URL('client/bien-dong');?>" class=""><span
                        class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-dollar-circle"></i></span>Biến động số dư</a></li>
            <li class="py-1"><a href="<?=BASE_URL('client/nhat-ky');?>" class=""><span
                        class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-time"></i></span>Nhật ký hoạt động</a></li>
            <li class="py-1"><a href="<?=BASE_URL('client/profile-changepassword');?>" class=""><span
                        class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-lock"></i></span>Đổi mật
                    khẩu</a></li>
        </ul>
    </div>
    <div class="my-4 v-menu-account">
        <h2 class="mb-2 border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold">
            GIAO DỊCH
        </h2>
        <ul class="pl-2 text-gray-800 font-medium">
            <li class="py-1 border-b border-gray-200"><a href="<?=BASE_URL('client/recharge-card');?>" aria-current="page"><span class="relative mr-2 text-lg"
                        style="top:1.5px;"><i class="bx bxs-star"></i></span>Nạp thẻ cào tự động</a></li>
            <li class="py-1 border-b border-gray-200"><a href="<?=BASE_URL('client/recharge');?>" aria-current="page"><span class="relative mr-2 text-lg"
                        style="top:1.5px;"><i class="bx bxs-credit-card"></i></span>Nạp qua ATM</a></li>
            <li class="py-1 border-b border-gray-200">
                <a href="<?=BASE_URL('client/his-code');?>" class="">
                    <span class="relative mr-2 text-lg" style="top: 1.5px;"><i class="bx bxs-receipt"></i></span>Lịch sử mua mã nguồn
                </a>
            </li>
        </ul>
    </div>
</div>