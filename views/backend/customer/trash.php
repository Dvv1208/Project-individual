<?php
use App\Models\Customer;
$list=Customer::where('Status','=','0')->orderBy('CreatedAt','desc')->get();
?>
<?php require_once('../views/backend/header.php');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thùng rác khách hàng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Thùng rác khách hàng</li>
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
                  <a href="index.php?option=customer" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
              </div>
          </div>
         
        <div class="card-body">
        <?php require_once('../views/backend/message_alert.php');?>
          <table class="table table-boadered" id="myTable">
          <thead>
               <th style="width:20px" class="text-center">
               <input type="checkbox" name="checkALL">
</th>
                <th>Mã khách hàng</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Giới tính</th>
                <th>Điện thoại</th>
                <th>Ngày tạo</th>
                <th>Người tạo</th>
                <th>Ngày sửa</th>
                <th>Người sửa</th>
                <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $rows):?>
                  <td><input type="checkbox" name="checkId[]"></td>
                    <td><?php echo $rows['Id']?>"</td>
                    <td><?php echo$rows['FullName']?></td>
                    <td><?php echo$rows['Email']?></td>
                    <td>
                      <?php if($rows['Gender']==1):?>
                        <?php echo "Nam"?>
                      <?php else:if($rows['Gender']==2):?>
                        <?php echo "Nữ"?>
                      <?php else:?>
                        <?php echo "Khác"?>
                        <?php endif;?>
                      <?php endif;?>
                    </td>
                    <td><?php echo$rows['Phone']?></td>
                    <td><?php echo$rows['CreatedAt']?></td>
                    <td><?php echo$rows['CreatedBy']?></td>
                    <td><?php echo$rows['UpdatedAt']?></td>
                    <td><?php echo$rows['UpdatedBy']?></td>
                    <td><?php echo$rows['Status']?></td>
                    <td class="text-center">
                    <a href="index.php?option=customer&cat=retrash&id=<?php echo $rows['Id'];?>" title="Khôi phục" class="btn btn-sm btn-primary">
                <i class="fas fa-undo"></i>
                    </a>
                      <a href="index.php?option=customer&cat=detail&id=<?php echo $rows['Id'];?>" title="Chi tiết" class="btn btn-sm btn-primary">
                <i class="fas fa-eye"></i>
                    </a>
                    <a href="index.php?option=customer&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=customer&cat=del&id=<?php echo $rows['Id'];?>" title="Xóa" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                    </a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
          </table>
        </div>
          <!-- /.card-body -->
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once('../views/backend/footer.php');?>
  <Script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
  </Script>
