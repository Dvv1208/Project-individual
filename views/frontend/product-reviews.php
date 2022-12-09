<?php

use App\Models\Product;
use App\Models\Reviews;

$reviews = new Reviews();
$id = $_POST['pro_id'];
$pro = Product::where('Id', '=', $id)->get();
foreach ($pro as $proId) {
    $p = $proId;
}
if (isset($_POST["rating_data"])) {

    $data = array(
        'user_name' => $_POST["user_name"],
        'pro_id' => $_POST["pro_id"],
        'user_rating' => $_POST["rating_data"],
        'user_review' => $_POST["user_review"],
        'datetime' => time()
    );
    // $reviews->insert($data);
    echo "Đánh giá & Xếp hạng của bạn đã gửi thành công";
}
if (isset($_POST["action"])) {
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $result = Reviews::where('pro_id', '=', $p->Id)->with('ids')->get();

    foreach ($result as $row) {
        $review_content[] = array(
            'user_name' => $row->user_name,
            'user_review' => $row->user_review,
            'rating' => $row->user_rating,
            'datetime' => date('l jS, F Y h:i:s A', $row->datetime)
        );

        if ($r["user_rating"] == '5') {
            $five_star_review++;
        }

        if ($r["user_rating"] == '4') {
            $four_star_review++;
        }

        if ($r["user_rating"] == '3') {
            $three_star_review++;
        }

        if ($r["user_rating"] == '2') {
            $two_star_review++;
        }

        if ($r["user_rating"] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $r["user_rating"];
    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    =>    number_format($average_rating, 1),
        'total_review'        =>    $total_review,
        'five_star_review'    =>    $five_star_review,
        'four_star_review'    =>    $four_star_review,
        'three_star_review'    =>    $three_star_review,
        'two_star_review'    =>    $two_star_review,
        'one_star_review'    =>    $one_star_review,
        'review_data'        =>    $review_content
    );

    echo json_encode($output);
}
