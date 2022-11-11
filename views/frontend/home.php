<?php

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
    <div class="container">
        <div class="row product-home my-3 border: 1px solid red;">
            <div class="col-md-12">
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
                    <tbody>
                        <tr>
                            <h3 class=" py-3 text-center position-relative">
                                <a href="index.php?option=product&cat=<?php echo $cat['Slug']; ?>"><?php echo $cat['Name']; ?></a>
                            </h3>
                            <td colspan="2" rowspan="2" class="oe_product">
                                <div class="row text-center my-3">
                                    <?php foreach ($list_product as $row_product) : ?>
                                        <div class="col-md-3 mb-3">
                                            <div class="card" style="width: 100%;">
                                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                    <img style="width: 100%;" src="public/images/product/<?php echo $row_product['Img']; ?>" class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">
                                                        <a class="a a-outline-danger" href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                            <?php echo $row_product['Name']; ?>
                                                        </a>
                                                    </h5>
                                                    <h5 class="text-center text-danger">
                                                        <?php
                                                        if ($row_product['Price'] > $row_product['Pricesale']) {
                                                            echo number_format($row_product['Pricesale'], 0, ',', '.') . "<sup>đ</sup>";

                                                            echo "<del class='text-success'>" . number_format($row_product['Price'], 0, ',', '.') . "</del><sup class='text-danger'>đ</sup>";
                                                        } else {
                                                            echo number_format($row_product['Price'], 0, ',', '.') . "<sup>đ</sup>";
                                                        }
                                                        ?>
                                                    </h5>
                                                    <div class="row">
                                                        <div class="btn-group w-100" data-autohide="false" role="group" aria-label="Basic example">
                                                            <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                            <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach; ?>
            </div>
            <div><?= Pagination::pageLinks($total, $page, $limit, 'index.php'); ?></div>
        </div>
    </div>
</section>
<!--section maincontent-->
<?php require_once('views/frontend/footer.php'); ?>