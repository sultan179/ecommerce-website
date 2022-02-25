<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
<?php
if(!isset($_GET['category'])){
    echo "<script>window.location.replace('./index.php')</script>";
}
$category=$_GET['category'];
?>
    <?php include('navbar.php') ?>
    <h1 class="text-center text-primary mt-5 mb-5">All Products</h1>

    <div class="container mt-5">
        <div class="mt-5 mb-5 row">
            <div class="col-2">
                <button id="reloadBtn" class="btn btn-success">Reload All Records</button>
            </div>
            <div class="ml-auto col-5">
                <input class="form-control" type="text" id="searchTerm" placeholder="Search Products">
            </div>
            <div class="col-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Category
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="category.php?category=Old Books">Old Books</a>
                        <a class="dropdown-item" href="category.php?category=New Books">New Books</a>
                        <a class="dropdown-item" href="category.php?category=Lab Supplies">Lab Supplies</a>
                        <a class="dropdown-item" href="category.php?category=Gifts">Gifts</a>
                        <a class="dropdown-item" href="category.php?category=Electronics">Electronics</a>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <button id="searchBtn" data-category="<?php echo $category ?>" class="btn btn-primary">Search</button>
            </div>
        </div>
        <div id="records" class="row">
            <?php
            include('../dbconfig.php');
            $sql = "SELECT * from product where status='active' and category='{$category}' order by date_added desc";
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
                                <li class="list-group-item">Date Added: <?php echo date('M j,Y', strtotime($row['date_added']))   ?></li>
                            </ul>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center alert alert-danger mt-4'>No Products</p>";
            }
            ?>


        </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        $(() => {
            $(document).on("click", "#searchBtn", function() {
                let searchTerm = $('#searchTerm').val();
                if (searchTerm != "") {
                    let category = $(this).data("category");
                    $.ajax({
                        url: 'ajax-products.php',
                        type: 'POST',
                        data: {
                            searchTerm,
                            category
                        },
                        success: function(data) {
                            if (data) {
                                $('#records').html(data);
                            } else {
                                alert("Error Fetching the records");
                            }
                        }
                    })
                } else {
                    //
                }

            })

            $('#reloadBtn').click(() => {
                location.reload();
            })
        })
    </script>
</body>

</html>