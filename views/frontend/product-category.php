<?php

use App\Models\Category;
use App\Models\Product;
use App\Libraries\Pagination;

$slug = $_REQUEST['cat'];
$row_cat = Category::where([['Slug', '=', $slug], ['Status', '=', '1']])->first();
$title = $row_cat['Name'];
$metakey = $row_cat['Metakey'];
$metadesc = $row_cat['Metadesc'];
$listcatid = array();
array_push($listcatid, $row_cat['Id']);
$list_category1 = Category::where([['Parentid', '=', $row_cat['Id']], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
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

$limit = 16;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page, $limit);

$list_product = Product::where('Status', '=', '1')
    ->whereIn('Catid', $listcatid)
    ->orderBy('CreatedAt', 'desc')->skip($skip)->take($limit)
    ->get();

$total = Product::where('Status', '=', '1')->whereIn('Catid', $listcatid)->count();

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
<section class="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- <?php require_once('views/frontend/mod_listcategory.php'); ?> -->
            </div>
            <div class="col-md-12">
                <div class="product_category my-3">
                    <h2 class="my-3 text-center position-relative">
                        <?php echo $title; ?>
                    </h2>
                    <div class="row">
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
                                                    <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                    <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                    <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
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
</section>

<?php require_once('views/frontend/footer.php'); ?>