<?php

use App\Models\Huyen;
use App\Models\Tinh;
use App\Models\User;
use App\Models\Xa;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký thành viên</title>
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="js/jtoast.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <?php
    if (isset($_POST['DANGKY'])) {
        $user = new User();
        $tinh = Tinh::where('matp', '=', $_POST['tinh'])->get();
        $huyen = Huyen::where('maqh', '=', $_POST['huyen'])->get();
        $xa = Xa::where('xaid', '=', $_POST['xa'])->get();
        $user->Fullname = $_POST['Fullname'];
        $user->Username = $_POST['Username'];
        $user->Email = $_POST['Email'];
        $user->Password = sha1($_POST['Password']);
        $user->Gender = $_POST['Gender'];
        $user->Phone = $_POST['Phone'];
        $user->Roles = $_POST['Roles'];
        foreach ($tinh as $t) {
            $tinhname = $t->name;
        }
        foreach ($huyen as $h) {
            $huyenname = $h->name;
        }
        foreach ($xa as $x) {
            $xaname = $x->name;
        }
        $h = $_POST['huyen'];
        $x = $_POST['xa'];
        $diachi = $_POST['diachi'];
        $row_address = $diachi . ", " . $xaname . ", " . $huyenname . ", " . $tinhname;
        $user->Address = $row_address;
        $user->CreatedAt = date('Y-m-d H:i:s');
        $user->Status = 1;
        $user->save();
        header("location:index.php?option=customer&login");
    }
    ?>
    <div class="card-header text-center my-3">
        <a class="h1"><b>Đăng Ký</b></a>
    </div>
    <form class="col-6 m-auto border border-primary p-2 row" action="" method="post">
        <div class="col-12 mb-3">
            <label for="name">Họ và tên</label>
            <div class="input-group">
                <input name="Fullname" id=fullname type="text" required class="form-control" placeholder="Nhập họ và tên của bạn">
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="name">Tên đăng nhập</label>
            <div class="input-group">
                <input name="Username" id=username type="text" required class="form-control" placeholder="Tên đăng nhập">
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="name">Email</label>
            <div class="input-group">
                <input name="Email" id=email type="email" required class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="name">Mật khẩu</label>
            <div class="input-group">
                <input name="Password" type="password" id=password required class="form-control" placeholder="Mật Khẩu">
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="name">Giới tính</label>&nbsp &nbsp
            <div class="input-group text-center ">
                <input name="Gender" class="form-check form-check-inline" type="radio" value="1" required />Nam &nbsp &nbsp
                <input name="Gender" class="form-check form-check-inline" type="radio" value="0" />Nữ
            </div>
        </div>
        <div class="col-12 mb-3">
            <label for="name">Số điện thoại</label>
            <div class="input-group">
                <input name="Phone" id=phone required class="form-control" placeholder="Số điện thoại">
            </div>
        </div>
        <input name="Roles" value="0" type="hidden" />
        <table name="address">
            <div class="col-6 mb-3">
                <label>Tỉnh/ Thành phố</label>
                <select id="tinh" name="tinh" class="form-control">
                    <option value=""> Chọn Tỉnh/ Thành phố</option>
                </select>
            </div>
            <div class="col-6 mb-3">
                <label>Quận/ Huyện</label>
                <select id="huyen" name="huyen" class="form-control">
                    <option value=""> Chọn Quận/ Huyện</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label>Phường/ Xã</label>
                <select id="xa" name="xa" class="form-control">
                    <option value=""> Chọn Phường/ Xã</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label>Địa chỉ</label>
                <input type="text" name="diachi" required class="form-control" placeholder="Địa chỉ">
            </div>
        </table>
        <div class="col-12 text-center">
            <button name="DANGKY" type="submit" class="btn btn-primary btn-block">Đăng Ký</button>
        </div>
        <div class="container signin my-3 text-center">
            <p>Bạn đã có tài khoản?</p>
            <a href="index.php?option=customer&login">Đăng nhập</a>
        </div>
    </form>
    <!-- script lấy tỉnh -->
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "http://localhost/JavaScript/php/index.php?option=tinh",
                dataType: 'json',
                success: function(data) {
                    $("#tinh").html("");
                    for (i = 0; i < data.length; i++) {
                        var tinh = data[i];
                        var str = ` 
                    <option value="${tinh['matp']}">${tinh['name']} 
                    </option>`;
                        $("#tinh").append(str);
                    }
                    $("#tinh").on("change", function(e) {
                        layHuyen();
                    });
                }
            });
        })
    </script>
    <!-- script lấy huyện trong tỉnh -->
    <script>
        function layHuyen() {
            var matp = $("#tinh").val();
            $.ajax({
                url: "http://localhost/JavaScript/php/index.php?option=huyen&matp=" + matp,
                dataType: 'json',
                success: function(data) {
                    $("#huyen").html("");
                    for (i = 0; i < data.length; i++) {
                        var huyen = data[i];
                        var str = ` 
                    <option value="${huyen['maqh']}">${huyen['name']} 
                    </option>`;
                        $("#huyen").append(str);
                    }
                    $("#huyen").on("change", function(e) {
                        layXa();
                    });
                }
            });
        }
    </script>
    <!-- script lấy xã trong huyện -->
    <script>
        function layXa() {
            var maqh = $("#huyen").val();
            $.ajax({
                url: "http://localhost/JavaScript/php/index.php?option=xa&maqh=" + maqh,
                dataType: 'json',
                success: function(data) {
                    $("#xa").html("");
                    for (i = 0; i < data.length; i++) {
                        var xa = data[i];
                        var str = ` 
                    <option value="${xa['xaid']}">${xa['name']} 
                    </option>`;
                        $("#xa").append(str);
                    }
                }
            });
        }
    </script>
    </div>
    <script src="public/plugins/jquery/jquery.min.js"></script>
    <script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/dist/js/adminlte.min.js"></script>
</body>

</html>