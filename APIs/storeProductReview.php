<?php
    include '../backend/connection.php';
    include '../businessLogic/product_review.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $comments = $data['review'];
    $rating = $data['rating'];
    $productId = $data['product_id'];
    $email = $data['reviewers_email'];

    if (addProductReview(
        $con,
        $comments,
        $rating,
        $productId,
        $email
        )) {
            echo json_encode(
                array('message' => 'post created')
            );
    } else {
        echo json_encode(
            array('message' => 'post not created')
        );
    }


?>