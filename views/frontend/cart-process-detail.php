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
<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php?option=cart_view">Giỏ hàng</a></li>
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php?option=cart-pay_view">Thanh toán</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="clearfix main mt-2">
    <form name="forml" action="index.php?option=cart-process" method="get">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 text-center py-5">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Đặt hàng thành công</h2>
                    <p class="lead">Cảm ơn bạn đã mua sắm tại cửa hàng !.</p>
                </div>
                <div class="col-md-8">
                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-center">Họ tên khách hàng</th>
                                <th class="text-center">Địa chỉ khách hàng</th>
                                <th class="text-center">Sđt khách hàng</th>
                                <th class="text-center">Email khách hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $order->Name; ?></td>
                                <td class="text-center"><?php echo $order->Diachi; ?></td>
                                <td class="text-center"><?php echo $order->Phone; ?></td>
                                <td class="text-center"><?php echo $order->Email; ?></td>
                            </tr>
                        <tbody>
                    </table>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <label><?php echo $order->Pttt ?></label>
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
                        <a class="btn btn-outline-info" href="index.php">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
    </form>

    <?php require_once('views/frontend/footer.php'); ?>