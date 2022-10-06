<?php
use App\Models\Customer;
use App\Libraries\MyClass;
$id=$_REQUEST['id'];
$list=Customer::where('Status','!=','0')->get();
$row=Customer::find($id);
if($row==null)
{
  MyClass::set_flash('message',array('type'=>'danger','msg'=>'Thất bại'));
header("location:index.php?option=customer");
}
$args=array(
  'status'=>'index'
);
?>
<?php require_once('../views/backend/header.php');?>
<form action="index.php?option=customer&cat=process" name="form1" method="post">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật thông tin khách hàng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Cập nhật thông tin khách hàng</li>
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
                <button type="submit" name="CAPNHAT" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Chỉnh sửa]</a>
                </button>
              <a href="index.php?option=customer" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
              </div>
          </div>
</div>
<div class="card-body">
  <?php require_once('../views/backend/message_alert.php');?>
          <div class="row">
          <div class="col-md-9">
              <input name="id" type="hidden" value="<?=$row['Id'];?>" id="id" class="form-control">
            <div class="mb-3">
              <label for="fullname">Họ tên khách hàng</label>
              <input name="data[FullName]" type="text" value="<?=$row['FullName'];?>" id="fullname" placeholder="nhập tên thành viên" class="form-control">
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input name="data[Email]" id="email" rows="5" class="form-control">Email hiện tại: <?=$row['Email'];?>
            </div>
            <div class="mb-3">
              <label for="phone">Điện thoại</label>
              <input name="data[Phone]" id="phone" rows="5" class="form-control">Số điện thoại hiện tại: <?=$row['Phone'];?>
            </div>
</div>
            <div class="col-md-3">
            <div class="mb-3">
              <label for="gender">Giới tính</label>
            <select id="gender" name="gender" class="form-control">
            <option value="0">--Chọn giới tính--</option>
            <option value="1">Nam</option>
              <option value="2">Nữ</option>
              <option value="3">Khác</option>
</select>
              </div>
              <div class="mb-3">
              <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
            <option value="1"<?=($row['Status']==1)?'selected':'';?>>Xuất bản</option>
              <option value="2"<?=($row['Status']==2)?'selected':'';?>>Không xuất bản</option>
</select>
              </div>
            </div>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
              <div class="col-12 text-right">
                <button type="submit" name="CAPNHAT" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[chỉnh sửa]</a>
                </button>
              <a href="index.php?option=customer" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
              </div>
          </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
</form>
  <!-- /.content-wrapper -->
  <?php require_once('../views/backend/footer.php');?>
