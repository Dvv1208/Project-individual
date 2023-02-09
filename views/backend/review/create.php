<?php

use App\Models\Reviews;
use App\Libraries\MyClass;
use App\Models\Product;

$list = Reviews::get();
$product = Product::where('Status', '!=', 0)->get();
$strproid = "";
foreach ($product as $item) {
  $strproid .= "<option value='" . $item["Id"] . "'>" . $item["Name"] . "</option>";
}

?>
<?php require_once('../views/backend/header.php'); ?>
<form action="index.php?option=review&cat=process" name="form1" method="post">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
            <li class="breadcrumb-item active"><a href="index.php?option=review">Đánh giá</a></li>
            <li class="breadcrumb-item active">Thêm đánh giá người dùng</li>
          </ol>
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
              <button type="submit" name="THEM" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Thêm]</a>
              </button>
              <a href="index.php?option=review" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php require_once('../views/backend/message_alert.php'); ?>
          <div class="row">
            <div class="col-md-12">
              <input name="id" type="hidden" id="id" class="form-control">
              <div class="mb-3">
                <label for="name">Tên người đánh giá</label>
                <input name="user_name" id="name" rows="5" placeholder="Nhập tên người đánh giá" class="form-control">
              </div>
              <div class="mb-3">
                <label for="proid">Mã sản phẩm</label>
                <select name="proid" class="form-control" required>
                  <option value="">Chọn loại sản phẩm</option>
                  <?= $strproid; ?>
                </select>
              </div>
              <div class="mb-3">
                <label for="ratting">Xếp hạng đánh giá</label>
                <select name="rating" class="form-control" required>
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="review">Đánh giá của người dùng</label>
                <input name="user_review" id="review" rows="5" placeholder="Nhập đánh giá của người dùng" class="form-control">
              </div>
            </div>
          </div>

    </section>
  </div>
</form>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>