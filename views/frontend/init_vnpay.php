<?php

use App\Libraries\Cart;
use App\Libraries\MyClass;
use App\Models\Order;

$list_content = Cart::contentCart();
$totalMoney = 0;
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/JavaScript/php/index.php?option=cart-process-detail";
$vnp_TmnCode = "R522YCH8";
$vnp_HashSecret = "YBRDOTAQPJFSLZKTGTMCDNHBWHKIXTUB";
foreach ($orders as $order) {
    $totalMoney = 0;
    foreach ($order->products as $product) {
        $totalMoney += $product->pivot->Amount;
    }
}
$vnp_TxnRef = $product->pivot->Orderid;
$vnp_Amount = $totalMoney;

$vnp_OrderInfo = "Thanh toán đơn hàng bằng VnPay";
$vnp_OrderType = 'billpayment';
$vnp_Locale = 'vn';
$vnp_BankCode = 'NCB';
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount * 100,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef
);
// var_dump($vnp_TxnRef);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}
$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array(
    'code' => '00', 'message' => 'success', 'data' => $vnp_Url
);
header('Location: ' . $vnp_Url);
unset($_SESSION['cart']);
MyClass::set_flash("message", ['msg' => 'Thanh toán thành công !']);
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
