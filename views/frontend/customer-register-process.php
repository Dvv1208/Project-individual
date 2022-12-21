<?php

use App\Libraries\MyClass;
use App\Models\Huyen;
use App\Models\Tinh;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Xa;

date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<?php
if (isset($_POST['DANGKY'])) {
    $user = new User();
    $tinh = Tinh::where('matp', '=', $_POST['tinh'])->get();
    $huyen = Huyen::where('maqh', '=', $_POST['huyen'])->get();
    $xa = Xa::where('xaid', '=', $_POST['xa'])->get();
    $user->Fullname = $_POST['Fullname'];
    $user->Username = $_POST['Username'];
    $emailErr = "Email không đúng định dạng";
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

    if ($user->save()) {
        $target_dir = "public/images/user/";
        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (in_array($imageFileType, ['png', 'jpg', 'bmp', 'gif'])) {
            $pathFile = $target_dir . $user->Id . '_' . $user->Username . '.' . $imageFileType;
            move_uploaded_file($_FILES["profileImage"]["tmp_name"], $pathFile);
            $userimg = new UserImage();
            $userimg->Avatar = $user->Id . '_' . $user->Username . '.' . $imageFileType;
            $userimg->User_id = $user->Id;
            $userimg->save();
        }
    }
    MyClass::set_flash("message", ['msg' => 'Đăng ký thành công! Mời bạn đăng nhập']);
    header("location:index.php");
}
?>