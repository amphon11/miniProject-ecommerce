<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "shop_db2";
// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);






// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>