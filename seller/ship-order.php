<?php

    include('../dbconfig.php');
    $id=$_POST['id'];
        $date = date('Y-m-d');
            $query="UPDATE orders set ship_date='{$date}',order_status='shipped' WHERE order_id='{$id}'";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>