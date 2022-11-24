<?php

use App\Libraries\Cart;
use App\Libraries\Heart;

$title = "Giỏ hàng";

?>

<?php require_once('views/frontend/header.php'); ?>
<form action="index.php?option=cart" method="post">
    <section class="breadcrumb p-0 m-0">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-3">
                        <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="clearfix main mt-2">
        <div class="container my-3 mb-3">
            <div class="row">
                <div class="col-md-9">
                    <h3>GIỎ HÀNG CỦA TÔI</h3>
                    <?php $totalMoney = 0; ?>
                    <?php
                    $list_content = Cart::contentCart();
                    ?>
                    <?php if ($list_content != null) : ?>
                        <table class="table table-borderd">
                            <tr>
                                <th style="width:100px">Hình ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                                <th></th>
                            </tr>
                            <?php foreach ($list_content as $rcart) : ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="public/images/product/<?php echo $rcart['Img']; ?>" class="img-fluid" alt="<?php echo $rcart['Img']; ?>">
                                    </td>
                                    <td class="text-center"><?php echo $rcart['Name'] ?></td>
                                    <td class="text-center"><?php echo number_format($rcart['Price'], 0, ',', '.'); ?><sup>đ</sup></td>
                                    <td class="text-center">
                                        <input style="width:90px" max="10" min="1" type="number" name="qty[<?= $rcart['Id']; ?>]" value="<?php echo $rcart['qty'] ?>" />
                                    </td>
                                    <td class="text-center"><?php echo number_format($rcart['amount'] * $rcart['qty'], 0, ',', '.') ?><sup>đ</sup></td>
                                    <td class="text-center">
                                        <a href="index.php?option=cart&delcart=<?php echo $rcart['Id'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                    <?php $totalMoney += ($rcart['amount'] * $rcart['qty']); ?>
                                </tr>
                            <?php endforeach; ?>

                            <tr>
                                <td colspan="4">
                                    <a class="btn btn-outline-danger" href="index.php?option=cart&delcart=all">Xóa tất cả</a>
                                    <!-- <button type="submit" name="updateCart" class="btn btn-success">Cập nhật</button> -->
                                </td>
                                <td colspan="2" class="text-end">
                                    <?php echo "Tổng tiền: " . number_format($totalMoney, 0, ',', '.'); ?><sup>đ</sup>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a class="btn btn-outline-info" href="index.php">Tiếp tục mua sắm</a>
                                </td>
                                <td colspan="4" class="text-end">
                                    <a class="btn btn-outline-success" name="btnTt" href="index.php?option=cart-pay_view">Thanh toán</a>
                                    <!-- <button type="submit" class="btn btn-info">Cập nhật</button>-->
                                </td>

                            </tr>
                        </table>

                    <?php else : ?>
                        GIỎ HÀNG CỦA BẠN CHƯA CÓ SẢN PHẨM NÀO
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</form>
<!--section content-->
<?php require_once('views/frontend/footer.php'); ?>