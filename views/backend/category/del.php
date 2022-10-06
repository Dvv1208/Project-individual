<?php

use App\Libraries\MyClass;
use App\Models\Category;

$id = $_REQUEST['id'];
$row = Category::find($id);

if($row != null){
    $row->delete();
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thành công !']);
}
else
{
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
}
header("location:index.php?option=category&cat=trash");
