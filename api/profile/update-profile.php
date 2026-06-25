<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $id = $data['id'];
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $email = $data['email'];
    $photo_profile = $data['photo_profile'];
    
    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "Erreur"]);
        exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET nom= :nom, prenom= :prenom, email= :email, photo_profile= :photo_profile WHERE id = :id");
    $stmt->execute([
    ':id' => $id,
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':photo_profile' => $photo_profile,
    ]);
    echo json_encode(["success" => true, "message" => "Mise à jour effectué"]);

?>