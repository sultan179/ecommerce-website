<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
      header('Location: ./login.php');
}
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
    include('../dbconfig.php');
if(!isset($_GET['id'])){
    echo "<script>window.location.replace('orders-list.php')</script>";
}
$id = $_GET['id'];
?>
    <div class="container mt-5">
        
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