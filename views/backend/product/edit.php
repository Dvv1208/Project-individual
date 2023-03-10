<?php

use App\Models\Category;
use App\Models\Product;
use App\Libraries\MyClass;
use App\Models\ProductsImages;

$product = new Product();
$id = $_REQUEST['id'];
$list = Product::where('Status', '!=', '0')->get();
$row = Product::find($id);
if ($row == null) {
    MyClass::set_flash("message", ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=product");
}

$listct = Category::where('Parentid', '=', '0')->get();
$strcatid = "";
foreach ($listct as $item) {
    $strcatid .= "<option value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
}
$imgD = ProductsImages::where('proId', '=', $id)->get();

?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper py-2">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                            <li class="breadcrumb-item active"><a href="index.php?option=product">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="index.php?option=product" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i>Lưu [Cập nhật]
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
                                <input name="data[Name]" value="<?php echo $row['Name']; ?>" id="name" type="text" class="form-control" required placeholder="Nhập tên sản phẩm" />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi Tiết Sản Phẩm</label>
                                <textarea name="data[Detail]" id="detail" class="form-control" required rows="4"><?php echo $row['Detail']; ?> </textarea>
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
                                <label for="catid">Chọn Loại Sản Phẩm</label>
                                <select name="data[Catid]" id="catid" class="form-control" required>
                                    <option value="<?php echo $row['Catid']; ?>">Mặc định</option>
                                    <?= $strcatid; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="number">Số Lượng</label>
                                <input name="data[Number]" id="number" class="form-control" type="number" min="1" max="10000000" value="<?php echo $row['Number']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="data[Price]" id="price" class="form-control" type="number" step="1000" min="50000" max="99999999999" value="<?php echo $row['Price']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="pricesale">Giá Khuyến Mãi</label>
                                <input name="data[Pricesale]" id="pricesale" class="form-control" type="number" step="1000" min="50000" max="99999999999" value="<?php echo $row['Pricesale']; ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="img">Hình</label>
                                <img style="height: 50px; width: 50px;" onClick="img()" id="imgProduct" src="../public/images/product/<?php echo $row['Img']; ?>" />
                                <input type="file" name="avt" onChange="imgDisplay(this)" id="avt" class="form-control" style="display: none;" />
                            </div>
                            <div class="mb-3">
                                <label for="imgdetail">Hình chi tiết</label>
                                <?php foreach ($imgD as $imgDetail) : ?>
                                    <img style="height: 50px; width: 50px;" src="../public/images/product/images/<?php echo $imgDetail->ImgId; ?>" />
                                <?php endforeach; ?>
                                <input type="file" name="imgd[]" id="imgd" multiple />
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
            </div>
        </section>
    </div>
</form>
<?php require_once('../views/backend/footer.php'); ?>

<script>
    function img(e) {
        document.querySelector('#avt').click();
    }

    function imgDisplay(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#imgProduct').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
<!-- <script>
    function imagefun(e) {
        document.querySelector('#imgd').click();
    }

    function imgDetailDisplay(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#imgDetail').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }

    }
</script> -->