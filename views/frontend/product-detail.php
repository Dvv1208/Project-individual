<?php require_once('views/frontend/header.php'); ?>
<?php

use App\Models\Product;
use App\Models\Category;
use App\Libraries\Pagination;
use App\Models\ProductsImages;

$slug = $_REQUEST['id'];

$row_pro = Product::where([['Slug', '=', $slug], ['Status', '=', '1']])->first();
$title = $row_pro['Name'];
$metakey = $row_pro['Metakey'];
$metadesc = $row_pro['Metadesc'];

$listcatid = array();
array_push($listcatid, $row_pro['Catid']);
$list_category1 = Category::where([['Parentid', '=', $row_pro['Catid']], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
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
    ->where('Id', '!=', $row_pro['Id'])
    ->orderBy('CreatedAt', 'desc')->take(8)
    ->with('images')
    ->get();
$list_img = ProductsImages::where('proId', '=', $row_pro['Id'])->get();
?>

<section class="maincontent">
    <div class="container my-3">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-md-pull-5">
                        <div id="product-imgs">
                            <?php foreach ($list_img as $key) : ?>
                                <div class="product-preview">
                                    <img src="public/images/product/<?php echo $key->ImgId; ?>" class="img-fluid w-100" alt="<?php echo $key->ImgId; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-push-2">
                        <div id="product-main-img" style="width: 498px;">
                            <?php foreach ($list_img as $key) : ?>
                                <div class="product-preview">
                                    <img src="public/images/product/<?php echo $key->ImgId; ?>" class="img-fluid w-100" alt="<?php echo $key->ImgId; ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name"><?php echo $row_pro['Name']; ?></h2>
                            <div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a style="text-decoration: none" class="review-link" href="#">10 lượt đánh giá | Thêm đánh giá của bạn</a>
                            </div>
                            <div>
                                <h5 class="product-price"><?php echo number_format($row_pro['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                    <del class="product-old-price"><?php echo number_format($row_pro['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                </h5>
                            </div>
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Số lượng
                                    <div class="input-number">
                                        <input type="number" value="1" min="1">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div><br><br>
                                <ul class="product-btns" role="group" aria-label="Basic example">
                                    <li>
                                        <a href="index.php?option=heart&addheart=<?php echo $row_pro['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> Thêm vào yêu thích</a>
                                    </li>
                                    <li>
                                        <a href="index.php?option=cart&addcart=<?php echo $row_pro['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="product-links">
                                <li><label>Chia sẻ: </label></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i></a></li>
                            </ul>
                        </div>
                        <br>
                        <h5>Chi tiết sản phẩm</h5>
                        <p><?php echo $row_pro['Detail']; ?></p>
                        <!-- <p>
                <div class="fb-like" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true">
                </div>
                </p> -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="fb-comments" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="100%" data-numposts="5">
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                    <div class="div my-3">
                        <h3>SẢN PHẨM CÙNG LOẠI</h3>
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php foreach ($list_product as $row_product) : ?>
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                    <img src="public/images/product/<?php echo $row_product['Img']; ?>" class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                                </a>
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
                                                    <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                    <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
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