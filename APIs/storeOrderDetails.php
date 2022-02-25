<?php
    include '../backend/connection.php';
    include '../businessLogic/order_details.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $fname = $data['firstName'];
    $lname = $data['lastName'];
    $phn = $data['phone'];
    $em = $data['email'];
    $baddress = $data['billingAddress'];
    $saddress = $data['shippingAddress'];
    $cnty = $data['country'];
    $st = $data['state'];
    $zip = $data['zipCode'];
    $id = $data['orderId'];

    if (storeOrderInformation(
        $con,
        $fname,
        $lname,
        $phn,
        $em,
        $baddress,
        $saddress,
        $cnty,
        $st,
        $zip,
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