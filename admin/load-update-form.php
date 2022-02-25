<?php

$id = $_POST["id"];

include('../dbconfig.php');

$sql = "SELECT category FROM product WHERE id = {$id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$output="";


$output .="

<div class='mb-3 mt-3'>
<select style='font-size:20px'; name='category' id='category' class='form-select w-100'>
<option selected value='Old Books'>Old Books</option>
<option value='New Books'>New Books</option>
<option value='Lab Supplies'>Lab Supplies</option>
<option value='Gifts'>Gifts</option>
<option value='Electronics'>Electronics</option>
</select>";
                         $output .="
                         <input class='btn btn-primary mt-3 ml-auto' data-id='". $id . "' type='submit' id='edit-submit' value='save'>
                    </div>";



    mysqli_close($conn);

    echo $output;


?>
