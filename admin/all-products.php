<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
      header('Location: ./login.php');
}
$email = $_SESSION['admin_email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/gif" href="../images/logo.gif" />
    <title>Products | Schoolify </title>
</head>
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

<body>
    <?php include('./navbar.php') ?>
    <div id="modal">
        <div id="modal-form">
          <h2>Edit Category</h2>
          <table cellpadding="10px" width="100%">
          </table>
          <div id="close-btn">X</div>
        </div>
      </div>
    <?php
    include('../dbconfig.php');
    $query = "SELECT * from product order by date_added asc";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>
        <h1 class="text-center mb-4 mt-4 text-primary">Products List</h1>
        <div class="container">
            <div class="row">
                <div class="col-12 m-auto custom">
                    <table style="width: 100%;" id="vam-buildings-user">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Count</th>
                                <th>Product Title</th>
                                <th>Product Category</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Change Category</th>
                                <th>Remove</th>
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
                                    <td><?php echo $row['product_title'] ?></td>
                                    <td><?php echo $row['category'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo 'product-display.php?id=' . $row['id'] ?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;">View</i></a>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-warning" style="cursor: pointer; text-align:right;" id="btn" data-id="<?php echo $row['id'] ?>">Change</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-danger" style="cursor: pointer; text-align:right;" id="remove-btn" data-id="<?php echo $row['id'] ?>">Remove</button>
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
        echo "<p class='text-center alert alert-danger mt-5'>No Products</p>";
    }
    ?>
    <script src="../js/jquery.min.js"></script>
    <script>
        $(() => {
      
            $(document).on("click", "#remove-btn", function() {
                var r = confirm("Are You Sure You want to Remove this product");
                if (r == true) {
                    let id = $(this).data('id');
                    let element = $(this);
                    $.ajax({
                        url: 'remove-product.php',
                        type: 'POST',
                        data: {
                            id
                        },
                        success: function(data) {
                            if (data == 1) {
                                alert("Product Removed");
                                element.closest("tr").remove();
                            } else {
                                alert("Can't Remove Product.");
                            }
                        }
                    })
                } else {
                    alert("You pressed Cancel!. Product is Not Removed.");
                }
            })

            //Show Modal Box
    $(document).on("click","#btn", function(){
      $("#modal").show();
      let id = $(this).data("id");
      $.ajax({
        url: "load-update-form.php",
        type: "POST",
        data: {
          id
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
        let category = $("#category").val();
        let id = $(this).data("id");
        $.ajax({
          url: "update-category.php",
          type : "POST",
          data : {category,id},
          success: function(data) {
            if(data == 1){
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