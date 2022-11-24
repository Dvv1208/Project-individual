<?php

use App\Libraries\Cart;
use App\Models\Product;
use App\Libraries\Heart;

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
    header("location:index.php");
    exit;
}

if (isset($_REQUEST['delheart'])) {

    $id = $_REQUEST['delheart'];
    if ($id == 'all') {
        unset($_SESSION['heart']);
    } else {
        Heart::removeHeart($id);
    }
    header("location:index.php?option=heart");
    exit;
}

if (isset($_REQUEST['addToCart'])) {
    $list_content = Heart::contentHeart();
    foreach ($list_content as $rheart) {
        $qty = $rheart['qty'];
    }
    $id = $_REQUEST['addToCart'];
    $row_product = Product::where([['Id', '=', $id], ['Status', '=', '1']])->first();

    $row_heart = array(
        'Id' => $id,
        'Img' => $row_product['Img'],
        'Name' => $row_product['Name'],
        'Price' => $row_product['Pricesale'],
        'qty' => $qty,
        'amount' => $row_product['Pricesale'] * $qty,
    );
    if ($id == 'all') {
        foreach ($list_content as $rheart) {
            $array = array(
                'Id' => $rheart['Id'],
                'Img' => $rheart['Img'],
                'Name' => $rheart['Name'],
                'Price' => $rheart['Price'],
                'qty' => $rheart['qty'],
                'amount' => $rheart['amount'] * $rheart['qty']++,
            );
            Cart::addToCart($array[$count]);
            unset($_SESSION['heart']);
        }
    }
    Cart::addToCart($row_heart);
    Heart::removeHeart($id);
    header("location:index.php?option=heart");
    exit;
}

if ($page == "view") {
    $list_content = Heart::contentHeart();
    require_once('views/frontend/heart_view.php');
    exit;
}
