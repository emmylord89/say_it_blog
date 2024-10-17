<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Say It Blog</title>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="nav-right">
                <ul>
                    <li><a href="register.html">Signup</a></li>
                    <li><a href="login.html">Login</a></li>
                    <!-- <li><a href="profile.html">User Profile</a></li> -->
                    <li><a href="admin_login.html">Admin Section</a></li>
                </ul>
            </div>
        </nav>
    </header>

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
