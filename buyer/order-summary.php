<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
}
if (!isset($_SESSION['summary'])) {
    header('Location: ./checkout.php');
  }
$user_email = $_SESSION['user_email'];
$summary = $_SESSION['summary'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../receipt.css">
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <style>
        </style>
    </head>
    <body>
        <?php include('./navbar.php') ?>
        <!-- <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 text-left">
                    <button href="myCart.html" class="btn btn-primary invisible" type="submit">My cart: 0 items</button>
                </div>
                <div class="col-sm-4 text-center">
                    <h1>Thank you for your order!</h1>
                </div>
                <div class="col-sm-4 text-right">
                    <button href="homepage.html" class="btn btn-primary" type="submit" href>Homepage</button>
                    <button href="Accounts.html" class="btn btn-primary" type="submit" href>My Account</button>
                    <button href="LoginScreen.html" class="btn btn-primary" type="submit">Logout</button>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            <div class="row">
                <img src="data:image/jpeg;base64,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" alt="website logo" class="text-right img-circle col-sm-2">


                
                
            </div>
        </div> -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center ">
                    <h2 style="font-size:32px;">Order Info:</h2>
                    
                    <h4 style="font-size:21px;"><b>Email address</b>: <?php echo $summary[1] ?></h4>
                    <h4 style="font-size:21px;"><b>Billing address</b>: <?php echo $summary[2] ?>
                    </h4>
                    <h4 style="font-size:21px;"><b>Postal Code</b>: <?php echo $summary[3] ?>
                    </h4>
                    <h4 style="font-size:21px;"><b>Phone</b>: <?php echo $summary[4] ?>
                    </h4>
                    <h4 style="font-size:21px;"><b>Grand Total</b>: <?php echo number_format($summary[5],2) ?>$
                    </h4>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 style="font-size:32px;">Order Summary:</h2>
                    
                    <h4 style="font-size:21px;">Order #</b>: <?php echo $summary[0] ?></h4>
                    <h4 style="font-size:21px;"><b>Subtotal of Items</b>: <?php echo number_format($summary[5],2) ?>$
                    </h4>
                    <h4 style="font-size:21px;"><b>Total before tax</b>: <?php echo number_format($summary[5],2) ?>$
                    </h4>
                    <h4 style="font-size:21px;">Tax</b>: 0.00$
                    </h4>
                    <h4 style="font-size:21px;">Grand Total</b>: <?php echo number_format($summary[5],2) ?>$
                    <?php
                    include('../dbconfig.php');
                    $arr = explode('|',$_SESSION['cart_items']);
                    for($i=0; $i<sizeof($arr); $i++){
                        $sql = "UPDATE cart set status=0 where buyer='{$user_email}' and id={$arr[$i]}";
                        $result = mysqli_query($conn,$sql);
                    }
                    if($result){
                        unset($_SESSION['summary']);
                        unset($_SESSION['grand_total']);
                        unset($_SESSION['cart_items']);
                    }             
                    ?>
                    </h4>
                </div>
            </div>
        </div>

    </body>
</html>