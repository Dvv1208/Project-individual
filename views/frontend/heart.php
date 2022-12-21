<?php

use App\Libraries\Cart;
use App\Models\Product;
use App\Libraries\Heart;
use App\Libraries\MyClass;

$product = Product::where([['Status', '=', '1']])->orderBy('CreatedAt', 'desc')->get();

$heart = new Heart();
$page = "view";

if (isset($_REQUEST['addheart'])) {
    $qty = 1;
    $id = $_REQUEST['addheart'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();

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
    header("location:index.php");
    exit;
}

if (isset($_REQUEST['delheart'])) {

    $id = $_REQUEST['delheart'];
    if ($id == 'all') {
        unset($_SESSION['heart']);
    } else {
        Heart::removeHeart($id);
        MyClass::set_flash("message", ['msg' => 'Xóa khỏi danh sách yêu thích thành công !']);
    }
    header("location:index.php?option=heart");
    MyClass::set_flash("message", ['msg' => 'Xóa khỏi danh sách yêu thích thành công !']);
    exit;
}

if (isset($_REQUEST['addToCart'])) {
    $list_content = Heart::contentHeart();
    $id = $_REQUEST['addToCart'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();
    foreach ($list_content as $rheart) {
        $qty = $rheart['qty'];
        $array = array(
            'Id' => $id,
            'Img' => $row_product['Img'],
            'Name' => $row_product['Name'],
            'Price' => $row_product['Pricesale'],
            'qty' => $qty,
            'amount' => $row_product['Pricesale'] * $qty,
        );
    }

    if ($id == 'all') {
        foreach ($list_content as $rheart) {
            $array = array(
                'Id' => $rheart['Id'],
                'Img' => $rheart['Img'],
                'Name' => $rheart['Name'],
                'Price' => $rheart['Price'],
                'qty' => $rheart['qty'],
                'amount' => $rheart['amount'] * $rheart['qty'],
            );
            Cart::addToCart($array);
            unset($_SESSION['heart']);
            MyClass::set_flash("message", ['msg' => 'Thêm tất cả từ danh sách yêu thích qua giỏ hàng thành công !']);
        }
    } else {
        Cart::addToCart($array);
        Heart::removeHeart($id);
        MyClass::set_flash("message", ['msg' => 'Thêm từ danh sách yêu thích qua giỏ hàng thành công !']);
    }
    header("location:index.php?option=heart");
    exit;
}

if ($page == "view") {
    $list_content = Heart::contentHeart();
    require_once('views/frontend/heart_view.php');
    exit;
}
