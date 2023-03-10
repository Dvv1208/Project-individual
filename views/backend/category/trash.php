<?php

use App\Models\Category;
use App\Libraries\MyClass;

$list = Category::where('Status', '=', '0')->orderBy('CreatedAt', 'desc')->get();
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
                        <li class="breadcrumb-item active"><a href="index.php?option=category">Danh mục</a></li>
                        <li class="breadcrumb-item active">Thùng rác danh mục</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="row">
                <div class="col-12 text-right">
                    <a href="index.php?option=category" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại
                        danh sách
                    </a>
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
                            <th style="width:90px" class="text-center">#</th>
                            <th class="text-center">Tên danh mục</th>
                            <th class="text-center">Danh mục sản phẩm</th>
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
                                <td class="text-center"><?php echo $row['Slug']; ?></td>
                                <td class="text-center"><?php echo $row['Name']; ?></td>
                                <td class="text-center"><?php echo $row['Slug']; ?></td>
                                <td class="text-center"><?php echo $row['CreatedAt']; ?></td>
                                <td class="text-center">

                                    <a href="index.php?option=category&cat=detail&id=<?php echo $row['Id']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="index.php?option=category&cat=retrash&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                                        <i class="fas fa-undo"></i>
                                    </a>

                                    <a href="index.php?option=category&cat=del&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                                <td><?php echo $row['Id']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>