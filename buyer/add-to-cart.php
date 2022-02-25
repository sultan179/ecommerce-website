<?php

    include('../dbconfig.php');
    $id=$_POST['id'];
    $email=$_POST['email'];
        
            $query="INSERT into cart(product_id,buyer) VALUES ($id,'$email')";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>