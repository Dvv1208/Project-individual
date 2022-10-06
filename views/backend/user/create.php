<?php
use App\Models\User;
use App\Libraries\MyClass;
$list=User::where('Status','!=','0')->get();
$strparentid="";
$strorders="";
foreach($list as $item)
{
  $strparentid.="<option value='".$item["Id"]."'>".$item["Name"]."</option>";
  $strorders.="<option value='".$item["Orders"]."'>sau".$item["Name"]."></option>";
}
?>
<?php require_once('../views/backend/header.php');?>
<form action="index.php?option=user&cat=process" name="form1" method="post">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm thành viên</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Thêm thành viên</li>
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
                <button type="submit" name="Thêm" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Thêm]</a>
                </button>
              <a href="index.php?option=user" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
              </div>
          </div>
</div>
<div class="card-body">
  <?php require_once('../views/backend/message_alert.php');?>
          <div class="row">
          <div class="col-md-9">
            <div class="mb-3">
              <label for="fullname">Họ tên thành viên</label>
              <input name="data[FullName]" type="text" id="fullname" placeholder="nhập họ và tên" class="form-control">
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input name="data[Email]" id="email" rows="5" class="form-control">
            </div>
            <div class="mb-3">
              <label for="phone">Số điện thoại</label>
              <input name="data[Phone]" id="phone" rows="5" class="form-control">
            </div>
            <div class="mb-3">
              <label for="username">Tên đăng nhập</label>
              <input name="data[UserName]" id="username" rows="5" class="form-control">
            </div>
            <div class="mb-3">
              <label for="password">Mật khẩu</label>
              <input name="data[Password]" id="password" rows="5" class="form-control">
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
              <label for="roles">Xét quyền</label>
            <select id="roles" name="roles" class="form-control">
            <option value="0">--Chọn quyền--</option>
            <option value="1">Administrator</option>
              <option value="2">Editor</option>
</select>
              </div>
              <div class="mb-3">
              <label for="status">Trạng thái</label>
            <select id="status" name="status" class="form-control">
            <option value="1">Xuất bản</option>
              <option value="2">Chưa xuất bản</option>
</select>
              </div>
            </div>
          </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
              <div class="col-12 text-right">
                <button type="submit" name="Thêm" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu</a>
                </button>
              <a href="index.php?option=user" class="btn btn-sm btn-info"><i class="fas fa-undo"></i>Quay về danh sách</a>
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
