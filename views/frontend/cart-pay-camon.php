<?php

use App\Libraries\MyClass;
use App\Models\Momo;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\VnPay;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/PHPMailer/phpmailer/src/Exception.php';
require 'vendor/PHPMailer/phpmailer/src/PHPMailer.php';
require 'vendor/PHPMailer/phpmailer/src/SMTP.php';

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
        $orders = Order::where([['User_id', '=', $_SESSION['user_id']], ['Code', '=', $momo->orderId]])->with('products')->get();
        foreach ($orders as $order) {
            if (($order->Pttt) == "Thanh toán bằng Momo") {
                $statuspay = "Đã thanh toán";
            }
            $mail = new PHPMailer;
            $mail->setLanguage("vi");
            try {
                $mail->SMTPSecure = 0;
                $mail->isSMTP();
                $mail->Encoding = 'base64';
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username   = 'vovanduong258@gmail.com';
                $mail->Password   = 'kqmcjauglcwyoauj';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->setFrom('vovanduong258@gmail.com', 'Võ Văn Dương');
                $mail->addAddress($order->Email, $order->Name);
                $mail->isHTML(true);
                $mail->Subject = "Shop đã tiếp nhận đơn hàng $order->Code của bạn";
                $mail->Body .= "Dear " . $order->Name . "," . "\n"
                    . "<br><br> Cảm ơn bạn đã mua sắm tại cửa hàng." . "\n\n"
                    . "<br><br> Địa chỉ: " . $order->Diachi . "\n\n"
                    . "<br> Số điện thoại: " . $order->Phone . "\n\n"
                    . "<br> Hình thức thanh toán: " . $order->Pttt . "\n\n"
                    . "<br> Trạng thái thanh toán: " . $statuspay . "\n\n"
                    . "<br><br> Thông tin sản phẩm: " . "\n\n";
                foreach ($order->products as $key => $pro) {
                    $qty += $pro->pivot->Quantity;
                    $totalMoney += $pro->pivot->Amount;
                    $mail->addEmbeddedImage("public/images/product/$pro->Img", 'images_base64');
                    $mail->Body .= "<br>
                        <html>
                            <body>
                                <table>" .
                        "<tr class='text-center'>" .
                        "<th rowspan='4' style='width:100px'>" . "<img src='cid:images_base64' style='width:100px' alt='$pro->Img'>" . "</th>" .
                        "<td class='text-center'>$pro->Name</td>" .
                        "</tr>";

                    $mail->Body .=
                        "<tr>" .
                        "<td class='text-center'>" . "Mã đơn hàng: " . "$order->Code</td>" .
                        "</tr>" .
                        "<tr>" .
                        "<td class='text-center'>" . "Số lượng: " . "$qty</td>" .
                        "</tr>" .
                        "<tr>" .
                        "<td class='text-center'>" . "Thành tiền: " . number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>" . "</td>" .
                        "</tr>" .
                        "</table>
                            </body>
                        </html>";
                }
                $mail->Body .= "<br> Chúng tôi sẽ gửi thông báo sau cho bạn. " . "\n\n"
                    . "<br><br>Cảm ơn &Trân trọng," . "\n" . "<br><br>Admin"
                    . "<br>Tell: 0985781353" . "<br>Email: vovanduong258@gmail.com";

                $mail->smtpConnect(array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
                echo 'Đã gửi mail thành công';
            } catch (Exception $e) {
                echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
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
        $orders = Order::where([['User_id', '=', $_SESSION['user_id']], ['Code', '=', $vnpay->vnp_TxnRef]])->with('products')->get();
        foreach ($orders as $order) {
            if (($order->Pttt) == "Thanh toán bằng VnPay") {
                $statuspay = "Đã thanh toán";
            }
            $mail = new PHPMailer;
            $mail->setLanguage("vi");
            try {
                $mail->SMTPSecure = 0;
                $mail->isSMTP();
                $mail->Encoding = 'base64';
                $mail->CharSet  = "utf-8";
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username   = 'vovanduong258@gmail.com';
                $mail->Password   = 'kqmcjauglcwyoauj';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
                $mail->setFrom('vovanduong258@gmail.com', 'Võ Văn Dương');
                $mail->addAddress($order->Email, $order->Name);
                $mail->isHTML(true);
                $mail->Subject = "Shop đã tiếp nhận đơn hàng $order->Code của bạn";
                $mail->Body .= "Dear " . $order->Name . "," . "\n"
                    . "<br><br> Cảm ơn bạn đã mua sắm tại cửa hàng." . "\n\n"
                    . "<br><br> Địa chỉ: " . $order->Diachi . "\n\n"
                    . "<br> Số điện thoại: " . $order->Phone . "\n\n"
                    . "<br> Hình thức thanh toán: " . $order->Pttt . "\n\n"
                    . "<br> Trạng thái thanh toán: " . $statuspay . "\n\n"
                    . "<br><br> Thông tin sản phẩm: " . "\n\n";
                foreach ($order->products as $key => $pro) {
                    $qty += $pro->pivot->Quantity;
                    $totalMoney += $pro->pivot->Amount;
                    $mail->addEmbeddedImage("public/images/product/$pro->Img", 'images_base64');
                    $mail->Body .= "<br>
                        <html>
                            <body>
                                <table>" .
                        "<tr class='text-center'>" .
                        "<th rowspan='4' style='width:100px'>" . "<img src='cid:images_base64' style='width:100px' alt='$pro->Img'>" . "</th>" .
                        "<td class='text-center'>$pro->Name</td>" .
                        "</tr>";

                    $mail->Body .=
                        "<tr>" .
                        "<td class='text-center'>" . "Mã đơn hàng: " . "$order->Code</td>" .
                        "</tr>" .
                        "<tr>" .
                        "<td class='text-center'>" . "Số lượng: " . "$qty</td>" .
                        "</tr>" .
                        "<tr>" .
                        "<td class='text-center'>" . "Thành tiền: " . number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>" . "</td>" .
                        "</tr>" .
                        "</table>
                            </body>
                        </html>";
                }
                $mail->Body .= "<br> Chúng tôi sẽ gửi thông báo sau cho bạn. " . "\n\n"
                    . "<br><br>Cảm ơn &Trân trọng," . "\n" . "<br><br>Admin"
                    . "<br>Tell: 0985781353" . "<br>Email: vovanduong258@gmail.com";

                $mail->smtpConnect(array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                ));
                $mail->send();
                echo 'Đã gửi mail thành công';
            } catch (Exception $e) {
                echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
            }
        }
        header('Location:index.php?option=cart-process-detail');
        unset($_SESSION['cart']);
    } else {
        MyClass::set_flash("message", ['msg' => 'Thanh toán bằng VnPay thất bại !']);
    }
}
