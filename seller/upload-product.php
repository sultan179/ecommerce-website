<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
}
$user_email = $_SESSION['user_email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product | ECommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <!-- <link rel="icon" type="image/gif" href="../images/logo.gif"/> -->
</head>

<body>
    <?php include('./navbar.php') ?>
    <h1 class="text-center text-primary mb-5 mt-5">Upload Product</h1>
    <?php
    include('../dbconfig.php');
    if (isset($_POST['s-button'])) {
        if ($_FILES['photo']['name']) {
            $fileInfo = $_FILES['photo'];
            $fileName = $fileInfo['name'];
            $fileTmp = $fileInfo['tmp_name'];
            $path = "../product_image_urls/" . uniqid() . $fileName;
            move_uploaded_file($fileTmp, $path);
        }
        $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
        $title = $POST['title'];
        $description = $POST['description'];
        $price = $POST['price'];
        $category = $POST['category'];
        $query = "INSERT into product(product_title,product_description,price,image_url,seller,status,category) values('{$title}','{$description}',{$price},'{$path}','{$user_email}','pending','{$category}')";
        if (mysqli_query($conn, $query)) {
            echo "<p class='text-center alert alert-success mt-4 mb-4'>Product Added Successfully</p>";
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-lg-auto col-md-8 m-md-auto col-sm-10 m-sm-auto">
                <form method="post" name="upload-product.php" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="email" class="form-label">Product Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group mb-4">
                        <label>Product Description</label>
                        <textarea required class="form-control" name="description" rows="5"></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label class="mr-2">Product Category: </label>
                        <select style='font-size:20px'; name="category" required class="form-select w-100">
                            <option selected value="Old Books">Old Books</option>
                            <option value="New Books">New Books</option>
                            <option value="Lab Supplies">Lab Supplies</option>
                            <option value="Gifts">Gifts</option>
                            <option value="Electronics">Electronics</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Photo of Product</label>
                        <input type="file" class="form-control-file" name="photo" accept="image/png,image/jpg,image/jpeg" required>
                    </div>
                    <div class="row">
                        <div class="col-3 ml-auto mr-auto mb-5 mt-3">
                            <button style="padding: 5px 25px;" class="btn btn-primary" type="submit" name="s-button">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <script>
        var d = new Date();
        document.getElementById("time").setAttribute('value', d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds());
    </script> -->
</body>

</html>