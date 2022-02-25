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

</style>

<body>
    <?php include('./navbar.php') ?>
    <?php
    include('../dbconfig.php');
    $query = "SELECT * from product where status='pending' order by date_added asc";
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
                                <th>Details</th>
                                <th>Activate</th>
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
                                    <td>
                                        <a target="_blank" href="<?php echo 'product-display.php?id=' . $row['id'] ?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;">View</i></a>
                                    </td>
                                    <td>
                                        <select style='font-size:20px' ; name="category" required data-id="<?php echo $row['id'] ?>" id="btn" class="form-select w-100">
                                            <option selected value="---">---</option>
                                            <option value="Approve">Approve</option>
                                            <option value="Disapprove">Disapprove</option>
                                        </select>
                                        <!-- <button class="btn btn-outline-success" style="cursor: pointer; text-align:right;" id="btn" data-id="<?php echo $row['id'] ?>">Activate</button> -->
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
            $(document).on("change", "#btn", function() {
                var optionSelected = $(this).find("option:selected");
                var status  = optionSelected.val();
                var r = confirm("Are You Sure You want to Change this product status");
                if (r == true) {
                    let id = $(this).data('id');
                    let element = $(this);
                    $.ajax({
                        url: 'activate-product.php',
                        type: 'POST',
                        data: {
                            id,status
                        },
                        success: function(data) {
                            if (data == 1) {
                                alert("Product Status Changed");
                                element.closest("tr").remove();
                            } else {
                                alert("Can't Change Product Status.");
                            }
                        }
                    })
                } else {
                    alert("You pressed Cancel!. Product's Status is Not Updated.");
                }
            })

            // REmove Product
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
        })
    </script>
</body>

</html>