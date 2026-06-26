<?php
    require_once "../config/db.php";
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM users");
    $stmt->execute();
    $users_count = $stmt->fetch()['total'];

    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM posts");
    $stmt->execute();
    $posts_count = $stmt->fetch()['total'];

    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM comments");
    $stmt->execute();
    $comments_count = $stmt->fetch()['total'];

    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM messages");
    $stmt->execute();
    $messages_count = $stmt->fetch()['total'];
    echo json_encode([
        "users" => $users_count,
        "posts" => $posts_count,
        "comments" => $comments_count,
        "messages" => $messages_count
    ]);
?>