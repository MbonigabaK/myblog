<?php
function registerUser($username, $email, $password) {
    global $pdo;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$username, $email, $hashedPassword]);
}

function loginUser($email, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        return true;
    }
    return false;
}

function createPost($userId, $title, $content) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
    return $stmt->execute([$userId, $title, $content]);
}

function getPosts() {
    global $pdo;
    $stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPost($postId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
    $stmt->execute([$postId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addComment($postId, $username, $comment) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)");
    return $stmt->execute([$postId, $username, $comment]);
}

function getComments($postId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
    $stmt->execute([$postId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
