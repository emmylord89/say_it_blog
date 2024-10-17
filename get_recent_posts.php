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
$sql = "SELECT title, media, content, created_at FROM posts_1 ORDER BY created_at DESC";
$result = $conn->query($sql);

$posts = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="post-list">
        <h1>Latest Posts</h1>
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-item">
                    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                    <?php if (!empty($post['media'])): ?>
                        <img src="uploads/<?php echo htmlspecialchars($post['media']); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>" />
                    <?php endif; ?>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <small>Posted on: <?php echo date("F j, Y, g:i a", strtotime($post['created_at'])); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
