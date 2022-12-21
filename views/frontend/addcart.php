<?php

use App\Libraries\Heart;
use App\Models\Product;
use App\Libraries\Cart;
use App\Libraries\MyClass;

date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_REQUEST['addcartFromdetail'])) {
    $cart = new Cart();
    $qty = $_POST['qty'];
    $id = $_POST['proid'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();
    $slug = $row_product['Slug'];
    $r_cart = array(
        'Id' => $id,
        'Img' => $row_product['Img'],
        'Name' => $row_product['Name'],
        'Price' => $row_product['Pricesale'],
        'qty' => $qty,
        'amount' => $row_product['Pricesale'] * $qty,
    );
    $cart->addToCart($r_cart);
    MyClass::set_flash("message", ['msg' => 'Thêm vào giỏ hàng thành công !']);
    header("location:index.php?option=product&id={$slug}");
    exit;
}
if (isset($_REQUEST['addheartFromdetail'])) {
    $qty = $_POST['qty'];
    $id = $_POST['proid'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();
    $slug = $row_product['Slug'];
    $row_heart = array(
        'Id' => $id,
        'Img' => $row_product['Img'],
        'Name' => $row_product['Name'],
        'Price' => $row_product['Pricesale'],
        'qty' => $qty,
        'amount' => $row_product['Pricesale'] * $qty,
    );
    Heart::addHeart($row_heart);
    MyClass::set_flash("message", ['msg' => 'Thêm vào danh sách yêu thích thành công !']);
    header("location:index.php?option=product&id={$slug}");
    exit;
}
