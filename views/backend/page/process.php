<?php
use App\Models\Page;
use App\Libraries\MyClass;

if(isset($_POST['THEM']))
{
    $data=$_POST['data'];
    $data['Status'] = $_POST['status'];
    $data['CreatedAt'] = date('Y-m-d H:i:s');
    $data['CreatedBy'] = (isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    $data['Slug'] = MyClass::str_slug($data['Title']);  
    $target_dir = "../public/images/page/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($imageFileType,['png','jpg','bmp','gif']))
    {
        $pathFile = $target_dir . $data['Slug'] . '.' . $imageFileType;
        
        $data['Img']= $data['Slug'] . '.' .$imageFileType;
        move_uploaded_file($_FILES["img"]["tmp_name"],$pathFile);  
        Page::insert($data);
        MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Thêm thành công !']); 
    }
    else {
        MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Tập tin không đúng định dạng !']);
    }
    
    header("location:index.php?option=page");
}
if(isset($_POST['CAPNHAT']))
{
    $id=$_POST['id'];
    $data=$_POST['data'];
    $slug=Myclass::str_slug($data['Title']);
    $data['Status'] = $_POST['status'];
    $data['CreatedAt'] = date('Y-m-d H:i:s');
    $data['UpdatedBy'] = (isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    $data['Slug'] = MyClass::str_slug($data['Title']);
    if(strlen($_FILES["img"]["name"]!=0)){
    $target_dir = "../public/images/page/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($imageFileType,['png','jpg','bmp','gif'])){
        //thay hinfh
        unlink($target_dir .$row["Img"]);
        $pathFile=$target_dir .$slug .'.' .$imageFileType;
        move_uploaded_file($_FILES["img"]["tmp_name"],$pathFile);  
        $data['Img']=$slug .'.' .$imageFileType;
        }
    }
    Page::where('Id','=',$id)->update($data);
    MyClass::set_flash("message", ['type'=> 'success','msg'=> 'Sửa thành công !']); 
    header("location:index.php?option=page");
}
?>




