<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your DB username
$password = ""; // Your DB password
$dbname = "say_it_blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get post data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // Handle file upload
    $target_dir = "uploads/";
    $media_file = $_FILES['media']['name'];
    $target_file = $target_dir . basename($media_file);
    $uploadOk = 1;

    // Check if file is an image or video
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" && $file_type != "mp4" && $file_type != "mov") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, and MOV files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Upload the file
        if (move_uploaded_file($_FILES["media"]["tmp_name"], $target_file)) {
            // File uploaded successfully, now insert post data into database
            $sql = "INSERT INTO posts_1 (title, content, media) VALUES ('$title', '$content', '$media_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New post created successfully!";
                // Redirect or display a success message
                header("Location: index.php"); // Redirect to posts page
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>
