<?php
use App\models\User;
use App\Libraries\MyClass;
$id=$_REQUEST['id'];
$row=User::find($id);
if($row!=null){
    $row->Status=0;
    $row->UpdatedAt=date('Y-m-d H:i:s');
    $row->UpdatedBy=(isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
$row->save();
MyClass::set_flash('message',array('type'=>'success','msg'=>'Xóa thành công'));
}
else
{
    MyClass::set_flash('message',array('type'=>'danger','msg'=>'Xóa Thất bại'));
}
header("location:index.php?option=user");