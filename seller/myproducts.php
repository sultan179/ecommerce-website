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
    <h1 class="text-center text-primary mt-5 mb-5">My Products</h1>
    <div class="container mt-5">
        <div class="row">
            <?php
            include('../dbconfig.php');
            $sql = "SELECT * from product where seller='{$user_email}' order by date_added desc";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-4 col-sm-6 mb-5 mx-sm-0 gy-2 mx-5 px-sm-3 px-5 d-flex align-items-stretch">
                        <div class="card">
                            <img src="<?php echo $row['image_url']  ?>" class="card-img-top" alt="Day Care">
                            <div class="card-body">
                                <h5><a href="./product-display.php?id=<?php echo $row['id'] ?>" class="card-title"><?php echo $row['product_title']  ?></a></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Category: <?php echo $row['category']  ?></li>
                                <li class="list-group-item">Price: <?php echo $row['price']  ?>$</li>
                                <li class="list-group-item">Status: <?php echo $row['status']  ?></li>
                                <li class="list-group-item">Date Added: <?php echo date('M j,Y', strtotime($row['date_added']))   ?></li>
                            </ul>
                            <div class="text-center mt-3 mb-3">
                                <a target="_blank" href="./edit-product.php?id=<?php echo $row['id'] ?>" class="btn btn-outline-warning mr-2" href="">Edit</a>
                                <button class="btn btn-outline-danger " style="cursor: pointer; text-align:right;" id="btn" data-id="<?php echo $row['id'] ?>">Delete</button>

                            </div>
                        </div>

                    </div>
                <?php
                }
                ?>


        </div>
    </div>
<?php
            } else {
                echo "<p class='text-center w-100 alert alert-danger mt-4'>No Products</p>";
            }
?>
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