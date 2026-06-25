<?php
    require_once "../config/db.php";
    $user_id = $_GET['user_id'];  
    
    $stmt = $pdo->prepare("SELECT users.id, users.nom, users.prenom, users.photo_profile 
    FROM users 
    JOIN friend_requests ON (
        friend_requests.sender_id = :user_id OR 
        friend_requests.receiver_id = :user_id
    )
    WHERE friend_requests.status = 'accepted'
    AND users.id != :user_id
    ");
    $stmt->execute([':user_id' => $user_id]);  
    
    $users = $stmt->fetchAll();  
    echo json_encode($users);
?>