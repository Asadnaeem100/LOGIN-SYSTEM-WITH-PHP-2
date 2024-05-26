<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($servername, $username, $password, $database);

if($conn){
}
else{
    die("Something went Wrong." . mysqli_connect_error($conn));
}

?>