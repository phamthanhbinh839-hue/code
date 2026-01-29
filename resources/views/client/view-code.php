<?php
if(isset($_GET['id']))
{
    $row = $TN->get_row(" SELECT * FROM `tbl_list_code` WHERE `id` = '".check_string($_GET['id'])."'  ");
    if(!$row)
    {
        die('<script type="text/javascript">if(!alert("Không tồn tại!")){window.history.back().location.reload();}</script>');
    }
    $TN->cong("tbl_list_code", "view", 1, " `id` = '".$row['id']."' ");
}
else
{
    die('<script type="text/javascript">if(!alert("Không tồn tại!")){window.history.back().location.reload();}</script>');
}
$title = strtoupper($row['name']) . ' | ' . $TN->site('title');
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
   <div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-0"> 
    <div class="mt-2"> 
     <div class="v-account-detail p-2 md:px-0 mt-5"> 
      <div class="v-infomations py-4 mb-10"> 
       <div class="w-full grid grid-cols-12 gap-4"> 
        <div class="col-span-12 sm:col-span-4 md:col-span-4 lg:col-span-4 xl:col-span-4"> 
         <img src="<?=$row['images'];?>" data-sizes="auto" class="border border-gray-400 mb-2 w-full lazyLoad lazy"> 
        </div> 
        <div class="col-span-12 sm:col-span-5 md:col-span-5 lg:col-span-5 xl:col-span-5 "> 
         <div class="v-bg w-full mb-5"> 
          <div class="v-table-content-2"> 
           <div class="py-3 px-4"> 
            <table class="table-auto w-full"> 
             <tbody class="text-sm select-text"> 
              <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
               <td class="v-account-text py-2 font-bold text-gray-800">MÃ SỐ</td> 
               <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"><span class="py-1 px-3 bg-blue-500 text-white rounded">#<?=$row['id'];?></span> </td> 
              </tr> 
              <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
               <td class="v-account-text py-2 font-bold text-gray-800">MÃ NGUỒN</td> 
               <td class="v-table-title px-2 py-2 text-gray-800"><?=$row['name'];?></td> 
              </tr> 
              <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
               <td class="v-account-text py-2 font-bold text-gray-800">GIÁ BÁN</td> 
               <td class="px-2 py-2 text-gray-800"><b class="text-blue-500"><?=format_cash($row['price']);?>đ</b></td> 
              </tr> 
              <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
               <td class="v-account-text py-2 font-bold text-gray-800">NGƯỜI BÁN</td> 
               <td class="v-table-title px-2 py-2 text-gray-800">ADMIN</td> 
              </tr> 
              <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
               <td class="v-account-text py-2 font-bold text-gray-800">CẬP NHẬT</td> 
               <td class="v-table-title px-2 py-2 text-gray-800"> 13:22:15 14-02-2023 </td> 
              </tr> 
             </tbody> 
            </table> 
           </div> 
          </div> 
          <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
           <div class="col-span-6"> 
            <div class="w-full"> 
            <input type="hidden" value="<?=$getUser['token']?>" id="token">
             <a href="javascript:;" id="AddCart" class="cursor-pointer border rounded w-full text-center cursor-pointer border-blue-500 hover:border-blue-500 bg-blue-500 transition duration-200 hover:bg-blue-500 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-shopping-cart"></i> THÊM GIỎ HÀNG </a> 
            </div> 
           </div> 
           <div class="col-span-6"> 
            <div class="w-full"> 
            <input type="hidden" value="<?=$row['id']?>" id="id_product">
             <a href="<?=$row['link_demo'];?>" class="cursor-pointer border rounded w-full text-center cursor-pointer border-green-600 hover:border-green-600 bg-green-600 transition duration-200 hover:bg-green-600 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-eye"></i> XEM DEMO </a> 
            </div> 
           </div> 
          </div> 
         </div> 
        </div> 
        <div class="col-span-12 sm:col-span-3 md:col-span-3 lg:col-span-3 xl:col-span-3"> 
         <div class="rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 mt-6"> 
          <div class="border-b border-gray-100 dark:border-gray-700 bg-black"> 
           <h5 class="text-1xl text-white font-semibold px-2 py-2">CÓ THỂ BẠN SẼ THÍCH</h5> 
          </div> 
          <div class="px-6"> 
           <ul> 
           <?php foreach($TN->get_list("SELECT * FROM `tbl_list_code` WHERE `status` = '1' ORDER BY view DESC LIMIT 5") as $rowlist) { ?>
            <li class="flex justify-between items-center py-6 border-t border-gray-100 dark:border-gray-700"> 
             <div class="flex items-center"> 
              <div class="ml-3"> 
               <a href="<?=BASE_URL('client/view-code/');?><?=$rowlist['id']?>" class="font-semibold"> <?=$rowlist['name'];?> </a> 
               <p class="text-slate-400 text-sm">Cập nhật <?=$rowlist['update_date']?></p> 
              </div> 
             </div> </li> 
             <?php }?>

           </ul> 
          </div> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
     <div class="v-account-detail p-2 md:px-0 mt-4"> 
      <div class="v-account-detail-1" id="taikhoan"> 
       <div class="mb-10"> 
        <?=$row['intro'];?>
       </div> 
       <div class="mb-10"> 
<?php 
$lines = explode("\n", $row['list_images']); 
if (!empty($lines)) {
foreach ($lines as $line) { ?>
<img src="<?=trim($line);?>" data-sizes="auto" class="border border-gray-400 mb-2 w-full lazyLoad lazy"> 
<?php
}
}
?>
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  <script>
$(document).ready(function(){
    $('#AddCart').click(function() {
        $('#AddCart').html('Đang Xử Lý...').prop('disabled', true);
        var formData = {
            action      : 'add',
            id_product: $('#id_product').val()
        };
        $.post("/ajaxs/client/Carts.php", formData,
            function (data) {
                if(data.status == '2') {
                    cuteToast({
                        type: "success",
                        message: data.msg,
                        timer: 5000
                    });
                    $('#AddCart').html('Thêm Giỏ Hàng').prop('disabled', false);
                } else {
                    var productID = $('#id_product').val(); // Lấy giá trị của phần tử có id là "id_product"
                    setTimeout(function(){ location.href = "/client/view-code/" + productID },1000); 
                    cuteToast({
                        type: "error",
                        message: data.msg,
                        timer: 5000
                    });
                    $('#AddCart').html('Thêm Giỏ Hàng').prop('disabled', false);
                }
        }, "json");
    });
});
</script> 

<?php require_once __DIR__ . '/footer.php'; ?>