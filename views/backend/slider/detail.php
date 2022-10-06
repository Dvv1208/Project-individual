<?php 
use App\Models\Slider;

$id=$_REQUEST['id'];
$row =Slider::find($id);

if($row==null){
  header("location:index.php?option=slider");
}


?>
<?php require_once('../views/backend/header.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chi tiết slider</h1>
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
          <div class="row mb-2">
            <div class="col-md-12 text-right">
              <a href="index.php?option=slider" class="btn btn-sm btn-info">
                      <i class="fas fa-undo"></i>Quay về danh sách
              </a>
              <a href="index.php?option=slider&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                     <i class="fas fa-edit"></i>Sữa
              </a>
              <a href="index.php?option=slider&cat=deltrash&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i>Xóa
              </a>
      
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-borderd" id="myTable">
           <tr>
              <th>Tên trường</th>
              <td>Giá trị</td>
            </tr>
            <tr>
              <th>Id</th>
              <td><?php echo $row['Id'];?></td>
            </tr>
            <tr>
              <th>Tên slider</th>
              <td><?php echo $row['Name'];?></td>
            </tr>
            <tr>
              <th>Liên kết</th>
              <td><?php echo $row['Link'];?></td>
            </tr>
            <tr>
              <th>Vị Trí</th>
              <td><?php echo $row['Position'];?></td>
            </tr>
            <tr>
              <th>Hình ảnh</th>
              <td><?php echo $row['Img'];?></td>
            </tr>
            <tr>
              <th>Sắp xếp</th>
              <td><?php echo $row['Orders'];?></td>
            </tr>
            <tr>
              <th>Ngày tạo</th>
              <td><?php echo $row['CreatedAt'];?></td>
            </tr>
            <tr>
              <th>Ngày sửa</th>
              <td><?php echo $row['CreatedBy'];?></td>
            </tr>
            <tr>
              <th>Người tạo</th>
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
          <div class="row mb-2">
            <div class="col-md-12 text-right">
              <a href="index.php?option=slider" class="btn btn-sm btn-info">
                      <i class="fas fa-undo"></i>Quay về danh sách
              </a>
              <a href="index.php?option=slider&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật" class="btn btn-sm btn-info">
                     <i class="fas fa-edit"></i>Sữa
              </a>
              <a href="index.php?option=slider&cat=deltrash&id=<?php echo $row['Id']; ?>" title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                      <i class="fas fa-trash"></i>Xóa
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
  <?php require_once('../views/backend/footer.php');?>
