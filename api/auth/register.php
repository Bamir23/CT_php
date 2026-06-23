<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $email = $data['email'];
    $mot_de_passe = $data['mot_de_passe'];
    if (empty($nom)||empty($prenom)||empty($email)||empty($mot_de_passe)) {
        echo json_encode(["success" => false, "message" => "Champs manquants"]);
    exit;
    }
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();
    if ($user) {
       echo json_encode(["success" => false, "message" => "Email déjà utilisé"]);
       exit;
    }
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
    $stmt->execute([
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':mot_de_passe' => $mot_de_passe_hash
    ]);
    echo json_encode(["success" => true, "message" => "Inscription réussie"]);

?>