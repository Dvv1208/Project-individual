<?php
use App\Models\Customer;
use App\Libraries\MyClass;
if(isset($_POST['Thêm']))
{
    $data=$_POST['data'];
    $data['Gender'] = $_POST['gender'];
    $data['Status'] = $_POST['status'];
    $data['CreatedAt'] = date('Y-m-d H:i:s');
    $data['CreatedBy'] = (isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    Customer::insert($data);
    MyClass::set_flash('message',array('type'=>'success','msg'=>'Thêm thành công'));
    header("location:index.php?option=customer");
}
if(isset($_POST['CAPNHAT']))
{
    $id=$_POST['id'];
    $data=$_POST['data'];
    $data['Gender'] = $_POST['gender'];
    $data['Status'] = $_POST['status'];
    $data['UpdatedAt'] = date('Y-m-d H:i:s');
    $data['UpdatedBy'] = (isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    $id=$_POST['id'];
    Customer::where('Id','=',$id)->update($data);
    MyClass::set_flash('message',array('type'=>'success','msg'=>'Sửa thành công'));
    header("location:index.php?option=customer");
}