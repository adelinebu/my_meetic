<?php
    
    require_once '../model/bdd.php';

    $db = new Mydatabase();
    $db->connect_to_db();
    
    $email = $_POST["email"];
    $password = $_POST["password"];
  
    if(!empty($email) && !empty($password)){
        
        $req = $db->user_connexion($email, $password);
        
    } 