<?php
session_start();

// Database connection
$servername = "localhost";
$db_username = "root"; // Your DB username
$db_password = ""; // Your DB password
$dbname = "say_it_blog";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Check if the user exists and is an admin
    $sql = "SELECT * FROM new_user WHERE username='$username' AND role='user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables and redirect to admin post creation page
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: admin_create_post.html");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Admin user not found";
    }
}

// Close the database connection
$conn->close();
?>
