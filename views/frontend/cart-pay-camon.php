<?php

use App\Libraries\MyClass;
use App\Models\Momo;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\VnPay;

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_GET['partnerCode'])) {
    $momo = new Momo();
    $momo->partnerCode = $_GET['partnerCode'];
    $momo->orderId = $_GET['orderId'];
    $momo->amount = $_GET['amount'];
    $momo->orderInfo = $_GET['orderInfo'];
    $momo->orderType = $_GET['orderType'];
    $momo->transId = $_GET['transId'];
    $momo->payType = $_GET['payType'];
    if ($momo->save() == true) {
        MyClass::set_flash("message", ['msg' => 'Thanh toán bằng Momo thành công !']);
        $orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();
        foreach ($orders as $order) {
            $to = $order->Email;
            $name = $order->Name;
            $address = $order->Diachi;
            $phone = $order->Phone;
            $pay = $order->Pttt;
            $subject = 'Shop đã tiếp nhận đơn hàng' . "\r" . $order->Code;
            $from = 'Admin';
            $headers = 'MIME-Version: 1.0' . "\r\n";
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
                $totalMoney = 0;
                $totalMoney += $pro->pivot->Amount;
                $qty = $pro->pivot->Quantity;
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
                    "<td class='text-center'>" . "Số lượng: " . "$qty</td>" .
                    "</tr>" .
                    "<tr>" .
                    "<td class='text-center'>" . "Thành tiền: " . "$totalMoney<sup>đ</sup>" . "</td>" .
                    "</tr>" .
                    "</table>
                        </body>
                    </html>";
            }
            $message .= "<br> Chúng tôi sẽ gửi thông báo sau cho bạn. " . "\n\n"
                . "<br><br>Cảm ơn &Trân trọng," . "\n" . "<br><br>Admin"
                . "<br>Tell: 0985781353" . "<br>Email: vovanduong175@gmail.com";

            if (mail($to, $subject, $message, $headers)) {
                echo 'Email của bạn đã được gữi đi thành công.';
            } else {
                echo 'Không thể gữi mail. Vui lòng kiểm tra lại';
            }
        }
        header('Location:index.php?option=cart-process-detail');
        unset($_SESSION['cart']);
    } else {
        MyClass::set_flash("message", ['msg' => 'Thanh toán bằng Momo thất bại !']);
    }
}


if (isset($_GET['vnp_Amount'])) {
    $vnpay = new VnPay();
    $vnpay->vnp_Amount = $_GET['vnp_Amount'];
    $vnpay->vnp_BankCode = $_GET['vnp_BankCode'];
    $vnpay->vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnpay->vnp_CardType = $_GET['vnp_CardType'];
    $vnpay->vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnpay->vnp_PayDate = $_GET['vnp_PayDate'];
    $vnpay->vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnpay->vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $vnpay->vnp_TxnRef = $_GET['vnp_TxnRef'];
    if ($vnpay->save() == true) {
        MyClass::set_flash("message", ['msg' => 'Thanh toán bằng VnPay thành công !']);
        $orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();
        foreach ($orders as $order) {
            $to = $order->Email;
            $name = $order->Name;
            $address = $order->Diachi;
            $phone = $order->Phone;
            $pay = $order->Pttt;
            $subject = 'Shop đã tiếp nhận đơn hàng' . "\r" . $order->Code;
            $from = 'Admin';
            $headers = 'MIME-Version: 1.0' . "\r\n";
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
                $totalMoney = 0;
                $totalMoney += $pro->pivot->Amount;
                $qty = $pro->pivot->Quantity;
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
                    "<td class='text-center'>" . "Số lượng: " . "$qty</td>" .
                    "</tr>" .
                    "<tr>" .
                    "<td class='text-center'>" . "Thành tiền: " . "$totalMoney<sup>đ</sup>" . "</td>" .
                    "</tr>" .
                    "</table>
                        </body>
                    </html>";
            }
            $message .= "<br> Chúng tôi sẽ gửi thông báo sau cho bạn. " . "\n\n"
                . "<br><br>Cảm ơn &Trân trọng," . "\n" . "<br><br>Admin"
                . "<br>Tell: 0985781353" . "<br>Email: vovanduong175@gmail.com";

            if (mail($to, $subject, $message, $headers)) {
                echo 'Email của bạn đã được gữi đi thành công.';
            } else {
                echo 'Không thể gữi mail. Vui lòng kiểm tra lại';
            }
        }
        header('Location:index.php?option=cart-process-detail');
        unset($_SESSION['cart']);
    } else {
        MyClass::set_flash("message", ['msg' => 'Thanh toán bằng VnPay thất bại !']);
    }
}
