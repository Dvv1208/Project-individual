<?php

use App\Models\Reviews;
use App\Libraries\MyClass;

$id = $_REQUEST['id'];
$list = Reviews::get();
$row = Reviews::find($id);
if ($row == null) {
  MyClass::set_flash('message', array('type' => 'danger', 'msg' => 'Thất bại'));
  header("location:index.php?option=review");
}
$args = array(
  'status' => 'index'
);
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
            <li class="breadcrumb-item active">Chỉnh sửa đánh giá người dùng</li>
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
              <button type="submit" name="CAPNHAT" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Chỉnh sửa]</a>
              </button>
              <a href="index.php?option=review" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <?php require_once('../views/backend/message_alert.php'); ?>
          <div class="row">
            <div class="col-md-12">
              <input name="id" type="hidden" value="<?= $row['review_id']; ?>" id="id" class="form-control">
              <div class="mb-3">
                <label for="name">Tên người đánh giá</label>
                <input name="data[user_name]" id="name" rows="5" value="<?= $row['user_name']; ?>" class="form-control">
              </div>
              <div class="mb-3">
                <label for="proid">Mã sản phẩm</label>
                <input name="data[pro_id]" type="text" value="<?= $row['pro_id']; ?>" id="pro_id" placeholder="Nhập mã sản phẩm" class="form-control">
              </div>
              <div class="mb-3">
                <label for="ratting">Xếp hạng đánh giá</label>
                <input name="data[user_rating]" id="ratting" rows="5" value="<?= $row['user_rating']; ?>" class="form-control">
              </div>
              <div class="mb-3">
                <label for="review">Đánh giá của người dùng</label>
                <input name="data[user_review]" id="review" rows="5" value="<?= $row['user_review']; ?>" class="form-control">
              </div>
              <div class="mb-3">
                <label for="datetime">Ngày tạo</label>
                <input name="data[datetime]" id="datetime" rows="5" value="<?= $row["datetime"]; ?>" class="form-control">
              </div>
            </div>
          </div>

    </section>
  </div>
</form>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>