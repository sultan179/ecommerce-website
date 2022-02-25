<?php
session_start();
if (isset($_SESSION['admin_email'])) {
      // header('Location: ./login.php');
}
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
  <center>  <h1> Admin Login</h1> </center>
  <?php
  include('../dbconfig.php');
  if (isset($_POST['login-button'])) {
    $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $email = $POST['email'];
    $password = sha1($POST['password']);
    $sql="select * from admin where email='{$email}' and password='{$password}'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0 ){
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['admin_email']=$row['email'];
            header('Location: ./member-list.php');
    }
    else {
        echo "<p class='text-center alert alert-danger mt-5'>Wrong Credentials</p>";
    }
}
    ?>  
  <hr>
  <form action="login.php" method="post">
 <br><label for="email"><b>Email</b></label>  
 <input type="email" placeholder="Enter Email" name="email" required>  
  
    <label for="psw"><b>Password</b></label>  
    <input type="password" placeholder="Enter Password" name="password" required>   
    <button type="submit" name="login-button" class="registerbtn">Log In</button>    
</form>  
</body>  
</html>  