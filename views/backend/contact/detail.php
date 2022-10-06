<?php
use App\models\Contact;
$id=$_REQUEST['id'];
$row=Contact::find($id);
if($row==null){
  header("location:index.php?option=contact");
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
            <h1>Chi tiết bài viết</h1>
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
                  <a href="index.php?option=contact" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
                  <a href="index.php?option=contact&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=contact&cat=deltrash&id=<?php echo $rows['Id'];?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                <i class="fas fa-trash"></i>
                    </a>
              </div>
          </div>
</div>
          <div class="card-body">
          <table class="table table-boadered" id="myTable">
             <tr>
               <th>Mã liên hệ</th>
               <td><?php echo$row['Id'];?></td>
             </tr>
             <tr>
               <th>MÃ người dùng</th>
               <td><?php echo$row['UserId'];?></td>
             </tr>
             <tr>
               <th>Họ và têm</th>
               <td><?php echo $row['FullName'];?></td>
             </tr>
             <tr>
               <th>Email</th>
               <td><?php echo $row['Email'];?></td>
             </tr>
             <tr>
               <th>Điện thoại</th>
               <td><?php echo $row['Phone'];?></td>
             </tr>
             <tr>
               <th>Tiêu đề</th>
               <td><?php echo $row['Title'];?></td>
             </tr>
             <tr>
               <th>Chi tiết</th>
               <td><?php echo $row['Detail'];?></td>
             </tr>
             <tr>
               <th>Mã trả lời</th>
               <td><?php echo $row['ReplyId'];?></td>
             </tr>
             <tr>
               <th>Nội dung trả lời</th>
               <td><?php echo $row['ReplyDetail'];?></td>
             </tr>
             <tr>
               <th>Ngày Liên hệ</th>
               <td><?php echo $row['CreatedAt'];?></td>
             </tr>
             <tr>
               <th>Ngày trả lời</th>
               <td><?php echo $row['UpdatedAt'];?></td>
             </tr>
             <tr>
               <th>Người trả lời</th>
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
                  <a href="index.php?option=contact" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
                  <a href="index.php?option=contact&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật" class="btn btn-sm btn-info">
                <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?option=contact&cat=deltrash&id=<?php echo $rows['Id'];?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
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
