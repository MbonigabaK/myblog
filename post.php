<?php
require 'config.php';
require 'functions.php';
$postId = $_GET['id'];
$post = getPost($postId);
$comments = getComments($postId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    if (addComment($postId, $username, $comment)) {
        header("Location: post.php?id=$postId");
        exit();
    } else {
        $error = "Failed to add comment!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?> - MyBlog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <p>by <?= htmlspecialchars($post['username']) ?> on <?= $post['created_at'] ?></p>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

        <h2>Comments</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="post.php?id=<?= $postId ?>" method="post">
            <input type="text" name="username" placeholder="Your Name" required>
            <textarea name="comment" placeholder="Write your comment here..." required></textarea>
            <button type="submit">Submit Comment</button>
        </form>

        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><strong><?= htmlspecialchars($comment['username']) ?></strong> said on <?= $comment['created_at'] ?>:</p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
