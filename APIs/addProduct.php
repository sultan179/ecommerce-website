<?php
    include '../backend/connection.php';
    include '../businessLogic/product.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $title = $data['product_title'];
    $description = $data['product_description'];
    $price = $data['price'];
    $image = $data['image_url'];
    $email = $data['seller'];
    $category = $data['category'];

    if (addNewProduct(
        $con,
        $title,
        $description,
        $price,
        $image,
        $email,
        $category
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