<?php

use App\Models\Product;
use App\Models\Post;

$keyword = '';
if (isset($_POST['keyword']) && $_POST['keyword'] != '') {
    $keyword = $_POST['keyword'];
}
// var_dump($keyword);
// $product = Product::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get()->toArray();
// $list_product = Product::find($keyword);
$list_pro = Product::where([['Status', '!=', '0'], ['Name', 'like', '%' . $keyword . '%']])->orderBy('CreatedAt', 'desc')->get();
$title = 'Tìm kiếm';

?>
<?php require_once('views/frontend/header.php'); ?>

<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="clearfix maincontent">
    <div class="container">
        <div class="col-md-3">
            <div class="area alert-info">Kết quả tìm kiếm "<?php echo $keyword; ?>" là:
                <?php echo (count($list_pro)) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="maincontent">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="products-tabs">
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <?php foreach ($list_pro as $row_product) : ?>
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
                    </div>
                </div>
        </div>
</section>
</div>
</div>
</section>
<?php require_once('views/frontend/footer.php'); ?>