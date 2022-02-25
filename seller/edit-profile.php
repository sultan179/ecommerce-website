<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
}
$user_email = $_SESSION['user_email'];
include('../dbconfig.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <?php include('./navbar.php') ?>
    <h1 class="text-center  mb-4 mt-5 display1 text-primary">Edit Profile</h1>
    <?php
    if (isset($_POST['save-button'])) {
        if ($_POST['password'] == $_POST['cpassword']) {
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
            $password = sha1($POST['password']);
            $address = $POST['address'];
            $phone = $POST['phone'];
            $name = $POST['name'];
                $sql = "UPDATE member set member_name='{$name}',phone_no='{$phone}',password='{$password}',address='{$address}' where email='${user_email}'";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<p class='text-center alert alert-success mt-4 mb-4'>Profile Edited Successfully</p>";
                    // header('Location: ./user/plans.php');
                } else {
                    echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
                }
            
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Passwords does not Match!</p>";
        }
    }
        $sql = "SELECT * from member where email='${user_email}'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-lg-auto col-md-8 m-md-auto col-sm-10 m-sm-auto">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="addForm">
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value=<?php echo $row['member_name'] ?> required>
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
                        <input type="text" class="form-control" name="address" value=<?php echo $row['address'] ?> required>
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value=<?php echo $row['phone_no'] ?> required>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-3 ml-auto mr-auto mb-5 mt-3">
                            <button class="btn btn-primary" type="submit" name="save-button" name="save-button">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>