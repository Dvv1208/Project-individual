<?php
use App\Models\Product;
use App\Libraries\Cart;
use App\Libraries\Myclass;

$product = Product::where([['Status', '=', '1']])->orderBy('CreatedAt','desc')->get();

$cart = new Cart();
$page="view";

if(isset($_REQUEST['addcart']))
{
    $qty= 1;
    $id = $_REQUEST['addcart'];
    $row_product = Product::where([['Id', '=', $id],['Status', '=', '1']])->first();

    $row_cart = array(
        'Id'=> $id,
        'Img' => $row_product['Img'],
        'Name'=>$row_product['Name'],
        'Price'=>$row_product['Pricesale'],
        'qty'=>$qty,
        'amount'=>$row_product['Pricesale']*$qty,
    );
    Cart::addCart($row_cart);
    header("location:index.php");
}
if(isset($_REQUEST['delcart'])){
    
    $id = $_REQUEST['delcart'];
    if($id == 'all'){
        unset($_SESSION['cart']);
    }
    else
    {
       Cart::removeCart($id);
    }
    header("location:index.php?option=cart");
}

if($page=="view")
{
    $list_content = Cart::contentCart();
    require_once'views/frontend/cart_view.php';
}