<?php require_once('views/frontend/header.php'); ?>
<?php

use App\Models\Product;
use App\Models\Category;
use App\Libraries\Pagination;
use App\Models\ProductsImages;

$slug = $_REQUEST['id'];

$row_pro = Product::where([['Slug', '=', $slug], ['Status', '=', '1']])->first();
$slugpro = $row_pro['Slug'];
$title = $row_pro['Name'];
$metakey = $row_pro['Metakey'];
$metadesc = $row_pro['Metadesc'];

$listcatid = array();
array_push($listcatid, $row_pro['Catid']);
$list_category1 = Category::where([['Parentid', '=', $row_pro['Catid']], ['Status', '=', '1']])->orderBy('Orders', 'asc')->get();
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
    ->where('Id', '!=', $row_pro['Id'])
    ->orderBy('CreatedAt', 'desc')->take(8)
    ->with('images')
    ->get();
$list_img = ProductsImages::where('proId', '=', $row_pro['Id'])->get();
$imgpro = Product::where('Id', '=', $row_pro['Id'])->with('images')->get();


// foreach ($imgpro as $i) {
//     echo '<pre>';
//     print_r($i->Img);
//     echo '</pre>';
// }


?>

<section class="maincontent">
    <div class="container my-3">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-md-pull-5">
                        <div id="product-imgs">
                            <?php
                            foreach ($imgpro as $i) {
                                echo ("<div class='product-preview'>"
                                    . "<img src='public/images/product/$i->Img' class='img-fluid w-100' alt='$i->Img'>"
                                    . "</div>");
                                if ($i->Id != null) {
                                    foreach ($list_img as $key) {
                                        echo ("<div class='product-preview'>"
                                            . "<img src='public/images/product/images/$key->ImgId' class='img-fluid w-100' alt='$key->ImgId'> "
                                            . "</div>");
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-push-2">
                        <div id="product-main-img" style="width: 498px;">
                            <?php
                            foreach ($imgpro as $i) {
                                echo ("<div class='product-preview'>"
                                    . "<img src='public/images/product/$i->Img' class='img-fluid w-100' alt='$i->Img'>"
                                    . "</div>");
                                if ($i->Id != null) {
                                    foreach ($list_img as $key) {
                                        echo ("<div class='product-preview'>"
                                            . "<img src='public/images/product/images/$key->ImgId' class='img-fluid w-100' alt='$key->ImgId'> "
                                            . "</div>");
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name"><?php echo $row_pro['Name']; ?></h2>
                            <div>
                                <div class="product-rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                                <a style="text-decoration: none" class="review-link" href="#">10 lượt đánh giá | Thêm đánh giá của bạn</a>
                            </div>
                            <div>
                                <h5 class="product-price"><?php echo number_format($row_pro['Pricesale'], 0, ',', '.') . "<sup>đ</sup>"; ?>
                                    <del class="product-old-price"><?php echo number_format($row_pro['Price'], 0, ',', '.') . "<sup>đ</sup>"; ?></del>
                                </h5>
                            </div>
                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Số lượng
                                    <div class="input-number">
                                        <input type="number" value="1" min="1">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div><br><br>
                                <ul class="product-btns" role="group" aria-label="Basic example">
                                    <li>
                                        <a href="index.php?option=heart&addheart=<?php echo $row_pro['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> Thêm vào yêu thích</a>
                                    </li>
                                    <li>
                                        <a href="index.php?option=cart&addcart=<?php echo $row_pro['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="product-links">
                                <li><label>Chia sẻ: </label></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i></a></li>
                            </ul>
                        </div>
                        <br>
                        <h5>Chi tiết sản phẩm</h5>
                        <p><?php echo $row_pro['Detail']; ?></p>
                        <!-- <p>
                        <div class="fb-like" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true">
                        </div>
                        </p> -->
                    </div>

                    <!-- <div class="row">
                        <div class="col-12">
                            <div class="fb-comments" data-href="index.php?option=product&id=<?php echo $slug; ?>" data-width="100%" data-numposts="5">
                            </div>
                        </div>
                    </div> -->
                    <!--end row-->

                    <div class="col-md-12">
                        <div id="product-tab">
                            <ul class="tab-nav">
                                <li class="active"><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabDetail')" type="button">Chi tiết sản phẩm</a></li>
                                <li><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabMetadesc')" type="button">Mô tả sản phẩm</a></li>
                                <li><a style="text-decoration: none" data-toggle="tab" class="tablinks" onclick="openTab(event, 'tabVote')" type="button">Đánh giá sản phẩm</a></li>
                            </ul>
                            <div id="tabDetail" class="tabcontent" style="display:block">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p><?php echo $row_pro['Detail']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="tabMetadesc" class="tabcontent">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p><?php echo $row_pro['Metadesc']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="tabVote" class="tabcontent">
                                <div class="row mb-3">
                                    <!-- Rating -->
                                    <div class="col-md-3 text-center">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span id="average_rating">0.0</span> / 5
                                                <div class="rating-stars">
                                                    <i class="fas fa-star text-warning star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star text-warning star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star text-warning star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star text-warning star-light mr-1 main_star"></i>
                                                    <i class="fas fa-star text-warning star-light mr-1 main_star"></i>
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                <li>
                                                    <div class="rating-stars">
                                                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    (<span id="total_five_star_review">0</span>)
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    (<span id="total_four_star_review">0</span>)
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    (<span id="total_three_star_review">0</span>)
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    (<span id="total_two_star_review">0</span>)
                                                </li>
                                                <li>
                                                    <div class="rating-stars">
                                                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                                                    </div>
                                                    <div class="rating-progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                    (<span id="total_one_star_review">0</span>)
                                                </li>
                                            </ul>
                                            <span id="total_review">0</span> Đánh giá
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                <li>
                                                    <!-- <div class="review-heading">
                                                        <h5 class="name">John</h5>
                                                        <p class="date">27 DEC 2018, 8:0 PM</p>
                                                        <div class="review-rating">
                                                            <i class="fas fa-star text-warning"></i>
                                                            <i class="fas fa-star text-warning"></i>
                                                            <i class="fas fa-star text-warning"></i>
                                                            <i class="fas fa-star text-warning"></i>
                                                            <i class="fas fa-star text-warning empty"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                    </div> -->
                                                    <p>Sản phẩm của bạn chưa có đánh giá nào</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-md-3 text-center">
                                        <h5><span class="mt-4 mb-3">Viết đánh giá của bạn ở đây</span></h5>
                                        <button type="button" name="add_review" id="add_review" class="btn btn-outline-success">Đánh giá</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="container my-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="newsletter">
                                        <h3>SẢN PHẨM CÙNG LOẠI</h3>
                                        <div class="products-tabs">
                                            <div class="products-slick" data-nav="#slick-nav-1">
                                                <?php foreach ($list_product as $row_product) : ?>
                                                    <div class="product">
                                                        <div class="product-img">
                                                            <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>">
                                                                <img src="public/images/product/<?php echo $row_product['Img']; ?>" class="card-img-top" alt="<?php echo $row_product['Img']; ?>">
                                                            </a>
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
                                                                <a href="index.php?option=heart&addheart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-danger"><i class="fas fa-heart"></i> </a>
                                                                <a href="index.php?option=cart&addcart=<?php echo $row_product['Id']; ?>" class="btn btn-outline-info"><i class="fas fa-shopping-cart"></i> </a>
                                                                <a href="index.php?option=product&id=<?php echo $row_product['Slug']; ?>" class="btn btn-outline-success"><i class="far fa-eye"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
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
                </div>
            </div>
        </div>
</section>
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gửi đánh giá</h5>
            </div>
            <div id="review-form">
                <form class="review-form">
                    <div class="modal-body">
                        <div class="input-rating text-center">
                            <div class="stars">
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                                <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Nhập tên của bạn" />
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="pro_id" id="pro_id" class="form-control" value="<?php echo $row_pro['Id']; ?>" />
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Nhập đánh giá của bạn"></textarea>
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <a type="button" id="save_review" name="save_review" class="btn btn-outline-danger" style="text-decoration: none">Gửi</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once('views/frontend/footer.php'); ?>
<link type="text/css" rel="stylesheet" href="public/home/css/slick.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/slick-theme.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/nouislider.min.css" />
<link type="text/css" rel="stylesheet" href="public/home/css/style.css" />
<script src="public/home/js/jquery.min.js"></script>
<script src="public/home/js/slick.min.js"></script>
<script src="public/home/js/nouislider.min.js"></script>
<script src="public/home/js/jquery.zoom.min.js"></script>
<script src="public/home/js/main.js"></script>
<script src="public/home/js/bootstrap.min.js"></script>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }
        document.getElementById(tabName).style.display = " block";
        evt.currentTarget.className += " active";
    }
</script>
<style>
    .tabcontent {
        display: none;
    }
</style>
<script>
    var rating_data = 0;

    $('#add_review').click(function() {

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function() {

        var rating = $(this).data('rating');

        reset_background();

        for (var count = 1; count <= rating; count++) {

            $('#submit_star_' + count).addClass('text-warning');

        }

    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function() {

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function() {

        var user_name = $('#user_name').val();

        var pro_id = $('#pro_id').val();

        var user_review = $('#user_review').val();

        if (user_name == '' || user_review == '') {
            alert("Please Fill Both Field");
            return false;
        } else {
            $.ajax({
                url: "index.php?option=product-reviews",
                method: "POST",
                data: {
                    rating_data: rating_data,
                    pro_id: pro_id,
                    user_name: user_name,
                    user_review: user_review
                },
                success: function(data) {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });
    load_rating_data();

    function load_rating_data() {
        $.ajax({
            url: "index.php?option=product-reviews",
            method: "POST",
            data: {
                action: 'load_data'
            },
            dataType: "JSON",
            success: function(data) {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function() {
                    count_star++;
                    if (Math.ceil(data.average_rating) >= count_star) {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                if (data.review_data.length > 0) {
                    var html = '';

                    for (var count = 0; count < data.review_data.length; count++) {
                        html += '<div class="row mb-3">';
                        html += '<div class="col-md-12">';
                        html += '<div id="reviews">';
                        html += '<ul class="reviews">';
                        html += '<li>';
                        html += '<div class="review-heading">';
                        html += '<h5 class="name"> ' + data.review_data[count].user_name + '</h5>';
                        html += '<p class="date"> ' + data.review_data[count].datetime + ' </p>';
                        html += '<div class="review-rating">';
                        for (var star = 1; star <= 5; star++) {
                            var class_name = '';

                            if (data.review_data[count].rating >= star) {
                                class_name = 'text-warning';
                            } else {
                                class_name = 'star-light';
                            }
                            html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '<div class="review-body">';
                        html += '<p>' + data.review_data[count].user_review + '</p>';
                        html += '</div>';
                        html += '</li>';
                        html += '</ul>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    }

                    $('#reviews').html(html);
                }
            }
        })
    }
</script>