<?php
use App\Models\Page;

$Page = new Page();
$id = $_REQUEST['id'];
$list = Page::where('Status', '!=', '0')->get();
$row = Page::find($id);
if($row == null){
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=page");
}
$strcatid='';
foreach($list as $item)
{
    $strcatid .= "<option value = '" .$item['Id'] ."'>" .$item['Name'] . "</option>";
}
 ?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=page&cat=process" method="page" enctype="multipart/form-data">
    <div class="content-wrapper py-2">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-danger">Cập nhật danh mục</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?option=page" class="btn btn-sm btn-info">
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
                                <label for="title">Tiêu đề</label>
                                <input name="data[Title]" id="title" type="text" class="form-control" required
                                    placeholder="Nhập tiêu đề bài viết" />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi Tiết</label>
                                <textarea name="data[Detail]" id="detail" class="form-control" required rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="data[Metakey]" id="metakey" class="form-control" required
                                    rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="data[Metadesc]" id="metadesc" class="form-control" required
                                    rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="img">Hình</label>
                                <input type="file" name="img" id="img" class="form-control">
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
                <!-- /.card-body -->
                <div class="card-footer">

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