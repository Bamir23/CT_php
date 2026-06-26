<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $sender_id = $data['sender_id'];
    $receiver_id = $data['receiver_id'];
    $content = $data['content'];
    $image_path = $data['image_path'];
    
    if (empty($content)) {
        echo json_encode(["success" => false, "message" => "Le message ne peut pas être vide"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, content, image_path) VALUES (:sender_id, :receiver_id, :content, :image_path)");
    $stmt->execute([
    ':sender_id' => $sender_id,
    ':receiver_id' => $receiver_id,
    ':content' => $content,
    ':image_path' => $image_path
    ]);
    echo json_encode(["success" => true, "message" => "Message envoyé"]);

?>