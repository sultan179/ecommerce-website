<?php

    include('../dbconfig.php');
    $id=$_POST['id'];
    $status=$_POST['status'];
    if($status=='Approve'){
        $status='active';
    }else{
        $status='Disapproved';
    }
        
            $query="UPDATE product set status='{$status}' WHERE id={$id}";
            if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            }

?>