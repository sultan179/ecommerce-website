<?php
    //Method to be called when displaying all products based on their status if pending or active
    function displayProductsByStatus($con, $stat) {
        $sql = "SELECT * from product where status=$stat order by date_added asc;";
        return mysqli_query($con, $sql);
    }
    
    //Method to be called when displaying products based on sellers email
    function displaySellerProducts($con, $userEmail) {
        $query = "SELECT * from product where seller=$userEmail order by date_added desc";
        return mysqli_query($con, $query);
    }
    //Method to retrieve a single product for viewing in detail
    function displayOneProduct($con, $id) {
        $query = "SELECT * from product where id=$id";
        return mysqli_query($con, $query);
    }

    //Method to be called when seller adds a new product
    function addNewProduct(
        $con,
        $title,
        $description,
        $price,
        $path,
        $userEmail,
        $category
        ) {
        $query = "INSERT into product(product_title,product_description,price,image_url,seller,status,category) values(?,?,?,?,?,'pending',?)";

        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ssdsss',
            $Title,
            $Description,
            $Price,
            $Path,
            $Email,
            $Category
        );

        //clean the data being inputted
        $Title = htmlspecialchars(strip_tags($title));
        $Description = htmlspecialchars(strip_tags($description));
        $Price = htmlspecialchars(strip_tags($price));
        $Path = htmlspecialchars(strip_tags($path));
        $Email = htmlspecialchars(strip_tags($userEmail));
        $Category = htmlspecialchars(strip_tags($category));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }

    //Method to be called to edit the sellers product
    function editProductBasedOnSeller(
        $con,
        $title,
        $description,
        $price,
        $path,
        $user_email,
        $category,
        $id
    ) {
        $query = "UPDATE product set product_title=?, product_description=?,price=?,image_url=?,seller=?,category=? where id =?";
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ssdsssi',
            $Title,
            $Description,
            $Price,
            $Path,
            $Email,
            $Category,
            $ID
        );
        
        //clean the data being inputted
        $Title = htmlspecialchars(strip_tags($title));
        $Description = htmlspecialchars(strip_tags($description));
        $Price = htmlspecialchars(strip_tags($price));
        $Path = htmlspecialchars(strip_tags($path));
        $Email = htmlspecialchars(strip_tags($user_email));
        $Category = htmlspecialchars(strip_tags($category));
        $ID = htmlspecialchars(strip_tags($id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }
    

    //Method to be called when admin changes the category of sellers product
    function changeCategoryOfAProduct(
        $con,
        $newCategory,
        $id
    ) {
        $query="UPDATE product set category=? WHERE id=?";
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'si',
            $category,
            $ID
        );
        
        //clean the data being inputted
        $category = htmlspecialchars(strip_tags($newCategory));
        $ID = htmlspecialchars(strip_tags($id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }

    //Method to be called to change the product to be active
    function makeProductActive($con,$id) {
        $query = "UPDATE product set status='active' WHERE id=?;";
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param($stmt,'i',$ID);
        
        //clean the data being inputted
        $ID = htmlspecialchars(strip_tags($id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }
    
    
    //Method to be called when admin removes a product
    function deleteProduct($con, $id) {
        $query="DELETE FROM product WHERE id=?";
        
        $stmt = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($stmt, 'i', $ID);

        $ID = htmlspecialchars(strip_tags($id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        }
        echo 'error updating data';
        return false;  
    }
?>