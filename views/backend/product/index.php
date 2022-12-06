<?php

use App\Models\Product;
use App\Libraries\MyClass;
use App\Models\ProductsImages;

$list = Product::where('Status', '!=', '0')->with('images')->orderBy('CreatedAt', 'desc')->get();

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
                        <li class="breadcrumb-item active"><a href="index.php?option=product">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Tất cả sản phẩm</li>
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
                        <a href="index.php?option=product&cat=create" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Thêm
                        </a>
                        <a href="index.php?option=product&cat=trash" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php include_once('../views/backend/message_alert.php'); ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px" class="text-center">
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th class="text-center">Hình</th>
                            <th class="text-center">Tên sản phẩm</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Chức năng</th>
                            <th style="width:20px" class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="checkId[]">
                                </td>
                                <td class="text-center">
                                    <img style="width:200px" src="../public/images/product/<?php echo $row['Img']; ?>" alt="<?php echo $row['Img']; ?>">
                                </td>
                                <!-- <td class="text-center">
                                    <?php foreach ($row->images as $pro) : ?>
                                        <div class="slider">
                                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php $index = 1; ?>
                                                    <?php if ($index == 1) : ?>
                                                        <div class="carousel-item active" style="display:inline-block">
                                                            <img style="width:200px" src="../public/images/product/<?php echo $pro->ImgId; ?>" alt="<?php echo $pro->ImgId; ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php $index++; ?>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </td> -->
                                <td class="text-center"><?php echo $row['Name']; ?></td>
                                <td class="text-center"><?php echo $row['Slug']; ?></td>
                                <td class="text-center"><?php echo $row['CreatedAt']; ?></td>
                                <td class="text-center">
                                    <?php if ($row['Status'] == 1) : ?>
                                        <a href="index.php?option=product&cat=status&id=<?php echo $row['Id']; ?>" title="Trạng thái" class="btn btn-sm btn-success">
                                            <i class="fas fa-toggle-on"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="index.php?option=product&cat=status&id=<?php echo $row['Id']; ?>" title="Trạng thái" class="btn btn-sm btn-danger">
                                            <i class="fas fa-toggle-off"></i>
                                        </a>
                                    <?php endif; ?>
                                    <a href="index.php?option=product&cat=detail&id=<?php echo $row['Id']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="index.php?option=product&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="index.php?option=product&cat=deltrash&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <td><?php echo $row['Id']; ?></td>
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