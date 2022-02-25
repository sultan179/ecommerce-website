<?php
    //Method to be called to get a unique admin user based on the email and password provided
    function displayAdminUsersByEmailAndPassword($con, $email, $password) {
        $sql="select * from admin where email='{$email}' and password='{$password}'";
        return mysqli_query($con, $sql);
    }
    
    //Method to be called when another admin registers
    function createAdmin(
        $con,
        $email,
        $password,
        $firstname,
        $middlename,
        $lastname,
        $DOB,
        $gender
        ) {
        $query = "insert into admin values (?,?,?,?,?,?,?)";

        //clean the data being inputted
        $em = htmlspecialchars(strip_tags($email));
        $pwd = htmlspecialchars(strip_tags($password));
        $fname = htmlspecialchars(strip_tags($firstname));
        $mname = htmlspecialchars(strip_tags($middlename));
        $lname = htmlspecialchars(strip_tags($lastname));
        $dob = htmlspecialchars(strip_tags($DOB));
        $gen = htmlspecialchars(strip_tags($gender));
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'sssssss',
            $em,
            $pwd,
            $fname,
            $mname,
            $lname,
            $dob,
            $gen
        );

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error inserting data';
            return false;  
        }
    }

    //Method to be called when admin user edits his own profile
    function editAdmin(
        $con,
        $firstname,
        $middlename,
        $lastname,
        $password,
        $DOB,
        $adminEmail
    ) {
        $query = "UPDATE admin set mname=?,lname=?,fname=?,password=?,dob=? where email=?;";
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'ssssss',
            $mname,
            $lname,
            $fname,
            $pwd,
            $dob,
            $email
        );
        
        //clean the data being inputted
        $fname = htmlspecialchars(strip_tags($firstname));
        $mname = htmlspecialchars(strip_tags($middlename));
        $lname = htmlspecialchars(strip_tags($lastname));
        $pwd = htmlspecialchars(strip_tags($password));
        $dob = htmlspecialchars(strip_tags($DOB));
        $email = htmlspecialchars(strip_tags($adminEmail));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }
?>