<?php
    include '../backend/connection.php';
    include '../businessLogic/order_details.php';

    $con = connect();

    $id = isset($_GET['orderId']) ? $_GET['orderId'] : die();

    $result = getOrderedProductDetails($con, $id);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['order ID'] = $row['order_id'];
        $output[$rowNumber]['First name'] = $row['fname'];
        $output[$rowNumber]['Last name'] = $row['lname'];
        $output[$rowNumber]['Buyer Phone #'] = $row['phone'];
        $output[$rowNumber]['Buyers email'] = $row['email'];
        $output[$rowNumber]['Billing address'] = $row['b_address'];
        $output[$rowNumber]['Shipping address'] = $row['s_address'];
        $output[$rowNumber]['Country'] = $row['country'];
        $output[$rowNumber]['State'] = $row['state'];
        $output[$rowNumber]['Zip code'] = $row['zip'];

        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);


?>