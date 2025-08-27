<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "reza";

$conn = mysqli_connect($host, $username, $password, $database);
if ($conn->connect_error){
    echo "gagal menyambungkan";
    die('error!');
}