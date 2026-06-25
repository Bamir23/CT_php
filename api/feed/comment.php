<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $user_id = $data['user_id'];
    $post_id = $data['post_id'];
    $content = $data['content'];
    
    if (empty($content)) {
        echo json_encode(["success" => false, "message" => "Le commentaire ne peut pas être vide"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (:user_id, :post_id, :content)");
    $stmt->execute([
    ':user_id' => $user_id,
    ':post_id' => $post_id,
    ':content' => $content,
    ]);
    echo json_encode(["success" => true, "message" => "Commentaire ajouté"]);

?>