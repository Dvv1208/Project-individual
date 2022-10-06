<?php 
use App\Models\Post;
use App\Models\Category;
use App\Libraries\Pagination;

$slug = $_REQUEST['id'];
$row_post = Post::where([['Slug', '=', $slug],['Status', '=', '1']])->first();
$title = $row_post['Title'];
$metakey = $row_post['Metakey'];
$metadesc = $row_post['Metadesc'];

$listpostid = array();
array_push($listpostid, $row_post['Type']);
$list_post1 = Post::where([['Type','=',$row_post['Type']],['Status','=','1']])->get();
if(count($list_post1)!=0)
{
    foreach($list_post1 as $post1)
    {
        array_push($listpostid, $post1['Type']);
    }
}
$limit = 3;
$page = Pagination::pageCurrent();
$skip = Pagination::pageOffset($page,$limit);
$total = Post::where('Status', '=', '1')->count();



$list_post = Post::where('Status', '=', '1')
    ->whereIn('Id',$listpostid)
    ->where('Id', '!=', $row_post['Id'])
    ->take($limit)
    ->get();
?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <div class="container my-3">

        <div class="row">
            <div class="col-md-6 col-lg-6">
                <img src="public/images/post/<?php echo $row_post['Img']; ?>" class="img-fluid w-100"
                    alt="<?php echo $row_post['Img']; ?>">
            </div>
            <div class="col-md-6 col-lg-6">
                <h3><?php echo $row_post['Title']; ?></h3>

                <h3>Chi tiết bài viết</h3>
                <p><?php echo $row_post['Detail']; ?></p>
                <p>
                <div class="fb-like" data-href="index.php?option=post&id=<?php echo $slug; ?>" data-width=""
                    data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="fb-comments" data-href="index.php?option=post&id=<?php echo $slug; ?>" data-width="100%"
                    data-numposts="5"></div>
            </div>
        </div>
        <!--end row-->
        <div class="div my-3">
            <h3>BÀI VIẾT KHÁC</h3>
            <div class="product_category my-3">
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
</section>
<?php require_once('views/frontend/footer.php');?>