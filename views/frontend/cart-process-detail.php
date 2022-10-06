<?php 
use App\Models\Order;
use App\Models\Product;
use App\Libraries\Cart;

$title = 'Đặt hàng thành công';
$list_order = Order::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get();

$id = $_REQUEST['addcart'];
$row = Order::find($id);
?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <form name="forml" action="index.php?option=cart-process" method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 text-center py-5">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Đặt hàng thành công</h2>
                    <p class="lead">Cảm ơn bạn đã mua sắm tại cửa hàng !.</p>
                </div>
                <div class="col-md-8 order-md-1">

                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="data[Name]" id="name" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" name="data[Diachi]" id="diachi" class="form-control" n>
                        </div>
                        <div class="col-md-12">
                            <label for="phone">Điện thoại</label>
                            <input type="text" name="data[Phone]" id="phone" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email</label>
                            <input type="text" name="data[Email]" id="email" class="form-control">
                        </div>
                    </div>
                    <h4 class="mb-3">Hình thức thanh toán</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="httt-1" name="httt_ma" type="radio" class="custom-control-input" required=""
                                value="1">
                            <label class="custom-control-label" for="httt-1">Tiền mặt</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required=""
                                value="2">
                            <label class="custom-control-label" for="httt-2">Chuyển khoản</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="httt-3" name="httt_ma" type="radio" class="custom-control-input" required=""
                                value="3">
                            <label class="custom-control-label" for="httt-3">Ship COD</label>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3>Thông tin sản phẩm</h3>
                        <?php $totalMoney=0;?>
                        <?php
                $list_content = Cart::contentCart();
                ?>
                        <?php if($list_content != null):?>
                        <table class="table table-borderd">
                            <tr>
                                <th class="text-center">Id sản phẩm</th>
                                <th class="text-center" style="width:100px">Hình ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                            </tr>
                            <?php foreach($list_content as $rcart):?>
                            <tr>
                                <td class="text-center"><?php echo $rcart['Id'] ?></td>
                                <td class="text-center">
                                    <img src="public/images/product/<?php echo $rcart['Img'];?>" class="img-fluid"
                                        alt="<?php echo $rcart['Img'];?>">
                                </td>
                                <td class="text-center"><?php echo $rcart['Name'] ?></td>
                                <td class="text-center"><?php echo number_format($rcart['Price']); ?><sup>đ</sup></td>
                                <td class="text-center"><?php echo $rcart['qty'] ?></td>
                                <td class="text-center">
                                    <?php echo number_format($rcart['amount']*$rcart['qty']) ?><sup>đ</sup></td>
                                <?php $totalMoney+=$rcart['amount']*$rcart['qty'];?>
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td colspan="5">
                                    <!-- <a class="btn btn-danger" href="index.php?option=cart&pay_view=all">Xóa tất cả</a> -->
                                    <!-- <button type="submit" class="btn btn-info">Cập nhật</button>-->
                                </td>
                                <td colspan="2" class="text-end">
                                    <?php echo "Tổng tiền: ".number_format($totalMoney);?><sup>đ</sup>
                                </td>
                            </tr>
                        </table>
                        <?php endif;?>
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