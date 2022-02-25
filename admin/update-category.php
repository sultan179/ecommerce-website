<?php
$id = $_POST['id'];
$category=$_POST['category'];
include('../dbconfig.php');
        $query="UPDATE product set category='{$category}' WHERE id={$id}";
         if(mysqli_query($conn,$query)){
                echo 1;
            }else{
                echo 0;
            } 

?>