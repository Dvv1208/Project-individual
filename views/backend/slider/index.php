<?php 
use App\Models\Slider;

$list=Slider::where('Status','!=','0')->orderBy('CreatedAt','desc')->get();
?>
<?php require_once('../views/backend/header.php');?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper py-2">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h3 class="text-dager">DANH SÁCH SLIDER</h3>
                    <div class="col-md-12 text-right">
                        <a href="index.php?option=slider&cat=create" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i>Thêm
                        </a>
                        <a href="index.php?option=slider&cat=trash" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>Thùng rác
                        </a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php require_once('../views/backend/message_alert.php'); ?>
                <table class="table table-borderd" id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:50%">Hình ảnh</th>
                            <th>Tên slider</th>
                            <th>Vị trí</th>
                            <th class="text-center">Chức năng</th>
                            <th style="width:20px" class="text-center">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $row) : ?>
                        <tr>
                            <td>
                                <img src="../public/images/slider/<?php echo $row['Img']; ?>" class="img-fluid" alt="">
                            </td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Position']; ?></td>
                            <td class="text-center">
                                <?php if($row['Status']==1) : ?>
                                <a href="index.php?option=slider&cat=status&id=<?php echo $row['Id']; ?>"
                                    title="Trạng thái" class="btn btn-sm btn-success">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                <?php else : ?>
                                <a href="index.php?option=slider&cat=status&id=<?php echo $row['Id']; ?>"
                                    title="Trạng thái" class="btn btn-sm btn-danger">
                                    <i class="fas fa-toggle-off"></i>
                                </a>
                                <?php endif ; ?>
                                <a href="index.php?option=slider&cat=detail&id=<?php echo $row['Id']; ?>"
                                    title="Chi tiết" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="index.php?option=slider&cat=edit&id=<?php echo $row['Id']; ?>" title="Cập nhật"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?option=slider&cat=deltrash&id=<?php echo $row['Id']; ?>"
                                    title="Xóa vào thùng rác" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td class="text-center"><?php echo $row['Id']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Foooter
            </div>
        </div>
        <!-- /.card -->

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