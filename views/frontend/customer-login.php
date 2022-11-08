<?php require_once('views/frontend/header.php'); ?>
<?php

use App\Models\User;
use App\Libraries\MyClass;

?>

<?php
if (isset($_POST['DANGNHAP'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    $message_alert = "";
    $args = null;
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $args = [
            ['Email', '=', $username],
            ['Password', '=', $password],
            ['Roles', '=', '1']
        ];
    } else {
        $args = [
            ['Username', '=', $username],
            ['Password', '=', $password],
            ['Roles', '=', '1']
        ];
    }
    $user = User::where($args)->first();
    //Bẫy lỗi
    if ($user == null) {
        $message_alert = "Tên đăng nhập không tồn tại";
    } else {
        if ($user != null) {
            $_SESSION['logincustomer'] = $username;
            $_SESSION['user_id'] = $user->Id;
            $message_alert = "Đăng nhập thành công";
        } else {
            $message_alert = "Mật khẩu không chính xác";
        }
    }
}
?>
<section class="maincontent">
    <form action="index.php?option=customer&login" method="post">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <h2>
                            <p class="text-center">Thông tin đăng nhập</p>
                        </h2>

                        <div class="mb-3">
                            <label for="username">Tên đăng nhập</label>
                            <input name="username" type="text" required class="form-control" placeholder="Tên Đăng Nhập hoặc Email">
                        </div>
                        <div class="mb-3">
                            <label for="password">Mật khẩu</label>
                            <input name="password" type="password" required class="form-control" placeholder="Mật Khẩu">
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <button name="DANGNHAP" type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                            </div>

                        </div>
                    <?php endif; ?>
                    <?php if (isset($message_alert)) : ?>
                        <div class="col-12">
                            <div class="alert alert-info">
                                <?= $message_alert; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        </div>
    </form>
    <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    </div>
</section>
<!-- /.login-box -->
<?php require_once('views/frontend/footer.php'); ?>

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.min.js"></script>