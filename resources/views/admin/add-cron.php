<?php 
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$title = 'Thêm Máy Chủ Cron | ' . $TN->site('title');
$body = [
    'title' => 'Thêm Máy Chủ Cron'
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
if(isset($_POST['Save']) && $getUser['level'] == 1)
{
    $isInsert = $TN->insert("server_cron_auto", [
        'name'       => check_string($_POST['name']),
        'rate'       => check_string($_POST['rate']),
        'limit'       => check_string($_POST['limit']),
        'status'       => check_string($_POST['status']),
    ]);
    if ($isInsert) {
        die('<script type="text/javascript">if(!alert("Thêm thành công !")){location.href = "' . BASE_URL('admin/list-cron') . '";}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Lưu thất bại!")){window.history.back().location.reload();}</script>');
    }
}
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <section class="col-lg-6">
                <div class="mb-3">
                    <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('admin/list-cron')?>"
                        type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
                </div>
            </section>
            <section class="col-lg-6">
            </section>
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit mr-1"></i>
                            THÊM MÁY CHỦ CRON
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
                                <label for="exampleInputEmail1">Máy Chủ</label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Nhập máy chủ" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Thuê</label>
                                <input type="number" class="form-control"
                                    name="rate" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số Lượt Thuê Giới Hạn</label>
                                <input type="number" name="limit" class="form-control"
                                    placeholder="Nhập số lượt thuê giới hạn" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Trạng Thái</label>
                                <select class="form-control" name="status" required>
                                    <option value="ON">Hoạt Động</option>
                                    <option value="OFF">Bảo Trì</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button name="Save" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                    class="fas fa-save mr-1"></i>Thêm Ngay</button>
                        </div>
                    </form>
                </div>
            </section>
            
        </div>
    </section>
</div>
<script>
$(function() {
    $('#datatable1').DataTable();
});
$(function() {
    $('#datatable2').DataTable();
});
</script>
<?php 
    require_once(__DIR__."/Footer.php");
?>