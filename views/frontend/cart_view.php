<?php
use App\Libraries\Cart;
$title="Giỏ hàng";
?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <div class="container my-3 mb-3">
        <div class="row">
            <!-- <div class="col-md-3">
                <?php require_once('views/frontend/mod_slider.php');?>
            </div> -->
            <div class="col-md-9">
                <h3>GIỎ HÀNG</h3>
                <?php $totalMoney=0;?>
                <?php
                $list_content = Cart::contentCart();
                ?>
                <?php if($list_content != null):?>
                <form name="form" action="index.php?option=cart&updatecart=true" method = "post">
                    <table class="table table-borderd">
                        <tr>
                            <th>ID</th>
                            <th style="width:100px">Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                        <?php foreach($list_content as $rcart):?>
                        <tr>
                            <td><?php echo $rcart['Id'] ?></td>
                            <td>
                                <img src="public/images/product/<?php echo $rcart['Img'];?>" class="img-fluid"
                                    alt="<?php echo $rcart['Img'];?>">
                            </td>
                            <td><?php echo $rcart['Name'] ?></td>
                            <td><?php echo number_format($rcart['Price']); ?><sup>đ</sup></td>
                            <td>
                                <input style="width:90px" max="10" min="1" type="number" name="qty[]"
                                    value="<?php echo $rcart['qty'] ?>" />
                            </td>
                            <td><?php echo number_format($rcart['amount']*$rcart['qty']) ?><sup>đ</sup></td>
                            <td>
                                <a href="index.php?option=cart&delcart=<?php echo $rcart['Id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <?php $totalMoney+=$rcart['amount']*$rcart['qty'];?>
                        </tr>
                        <?php endforeach;?>

                        <tr>
                            <td colspan="5">
                                <a class="btn btn-danger" href="index.php?option=cart&delcart=all">Xóa tất cả</a>
                                <!-- <button type="submit" class="btn btn-success">Cập nhật</button> -->
                            </td>
                            <td colspan="2" class="text-end">
                                <?php echo "Tổng tiền: ".number_format($totalMoney);?><sup>đ</sup>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a class="btn btn-info" href="index.php">Tiếp tục mua sắm</a>
                            </td>
                            <td colspan="7" class="text-end">
                                <a class="btn btn-success" href="index.php?option=pay_view">Thanh toán</a>
                                <!-- <button type="submit" class="btn btn-info">Cập nhật</button>-->
                            </td>

                        </tr>
                    </table>
                </form>
                <?php else:?>
                GIỎ HÀNG CỦA BẠN CHƯA CÓ SẢN PHẨM NÀO
                <?php endif;?>
            </div>
        </div>
    </div>
</section>
<!--section content-->
<?php require_once('views/frontend/footer.php'); ?>