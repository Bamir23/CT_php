<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $sender_id = $data['sender_id'];
    $receiver_id = $data['receiver_id'];

    $stmt = $pdo->prepare("INSERT INTO friend_requests (sender_id, receiver_id) VALUES (:sender_id, :receiver_id)");
    $stmt->execute([
    ':sender_id' => $sender_id,
    ':receiver_id' => $receiver_id,
    ]);
    echo json_encode(["success" => true, "message" => "Demande envoyé"]);

?>