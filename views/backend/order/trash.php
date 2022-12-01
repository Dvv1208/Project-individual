<?php

use App\Models\Order;
use App\Libraries\MyClass;

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
                    <h1>Đơn hàng đã hủy</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Thùng rác danh mục</li>
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
                            <th style="width:5px" class="text-center">
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th class="text-center">Tên</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center">Sđt</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mã đơn hàng</th>
                            <th class="text-center">Số lượng sản phẩm</th>
                            <th class="text-center">Thành tiền</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <?php
                            $totalMoney = 0;
                            $qty = 0;
                            foreach ($row->products as $product) {
                                $totalMoney += $product->pivot->Amount;
                                $qty += $product->pivot->Quantity;
                            }
                            ?>
                            <tr>
                                <td style="width:5px" class="text-center">
                                    <input type="checkbox" name="checkId[]">
                                </td>
                                <td class="text-center"><?php echo $row['Name']; ?></td>
                                <td class="text-center"><?php echo $row['Diachi']; ?></td>
                                <td class="text-center"><?php echo $row['Phone']; ?></td>
                                <td class="text-center"><?php echo $row['Email']; ?></td>
                                <td class="text-center"><?php echo $row['Code']; ?></td>
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
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>