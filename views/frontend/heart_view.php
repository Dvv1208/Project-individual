<?php

use App\Libraries\Heart;

$title = "Sảm phẩm yêu thích";

?>

<?php require_once('views/frontend/header.php'); ?>
<form action="index.php?option=heart" method="post">
    <section class="breadcrumb p-0 m-0">
        <div class="container">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb my-3">
                        <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="clearfix main mt-2">
        <div class="container my-3 mb-3">
            <div class="row">
                <div class="col-md-9">
                    <h3>SẢN PHẨM YÊU THÍCH</h3>
                    <?php
                    $list_content = Heart::contentHeart();
                    ?>
                    <?php if ($list_content != null) : ?>

                        <table class="table table-borderd">
                            <tr>
                                <th class="text-center" style="width:100px">Hình ảnh</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Thành tiền</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php foreach ($list_content as $rheart) : ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="public/images/product/<?php echo $rheart['Img']; ?>" class="img-fluid" alt="<?php echo $rheart['Img']; ?>">
                                    </td>
                                    <td class="text-center"><?php echo $rheart['Name'] ?></td>
                                    <td class="text-center"><?php echo number_format($rheart['Price'], 0, ',', '.'); ?><sup>đ</sup></td>
                                    <td class="text-center">
                                        <?php echo $rheart['qty'] ?>
                                    </td>
                                    <td class="text-center"><?php echo number_format($rheart['amount'] * $rheart['qty'], 0, ',', '.') ?><sup>đ</sup></td>
                                    <td class="text-center">
                                        <a href="index.php?option=heart&addToCart=<?php echo $rheart['Id'] ?>">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a href="index.php?option=heart&delheart=<?php echo $rheart['Id'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="6">
                                    <a class="btn btn-outline-danger" href="index.php?option=heart&delheart=all">Xóa tất cả</a>
                                </td>
                                <td colspan="2" class="text-end">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a class="btn btn-outline-info" href="index.php">Tiếp tục mua sắm</a>
                                </td>
                                <div class="form-group">
                                    <td colspan="6" class="text-end">
                                        <a class="btn btn-outline-success" href="index.php?option=heart&addToCart=all">Thêm tất cả vào giỏ hàng</a>
                                    </td>
                                </div>
                            </tr>
                        </table>

                    <?php else : ?>
                        BẠN CHƯA CÓ SẢN PHẨM YÊU THÍCH nào
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</form>
<!--section content-->
<?php require_once('views/frontend/footer.php'); ?>