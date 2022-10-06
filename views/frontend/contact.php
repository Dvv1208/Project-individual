<?php 
use App\Models\Contact;
use App\Libraries\Pagination;

$title = 'Liên hệ';

?>

<?php require_once('views/frontend/header.php'); ?>
<section class="maincontent">
    <?php require_once('views/frontend/mod_slider.php'); ?>
    <form name="forml" action="index.php?option=contact-process" method="post">
        <div class="container">
            <div class="product_category my-3">
                <h3 class="my-3 text-light text-center bg-mainmenu">
                    <?php echo $title; ?>
                </h3>
                <div class="row">
                    <div class="col-md-9">
                        <div class="md-3">
                            <label for="title">Tiêu đề liên hệ:</label>
                            <input class="form-control" name="data[Title]" id="title" type="text" />
                        </div>
                        <div class="md-3">
                            <label for="detail">Câu hỏi liên hệ:</label>
                            <textarea name="data[Detail]" id="detail" type="text" class="form-control">
                                </textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-3">
                            <label for="fullname">Họ và tên</label>
                            <input class="form-control" name="data[FullName]" id="fullname" type="text" />
                        </div>
                        <div class="md-3">
                            <label for="phone">Số điện thoại</label>
                            <input class="form-control" name="data[Phone]" id="phone" type="text" />
                        </div>
                        <div class="md-3">
                            <label for="email">Email liên hệ</label>
                            <input class="form-control" name="data[Email]" id="email" type="text" />
                        </div>
                    </div>
                </div>
            </div>
            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                <i></i> Gửi liên hệ
            </button>
            <p class="form-control">Địa chỉ của chúng tôi: 20 Đường Tăng Nhơn Phú, Phước Long B, Thủ Đức, Thành phố Hồ
                Chí Minh, Việt Nam</p>
            <div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.7516950361805!2d106.77279011529349!3d10.83030456115719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752701a34a5d5f%3A0x30056b2fdf668565!2zVHLGsOG7nW5nIENhbyDEkOG6s25nIEPDtG5nIFRoxrDGoW5nIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1655825474125!5m2!1svi!2s"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
</section>
</form>
<?php require_once('views/frontend/footer.php');?>