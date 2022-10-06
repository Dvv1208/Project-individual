<?php 

use App\Libraries\Myclass;
use App\Models\Product;

if(isset($_POST['THEM']))
{
    $data = $_POST['data'];
    $data['Status'] = $_POST['status'];
    $data['CreatedAt'] = date('y-m-d H:i:s');
    $data['CreatedBy'] =(isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    $data['Slug'] = Myclass::str_slug($data['Name']); 

    $target_dir = "../public/images/product/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($imageFileType,['png','jpg','bmp','gif']))
    {
        $pathFile = $target_dir . $data['Slug'] . '.' . $imageFileType;
        
        $data['Img']= $data['Slug'] . '.' .$imageFileType;
        move_uploaded_file($_FILES["img"]["tmp_name"],$pathFile);  
        Product::insert($data);
        MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thêm thành công !']); 
    }
    else {
        MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Tập tin không đúng định dạng !']);
    }
    
    header("location:index.php?option=product");
}
if(isset($_POST['CAPNHAT']))
{
    $id = $_POST['id'];
    $data = $_POST['data'];

    $data['Status'] = $_POST['status'];
    $data['UpdatedAt'] = date('y-m-d H:i:s');
    $data['UpdatedBy'] =(isset($_SESSION['useradmin']))?$_SESSION['userid']:1; 
    $data['Slug'] = Myclass::str_slug($data['Name']);

    $target_dir = "../public/images/product/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($imageFileType,['png','jpg','bmp','gif']))
    {
        // Lấy hình cũ
        $pathdel = $target_dir .$row['Img']; //
        if(file_exists($pathdel))
        {
            unlink($pathdel);
        }
        else 
        {
            $pathFile = $target_dir . $data['Slug'] . '.' . $imageFileType;
            $data['Img']= $data['Slug'] . '.' .$imageFileType;
            move_uploaded_file($_FILES["img"]["tmp_name"],$pathFile); 
        }
        
    }
    Product::where('Id', '=',$id)->update($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Sửa thành công !']);
    header("location:index.php?option=product");
}

?>