<?php
    require_once "../config/db.php";
    $stmt = $pdo->prepare("SELECT posts.*, users.nom, users.prenom, users.photo_profile 
        FROM posts 
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();
    echo json_encode($posts);
?>