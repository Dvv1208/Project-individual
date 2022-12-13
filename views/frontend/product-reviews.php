<?php

use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;

$reviews = new Reviews();

if (isset($_POST["rating_data"])) {
    $user = User::find($_SESSION['user_id']);
    $data = array(
        'user_name' => $_POST["user_name"] ?: $user['Fullname'],
        'pro_id' => $_POST["pro_id"],
        'user_rating' => $_POST["rating_data"],
        'user_review' => $_POST["user_review"],
        'datetime' => time()
    );
    $reviews->insert($data);
    echo "Đánh giá & Xếp hạng của bạn đã gửi thành công";
    // header('location:index.php?option=');
}

if (isset($_POST["action"])) {
    $average_rating = 0;
    $product_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $result = Reviews::where('pro_id', '=', $_POST["pro_id"])->orderBy('datetime', 'desc')->get();

    foreach ($result as $row) {
        $review_content[] = array(
            'user_name' => $row["user_name"],
            'user_review' => $row["user_review"],
            'rating' => $row["user_rating"],
            'datetime' => date('l jS, F Y h:i:s A', $row["datetime"])
        );

        if ($row["user_rating"] == '5') {
            $five_star_review++;
        }

        if ($row["user_rating"] == '4') {
            $four_star_review++;
        }

        if ($row["user_rating"] == '3') {
            $three_star_review++;
        }

        if ($row["user_rating"] == '2') {
            $two_star_review++;
        }

        if ($row["user_rating"] == '1') {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["user_rating"];
    }

    $average_rating = $total_user_rating / $total_review;
    $product_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'    =>    number_format($average_rating, 1),
        'product_rating'    =>    number_format($average_rating, 1),
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
