<?php
    include '../backend/connection.php';
    include '../businessLogic/admin.php';

    $con = connect();
    //Headers needed
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');


    $data = json_decode(file_get_contents("php://input"), true);
    
    $Fname = $data['fname'];
    $Mname = $data['mname'];
    $Lname = $data['lname'];
    $Pwd = $data['password'];
    $DOB = $data['dob'];
    $Email = $data['email'];
    

    if (editAdmin(
        $con,
        $Fname,
        $Mname,
        $Lname,
        $Pwd,
        $DOB,
        $Email)) {
        echo json_encode(
            array('message' => 'post updated')
        );
    } else {
        echo json_encode(
            array('message' => 'post not updated')
        );
    }


?>