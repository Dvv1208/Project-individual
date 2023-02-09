<?php

use App\Models\Reviews;
use App\Libraries\MyClass;
use App\Models\ProductsImages;

$list = Reviews::orderBy('review_id', 'desc')->get();

?>

<?php require_once('../views/backend/header.php'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
                        <li class="breadcrumb-item active"><a href="index.php?option=review">Đánh giá</a></li>
                        <li class="breadcrumb-item active">Tất cả đánh giá</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="index.php?option=review&cat=create" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Thêm
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php include_once('../views/backend/message_alert.php'); ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px;" class="text-center">Id</th>
                            <th style="width:60px;" class="text-center">Mã sản phẩm</th>
                            <th class="text-center">Tên người đánh giá</th>
                            <th class="text-center">Xếp hạng người dùng</th>
                            <th style="width:300px;" class="text-center">Đánh giá người dùng</th>
                            <th class="text-center">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td class="text-center"><?php echo $row['review_id']; ?></td>
                                <td class="text-center"><?php echo $row['pro_id']; ?></td>
                                <td class="text-center"><?php echo $row['user_name']; ?></td>
                                <td class="text-center"><?php echo $row['user_rating']; ?></td>
                                <td class="text-center"><?php echo $row['user_review']; ?></td>
                                <td class="text-center">
                                    <a href="index.php?option=review&cat=detail&id=<?php echo $row['review_id']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="index.php?option=review&cat=edit&id=<?php echo $row['review_id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php require_once('../views/backend/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>