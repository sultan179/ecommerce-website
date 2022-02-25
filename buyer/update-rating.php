<?php

    include('../dbconfig.php');
    $id=$_POST['id'];
    $rating=$_POST['rating'];
    $review=$_POST['review'];
    $email=$_POST['email'];
        
            $query="INSERT into product_review(review,rating,product_id,buyer) Values('{$review}',{$rating},{$id},'{$email}')";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>