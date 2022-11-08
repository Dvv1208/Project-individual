<?php
use App\Models\Product;
use App\Libraries\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Orderdetail;

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

if(isset($_SESSION['contentcart'])){
    $row_cart = $_SESSION['contentcart'];
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

if(isset($_REQUEST['process']))
{
    $user = User::find($_SESSION['user_id']);
    $data = getdate();
    $oder = new Order();
    $oder->Code = $data[0];
    $oder->User_id = $_SESSION['user_id'];
    $oder->CreatedAt = date('Y-m-d H:i:s');
    $oder->Diachi = (isset($_POST['Diachi'])?$_POST['Diachi']:$user['Address']);
    $oder->Name = (isset($_POST['Name'])?$_POST['Name']:$user['Fullname']);
    $oder->Phone = (isset($_POST['Phone'])?$_POST['Phone']:$user['Phone']);
    $oder->Email = (isset($_POST['Email'])?$_POST['Email']:$user['Email']);
    $oder->Status = 1;
    if($oder->save())
    {
        $carts = $list_content ;
        foreach($carts as $cart){
            $orderdetail = new Orderdetail();
            $orderdetail->Orderid = $oder->Id;
            $orderdetail->Productid = $cart['Id'];
            $orderdetail->Price = $cart['Price'];
            $orderdetail->Quantity = $cart['qty'];
            $orderdetail->Amount = $cart['amount'];
            $orderdetail->save();
        }
    }
    // Order::insert($data);
    //header("location:index.php?option=cart-process-detail");
}
