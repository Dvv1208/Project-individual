<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Libraries\Cart;
use App\Models\Product;
use App\Models\User;


$title = 'Đặt hàng thành công';
$user = User::find($_SESSION['user_id']);
$order = Order::where('Code', '=', $_SESSION['order_id'])->with('products')->first();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <form name="forml" action="index.php?option=cart-process" method="get">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 text-center py-5">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Đặt hàng thành công</h2>
                    <p class="lead">Cảm ơn bạn đã mua sắm tại cửa hàng !.</p>
                </div>
                <div class="col-md-8 order-md-1">

                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>Họ tên khách hàng</th>
                                <th>Địa chỉ khách hàng</th>
                                <th>Điện thoại khách hàng</th>
                                <th>Email khách hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $username->Fullname; ?></td>
                                <td><?php echo $username->Address; ?></td>
                                <td><?php echo $username->Phone; ?></td>
                                <td><?php echo $username->Email; ?></td>
                            </tr>
                        <tbody>
                    </table>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="httt-1" name="httt_ma" type="radio" class="custom-control-input" required="" value="1">
                            <label class="custom-control-label" for="httt-1">Tiền mặt</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required="" value="2">
                            <label class="custom-control-label" for="httt-2">Chuyển khoản</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-3" name="httt_ma" type="radio" class="custom-control-input" required="" value="3">
                            <label class="custom-control-label" for="httt-3">Ship COD</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3>Thông tin sản phẩm</h3>
                        <?php $totalMoney = 0; ?>
                        <table class="table table-borderd">
                            <tr>
                                <th class="text-center" style="width:100px">Hình ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Mã đơn hàng</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                            <?php foreach ($order->products as $product) : ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="public/images/product/<?php echo $product->Img; ?>" class="img-fluid" alt="<?php echo $product->Img; ?>">
                                    </td>
                                    <td class="text-center"><?php echo $product->Name; ?></td>
                                    <td class="text-center"><?php echo $product->pivot->Orderid; ?></td>
                                    <td class="text-center"><?php echo $product->pivot->Quantity; ?></td>
                                    <td class="text-center">
                                        <?php echo number_format($product->pivot->Amount, 0, ',', '.') . "<sup>đ</sup>"; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <hr class="mb-4">
                    <div class="col-md-4 order-md-2 mb-4">
                        <a class="btn btn-info" href="index.php?option=cart">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
    </form>

    </div>
    </main>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popperjs/popper.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/app.js"></script>
    </body>

    </html>