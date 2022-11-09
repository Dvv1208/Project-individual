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
    $oder->User_id = $_SESSION['user_id'];
    $oder->CreatedAt = date('Y-m-d H:i:s');
    $oder->Diachi = (isset($_POST['Diachi']) ? $_POST['Diachi'] : $user['Address']);
    $oder->Name = (isset($_POST['Name']) ? $_POST['Name'] : $user['Fullname']);
    $oder->Phone = (isset($_POST['Phone']) ? $_POST['Phone'] : $user['Phone']);
    $oder->Email = (isset($_POST['Email']) ? $_POST['Email'] : $user['Email']);
    $oder->Status = 1;
    if ($oder->save()) {
        $carts = $list_content;
        foreach ($carts as $cart) {
            $orderdetail = new Orderdetail();
            $orderdetail->Orderid = $oder->Code;
            $orderdetail->Productid = $cart['Id'];
            $orderdetail->Price = $cart['Price'];
            $orderdetail->Quantity = $cart['qty'];
            $orderdetail->Amount = $cart['amount'];
            $orderdetail->save();
        }
    }
    unset($_SESSION['cart']);
    header("location:index.php?option=cart-process-detail");
}

header('Content-type: text/html; charset=utf-8');


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
$amount = $orderdetail->Amount;
$orderId = time() . "";
$redirectUrl = "http://localhost/JavaScript/php/index.php?option=cart-pay_view";
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
$jsonResult = json_decode($result, true);  // decode json

//Just a example, please check more in there

header('Location: ' . $jsonResult['payUrl']);
?>