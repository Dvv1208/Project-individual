<?php 
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

$list_category = Category::where([['Parentid','=','0'],['Status','=','1']])->orderBy('Orders','asc')->get();
$title="Trang chủ";
$metakey="";
$metadesc="";

$list_slider = Slider::where([['Position','=','slideshow'],['Status','=','1']])->orderBy('Orders', 'asc')->get();
?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <div class="container my-3">
        <?php require_once('views/frontend/mod_slider.php'); ?>
        <!-- end slider-->
        <div class="container">
            <div class="row product-home my-3 border: 1px solid red;">
                <div class="col-md-3">
                    <div class="row my-3 ">
                        <div class="list-group">
                            <div class="row my-3">
                                <img src="public/images/logo.jpg" class="card-img-top my-3" alt="...">
                            </div>
                            <li class="list-group-item bg-mainmenu text-center">Hở trợ trực tuyến</li>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                <i class="fa-solid fa-phone mt-3"></i>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Nhân viên tư vấn 1</h6>
                                        <p class="mb-0 opacity-75">Mr. Dương: (09) 85 7813 353</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                <i class="fa-solid fa-phone mt-3"></i>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Nhân viên tư vấn 2</h6>
                                        <p class="mb-0 opacity-75">Mr. Giang: (09) 7890 2345</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                <i class="fa-solid fa-phone mt-3"></i>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Nhân viên tư vấn 3</h6>
                                        <p class="mb-0 opacity-75">Mrs. Hân: (09) 7890 2345</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3">
                                <i class="fa-solid fa-envelope"></i>
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0">Email liên hệ</h6>
                                        <p class="mb-0 opacity-75">nhom3@gmail.com</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="list-group my-3">
                            <?php require_once('views/frontend/mod_listcategory.php') ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <?php foreach ($list_category as $cat) : ?>
                    <?php 
                        $listcatid = array();
                        array_push($listcatid, $cat['Id']);
                        $list_category1 = Category::where([['Parentid','=',$cat['Id']],['Status','=','1']])->orderBy('Orders','asc')->get();
                        if(count($list_category1)!=0)
                        {
                            foreach($list_category1 as $cat1)
                            {
                                array_push($listcatid, $cat1['Id']);
                                $list_category2 = Category::where([['Parentid','=',$cat1['Id']],['Status','=','1']])->orderBy('Orders','asc')->get();
                                if(count($list_category2)!=0)
                                {
                                    foreach($list_category2 as $cat2)
                                    {
                                        array_push($listcatid, $cat2['Id']);
                                    }
                                }
                            }
                        }
                        $list_product = Product::where('Status', '=', '1')
                        ->whereIn('Catid',$listcatid)
                        ->orderBy('CreatedAt','desc')
                        ->take(8)
                        ->get();
                    ?>
                    <h3 class=" py-3 text-center position-relative">
                        <a
                            href="index.php?option=product&cat=<?php echo $cat['Slug']; ?>"><?php echo $cat['Name']; ?></a>
                    </h3>
                    <div class="row text-center my-3">
                        <?php foreach($list_product as $row_product) : ?>
                        <div class="col-md-3 mb-3">
                            <div class="card" style="width: 100%;">
                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                    <img style="width: 100%;"
                                        src="public/images/product/<?php echo $row_product['Img']; ?>"
                                        class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                            <?php echo $row_product['Name']; ?>
                                        </a>
                                    </h5>
                                    <h5 class="text-center text-success">
                                        <?php
                                if ($row_product['Price']>$row_product['Pricesale'])
                                {
                                    echo number_format($row_product['Pricesale']) ."<sup>đ</sup>";

                                    echo "<del class='text-danger'>" .number_format($row_product['Price'])."</del><sup class='text-danger'>đ</sup>";
                                }
                                else {
                                    echo number_format($row_product['Price'])."<sup>đ</sup>";
                                }
                                ?>
                                    </h5>
                                    <div class="row">
                                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                                            <a href="index.php?option=product&id=<?php echo $row_product['Slug'];?>"
                                                class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                            <a href="index.php?option=cart&addcart=<?php echo $row_product['Id'];?>"
                                                class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endforeach ;?>
                </div>

            </div>

        </div>
    </div>
    </div>
</section>
<!--section maincontent-->
<?php require_once('views/frontend/footer.php');?>