<?php
use App\Models\Post;

$list = Post::where('Status', '!=', '0')->get();
 ?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="form1" action="index.php?option=post&cat=process" method="post" enctype="multipart/form-data">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm bài viết</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm bài viết</li>
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
                            <a href="index.php?option=post" class="btn btn-sm btn-info">
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
                            <input name="id" type="hidden" />
                            <div class="mb-3">
                                <label for="title">Tiêu đề</label>
                                <input name="data[Title]" id="title" type="text" class="form-control" required
                                    placeholder="Nhập tiêu đề bài viết" />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi Tiết bài viết</label>
                                <textarea name="data[Detail]" id="detail" class="form-control" required rows="4"></textarea>
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
              <label for="type">Kiểu bài viết</label>
            <select id="Type" name="type" class="form-control">
            <option value="1">Tin tức</option>
              <option value="2">giới thiệu</option>
              <option value="3">dịch vụ</option>
</select>
              </div>
                            <div class="mb-3">
                                <label for="img">Hình</label>
                                <input type="file" name="img" id="img" class="form-control">
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