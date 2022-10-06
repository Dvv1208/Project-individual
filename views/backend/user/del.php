<?php
use App\models\User;
use App\Libraries\MyClass;
$id=$_REQUEST['id'];
$row=User::find($id);
if($row!=null){
$row->delete();
MyClass::set_flash('message',array('type'=>'success','msg'=>'Xóa thành công'));
}
else
{
    MyClass::set_flash('message',array('type'=>'danger','msg'=>'Xóa thất bại'));
}
header("location:index.php?option=user&cat=trash");