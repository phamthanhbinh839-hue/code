<?php
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$title = 'Chỉnh Sửa Đơn Cron | ' . $TN->site('title');
$body = [
    'title' => 'Chỉnh sửa máy chủ cron'
];
$body['header'] = '
    <!-- DataTables -->
    <link rel="stylesheet" href="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
';
$body['footer'] = '
    <!-- DataTables  & Plugins -->
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/jszip/jszip.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/pdfmake/pdfmake.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/pdfmake/vfs_fonts.js"></script>   
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="' . BASE_URL('public/AdminLTE3/') . 'plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
';
require_once(__DIR__ . '/Header.php');
require_once(__DIR__ . '/Sidebar.php');
require_once(__DIR__ . '/Navbar.php');
require_once(__DIR__ . '/../../../core/is_user.php');
CheckLogin();
CheckAdmin();
?>
<?php
if (isset($_GET['id']) && $getUser['level'] == '1') {
    $row = $TN->get_row(" SELECT * FROM `list_url_cron` WHERE `id` = '" . check_string($_GET['id']) . "'  ");
    if (!$row) {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "javascript:history.back()";}</script>');
    }
} else {
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "javascript:history.back()";}</script>');
}
if (isset($_POST['btnSaveCron']) && $getUser['level'] == 1) {
     $url = check_string($_POST['url']);
    $sogiay = check_string($_POST['sogiay']);
    $trangthai = check_string($_POST['trangthai']);
    $id_server = check_string($_POST['id_server']);
    
    $isUpdate = $TN->update("list_url_cron", array(
        'url' => $url,
        'sogiay'           => $sogiay,
        'trangthai'         => $trangthai,
        'id_server'         => $id_server
    ), " `id` = '".$row['id']."' ");
    if ($isUpdate) {
        die('<script type="text/javascript">if(!alert("Lưu thành công!")){window.history.back().location.reload();}</script>');
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
                    <a class="btn btn-danger btn-icon-left m-b-10" href="<?= BASE_URL('admin/list-cron') ?>" type="button"><i class="fas fa-undo-alt mr-1"></i>Quay Lại</a>
                </div>
            </section>
            <section class="col-lg-6">
            </section>
            <section class="col-lg-12 connectedSortable">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit mr-1"></i>
                            CHỈNH ĐƠN THUÊ CRON
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i class="fas fa-expand"></i>
                            </button>
                            <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail3">Mã giao dịch</label>

                                <input type="text" class="form-control" id="magd" value="<?= $row['magd']; ?>" disabled>

                            </div>
                            <div class="form-group">
                                <label for="inputEmail3">Link cron</label>

                                <input type="text" class="form-control" name="url" value="<?= $row['url']; ?>">

                            </div>
                            <div class="form-group">
                                <label for="inputEmail3">Số giây</label>

                                <input type="text" class="form-control" name="sogiay" value="<?= $row['sogiay']; ?>">

                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Trạng thái</label>

                                <select class="custom-select" name="trangthai">
                                    <option value="<?= $row['trangthai']; ?>"><?= GetStatusCron($row['trangthai']); ?></option>
                                    <option value="hoatdong">Hoạt động</option>
                                    <option value="tamdung">Tạm dừng</option>
                                    <option value="loi">Lỗi</option>
                                    <option value="hethan">Hết hạn</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Máy chủ</label>

                                <select class="custom-select" name="id_server">
                                    <option value="<?= $row['id_server']; ?>"><?= GetSvCron($row['id_server']); ?></option>
                                    <?php foreach ($TN->get_list(" SELECT * FROM `server_cron_auto` WHERE `status` = 'ON' ") as $tnguyn) { ?>
                                        <option value="<?= $tnguyn['id']; ?>"><?= $tnguyn['name']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <button type="submit" name="btnSaveCron" class="btn btn-primary btn-block waves-effect">
                                <span>LƯU</span>
                            </button>
                            <a type="button" href="<?= BASE_URL('admin/orders-cron'); ?>" class="btn btn-danger btn-block waves-effect">
                                <span>TRỞ LẠI</span>
                            </a>
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
require_once(__DIR__ . "/Footer.php");
?>