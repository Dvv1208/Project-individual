<?php

use App\Models\Page;
use App\Libraries\MyClass;

$list = Page::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get();

?>

<?php require_once('../views/backend/header.php');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tất cả trang đơn</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả trang đơn</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="index.php?option=page&cat=create" class="btn btn-sm btn-success"><i
                                class="fas fa-plus"></i> Thêm
                        </a>
                        <a href="index.php?option=page&cat=trash" class="btn btn-sm btn-danger"><i
                                class="fas fa-trash"></i> Thùng rác
                        </a>
                    </div>
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
                            <th class="text-center">Hình</th>
                            <th class="text-center">Tiêu đề bài viết</th>
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
                                <img style="width:200px" src="../public/images/page/<?php echo $row['Img'];?>" alt="<?php echo $row['Img'];?>">
                            </td>
                            <td class="text-center"><?php echo $row['Title'];?></td>                        
                            <td class="text-center">
                                <?php if($row['Status']==1):?>
                                <a href="index.php?option=page&cat=status&id=<?php echo $row['Id'];?>"
                                    title="Trạng thái" class="btn btn-sm btn-success">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                <?php else:?>
                                <a href="index.php?option=page&cat=status&id=<?php echo $row['Id'];?>"
                                    title="Trạng thái" class="btn btn-sm btn-danger">
                                    <i class="fas fa-toggle-off"></i>
                                </a>
                                <?php endif; ?>
                                <a href="index.php?option=page&cat=detail&id=<?php echo $row['Id'];?>"
                                    title="Chi tiết" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="index.php?option=page&cat=edit&id=<?php echo $row['Id'];?>"
                                    title="Cập nhật" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="index.php?option=page&cat=deltrash&id=<?php echo $row['Id'];?>"
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