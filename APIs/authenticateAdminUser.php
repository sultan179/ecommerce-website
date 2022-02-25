<?php
    include '../backend/connection.php';
    include '../businessLogic/admin.php';

    $con = connect();

    $email = isset($_GET['email']) ? $_GET['email'] : die();
    $password = isset($_GET['password']) ? $_GET['password'] : die();

    $result = displayAdminUsersByEmailAndPassword($con, $email, $password);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['First name'] = $row['fname'];
        $output[$rowNumber]['Middle name'] = $row['mname'];
        $output[$rowNumber]['Last name'] = $row['lname'];
        $output[$rowNumber]['Date of birth'] = $row['dob'];
        $output[$rowNumber]['Gender'] = $row['gender'];

        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);
?>