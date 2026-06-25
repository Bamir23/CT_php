<?php
    require_once('../config/db.php');
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $user_id = $data['user_id'];
    $post_id = $data['post_id'];
    $stmt = $pdo->prepare("SELECT id FROM likes WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->execute([':user_id' => $user_id, ':post_id' => $post_id]);
    $like = $stmt->fetch();
    if ($like) {
        // like existe → supprimer
        $stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->execute([':user_id' => $user_id, ':post_id' => $post_id]);
        echo json_encode(["success" => true, "action" => "unliked"]);
    } else {
        // like n'existe pas → insérer
        $stmt = $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
        $stmt->execute([':user_id' => $user_id, ':post_id' => $post_id]);
        echo json_encode(["success" => true, "action" => "liked"]);
    }
    
?>