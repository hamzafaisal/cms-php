<?php

$server    = "localhost";
$username  = "root";
$password  = "root";
$db        = "cms";

$conn = mysqli_connect($server, $username, $password, $db);

if(!$conn){
    die("connection failed:" .mysqli_connect());
} else{
//    echo "connect successfully!";
}


?>