<?php 
use App\Models\Post;
use App\Libraries\Pagination;

$title = 'Tất cả bài viết';

$limit = 2;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page,$limit);
$list_post = Post::where('Status', '=', '1')
    ->orderBy('CreatedAt','desc')->skip($skip)->take($limit)
    ->get();
    
$total = Post::where('Status', '=', '1')->count();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <?php require_once('views/frontend/mod_slider.php'); ?>
    <div class="row">
        <div class="col-md-3">
            <?php require_once('views/frontend/mod_listpost.php'); ?>
        </div>
        <div class="col-md-9">
            <div class="container">
                <div class="product_category my-3">
                    <h3 class="my-3 text-light text-center bg-mainmenu">
                        <?php echo $title; ?>
                    </h3>
                    <?php foreach($list_post as $row_post) : ?>
                    <div class="card mb-3" style="text-center">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="public/images/post/<?php echo $row_post['Img']; ?>"
                                    class="img-fluid rounded-start" alt="<?php echo $row_post['Title']; ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="index.php?option=post&id=<?php echo $row_post['Slug']; ?>">
                                        <h5 class="card-title"><?php echo $row_post['Title'];?></h5>
                                    </a>
                                    <p class="card-text"><?php echo $row_post['Detail'];?></p>
                                    <p class="card-text"><small class="text-muted">Ngày đăng:
                                            <?php echo $row_post['CreatedAt'];?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                    <div><?=Pagination::pageLinks($total, $page, $limit,'index.php?option=post');?></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php');?>