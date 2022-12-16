<?php

use App\Models\Order;
use App\Libraries\MyClass;
use App\Models\CancelOrder;

$list = Order::where('OrderStatus', '=', '0')->orderBy('CreatedAt', 'desc')->with('products')->get();
?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                        <li class="breadcrumb-item active"><a href="index.php?option=order">Đơn hàng</a></li>
                        <li class="breadcrumb-item active">Đơn hàng bị hủy</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="card">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="index.php?option=order" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại
                        danh sách
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if (MyClass::exists_flash('message')) : ?>
                    <?php
                    $arr_message = MyClass::get_flash('message');
                    ?>
                    <div class="alert alert-<?= $arr_message['type']; ?>" role="alert">
                        <?php echo $arr_message['msg']; ?>
                    </div>
                <?php endif; ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">Tên</th>
                            <th class="text-center" style="width: 250px;">Địa chỉ</th>
                            <th class="text-center">Sđt</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mã đơn hàng</th>
                            <th class="text-center">Lý do hủy</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Thành tiền</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <?php
                            $cancel = CancelOrder::where('Order_id', '=', $row->Code)->get();
                            foreach ($cancel as $c) {
                                $reason = $c->Reason;
                            }
                            $totalMoney = 0;
                            $qty = 0;
                            foreach ($row->products as $product) {
                                $totalMoney += $product->pivot->Amount;
                                $qty += $product->pivot->Quantity;
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $row['Name']; ?></td>
                                <td class="text-center"><?php echo $row['Diachi']; ?></td>
                                <td class="text-center"><?php echo $row['Phone']; ?></td>
                                <td class="text-center"><?php echo $row['Email']; ?></td>
                                <td class="text-center"><?php echo $row['Code']; ?></td>
                                <td class="text-center"><?php echo $reason; ?></td>
                                <td class="text-center"><?php echo $qty; ?></td>
                                <td class="text-center"><?php echo number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>"; ?></td>
                                <td class="text-center"><?php echo $row['CreatedAt']; ?></td>
                                <td class="text-center">
                                    <a href="index.php?option=order&cat=del&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
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
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>