<?php require_once('../views/backend/header.php'); ?>
<?php

use App\Models\Topic;

$list = Topic::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get();
?>

<div class="content-wrapper py-2">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
          <li class="breadcrumb-item active"><a href="index.php?option=topic">Bài viết</a></li>
          <li class="breadcrumb-item active">Tất cả chủ đề bài viết</li>
        </ol>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12 text-right">
            <a href="index.php?option=topic&cat=create" class="btn btn-sm btn-success">
              <i class="fas fa-plus"></i>Thêm
            </a>
            <a href="index.php?option=topic&cat=trash" class="btn btn-sm btn-danger">
              <i class="fas fa-trash"></i>Thùng rác
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php require_once('../views/backend/message_alert.php'); ?>
        <table class="table table-borderd" id="myTable">
          <thead>
            <tr>
              <th>Tên danh mục</th>
              <th>Slug</th>
              <th class="text-center">Chức năng</th>
              <th class="text-center">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <tr>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Slug']; ?></td>
                <td class="text-center">
                  <?php if ($row['Status'] == 1) : ?>
                    <a href="index.php?option=topic&cat=status&id=<?php echo $row['Id']; ?>" title="Trạng thái" class="btn btn-sm btn-success">
                      <i class="fas fa-toggle-on"></i>
                    </a>
                  <?php else : ?>
                    <a href="index.php?option=topic&cat=status&id=<?php echo $row['Id']; ?>" title="Trạng thái" class="btn btn-sm btn-danger">
                      <i class="fas fa-toggle-off"></i>
                    </a>
                  <?php endif; ?>
                  <a href="index.php?option=topic&cat=detail&id=<?php echo $row['Id']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i>
                  </a>
                  <a href="index.php?option=topic&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="index.php?option=topic&cat=deltrash&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
                <td class="text-center"><?php echo $row['Id']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->

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