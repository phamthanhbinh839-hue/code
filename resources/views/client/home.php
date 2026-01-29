<?php
$title = 'TRANG CHỦ | ' . $TN->site('title');
$body['header'] = '
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
';
$body['footer'] = '

';
require_once __DIR__ . '/../../../core/is_user.php';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/nav.php';
//CheckLogin();
?>
   <div class="v-theme"> 
<div class="my-6">
  <div class="w-full max-w-6xl mx-auto">
    <div id="slider-function" class="carousel-scale center">
      <div class="owl-carousel owl-theme">
        <div class="item"><img src="https://i.imgur.com/8AG01M4.jpg" alt=""></div>
        <div class="item"><img src="https://i.imgur.com/Je1CPro.jpg" alt=""></div>
      </div>
    </div>
  </div>
</div>
<style>
.owl-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 100%;
}

.owl-prev,
.owl-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: #fff;
  font-size: 2rem;
  padding: 0 1rem;
}

.owl-prev {
  left: 0;
}

.owl-next {
  right: 0;
}
</style>
<script>
$(document).ready(function(){
  $('#slider-function .owl-carousel').owlCarousel({
    loop:true, // Lặp lại các item trong carousel
    margin:10, // Khoảng cách giữa các item
    nav:true, // Hiển thị nút prev và next
    dots:true, // Hiển thị nút điều hướng
    responsive:{
      0:{
        items:1 // Số item hiển thị ở màn hình nhỏ hơn 576px
      },
      576:{
        items:1 // Số item hiển thị ở màn hình từ 576px đến 768px
      },
      768:{
        items:1 // Số item hiển thị ở màn hình từ 768px đến 992px
      },
      992:{
        items:1 // Số item hiển thị ở màn hình từ 992px trở lên
      }
    }
  });
});
</script>
   <style> #loading { display: none; height: 50px; text-align: center;
 } .loading-icon { display: inline-block; width: 20px; height: 20px; border: 2px solid #ccc; border-radius: 50%; border-top-color: #333; animation: spin 1s ease infinite; margin: 15px auto;
 } @keyframes spin { to { transform: rotate(360deg); }
 } </style> 
   <div class="pb-10"> 
    <div class="v-card w-full max-w-6xl mx-auto"> 
     <div class="md:mx-0"> 
      <div class="py-2"> 
       <div class="mb-16"> 
        <div class="mb-6 block"> 
         <div class="fade-in text-center uppercase py-1 text-gray-700 text-2xl font-extrabold my-2">
           MÃ NGUỒN CỦA CHÚNG TÔI 
         </div> 
         <div class="mb-2">
          <span class="mx-auto block w-40 border-2 border-blue-500"></span>
         </div> 
        </div> 
<div id="loading"> 
  <div class="loading-icon"></div> 
</div> 
        <div id="slc" class="fade-in grid grid-cols-8 gap-2 px-2 md:px-0"> 
        <?php foreach($TN->get_list("SELECT * FROM `tbl_list_code` WHERE `status` = '1' ORDER BY id DESC") as $row) { ?>
         <div class="fade-in col-span-8 sm:col-span-4 md:col-span-2 lg:col-span-2 xl:col-span-2 border border-gray-300 relative" style="padding: 1px;"> 
          <div> 
           <div class="relative"> 
            <a href="<?=BASE_URL('client/view-code/');?><?=$row['id']?>"> 
             <div class="relative"> 
              <img class="h-56 md:h-40 w-full object-fill object-center" src="<?=$row['images'];?>" alt="">
              <span class="absolute v-text-1 bg-blue-500 text-white font-bold text-sm inline-block px-2 rounded-sm" style="right: 5px; top: 5px;">#<?=$row['id'];?></span> 
             </div> </a> 
            <div class="py-2 bg-gray-200 px-2 text-center"> 
             <p class="font-bold truncate text-center uppercase"> <?=$row['name'];?> </p> 
            </div> 
            <div class="my-2 py-2 px-2 relative"> 
             <div class="grid grid-cols-12 gap-3 text-gray-700 font-medium text-sm"> 
              <div class="col-span-6 text-center"> 
               <p> <b class="text-gray-800">Lượt xem: <?=$row['view'];?></b> </p> 
              </div> 
              <div class="col-span-6 text-center"> 
               <p> <b class="text-gray-800">Lượt mua: <?=$row['sold'];?></b> </p> 
              </div> 
             </div> 
            </div> 
            <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
             <div class="col-span-6"> 
              <ul class="v-text-1 rounded-sm w-full font-medium" style="font-weight: 500;"> 
               <p class="w-full border border-blue-500 text-center rounded text-blue-500 block px-3 py-1"> <?=format_cash($row['price']);?> đ </p> 
              </ul> 
             </div> 
             <div class="col-span-6"> 
              <div class="w-full"> 
               <a href="<?=BASE_URL('client/view-code/');?><?=$row['id']?>" class="cursor-pointer border rounded w-full text-center cursor-pointer border-blue-500 hover:border-blue-500 bg-blue-500 transition duration-200 hover:bg-blue-500 text-white uppercase inline-block font-semibold py-1 px-3"> Chi tiết </a> 
              </div> 
             </div> 
            </div> 
           </div> 
          </div> 
         </div> 
         <?php }?>
        </div> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
<script>
window.onload = function() {
  document.getElementById("loading").style.display = "block";
  document.getElementById("slc").style.visibility = "hidden";
  setTimeout(function() {
    document.getElementById("loading").style.display = "none";
    document.getElementById("slc").style.visibility = 'visible';
  }, 500);
}
</script>
<?php if($TN->site('status_noti')==1):?>
    <div class="animated modal fadeIn is-visible fixed z-50 pin bg-smoke-dark flex p-2 md:p-0 top-0 left-0 bottom-0 right-0"
        style="z-index: 999;" id="myModal">
        <div
            class="animated fadeInDown fixed shadow-inner max-w-md md:max-w-lg relative pin-b pin-x align-top m-auto justify-center bg-white rounded w-full h-auto md:shadow-lg flex flex-col">
            <div class="modal-header">
     <div class="text-blue-500 font-bold text-lg text-center mb-3 p-3 uppercase border-b bg-gray-300">
       Thông báo 
     </div> 
      <div class="overflow-auto p-2 md:px-4" style="max-height: 600px;"> 
       <div class="relative px-2 pb-4 text-dark-900"> 
        <?=$TN->site('notification');?>
       </div> 
      </div> 
      <div class="flex justify-end p-3 md:px-3"> 
       <span class="absolute cursor-pointer text-2xl text-gray-800 pt-3 px-3" style="right: -1px; top: -2px;" data-close=""><i class="bx bxs-x-square" onclick="FuncHideModal()"></i></span> 
       <button onclick="FuncHideModal()" class="focus:outline-none rounded transition duration-200 hover:bg-blue-500 hover:text-white py-1 border-2 border-blue-500 font-semibold text-blue-700 px-6" data-close=""> <i class="fa fa-close"></i> Đóng </button> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
    <script>
    function FuncHideModal() {
        var x = document.getElementById("myModal");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
    </script> 
<script>
     $(document).ready(function() {
        $("#myModal").modal("show");
    });
</script>
<?php endif?>
<script type="text/javascript">
    $('#datatable').DataTable({
        language: {
            url: "<?= BASE_URL('public/assets/Vietnamese.json') ?>"
        },
    });
</script>
<?php require_once __DIR__ . '/footer.php'; ?>