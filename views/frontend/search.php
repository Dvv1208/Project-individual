<?php

use App\Models\Product;
use App\Models\Post;

$keyword='';
if(isset($_REQUEST['keyword']))
{
	$keyword=$_REQUEST['keyword'];
}

$product = Product::where('Status', '!=', '0')->orderBy('CreatedAt','desc')->get()->toArray();
$post = Post::where('Status', '!=', '0')->orderBy('CreatedAt','desc')->get();

$list_product = Product::find($keyword);
// $list_post = Post::where('Name','=',$keyword)->find($keyword);
$title='Tìm kiếm';

?>
<?php require_once('views/frontend/header.php'); ?>

<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title;?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="clearfix maincontent">
    <div class="row">
        <div class="col-md-9">
            <div class="row mt-3">
                <div class="col">
                    <div class="area alert-info">Kết quả tìm kiếm "<?php echo $keyword;?>" là: 
                        <!-- <?php echo (count($list_product)+count($list_post)) ?> -->
                    </div>
                </div>
            </div>
            <?php foreach($list_product as $p):?>
            <div class="row mb-3 border">
                <div class="col-md-2 ">
                    <a href="index.php?option=product&id=<?php echo $p['Slug'];?>">
                        <img src="public/images/product/<?php echo $p['Img'];?>" class="img-fluid" alt="Hinh">
                    </a>
                </div>
                <div class="col-md-10">
                    <h3><a href="index.php?option=product&id=<?php echo $p['Slug'];?>"><?php echo $p['Name'];?></a>
                    </h3>
                </div>
            </div>
            <?php endforeach; ?>
            <?php foreach($list_post as $post):?>
            <div class="row mb-3 border">
                <div class="col-md-2 ">
                    <a href="index.php?option=post&id=<?php echo $ppst['Slug'];?>">
                        <img src="public/images/post/<?php echo $post['Img'];?>" class="img-fluid" alt="Hinh">
                    </a>
                </div>
                <div class="col-md-10">
                    <h3><a href="index.php?option=post&id=<?php echo $post['Slug'];?>"><?php echo $post['Title'];?></a>
                    </h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-3">
            <h3>DANH MỤC SẢN PHẨM</h3>
            <?php require_once('views/frontend/mod_listcategory.php'); ?>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>