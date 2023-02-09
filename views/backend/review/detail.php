<?php

use App\models\Reviews;

$id = $_REQUEST['id'];
$row = Reviews::find($id);
if ($row == null) {
  header("location:index.php?option=review");
}
?>
<?php require_once('../views/backend/header.php'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
          <li class="breadcrumb-item active"><a href="index.php?option=review">Đánh giá</a></li>
          <li class="breadcrumb-item active">Chi tiết đánh giá</li>
        </ol>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">

    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-12 text-right">
            <a href="index.php?option=review" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
            <a href="index.php?option=review&cat=edit&id=<?php echo $row['review_id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
              <i class="fas fa-edit"></i>
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-boadered" id="myTable">
          <tr>
            <th>Mã review</th>
            <td><?php echo $row['review_id']; ?></td>
          </tr>
          <tr>
            <th>Mã sản phẩm đánh giá</th>
            <td><?php echo $row['pro_id']; ?></td>
          </tr>
          <tr>
            <th>Tên người đánh giá</th>
            <td><?php echo $row['user_name']; ?></td>
          </tr>
          <tr>
            <th>Xếp hạng của người đánh giá</th>
            <td><?php echo $row['user_rating']; ?></td>
          </tr>
          <tr>
            <th>Đánh giá của người dùng</th>
            <td><?php echo $row['user_review']; ?></td>
          </tr>
          <tr>
            <th>Ngày tạo</th>
            <td><?php echo date('y-m-d H:i:s', $row["datetime"]); ?></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>