<?php
    //Method to be called when displaying orders of certain buyer
    function getOrdersByBuyer($con, $email) {
        $query = "SELECT * from orders where buyer='{$email}' order by order_place_date desc";
        return mysqli_query($con, $query);
    }
    //Method to be called when displaying orders of certain Seller
    function getOrdersBySeller($con, $email) {
        $query = "SELECT * from orders where seller='{$email}' order by order_place_date desc";
        return mysqli_query($con, $query);
    }

    //Method to be called when seller adds an item
    function storeOrder(
        $con,
        $order_id,
        $cart_items,
        $user_email,
        $seller_email
        ) {
        $query = "INSERT into orders(order_id,order_status,cart_items,buyer,seller) VALUES(?,'In Progress',?,?,?)";

        //clean the data being inputted
        $id = htmlspecialchars(strip_tags($order_id));
        $cartItems = htmlspecialchars(strip_tags($cart_items));
        $userEmail = htmlspecialchars(strip_tags($user_email));
        $sellerEmail = htmlspecialchars(strip_tags($seller_email));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'isss',
            $id,
            $cartItems,
            $userEmail,
            $sellerEmail
        );

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }
    //Method to be called to update shipping date of order
    function shipOrder(
        $con,
        $shippingDate,
        $orderId
    ) {
        $query="UPDATE orders set ship_date=?,order_status='shipped' WHERE order_id=?";
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ss',
            $shipDate,
            $id
        );
        
        //clean the data being inputted
        $shipDate = htmlspecialchars(strip_tags($shippingDate));
        $id = htmlspecialchars(strip_tags($orderId));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }

    //Method to be called when Buyer deletes an order
    function deleteAnOrder($con, $order_id) {
        $query = "DELETE from orders where order_id=?";
        
        $stmt = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($stmt, 'i', $orderId);

        $orderId = htmlspecialchars(strip_tags($order_id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        }
        echo 'error updating data';
        return false;  
    }
?>