<?php 
use App\Models\Topic;

$list=Topic::where('Status','!=','0')->get();


  $strparentid="";
  $strorders="";
  foreach ($list as $item)
  {
    $strparentid.="<option value='".$item['Id']."'>".$item["Name"]."</option>";
    $strorders.="<option value='".$item['Orders']."'>Sau: ".$item["Name"]."</option>";
  }
?>
<?php require_once('../views/backend/header.php');?>
<form action="index.php?option=topic&cat=process" name="form1" method="POST">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Thêm chủ đề bài viết</li>
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
            <h3 class="text-danger">THÊM MỚI CHỦ ĐỀ BÀI VIẾT</h3>
            <div class="col-md-12 text-right">
                <button type="submit" name="THEM" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Thêm]
                </button>
              <a href="index.php?option=topic" class="btn btn-sm btn-info">
                      <i class="fas fa-undo"></i>Quay về danh sách
              </a>
      
            </div>
          </div>
        </div>
        <div class="card-body">
        <?php require_once('../views/backend/message_alert.php'); ?>
          <div class="row">
              <div class="col-md-9">
                  <div class="mb-3">
                      <label for="name">Tên chủ đề</label>
                      <input name="data[Name]" type="text" id="name" placeholder="Nhập tên danh mục" class="form-control">
                  </div>
                  <div class="mb-3">
                      <label for="metakey">Từ khóa</label>
                      <textarea name="data[Metakey]" id="metakey" row="3" class="form-control"></textarea>
                  </div>
                  <div class="mb-3">
                      <label for="metadesc">Mô tả</label>
                      <textarea name="data[MetaDesc]" id="metadesc" row="3" class="form-control"></textarea>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="mb-3">
                    <label for="parentid">Cấp cha</label>
                    <select id="parentid" name="parentid" class="form-control">
                        <option value="0">None</option>
                        <?=$strparentid; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="orders">Sắp xếp</label>
                    <select id="orders" name="orders" class="form-control">
                        <option value="0">None</option>
                        <?=$strorders; ?>
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
          <div class="card-footer">
          <div class="row mb-2">
            <div class="col-md-12 text-right">
                <button type="submit" name="THEM" class="btn btn-sm btn-success">
                <i class="fas fa-save"></i>Lưu[Thêm]
                </button>
              <a href="index.php?option=topic" class="btn btn-sm btn-info">
                      <i class="fas fa-undo"></i>Quay về danh sách
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
</form>
  <?php require_once('../views/backend/footer.php');?>
