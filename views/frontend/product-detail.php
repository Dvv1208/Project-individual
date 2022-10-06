<?php 
use App\Models\Product;
use App\Models\Category;
use App\Libraries\Pagination;

$slug = $_REQUEST['id'];

$row_pro = Product::where([['Slug', '=', $slug],['Status', '=', '1']])->first();
$title = $row_pro['Name'];
$metakey = $row_pro['Metakey'];
$metadesc = $row_pro['Metadesc'];

$listcatid = array();
array_push($listcatid, $row_pro['Catid']);
$list_category1 = Category::where([['Parentid','=',$row_pro['Catid']],['Status','=','1']])->orderBy('Orders','asc')->get();
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
    ->where('Id', '!=', $row_pro['Id'])
    ->orderBy('CreatedAt','desc')->take(8)
    ->get();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <div class="container my-3">

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <img src="public/images/product/<?php echo $row_pro['Img']; ?>" class="img-fluid w-100"
                    alt="<?php echo $row_pro['Img']; ?>">
            </div>
            <div class="col-md-6 col-lg-6">
                <h3><?php echo $row_pro['Name']; ?></h3>
                <h5>Giá:
                    <del><strong class="text-success">
                            <?php echo number_format($row_pro['Price']); ?> <sup>đ</sup>
                        </strong>
                    </del>
                </h5>
                <h5>Giá sale:
                    <span class="text-danger">
                        <?php echo number_format($row_pro['Pricesale']); ?>
                    </span><sup>đ</sup>
                </h5>
                <div class="input-group input-group-sm mb-3">
                    <input type="number" name="qty" value="1" min="1" style="width:100px"
                        aria-describedby="basic-addon2">

                    <a href="index.php?option=cart&addcart=<?php echo $row_pro['Id'];?>"
                        class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Thêm vào giỏ hàng</a>

                </div>
                <div class="rating-wrap my-3">
                    <ul class="rating-stars">
                        <li style="width:80%" class="stars-active">
                            <i class="fas fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fas fa-star"></i> <i class="fa fa-star"></i>
                            <i class="fas fa-star"></i>
                        </li>
                        <small class="label-rating text-muted">132 Đánh giá</small>
                        <small class="label-rating text-success"> <i class="fa fa-clipboard-check"></i> 154 đơn đặt hàng
                        </small>
                    </ul>

                </div>

                <h3>Chi tiết sản phẩm</h3>
                <p><?php echo $row_pro['Detail']; ?></p>
                <p>
                <div class="fb-like" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width=""
                    data-layout="standard" data-action="like" data-size="small" data-share="true">
                </div>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="fb-comments" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="100%"
                    data-numposts="5">
                </div>
            </div>
        </div>
        <!--end row-->
        <div class="div my-3">
            <h3>SẢN PHẨM CÙNG LOẠI</h3>
            <div class="row my-3">
                <?php foreach ($list_product as $row_product) : ?>
                <div class="col-md-3">
                    <div class="card" style="width: 100%;">
                        <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                            <img src="public/images/product/<?php echo $row_product['Img']; ?>" class="card-img-top"
                                alt="<?php echo $row_product['Img']; ?>">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title text-center ">
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
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php');?>