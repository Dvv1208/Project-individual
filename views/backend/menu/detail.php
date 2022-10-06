<?php

use App\Models\Menu;


$id = $_REQUEST["id"];
$row = Menu::find($id);
if ($row == null){
  header("location:index.php?option=menu");
}

?>

<?php require_once('../views/backend/header.php');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Chi tiết menu</li>
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
                    <a href="index.php?option=menu" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại
                        danh sách
                    </a>
                    <a href="index.php?option=menu&cat=edit&id=<?php echo $row['Id'];?>" title="Cập nhật"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-edit">Sửa</i>
                    </a>
                    <a href="index.php?option=menu&cat=deltrash&id=<?php echo $row['Id'];?>"
                        title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash">Xóa</i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="myTable">
                    <tr>
                        <th class="text-center">Tên menu</th>
                        <th class="text-center">Vị trí</th>
                        <th class="text-center">Loại menu</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th style="width:20px" class="text-center">ID</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center"><?php echo $row['Name'];?></td>
                            <td class="text-center"><?php echo $row['Position'];?></td>
                            <td class="text-center"><?php echo $row['Type'];?></td>
                            <td class="text-center"><?php echo $row['CreatedAt'];?></td>
                            <td class="text-center"><?php echo $row['UpdatedAt'];?></td>
                            <td><?php echo $row['Id'];?></td>
                        </tr>
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