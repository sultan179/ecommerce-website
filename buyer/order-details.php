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
    <style>
        .success {
    width: fit-content;
    color: black;
    font-size: 25px;
    position: absolute;
    top: 110px;
    right: 20px;
    box-shadow: 0px 0px 3px 0px black;
    padding: 10px 10px;
    border-radius: 5px;
  }

  #modal{
  background: rgba(0,0,0,0.7);
  position: fixed;
  left: 0;
  top:0;
  width: 100%;
  height: 100%;
  z-index: 100;
  display: none;
}
#modal-form{
  background: #fff;
  width: fit-content;
  position: relative;
  top: 20%;
  left: calc(50% - 15%);
  /* left: 10%; */
  padding: 15px;
  border-radius: 4px;
}
#modal-form h2{
  margin: 0 0 15px;
  padding-bottom: 10px;
  border-bottom: 1px solid #000;
}
#modal-form input[type = "text"]{
  width: 100%;
}
#close-btn{
  background: red;
  color: white;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  border-radius: 50%;
  position: absolute;
  top: -15px;
  right: -15px;
  cursor: pointer;
}


  @media screen and (max-width:600px){
    #modal-form{
      left: 10%;
    }
  }

  @media screen and (max-width:500px){
    #modal-form{
      left: 5%;
    }
  }
    </style>
</head>
<body>
    <?php include('./navbar.php') ?>
    <div id="modal">
        <div id="modal-form">
          <h2>Rating and Review</h2>
          <table cellpadding="10px" width="100%">
          </table>
          <div id="close-btn">X</div>
        </div>
      </div>
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
                where cart.buyer = '{$user_email}' and cart.status=0 and cart.id=$cart[$i]
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
                            <div class="text-center mt-3 mb-3">
                                <button data-email="<?php echo $user_email ?>" data-id="<?php echo $results[$i][4] ?>" class="btn btn-outline-primary" id="rate-btn">Rate</button>
                            </div>
                        </div>

                    </div>
                <?php
                }
                ?>


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

        //Show Modal Box
    $(document).on("click","#rate-btn", function(){
      $("#modal").show();
      let id = $(this).data("id");
      let email = $(this).data("email");
      $.ajax({
        url: "load-update-form.php",
        type: "POST",
        data: {
          id,email
         },
        success: function(data) {
          $("#modal-form table").html(data);
        }
      })
    });

    //Hide Modal Box
    $("#close-btn").on("click",function(){
      $("#modal").hide();
    });

    //Save Update Form
    $(document).on("click","#edit-submit", function(){
        let rating = $("#rating").val();
        let review = $("#review").val();
        let email = $("#email").val();
        let id = $(this).data("id");
        $.ajax({
          url: "update-rating.php",
          type : "POST",
          data : {rating,review,id,email},
          success: function(data) {
            if(data == 1){
                alert("Rated Successfully");
              $("#modal").hide();
              location.reload();
            }else{
              alert("Error");
            }
          }
        })
      });
    })
</script>
</body>

</html>