<?php

use App\Models\Order;
use App\Libraries\MyClass;

$list = Order::where('OrderStatus', '!=', 0)->orderBy('CreatedAt', 'DESC')->get();

?>

<?php require_once('../views/backend/header.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                        <li class="breadcrumb-item active"><a href="index.php?option=order&cat=order-cart">Trạng thái đơn hàng</a></li>
                        <li class="breadcrumb-item active">Trạng thái thanh toán đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">

            <div class="row">
                <div class="col-12 text-right my-3">
                </div>
            </div>
            <div class="card-body">
                <?php include_once('../views/backend/message_alert.php'); ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">Mã đơn hàng</th>
                            <th class="text-center">Tên người đặt hàng</th>
                            <th class="text-center">Sđt người đặt hàng</th>
                            <th class="text-center">Trạng thái thanh toán</th>
                            <th class="text-center">Chức năng</th>
                            <th style="width:20px" class="text-center">Id</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td class="text-center"><?php echo $row['Code']; ?></td>
                                <td class="text-center"><?php echo $row['Name']; ?></td>
                                <td class="text-center"><?php echo $row['Phone']; ?></td>
                                <td class="text-center">
                                    <?php
                                    if (($row->Pttt) == "Thanh toán bằng VnPay") {
                                        echo ("Đã thanh toán bằng VnPay");
                                    } elseif (($row->Pttt) == "Thanh toán bằng Momo") {
                                        echo ("Đã thanh toán bằng Momo");
                                    } else {
                                        echo ("Thanh toán bằng tiền mặt");
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if (($row->Pttt) == "Thanh toán bằng VnPay") : ?>
                                        <a href="index.php?option=order&cat=detail-cart&code=<?php echo $row['Code']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?option=order&cat=edit-cart&code=<?php echo $row['Code']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    <?php elseif (($row->Pttt) == "Thanh toán bằng Momo") : ?>
                                        <a href="index.php?option=order&cat=detail-cart&code=<?php echo $row['Code']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?option=order&cat=edit-cart&code=<?php echo $row['Code']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="index.php?option=order&cat=detail-cart&code=<?php echo $row['Code']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="index.php?option=order&cat=edit-cart&code=<?php echo $row['Code']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php echo $row['Id']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<?php require_once('../views/backend/footer.php'); ?>

</section>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>