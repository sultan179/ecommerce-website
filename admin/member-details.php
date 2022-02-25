<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
      header('Location: ./login.php');
}
$email=$_SESSION['admin_email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" type="image/gif" href="../images/logo.gif"/>
  <title>Orders | Schoolify </title>
</head>
<style>


</style>
<body>
  <?php include('./navbar.php') ?>
  <h1 class="text-center mb-4 mt-4 text-primary">Orders as Buyer</h1>
  <?php
  include('../dbconfig.php');
  if(!isset($_GET['email'])){
    echo "<script>window.location.replace('member-list.php')</script>";
}
$user = 'mohammed@gmail.com';
  $query = "SELECT * from orders where buyer='{$user}' order by order_place_date desc";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
  ?>
    
    <div class="container">
      <div class="row">
        <div class="col-12 m-auto custom">
          <table style="width: 100%;" id="vam-buildings-user">
            <thead>
              <tr style="text-align: center;">
                <th>Count</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Order Ship Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                  $count++;
              ?>
                <tr style="text-align: center;">
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['order_id'] ?></td>
                  <?php 
                  $date = date('F m, Y',strtotime($row['order_place_date'])) 
                  ?>
                  <td><?php echo $date ?></td>
                  <td><?php echo $row['order_status'] ?></td>
                  <td><?php
                  if($row['order_status']=='In Progress'){
                      echo "Not Shipped Yet";
                  }else{
                      echo $row['ship_date'];
                  }    
                   ?></td>
                    <td>
                   <a target="_blank" href="<?php echo 'order-details.php?id='.$row['order_id'].'&cart='.$row['cart_items'] ?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;" id="btn" >View</i></a>
                  </td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<p class='text-center alert alert-danger mt-5'>No Orders</p>";
  }
  ?>
  <h1 class="text-center mb-4 mt-4 text-primary">Orders as Seller</h1>
<?php
$query = "SELECT * from orders where seller='{$user}' order by order_place_date desc";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
  ?>
    
    <div class="container">
      <div class="row">
        <div class="col-12 m-auto custom">
          <table style="width: 100%;" id="vam-buildings-user">
            <thead>
              <tr style="text-align: center;">
                <th>Count</th>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Order Ship Date</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 0;
              while ($row = mysqli_fetch_assoc($result)) {
                  $count++;
              ?>
                <tr style="text-align: center;">
                  <td><?php echo $count ?></td>
                  <td><?php echo $row['order_id'] ?></td>
                  <?php 
                  $date = date('F m, Y',strtotime($row['order_place_date'])) 
                  ?>
                  <td><?php echo $date ?></td>
                  <td><?php echo $row['order_status'] ?></td>
                  <td><?php
                  if($row['order_status']=='In Progress'){
                      echo "Not Shipped Yet";
                  }else{
                      echo $row['ship_date'];
                  }    
                   ?></td>
                    <td>
                   <a target="_blank" href="<?php echo 'order-details.php?id='.$row['order_id'].'&cart='.$row['cart_items'] ?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;" id="btn" >View</i></a>
                  </td>
                </tr>
              <?php
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php
  } else {
    echo "<p class='text-center alert alert-danger mt-5'>No Orders</p>";
  }
  ?>
  <div class="container mt-5">
      <h1 class="text-center text-primary mt-5 mb-5">Products of the User</h1>
        <div class="row">
            <?php
            $sql = "SELECT * from product where seller='{$user}' order by date_added desc";
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
</body>

</html>