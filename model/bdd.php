<?php

class MyDatabase {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $charset;
    public $pdo;

    public function connect_to_db(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "epitech";
        $this->dbname = "my_meetic";
        $this->charset = "utf8mb4";

        try {
        $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo; 
        } catch (PDOException $e) {
            echo "Connexion échouée: ".$e->getMessage();
        }
        
    }

    public function add_user_to_db ($nom, $prenom, $date, $genre, $ville, $email, $hash, $loisir){
        try {
            $req = "INSERT INTO membre VALUES (0,'$nom', '$prenom', '$date', '$genre', '$ville', '$email', '$hash')";
            $res_infos = $this->pdo->exec($req);
            $req_email = "SELECT *  FROM membre WHERE email='$email'";
            $res_email = $this->pdo->query($req_email);
            $id_membre = $res_email->fetch();
            
            for ($i=0; $i<=count($loisir); $i++){
                $req_relation = "INSERT INTO relation VALUES (0, $id_membre[0], $loisir[$i])";
                $res = $this->pdo->exec($req_relation);
                return true;
            }
            return true;
        } catch(Exception $e) {
            return false;
        }

    }

    public function do_user_exists($email){
            $req = "SELECT *  FROM membre WHERE email='$email'";
            $res = $this->pdo->query($req);
            $user = $res->fetch();
            if(!empty($user)){
               return true; 
            } return false;
        }

    public function user_connexion($email, $password) {

            $req = "SELECT * FROM membre WHERE email='$email'";
            $res = $this->pdo->query($req);
            $connexion = $res->fetch(); 
            if(!empty($connexion)){
                $pass_verif = password_verify($password, $connexion[7]);
                if($pass_verif == true){
                    echo $connexion[0];
                } else {
                    return false;
                }
            
            }

    } 

}