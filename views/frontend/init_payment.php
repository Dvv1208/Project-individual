<?php

use App\Libraries\Cart;
use App\Libraries\MyClass;
use App\Models\Order;

$list_content = Cart::contentCart();
$totalMoney = 0;
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->get();

header('Content-type: text/html; charset=utf-8');
// header("content-type: application/json; charset=UTF-8");
http_response_code(200);
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán qua mã QR MoMo";
foreach ($orders as $order) {
    $totalMoney = 0;
    foreach ($order->products as $product) {
        $totalMoney += $product->pivot->Amount;
    }
}
$amount = $totalMoney;
$orderId = time() . "";
$redirectUrl = "http://localhost/JavaScript/php/index.php?option=cart-pay-camon";
$ipnUrl = "http://localhost/JavaScript/php/index.php?option=cart-pay_view";
$extraData = "";

$requestId = time() . "";
$requestType = "captureWallet";
//before sign HMAC SHA256 signature
$rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
$signature = hash_hmac("sha256", $rawHash, $secretKey);
$data = array(
    'partnerCode' => $partnerCode,
    'partnerName' => "Test",
    "storeId" => "MomoTestStore",
    'requestId' => $requestId,
    'amount' => $amount,
    'orderId' => $orderId,
    'orderInfo' => $orderInfo,
    'redirectUrl' => $redirectUrl,
    'ipnUrl' => $ipnUrl,
    'lang' => 'vi',
    'extraData' => $extraData,
    'requestType' => $requestType,
    'signature' => $signature
);
$result = execPostRequest($endpoint, json_encode($data));
$jsonResult = json_decode($result, true);
header('Location: ' . $jsonResult['payUrl']);
