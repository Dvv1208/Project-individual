<?php

use App\Models\Order;
use App\Libraries\Cart;

$title = 'Thanh toán';

if (!isset($_SESSION['logincustomer'])) {
    header('location:index.php?option=customer-login');
}

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 py-5">
                <h4 class="mb-3 text-center">Thông tin khách hàng</h4>
                <form action="index.php?option=cart-process" method="post" onSubmit="dathang">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="Name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" name="Diachi" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="phone">Điện thoại</label>
                            <input type="text" name="Phone" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="text" name="Email" class="form-control">
                        </div>
                    </div>
                </form>
                <h4 class="mb-3">Hình thức thanh toán</h4>
                <div class="d-block my-3" required>
                    <p><input type="radio" name="phuongthuctt" value="ck"> Chuyển khoản</p>
                    <p><input type="radio" name="phuongthuctt" value="khinhan"> Khi nhận hàng</p>
                    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="index.php?option=init_payment">
                        <p><input id="momo" name="phuongthuctt" type="submit" class="custom-control-input" value="Thanh toán momo QRCode"></p>
                    </form>
                </div>

                <div class="col-md-4 order-md-2 mb-4">
                </div>
                <form action="index.php?option=cart-process" method="post">
                    <div class="form-group">
                        <div class="col-md-12 order-md-2 mb-4 text-end">
                            <a class="btn btn-info" href="index.php?option=cart">Quay về giỏ hàng</a>
                            <tr>
                                <td>
                                    <button class="btn btn-success" name="dathang" type="submit">Đặt hàng</button>
                                </td>
                            </tr>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-md-8 order-md-1">
                <div class="col-md-9">
                    <h3>Thông tin sản phẩm</h3>
                    <?php $totalMoney = 0; ?>
                    <?php
                    $list_content = Cart::contentCart();
                    ?>
                    <?php if ($list_content != null) : ?>
                        <table class="table table-borderd">
                            <tr>
                                <th class="text-center" style="width:100px">Hình ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                            <?php foreach ($list_content as $rcart) : ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="public/images/product/<?php echo $rcart['Img']; ?>" class="img-fluid" alt="<?php echo $rcart['Img']; ?>">
                                    </td>
                                    <td class="text-center"><?php echo $rcart['Name'] ?></td>
                                    <td class="text-center"><?php echo number_format($rcart['Price'],0,',','.'); ?><sup>đ</sup></td>
                                    <td class="text-center"><?php echo $rcart['qty'] ?></td>
                                    <td class="text-center">
                                        <?php echo number_format($rcart['amount'] * $rcart['qty'],0,',','.') ?><sup>đ</sup></td>
                                    <?php $totalMoney += $rcart['amount'] * $rcart['qty']; ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4">
                                </td>
                                <td colspan="2" class="text-end">
                                    <?php echo "Tổng tiền: " . number_format($totalMoney,0,',','.'); ?><sup>đ</sup>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>