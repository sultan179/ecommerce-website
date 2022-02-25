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
    <title>Products</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <?php include('./navbar.php') ?>
    <?php
if(!isset($_GET['id']) && !isset($_GET['cart'])){
    echo "<script>window.location.replace('orders-list.php')</script>";
}
$id = $_GET['id'];
$cart = $_GET['cart'];
$cart = explode('|',$cart);
?>
    <div class="container mt-5">
        <h1 class="text-primary text-center mt-2 mb-5">Products In the order</h1>
        <div class="row">
            <?php
            $results = array();
            include('../dbconfig.php');
            for($i=0; $i<sizeof($cart); $i++){
                $sql = "SELECT product.product_title,product.price,product.category,product.image_url,product.id from product inner join
                cart on cart.product_id=product.id
                where cart.status=0 and cart.id=$cart[$i]
        ";
            $result = mysqli_query($conn, $sql);
            array_push($results,mysqli_fetch_row($result));
            }
                for ($i=0; $i<sizeof($results); $i++) {
            ?>
                    <div class="col-md-4 col-sm-6 mb-5 mx-sm-0 gy-2 mx-5 px-sm-3 px-5 d-flex align-items-stretch">
                        <div class="card">
                            <img src="<?php echo $results[$i][3]  ?>" class="card-img-top" alt="Day Care">
                            <div class="card-body">
                                <h5><a href="./product-display.php?id=<?php echo $results[$i][4] ?>" class="card-title"><?php echo $results[$i][0]  ?></a></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Category: <?php echo $results[$i][2]  ?></li>
                                <li class="list-group-item">Price: <?php echo number_format($results[$i][1],2)  ?>$</li>
                            </ul>
                        </div>

                    </div>
                <?php
                }
                ?>
        </div>
        <h1 class="text-primary text-center mt-2 mb-5">Shipping details</h1>
        <?php
            $sql = "SELECT * from order_details where order_id='{$id}'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_row($result);
        ?>
        <div class="row">
        <div class="col-12 m-auto text-center">
            <div style="text-align: center; display:flex; flex-direction:row; justify-content:center;">
              <div style="text-align: justify; display:flex; flex-direction:column;">
                  <div class="mb-3 mr-5"><b>First Name:</b></div>
                  <div class="mb-3 mr-5"><b>Last Name:</b></div>
                  <div class="mb-3 mr-5"><b>Email:</b></div>
                  <div class="mb-3 mr-5"><b>Phone:</b></div>
                  <div class="mb-3 mr-5"><b>Billing Address:</b></div>
                  <div class="mb-3 mr-5"><b>Shipping Address:</b></div>
                  <div class="mb-3 mr-5"><b>Country:</b></div>
                  <div class="mb-3 mr-5"><b>State:</b></div>
                  <div class="mb-3 mr-5"><b>Zip:</b></div>
              </div>    
                <div style="text-align: justify; display:flex; flex-direction:column;">
                <div class="mb-3 mr-5"><b><?php echo $row[1] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[2] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[4] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[3] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[5] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[6] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[7] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[8] ?></b></div>
                  <div class="mb-3 mr-5"><b><?php echo $row[9] ?></b></div>
                </div>
            </div>
        </div>
      </div>
    </div>
<script src="../js/jquery.min.js"></script>
<script>
    $(() => {
        $(document).on("click", "#btn", function() {
            var r = confirm("Are You Sure You want to Remove this Product!");
            if (r == true) {
                let id = $(this).data('id');
                $.ajax({
                    url: 'remove-product.php',
                    type: 'POST',
                    data: {
                        id
                    },
                    success: function(data) {
                        if (data == 1) {
                            window.location.reload();
                        } else {
                            alert("Can't Remove Product.");
                        }
                    }
                })
            } else {
                alert("You pressed Cancel!. Product is Not removed.");
            }
        })
    })
</script>
</body>

</html>