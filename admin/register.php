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
  <center>  <h1> Admin Registration</h1> </center>
  <?php
  include('../dbconfig.php');
    if (isset($_POST['save-button'])) {
        if ($_POST['password'] == $_POST['cpassword']) {
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $email = $POST['email'];
            $password = sha1($POST['password']);
            $firstname = $POST['firstname'];
            $lastname = $POST['lastname'];
            $middlename = $POST['middlename'];
            $DOB = $POST['DOB'];
            $gender = $POST['gender'];
            $query = "SELECT * from admin where email='{$email}'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $sql = "insert into admin values('${email}','${password}','${firstname}','${middlename}','${lastname}','${DOB}','${gender}')";
                if ($result = mysqli_query($conn, $sql)) {
                    session_start();
                    $_SESSION['admin_email'] = $email;
                    echo "<p class='text-center alert alert-success mt-4 mb-4'>Registered Successfully</p>";
                    // header('Location: ./user/plans.php');
                } else {
                    echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
                }
            }else{
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>User Already Exists</p>";
            }
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Passwords does not Match!</p>";
        }
    }
    ?>  
  <hr>
  <form action="register.php" method="post">
  <label> Firstname </label>   
<input type="text" name="firstname" placeholder= "Firstname" size="15" required />   
<label> Middlename: </label>   
<input type="text" name="middlename" placeholder="Middlename" size="15" required />   
<label> Lastname: </label>    
<input type="text" name="lastname" placeholder="Lastname" size="15"required />   
<div>  
<label>   

Gender :  
</label><br>  
<input type="radio" value="Male" name="gender" checked > Male   
<input type="radio" value="Female" name="gender"> Female   
<input type="radio" value="Other" name="gender"> Other 
  
</div>  
    <label for="DateOfBirth"><b>DateOfBirth</b></label>  
    <input type="date" placeholder="Enter DOB" name="DOB" required>  
 
 <br><label for="email"><b>Email</b></label>  
 <input type="email" placeholder="Enter Email" name="email" required>  
  
    <label for="psw"><b>Password</b></label>  
    <input type="password" placeholder="Enter Password" name="password" required>  
  
    <label for="psw-repeat"><b>Re-type Password</b></label>  
    <input type="password" placeholder="Retype Password" name="cpassword" required>  
    <button type="submit" name="save-button" class="registerbtn">Register</button>    
</form>  
</body>  
</html>  