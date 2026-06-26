<?php
    require_once "../config/db.php";
    $user_id = $_GET['user_id'];  
    
    $stmt = $pdo->prepare("SELECT DISTINCT users.id, users.nom, users.prenom, users.photo_profile
    FROM users
    JOIN messages ON (messages.sender_id = users.id OR messages.receiver_id = users.id)
    WHERE (messages.sender_id = :user_id OR messages.receiver_id = :user_id)
    AND users.id != :user_id");
    $stmt->execute([':user_id' => $user_id]);  
    
    $users = $stmt->fetchAll();  
    echo json_encode($users);
?>