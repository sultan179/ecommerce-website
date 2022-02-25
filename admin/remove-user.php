<?php

    include('../dbconfig.php');
    $email=$_POST['email'];
        
            $query="DELETE FROM member WHERE email='{$email}'";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>