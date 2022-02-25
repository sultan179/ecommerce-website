<?php
    //Method to be called when displaying information of certian order
    function getOrderedProductDetails($con, $order_id) {
        $sql = "SELECT * from order_details where order_id='{$order_id}'";
        return mysqli_query($con, $sql);
    }
    //Method to be called when transaction has been processed to store order information
    function storeOrderInformation(
        $con,
        $firstname,
        $lastname,
        $phone,
        $email,
        $baddress,
        $saddress,
        $country,
        $state,
        $zip,
        $order_id
        ) {
        $query = "INSERT into order_details(fname,lname,phone,email,b_address,s_address,country,state,zip,order_id) values (?,?,?,?,?,?,?,?,?,?);";

        //clean the data being inputted
        $fname = htmlspecialchars(strip_tags($firstname));
        $lname = htmlspecialchars(strip_tags($lastname));
        $phn = htmlspecialchars(strip_tags($phone));
        $em = htmlspecialchars(strip_tags($email));
        $baddr = htmlspecialchars(strip_tags($baddress));
        $saddr = htmlspecialchars(strip_tags($saddress));
        $ctry = htmlspecialchars(strip_tags($country));
        $st = htmlspecialchars(strip_tags($state));
        $z = htmlspecialchars(strip_tags($zip));
        $odrid = htmlspecialchars(strip_tags($order_id));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ssssssssss',
            $fname,
            $lname,
            $phn,
            $em,
            $baddr,
            $saddr,
            $ctry,
            $st,
            $z,
            $odrid
        );

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }
?>