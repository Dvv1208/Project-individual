<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;

$title = 'Thông tin của tôi';

$username = User::find($_SESSION['user_id']);
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <div class="container">
        <div class="card-header">
            <h2>Thông tin của bạn</h2>
        </div>
        <div class="container border py-3 my-3">
            <div class="col-md-auto">
                <label><b>Họ tên</b></label><br> <?php echo $username->Fullname; ?>
            </div>
            <div class="col-md-auto">
                <label><b>Địa chỉ</b></label><br> <?php echo $username->Address; ?>
            </div>
            <div class="col-md-auto">
                <label><b>Số điện thoại</b></label><br> <?php echo  $username->Phone; ?>
            </div>
            <div class="col-md-auto">
                <label><b>Email</b></label><br> <?php echo  $username->Email; ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="col-md-9">
                <h3>Lịch sử đơn hàng</h3>
                <?php if ($orders != null) : ?>
                    <table class="table table-borderd">
                        <tr>
                            <th class="text-center">Mã đơn hàng</th>
                            <th class="text-center">Thành tiền</th>
                            <th class="text-center">Phương thức thanh toán</th>
                            <th class="text-center">Trạng thái đơn hàng</th>
                            <th class="text-center"></th>
                        </tr>

                        <?php foreach ($orders as $order) : ?>
                            <?php
                            $totalMoney = 0;
                            foreach ($order->products as $product) {
                                $totalMoney += $product->pivot->Amount;
                            }
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $order->Code; ?></td>
                                <td class="text-center">
                                    <?php echo number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>"; ?>
                                </td>
                                <td class="text-center"><?php echo $order->Pttt; ?></td>
                                <td class="text-center">
                                    <?php
                                    if (($order->OrderStatus) == "1") {
                                        echo ("Chờ xác nhận");
                                    } elseif (($order->OrderStatus) == "0") {
                                        echo ("Đã hủy");
                                    } else {
                                        echo ("Đang giao hàng");
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <!-- <?php if (($order->OrderStatus) == "0") : ?>
                                        <input type="hidden" name="action" value="huydonhang">
                                        <a href="index.php?option=customer&profile=status&id=<?php echo $order->Id; ?>" title="Trạng thái đơn hàng" class="btn btn-sm btn-danger">Khôi phục đơn hàng</a>
                                        </input>
                                    <?php endif; ?> -->
                                    <?php if (($order->OrderStatus) == "1") : ?>
                                        <input type="hidden" name="action" value="huydonhang">
                                        <a href="index.php?option=customer&profile=status&id=<?php echo $order->Id; ?>" title="Trạng thái đơn hàng" class="btn btn-sm btn-danger">Hủy đơn hàng</a>
                                        </input>
                                        <?php if (($order->OrderStatus) == "2") : ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else : ?>
                    Bạn chưa có đơn hàng nào
                <?php endif; ?>
            </div>
        </div>
        
        <hr class="mb-4">
        <div class="col-md-4 order-md-2 mb-4">
            <a class="btn btn-info" href="index.php">Quay về trang chủ</a>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>