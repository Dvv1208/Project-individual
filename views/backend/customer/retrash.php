<?php
use App\models\Customer;
use App\Libraries\MyClass;
$id=$_REQUEST['id'];
$row=Customer::find($id);
if($row!=null){
    $row->Status=2;
    $row->UpdatedAt=date('Y-m-d H:i:s');
    $row->UpdatedBy=(isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
$row->save();
MyClass::set_flash('message',array('type'=>'success','msg'=>'Khôi phục thành công'));
}
else
{
    MyClass::set_flash('message',array('type'=>'danger','msg'=>'Khôi phục thất bại'));
}
header("location:index.php?option=customer");