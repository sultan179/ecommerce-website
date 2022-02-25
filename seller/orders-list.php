<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: ../login.php');
}
$email=$_SESSION['user_email'];
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
  <?php
  include('../dbconfig.php');
  $query = "SELECT * from orders where seller='{$email}' order by order_place_date desc";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
  ?>
    <h1 class="text-center mb-4 mt-4 text-primary">My Orders</h1>
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
                <th>Ship Order</th>
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
                    <?php
                    if($row['order_status']=='In Progress'){
                      ?>
                      <button class="btn btn-outline-success" style="cursor: pointer; text-align:right;" id="btn" data-id="<?php echo $row['order_id'] ?>">Ship</button>
                      <?php
                      }else{
                        echo 'shipped';
                      }
                    ?>
                    </td>
                    <td>
                   <a target="_blank" href="<?php echo 'order-details.php?id='.$row['order_id'].'&cart='.$row['cart_items'] ?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;" id="view-btn" >View</i></a>
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
  <script src="../js/jquery.min.js"></script>
<script>
    $(() => {
        $(document).on("click", "#btn", function() {
            var r = confirm("Are You Sure You have shipped this order. This will make the status of order shipped!");
            if (r == true) {
                let id = $(this).data('id');
                $.ajax({
                    url: 'ship-order.php',
                    type: 'POST',
                    data: {
                        id
                    },
                    success: function(data) {
                        if (data == 1) {
                          alert("Status Updated");
                            window.location.reload();
                        } else {
                            alert("Can't Update Status.");
                        }
                    }
                })
            } else {
                alert("You pressed Cancel!. Status is Not updated.");
            }
        })
    })
</script>
</body>

</html>