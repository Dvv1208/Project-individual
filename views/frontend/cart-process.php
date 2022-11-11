<?php

use App\Libraries\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;

$list_content = Cart::contentCart();

if (isset($_POST['dathang'])) {
    $user = User::find($_SESSION['user_id']);
    $data = getdate();
    $oder = new Order();
    $oder->Code = $data[0];
    $_SESSION['order_id'] = $oder->Code;
    $oder->User_id = $_SESSION['user_id'];
    $oder->CreatedAt = date('Y-m-d H:i:s');
    $oder->Diachi = (isset($_POST['Diachi']) ? $_POST['Diachi'] : $user['Address']);
    $oder->Name = (isset($_POST['Name']) ? $_POST['Name'] : $user['Fullname']);
    $oder->Phone = (isset($_POST['Phone']) ? $_POST['Phone'] : $user['Phone']);
    $oder->Email = (isset($_POST['Email']) ? $_POST['Email'] : $user['Email']);
    $oder->Pttt = (isset($_POST['phuongthuctt']));
    $oder->Status = 1;
    if ($oder->save()) {
        $carts = $list_content;
        foreach ($carts as $cart) {
            $orderdetail = new Orderdetail();
            $orderdetail->Orderid = $oder->Code;
            $orderdetail->Productid = $cart['Id'];
            $orderdetail->Price = $cart['Price'];
            $orderdetail->Quantity = $cart['qty'];
            $orderdetail->Amount = $cart['amount'] * $cart['qty'];
            $orderdetail->save();
        }
    }
    unset($_SESSION['cart']);
    header("location:index.php?option=cart-process-detail");
}
