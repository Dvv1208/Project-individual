<?php

use App\Models\Contact;
use App\Libraries\MyClass;

$list = Contact::where('Status', '!=', '0')->orderBy('CreatedAt', 'desc')->get();

?>

<?php require_once('../views/backend/header.php');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách liên hệ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả liên hệ</li>
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
                        <a href="index.php?option=contact&cat=trash" class="btn btn-sm btn-danger"><i
                                class="fas fa-trash"></i> Thùng rác
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php if(MyClass::exists_flash('message')): ?>
                <?php
                  $arr_message = MyClass::get_flash('message');
                ?>
                <div class="alert alert-<?= $arr_message['type']; ?>" role="alert">
                    <?php echo $arr_message['msg']; ?>
                </div>
                <?php endif; ?>
                <table class="table table-bordered" id="myTable">
                    <thead>
                        <tr>
                            <th style="width:20px" class="text-center">
                                <input type="checkbox" name="checkAll">
                            </th>
                            <th class="text-center">Tiêu đề liên hệ</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Điện thoại</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Chức năng</th>
                            <th style="width:20px" class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="checkId[]">
                            </td>
                            <td class="text-center"><?php echo $row['Title'];?></td>
                            <td class="text-center"><?php echo $row['Email'];?></td>                          
                            <td class="text-center"><?php echo $row['Phone'];?></td>
                            <td class="text-center">
                            <?php if($row['Status']==1):?>
                                 <span class="badge badge-success"><?php echo "Chưa trả lời";?></span>
                             <?php else:if($row['Status']==2):?>
                                <span class="badge badge-danger"><?php echo "Đã trả lời";?></span>
                                <?php else:?>
                                    <?php endif;?>
                                <?php endif;?>
                            </td>
                            <td class="text-center">
                                <?php if($row['Status']==1):?>
                                <a href="index.php?option=contact&cat=status&id=<?php echo $row['Id'];?>"
                                    title="Trạng thái" class="btn btn-sm btn-success">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                <?php else:if($row['Status']==2):?>
                                <a href="index.php?option=contact&cat=status&id=<?php echo $row['Id'];?>"
                                    title="Trạng thái" class="btn btn-sm btn-danger">
                                    <i class="fas fa-toggle-off"></i>
                                </a>
                                <?php else:?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a href="index.php?option=contact&cat=reply&id=<?php echo $row['Id'];?>"
                                    title="Trả lời" class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?option=contact&cat=detail&id=<?php echo $row['Id'];?>"
                                    title="Trả lời" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="index.php?option=contact&cat=deltrash&id=<?php echo $row['Id'];?>"
                                    title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td><?php echo $row['Id'];?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php');?>
<script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</script>