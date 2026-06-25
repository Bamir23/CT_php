<?php
    require_once('../config/db.php');
    $data = json_decode(file_get_contents("php://input"), true);
    //var_dump($data);
    $user_id = $data['user_id'];
    $post_id = $data['post_id'];
    
?>