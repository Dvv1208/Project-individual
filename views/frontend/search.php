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
$list_post = Product::where('Name', 'like', '%' . $keyword . '%')->get();
$title = 'Tìm kiếm';

?>
<?php require_once('views/frontend/header.php'); ?>

<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
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
                <?php echo (count($list_post)) ?>
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
                        <div class="col-md-12">
                            <div class="product_category my-3">
                                <div class="row">
                                    <?php foreach ($list_post as $p) : ?>
                                        <div class="col-md-3 mb-3">
                                            <div class="card" style="width: 100%;">
                                                <a href="index.php?option=product&id=<?php echo $p['Slug']; ?>">
                                                    <img src="public/images/product/<?php echo $p['Img']; ?>" class="card-img-top" alt="<?php echo $p['Img']; ?>">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center ">
                                                        <a href="index.php?option=product&id=<?php echo $p['Slug']; ?>">
                                                            <?php echo $p['Name']; ?>
                                                        </a>
                                                    </h5>
                                                    <h5 class="text-center text-danger">
                                                        <?php
                                                        if ($p['Price'] > $p['Pricesale']) {
                                                            echo number_format($p['Pricesale']) . "<sup>đ</sup>";

                                                            echo "<del class='text-success'>" . number_format($p['Price']) . "</del><sup class='text-danger'>đ</sup>";
                                                        } else {
                                                            echo number_format($p['Price']) . "<sup>đ</sup>";
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div class="btn-group w-100" role="group" aria-label="Basic example">
                                                        <a href="index.php?option=cart&addcart=<?php echo $p['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>

                                                        <a href="index.php?option=product&id=<?php echo $p['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                    </div>
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
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>