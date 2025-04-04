<?php
$host = "localhost";      
$user = "root";          
$password = "";           
$dbname = "eshop";        //name of the database


$conn = new mysqli($host, $user, $password, $dbname,3307);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

?>
