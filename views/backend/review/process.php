<?php

use App\Models\Reviews;
use App\Libraries\MyClass;

if (isset($_POST['THEM'])) {
    $review = new Reviews();
    $review->pro_id = $_POST['proid'];
    $review->user_name = $_POST['user_name'];
    $review->user_rating = $_POST['rating'];
    $review->user_review = $_POST['user_review'];
    $review->datetime = strtotime(date('Y-m-d H:i:s'));
    $review->created_at = date('Y-m-d H:i:s');
    $review->save();
    MyClass::set_flash('message', array('type' => 'success', 'msg' => 'Thêm thành công'));
    header("location:index.php?option=review");
}


if (isset($_POST['CAPNHAT'])) {
    $id = $_POST['id'];
    $data = $_POST['data'];
    $data['pro_id'] = $data['pro_id'];
    $data['datetime'] = $data['datetime'];
    Reviews::where('review_id', '=', $id)->update($data);
    MyClass::set_flash('message', array('type' => 'success', 'msg' => 'Sửa thành công'));
    header("location:index.php?option=review");
}
