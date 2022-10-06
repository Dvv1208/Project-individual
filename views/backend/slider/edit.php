<?php 
use App\Models\Slider;

$list=Slider::where('Status','!=','0')->get();

$id= $_REQUEST["id"];

$row=Slider::find($id);
if($row==null){
  MyClass::set_flash('message',['type'=>'danger','msg'=>'Mẫu tin không tồn tại']);
  header("location:index.php?option=category");
}
  $strposition="";
  foreach ($list as $item)
  {
    if($item['Id']!= $id){
      if($row['Position']==$item['Id'])
      {
        $strposition.="<option selected value='".$item['Id']."'>".$item["Position"]."</option>";
      }
      else{
        $strposition.="<option value='".$item['Id']."'>".$item["Position"]."</option>";
      }
    }
  }
?>
<?php require_once('../views/backend/header.php');?>
<form action="index.php?option=slider&cat=process" name="form1" method="POST" enctype="multipart/form-data">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cập nhật slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Cập nhật Slider</li>
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
                <button type="submit" name="CAPNHAT" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Cập nhật]
                </button>
              <a href="index.php?option=slider" class="btn btn-sm btn-info">
                      <i class="fas fa-undo"></i>Quay về danh sách
              </a>
      
            </div>
          </div>
        </div>
        <div class="card-body">
        <?php require_once('../views/backend/message_alert.php'); ?>
          <div class="row">
              <div class="col-md-9">
              <input name="id" type="hidden" value="<?=$row['Id'];?>" id="id" class="form-control">
                  <div class="mb-3">
                      <label for="name">Tên slider</label>
                      <input name="data[Name]" type="text" id="name" value="<?=$row['Name'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                      <label for="link">Liên kết</label>
                      <input name="link" type="url" id="link" value="<?=$row['Link'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                      <label for="img">Hình ảnh</label>
                      <input name="img" type="file" id="img" value="<?=$row['Img'];?>" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="orders">Sắp xếp</label>
                    <select id="orders" name="orders" class="form-control">
                        <option value="0">None</option>
                    </select>
                  </div>
                  <div class="mb-3">
                      <label for="position">Vị trí</label>
                      <select id="position" name="position" class="form-control">
                          <option>--Chọn vị trí</option>
                          <?=$strposition;?>
                      </select>
                  </div>
                  <div class="mb-3">
                    <label for="status">Trạng thái</label>
                    <select id="status" name="status" class="form-control">
                        <option value="1" <?=($row['Status']==1)?'selected':'';?>>Xuất bản</option>
                        <option value="2" <?=($row['Status']==2)?'selected':'';?>>Chưa xuất bản</option>
                        <?=$strstatus; ?>
                    </select>
                </div>
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
</form>
  <?php require_once('../views/backend/footer.php');?>
