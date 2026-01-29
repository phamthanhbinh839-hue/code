<?php
$title = 'GIỎ HÀNG | ' . $TN->site('title');
$body['header'] = '
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
';
$body['footer'] = '

';
require_once __DIR__ . '/../../../core/cart.php';
require_once __DIR__ . '/../../../core/is_user.php';
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/nav.php';
//CheckLogin();
$Cart = new Cart();
?>
<?php
if (isset($_GET['remove'])) {
        unset($_SESSION['cart'][$_GET['remove']]);
        // Ghi đè giá trị mới của $_SESSION['cart'] vào session
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        die('<script type="text/javascript">if(!alert("Xóa sản phẩm thành công!")){window.history.back().location.reload();}</script>');
}
if (isset($_GET['delete'])) {
unset($_SESSION['cart']);
session_regenerate_id(true);
die('<script type="text/javascript">if(!alert("Xóa giỏ hàng thành công!")){window.history.back().location.reload();}</script>');
}
?>
   <div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-0"> 
    <div class="mt-2"> 
     <div class="v-account-detail p-2 md:px-0 mt-5"> 
      <div class="v-infomations py-4 mb-10"> 
       <h2 class="mb-3 v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold"> BẠN ĐANG CÓ <?=count($_SESSION['cart']);?> SẢN PHẨM TRONG GIỎ HÀNG </h2> 
       <div class="w-full grid grid-cols-12 gap-4"> 
        <div class="col-span-12 sm:col-span-8 md:col-span-8 lg:col-span-8 xl:col-span-8"> 
        <?php if (count($_SESSION['cart']) == 0) { ?>
         <div class="sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 text-center"> 
          <img src="https://i.imgur.com/IX8cYOt.png" class="img-fluid" alt=""> 
          <h4 class="py-1 font-bold text-md px-1 truncate text-center uppercase">GIỎ HÀNG RỖNG, ĐI MUA SẮM ĐI NÀO</h4> 
         </div> 
        </div> 
        <?php } ?>
        <?php if (isset($_SESSION['cart'])) {
foreach ($_SESSION['cart'] as $id => $item) {
?>

        <div class="blog relative rounded-md shadow dark:shadow-gray-800 overflow-hidden mt-3"> 
         <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
          <div class="col-span-6"> 
           <div class="w-full"> 
            <div class="relative md:shrink-0" style="height:200px"> 
             <img class="h-full object-cover" width="100%" src="<?=$item['image'];?>" alt=""> 
            </div> 
           </div> 
          </div> 
          <div class="col-span-6"> 
           <div class="w-full"> 
            <a href="<?=BASE_URL('client/view-code/');?><?=$id;?>" class="py-1 font-bold text-md px-1 truncate text-center uppercase"><?=$item['name'];?></a> 
            <div class="my-auto"> 
             <p class="text-slate-400 mt-3 font-bold">Giá sản phẩm: <?=number_format($item['price']);?>đ</p> 
            </div> 
            <div class="mt-4"> 
             <a href="<?=BASE_URL('client/cart/remove/');?><?=$id;?>" class="cursor-pointer border rounded  text-center cursor-pointer border-red-500 hover:border-black transition duration-200 hover:bg-red-500 hover:text-white text-red-500 uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-close"></i> XÓA SẢN PHẨM </a> 
            </div> 
           </div> 
          </div> 
         </div> 
        </div> 
        <?php }} ?>
        </div> 
        <div class="col-span-12 sm:col-span-4 md:col-span-4 lg:col-span-4 xl:col-span-4 "> 
         <div class="sticky top-20 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 mt-6"> 
          <div class="border-b border-gray-100 dark:border-gray-700 bg-black"> 
           <h5 class="text-1xl text-white font-semibold px-2 py-2">THÔNG TIN THANH TOÁN</h5> 
          </div> 
          <div class="px-6"> 
           <ul> 
            <li class="flex justify-between items-center py-6"> 
             <div class="flex items-center"> 
              <div class="ml-3"> 
               <p class="font-semibold">TỔNG TIỀN THANH TOÁN</p> 
               <p class="text-slate-400 text-sm">               <?php 
               $sum = 0;
               if(isset($_SESSION['cart']))
               {
                   foreach($_SESSION['cart'] as $val)
                   {
                       $sum = $sum + $val['price'];
                   }
                   echo number_format($sum);
               }
               
               ?>đ</p> 
              </div> 
             </div> </li> 
            <li class="flex justify-between items-center py-6 border-t border-gray-100 dark:border-gray-700"> 
             <div class="flex items-center"> 
              <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
               <div class="col-span-6"> 
                <div class="w-full"> 
                <input id="token" type="hidden" value="<?=$getUser['token'];?>">
                 <a href="javascript:;" id="paymentCart" class="cursor-pointer border rounded w-full text-center cursor-pointer hover:border-lime-600 bg-lime-600 transition duration-200 hover:bg-lime-600 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-shopping-cart"></i> THANH TOÁN </a> 
                </div> 
               </div> 
               <div class="col-span-6"> 
                <div class="w-full"> 
                <input id="total" type="hidden" value="<?=number_format($sum);?>">
                 <a href="<?=BASE_URL('client/cart/delete/');?>" class="cursor-pointer border rounded w-full text-center cursor-pointer border-red-500 hover:border-yellow-500 bg-red-500 transition duration-200 hover:bg-yellow-500 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-close"></i> XÓA GIỎ HÀNG </a> 
                </div> 
               </div> 
              </div> 
             </div> </li> 
           </ul> 
          </div> 
         </div> 
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
<script type="text/javascript">
$("#paymentCart").click(function() {
    var total = $('#total').val();
    cuteAlert({
        type: "question",
        title: "XÁC NHẬN THANH TOÁN ĐƠN HÀNG",
        message: "Bạn có chắc chắn muốn thanh toán đơn hàng với tổng thiệt hại là " + total + "đ không?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
    }).then((e) => {
        if (e) {
            $.ajax({
                url: '<?=BASE_URL('ajaxs/client/Carts.php')?>',
                type: 'POST',
                dataType: "json",
                data: {
                    action: "pay",
                    token: $('#token').val()
                },
                success: function(res) {
                    if (res.status == '2') {
                        cuteToast({
                            type: "success",
                            message: res.msg,
                            timer: 5000
                        });
                        setTimeout(function() {
                            window.location = "<?=BASE_URL('client/cart')?>"
                        }, 1000);
                    } else {
                        cuteToast({
                            type: "error",
                            message: res.msg,
                            timer: 5000
                        });
                    }
                }
            });
        }
    });
});
</script>
<?php require_once __DIR__ . '/footer.php'; ?>