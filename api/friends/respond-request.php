<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $id = $data['id'];
    $status = $data['status'];
    
    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "Erreur"]);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE friend_requests SET status = :status WHERE id = :id");
    $stmt->execute([
    ':id' => $id,
    ':status' => $status,
    ]);
    echo json_encode(["success" => true, "message" => "Demande mise à jour"]);

?>