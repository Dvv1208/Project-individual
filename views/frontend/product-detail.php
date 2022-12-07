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
$imgpro = Product::where('Id', '=', $row_pro['Id'])->with('images')->get();



// foreach ($imgpro as $i) {
//     echo '<pre>';
//     print_r($i->Img);
//     echo '</pre>';
// }


?>

<section class="maincontent">
    <div class="container my-3">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-md-pull-5">
                        <div id="product-imgs">
                            <?php
                            foreach ($imgpro as $i) {
                                echo ("<div class='product-preview'>"
                                    . "<img src='public/images/product/$i->Img' class='img-fluid w-100' alt='$i->Img'>"
                                    . "</div>");
                                if ($i->Id != null) {
                                    foreach ($list_img as $key) {
                                        echo ("<div class='product-preview'>"
                                            . "<img src='public/images/product/images/$key->ImgId' class='img-fluid w-100' alt='$key->ImgId'> "
                                            . "</div>");
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-push-2">
                        <div id="product-main-img" style="width: 498px;">
                            <?php
                            foreach ($imgpro as $i) {
                                echo ("<div class='product-preview'>"
                                    . "<img src='public/images/product/$i->Img' class='img-fluid w-100' alt='$i->Img'>"
                                    . "</div>");
                                if ($i->Id != null) {
                                    foreach ($list_img as $key) {
                                        echo ("<div class='product-preview'>"
                                            . "<img src='public/images/product/images/$key->ImgId' class='img-fluid w-100' alt='$key->ImgId'> "
                                            . "</div>");
                                    }
                                }
                            }
                            ?>
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

                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="fb-comments" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="100%" data-numposts="5">
                            </div>
                        </div>
                    </div> -->
                    <!--end row-->

                    <div class="col-md-12">
                        <div id="product-tab">
                            <ul class="tab-nav">
                                <li class="active"><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabDetail')" type="button">Chi tiết sản phẩm</a></li>
                                <li><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabMetadesc')" type="button">Mô tả sản phẩm</a></li>
                                <li><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabVote')" type="button">Đánh giá sản phẩm</a></li>
                            </ul>
                            <div id="tabDetail" class="tabcontent" style="display:block">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p><?php echo $row_pro['Detail']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="tabMetadesc" class="tabcontent">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p><?php echo $row_pro['Metadesc']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="tabVote" class="tabcontent">
                                <div class="row mb-3">
                                    <!-- Rating -->
                                    <div class="col-md-3 ">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>4.5</span>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 80%;"></div>
                                                    </div>
                                                    <span class="sum">3</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div style="width: 60%;"></div>
                                                    </div>
                                                    <span class="sum">2</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div></div>
                                                    </div>
                                                    <span class="sum">0</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form">
                                                <input class="input" type="text" placeholder="Your Name">
                                                <input class="input" type="email" placeholder="Your Email">
                                                <textarea class="input" placeholder="Your Review"></textarea>
                                                <div class="input-rating">
                                                    <span>Your Rating: </span>
                                                    <div class="stars">
                                                        <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                        <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                        <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                        <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                        <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                    </div>
                                                </div>
                                                <button class="primary-btn">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="container my-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="newsletter">
                                    <h3>SẢN PHẨM CÙNG LOẠI</h3>
                                    <div class="products-tabs">
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
                                    <div class="container text-center">
                                        <div class="row">
                                            <div id="slick-nav-1" class="products-slick-nav"></div>
                                        </div>
                                    </div>
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
<link type="text/css" rel="stylesheet" href="public/home/css/slick.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/slick-theme.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/nouislider.min.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/style.css" />
<script src="public/home/js/jquery.min.js"></script>
<script src="public/home/js/slick.min.js"></script>
<script src="public/home/js/nouislider.min.js"></script>
<script src="public/home/js/jquery.zoom.min.js"></script>
<script src="public/home/js/main.js"></script>
<script src="public/home/js/bootstrap.min.js"></script>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }
        document.getElementById(tabName).style.display = " block";
        evt.currentTarget.className += " active";
    }
</script>
<style>
    .tabcontent {
        display: none;
    }
</style>