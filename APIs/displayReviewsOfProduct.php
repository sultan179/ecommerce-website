<?php
    include '../backend/connection.php';
    include '../businessLogic/product_review.php';

    $con = connect();
    $id = isset($_GET['product_id']) ? $_GET['product_id'] : die();
    $result = getProductReviews($con, $id);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['Members Name'] = $row['member_name'];
        $output[$rowNumber]['review'] = $row['review'];
        $output[$rowNumber]['rating'] = $row['rating'];
        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);


?>