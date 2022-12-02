<?php

use App\Models\Order;


$id = $_REQUEST["code"];
$row = Order::find($id);
// if ($row != null) {
//   header("location:index.php?option=order");
// }

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
            <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="card">
      <div class="row">
        <div class="col-12 text-right">
          <a href="index.php?option=order" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại danh sách
          </a>
          <?php $orders = Order::where('Code', '=', $id)->with('products')->get();
          foreach ($orders as $order) : ?>
            <a href="index.php?option=order&cat=edit&id=<?php echo $order['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
              <i class="fas fa-edit">Sửa</i>
            </a>
          <?php endforeach; ?>
          <!-- <a href="index.php?option=order&cat=deltrash&id=<?php echo $row['Code']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
            <i class="fas fa-trash">Xóa</i>
          </a> -->
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="myTable">
          <tr>
            <th class="text-center">Tên người nhận</th>
            <th class="text-center">Sđt người nhận</th>
            <th class="text-center">Địa chỉ người nhận</th>
            <th class="text-center">Mã đơn hàng</th>
            <th class="text-center">Số lượng</th>
            <th class="text-center">Thành tiền</th>
            <th class="text-center">Hình thức thanh toán</th>
            <th class="text-center">Trạng thái đơn hàng</th>
            <th class="text-center">Ngày tạo</th>
            <th style="width:20px" class="text-center">Id</th>
          </tr>
          </thead>
          <tbody>
            <?php $orders = Order::where('Code', '=', $id)->with('products')->get();
            foreach ($orders as $order) : ?>
              <?php
              $totalMoney = 0;
              $qty = 0;
              foreach ($order->products as $product) {
                $totalMoney += $product->pivot->Amount;
                $qty += $product->pivot->Quantity;
              }
              ?>
              <td class="text-center"><?php echo $order['Name']; ?></td>
              <td class="text-center"><?php echo $order['Phone']; ?></td>
              <td class="text-center"><?php echo $order['Diachi']; ?></td>
              <td class="text-center"><?php echo $order['Code']; ?></td>
              <td class="text-center"><?php echo $qty; ?></td>
              <td class="text-center"><?php echo number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>"; ?></td>
              <td class="text-center"><?php echo $order['Pttt']; ?></td>
              <td class="text-center">
                <?php
                if (($order->OrderStatus) == "1") {
                  echo ("Chờ xác nhận");
                } elseif (($order->OrderStatus) == "0") {
                  echo ("Đã hủy");
                } else {
                  echo ("Đang giao hàng");
                }
                ?>
              </td>
              <td class="text-center"><?php echo $order['CreatedAt']; ?></td>
              <td class="text-center"><?php echo $order['Id']; ?></td>
              </tr>
            <?php endforeach; ?>
        </table>
      </div>

    </div>
  </section>
</div>
<?php require_once('../views/backend/footer.php'); ?>