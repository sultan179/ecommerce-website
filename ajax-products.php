<?php
$category = $_POST['category'];
$searchTerm = $_POST['searchTerm'];
include('./dbconfig.php');
$output = "";
if($category == 'All'){
    $sql = "SELECT * from product where status='active' and product_title like '%{$searchTerm}%'  order by date_added desc";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $output .="<div class='col-md-4 col-sm-6 mb-5 mx-sm-0 gy-2 mx-5 px-sm-3 px-5 d-flex align-items-stretch'>
            <div class='card'>
                <img src='". substr($row['image_url'], 1) ."' class='card-img-top' alt='Day Care'>
                <div class='card-body'>
                    <h5><a href='./product-display.php?id=" .$row['id']."' class='card-title'>" . $row['product_title'] . "</a></h5>
                </div>
                <ul class='list-group list-group-flush'>
                    <li class='list-group-item'>Category: ". $row['category'] . "</li>
                    <li class='list-group-item'>Price: " . $row['price'] . "$</li>
                    <li class='list-group-item'>Date Added: " . date('M j,Y', strtotime($row['date_added'])) ."</li>
                </ul>
            </div>
        </div>";
        }
        echo $output;
    }else{
        $output = "<p class='alert alert-danger w-100 text-center'>No Records</p>";
        echo $output;
    }
    
}else{
    $sql = "SELECT * from product where status='active' and category='{$category}' and product_title like '%{$searchTerm}%'  order by date_added desc";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $output .="<div class='col-md-4 col-sm-6 mb-5 mx-sm-0 gy-2 mx-5 px-sm-3 px-5 d-flex align-items-stretch'>
            <div class='card'>
                <img src='". substr($row['image_url'], 1) ."' class='card-img-top' alt='Day Care'>
                <div class='card-body'>
                    <h5><a href='./product-display.php?id=" .$row['id']."' class='card-title'>" . $row['product_title'] . "</a></h5>
                </div>
                <ul class='list-group list-group-flush'>
                    <li class='list-group-item'>Category: ". $row['category'] . "</li>
                    <li class='list-group-item'>Price: " . $row['price'] . "$</li>
                    <li class='list-group-item'>Date Added: " . date('M j,Y', strtotime($row['date_added'])) ."</li>
                </ul>
            </div>
        </div>";
        }
        echo $output;
    }else{
        $output = "<p class='alert alert-danger w-100 text-center'>No Records</p>";
        echo $output;
    }
    
}















?>