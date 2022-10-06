<?php
use App\models\User;
$id=$_REQUEST['id'];
$row=User::find($id);
if($row==null){
  header("location:index.php?option=user");
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
            <h1>Chi tiết tài khoản</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Chi tiết</li>
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
                  <a href="index.php?option=user" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
                  <a href="index.php?option=user&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=user&cat=deltrash&id=<?php echo $rows['Id'];?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                    </a>
              </div>
          </div>
</div>
          <div class="card-body">
          <table class="table table-boadered" id="myTable">
             <tr>
               <th>Mã tài khoản</th>
               <td><?php echo$row['Id'];?></td>
             </tr>
             <tr>
               <th>Họ và tên</th>
               <td><?php echo$row['FullName'];?></td>
             </tr>
             <tr>
               <th>Tên đăng nhập</th>
               <td><?php echo $row['UserName'];?></td>
             </tr>
             <tr>
               <th>Mật khẩu</th>
               <td><?php echo $row['Password'];?></td>
             </tr>
             <tr>
               <th>Email</th>
               <td><?php echo $row['Email'];?></td>
             </tr>
             <tr>
               <th>Giới tính</th>
               <td><?php echo $row['Gender'];?></td>
             </tr>
             <tr>
               <th>Điện thoại</th>
               <td><?php echo $row['Phone'];?></td>
             </tr>
             <tr>
               <th>Hình</th>
               <td><?php echo $row['Img'];?></td>
             </tr>
             <tr>
               <th>Quyền truy cập</th>
               <td>
                <?php if($row['Roles']==1):?>
                  <?php echo "Administrator"?>
                <?php else:?>
                  <?php echo "Editor"?>
                <?php endif;?>
               </td>
             </tr>
             <tr>
               <th>Ngày tạo</th>
               <td><?php echo $row['CreatedAt'];?></td>
             </tr>
             <tr>
               <th>Người tạo</th>
               <td><?php echo $row['CreatedBy'];?></td>
             </tr>
             <tr>
               <th>Ngày sửa</th>
               <td><?php echo $row['UpdatedAt'];?></td>
             </tr>
             <tr>
               <th>Người sửa</th>
               <td><?php echo $row['UpdatedBy'];?></td>
             </tr>
             <tr>
               <th>Trạng thái</th>
               <td><?php echo $row['Status'];?></td>
             </tr>
          </table>
        </div>
        <div class="card-footer">
          <div class="row">
              <div class="col-12 text-right">
                  <a href="index.php?option=user" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
                  <a href="index.php?option=user&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=user&cat=deltrash&id=<?php echo $rows['Id'];?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                    </a>
              </div>
          </div>
</div>
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once('../views/backend/footer.php');?>
