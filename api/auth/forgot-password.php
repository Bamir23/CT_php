<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $email = $data['email'];
    if (empty($email)) {
        echo json_encode(["success" => false, "message" => "Champs manquants"]);
    exit;
    }
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();
    if (empty($user)) {
       echo json_encode(["success" => false, "message" => "Email n'existe pas"]);
       exit;
    }
    echo json_encode(["success" => true, "message" => "Email de réinitialisation envoyé"]);
?>