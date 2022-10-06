<?php 
use App\Models\Product;
use App\Libraries\Pagination;

$title = 'Tất cả sản phẩm';

$limit = 16;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page,$limit);
$list_product = Product::where('Status', '=', '1')
    ->orderBy('CreatedAt','desc')->skip($skip)->take($limit)
    ->get();
    
$total = Product::where('Status', '=', '1')->count();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('views/frontend/mod_listcategory.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="product_category my-3">
                    <h3 class="my-3 text-center">
                        <?php echo $title; ?>
                    </h3>
                    <div class="row">
                        <?php foreach($list_product as $row_product) : ?>
                        <div class="col-md-3 mb-3">
                            <div class="card" style="width: 100%;">
                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                    <img src="public/images/product/<?php echo $row_product['Img']; ?>"
                                        class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title text-center ">
                                        <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                            <?php echo $row_product['Name']; ?>
                                        </a>
                                    </h5>
                                    <h5 class="text-center">
                                        <?php
                                        if ($row_product['Price']>$row_product['Pricesale'])
                                        {
                                            echo "<del >" .number_format($row_product['Price'])."</del><sup>đ</sup>";
                                            echo number_format($row_product['Pricesale']) ."<sup>đ</sup>";
                                        }
                                        else {
                                            echo number_format($row_product['Price'])."<sup>đ</sup>";
                                        }
                                        ?>
                                    </h5>
                                    <div class="btn-group w-100" role="group" aria-label="Basic example">
                                        <a href="index.php?option=cart&addcart=<?php echo $row_product['Id'];?>"
                                            class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>

                                        <a href="index.php?option=product&id=<?php echo $row_product['Slug'];?>"
                                            class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div><?=Pagination::pageLinks($total, $page, $limit,'index.php?option=product');?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php');?>