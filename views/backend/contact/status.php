<?php

use App\Libraries\MyClass;
use App\Models\Contact;

$id = $_REQUEST["id"];
$row = Contact::find($id);

if ($row != null){
    $row['Status'] = ($row['Status'] == 1) ? 2 : 1;
    $row['UpdatedAt'] = date('Y-m-d H:i:s');
    $row -> save();
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thành công !']);
}
else
{
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
}
header("location:index.php?option=contact");