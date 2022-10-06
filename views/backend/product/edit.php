<?php
use App\Models\Product;

$product = new Product();
$id = $_REQUEST['id'];
$list = Product::where('Status', '!=', '0')->get();
$row = Product::find($id);
if($row == null){
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=product");
}
$strcatid='';
foreach($list as $item)
{
    $strcatid .= "<option value = '" .$item['Id'] ."'>" .$item['Name'] . "</option>";
}
 ?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
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
                            <a href="index.php?option=product" class="btn btn-sm btn-info">
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
                                <label for="name">Tên sản phẩm</label>
                                <input name="data[Name]" value="<?php echo $row['Name']; ?>" id="name" type="text"
                                    class="form-control" required placeholder="Nhập tên sản phẩm" />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi Tiết Sản Phẩm</label>
                                <textarea name="data[Detail]" id="detail" class="form-control" required
                                    rows="4"><?php echo $row['Detail']; ?> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa SEO</label>
                                <textarea name="data[Metakey]" id="metakey" class="form-control" required
                                    rows="4"><?php echo $row['Metakey']; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả SEO</label>
                                <textarea name="data[Metadesc]" id="metadesc" class="form-control" required
                                    rows="4"><?php echo $row['Metadesc']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="catid">Chọn Loại Sản Phẩm</label>
                                <select name="data[Catid]" id="catid" class="form-control" required>
                                    <option value="">Chọn Loại</option>
                                    <?= $strcatid; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="number">Số Lượng</label>
                                <input name="data[Number]" id="number" class="form-control" type="number" min="1"
                                    max="10000000" value="<?php echo $row['Number']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="data[Price]" id="price" class="form-control" type="number" step="1000"
                                    min="50000" max="99999999999" value="<?php echo $row['Price']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="pricesale">Giá Khuyến Mãi</label>
                                <input name="data[Pricesale]" id="pricesale" class="form-control" type="number"
                                    step="1000" min="50000" max="99999999999"
                                    value="<?php echo $row['Pricesale']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="hinh">Hinh</label>
                                <input name="img" id="img" type="file" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng Thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?php echo ($row['Status']==1)?'selected':''; ?>>Xuất bản</option>
                                    <option value="2" <?php echo ($row['Status']==2)?'selected':''; ?>>Chưa xuất bản
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