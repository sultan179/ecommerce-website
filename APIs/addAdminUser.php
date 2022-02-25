<?php
    include '../backend/connection.php';
    include '../businessLogic/admin.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $em = $data['email'];
    $pwd = $data['password'];
    $fname = $data['firstname'];
    $mname = $data['middlename'];
    $lname = $data['lastname'];
    $dob = $data['dateOfBirth'];
    $gender = $data['gender'];

    if (createAdmin(
        $con,
        $em,
        $pwd,
        $fname,
        $mname,
        $lname,
        $dob,
        $gender
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