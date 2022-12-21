<?php

use App\Models\Order;
use App\Libraries\MyClass;

$order = new Order();
$id = $_REQUEST['code'];
$row = Order::find($id);
$orders = Order::where('Code', '=', $id)->with('products')->get();

?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=order&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper py-2">
        <section class="content">
            <div class="card">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                    <li class="breadcrumb-item active"><a href="index.php?option=order">Đơn hàng</a></li>
                    <li class="breadcrumb-item active">Cập nhật đơn hàng</li>
                </ol>
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-danger">Cập nhật đơn hàng</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?option=order" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>Lưu [Cập nhật]
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    foreach ($orders as $order) : ?>
                        <?php
                        $totalMoney = 0;
                        $qty = 0;
                        foreach ($order->products as $product) {
                            $totalMoney += $product->pivot->Amount;
                            $qty += $product->pivot->Quantity;
                        }
                        ?>
                        <div class="row">
                            <input name="id" value="<?php echo $order['Id']; ?>" type="hidden" />
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="detail">Mã đơn hàng</label>
                                    <input name="code" value="<?php echo $order['Code']; ?>" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="name">Tên người mua hàng</label>
                                    <input name="data[Name]" value="<?php echo $order['Name']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="name">Địa chỉ người mua</label>
                                    <input name="data[Diachi]" value="<?php echo $order['Diachi']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="metakey">Số điện thoại người mua</label>
                                    <input name="data[Phone]" value="<?php echo $order['Phone']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="metakey">Email người mua</label>
                                    <input name="data[Email]" value="<?php echo $order['Email']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="catid">Phương thức thanh toán</label>
                                    <input name="data[Pttt]" value="<?php echo $order['Pttt']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="number">Số Lượng</label>
                                    <input id="number" class="form-control" type="number" min="1" max="10000000" readonly value="<?php echo $qty; ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="amount">Thành tiền</label>
                                    <input id="amount" class="form-control" readonly value="<?php echo number_format($totalMoney, 0, ',', '.') ?>" />
                                </div>
                                <div class="mb-3">
                                    <label for="orderstatus">Trạng Thái đơn hàng</label>
                                    <select name="orderstatus" id="orderstatus" class="form-control">
                                        <option value="1" <?php echo ($order['OrderStatus'] == 1) ? 'selected' : ''; ?>>Chờ xác nhận</option>
                                        <option value="2" <?php echo ($order['OrderStatus'] == 2) ? 'selected' : ''; ?>>Đang giao hàng
                                        </option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>
</form>

<?php require_once('../views/backend/footer.php'); ?>