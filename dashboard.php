<?php
require 'config.php';
require 'functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (createPost($_SESSION['user_id'], $title, $content)) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Failed to create post!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - MyBlog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create New Post</h1>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="dashboard.php" method="post">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Write your post here..." required></textarea>
            <button type="submit">Publish</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
