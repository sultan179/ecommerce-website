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
    <title>Edit Product | ECommerce</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="../css/style.css"> -->
    <!-- <link rel="icon" type="image/gif" href="../images/logo.gif"/> -->
</head>

<body>
    <?php
    if(isset($_GET['id'])){
        $product = $_GET['id'];
        $sql = "SELECT * from product where id=${product}";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
    } 
?>
<?php include('./navbar.php') ?>
    <h1 class="text-center text-primary mb-5 mt-5">Edit Product</h1>
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
        $id = $POST['id'];
        $query = "UPDATE product set product_title='{$title}', product_description='{$description}',price={$price},image_url='{$path}',seller='{$user_email}',category='{$category}' where id =${id}";
        if ($result = mysqli_query($conn, $query)) {
            echo "<p class='text-center alert alert-success mt-4 mb-4'>Product Updated Successfully</p>";
            echo "<script>
            setTimeout(function(){window.location.replace('myproducts.php')}, 3000);
            </script>";   
        } else {
            echo "<p class='text-center alert alert-danger mt-4 mb-4'>Error</p>";
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-lg-auto col-md-8 m-md-auto col-sm-10 m-sm-auto">
                <form method="post" name="edit-product.php" id="form" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product ?>">
                    <div class="mb-4">
                        <label for="email" class="form-label">Product Title</label>
                        <input type="text" class="form-control" value="<?php if(isset($row)){
            echo $row['product_title'];
        } ?>" name="title" required>
                    </div>
                    <div class="form-group mb-4">
                        <label>Product Description</label>
                        <textarea required class="form-control" name="description"  rows="5"><?php if(isset($row)){
            echo $row['product_description'];
        } ?></textarea>
                    </div>
                    <div class="mb-4">
                    <label class="mr-2">Product Category: </label>
                        <select style='font-size:20px'; name="category" class="form-select w-100">
                            <option selected value="Old Books">Old Books</option>
                            <option value="New Books">New Books</option>
                            <option value="Lab Supplies">Lab Supplies</option>
                            <option value="Gifts">Gifts</option>
                            <option value="Electronics">Electronics</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" value="<?php if(isset($row)){
            echo $row['price'];
        } ?>" required>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label>Photo of Product</label>
                        <input type="file" class="form-control-file" name="photo" accept="image/png,image/jpg,image/jpeg" required>
                    </div>
                    <div class="row">
                        <div class="col-3 ml-auto mr-auto mb-5 mt-3">
                            <button style="padding: 5px 25px;" class="btn btn-primary" type="submit" name="s-button">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>