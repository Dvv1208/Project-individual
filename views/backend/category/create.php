<?php
use App\Models\Category;

$list = Category::where('Status', '!=', '0')->get();
$strparentid = "";
$strorders = "";
foreach($list as $item){
  $strparentid .= "<option value = '" .$item['Id'] ."'>" .$item['Name'] . "</option>";
  $strorders .="<option value='".$item['Orders']."'> Sau: ".$item['Name']."</option>";
}

 ?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="forml" action="index.php?option=category&cat=process" method="post">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm danh mục sản phẩm</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm danh mục</li>
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
                            <a href="index.php?option=category" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Lưu [Thêm]
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="name">Tên danh mục</label>
                                <input name="data[Name]" id="name" type="text" class="form-control" required
                                    placeholder="Nhập tên danh mục" />
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="data[Metakey]" id="metakey" class="form-control" required
                                    rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="data[Metadesc]" id="metadesc" class="form-control" required
                                    rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="parentid">Cấp cha</label>
                                <select name="parentid" id="parentid" class="form-control">
                                    <option value="0">None</option>
                                    <?= $strparentid; ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="orders">Sắp xếp</label>
                                <select name="orders" id="orders" class="form-control">
                                    <option value="0">None</option>
                                    <?= $strorders; ?>
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng Thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Xuất bản</option>
                                    <option value="2">Chưa xuất bản</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
</form>
<!-- /.content-wrapper -->

<?php require_once('../views/backend/footer.php'); ?>