<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "say_it_blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get posts, ordered by creation date (latest first)
$sql = "SELECT title, content, media, created_at FROM posts ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

// Return posts as JSON
header('Content-Type: application/json');
echo json_encode($posts);

$conn->close();
?>
