<?php
    //Method to be called when seller cheates an account
    function addMember(
        $con,
        $email,
        $password,
        $name,
        $user_name,
        $address,
        $phone,
        $gender
        ) {
        $query = "insert into member values(?,?,?,?,?,?,?)";

        //clean the data being inputted
        $em = htmlspecialchars(strip_tags($email));
        $pwd = htmlspecialchars(strip_tags($password));
        $nme = htmlspecialchars(strip_tags($name));
        $unme = htmlspecialchars(strip_tags($user_name));
        $adr = htmlspecialchars(strip_tags($address));
        $phn = htmlspecialchars(strip_tags($phone));
        $gen = htmlspecialchars(strip_tags($gender));

        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'sssssss',
            $em,
            $pwd,
            $nme,
            $unme,
            $adr,
            $phn,
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

    //Method to be called member edits their account
    function editMemberAccountInformation(
        $con,
        $name,
        $phone,
        $password,
        $address,
        $user_email
    ) {
        $query = 'UPDATE member set member_name=?,phone_no=?,password=?,address=? where email=?;';
        
        $stmt = mysqli_prepare($con, $query);
        
        mysqli_stmt_bind_param(
            $stmt,
            'sssss',
            $usrName,
            $phn,
            $pwd,
            $addr,
            $email
        );
        
        //clean the data being inputted
        $usrName = htmlspecialchars(strip_tags($name));
        $phn = htmlspecialchars(strip_tags($phone));
        $pwd = htmlspecialchars(strip_tags($password));
        $addr = htmlspecialchars(strip_tags($address));
        $email = htmlspecialchars(strip_tags($user_email));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            //print error if something goes wrong
            echo 'error updating data';
            return false;  
        }
    }
    
    //Method to be called when admin deletes a member
    function deleteMember($con, $email) {
        $query="DELETE FROM member WHERE email=?";
        
        $stmt = mysqli_prepare($con, $query);

        mysqli_stmt_bind_param($stmt, 's', $em);

        $em = htmlspecialchars(strip_tags($email));

        if(mysqli_stmt_execute($stmt)) {
            return true;
        }
        echo 'error updating data';
        return false;  
    }
?>