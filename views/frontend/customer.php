<?php

require_once("vendor/autoload.php");
require_once("config/database.php");

use App\Models\User;
use App\Libraries\Myclass;

?>

<?php
if(isset($_REQUEST['login']))
{
    require_once("views/frontend/customer-login.php");
}
if(isset($_REQUEST['register']))
{
    require_once("views/frontend/customer-register.php");
}
if(isset($_REQUEST['logout']))
{
    unset($_SESSION['logincustomer']);
    unset($_SESSION['user_id']);
    header("location:index.php");
}
if(isset($_REQUEST['profile']))
{
    require_once("views/frontend/customer-profile.php");
}
?>