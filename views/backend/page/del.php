<?php

use App\Libraries\MyClass;
use App\Models\Page;

$id = $_REQUEST['id'];
$row = Page::find($id);

if($row != null){
    $row->delete();
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thành công !']);
}
else
{
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
}
header("location:index.php?option=page&cat=trash");
