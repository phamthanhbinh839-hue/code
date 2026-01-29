<?php 
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$title = 'Danh Sách Đơn Cron | ' . $TN->site('title');
$body = [
    'title' => ' DANH SÁCH ĐƠN THUÊ CRON'
];
$body['header'] = '
    <!-- DataTables -->
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
';
$body['footer'] = '
    <!-- DataTables  & Plugins -->
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/jszip/jszip.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/pdfmake/pdfmake.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/pdfmake/vfs_fonts.js"></script>   
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
';
require_once(__DIR__.'/Header.php');
require_once(__DIR__.'/Sidebar.php');
require_once(__DIR__.'/Navbar.php');
require_once(__DIR__ . '/../../../core/is_user.php');
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_POST['perform']) && $getUser['level'] == 1) {
if($_POST['display_action'] == '')
{
        die('<script type="text/javascript">if(!alert("Vui lòng chọn thao tác!")){window.history.back().location.reload();}</script>');
    }
if($_POST['display_action'] == 'ACTIVEALL')
{
        $TN->update("list_url_cron", array(
            'trangthai' => 'hoatdong'
        ), " `trangthai` != 'hethan' ");
        die('<script type="text/javascript">if(!alert("Thao tác thành công!")){window.history.back().location.reload();}</script>');
    }
if($_POST['display_action'] == 'STOPALL')
{
        $TN->update("list_url_cron", array(
            'trangthai' => 'tamdung'
        ), " `trangthai` != 'hethan' ");
        die('<script type="text/javascript">if(!alert("Thao tác thành công!")){window.history.back().location.reload();}</script>');
    }
if($_POST['display_action'] == 'MACHINEALL')
{
        $TN->update("list_url_cron", array(
            'trangthai' => 'baotri'
        ), " `trangthai` != 'hethan' ");
        die('<script type="text/javascript">if(!alert("Thao tác thành công!")){window.history.back().location.reload();}</script>');
    }
else
{
die('<script type="text/javascript">if(!alert("Không xác định!")){window.history.back().location.reload();}</script>');
}
}
?>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
               
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-cart-plus mr-1"></i>
                                THAO TÁC NHANH
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thao tác</label>
                                    <select class="form-control select2bs4" name="display_action">
                                        <option value="">--Chọn thao tác--</option>
                                        <option value="ACTIVEALL">KÍCH HOẠT ALL</option>
                                        <option value="STOPALL">TẠM DỪNG ALL</option>
                                        <option value="MACHINEALL">BẢO TRÌ ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="perform" class="btn btn-info btn-icon-left m-b-10" type="submit"><i class="fas fa-save mr-1"></i>Thực Hiện</button>
                            </div>
                        </form>
                    </div>
                </section>
               
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-users mr-1"></i>
                                DANH SÁCH ĐƠN THUÊ CRON
                            </h3>
                            <div class="card-tools">
                            <input type="hidden" value="<?=$getUser['token']?>" id="token">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table id="datatable1" class="table table-bordered table-striped table-hover">
                                     <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>NGƯỜI DÙNG</th>
                                        <th>MÁY CHỦ</th>
                                        <th>LINK CRON</th>
                                        <th>SỐ GIÂY</th>
                                        <th>BẮT ĐẦU</th>
                                        <th>HẾT HẠN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th>KẾT QUẢ</th>
                                        <th>THAO TÁC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach($TN->get_list(" SELECT * FROM `list_url_cron` WHERE `chunhan` IS NOT NULL ORDER BY id DESC ") as $row){
                                    ?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$row['chunhan'];?></td>
                                        <td><?=GetSvCron($row['id_server']);?></td>
                                        <td><?=$row['url'];?></td>
                                        <td><?=$row['sogiay'];?></td>
                                        <td><?=date('d/m/Y - H:i:s', $row['ngay_mua']);?></td>
                                        <td><span class="badge badge-dark"><?=date('d/m/Y - H:i:s', $row['ngay_het']);?></span></td>
                                        <td><?=GetStatusCron($row['trangthai']);?></td>
                                        <td><?= GetCodeCron($row['response']); ?><br>Lần chạy gần nhất: <?= date('d/m/Y - H:i:s', $row['time_his']); ?></td>
                                        <td>
                                            <a type="button" href="<?=BASE_URL('admin/orders-cron-edit/');?><?=$row['id'];?>"
                                                class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                                                <span>SỬA</span></a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<script>
function RemoveRow(id) {
    cuteAlert({
        type: "question",
        title: "Xác Nhận Xóa Thành Viên",
        message: "Bạn có chắc chắn muốn xóa thành viên ID " + id + " không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
    }).then((e) => {
        if (e) {
            $.ajax({
                url: "<?=BASE_URL('')?>ajaxs/admin/removeUser.php",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                    token: $("#token").val()
                },
                success: function(respone) {
                    if (respone.status == 'success') {
                        cuteToast({
                            type: "success",
                            message: respone.msg,
                            timer: 5000
                        });
                        location.reload();
                    } else {
                        cuteAlert({
                            type: "error",
                            title: "Error",
                            message: respone.msg,
                            buttonText: "Okay"
                        });
                    }
                },
                error: function() {
                    alert(html(response));
                    location.reload();
                }
            });
        }
    })
}
</script>

<script>
$(function() {
    $('#datatable1').DataTable();
});
</script>
<script>
$(function() {
    $('#datatable2').DataTable();
});
</script>
<?php
require_once(__DIR__.'/Footer.php');
?>