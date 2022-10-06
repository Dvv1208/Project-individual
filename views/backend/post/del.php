<?php

use App\Libraries\MyClass;
use App\Models\Post;

$id = $_REQUEST['id'];
$row = Post::find($id);

if($row != null){
    $row->delete();
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thành công !']);
}
else
{
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
}
header("location:index.php?option=post&cat=trash");
