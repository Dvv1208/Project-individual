<?php
use App\Models\Contact;
$contact = new Contact();
$id = $_REQUEST['id'];
$row = Contact::find($id);
$tt="Giải đáp thắc mắc";
if($row == null){
    MyClass::set_flash("message", ['type'=> 'danger','msg'=> 'Mẫu tin không tồn tại !']);
    header("location:index.php?option=contact");
}
 ?>
<?php require_once('../views/backend/header.php'); ?>

<!-- Content Wrapper. Contains page content -->
<form name="forml" action="index.php?option=contact&cat=process" method="post">
    <div class="content-wrapper py-2">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong class="text-danger">Trả lời bài viết</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?option=contact" class="btn btn-sm btn-info">
                                <i class="fas fa-undo"></i> Quay về danh sách
                            </a>
                            <button name="CAPNHAT" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>Lưu [Trả lời]
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <input name="id" value="<?php echo $row['Id']; ?>" type="hidden" />
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="title">Tiêu đề liên hệ</label>
                                <input name="data[Title]" value="<?php echo $row['Title']; ?>" id="title" type="text"
                                    class="form-control" name value=<?php echo $row['Title'];?> readonly />
                            </div>
                            <div class="mb-3">
                                <label for="detail">Câu hỏi liên hệ</label>
                                <textarea name="data[Detail]" value="<?php echo $row['Detail']; ?>" id="detail" type="text"
                                    class="form-control" readonly ><?php echo $row['Detail'];?>
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="replydetaol">Nội dung trả lời</label>
                                <input type="text" name="data[ReplyDetail]" value="<?php echo $row['ReplyDetail']; ?>" id="detail" type="text"
                                    class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-3">
                        <div class="mb-3">
                                <label for="fullname">Họ và tên</label>
                                <input name="data[FullName]" value="<?php echo $row['FullName']; ?>" id="fullname" type="text"
                                    class="form-control" name value=<?php echo $row['FullName'];?> readonly />
                            </div>
                            <div class="mb-3">
                                <label for="phone">Số điện thoại</label>
                                <input name="data[Phone]" value="<?php echo $row['Phone']; ?>" id="phone" type="text"
                                    class="form-control" name value=<?php echo $row['Phone'];?> readonly />
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input name="data[Email]" value="<?php echo $row['Email']; ?>" id="email" type="text"
                                    class="form-control" name value=<?php echo $row['Email'];?> readonly />
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <input name="data[Status]" value="<?php echo "Đã trả lời"; ?>" id="status" type="text"
                                    class="form-control" value="2" <?php echo ($row['Status']==2)?'selected':''; ?> readonly />
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
</form>
<!-- /.content-wrapper -->

<?php require_once('../views/backend/footer.php'); ?>