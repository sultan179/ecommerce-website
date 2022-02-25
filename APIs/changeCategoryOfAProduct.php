<?php
    include '../backend/connection.php';
    include '../businessLogic/product.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $newCategory = $data['newCategory'];
    $ID = $data['id'];

    if (changeCategoryOfAProduct(
        $con,
        $newCategory,
        $ID)) {
            echo json_encode(
                array('message' => 'post updated')
            );
    } else {
        echo json_encode(
            array('message' => 'post not updated')
        );
    }


?>