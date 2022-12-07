<?php

use App\Libraries\MyClass;
use App\Models\User;
use App\Models\UserImage;

if (isset($_POST['save_profile'])) {
    $userimg = new UserImage();
    $user = User::find($_SESSION['user_id']);

    $user->Fullname = $_POST['name'];
    $user->Address = $_POST['address'];
    $user->Phone = $_POST['phone'];
    $user->Email = $_POST['email'];
    $user->save();
    MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Chỉnh sửa thông tin thành công !']);
    header("location:index.php?option=customer&profile");
}
if ($user->save()) {
    $userimg->User_id = $user->Id;

    $target_dir = "public/images/user/";
    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);

    if (file_exists($target_file)) {
        MyClass::set_flash("message", ['type' => 'danger', 'msg' => 'File đã tồn tại !']);
    }
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['png', 'jpg', 'bmp', 'gif'])) {

        $pathFile = $target_dir . time() . $user->Id . '_' . $user->Username . '.' . $imageFileType;
        move_uploaded_file($_FILES["profileImage"]["tmp_name"], $pathFile);

        $userimg->Avatar = time() . $user->Id . '_' . $user->Username . '.' . $imageFileType;
        $userimg->save();
        MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Chỉnh sửa thông tin thành công !']);
        header("location:index.php?option=customer&profile");
    } else {
        MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Chỉnh sửa thông tin thành công !']);
    }
}
