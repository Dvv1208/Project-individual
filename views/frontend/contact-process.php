<?php

use App\Libraries\Myclass;
use App\Models\Contact;

if (isset($_POST['THEM'])) {
    $data = $_POST['data'];
    $data['UserId'] = $_SESSION['user_id'];
    $data['Status'] = 1;
    $data['CreatedAt'] = date('y-m-d H:i:s');
    Contact::insert($data);
    MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Gửi thông tin liên hệ thành công !']);
    header("location:index.php?option=contact");
}
