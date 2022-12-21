<?php

use App\Models\Category;

$list = Category::where('Parentid', '=', '0')->get();
$strcatid = "";
foreach ($list as $item) {
    $strcatid .= "<option value = '" . $item['Id'] . "'>" . $item['Name'] . "</option>";
}
?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=product&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                            <li class="breadcrumb-item active"><a href="index.php?option=product">Sản phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm sản phẩm</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="index.php?option=product" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <input type="hidden" name="action" value="THEM">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Lưu [Thêm]
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input name="Name" type="text" class="form-control" required placeholder="Nhập tên sản phẩm" />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi Tiết Sản Phẩm</label>
                                <textarea name="Detail" class="form-control" required rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="Metakey" class="form-control" required rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="Metadesc" class="form-control" required rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="catid">Chọn loại sản phẩm</label>
                                <select name="Catid" class="form-control">
                                    <option value="0">Chọn loại</option>
                                    <?= $strcatid; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="number">Số Lượng</label>
                                <input name="Number" class="form-control" type="number" min="1" max="10000000" value="1" />
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="Price" class="form-control" type="number" step="1000" min="50000" max="99999999999" value="100000" />
                            </div>
                            <div class="mb-3">
                                <label for="pricesale">Giá khuyến mãi</label>
                                <input name="Pricesale" class="form-control" type="number" step="1000" min="50000" max="99999999999" value="100000" />
                            </div>
                            <div class="mb-3">
                                <label for="img">Hình</label>
                                <input type="file" name="avt" id="avt">
                            </div>
                            <div class="mb-3">
                                <label for="img">Hình chi tiết</label>
                                <input type="file" name="img[]" multiple>
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng Thái</label>
                                <select name="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</form>
<!-- /.content-wrapper -->

<?php require_once('../views/backend/footer.php'); ?>