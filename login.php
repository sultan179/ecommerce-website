<?php
session_start();
if (isset($_SESSION['user_email'])) {
    header('Location: ./seller/myproducts.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <?php include('navbar.php') ?>
    <h1 class="text-center mb-md-5 mb-sm-4 mt-5 display1 text-primary">Login</h1>
    <?php
    if (isset($_POST['save-button'])) {

        include('./dbconfig.php');
        $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
        $email = $POST['email'];
        $password = sha1($POST['password']);
        $sql = "select email from member where email='{$email}' and password='{$password}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_email'] = $row['email'];
            echo "<p class='text-center alert alert-success mt-4'>Success</p>";
            header('Location: ./seller/myproducts.php');
        } else {
            echo "<p class='text-center alert alert-danger mt-4'>Wrong Credentials</p>";
        }
    }
    ?>
    <div class="container ">
        <div class="row">
            <div class="col-lg-6 m-lg-auto col-md-8 m-md-auto col-sm-10 m-sm-auto">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="example@gmail.com" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <a href="./register.php">Don't have an account? Sign Up</a>
                    <div class="row">
                        <div class="col-sm-2 col-3 ml-auto mr-auto mb-4 mt-3">
                            <button class="btn btn-primary" type="submit" name="save-button" id="save-button">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>