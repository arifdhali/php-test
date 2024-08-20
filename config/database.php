<?php
$host = "localhost";
$username = "root";
$password = "";
$db_name = "crud_app";

$connect = mysqli_connect($host, $username, $password, $db_name);

if ($connect->connect_error) {
    die("Connection error:" . $connect->connect_error);
} else {
    // echo "Connected successfully";

    
}

?>