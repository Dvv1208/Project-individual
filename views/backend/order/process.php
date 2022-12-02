<?php

use App\Libraries\Myclass;
use App\Models\Order;

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['code'];
    $data = $_POST['data'];
    $data['OrderStatus'] = $_POST['orderstatus'];
    Order::where('Code', '=', $id)->update($data);
    MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Sửa đơn hàng thành công !']);
    header("location:index.php?option=order");
}
