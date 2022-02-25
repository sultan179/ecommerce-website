<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <?php include('navbar.php') ?>
    <h1 class="text-center  mb-4 mt-5 display1 text-primary">Sign Up</h1>
    <?php
    include('./dbconfig.php');
    if (isset($_POST['save-button'])) {
        if ($_POST['password'] == $_POST['cpassword']) {
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $email = $POST['email'];
            $password = sha1($POST['password']);
            $user_name = $POST['user_name'];
            $address = $POST['address'];
            $phone = $POST['phone'];
            $gender = $POST['gender'];
            $name = $POST['name'];
            $query = "SELECT * from member where email='{$email}' or user_name='{$user_name}'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) == 0) {
                $sql = "insert into member values('${email}','${password}','${name}','${user_name}','${address}','${phone}','${gender}')";
                if ($result = mysqli_query($conn, $sql)) {
                    session_start();
                    $_SESSION['user_email'] = $email;
                    echo "<p class='text-center alert alert-success mt-4 mb-4'>Registered Successfully</p>";
                echo "<script>
                setTimeout(function(){window.location.replace('./seller/myproducts.php')}, 3000);
                </script>"; 
                } else {
                    echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
                }
            } else {
                echo "<p class='text-center alert alert-danger mt-4 mb-4'>User Already Exists</p>";
            }
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Passwords does not Match!</p>";
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-lg-auto col-md-8 m-md-auto col-sm-10 m-sm-auto">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="addForm">
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="user_name" required>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-4">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" required>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <label for="gender" class="form-label">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" checked>
                        <label class="form-check-label" for="gender1">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="gender2"  >
                        <label class="form-check-label" for="gender2">
                            Female
                        </label>
                    </div><br>
                    <a href="./login.php">Already have an account? Log In</a>
                    <div class="row">
                        <div class="col-sm-2 col-3 ml-auto mr-auto mb-5 mt-3">
                            <button class="btn btn-primary" type="submit" name="save-button" name="save-button">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>