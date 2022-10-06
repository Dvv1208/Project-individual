<?php
use App\Models\User;
use App\Libraries\MyClass;
$list =User::where('Status','!=','0')->get();
?>
<?php require_once('../views/backend/header.php');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tất cả khách hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả khách hàng</li>
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
                        <a href="index.php?option=user&cat=create" class="btn btn-sm btn-success"><i
                                class="fas fa-plus"></i>Thêm</a>
                        <a href="index.php?option=user&cat=trash" class="btn btn-sm btn-danger"><i
                                class="fas fa-trash"></i>Thùng rác</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php require_once('../views/backend/message_alert.php');?>
                <table class="table table-boadered" id="myTable">
                    <thead>
                        <th>Mã tài khoản</th>
                        <th>Họ và tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Mật khẩu</th>
                        <th>Email</th>
                        <th>Giới tính</th>
                        <th>Điện thoại</th>
                        <th>Quyền truy cập</th>
                        <th>Ngày tạo</th>
                        <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $rows):?>
                        <td><?php echo $rows['Id']?></td>
                        <td><?php echo$rows['Fullname']?></td>
                        <td><?php echo$rows['Username']?></td>
                        <td><?php echo$rows['Password']?></td>
                        <td><?php echo$rows['Email']?></td>
                        <td>
                            <?php if($rows['Gender']==1):?>
                            <?php echo "Nam"?>
                            <?php else:if($rows['Gender']==2):?>
                            <?php echo "Nữ"?>
                            <?php else:?>
                            <?php echo "Khác"?>
                            <?php endif;?>
                            <?php endif;?>
                        </td>
                        <td><?php echo$rows['Phone']?></td>
                        <td><?php if($rows['Roles']==1):?>
                            <?php echo "Administrator"?>
                            <?php else:?>
                            <?php echo "Editor"?>
                            <?php endif;?>
                        </td>
                        <td><?php echo$rows['CreatedAt']?></td>
                        <td class="text-center">
                            <?php if($rows['Status']==1):?>
                            <a href="index.php?option=user&cat=status&id=<?php echo $rows['Id'];?>"
                                title="Duyệt đơn hàng" class="btn btn-sm btn-success">
                                <i class="fas fa-toggle-on"></i>
                            </a>
                            <?php else:?>
                            <a href="index.php?option=user&cat=status&id=<?php echo $rows['Id'];?>"
                                title="Đơn hàng đã duyệt" class="btn btn-sm btn-danger">
                                <i class="fas fa-toggle-off"></i>
                                <?php endif;?>
                                <a href="index.php?option=user&cat=detail&id=<?php echo $rows['Id'];?>" title="Chi tiết"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="index.php?option=user&cat=edit&id=<?php echo $rows['Id'];?>" title="Cập nhật"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?option=user&cat=deltrash&id=<?php echo $rows['Id'];?>"
                                    title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                        </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once('../views/backend/footer.php');?>
<Script>
$(document).ready(function() {
    $('#myTable').DataTable();
});
</Script>