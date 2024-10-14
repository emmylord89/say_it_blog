<?php
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "say_it_blog";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // Default role

    $sql = "INSERT INTO new_user (fullname, email, username, password, role) VALUES ('$fullname', '$email', '$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
