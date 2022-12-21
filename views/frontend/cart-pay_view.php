<?php

use App\Models\User;
use App\Libraries\Cart;


$title = 'Thanh toán';
$username = User::find($_SESSION['user_id']);

if (!isset($_SESSION['logincustomer'])) {
    $_SESSION['checkout'] = true;
    header('location:index.php?option=customer-login');
} else {
    unset($_SESSION['checkout']);
}

?>

<?php require_once('views/frontend/header.php'); ?>
<?php include_once('views/frontend/message_alert.php'); ?>
<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php?option=cart_view">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="clearfix main mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 py-5">
                <form action="index.php?option=cart-process" method="post">
                    <h4 class="mb-3 text-center">Thông tin khách hàng</h4>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="Name" placeholder="<?php echo $username->Fullname; ?>" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" name="Diachi" placeholder="<?php echo $username->Address; ?>" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="phone">Điện thoại</label>
                            <input type="text" name="Phone" placeholder="<?php echo $username->Phone; ?>" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="text" name="Email" placeholder="<?php echo $username->Email; ?>" class="form-control">
                            <input name="OrderStatus" value="1" type="hidden" />
                        </div>
                    </div>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <select value="pay" class="text-center" name="payment">
                        <option <?php if (isset($pay) && $pay == 'Khi nhận hàng') echo "selected=\"selected\""; ?>value="Khi nhận hàng"> Thanh toán khi nhận hàng</option>
                        <option <?php if (isset($pay) && $pay == 'Thanh toán bằng VnPay') echo "selected=\"selected\""; ?>value="Thanh toán bằng VnPay" name="redirect"> Thanh toán bằng VnPay</option>
                        <option <?php if (isset($pay) && $pay == 'Thanh toán bằng Momo') echo "selected=\"selected\""; ?> value="Thanh toán bằng Momo"> Thanh toán bằng Momo
                        </option>
                    </select>
                    <div class="col-md-4 order-md-2 mb-4">
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 order-md-2 mb-4 text-end">
                            <a class="btn btn-outline-info" href="index.php?option=cart">Quay về giỏ hàng</a>
                            <tr>
                                <td>
                                    <input type="hidden" name="action" value="dathang">
                                    <button class="btn btn-outline-success" name="dathang" onclick="confirmOrder();" type="submit">Đặt hàng</button>
                                    </input>
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
                                    <td class="text-center"><?php echo number_format($rcart['Price'], 0, ',', '.'); ?><sup>đ</sup></td>
                                    <td class="text-center"><?php echo $rcart['qty'] ?></td>
                                    <td class="text-center">
                                        <?php echo number_format($rcart['Price'] * $rcart['qty'], 0, ',', '.') ?><sup>đ</sup></td>
                                    <?php $totalMoney += $rcart['amount'] ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4">
                                </td>
                                <td colspan="2" class="text-end">
                                    <?php echo "Tổng tiền: " . number_format($totalMoney, 0, ',', '.'); ?><sup>đ</sup>
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