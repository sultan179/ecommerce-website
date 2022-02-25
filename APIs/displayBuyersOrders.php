<?php
    include '../backend/connection.php';
    include '../businessLogic/orders.php';

    $con = connect();
    $buyer = isset($_GET['buyer']) ? $_GET['buyer'] : die();
    $result = getOrdersByBuyer($con, $buyer);

    header("Content-Type: JSON");

    $rowNumber = 0;
    $output = array();

    while ($row = mysqli_fetch_array($result)) {
        $output[$rowNumber]['order_id'] = $row['order_id'];
        $output[$rowNumber]['seller'] = $row['seller'];
        $output[$rowNumber]['ship_date'] = $row['ship_date'];
        $output[$rowNumber]['order_status'] = $row['order_status'];
        $output[$rowNumber]['cart_items'] = $row['cart_items'];
        $output[$rowNumber]['order_place_date'] = $row['order_place_date'];
        $rowNumber++;
    }
    echo json_encode($output, JSON_PRETTY_PRINT);
?>