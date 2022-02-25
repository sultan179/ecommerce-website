
<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'root';
    $db = "ecommerce";

    $con;

    function connect() {
        global $host;
        global $user;
        global $password;
        global $db;
        global $con;
        $con = mysqli_connect($host, $user, $password, $db);
        if (mysqli_connect_errno($con)) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
        }
        return $con;
    }
?>
