<?php

use App\Models\Order;
use App\Libraries\MyClass;

$list = Order::where('OrderStatus', '!=', 0)->orderBy('CreatedAt', 'desc')->get();

?>

<?php require_once('../views/backend/header.php'); ?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
            <li class="breadcrumb-item active"><a href="index.php?option=order">Đơn hàng</a></li>
            <li class="breadcrumb-item active">Tất cả đơn hàng</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">

      <div class="row">
        <div class="col-12 text-right my-3">
          <a href="index.php?option=order&cat=trash" class="btn btn-sm btn-danger"></i> Đơn hàng bị hủy
          </a>
        </div>
      </div>
      <div class="card-body">
        <?php include_once('../views/backend/message_alert.php'); ?>
        <table class="table table-bordered" id="myTable">
          <thead>
            <tr>
              <th class="text-center">Mã đơn hàng</th>
              <th class="text-center">Tên người nhận</th>
              <th class="text-center">Sđt người nhận</th>
              <th class="text-center">Địa chỉ người nhận</th>
              <th class="text-center">Email</th>
              <th class="text-center">Hình thức thanh toán</th>
              <th class="text-center">Trạng thái đơn hàng</th>
              <th class="text-center">Chức năng</th>
              <th class="text-center">Ngày tạo</th>
              <th style="width:20px" class="text-center">Id</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td class="text-center"><?php echo $row['Code']; ?></td>
                <td class="text-center"><?php echo $row['Name']; ?></td>
                <td class="text-center"><?php echo $row['Phone']; ?></td>
                <td class="text-center"><?php echo $row['Diachi']; ?></td>
                <td class="text-center"><?php echo $row['Email']; ?></td>
                <td class="text-center"><?php echo $row['Pttt']; ?></td>
                <td class="text-center">
                  <?php
                  if (($row->OrderStatus) == "1") {
                    echo ("Chờ xác nhận");
                  } elseif (($row->OrderStatus) == "0") {
                    echo ("Đã hủy");
                  } else {
                    echo ("Đang giao hàng");
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if (($row->OrderStatus) == 0) : ?>
                    <a href="index.php?option=order&cat=detail&code=<?php echo $row['Code']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                      <i class="fas fa-eye"></i>
                    </a>
                  <?php else : ?>
                    <a href="index.php?option=order&cat=detail&code=<?php echo $row['Code']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="index.php?option=order&cat=edit&code=<?php echo $row['Code']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                      <i class="fas fa-edit"></i>
                    </a>
                  <?php endif; ?>
                </td>
                <td class="text-center"><?php echo $row['CreatedAt']; ?></td>
                <td class="text-center"><?php echo $row['Id']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->

      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</div>
<?php require_once('../views/backend/footer.php'); ?>

</section>
</div>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>