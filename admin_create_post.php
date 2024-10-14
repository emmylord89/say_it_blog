<?php
include 'auth.php';
redirect_if_not_admin();
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.html");
}

$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "say_it_blog";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $media = $_POST['media']; // Assume the media is uploaded and handled

    $sql = "INSERT INTO posts (user_id, title, content, media) VALUES ('$user_id', '$title', '$content', '$media')";
    if ($conn->query($sql) === TRUE) {
        echo "Post created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
