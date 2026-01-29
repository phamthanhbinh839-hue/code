<?php
$title = 'GIA HẠN CRON | ' . $TN->site('title');
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
       <h2 class="mb-3 v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold"> GIA HẠN CRON JOB </h2> 
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
                <td class="v-account-text py-2 font-bold text-gray-800">MÃ ĐƠN CRON </td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"> <input type="text" id="magd" value="<?=$rowData['magd'];?>" readonly class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none"> </td> 
               </tr> 
               <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">THỜI GIAN</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase">
                            <select id="thoigian"
                                class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none" onchange="tongtien()">
                                            <option value="">Chọn thời gian gia hạn</option>
                                            <option value="1">1 Tháng</option>
                                            <option value="2">2 Tháng</option>
                                            <option value="3">3 Tháng</option>
                                            <option value="4">4 Tháng</option>
                                            <option value="5">5 Tháng</option>
                                            <option value="6">6 Tháng</option>
                            </select>
                </td> 
               </tr> 
               <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">TỔNG TIỀN</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase">
                <p class="text-slate-400 text-sm"><b class="text-red-500" id="tongtien">0</b><b class="text-red-500">đ</b></p> 
                </td> 
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
               <input id="server" type="hidden" value="<?=$rowData['id_server'];?>">
                <a href="javascript:;" id="btnGiaHan" class="cursor-pointer border rounded w-full text-center cursor-pointer border-lime-600 hover:border-lime-600 bg-lime-600 transition duration-200 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-save"></i> GIA HẠN </a> 
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
    $("#btnGiaHan").click(function() {
        $('#btnGiaHan').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
            true);
        $.ajax({
            url: '<?=BASE_URL('ajaxs/client/cron.php')?>',
            type: 'POST',
            dataType: "json",
            data: {
                action: "giahan",
                thoigian: $("#thoigian").val(),
                magd: $("#magd").val(),
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
                $('#btnGiaHan').html('<i class="fa fa-upload mr-1"></i>GIA HẠN').prop('disabled', false);
            }
        });
    });
    
    function tongtien() {
        var magd = $('#magd').val();
        var thoigian = $('#thoigian').val();
        if(server != '' || thoigian != ''){
            $.ajax({
                url: '<?=BASE_URL('ajaxs/client/cron.php')?>',
                type: 'POST',
                data: {
                    action: "totalgiahan",
                    magd: magd,
                    thoigian: thoigian,
                    token: $('#token').val()
                },
                success: function(result) {
                    $('#tongtien').html(result);
                }
            });
        }else{
            $('#tongtien').html();
        }
            
}
</script>
<?php require_once __DIR__ . '/footer.php'; ?>