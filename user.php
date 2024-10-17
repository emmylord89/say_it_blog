<?php
session_start(); // Start the session to access session variables

// Assume the user is logged in and their full name is stored in the session
// e.g., $_SESSION['fullname'] = 'John Doe';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css"> <!-- Assuming you have a separate CSS file for user styling -->
    <title>User Profile - Say It Blog</title>
</head>
<body>
   <!-- Navigation Bar for User -->
   <nav>
        <div class="nav-left">
            <!-- Display the logged-in user's name instead of 'User Profile' -->
            <h1>
                <?php
                if (isset($_SESSION['fullname'])) {
                    echo "Welcome, " . htmlspecialchars($_SESSION['fullname']); // Display user's full name
                } else {
                    echo "User Profile"; // Fallback text in case the user name is not available
                }
                ?>
            </h1>
        </div>
        <div class="nav-right">
            <ul>
                <li><a href="index.php">My Profile</a></li>
                <li><a href="index.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Flash Welcome Message -->
    <?php if (isset($_SESSION['welcome_message'])): ?>
        <div class="flash-message">
            <?php 
            echo $_SESSION['welcome_message']; 
            unset($_SESSION['welcome_message']); // Unset the message after displaying it
            ?>
        </div>
    <?php endif; ?>

    <!-- "Say It Blog" Banner Section -->
    <section class="say-it-banner">
        <h1>Say It Blog!</h1>
        <h2>News, Inspiration, Lifestyle, Entertainment, Events, and More...</h2>
    </section>

    <!-- Main Blog Content (Slideshow + Posts) -->
    <div class="main-container">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="uploads/pix1.png">
            </div>
            <div class="mySlides fade">
                <img src="uploads/pix2.png">
            </div>
            <div class="mySlides fade">
                <img src="uploads/pix3.png">
            </div>
            <div class="mySlides fade">
                <img src="uploads/pix4.png">
            </div>
            <div class="mySlides fade">
                <img src="uploads/pix5.png">
            </div>
        </div>

        <!-- Dynamic Posts Section -->
        <div class="post-container" id="post-container">
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

            // Query to get posts, ordered by creation date (latest first)
            $sql = "SELECT title, media, content, created_at FROM posts_1 ORDER BY created_at DESC";
            $result = $conn->query($sql);

            // Check if there are posts
            if ($result->num_rows > 0) {
                // Output data of each row
                while($post = $result->fetch_assoc()) {
                    echo '<div class="post-item">';
                    echo '<h2>' . htmlspecialchars($post['title']) . '</h2>';
                    if (!empty($post['media'])) {
                        echo '<img src="uploads/' . htmlspecialchars($post['media']) . '" alt="' . htmlspecialchars($post['title']) . '" />';
                    }
                    echo '<p>' . htmlspecialchars($post['content']) . '</p>';
                    echo '<small>Posted on: ' . date("F j, Y, g:i a", strtotime($post['created_at'])) . '</small>';
                    echo '</div>';
                }
            } else {
                echo '<p>No posts found.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
