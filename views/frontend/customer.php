<?php

require_once("vendor/autoload.php");
require_once("config/database.php");

use App\Models\User;
use App\Libraries\Myclass;

?>

<?php
if(isset($_REQUEST['login']))
{
    header("location:index.php?option=login");
}
if(isset($_REQUEST['register']))
{
    header("location:index.php?option=register");
}
if(isset($_REQUEST['logout']))
{
    unset($_SESSION['user']);
    // unset($_SESSION['userid']);
    header("location:index.php");
}
?>