<?php
    include '../backend/connection.php';
    include '../businessLogic/orders.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $id = $data['orderId'];
    $cart_items = $data['cartItems'];
    $uemail = $data['userEmail'];
    $semail = $data['sellerEmail'];

    if (storeOrder(
        $con,
        $id,
        $cart_items,
        $uemail,
        $semail
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