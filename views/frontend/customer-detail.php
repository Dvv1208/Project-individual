<?php

use App\Models\Order;
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();

$id = $_REQUEST["id"];
$row = Order::find($id);

if ($row != 0) {
    $row['OrderStatus'] = ($row['OrderStatus'] == 1) ? 0 : 1;
    $row->save();
}

header("location:index.php?option=customer&profile");