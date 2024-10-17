<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "say_it_blog";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = 'user'; // Default role

    // Prepare the SQL query
    $sql = "INSERT INTO new_user (fullname, email, username, password, role) 
            VALUES ('$fullname', '$email', '$username', '$password', '$role')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Registration successful, store welcome message in session
        $_SESSION['welcome_message'] = "Welcome, " . htmlspecialchars($fullname) . "!";

        // Redirect to user.php
        header("Location: user.php");
        exit(); // Always call exit() after a redirect
    } else {
        // If there's an error, display the error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
