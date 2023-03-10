<?php

use App\Models\Category;


$id = $_REQUEST["id"];
$row = Category::find($id);
if ($row == null) {
  header("location:index.php?option=category");
}

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
            <li class="breadcrumb-item active">Chi tiết danh mục</li>
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
          <a href="index.php?option=category" class="btn btn-sm btn-info"><i class="fas fa-undo"></i> Quay lại danh sách
          </a>
          <a href="index.php?option=category&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
            <i class="fas fa-edit">Sửa</i>
          </a>
          <a href="index.php?option=category&cat=deltrash&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
            <i class="fas fa-trash">Xóa</i>
          </a>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="myTable">
          <tr>
            <th class="text-center">Slug sản phẩm</th>
            <th class="text-center">Tên danh mục</th>
            <th class="text-center">Từ khóa SEO</th>
            <th class="text-center">Mô tả SEO</th>
            <th class="text-center">Ngày tạo</th>
            <th class="text-center">Ngày sửa</th>
            <th style="width:20px" class="text-center">ID</th>
          </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center"><?php echo $row['Slug']; ?></td>
              <td class="text-center"><?php echo $row['Name']; ?></td>
              <td class="text-center"><?php echo $row['MetaKey']; ?></td>
              <td class="text-center"><?php echo $row['MetaDesc']; ?></td>
              <td class="text-center"><?php echo $row['CreatedAt']; ?></td>
              <td class="text-center"><?php echo $row['UpdatedAt']; ?></td>
              <td><?php echo $row['Id']; ?></td>
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
<?php require_once('../views/backend/footer.php'); ?>