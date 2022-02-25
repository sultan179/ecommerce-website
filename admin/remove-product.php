<?php

    include('../dbconfig.php');
    $id=$_POST['id'];
        
            $query="DELETE FROM product WHERE id={$id}";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>