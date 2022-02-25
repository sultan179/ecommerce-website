<?php

$id = $_POST["id"];
$email = $_POST["email"];

$output="";


$output .="

<div class='mb-3 mt-3'>
<input type='hidden' id='email' value=".$email." required /><br>
                        <label>Rating</label>
                        <select  class='form-select' id='rating' name='rating' required >
                        <option value='1' >1</option>
                        <option value='2' >2</option>
                        <option value='3' >3</option>
                        <option value='4' >4</option>
                        <option value='5' >5</option>
                        </select>
                        <br>
                        <label>Review</label>
                        <input type='text' class='form-control' id='review' name='review'  required /><br>";
                         $output .="
                         <input class='btn btn-primary mt-3 ml-auto' data-id='". $id . "' type='submit' id='edit-submit' value='save'>
                    </div>";



    echo $output;


?>
