<?php

use App\Models\Product;
use App\Libraries\Pagination;

$title = 'Tất cả sản phẩm';

$limit = 16;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);
$list_product = Product::where('Status', '=', '1')
    ->orderBy('CreatedAt', 'desc')
    ->get();

$total = Product::where('Status', '=', '1')->count();
$name_asc = Product::where('Status', '=', '1')
    ->orderBy('Name', 'asc')
    ->get();
$name_desc = Product::where('Status', '=', '1')
    ->orderBy('Name', 'desc')
    ->get();
$price_desc = Product::where('Status', '=', '1')
    ->orderBy('Price', 'desc')
    ->get();
$price_asc = Product::where('Status', '=', '1')
    ->orderBy('Price', 'asc')
    ->get();
?>


<?php require_once('views/frontend/header.php'); ?>
<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="maincontent normal">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-12">
                <div class="product_category my-3">
                    <h3 class="my-3 text-center">
                        <?php echo $title; ?>
                    </h3>
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label id="orderby" style="text-transform: none; font-size: 16px;">
                                Sắp xếp theo:
                                <select class="input-select">
                                    <option value="chon">Chọn</option>
                                    <option value="orderbyName">Tên</option>
                                    <option value="orderbyPrice">Giá</option>
                                </select>
                            </label>

                            <label style="text-transform: none; font-size: 16px;">
                                Hiển thị theo:
                                <select class="input-select" id="nameorder" name="nameorder">
                                    <option value="atoz" id="atoz">A - Z</option>
                                    <option value="ztoa" id="ztoa">Z - A</option>
                                </select>
                                <select class="input-select" id="price" name="price">
                                    <option value="maxprice">Giá tăng dần</option>
                                    <option value="minprice">Giá giảm dần</option>
                                    <option value="ontofour">Từ 1-4 triệu</option>
                                    <option value="fourtoeight">Từ 4-8 triệu</option>
                                    <option value="toeight">Trên 8 triệu</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <div class="products-tabs">
                        <div id="tab1" class="tab-pane active normal">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <?php foreach ($list_product as $row_product) : ?>
                                    <div class="product filter_data">
                                        <div class="product-img">
                                            <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                <img src="public/images/product/<?php echo $row_product['Img']; ?>" class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                            </a>
                                            <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name">
                                                <h5>
                                                    <a style="text-decoration: none" href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                        <?php echo $row_product['Name']; ?>
                                                    </a>
                                                </h5>
                                            </h3>
                                            <h5 class="product-price"><?php echo number_format($row_product['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                                <del class="product-old-price"><?php echo number_format($row_product['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                            </h5>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns" role="group" aria-label="Basic example">
                                                <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div id="slick-nav-1" class="products-slick-nav"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane active nameasc">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <?php foreach ($name_asc as $row_nameasc) : ?>
                                    <div class="product filter_data">
                                        <div class="product-img">
                                            <a href="index.php?option=product&id=<?php echo $row_nameasc['Slug']; ?>">
                                                <img src="public/images/product/<?php echo $row_nameasc['Img']; ?>" class="card-img-top" alt="<?php echo $row_nameasc['Img']; ?>">
                                            </a>
                                            <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name">
                                                <h5>
                                                    <a style="text-decoration: none" href="index.php?option=product&id=<?php echo $row_nameasc['Slug']; ?>">
                                                        <?php echo $row_nameasc['Name']; ?>
                                                    </a>
                                                </h5>
                                            </h3>
                                            <h5 class="product-price"><?php echo number_format($row_nameasc['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                                <del class="product-old-price"><?php echo number_format($row_nameasc['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                            </h5>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns" role="group" aria-label="Basic example">
                                                <a href="index.php?option=cart&addcart=<?php echo $row_nameasc['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                <a href="index.php?option=cart&addcart=<?php echo $row_nameasc['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                <a href="index.php?option=product&id=<?php echo $row_nameasc['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div id="slick-nav-2" class="products-slick-nav"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab3" class="tab-pane active namedesc">
                            <div class="products-slick" data-nav="#slick-nav-3">
                                <?php foreach ($name_desc as $row_namedesc) : ?>
                                    <div class="product filter_data">
                                        <div class="product-img">
                                            <a href="index.php?option=product&id=<?php echo $row_namedesc['Slug']; ?>">
                                                <img src="public/images/product/<?php echo $row_namedesc['Img']; ?>" class="card-img-top" alt="<?php echo $row_namedesc['Img']; ?>">
                                            </a>
                                            <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name">
                                                <h5>
                                                    <a style="text-decoration: none" href="index.php?option=product&id=<?php echo $row_namedesc['Slug']; ?>">
                                                        <?php echo $row_namedesc['Name']; ?>
                                                    </a>
                                                </h5>
                                            </h3>
                                            <h5 class="product-price"><?php echo number_format($row_namedesc['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                                <del class="product-old-price"><?php echo number_format($row_namedesc['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                            </h5>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns" role="group" aria-label="Basic example">
                                                <a href="index.php?option=cart&addcart=<?php echo $row_namedesc['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                <a href="index.php?option=cart&addcart=<?php echo $row_namedesc['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                <a href="index.php?option=product&id=<?php echo $row_namedesc['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div id="slick-nav-3" class="products-slick-nav"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab4" class="tab-pane active priceasc">
                            <div class="products-slick" data-nav="#slick-nav-4">
                                <?php foreach ($price_asc as $row_price_asc) : ?>
                                    <div class="product filter_data">
                                        <div class="product-img">
                                            <a href="index.php?option=product&id=<?php echo $row_price_asc['Slug']; ?>">
                                                <img src="public/images/product/<?php echo $row_price_asc['Img']; ?>" class="card-img-top" alt="<?php echo $row_price_asc['Img']; ?>">
                                            </a>
                                            <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name">
                                                <h5>
                                                    <a style="text-decoration: none" href="index.php?option=product&id=<?php echo $row_price_asc['Slug']; ?>">
                                                        <?php echo $row_price_asc['Name']; ?>
                                                    </a>
                                                </h5>
                                            </h3>
                                            <h5 class="product-price"><?php echo number_format($row_price_asc['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                                <del class="product-old-price"><?php echo number_format($row_price_asc['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                            </h5>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns" role="group" aria-label="Basic example">
                                                <a href="index.php?option=cart&addcart=<?php echo $row_price_asc['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                <a href="index.php?option=cart&addcart=<?php echo $row_price_asc['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                <a href="index.php?option=product&id=<?php echo $row_price_asc['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div id="slick-nav-4" class="products-slick-nav"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab5" class="tab-pane active pricedesc">
                            <div class="products-slick" data-nav="#slick-nav-5">
                                <?php foreach ($price_desc as $row_price_desc) : ?>
                                    <div class="product filter_data">
                                        <div class="product-img">
                                            <a href="index.php?option=product&id=<?php echo $row_price_desc['Slug']; ?>">
                                                <img src="public/images/product/<?php echo $row_price_desc['Img']; ?>" class="card-img-top" alt="<?php echo $row_price_desc['Img']; ?>">
                                            </a>
                                            <!-- <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div> -->
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name">
                                                <h5>
                                                    <a style="text-decoration: none" href="index.php?option=product&id=<?php echo $row_price_desc['Slug']; ?>">
                                                        <?php echo $row_price_desc['Name']; ?>
                                                    </a>
                                                </h5>
                                            </h3>
                                            <h5 class="product-price"><?php echo number_format($row_price_desc['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                                <del class="product-old-price"><?php echo number_format($row_price_desc['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                            </h5>
                                            <div class="product-rating">
                                            </div>
                                            <div class="product-btns" role="group" aria-label="Basic example">
                                                <a href="index.php?option=cart&addcart=<?php echo $row_price_desc['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                <a href="index.php?option=cart&addcart=<?php echo $row_price_desc['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                <a href="index.php?option=product&id=<?php echo $row_price_desc['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="container text-center">
                                <div class="row">
                                    <div id="slick-nav-5" class="products-slick-nav"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once('views/frontend/footer.php'); ?>

<link rel="stylesheet" href="public/home/css/font-awesome.min.css">
<script src="public/js/orderBy.js"></script>