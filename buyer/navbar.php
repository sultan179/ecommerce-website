<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <title>Document</title>
</head>
<style>
a{
  margin-right: 12px;
}
a:hover{
  transform: scale(1.1);
  transition: .3s linear;
}
</style>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <div class="container-fluid">
    <a style="font-size: 35px; color:white;" class="navbar-brand" href="myproducts.php">Buyer Account</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto">
      <a style="font-size: 20px; color:white;" class="nav-link  btn btn-outline-light text-white" href="./index.php">Buy Products</a>
        <a style="font-size: 20px; color:white;" class="nav-link  btn btn-outline-light text-white" href="orders-list.php">View Orders</a>
        <a style="font-size: 20px; color:white;" class="nav-link  btn btn-outline-light text-white" href="cart-display.php">My Cart</a>
        <a style="font-size: 20px; color:white;" class="nav-link  btn btn-outline-light text-white" href="../seller/myproducts.php">Switch To Selling</a>
        <a style="font-size: 20px; color:white;" class="nav-link  btn btn-outline-light text-white" href="../seller/logout.php">Log Out</a>
      </div>
    </div>
  </div>
</nav>
<script src="./js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
</body>


</html>