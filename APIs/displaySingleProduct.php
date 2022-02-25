<?php
    include '../backend/connection.php';
    include '../businessLogic/product.php';

    $con = connect();
    $id = isset($_GET['productId']) ? $_GET['productId'] : die();
    $result = displayOneProduct($con, $id);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['product_title'] = $row['product_title'];
        $output[$rowNumber]['product_description'] = $row['product_description'];
        $output[$rowNumber]['category'] = $row['category'];
        $output[$rowNumber]['price'] = $row['price'];
        $output[$rowNumber]['image_url'] = $row['image_url'];
        $output[$rowNumber]['date_added'] = $row['date_added'];
        $output[$rowNumber]['status'] = $row['status'];
        $output[$rowNumber]['seller'] = $row['seller'];
        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);


?>