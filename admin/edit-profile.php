<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
      header('Location: ./login.php');
}
$admin_email = $_SESSION['admin_email'];
?>
<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<style>  
body{  
  font-family: Calibri, Helvetica, sans-serif;  
  background-color: pink;  
}  
.container {  
    padding: 50px;  
  background-color:rgb(228, 232, 236);  
  
  background-color: rgb(236, 161, 106);

  
}  
  
input[type=text], input[type=password], input[type=email], textarea {  
  width: 100%;  
  padding: 15px;  
  margin: 5px 0 22px 0;  
  display: inline-block;  
  border: none;  
  background: #f0efef;  
}  
/* input[type=text]:focus, input[type=password]:focus {  
  background-color: rgb(10, 10, 10);  
  outline: none;  
}   */
 div {  
            padding: 10px 0;  
         }  
hr {  
  border: 1px solid #f1f1f1;  
  margin-bottom: 25px;  
}  
.registerbtn {  
  background-color: #020702; 
  width: 100px; 
  color: white;  
  padding: 16px 20px;  
  margin: 8px 0;  
  border: none;  
  cursor: pointer;  
  width: 100%;  
  opacity: 0.9;  
}  
.registerbtn:hover {  
  opacity: 1;  
}  
</style>  
</head>  
<body>
  <div class="container">  
  <center>  <h1> Admin Edit Profile</h1> </center>
  <?php
  include('../dbconfig.php');
    if (isset($_POST['save-button'])) {
        if ($_POST['password'] == $_POST['cpassword']) {
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $password = sha1($POST['password']);
            $firstname = $POST['firstname'];
            $lastname = $POST['lastname'];
            $middlename = $POST['middlename'];
            $DOB = $POST['DOB'];
                $sql = "UPDATE admin set mname='{$middlename}',lname='{$lastname}',fname='{$firstname}',password='{$password}',dob='{$DOB}' where email='${admin_email}'";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<p class='text-center alert alert-success mt-4 mb-4'>Profile Updated Successfully</p>";
                } else {
                    echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
                }
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Passwords does not Match!</p>";
        }
    }
    $sql = "SELECT * from admin where email='${admin_email}'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
    ?>  
  <hr>
  <form action="edit-profile.php" method="post">
  <label> Firstname </label>   
<input type="text" name="firstname" placeholder= "Firstname" value=<?php echo $row['fname'] ?> size="15" required />   
<label> Middlename: </label>   
<input type="text" name="middlename" value=<?php echo $row['mname'] ?> placeholder="Middlename" size="15" required />   
<label> Lastname: </label>    
<input type="text" name="lastname" value=<?php echo $row['mname'] ?> placeholder="Lastname" size="15"required />   
 
    <label for="DateOfBirth"><b>DateOfBirth</b></label>  
    <input type="date" placeholder="Enter DOB" value=<?php echo $row['dob'] ?> name="DOB" required>  
 
  <br>
    <label for="psw"><b>Password</b></label>  
    <input type="password" placeholder="Enter Password" name="password" required>  
  
    <label for="psw-repeat"><b>Re-type Password</b></label>  
    <input type="password" placeholder="Retype Password" name="cpassword" required>  
    <button type="submit" name="save-button" class="registerbtn">Edit</button>    
</form>  
</body>  
</html>  