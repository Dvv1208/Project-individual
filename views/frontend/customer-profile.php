<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use App\Libraries\Cart;

$title = 'Thông tin của tôi';

$username = User::find($_SESSION['user_id']);

$list_orderdetail = new Orderdetail();

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
        </div>
        <hr class="mb-4">
        <div class="col-md-4 order-md-2 mb-4">
            <a class="btn btn-info" href="index.php">Quay về trang chủ</a>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>