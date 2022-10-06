<?php

use App\Models\Product;
use App\Libraries\MyClass;

$list = Product::where('Status', '=', '0')->orderBy('CreatedAt', 'desc')->get();
?>

<?php require_once('../views/backend/header.php');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
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
                    <a href="index.php?option=product" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại
                        danh sách
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php if(MyClass::exists_flash('message')): ?>
                <?php
                  $arr_message = MyClass::get_flash('message');
                ?>
                <div class="alert alert-<?= $arr_message['type']; ?>" role="alert">
                    <?php echo $arr_message['msg']; ?>
                </div>
                <?php endif; ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px" class="text-center">
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th style="width:90px" class="text-center">#</th>
                            <th class="text-center">Tên sản phẩm</th>
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
                            <td class="text-center"><?php echo $row['Slug'];?></td>
                            <td class="text-center"><?php echo $row['Name'];?></td>
                            <td class="text-center"><?php echo $row['Slug'];?></td>
                            <td class="text-center"><?php echo $row['CreatedAt'];?></td>
                            <td class="text-center">

                                <a href="index.php?option=product&cat=detail&id=<?php echo $row['Id'];?>"
                                    title="Chi tiết" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="index.php?option=product&cat=retrash&id=<?php echo $row['Id'];?>"
                                    title="Cập nhật" class="btn btn-sm btn-info">
                                    <i class="fas fa-undo"></i>
                                </a>

                                <a href="index.php?option=product&cat=del&id=<?php echo $row['Id'];?>"
                                    title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?php echo $row['Id'];?></td>
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
<?php require_once('../views/backend/footer.php');?>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>