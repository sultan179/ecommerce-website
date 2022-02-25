<?php
    include '../backend/connection.php';
    include '../businessLogic/payment_information.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $cname = $data['cardOwnerName'];
    $cnumber = $data['cardNumber'];
    $cvv = $data['cvv'];
    $expdate = $data['cardExpiryDate'];
    $id = $data['orderId'];

    if (storePaymentInformation(
        $con,
        $cname,
        $cnumber,
        $cvv,
        $expdate,
        $id
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