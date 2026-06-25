<?php
    require_once "../config/db.php";
    $user_id = $_GET['user_id'];
    $stmt= $pdo->prepare("SELECT users.id, users.nom, users.prenom, users.photo_profile 
    FROM users WHERE id = :user_id ");
    $stmt->execute([':user_id' => $user_id]); 
    $user = $stmt->fetch();  
    echo json_encode($user);
?>