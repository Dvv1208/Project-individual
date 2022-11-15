<?php

use App\Libraries\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;

$list_content = Cart::contentCart();

switch ($_POST['action']) {
    case 'dathang':
        $user = User::find($_SESSION['user_id']);
        $data = getdate();
        $oder = new Order();
        $oder->Code = $data[0];
        $_SESSION['order_id'] = $oder->Code;
        $oder->User_id = $_SESSION['user_id'];
        $oder->CreatedAt = date('Y-m-d H:i:s');
        $oder->Diachi = ($_POST['Diachi'] ?: $user['Address']);
        $oder->Name = ($_POST['Name'] ?: $user['Fullname']);
        $oder->Phone = ($_POST['Phone'] ?: $user['Phone']);
        $oder->Email = ($_POST['Email'] ?: $user['Email']);
        $oder->Pttt = $_POST['payment'];
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
        switch ($_POST['payment']) {
            case 'Khi nhận hàng':
                header("location:index.php?option=cart-process-detail");
                unset($_SESSION['cart']);
                break;
            case 'Thanh toán bằng VnPay':
                header("location:index.php?option=init_vnpay");
                break;
            case 'Thanh toán bằng Momo':
                header("location:index.php?option=init_payment");
                break;
        }
}
