<?php
$servername = "localhost";
$username = "root";
$password = ""; // leave empty if no password set
$dbname = "inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
