<?php
// db_connect.php
$servername = "localhost";
$username = "root"; // Username
$password = ""; // DB Password
$dbname = "say_it_blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
