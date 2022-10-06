<?php 

use App\Libraries\Myclass;
use App\Models\Contact;

if(isset($_POST['CAPNHAT']))
{
    $id = $_POST['id'];
    $data = $_POST['data'];
    $data['Status'] = 2;
    $data['UpdatedAt'] = date('y-m-d H:i:s');
    $data['UpdatedBy'] =(isset($_SESSION['useradmin']))?$_SESSION['userid']:1; 
    Contact::where('Id', '=',$id)->update($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Sửa thành công !']);
    header("location:index.php?option=contact");
}

?>