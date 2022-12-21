<?php

use App\Models\Slider;

$list = Slider::where('Status', '=', '0')->orderBy('CreatedAt', 'desc')->get();
?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper py-2">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="index.php">Trang quản trị</a></li>
            <li class="breadcrumb-item active"><a href="index.php?option=slider">Silder</a></li>
            <li class="breadcrumb-item active">Thùng rác Slider</li>
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
        <div class="row mb-2">
          <div class="col-md-12 text-right">
            <a href="index.php?option=slider" class="btn btn-sm btn-info">
              <i class="fas fa-undo"></i>Quay về danh sách
            </a>

          </div>
        </div>
      </div>
      <div class="card-body">
        <?php require_once('../views/backend/message_alert.php'); ?>
        <table class="table table-borderd" id="myTable">
          <thead>
            <tr>
              <th class="text-center" >Hình ảnh</th>
              <th>Tên slider</th>
              <th>Vị trí</th>
              <th class="text-center">Chức năng</th>
              <th class="text-center">ID</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($list as $row) : ?>
              <td>
                <img src="../public/images/slider/<?php echo $row['Img']; ?>" class="img-fluid" alt="">
              </td>
              <td><?php echo $row['Name']; ?></td>
              <td><?php echo $row['Position']; ?></td>
              <td class="text-center">

                <a href="index.php?option=slider&cat=detail&id=<?php echo $row['Id']; ?>" title="Chi tiết" class="btn btn-sm btn-primary">
                  <i class="fas fa-eye"></i>
                </a>
                <a href="index.php?option=slider&cat=retrash&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                  <i class="fas fa-undo"></i>
                </a>
                <a href="index.php?option=slider&cat=del&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
              <td class="text-center"><?php echo $row['Id']; ?></td>
          </tbody>
        <?php endforeach; ?>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Foooter
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php'); ?>
<?php require_once('../views/backend/footer.php'); ?>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>