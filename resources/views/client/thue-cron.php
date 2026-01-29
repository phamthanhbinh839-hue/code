<?php
$title = 'THUÊ CRON | ' . $TN->site('title');
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
       <h2 class="mb-3 v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold"> THUÊ CRON JOB </h2> 
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
                <td class="v-account-text py-2 font-bold text-gray-800">LINK CRON</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"><input type="text" id="url" placeholder="Nhập link cron" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none"> </td> 
               </tr> 
               <tr class="v-border-hr-2 rounded-none border-b border-gray-200 py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">SỐ GIÂY</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"><input type="number" min="1" id="sogiay" placeholder="Nhập số giây" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none"> </td> 
               </tr> 
               <tr class="v-border-hr-2 rounded-none py-10"> 
                <td class="v-account-text py-2 font-bold text-gray-800">MÁY CHỦ</td> 
                <td class="v-table-title font-bold px-2 py-2 text-gray-800 uppercase"> 
                 <div class="flex items-center relative"> 
                  <select id="server" onchange="tongtien()" class="border border-gray-500 rounded bg-white text-gray-800 appearance-none w-full py-2 px-3 leading-tight focus:outline-none">
                  <option value="">Chọn máy chủ</option>
                  <?php foreach($TN->get_list("SELECT * FROM `server_cron_auto` WHERE `status` = 'ON' ") as $row) {?>
                  <option value="<?=$row['id'];?>"><?=$row['name'];?></option>
                  <?php }?>
                  </select> 
                  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"> 
                   <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" class="fill-current h-4 w-4"> 
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"> 
                    </path> 
                   </svg> 
                  </div> 
                 </div> </td> 
               </tr> 
              </tbody> 
             </table> 
            </div> 
           </div> 
          </div> 
         </div> 
        </div> 
        <div class="col-span-12 sm:col-span-4 md:col-span-4 lg:col-span-4 xl:col-span-4 "> 
         <div class="sticky top-20 rounded-md shadow dark:shadow-gray-800 bg-white dark:bg-slate-900 mt-6"> 
          <div class="border-b border-gray-100 dark:border-gray-700 bg-black"> 
           <h5 class="text-1xl text-white font-semibold px-2 py-2">THÔNG TIN THUÊ</h5> 
          </div> 
          <div class="px-6"> 
           <ul> 
            <li class="flex justify-between items-center py-6"> 
             <div class="flex items-center"> 
              <div class="ml-3"> 
               <p class="font-semibold">TỔNG TIỀN THUÊ</p> 
               <p class="text-slate-400 text-sm"><b class="text-red-500" id="tongtien">0</b><b class="text-red-500">đ</b></p> 
               <input id="token" type="hidden" value="<?=$getUser['token'];?>">
              </div> 
             </div> </li> 
            <li class="flex justify-between items-center py-6 border-t border-gray-100 dark:border-gray-700"> 
             <div class="flex items-center"> 
              <div class="mt-4 rounded-b-sm grid grid-cols-12 gap-5 p-2"> 
               <div class="col-span-6"> 
                <div class="w-full"> 
                 <a href="javascript:;" id="btnThueCron" class="cursor-pointer border rounded w-full text-center cursor-pointer hover:border-lime-600 bg-lime-600 transition duration-200 hover:bg-lime-600 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-shopping-cart"></i> THUÊ NGAY </a> 
                </div> 
               </div> 
              </div> 
             </div> </li> 
           </ul> 
          </div> 
         </div> 
        </div> 
       </div> 

       <div class="v-bg w-full mb-2 px-2"> 
        <h2 class="v-title border-l-4 border-gray-800 px-3 select-none text-gray-800 text-xl md:text-2xl font-bold"> LỊCH SỬ THUÊ CRON </h2> 
        <div class="v-table-content select-text"> 
         <div class="py-2 overflow-x-auto scrolling-touch max-w-400"> 
          <table id="datatable" class="table-auto w-full scrolling-touch min-w-850 dataTable no-footer"> 
           <thead> 
            <tr class="v-border-hr select-none border-b-2 border-gray-300"> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> STT </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> LINK CRON </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> SỐ GIÂY </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> MÁY CHỦ </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> TRẠNG THÁI </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> RESPONSE </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> HẠN DÙNG </th> 
             <th class="v-table-title py-2 text-sm font-bold text-gray-800 text-left px-1"> THAO TÁC </th> 
            </tr> 
           </thead> 
                            <tbody class="text-sm font-semibold">
                                <?php $i=0; foreach ($TN->get_list("SELECT * FROM `list_url_cron` WHERE `chunhan` = '" . $getUser['username'] . "' ORDER BY `id` DESC") as $row) {?>
                                     <tr>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$i++?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><?=$row['url'];?>                                    </td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?=$row['sogiay'];?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?= GetSvCron($row['id_server']); ?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?= GetStatusCron($row['trangthai']); ?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                        <?= GetCodeCron($row['response']); ?><br>Lần chạy gần nhất: <?= date('d/m/Y - H:i:s', $row['time_his']); ?></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b"><span
                                            class="badge badge-danger"><?=date('d-m-Y H:i:s',$row['ngay_het'])?></span></td>
                                    <td class="text-sm text-gray-800 text-left px-1 py-1 border-b">
                                    <a href="<?= BASE_URL('client/giahan-cron/'), $row['id'] ?>" class="cursor-pointer border rounded text-center cursor-pointer hover:border-lime-600 bg-lime-600 transition duration-200 hover:bg-lime-600 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-shopping-cart"></i> GIA HẠN </a>
                                    <a href="<?= BASE_URL('client/edit-cron/'), $row['id'] ?>" class="cursor-pointer border rounded text-center cursor-pointer hover:border-lime-600 bg-blue-500 transition duration-200 hover:bg-lime-600 text-white uppercase inline-block font-semibold py-1 px-3"> <i class="fa fa-edit"></i> CHỈNH SỬA </a>
                                    </td> 
                                </tr>
                                <?php }?>
                                                            </tbody>
          </table> 
         </div> 
         <div class="v-table-note mt-1 py-1 font-semibold text-gray-800 text-sm">
           Dùng điện thoại 
          <i class="bx bxs-mobile"></i>, hãy vuốt bảng từ phải qua trái (
          <i class="bx bxs-arrow-from-right"></i>) để xem đầy đủ thông tin! 
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
    $("#btnThueCron").click(function() {
        $('#btnThueCron').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
            true);
        $.ajax({
            url: '<?=BASE_URL('ajaxs/client/cron.php')?>',
            type: 'POST',
            dataType: "json",
            data: {
                action: "buy",
                server: $('#server').val(),
                url: $('#url').val(),
                sogiay: $('#sogiay').val(),
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
                        window.location = "<?=BASE_URL('client/thue-cron')?>"
                    }, 1000);
                } else {
                    cuteToast({
                        type: "error",
                        message: res.msg,
                        timer: 5000
                    });
                }
                $('#btnThueCron').html('<i class="fa fa-cart-plus mr-1"></i>THUÊ NGAY').prop('disabled', false);
            }
        });
    });
    
    function tongtien() {
        var server = $('#server').val();
        if(server != ''){
            $.ajax({
                url: '<?=BASE_URL('ajaxs/client/cron.php')?>',
                type: 'POST',
                data: {
                    action: "total",
                    server: server
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