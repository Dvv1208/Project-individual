<?php

use App\Libraries\Myclass;
use App\Models\Product;
use App\Models\ProductsImages;
use Illuminate\Support\Facades\Request;

switch (isset($_POST['action'])) {
    case 'THEM':
        $data = getdate();
        $pro = new Product();
        $pro->Id = $data[0];
        $_SESSION['Id'] = $pro->Id;
        $pro->Catid = $_POST['Catid'];
        $pro->Name = $_POST['Name'];
        $pro->Detail = $_POST['Detail'];
        $pro->Price = $_POST['Price'];
        $pro->Pricesale = $_POST['Pricesale'];
        $pro->Number = $_POST['Number'];
        $pro->Metakey = $_POST['Metakey'];
        $pro->Metadesc = $_POST['Metadesc'];
        $pro->CreatedAt = date('Y-m-d H:i:s');
        $pro->Slug = $_POST['Slug'] = Myclass::str_slug($_POST['Name']);
        $pro->Status = $_POST['Status'] = $_POST['status'];
        $target_dir = "../public/images/product/";
        $countfiles = count($_FILES['img']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            $pathFile = $target_dir . $pro->Slug . '_';
            $filename = $_FILES['img']['name'][$i];
            $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $img = move_uploaded_file($_FILES['img']['tmp_name'][$i], $pathFile . $filename);
            $pro->Img = $pro->Slug . '_' . $filename;
            if ($pro->images->save()) {
                $imgP = new ProductsImages();
                $imgP->proId = $pro->Id;
                $imgP->ImgId = $pro->Img;
                $imgP->save();
                MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Thêm thành công !']);
                header("location:index.php?option=product");
            } else {
                MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Tập tin không đúng định dạng !']);
            }
        }
        break;
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $data = $_POST['data'];

    $data['Status'] = $_POST['status'];
    $data['UpdatedAt'] = date('y-m-d H:i:s');
    $data['UpdatedBy'] = (isset($_SESSION['useradmin'])) ? $_SESSION['userid'] : 1;
    $data['Slug'] = Myclass::str_slug($data['Name']);

    $target_dir = "../public/images/product/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['png', 'jpg', 'bmp', 'gif'])) {
        // Lấy hình cũ
        $pathdel = $target_dir . $row['Img']; //
        if (file_exists($pathdel)) {
            unlink($pathdel);
        } else {
            $pathFile = $target_dir . $data['Slug'] . '.' . $imageFileType;
            $data['Img'] = $data['Slug'] . '.' . $imageFileType;
            move_uploaded_file($_FILES["img"]["tmp_name"], $pathFile);
        }
    }
    Product::where('Id', '=', $id)->update($data);
    MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Sửa thành công !']);
    header("location:index.php?option=product");
}
