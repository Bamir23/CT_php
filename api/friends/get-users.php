<?php
    require_once "../config/db.php";
    $user_id = $_GET['user_id']; 
    
    $stmt = $pdo->prepare("SELECT id, nom, prenom, photo_profile FROM users WHERE id != :user_id");
    $stmt->execute([':user_id' => $user_id]);  
    
    $users = $stmt->fetchAll(); 
    echo json_encode($users);   
?>