<body>
    <div class="select-none" style="height: auto;min-height: 100vh;"> 
        <div class="sticky top-0 z-100">
            <div class="shadow">
                <header class="mx-auto w-full max-w-6xl px-2 bg-white flex flex-wrap items-center py-2">
                    <div class="flex-1 flex justify-between items-center">
                        <a href="<?=BASE_URL('');?>"><img width="200" src="<?=$TN->site('logo');?>"
                                class="v-logo"></a>
                    </div>
                    <?php if(empty($getUser['username'])) { ?>
                    <a href="<?=BASE_URL('client/login');?>"
                        class="lg:hidden flex border mx-2 px-3 h-8 border-gray-400 rounded items-center text-gray-800 font-bold justify-center pointer-cursor">
                        Đăng nhập
                    </a>
                    <a href="<?=BASE_URL('client/register');?>"
                        class="lg:hidden flex border mx-2 px-3 h-8 border-gray-400 rounded items-center text-gray-800 font-bold justify-center pointer-cursor">
                        Đăng ký
                    </a>
                    <?php } else { ?>
                    <a href="<?=BASE_URL('client/user-profile');?>"
                        class="lg:hidden relative mx-2 flex border px-3 h-8 border-gray-400 rounded items-center text-gray-800 font-bold justify-center pointer-cursor nuxt-link-exact-active nuxt-link-active"><span
                            class="block"><i class="fa fa-user" aria-hidden="true"></i>
                            <?=$getUser['username'];?> - <?=format_cash($getUser['money']);?>đ</span></a>

                    <?php }?>
                    <label for="menu-toggle" id="toggle" class="pointer-cursor text-gray-800 text-2xl lg:hidden block">
                        <span class="h-8 w-8 border border-gray-400 justify-center items-center inline-flex rounded"><i
                                class="bx bx-menu"></i></span>
                    </label>
                    <div class="hidden md:mt-0 lg:flex lg:items-center lg:w-auto w-full" id="menu-toggle">
                        <nav class="font-bold lg:text-lg">
                            <ul class="lg:flex items-center justify-between text-base text-gray-700 lg:pt-0">
                                <li><a href="<?=BASE_URL('');?>" class="lg:p-3 py-1 lg:py-2 px-2 lg:px-3 block">TRANG
                                        CHỦ</a></li>
         <li class="dropdown-custom"> <a href="javascript:;" data-dropdown-toggle="dropdownDivider" class="dropbtn lg:p-3 py-1 lg:py-2 px-2 lg:px-3 block link inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">NẠP TIỀN</a> 
          <div class="hidden dropdown-content z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"> 
           <ul class="py-1 text-sm" aria-labelledby="dropdownDividerButton"> 
            <li> <a href="<?=BASE_URL('client/recharge-card');?>" class="block mb-0 px-4">NẠP THẺ CÀO</a> </li> 
            <li> <a href="<?=BASE_URL('client/recharge');?>" class="block mb-0 px-4">NẠP QUA VÍ/ATM</a> </li> 
           </ul> 
          </div> </li> 
                                <li><a href="<?=BASE_URL('client/list-code');?>"
                                        class="lg:p-3 py-1 lg:py-2 px-2 lg:px-3 block">MÃ NGUỒN</a></li>
                                         <li class="dropdown-custom"> <a href="javascript:;" data-dropdown-toggle="dropdownDivider" class="dropbtn lg:p-3 py-1 lg:py-2 px-2 lg:px-3 block link inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">DỊCH VỤ</a> 
          <div class="hidden dropdown-content z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"> 
           <ul class="py-1 text-sm" aria-labelledby="dropdownDividerButton"> 
            <li> <a href="<?=BASE_URL('client/thue-cron');?>" class="block mb-0 px-4">CRON JOB</a> </li>
           </ul> 
          </div> </li> 
                                <?php if(isset($getUser['username']) && $getUser['level'] == '1') { ?>        
                                <li><a href="<?=BASE_URL('admin/');?>"
                                        class="lg:p-3 py-1 lg:py-2 px-2 lg:px-3 block">QUẢN TRỊ WEBSITE</a></li>
                                    <?php }?>
                                <a href="<?=BASE_URL('client/cart');?>" class="lg:ml-4 flex border px-3 h-8 border-gray-400 rounded items-center text-gray-800 font-bold justify-center lg:mb-0 mb-2 pointer-cursor"><span class="block"><i class="fa fa-shopping-cart mr-2"></i>Giỏ hàng - (<span><?=count($_SESSION['cart']);?></span>)</span></a>
                                <?php if(empty($getUser['username'])) { ?>
                                <a href="<?=BASE_URL('client/login');?>"
                                    class="lg:ml-4 flex border px-3 h-8 border-gray-400 lg:rounded-full items-center text-gray-800 font-bold justify-center lg:mb-0 mb-2 pointer-cursor"><span
                                        class="block"><i class="relative bx bxs-user mr-2"></i>Đăng nhập</span></a>
                                <a href="<?=BASE_URL('client/register');?>"
                                    class="lg:ml-4 flex border px-3 h-8 border-gray-400 lg:rounded-full items-center text-gray-800 font-bold justify-center lg:mb-0 mb-2 pointer-cursor"><span
                                        class="block"><i class="relative bx bxs-user-plus mr-2"></i> Đăng ký</span></a>
                                <?php } else { ?>
                                <a href="<?=BASE_URL('client/user-profile');?>"
                                    class="lg:ml-4 flex border px-3 h-8 border-gray-400 lg:rounded-full items-center text-gray-800 font-bold justify-center lg:mb-0 mb-2 pointer-cursor"><span
                                        class="block"><i class="fa fa-user" aria-hidden="true"></i>
                                        <?=$getUser['username'];?> - <?=format_cash($getUser['money']);?>đ</span></a>
                                <a href="<?=BASE_URL('client/logout');?>"
                                    class="lg:ml-4 flex border px-3 h-8 border-gray-400 lg:rounded-full items-center text-gray-800 font-bold justify-center lg:mb-0 mb-2 pointer-cursor"><span
                                        class="block"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng
                                        xuất</span></a>
                                <?php }?>
                    </div>
                </header>
            </div>
        </div>
        <script>
document.addEventListener('click', function(event) {
  var dropdownContent = document.querySelector('.dropdown-content');
  var dropdownToggle = document.querySelector('[data-dropdown-toggle="dropdownDivider"]');
  var dropdownDividerButton = document.querySelector('#dropdownDividerButton');
  
  if (event.target !== dropdownToggle && !dropdownContent.contains(event.target)) {
    dropdownContent.classList.add('hidden');
  } else if (event.target === dropdownDividerButton) {
    dropdownContent.classList.add('hidden');
  }
});

var dropdownToggle = document.querySelector('[data-dropdown-toggle="dropdownDivider"]');
dropdownToggle.addEventListener('click', function() {
  var dropdownContent = document.querySelector('.dropdown-content');
  dropdownContent.classList.toggle('hidden');
});
        </script>
        <?php
        if(isset($getUser['username']))
        {
            if($getUser['banned'] == 1)
            {
                session_destroy();
                msg_warning("Tài khoản của bạn đã bị khóa.", "", 5000);
            }
            if($getUser['level'] != '1')
            {

            }
        }
        else
        {

        }