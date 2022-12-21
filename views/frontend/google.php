<?php

use App\Libraries\MyClass;
use App\Models\User;
use App\Models\UserImage;
use Google\Service\Blogger\Resource\Users;

require_once("config/google.php");

if (isset($_GET["code"])) {
    $toke = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
} else {
    header("Location: index.php?option=customer&login");
    exit();
}
if (isset($token["error"]) != "invalid_grant") {
    $oAuth = new Google\Service\Oauth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    $users = new User();
    $users->Email = $userData['email'];
    $users->Fullname = $userData['familyName'] . $userData['givenName'];
    $users->Username = $userData['email'];
    $users->Password = "d033e22ae348aeb5660fc2140aec35850c4da997";
    $users->Gender = 0;
    $users->Roles = 0;
    $users->Phone = "0985781353";
    $users->Address = "97 đường số 11, Phường Trường Thọ, Thành phố Thủ Đức, Thành phố Hồ Chí Minh";
    $users->Status = 1;
    $_SESSION['user_id'] = $users->Id;
    $users->save();
    MyClass::set_flash("message", ['msg' => 'Đăng nhập thành công !']);
    header("location:index.php");
}
if ($users->save() == true) {
    $userimg = new UserImage();
    $userimg->User_id = $users->Id;
    $userimg->Avatar = $userData['picture'];
    $userimg->save();
}
