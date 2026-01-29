<?php
$title = 'CHỈNH SỬA CRON | ' . $TN->site('title');
$body['header'] = '
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
<?php
if (isset($_GET['id'])) {
    $rowData = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `id` = '" . xss($_GET['id']) . "' AND `chunhan`='" . $getUser['username'] . "' ");
    if (!$rowData) {
        TN_error_time("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    TN_error_time("Liên kết không tồn tại", BASE_URL(''), 0);
}

?>
   <div class="mt-12 relative w-full max-w-6xl mx-auto text-gray-800 pb-8 px-2 md:px-0"> 
    <div class="mt-2"> 
     <div class="v-account-detail p-2 md:px-0 mt-5"> 
      <div class="v-infomations py-4 mb-10"> 
       <h2 class="mb-3 v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold"> CHỈNH SỬA CRON JOB </h2> 
       <div class="w-full grid grid-cols-12 gap-4"> 
        <div class="col-span-12 sm:col-span-8 md:col-span-8 lg:col-span-8 xl:col-span-8"> 
         <div class="text-gray-900"> 
          <div class="p-2 border border-gray-300 mb-4"> 
           <div class="flex justify-between items-center cursor-pointer"> 
            <div class="flex select-none">
             <img src="https://sieuthicode.net/assets/img/bank.png" class="h-10 w-10 rounded"> 
             <div class="ml-2 text-left"> 
              <h2 class="font-bold text-base"> Sau khi thuê link cron, thì mặc định cron sẽ được duy trì trong 1 tháng, và có thể gia hạn </h2> 
             </div> 
            </div> 
            <button class="select-none focus:outline-none bg-blue-500 text-white text-xs inline-block h-5 flex items-center justify-center font-semibold px-2 rounded"> Auto </button> 
           </div> 
           <div> 
            <div class="py-3"> 
             <table class="table-auto w-full"> 
              <tbody class="text-sm select-text"> 
               <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">LINK CRON </td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"> <input type="text" id="url" value="<?=$rowData['url'];?>" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none"> </td> 
               </tr> 
               <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">SỐ GIÂY</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"> <input type="text" id="sogiay" value="<?=$rowData['sogiay'];?>" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none"> </td> 
               </tr> 

              </tbody> 
             </table> 
             <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
              <div class="col-span-6"> 
               <div class="w-full"> 
                <a href="javascript:history.back()" class="cursor-pointer border rounded w-full text-center cursor-pointer border-red-500 hover:border-red-500 bg-red-500 transition duration-200 hover:bg-red-500 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-arrow-left"></i> QUAY LẠI </a> 
               </div> 
              </div> 
              <div class="col-span-6"> 
               <div class="w-full"> 
               <input id="token" type="hidden" value="<?=$getUser['token'];?>">
               <input id="magd" type="hidden" value="<?=$rowData['magd'];?>">
                <a href="javascript:;" id="btnSave" class="cursor-pointer border rounded w-full text-center cursor-pointer border-lime-600 hover:border-lime-600 bg-lime-600 transition duration-200 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-save"></i> LƯU NGAY </a> 
               </div> 
              </div> 
              <div class="col-span-6"> 
               <div class="w-full"> 
                <a id="active" class="cursor-pointer border rounded w-full text-center cursor-pointer border-lime-600 hover:border-lime-600 bg-lime-600 transition duration-200 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-play"></i> KÍCH HOẠT </a> 
               </div> 
              </div> 
              <div class="col-span-6"> 
               <div class="w-full"> 
                <a id="stop" class="cursor-pointer border rounded w-full text-center cursor-pointer border-red-500 hover:border-red-500 bg-red-500 transition duration-200 hover:bg-red-500 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-stop"></i> TẠM DỪNG </a> 
               </div> 
              </div> 
             </div> 
            </div> 
           </div> 
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
    $("#btnSave").click(function() {
        $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
            true);
        $.ajax({
            url: '<?=BASE_URL('ajaxs/client/cron.php')?>',
            type: 'POST',
            dataType: "json",
            data: {
                action: "edit",
                magd: $("#magd").val(),
                url: $("#url").val(),
                sogiay: $("#sogiay").val(),
                token: $("#token").val()
            },
            success: function(res) {
                if (res.status == '2') {
                    cuteToast({
                        type: "success",
                        message: res.msg,
                        timer: 5000
                    });
                    setTimeout(function() {
                        window.location = "<?=BASE_URL('client/thue-cron')?>"
                    }, 1000);
                } else {
                    cuteToast({
                        type: "error",
                        message: res.msg,
                        timer: 5000
                    });
                }
                $('#btnSave').html('<i class="fa fa-save mr-1"></i>LƯU NGAY').prop('disabled', false);
            }
        });
    });
   
      $("#stop").on("click", function() {
        $('#stop').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "<?= BASE_URL("ajaxs/client/cron.php"); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: "stop",
                magd: $("#magd").val(),
                token: $("#token").val()
            },
            success: function(data) {
                if (data.status == '2') {
                    cuteToast({
                        type: "success",
                        message: data.msg,
                        timer: 5000
                    });
                    setTimeout(function() {
                        window.location = "<?= BASE_URL('client/thue-cron') ?>"
                    }, 1000);
                } else {
                    cuteToast({
                        type: "error",
                        message: data.msg,
                        timer: 5000
                    });
                }
                $('#stop').html('<i class="fa fa-stop"></i> TẠM NGƯNG').prop('disabled', false);
            }
        });
    });
    
      $("#active").on("click", function() {
        $('#active').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "<?= BASE_URL("ajaxs/client/cron.php"); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: "active",
                magd: $("#magd").val(),
                token: $("#token").val()
            },
            success: function(data) {
                if (data.status == '2') {
                    cuteToast({
                        type: "success",
                        message: data.msg,
                        timer: 5000
                    });
                    setTimeout(function() {
                        window.location = "<?= BASE_URL('client/thue-cron') ?>"
                    }, 1000);
                } else {
                    cuteToast({
                        type: "error",
                        message: data.msg,
                        timer: 5000
                    });
                }
                $('#active').html('<i class="fa fa-play"></i> KÍCH HOẠT').prop('disabled', false);
            }
        });
    });

</script>
<?php require_once __DIR__ . '/footer.php'; ?>