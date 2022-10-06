<?php 

use App\Libraries\Myclass;
use App\Models\Contact;

if(isset($_POST['THEM']))
{
    $data = $_POST['data'];
    $data['Status']=1;
    $data['CreatedAt'] = date('y-m-d H:i:s');
    Contact::insert($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thêm thành công !']);
    header("location:index.php?option=contact");
}

?>