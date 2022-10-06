<?php

use App\Models\Order;
use App\Libraries\MyClass;

$list = Order::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get();

?>

<?php require_once('../views/backend/header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh mục Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Tất cả</li>
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
                    <a href="index.php?option=product&cat=create" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Thêm
                    </a>
                </div>
            </div>
        <div class="card-body">
          <table class="table table-bordered" id="myTable">
            <thead>
              <tr>
                <th style="width:20px" class="text-center">
                    <input type="checkbox" name="checkAll">
                </th>
                <th class="text-center">Ngày tạo</th>
                <th class="text-center">Tên người nhận</th>
                <th class="text-center">Điện thoại người nhận</th>
                <th class="text-center">Chức năng</th>
                <th style="width:20px" class="text-center">Id</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $row) : ?>
              <tr>
                  <td>
                      <input type="checkbox" name="checkId[]">
                  </td>
                  <td class="text-center"><?php echo $row['CreatedAt'];?></td>
                  <td class="text-center"><?php echo $row['Name'];?></td>
                  <td class="text-center"><?php echo $row['Phone'];?></td>
                  <td class="text-center">
                  <a href="index.php?option=product&cat=status&id=1" title="Trạng thái" class="btn btn-sm btn-success">
                    <i class="fas fa-toggle-off"></i>
                    <i class="fas fa-toggle-on"></i>
                  </a>

                  <a href="index.php?option=product&cat=detail&id=1" title="Chi tiết" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i>
                  </a>

                  <a href="index.php?option=product&cat=edit&id=1" title="Cập nhật" class="btn btn-sm btn-info">
                    <i class="fas fa-edit"></i>
                  </a>

                  <a href="index.php?option=product&cat=deltrash&id=1" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </a>
                  </td>
                  <td class="text-center"><?php echo $row['Id'];?></td>
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
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>