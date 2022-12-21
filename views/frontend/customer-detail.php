<?php

use App\Models\Order;
use App\Models\CancelOrder;

date_default_timezone_set('Asia/Ho_Chi_Minh');
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();

$id = $_POST["order_id"];
$row = Order::find($id);

if ($row != 0) {
    $cancel = new CancelOrder;
    $row['OrderStatus'] = ($row['OrderStatus'] == 1) ? 0 : 1;
    if ($row->save()) {
        $order_code = $_POST["order_code"];
        $cancel->Order_id = $order_code;
        $cancel->Reason = $_POST["user_reason"];
        $cancel->save();
    }
    header("location:index.php?option=customer&profile");
}
