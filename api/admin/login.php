<?php
    require_once "../config/db.php";
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $email = $data['email'];
    $mot_de_passe = $data['mot_de_passe'];
    if (empty($email)||empty($mot_de_passe)) {
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
    if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
        echo json_encode(["success" => false, "message" => "Mot de passe incorrect"]);
        exit;
        // mot de passe incorrect;
    }
    if ($user['role'] === 'user') {
        echo json_encode(["success" => false, "message" => "Accès refusé"]);
        exit;
    }
    echo json_encode([
    "success" => true, 
    "message" => "Connexion réussie",
    "user" => [
        "id" => $user['id'],
        "nom" => $user['nom'],
        "prenom" => $user['prenom'],
        "email" => $user['email'],
        "role" => $user['role'],
        "photo_profile" => $user['photo_profile']
    ]
    ]);
?>