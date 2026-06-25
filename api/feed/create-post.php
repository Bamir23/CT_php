<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $user_id = $data['user_id'];
    $content = $data['content'];
    $image_path = $data['image_path'];
    
    if (empty($content)) {
        echo json_encode(["success" => false, "message" => "Le post ne peut pas être vide"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO posts (user_id, content, image_path) VALUES (:user_id, :content, :image_path)");
    $stmt->execute([
    ':user_id' => $user_id,
    ':content' => $content,
    ':image_path' => $image_path
    ]);
    echo json_encode(["success" => true, "message" => "Post créé"]);

?>