<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\User;
use App\Libraries\MyClass;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang quản trị</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../public/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../public/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/toastr.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../public/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../public/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../public/dist/css/adminlte.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Trang quản trị</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/JavaScript/php/" class="nav-link">Website Bán Hàng</a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Liên hệ</a>
                </li> -->
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="logout.php" role="button">
                        <i class="fas fa-power-off"></i> ĐĂNG XUẤT
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link">
                <?php $username = User::find($_SESSION['userid']); ?>
                <img src="../public/dist/img/user2-160x160.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?php echo $username->Fullname ?></span>
            </a>

            <div class="sidebar">
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2" id="fixednav">
                    <ul class="nav nav-pills-danger nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-product-hunt"></i>
                                <p id="tabcontent">
                                    Sản phẩm
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=product" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="tablinks">Tất cả sản phẩm</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="index.php?option=product&cat=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="tablinks">Thêm sản phẩm</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=category" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh mục sản phẩm</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-newspaper-o"></i>
                                <p>
                                    Bài viết
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=post" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tất cả bài viết</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=post&cat=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm bài viết</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=topic" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Chủ đề bài viết</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=page" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh sách trang đơn</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-shopping-basket"></i>
                                <p>
                                    Đơn hàng
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=order" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tất cả đơn hàng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=order&cat=order-cart" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tình trạng đơn hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-user-o"></i>
                                <p>
                                    Khách hàng
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=customer" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Khách hàng</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=customer&cat=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm khách hàng</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-id-badge"></i>
                                <p>
                                    Liên hệ
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=contact" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tất cả liên hệ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=customer&cat=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm liên hệ</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-tachometer"></i>
                                <p>
                                    Giao diện
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=menu" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Menu</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=slider" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Slider</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    Thành viên
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=user" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tất cả thành viên</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?option=user&cat=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm thành viên</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-grin-stars"></i>
                                <p>
                                    Đánh giá
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?option=review" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tất cả đánh giá</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <script>
            $(function() {
                var url = window.location;
                $('ul.nav-sidebar a').filter(function() {
                    return this.href == url;
                }).addClass('active');
                $('ul.nav-treeview a').filter(function() {
                        return this.href == url;
                    }).parentsUntil(".nav-sidebar > .nav-treeview")
                    .css({
                        'display': 'block'
                    })
                    .addClass('menu-open').prev('a')
                    .addClass('active');
            });
            // $(".nav .nav-link").on("click", function() {
            //     $(".nav").find(".active").removeClass("active");
            //     $(this).addClass("active");
            // });
        </script>