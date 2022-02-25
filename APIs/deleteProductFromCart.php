<?php
    include '../backend/connection.php';
    include '../businessLogic/cart.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $id = $data['cartId'];

    if (deleteProductFromCart(
        $con,
        $id)) {
        echo json_encode(
            array('message' => 'post deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'post not deleted')
        );
    }
?>