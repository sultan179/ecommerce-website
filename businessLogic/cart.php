<?php
    //Method to be called when displaying in cart products
    function displayCartProducts($con, $user_email) {
        $query = "SELECT cart.id,product.product_title,product.price,product.category from product inner join
        cart on cart.product_id=product.id inner join member on member.email = cart.buyer
        where cart.buyer = '{$user_email}' and cart.status=1";
        return mysqli_query($con, $query);
    }

    //Method to be called when product is added to the cart
    function addProductToCart(
        $con,
        $productId,
        $buyerEmail
        ) {
        $query="INSERT into cart(product_id,buyer) VALUES (?,?)";

        //clean the data being inputted
        $product_id = htmlspecialchars(strip_tags($productId));
        $email = htmlspecialchars(strip_tags($buyerEmail));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'is',
            $product_id,
            $email
        );

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }
    
    //Method to be called when Buyer removes a product from cart
    function deleteProductFromCart($con, $id) {
        $query="DELETE FROM cart WHERE id=?";
        
        $stmt = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($stmt, 'i', $cartId);

        $cartId = htmlspecialchars(strip_tags($id));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        }
        echo 'error updating data';
        return false;  
    }
?>