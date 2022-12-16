<?php
require_once("vendor/autoload.php");

use App\Libraries\Cart;
use App\Libraries\MyClass;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;
use PHPMailer\PHPMailer\PHPMailer;

require 'vendor/PHPMailer/phpmailer/src/Exception.php';
require 'vendor/PHPMailer/phpmailer/src/PHPMailer.php';
require 'vendor/PHPMailer/phpmailer/src/SMTP.php';

$list_content = Cart::contentCart();
date_default_timezone_set('Asia/Ho_Chi_Minh');

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
                    if (($order->Pttt) == "Khi nhận hàng") {
                        $statuspay = "Thanh toán khi nhận hàng";
                    }
                    $mail->Subject = "Shop đã tiếp nhận đơn hàng $order->Code của bạn";
                    $mail->Body .= "Dear " . $order->Name . "," . "\n"
                        . "<br><br> Cảm ơn bạn đã mua sắm tại cửa hàng." . "\n\n"
                        . "<br><br> Địa chỉ: " . $order->Diachi . "\n\n"
                        . "<br> Số điện thoại: " . $order->Phone . "\n\n"
                        . "<br> Hình thức thanh toán: " . $order->Pttt . "\n\n"
                        . "<br> Trạng thái thanh toán: " . $statuspay . "\n\n"
                        . "<br><br> Thông tin sản phẩm: " . "\n\n";
                    foreach ($order->products as $key => $pro) {
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
                            "<td class='text-center'>" . "Số lượng: " . "$orderdetail->Quantity</td>" .
                            "</tr>" .
                            "<tr>" .
                            "<td class='text-center'>" . "Thành tiền: " . number_format($orderdetail->Amount, 0, ',', '.') . "<sup>đ</sup>" . "</td>" .
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

                MyClass::set_flash("message", ['msg' => 'Đặt hàng thành công !']);
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
