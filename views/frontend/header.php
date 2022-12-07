<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\User;
use App\Libraries\MyClass;

$user = (isset($_SESSION['logincustomer'])) ?  $_SESSION['logincustomer'] : [];

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
    <link rel="stylesheet" href="public/css/toastr.min.css">
    <link rel="stylesheet" href="public/css/layoutsite.css">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="public/js/toastr.min.js"></script>
    <script>
        window.toastr.options = {
            "progressBar": true,
            heading: 'Positioning',
            position: 'top-right',
            stack: false
        };
    </script>

</head>
<?php include_once('views/frontend/message_alert.php'); ?>

<body class="o_connected_user">
    <header class="header">
        <div id="wrapwrap" class="container">
            <header id="top" data-anchor="true" data-name="Header" class="o_header_standard o_top_fixed_element">
                <nav data-name="Navbar" class="navbar navbar-expand-lg navbar-light o_colored_level o_cc shadow-sm">
                    <div id="top_menu_container" class="container justify-content-start justify-content-lg-between">
                        <a href="/" class="navbar-brand logo mr-4">
                            <span data-oe-model="website" data-oe-id="1" data-oe-field="logo" data-oe-type="image" data-oe-expression="website.logo" role="img" aria-label="Logo of My Website" title="My Website"><img src="/web/image/website/1/logo/My%20Website?unique=3e7f044" class="img img-fluid" alt="My Website" loading="lazy"></span>
                        </a>
                        <button type="button" data-toggle="collapse" data-target="#top_menu_collapse" data-oe-model="ir.ui.view" data-oe-id="4965" data-oe-field="arch" data-oe-xpath="/t[1]/button[1]" class="navbar-toggler ml-auto">
                            <span class="navbar-toggler-icon o_not_editable"></span>
                        </button>
                        <div id="top_menu_collapse" class="collapse navbar-collapse order-last order-lg-0" aria-expanded="false">
                            <ul id="top_menu" class="nav navbar-nav flex-grow-1">
                                <?php if (isset($_SESSION['logincustomer'])) : ?>
                                    <?php $username = User::find($_SESSION['user_id']); ?>
                                    <?php if ($username['Roles'] == 1) : ?>
                                        <li class="nav-item">
                                            <a role="menuitem" href="admin" class="nav-link ">
                                                <span class="">Trang Admin</span>
                                            </a>
                                        </li>
                                    <? else : ?>
                                    <?php endif ?>
                                <?php endif ?>
                                <li class="nav-item">
                                    <a role="menuitem" href="index.php" class="nav-link active">
                                        <span>Cửa hàng</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a role="menuitem" href="index.php?option=contact" class="nav-link ">
                                        <span>Liên hệ</span>
                                    </a>
                                </li>

                                <li class="nav-item mx-lg-3">
                                    <?php
                                    $count_heart = 0;
                                    if (isset($_SESSION['heart'])) {
                                        $heart = $_SESSION['heart'];
                                        $count_heart = count($heart);
                                    }
                                    ?>
                                    <a href="index.php?option=heart" class="nav-link" data-original-title="" title="Thêm vào yêu thích">
                                        <i class="fas fa-heart"></i>

                                        <sup class="badge bg-danger rounded-pill"><?php echo $count_heart; ?></sup>
                                    </a>
                                </li>

                                <li class="o_wsale_my_cart nav-item">
                                    <?php
                                    $count_cart = 0;
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                        $count_cart = count($cart);
                                    }
                                    ?>
                                    <a href="index.php?option=cart" class="nav-link" data-original-title="" title="">
                                        <i class="fa fa-shopping-cart"></i>

                                        <sup class="badge bg-danger rounded-pill"><?php echo $count_cart; ?></sup>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="oe_structure oe_structure_solo" id="oe_structure_header_default_1">
                            <section class="s_text_block" data-snippet="s_text_block" data-name="Text">
                                <div class="container">
                                    <ul id="top_menu" class="nav navbar-nav flex-grow-1">
                                        <?php if (isset($_SESSION['logincustomer'])) : ?>
                                            <?php $username = User::find($_SESSION['user_id']); ?>
                                            <ul class="nav-item dropdown ml-lg-auto o_no_autohide_item">
                                                <a href="#" role="button" data-bs-toggle="dropdown" class="dropdown-toggle nav-link font-weight-bold" aria-expanded="false">
                                                    <span class=""><?php echo $username->Fullname ?></span>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="index.php?option=customer&logout">Đăng
                                                            xuất</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index.php?option=customer&profile">Thông tin
                                                        </a>
                                                    </li>
                                                </ul>
                                            </ul>
                                        <?php else : ?>
                                            <ul class="nav-item dropdown ml-lg-auto o_no_autohide_item">
                                                <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tài khoản
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
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
    </header>
</body>

<section class="mainmenu clearfix">
    <div class="container">
        <?php require_once('views/frontend/mod_mainmenu.php') ?>
    </div>
</section>