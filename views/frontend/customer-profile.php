<?php

use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use App\Models\UserImage;

$title = 'Thông tin của tôi';

$username = User::find($_SESSION['user_id']);
$orders = Order::where('User_id', '=', $_SESSION['user_id'])->with('products')->orderBy('CreatedAt', 'desc')->get();
$user_id = $username->Id;
$userimg = UserImage::where('User_id', '=', $user_id)->get();

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="breadcrumb p-0 m-0">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a style="text-decoration: none" href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<section class="clearfix main mt-2">
    <div class="container">
        <div class="container bootstrap snippet">
            <div class="card-header">
                <h2>Thông tin của bạn</h2>
            </div>
            <form action="index.php?option=customer-profile-saveImage" method="post" enctype="multipart/form-data" id="form_profile">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="text-center">
                            <?php foreach ($userimg as $img) {
                            } ?>
                            <img style="border-radius: 50%; width: auto; height: 300px;" src="public/images/user/<?php echo $img->Avatar; ?>" onClick="triggerClick()" id="profileDisplay" title="Ấn vào để thay đổi hình đại diện" class="avatar img-circle img-thumbnail" alt="<?php echo $img->Avatar; ?>">
                        </div>
                        <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                    </div>
                    <div class="col-sm-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="name">
                                            <label><b>Họ tên</b></label><br>
                                        </label>
                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $username->Fullname; ?>" title="Nhập họ tên của bạn" required>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="col-xs-6 ">
                                        <label for="address">
                                            <label><b>Địa chỉ</b></label><br>
                                        </label>
                                        <input type="text" class="form-control" name="address" id="address" value="<?php echo $username->Address; ?>" title="Nhập địa chỉ của bạn" required>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="col-xs-6">
                                        <label for="phone">
                                            <label><b>Số điện thoại</b></label><br>
                                        </label>
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?php echo  $username->Phone; ?>" title="Nhập số điện thoại của bạn" required>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <div class="col-xs-6">
                                        <label for="email">
                                            <label><b>Email</b></label><br>
                                        </label>
                                        <input type="text" class="form-control" name="email" id="email" value="<?php echo  $username->Email; ?>" title="Nhập email của bạn" required>
                                    </div>
                                </div>
                                <div class="form-group my-3 text-end">
                                    <div class="col-xs-12">
                                        <br>
                                        <button type="button" value="edit_profile" id="edit_profile" class="btn btn-outline-info btn-block">Sửa</button>
                                        <button type="submit" name="save_profile" value="save_profile" id="save_profile" class="btn btn-outline-success btn-block">Lưu</button>
                                        <button type="button" value="cancel_profile" id="cancel_profile" class="btn btn-outline-info btn-block">Hủy</button>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-9">
            <div class="col-md-9">
                <h3>Lịch sử đơn hàng</h3>
            </div>
            <?php if (count($orders) != null) : ?>
                <table class="table table-borderd">
                    <tr>
                        <th class="text-center">Mã đơn hàng</th>
                        <th class="text-center">Thành tiền</th>
                        <th class="text-center">Phương thức thanh toán</th>
                        <th class="text-center">Trạng thái đơn hàng</th>
                        <th class="text-center"></th>
                    </tr>

                    <?php foreach ($orders as $order) : ?>
                        <?php
                        $totalMoney = 0;
                        foreach ($order->products as $product) {
                            $totalMoney += $product->pivot->Amount;
                        }
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $order->Code; ?></td>
                            <td class="text-center">
                                <?php echo number_format($totalMoney, 0, ',', '.') . "<sup>đ</sup>"; ?>
                            </td>
                            <td class="text-center"><?php echo $order->Pttt; ?></td>
                            <td class="text-center">
                                <?php
                                if (($order->OrderStatus) == "1") {
                                    echo ("Chờ xác nhận");
                                } elseif (($order->OrderStatus) == "0") {
                                    echo ("Đã hủy");
                                } else {
                                    echo ("Đang giao hàng");
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <!-- <?php if (($order->OrderStatus) == "0") : ?>
                                        <input type="hidden" name="action" value="huydonhang">
                                        <a href="index.php?option=customer&profile=status&id=<?php echo $order->Id; ?>" title="Trạng thái đơn hàng" class="btn btn-sm btn-danger">Khôi phục đơn hàng</a>
                                        </input>
                                    <?php endif; ?> -->
                                <?php if (($order->OrderStatus) == "1") : ?>
                                    <input type="hidden" name="action" value="huydonhang">
                                    <button id="cancel_order" name="cancel_order" title="Trạng thái đơn hàng" class="btn btn-sm btn-danger">Hủy đơn hàng</button>
                                    </input>
                                    <?php if (($order->OrderStatus) == "2") : ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <div id="reason_order" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Lý do hủy đơn hàng</h5>
                                    </div>
                                    <div id="review-form">
                                        <form class="review-form">
                                            <div class="modal-body">
                                                <br>
                                                <div class="form-group">
                                                    <input type="hidden" name="order_id" id="order_id" class="form-control" value="<?php echo $order->Id; ?>" />
                                                    <input type="hidden" name="order_code" id="order_code" class="form-control" value="<?php echo $order->Code; ?>" />
                                                    <textarea name="user_reason" id="user_reason" class="form-control" placeholder="Nhập lý do hủy đơn của bạn"></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group text-center">
                                                    <a type="button" id="save_order" name="save_order" class="btn btn-outline-danger" style="text-decoration: none">Gửi</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <strong>Bạn chưa có đơn hàng nào</strong>
            <?php endif; ?>
        </div>
        <hr class="mb-4">
        <div class="col-md-4 order-md-2 mb-4">
            <a class="btn btn-outline-info" href="index.php">Quay về trang chủ</a>
        </div>
    </div>
</section>
<?php require_once('views/frontend/footer.php'); ?>

<script>
    function triggerClick(e) {
        document.querySelector('#profileImage').click();
    }

    function displayImage(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
</script>
<script>
    $('#cancel_order').click(function() {
        $('#reason_order').modal('show');
    });

    $('#save_order').click(function() {
        var order_id = $('#order_id').val();
        var order_code = $('#order_code').val();
        var user_reason = $('#user_reason').val();
        if (user_reason == '') {
            alert("Bạn phải điền lý do hủy đơn hàng");
            return false;
        } else {
            $.ajax({
                url: "index.php?option=customer-detail",
                method: "POST",
                data: {
                    order_id: order_id,
                    order_code: order_code,
                    user_reason: user_reason
                },
                success: function(data) {
                    $('#reason_order').modal('hide');
                    alert("Đơn hàng của bạn đã được hủy");
                    window.location.reload();
                }
            });
        }
    });
</script>
<script>
    $("#save_profile, #cancel_profile").hide();
    $('#form_profile input').attr('disabled', true);
    $('#edit_profile').on('click', function(e) {
        $("#save_profile, #cancel_profile").show();
        $("#edit_profile").hide();
        e.preventDefault();
        if ($('#form_profile input').attr('disabled')) {
            $('#form_profile input').removeAttr('disabled');
        }
    })
    $('#cancel_profile').on('click', function(e) {
        $("#save_profile, #cancel_profile").hide();
        $("#edit_profile").show();
        $('#form_profile input').attr('disabled', true);
    })
</script>