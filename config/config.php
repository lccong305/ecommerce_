<?php
$servername = "root";
$username = "username";
$password = "";

// Create connection
$conn = new mysqli("localhost", "root", "", "ecommerce");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";
?>