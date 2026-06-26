<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data['id'];
    
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
    $stmt->execute([':id' => $id]);
    
    echo json_encode(["success" => true, "message" => "Post supprimé"]);
?>