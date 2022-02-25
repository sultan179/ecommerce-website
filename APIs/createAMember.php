<?php
    include '../backend/connection.php';
    include '../businessLogic/member.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $em = $data['email'];
    $pwd = $data['password'];
    $nme = $data['name'];
    $unme = $data['userName'];
    $adr = $data['address'];
    $phn = $data['phone'];
    $gen = $data['gender'];

    if (addMember(
        $con,
        $em,
        $pwd,
        $nme,
        $unme,
        $adr,
        $phn,
        $gen
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