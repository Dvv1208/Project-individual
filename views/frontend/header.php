<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Models\User;

$row = (isset($_SESSION['user'])) ?  $_SESSION['user']: [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($title)) ? $title : "Võ Văn Dương"; ?></title>
    <meta name="description" content="<?php echo (isset($metakey)) ? $metakey : "Từ khóa SEO"; ?>">
    <meta name="keywords" content="<?php echo (isset($metadesc)) ? $metadesc : "Mô tả SEO"; ?>">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/all.min.css">
    <link rel="stylesheet" href="public/css/layoutsite.css">
    <script src="public/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="header">
        <section class="header">
            <div class="container my-3">
                <div class="row">
                    <div class="col-md-2">
                        <img src="public/images/logo2.jpg" class="img-fluid" alt="logo">
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3 my-3">
                            <select name="" class="form-select border-right-0" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <option value="">Danh mục sản phẩm</option>
                                <option value="">Điện thoại Iphone</option>
                                <option value="">Điện thoại Samsung</option>
                                <option value="">Điện thoại Nokia</option>
                                <option value="">Điện thoại Vivo</option>
                                <option value="">Điện thoại Xiaomi</option>
                                <option value="">Điện thoại Oppo</option>
                                <option value="">Điện thoại Realme</option>
                            </select>
                            <input type="text" class="form-control" aria-label="Text input with dropdown button">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="nav justify-content-end">
                            <?php
                            $count_cart=0;
                            if(isset($_SESSION['cart']))
                            {
                                $cart = $_SESSION['cart'];
                                $count_cart=count($cart);
                            }   
                            ?>
                            <div class="col mt-3 text-center">
                                <a href="index.php?option=cart" class="text-decoration-none text-dark">
                                    <i class="fa-solid fa-cart-shopping fs-3 ms-3"></i>
                                    <span class="badge bg-danger rounded-pill"><?php echo $count_cart;?></span>
                                    <br>
                                    <h6 class="my-2">
                                        <a style="text-decoration: none" class="text-dark"
                                            href="index.php?option=cart"><b>Giỏ
                                                hàng</b>
                                        </a>
                                    </h6>
                                </a>
                            </div>
                            <div class="col mt-3 text-center">
                                <?php if(isset($_SESSION['user'])) :?>
                                <i class="fa-solid fa-user fs-3 ms-4 "></i>
                                <ul class="">
                                    <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false"><b><?php echo $_SESSION['user']?></b>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="index.php?option=customer&logout">Đăng
                                                xuất</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="index.php?option=customer&protife">Thông tin
                                            </a>
                                        </li>
                                    </ul>
                                </ul>
                                <?php else:?>
                                <i class="fa-solid fa-user fs-3 ms-4 "></i>
                                <ul class="">
                                    <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false"><b>Tài khoản</b>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li>
                                            <a class="dropdown-item" href="index.php?option=customer&login">Đăng
                                                nhập</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="index.php?option=customer&register">Đăng
                                                ký</a>
                                        </li>
                                    </ul>
                                </ul>
                                <?php endif;?>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="mainmenu clearfix bg-mainmenu">
            <div class="container">
                <?php require_once('views/frontend/mod_mainmenu.php') ?>
            </div>
        </section>