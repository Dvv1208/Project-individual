<?php 

use App\Libraries\Myclass;
use App\Models\Category;

if(isset($_POST['THEM']))
{
    $data = $_POST['data'];
    $data['Parentid'] = $_POST['parentid'];
    $data['Orders'] = $_POST['orders'] + 1;
    $data['Status'] = $_POST['status'];
    $data['CreatedAt'] = date('y-m-d H:i:s');
    $data['CreatedBy'] =(isset($_SESSION['useradmin']))?$_SESSION['userid']:1; 
    $data['Slug'] = Myclass::str_slug($data['Name']);
    Category::insert($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thêm thành công !']);
    header("location:index.php?option=category");
}
if(isset($_POST['CAPNHAT']))
{
    $id = $_POST['id'];
    $data = $_POST['data'];
    $data['Parentid'] = $_POST['parentid'];
    $data['Orders'] = $_POST['orders'] + 1;
    $data['Status'] = $_POST['status'];
    $data['UpdatedAt'] = date('y-m-d H:i:s');
    $data['UpdatedBy'] =(isset($_SESSION['useradmin']))?$_SESSION['userid']:1; 
    $data['Slug'] = Myclass::str_slug($data['Name']);
    Category::where('Id', '=',$id)->update($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Sửa thành công !']);
    header("location:index.php?option=category");
}

?>