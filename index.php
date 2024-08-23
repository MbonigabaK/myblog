<?php
require 'config.php';
require 'functions.php';
$posts = getPosts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyBlog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>MyBlog</h1>
        <p><a href="dashboard.php">Create New Post</a> | <a href="login.php">Login</a> | <a href="register.php">Register</a></p>
        <div class="posts">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><a href="post.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                    <p>by <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></p>
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
