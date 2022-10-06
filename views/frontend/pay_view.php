<?php 
use App\Models\Order;

$title = 'Thanh toán';

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="clearfix main mt-2">
    <form name="forml" action="index.php?option=cart-process" method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4 text-center py-5">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Thanh toán</h2>
                    <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin trước khi Đặt hàng.</p>
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
                    <hr class="mb-4">
                    <div class="col-md-4 order-md-2 mb-4">
                        <button name="DATHANG" type="submit" class="btn btn-sm btn-primary">Đặt hàng
                        </button>
                        <a class="btn btn-info" href="index.php?option=cart">Quay về Giỏ Hàng</a>
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