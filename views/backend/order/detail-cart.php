<?php

use App\Models\Order;
use App\Models\Momo;
use App\Models\VnPay;

$id = $_REQUEST["code"];
$row = Order::find($id);

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
                        <li class="breadcrumb-item active">Chi tiết trạng thái thanh toán đơn hàng</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="index.php?option=order&cat=order-cart" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại danh sách
                    </a>
                    <?php $orders = Order::where('Code', '=', $id)->with('products')->get();
                    foreach ($orders as $order) : ?>
                        <a href="index.php?option=order&cat=edit-cart&code=<?php echo $order['Code']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                    <?php endforeach; ?>
                    <!-- <a href="index.php?option=order&cat=deltrash&id=<?php echo $row['Code']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
            <i class="fas fa-trash">Xóa</i>
          </a> -->
                </div>
            </div>
            <div class="card-body">
                <?php foreach ($orders as $order) : ?>
                    <?php
                    $totalMoney = 0;
                    $qty = 0;
                    foreach ($order->products as $product) {
                        $totalMoney += $product->pivot->Amount;
                        $qty += $product->pivot->Quantity;
                    }
                    ?>
                    <div class="row">
                        <?php if ($order['Pttt'] == "Thanh toán bằng VnPay") : ?>
                            <input name="id" value="<?php echo $order['Id']; ?>" type="hidden" />
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="detail">Mã đơn hàng</label>
                                    <input name="code" value="<?php echo $order['Code']; ?>" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="name">Tên người mua hàng</label>
                                    <input value="<?php echo $order['Name']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="daichi">Địa chỉ người mua</label>
                                    <input value="<?php echo $order['Diachi']; ?>" id="daichi" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="sdt">Số điện thoại người mua</label>
                                    <input value="<?php echo $order['Phone']; ?>" id="sdt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email người mua</label>
                                    <input value="<?php echo $order['Email']; ?>" id="email" type="text" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pttt">Phương thức thanh toán</label>
                                    <input value="<?php echo $order['Pttt']; ?>" id="pttt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="createdat">Ngày tạo</label>
                                    <input id="number" class="form-control" type="number" min="1" max="10000000" readonly value="<?php echo $qty; ?>" />
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
                                    <input id="orderstatus" type="text" class="form-control" readonly 
                                    value="<?php if (($order['OrderStatus']) == "0") { echo ("Đã hủy");
                                            } elseif (($order['OrderStatus']) == "1") {
                                                echo ("Chờ xác nhận");
                                            } else {
                                                echo ("Đang giao hàng");
                                            }
                                            ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php $vnpays = VnPay::where('vnp_TxnRef', '=', $order['Code'])->get() ?>
                                <?php foreach ($vnpays as $vnpay) : ?>
                                    <div class="mb-3">
                                        <label for="bankcode">Mã ngân hàng</label>
                                        <input value="<?php echo $vnpay->vnp_BankCode; ?>" id="bankcode" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="magiaodich">Mã giao dịch</label>
                                        <input value="<?php echo $vnpay->vnp_BankTranNo; ?>" id="magiaodich" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardtype">Loại tài khoản/ Thẻ</label>
                                        <input value="<?php echo $vnpay->vnp_CardType; ?>" id="cardtype" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="mawebsite">Mã website</label>
                                        <input value="<?php echo $vnpay->vnp_TmnCode; ?>" id="mawebsite" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="mgdvnp">Mã giao dịch tại VnPay</label>
                                        <input value="<?php echo $vnpay->vnp_TransactionNo; ?>" id="mgdvnp" type="text" class="form-control" readonly />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php elseif ($order['Pttt'] == "Thanh toán bằng Momo") : ?>
                            <input name="id" value="<?php echo $order['Id']; ?>" type="hidden" />
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code">Mã đơn hàng</label>
                                    <input name="code" value="<?php echo $order['Code']; ?>" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="name">Tên người mua hàng</label>
                                    <input value="<?php echo $order['Name']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="diachi">Địa chỉ người mua</label>
                                    <input value="<?php echo $order['Diachi']; ?>" id="diachi" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="sdt">Số điện thoại người mua</label>
                                    <input value="<?php echo $order['Phone']; ?>" id="sdt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email người mua</label>
                                    <input value="<?php echo $order['Email']; ?>" id="email" type="text" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pttt">Phương thức thanh toán</label>
                                    <input value="<?php echo $order['Pttt']; ?>" id="pttt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="createdat">Ngày tạo</label>
                                    <input value="<?php echo $order['CreatedAt']; ?>" id="createdat" type="text" class="form-control" readonly />
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
                                    <input id="orderstatus" type="text" class="form-control" readonly 
                                    value="<?php if (($order['OrderStatus']) == "0") { echo ("Đã hủy");
                                            } elseif (($order['OrderStatus']) == "1") {
                                                echo ("Chờ xác nhận");
                                            } else {
                                                echo ("Đang giao hàng");
                                            }
                                            ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php $momos = Momo::where('orderId', '=', $order['Code'])->get() ?>
                                <?php foreach ($momos as $momo) : ?>
                                    <div class="mb-3">
                                        <label for="mkh">Mã kết hợp</label>
                                        <input value="<?php echo $momo->partnerCode; ?>" id="mkh" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="ktt">Kiểu thanh toán</label>
                                        <input value="<?php echo $momo->orderType; ?>" id="ktt" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="mgg">Mã giao dịch</label>
                                        <input value="<?php echo $momo->transId; ?>" id="mgg" type="text" class="form-control" readonly />
                                    </div>
                                    <div class="mb-3">
                                        <label for="httt">Hình thức thanh toán</label>
                                        <input value="<?php echo $momo->payType; ?>" id="httt" type="text" class="form-control" readonly />
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($order['Pttt'] == "Khi nhận hàng") : ?>
                            <div class="col-md-9">
                                <div class="mb-3">
                                    <label for="code">Mã đơn hàng</label>
                                    <input name="code" value="<?php echo $order['Code']; ?>" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="name">Tên người mua hàng</label>
                                    <input value="<?php echo $order['Name']; ?>" id="name" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="diachi">Địa chỉ người mua</label>
                                    <input value="<?php echo $order['Diachi']; ?>" id="diachi" type="text" class="form-control" readonly />
                                </div>

                                <div class="mb-3">
                                    <label for="sdt">Số điện thoại người mua</label>
                                    <input value="<?php echo $order['Phone']; ?>" id="sdt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email người mua</label>
                                    <input value="<?php echo $order['Email']; ?>" id="email" type="text" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="pttt">Phương thức thanh toán</label>
                                    <input value="<?php echo $order['Pttt']; ?>" id="pttt" type="text" class="form-control" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="createdat">Ngày tạo</label>
                                    <input value="<?php echo $order['CreatedAt']; ?>" id="createdat" type="text" class="form-control" readonly />
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
                                    <input id="orderstatus" type="text" class="form-control" readonly 
                                    value="<?php if (($order['OrderStatus']) == "0") { echo ("Đã hủy");
                                            } elseif (($order['OrderStatus']) == "1") {
                                                echo ("Chờ xác nhận");
                                            } else {
                                                echo ("Đang giao hàng");
                                            }
                                            ?>" />
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</div>
<?php require_once('../views/backend/footer.php'); ?>