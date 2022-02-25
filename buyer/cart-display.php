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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <style>
        </style>
    </head>
    <body>
    
        <?php include('./navbar.php')  ?>
        <div class="container-fluid text-center">
            <div class="row">
                <h1 class="col-sm-10 mx-auto text-center mt-5 mb-5">Online Buying and selling Items System</h1>
            </div>
        </div>
        <?php
        include('../dbconfig.php');
        $sql = "SELECT cart.id,product.product_title,product.price,product.category from product inner join
        cart on cart.product_id=product.id inner join member on member.email = cart.buyer
        where cart.buyer = '{$user_email}' and cart.status=1
        ";
        $result = mysqli_query($conn,$sql);
?>
        <div class="container-fluid text-left">
            <h3>My Cart:</h3>
            <?php
                        if(mysqli_num_rows($result) > 0){
                ?>                         
        </div>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Item name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cart_array = array();
                    $sum = 0;
                    $item = 0;
                    $shipping_price = 0;
                    while($row=mysqli_fetch_row($result)){
                        $item++;
                        $sum = $sum + $row[2];
                        array_push($cart_array,$row[0]);
                        ?>        
                    <tr>
                        <th scope="row"><?php echo $row[1] ?></th>
                        <td><?php echo $row[3] ?></td>
                        <td class="text-right">$<?php echo $row[2] ?></td>
                        <td>
                            <div class="text-right">
                                <button id="btn" data-id="<?php echo $row[0] ?>" class="btn btn-danger" type="button">X</button>
                            </div>
                        </td>
                    </tr>
                    <?php
}
$str = implode('|',$cart_array);
$_SESSION['cart_items'] = $str;
?>
                </tbody>
            </table>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-11 text-right">
                    <h4>Total number of items:</h4>
                </div>
                <div class="col-sm-1 text-right">
                    <h4><?php echo $item ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11 text-right">
                    <h4>Shipping price (5% of original price):</h4>
                </div>
                <div class="col-sm-1 text-right">
                    <h4>$<?php
                    $perc = (5*$sum)/100;
                    echo number_format($perc,2);
                    ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11 text-right">
                    <h4>Total price:</h4>
                </div>
                <div class="col-sm-1 text-right">
                    <h4>$<?php echo number_format($sum,2) ?></h4>
                    <?php $grand_total = $perc + $sum;
                    $_SESSION['grand_total'] = $grand_total;
                    ?>
                </div>
            </div>
        </div>
        <?php
    }else{
        echo "<p class='alert alert-danger text-center'>No Item</p>";
    }
    ?>
        <div class="container-fluid mt-3 mb-5">
            <div class="row justify-content-end">
                <div class="ml-auto col-md-2">
                    <a href="../index.php" class="btn btn-secondary">Continue Shopping</a>
                </div>
                <div class="col-md-2">
                    <a href="./checkout.php" class="btn btn-success">Proceed to Checkout</a>
                </div>
                <!-- <div class="col-6 text-right">
                    <div class="col-sm-10 text-right">
                        
                    </div>
                    <div class="col-sm-2 text-right">
                        <button class="btn btn-success">Proceed to Checkout</button>
                    </div>
                    
                </div> -->
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
                    url: 'remove-cart-product.php',
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