<?php 

use App\Libraries\Myclass;
use App\Models\Order;

if(isset($_POST['DATHANG']))
{
    $data = $_POST['data'];
    $data['Status']=1;
    $data['CreatedAt'] = date('y-m-d H:i:s');
    Order::insert($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thêm thành công !']);
    header("location:index.php?option=cart-process-detail");
}

?>