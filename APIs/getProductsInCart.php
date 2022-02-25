<?php
    include '../backend/connection.php';
    include '../businessLogic/cart.php';

    $con = connect();

    $email = isset($_GET['buyers_email']) ? $_GET['buyers_email'] : die();

    $result = displayCartProducts($con, $email);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['cartId'] = $row['id'];
        $output[$rowNumber]['productsName'] = $row['product_title'];
        $output[$rowNumber]['productPrice'] = $row['price'];
        $output[$rowNumber]['productCategory'] = $row['category'];

        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);


?>