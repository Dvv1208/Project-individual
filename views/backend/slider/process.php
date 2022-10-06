<?php
use App\libraries\MyClass;
use App\Models\Slider;


if(isset($_POST['THEM']))
{
 
    $data=$_POST['data'];
    $slug = MyClass::str_slug($data['Name']);
    $data['Position']=$_POST['position'];
    $data['Link']=$_POST['link'];
    $data['Orders']=$_POST['orders'];
    $data['Status']=$_POST['status'] ;
    $data['CreatedAt']=date('Y-m-d H:i:s');
    $data['CreatedBy']=(isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    $target_dir="../public/images/slider/";

    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(in_array($imageFileType,['png','gif','jpg']))
    {
        $pathFile= $target_dir.$slug.'.'. $imageFileType;
        move_uploaded_file($_FILES['img']['tmp_name'],$pathFile);
        $data['Img']= $slug.'.'. $imageFileType;
        Slider::insert($data);
        MyClass::set_flash('message',['type'=>'success','msg'=>'Thêm thành công']);
    }
    else{
        MyClass::set_flash('message',['type'=>'danger','msg'=>'Tập tin không đúng định dạng']);
    
    } 
    header("location:index.php?option=slider");
}
if(isset($_POST['CAPNHAT']))
{
    $id=$_POST['id'];
    $data=$_POST['data'];
    $slug = MyClass::str_slug($data['Name']);
    $data['Position']=$_POST['position'];
    $data['Link']=$_POST['link'];
    $data['Orders']=$_POST['orders'];
    $data['Status']=$_POST['status'] ;
    $data['UpdatedAt']=date('Y-m-d H:i:s');
    $data['UpdatedBy']=(isset($_SESSION['useradmin']))?$_SESSION['userid']:1;
    if(strlen($_FILES["img"]["name"])!=0)
    {
        $target_dir="../public/images/slider/";

        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(in_array($imageFileType,['png','gif','jpg']))
        {
            unlink("../public/images/slider/".$data['Img']);
            $pathFile= $target_dir.$slug.'.'. $imageFileType;
            move_uploaded_file($_FILES['img']['tmp_name'],$pathFile);
            $data['Img']= $slug.'.'. $imageFileType;
            
          }
    }
    Slider::where('Id','=',$id)->update($data);
    MyClass::set_flash('message',['type'=>'success','msg'=>'Thêm thành công']);

    header("location:index.php?option=slider");
}