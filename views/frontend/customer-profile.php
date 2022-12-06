<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use App\Models\UserImage;

$title = 'Thông tin của tôi';

$username = User::find($_SESSION['user_id']);
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();
$user_id = $username->Id;
$userimg = UserImage::where('User_id', '=', $user_id)->get();

?>

<?php require_once('views/frontend/header.php'); ?>
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
    <div class="container">
        <div class="container bootstrap snippet">
            <div class="card-header">
                <h2>Thông tin của bạn</h2>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="text-center">
                        <?php foreach ($userimg as $img) {
                        } ?>
                        <img style="border-radius: 50%;" src="public/images/user/<?php echo $img->Avatar; ?>" onClick="triggerClick()" id="profileDisplay" class="avatar img-circle img-thumbnail" alt="avatar">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <form class="form" action="##" method="post" id="registrationForm">
                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label><b>Họ tên</b></label><br> 
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="<?php echo $username->Fullname; ?>" title="enter your first name if any.">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label><b>Địa chỉ</b></label><br> 
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="<?php echo $username->Address; ?>" title="enter your last name if any.">
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-xs-6">
                                        <label for="phone">
                                            <label><b>Số điện thoại</b></label><br> 
                                        </label>
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="<?php echo  $username->Phone; ?>" title="enter your phone number if any.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="mobile">
                                            <label><b>Email</b></label><br> 
                                        </label>
                                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="<?php echo  $username->Email; ?>" title="enter your mobile number if any.">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <br>
                                        <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                        <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
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
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
                <div class="text-center">
                    <h2>Ảnh đại diện</h2>
                </div>
                <div class="container py-3 my-3">
                    <form action="index.php?option=customer-profile-saveImage" method="post" enctype="multipart/form-data">
                        <div class="form-group text-center" style="position: relative;">
                            <span class="img-div">
                                <?php foreach ($userimg as $img) {
                                } ?>
                                <img class="col-9" style="border-radius: 50%;" src="public/images/user/<?php echo $img->Avatar; ?>" onClick="triggerClick()" id="profileDisplay">
                            </span>
                            <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button type="submit" name="save_profile" class="btn btn-outline-success btn-block">Lưu</button>
                        </div>
                    </form>
                </div>
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
<script>
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>