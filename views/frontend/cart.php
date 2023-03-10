<?php

use App\Models\Product;
use App\Libraries\Cart;
use App\Libraries\MyClass;
use Illuminate\Support\Arr;

$product = Product::where([['Status', '=', '1']])->orderBy('CreatedAt', 'desc')->get();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$cart = new Cart();
$page = "view";

if (isset($_REQUEST['addcart'])) {
    $qty = 1;
    $id = $_REQUEST['addcart'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();

    $row_cart = array(
        'Id' => $id,
        'Img' => $row_product['Img'],
        'Name' => $row_product['Name'],
        'Price' => $row_product['Pricesale'],
        'qty' => $qty,
        'amount' => $row_product['Price'] * $qty,
    );
    Cart::addCart($row_cart);
    MyClass::set_flash("message", ['msg' => 'Thêm vào giỏ hàng thành công !']);
    header("location:index.php");
    exit;
}
if (isset($_REQUEST['delcart'])) {

    $id = $_REQUEST['delcart'];
    if ($id == 'all') {
        unset($_SESSION['cart']);
    } else {
        Cart::removeCart($id);
        MyClass::set_flash("message", ['msg' => 'Xóa sản phẩm khỏi giỏ hàng thành công!']);
    }
    MyClass::set_flash("message", ['msg' => 'Xóa sản phẩm khỏi giỏ hàng thành công!']);
    header("location:index.php?option=cart");
    exit;
}
if (isset($_POST['updateCart'])) {
    $arr_qty = $_POST['qty'];
    foreach ($arr_qty as $id => $number) {
        $cart = $_SESSION['cart'];
        $cart = Cart::updateCart($cart, $id, $number);
        MyClass::set_flash("message", ['msg' => 'Cập nhật giỏ hàng thành công!']);
    }
}
if ($page == "view") {
    $list_content = Cart::contentCart();
    require_once('views/frontend/cart_view.php');
    exit;
}

// if(isset($_REQUEST['process'])){
//     require_once('views/frontend/cart-pay_view.php');
// }else{
//     require_once('views/frontend/cart_view.php');
// }
