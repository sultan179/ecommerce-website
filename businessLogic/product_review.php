<?php
    //Method to be called when displaying reviews of a certin product
    function getProductReviews($con, $id) {
        $sql = "SELECT product_review.rating,product_review.review,member.member_name 
                from product_review inner join member on product_review.buyer=member.email 
                where product_review.product_id={$id};";
        return mysqli_query($con, $sql);
    }

    //Method to be called when Buyer makes a review on product
    function addProductReview(
        $con,
        $review,
        $rating,
        $product_id,
        $email
        ) {
        $query="INSERT into product_review(review,rating,product_id,buyer) Values(?,?,?,?)";

        //clean the data being inputted
        $Review = htmlspecialchars(strip_tags($review));
        $Rating = htmlspecialchars(strip_tags($rating));
        $ProductID = htmlspecialchars(strip_tags($product_id));
        $Email = htmlspecialchars(strip_tags($email));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'siis',
            $Review,
            $Rating,
            $ProductID,
            $Email
        );

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }
?>