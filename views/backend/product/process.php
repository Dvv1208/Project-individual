<?php

use App\Libraries\Myclass;
use App\Models\Product;
use App\Models\ProductsImages;
use Illuminate\Support\Facades\Request;

if (isset($_POST['THEM'])) {
    $pro = new Product();
    // $pro->Id = $data[0];
    // $_SESSION['Id'] = $pro->Id;
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
    $target_file = $target_dir . basename($_FILES["avt"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['png', 'jpg', 'bmp', 'gif'])) {
        $pathFile = $target_dir . $pro->Slug . '.' . $imageFileType;
        move_uploaded_file($_FILES["avt"]["tmp_name"], $pathFile);
        $pro->Img = $pro->Slug . '.' . $imageFileType;
    }

    if ($pro->save()) {
        $target_dir1 = "../public/images/product/images/";
        $countfiles = count($_FILES['img']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            $pathFile1 = $target_dir1 . $pro->Slug . '_';
            $filename1 = $_FILES['img']['name'][$i];
            $imageFileType1 = strtolower(pathinfo($filename1, PATHINFO_EXTENSION));
            $img = move_uploaded_file($_FILES['img']['tmp_name'][$i], $pathFile1 . $filename1);
            $imgP = new ProductsImages();
            $imgP->proId = $pro->Id;
            $imgP->ImgId = $pro->Slug . '_' . $filename1;
            $imgP->save();
            MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Thêm thành công !']);
            header("location:index.php?option=product");
        }
    } else {
        MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Tập tin không đúng định dạng !']);
    }
}


if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $data = $_POST['data'];
    $row = Product::find($id);
    $data['Status'] = $_POST['status'];
    $data['UpdatedAt'] = date('y-m-d H:i:s');
    $data['UpdatedBy'] = (isset($_SESSION['useradmin'])) ? $_SESSION['userid'] : 1;
    $data['Slug'] = Myclass::str_slug($data['Name']);

    $target_dir = "../public/images/product/";
    $target_file = $target_dir . basename($_FILES["avt"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (in_array($imageFileType, ['png', 'jpg', 'bmp', 'gif'])) {
        // Lấy hình cũ
        // $pathdel = $target_dir . $row['Img'];
        // if (!empty(file_exists($pathdel))) {
        //     unlink($pathdel);
        // } else {
        $pathFile = $target_dir . $data['Slug'] . '.' . $imageFileType;
        $data['Img'] = $data['Slug'] . '.' . $imageFileType;
        move_uploaded_file($_FILES["avt"]["tmp_name"], $pathFile);
        // }
    }
    if (Product::where('Id', '=', $id)->update($data)) {
        $countfiles = count($_FILES['imgd']['name']);
        for ($i = 0; $i < $countfiles; $i++) {
            $target_dir1 = "../public/images/product/images/";
            $filename1 = $_FILES['imgd']['name'][$i];
            $imageFileType1 = strtolower(pathinfo($filename1, PATHINFO_EXTENSION));
            if (in_array($imageFileType1, ['png', 'jpg', 'bmp', 'gif'])) {

                $pathdel = $target_dir . $imgP->ImgId;
                if (!file_exists($pathdel)) {
                    unlink($pathdel);
                } else {
                    $pathFile1 = $target_dir1 . $data['Slug'] . '_';
                    $filename1 = $_FILES['imgd']['name'][$i];
                    $imageFileType1 = strtolower(pathinfo($filename1, PATHINFO_EXTENSION));
                    $img = move_uploaded_file($_FILES['imgd']['tmp_name'][$i], $pathFile1 . $filename1);
                    $imgP = new ProductsImages();
                    $imgP->proId = $id;
                    $imgP->ImgId = $data['Slug'] . '_' . $filename1;
                    $img = move_uploaded_file($_FILES['imgd']['tmp_name'][$i], $pathFile1 . $filename1);
                    $imgP->save();
                }
            }
        }
        MyClass::set_flash("message", ['type' => 'success', 'msg' => 'Sửa thành công !']);
        header("location:index.php?option=product");
    }
}
