<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
}
$email = $_SESSION['user_email'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <style>
        .img{
            width: 300px;
            height: 300px;
        }
        </style>
    </head>
    <body>
    <?php
    include('../dbconfig.php');
    if(isset($_GET['id'])){
        $product = $_GET['id'];
        $sql = "SELECT * from product where id=${product}";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }
    }else{
        echo "<script>window.location.replace('./order-details.php')</script>";
    } 
?>
        <?php 
        // include('./navbar.php');
        ?>
        <div class="container text-center mt-5">
        <div class="row">
                <div class="col-sm-4">
                    <h3 class="mb-3" style="font-size: 18px;"><?php echo $row['product_title'] ?></h3>
                    <img src="<?php echo $row['image_url'] ?>" alt="Elmasri textbook" class="img img-rounded">
                </div>
                <div class="col-sm-8">
                    <h3>Category: <?php echo $row['category'] ?></h3>
                    <h5 style="font-size: 16px;" class="text-left">Price: $<?php echo number_format($row['price'],2) ?></h5>
                    <p style="font-size: 16px;" class="jumbotron">
                        Sellers Description: <?php echo $row['product_description'] ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="container text-left mt-5">
            <div class="row">
                <h2>User product reviews</h2>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
        <?php
    $sql = "SELECT product_review.rating,product_review.review,member.member_name from product_review inner join member on product_review.buyer=member.email where product_review.product_id={$product}";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row=mysqli_fetch_row($result)){
            ?>
                <div class="alert alert-success w-100 mb-4">
                    <h5 style="font-size: 18px;" class="text-left">User: <?php echo $row[2] ?></h5>
                    <h5 style="font-size: 18px;" class="text-left">Rating: <?php echo $row[0] ?></h5>
                    <p style="font-size: 22px;" class="text-left">
                        Review: <?php echo $row[1] ?>
                    </p>
                </div>
     <?php       
        }
    }

?>
        
            </div>
        </div>
        <script src="./js/jquery.min.js"></script>
        <script>
    $(() => {
        $(document).on("click", "#btn", function() {
            var r = confirm("Are You Sure You want to add this Product to cart!");
            if (r == true) {
                let id = $(this).data('id');
                let email = $(this).data('email');
                $.ajax({
                    url: './buyer/add-to-cart.php',
                    type: 'POST',
                    data: {
                        id,
                        email
                    },
                    success: function(data) {
                        if (data == 1) {
                            alert("Product added to Cart.");
                        } else {
                            alert("Can't add to Cart.");
                        }
                    }
                })
            } else {
                alert("You pressed Cancel!. Product is Not added to Cart.");
            }
        })
    })
</script>
    </body>
</html>