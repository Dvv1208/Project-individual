<?php

use App\Libraries\MyClass;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Libraries\Pagination;

$limit = 16;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);
$list_product = Product::where('Status', '=', '1')
    ->orderBy('CreatedAt', 'desc')->skip($skip)->take($limit)
    ->get();

$total = Product::where('Status', '=', '1')->count();

$list_category = Category::where([['Parentid', '=', '0'], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
$title = "Trang chủ";
$metakey = "";
$metadesc = "";

$list_slider = Slider::where([['Position', '=', 'slideshow'], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <?php require_once('views/frontend/mod_slider.php'); ?>
    <div class="container">
        <div class="row product-home my-3 border: 1px solid red;">
            <?php foreach ($list_category as $cat) : ?>
                <?php
                $listcatid = array();
                array_push($listcatid, $cat['Id']);
                $list_category1 = Category::where([['Parentid', '=', $cat['Id']], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
                if (count($list_category1) != 0) {
                    foreach ($list_category1 as $cat1) {
                        array_push($listcatid, $cat1['Id']);
                        $list_category2 = Category::where([['Parentid', '=', $cat1['Id']], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
                        if (count($list_category2) != 0) {
                            foreach ($list_category2 as $cat2) {
                                array_push($listcatid, $cat2['Id']);
                            }
                        }
                    }
                }
                $list_product = Product::where('Status', '=', '1')
                    ->whereIn('Catid', $listcatid)
                    ->orderBy('CreatedAt', 'desc')
                    ->take(8)
                    ->get();
                ?>
                <div class="col-md-12">
                    <div class="row">
                        <h2 class="text-center position-relative my-3">
                            <a style="text-decoration: none" href="index.php?option=product&cat=<?php echo $cat['Slug']; ?>"><?php echo $cat['Name']; ?></a>
                        </h2>
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php foreach ($list_product as $row_product) : ?>
                                        <div class="product">
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
                                                    <a href="index.php?option=heart&addheart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                    <a onclick="myFunction()" href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                    <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                </div>
                                            </div>
                                            <!-- <div class="add-to-cart">
                                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                                </div> -->
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>
<link type="text/css" rel="stylesheet" href="public/home/css/slick.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/slick-theme.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/nouislider.min.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/style.css" />
<script src="public/home/js/jquery.min.js"></script>
<script src="public/home/js/slick.min.js"></script>
<script src="public/home/js/nouislider.min.js"></script>
<script src="public/home/js/jquery.zoom.min.js"></script>
<script src="public/home/js/main.js"></script>