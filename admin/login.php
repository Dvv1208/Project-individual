<?php
session_start();
require_once("../vendor/autoload.php");
require_once("../config/database.php");

use App\Models\User;

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <?php
    if(isset($_POST['DANGNHAP']))
    {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        if (filter_var($username, FILTER_VALIDATE_EMAIL))
        {
            $args = [
                ['Status','=','1'],
                ['Email','=',$username],
                ['Roles','=','1']
            ];
        }
        else
        {
            $args = [
                ['Status','=','1'],
                ['Username','=',$username],
                ['Roles','=','0']
            ];
        }
        $user = User::first();
        //Bẫy lỗi
        $error='';
        if($user == null)
        {
            $error='<div class="text-danger">Tên đăng nhập không tồn tại !</div>';
        }
        else
        {
            if($password==$user['Password'])
            {
                $_SESSION['useradmin']=$username;
                $_SESSION['userid']=$user['Id'];
                header("location:index.php");
            }
            else
            {
                $error='<div class="text-danger">Mật khẩu không chính xác !</div>';
            } 
        } 
    }
    ?>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Đăng Nhập</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Thông tin đăng nhập</p>

                <form action="" name="from1" method="post">
                    <div class="input-group mb-3">
                        <input name="username" type="text" required class="form-control"
                            placeholder="Tên Đăng Nhập hoặc Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" type="password" required class="form-control" placeholder="Mật Khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button name="DANGNHAP" type="submit" class="btn btn-primary btn-block">Đăng Nhập</button>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(isset($error)): ?>
                        <div class="col-12">
                            <?= $error; ?>
                        </div>
                        <?php endif;?>
                    </div>
                </form>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../public/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../public/dist/js/adminlte.min.js"></script>
</body>

</html>