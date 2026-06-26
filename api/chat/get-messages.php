<?php
    require_once "../config/db.php";
    $user_id = $_GET['user_id'];  
    $receiver_id = $_GET['receiver_id'];
    
    $stmt = $pdo->prepare("SELECT * FROM messages 
    WHERE (sender_id = :user_id AND receiver_id = :receiver_id)
    OR (sender_id = :receiver_id AND receiver_id = :user_id)
    ORDER BY created_at ASC");
    $stmt->execute([':user_id' => $user_id, ':receiver_id' => $receiver_id]);  
    
    $messages = $stmt->fetchAll();  
    echo json_encode($messages);
?>