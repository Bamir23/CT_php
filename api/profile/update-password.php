<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $id = $data['id'];
    $ancien_mot_de_passe = $data['ancien_mot_de_passe'];
    $nouveau_mot_de_passe = $data['nouveau_mot_de_passe'];
    
    $stmt = $pdo->prepare("SELECT mot_de_passe FROM users WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $user = $stmt->fetch();

    if (!password_verify($ancien_mot_de_passe, $user['mot_de_passe'])) {
        echo json_encode(["success" => false, "message" => "Ancien mot de passe incorrect"]);
    exit;
    }
    $nouveau_mot_de_passe_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("UPDATE users SET mot_de_passe= :mot_de_passe WHERE id = :id");
    $stmt->execute([
    ':id' => $id,
    ':mot_de_passe' => $nouveau_mot_de_passe_hash ,
    ]);
    echo json_encode(["success" => true, "message" => "Mise à jour effectué"]);

?>