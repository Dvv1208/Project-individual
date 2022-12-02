<?php

use App\Models\Menu;
use App\Libraries\MyClass;


$menu = new Menu();
$id = $_REQUEST['id'];
$list = Menu::where('Status', '!=', '0')->get();
$row = Menu::find($id);
if ($row == null) {
    MyClass::set_flash("message", ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=product");
}
$strparentid = "";
$strorders = "";
foreach ($list as $item) {
    $strparentid .= "<option value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
    $strorders .= "<option value='" . $item['Orders'] . "'> Sau: " . $item['Name'] . "</option>";
}

?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="forml" action="index.php?option=menu&cat=process" method="post">
    <div class="content-wrapper py-2">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                            <li class="breadcrumb-item active"><a href="index.php?option=menu">Menu</a></li>
                            <li class="breadcrumb-item active">Cập nhật menu</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <a href="index.php?option=menu" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>Lưu [Cập nhật]
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <input name="id" value="<?php echo $row['Id']; ?>" type="hidden" />
                            <div class="mb-3">
                                <label for="name">Tên Menu</label>
                                <input name="data[Name]" value="<?php echo $row['Name']; ?>" id="name" type="text" class="form-control" required placeholder="Nhập tên menu" />
                            </div>
                            <div class="mb-3">
                                <label for="link">Liên kết</label>
                                <input name="data[Link]" value="<?php echo $row['Link']; ?>" id="link" type="text" class="form-control" placeholder="#" />
                            </div>
                            <div class="mb-3">
                                <label for="type">Loại menu</label>
                                <input name="data[Type]" value="<?php echo $row['Type']; ?>" id="type" type="text" class="form-control" placeholder="Nhập loại menu" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="position">Vị trí</label>
                                <select name="position" value="<?php echo $row['Position']; ?>" id="position" class="form-control">
                                    <option value="mainmenu">Mainmenu</option>
                                    <option value="vitrikhac">Vị trí khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="parentid">Cấp cha</label>
                                <select name="parentid" id="parentid" class="form-control">
                                    <option value="0">None</option>
                                    <?= $strparentid; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="orders">Sắp xếp</label>
                                <select name="orders" id="orders" class="form-control">
                                    <?= $strorders; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng Thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</form>
<!-- /.content-wrapper -->

<?php require_once('../views/backend/footer.php'); ?>