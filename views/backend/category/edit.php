<?php

use App\Models\Category;
use App\Libraries\MyClass;

$category = new Category();
$id = $_REQUEST['id'];
$list = Category::where('Status', '!=', '0')->get();
$row = Category::find($id);
if ($row == null) {
    MyClass::set_flash("message", ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=category");
}
$strparentid = '';
$strorders = '';
$strposition = '';
foreach ($list as $item) {
    if ($item['Id'] != $id) {
        if ($row['Parentid'] == $item['Id']) {
            $strparentid .= "<option selected value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
        } else {
            $strparentid .= "<option value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
        }
        if ($row['Orders'] - 1 == $item['Orders']) {
            $strorders .= "<option value='" . $item['Orders'] . "'> Sau: " . $item['Name'] . "</option>";
        } else {
            $strorders .= "<option value='" . $item['Orders'] . "'> Sau: " . $item['Name'] . "</option>";
        }
        if ($row['Position'] == $item['Id']) {
            $strposition .= "<option selected value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
        } else {
            $strposition .= "<option value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
        }
    }
}
?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="forml" action="index.php?option=category&cat=process" method="post">
    <div class="content-wrapper py-2">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                            <li class="breadcrumb-item active"><a href="index.php?option=category">Danh mục</a></li>
                            <li class="breadcrumb-item active">Cập nhật danh mục</li>
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
                            <a href="index.php?option=category" class="btn btn-sm btn-info">
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
                        <input name="id" value="<?php echo $row['Id']; ?>" type="hidden" />
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="name">Tên danh mục</label>
                                <input name="data[Name]" value="<?php echo $row['Name']; ?>" id="name" type="text" class="form-control" required placeholder="Nhập tên danh mục" />
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa SEO</label>
                                <textarea name="data[Metakey]" id="metakey" class="form-control" required rows="4"><?php echo $row['Metakey']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả SEO</label>
                                <textarea name="data[Metadesc]" id="metadesc" class="form-control" required rows="4"><?php echo $row['Metadesc']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                    <option value="0">None</option>
                                    <?php echo $strorders; ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng Thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?php echo ($row['Status'] == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?php echo ($row['Status'] == 2) ? 'selected' : ''; ?>>Chưa xuất bản
                                    </option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</form>
<!-- /.content-wrapper -->

<?php require_once('../views/backend/footer.php'); ?>