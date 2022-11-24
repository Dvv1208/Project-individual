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
        $order = new Order();
        $order->Code = $data[0];
        $_SESSION['order_id'] = $order->Code;
        $order->User_id = $_SESSION['user_id'];
        $order->CreatedAt = date('Y-m-d H:i:s');
        $order->Diachi = ($_POST['Diachi'] ?: $user['Address']);
        $order->Name = ($_POST['Name'] ?: $user['Fullname']);
        $order->Phone = ($_POST['Phone'] ?: $user['Phone']);
        $order->Email = ($_POST['Email'] ?: $user['Email']);
        $order->Pttt = $_POST['payment'];
        $order->OrderStatus = $_POST['OrderStatus'];
        // $order->Status = 1;
        if ($order->save()) {
            $carts = $list_content;
            foreach ($carts as $cart) {
                $orderdetail = new Orderdetail();
                $orderdetail->Orderid = $order->Code;
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
        $to = $order->Email;
        $name = $order->Name;
        $address = $order->Diachi;
        $phone = $order->Phone;
        $pay = $order->Pttt;
        $subject = 'Shop đã tiếp nhận đơn hàng' . "\r" . $order->Code;
        $from = 'Admin';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $headers .= 'From: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $message = '<html><body>';
        $message .= "Dear " . $name . "," . "\n"
            . "<br><br> Cảm ơn bạn đã mua sắm tại cửa hàng." . "\n\n"
            . "<br><br> Địa chỉ: " . $address . "\n\n"
            . "<br> Số điện thoại: " . $phone . "\n\n"
            . "<br> Hình thức thanh toán: " . $pay . "\n\n"
            . "<br><br> Thông tin sản phẩm: " . "\n\n";
        foreach ($order->products as $key => $pro) {
            $path = "C:/JavaScript/php/public/images/product/$pro->Img";
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // $message .= "<br>" . "Base" . $base64;
            $message .= "<br>
                        <html>
                            <body>
                                <table>" .
                "<tr class='text-center'>" .
                "<th rowspan='4' style='width:100px'>" . "<img src='$base64' style='width:100px' alt='$pro->Img'>" . "</th>" .
                "<td class='text-center'>$pro->Name</td>" .
                "</tr>";

            $message .=
                "<tr>" .
                "<td class='text-center'>" . "Mã đơn hàng: " . "$order->Code</td>" .
                "</tr>" .
                "<tr>" .
                "<td class='text-center'>" . "Số lượng: " . "$orderdetail->Quantity</td>" .
                "</tr>" .
                "<tr>" .
                "<td class='text-center'>" . "Thành tiền: " . "$orderdetail->Amount<sup>đ</sup>" . "</td>" .
                "</tr>" .
                "</table>
                            </body>
                        </html>";
        }
        $message .= "<br> Chúng tôi sẽ gửi thông báo sau cho bạn. " . "\n\n"
            . "<br><br>Cảm ơn &Trân trọng," . "\n" . "<br><br>Admin"
            . "<br>Tell: 0985781353" . "<br>Email: vovanduong175@gmail.com";

        if (mail($to, $subject, $message, $headers)) {
            echo 'Your mail has been sent successfully.';
        } else {
            echo 'Unable to send email. Please try again.';
        }
}
