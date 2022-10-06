<?php 

use App\Models\User;

if(isset($_POST['DANGKY']))
{
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <?php
if(isset($_POST['DANGKY']))
    {
        $data = $_POST['data'];
        $data['Status']=1;
        $data['CreatedAt'] = date('y-m-d H:i:s');
        $data['Password'] = sha1($_POST['password']);
        User::insert($data);
        header("location:index.php?option=customer&login");
    }
    ?>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Đăng Ký</b></a>
            </div>
            <form action="index.php?option=register" method="post" id="form-register">
                <input name="data[Roles]" value="0" type="hidden" />
                <div class="form-group">
                    <label for="name"><b>Họ Tên :</b></label>
                    <input type="text" class="form-input" placeholder="" name="data[FullName]" id=fullname required>
                </div>
                <div class="form-group">
                    <label for="name"><b>Giới tính :</b></label>&nbsp &nbsp
                    <input name="data[Gender]" class="form-check" type="radio" value="1" required/>Nam &nbsp &nbsp
                    <input name="data[Gender]" class="form-check" type="radio" value="0" />Nữ
                </div>
                <div class="form-group">
                    <label for="email"><b>Email :</b></label>
                    <input type="email" class="form-input" placeholder="" name="data[Email]" id=email required>
                </div>
                <div class="form-group">
                    <label for="phone"><b>Phone :</b></label>
                    <input type="text" class="form-input" placeholder="" name="data[Phone]" id=phone required>
                </div>
                <div class="form-group mb-3">
                    <label for="username"><b>Tên đăng nhập :</b></label>
                    <input type="text" class="form-input" placeholder="" name="data[Username]" id=username required>
                </div>
                <div class="form-group mb-3">
                    <label for="name"><b>Mật khẩu :</b></label>
                    <input type="password" class="form-input" placeholder="" name="data[Password]" id=password required>
                </div>
                <div class="row">
                    <div class="col-12 my-3">
                        <button name="DANGKY" type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
                    </div>
                </div>
                <div class="container signin my-3 text-center">
                    <p>Bạn đã có tài khoản?</p>
                    <a href="index.php?option=customer&login">Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
</body>

</html>