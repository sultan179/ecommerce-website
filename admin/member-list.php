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
    <title>Members List | Ecommerce </title>
</head>
<style>

</style>

<body>
    <?php include('./navbar.php') ?>
    <?php
    include('../dbconfig.php');
    $query = "SELECT * from member";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
    ?>
        <h1 class="text-center mb-4 mt-4 text-primary">Members</h1>
        <div class="container">
            <div class="row">
                <div class="col-12 m-auto custom">
                    <table style="width: 100%;" id="vam-buildings-user">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Count</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Remove</th>
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
                                    <td><?php echo $row['member_name'] ?></td>
                                    <td><?php echo $row['phone_no'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td>
                                        <button class="btn btn-outline-danger" style="cursor: pointer; text-align:right;" id="btn" data-email="<?php echo $row['email'] ?>">Remove</button>
                                    </td>
                                    <td>
                                        <a target="_blank" href="<?php echo 'member-details.php?email=' . $row['email']?>" class="btn btn-outline-primary" style="cursor: pointer; text-align:right;">View</i></a>
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
                var r = confirm("Are You Sure You want to remove this user");
                if (r == true) {
                    let email = $(this).data('email');
                    let element = $(this);
                    $.ajax({
                        url: 'remove-user.php',
                        type: 'POST',
                        data: {
                            email
                        },
                        success: function(data) {
                            if (data == 1) {
                                element.closest("tr").remove();
                            } else {
                                alert("Can't Remove User.");
                            }
                        }
                    })
                } else {
                    alert("You pressed Cancel!. User is Not removed.");
                }
            })
        })
    </script>
</body>

</html>