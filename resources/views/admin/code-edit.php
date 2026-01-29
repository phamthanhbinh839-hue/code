<?php 
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$title = 'Chỉnh Sửa Mã Nguồn | ' . $TN->site('title');
$body = [
    'title' => 'Chỉnh sửa mã nguồn'
];
$body['header'] = '
    <!-- DataTables -->
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('public/AdminLTE3/').'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
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
if(isset($_GET['id']) && $getUser['level'] == 1)
{
    $row = $TN->get_row(" SELECT * FROM `tbl_list_code` WHERE `id` = '".xss($_GET['id'])."'  ");
    if(!$row)
    {
        die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "javascript:history.back()";}</script>');
    }
}
else
{
    die('<script type="text/javascript">if(!alert("Không tồn tại !")){location.href = "javascript:history.back()";}</script>');
}
if(isset($_POST['Save']) && $getUser['level'] == 1)
{
    $isUpdate= $TN->update("tbl_list_code", array(
        'name'       => xss($_POST['name']),
        'price'       => xss($_POST['price']),
        'images'       => xss($_POST['images']),
        'list_images'       => xss($_POST['list_images']),
        'intro'       => $_POST['intro'],
        'link_down'       => nguyencoder_enc(xss($_POST['link_down'])),
        'link_demo'       => xss($_POST['link_demo']),
        'status'       => xss($_POST['status']),
        'update_date'       => gettime(),
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
                    <a class="btn btn-danger btn-icon-left m-b-10" href="<?=BASE_URL('admin/list-code')?>"
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
                            CHỈNH SỬA MÃ NGUỒN
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
                                <label for="exampleInputEmail1">Tên Mã Nguồn</label>
                                <input type="text" class="form-control" name="name" value="<?=$row['name']?>"
                                    placeholder="Nhập tên mã nguồn" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá Bán</label>
                                <input type="number" class="form-control"
                                    name="price" value="<?=$row['price']?>" placeholder="Nhập giá bán" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link banner</label>
                                <input type="text" class="form-control"
                                    name="images" value="<?=$row['images']?>" placeholder="Nhập link banner" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link ảnh mô tả</label>
                                                                <textarea class="form-control" name="list_images"
                                                                    placeholder="Nhập link ảnh mô tả (mỗi dùng 1 link)"
                                                                    rows="6"><?=$row['list_images']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mô tả code</label>
                                <textarea type="text" class="form-control" id="intro" name="intro"><?=$row['intro']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link tải code</label>
                                <input type="text" class="form-control"
                                    name="link_down" value="<?=nguyencoder_dec($row['link_down'])?>" placeholder="Nhập link tải code" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Link demo</label>
                                <input type="text" class="form-control"
                                    name="link_demo" value="<?=$row['link_demo']?>" placeholder="Nhập link demo" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Trạng Thái</label>
                                <select class="form-control" name="status" required>
                                    <option <?= $row['status'] == '1' ? 'selected' : ''; ?> value="1">Hoạt Động</option>
                                    <option <?= $row['status'] == '0' ? 'selected' : ''; ?> value="0">Bảo Trì</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button name="Save" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                    class="fas fa-save mr-1"></i>Lưu Ngay</button>
                        </div>
                    </form>
                </div>
            </section>
            
        </div>
    </section>
</div>
<script>
    $('#intro').summernote({
        placeholder: 'Điền nội dung',
        tabsize: 2,
        height: 400,
    });
</script>
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