<?php
    //Method to be called when transaction has been processed to store payment information
    function storePaymentInformation(
        $con,
        $cardname,
        $cardnumber,
        $cvv,
        $edate,
        $order_id
        ) {
        $query = "INSERT into payment_information(card_owner,card_number,cvv,expiry_date,order_id) values(?,?,?,?,?)";

        //clean the data being inputted
        $cardName = htmlspecialchars(strip_tags($cardname));
        $cardNum = htmlspecialchars(strip_tags($cardnumber));
        $cvv = htmlspecialchars(strip_tags($cvv));
        $eDate = htmlspecialchars(strip_tags($edate));
        $id = htmlspecialchars(strip_tags($order_id));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'sssss',
            $cardName,
            $cardNum,
            $cvv,
            $eDate,
            $id
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