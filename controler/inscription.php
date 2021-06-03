<?php
require_once '../model/bdd.php';

$db = new Mydatabase();
$db->connect_to_db();

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$date = $_POST["date"];
$genre = $_POST["genre"];
$ville = $_POST["ville"];
$email = $_POST["email"];
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_DEFAULT);
$loisirs = $_POST["loisir"];
$loisir = explode(",", $loisirs);

if (isset($nom) && isset($prenom) && isset($date) && isset($genre) && isset($ville) && isset($email) && isset($password) && isset($loisirs))
{

    if ($db->do_user_exists($email) == true)
    {

        echo "email existe";
    }

    else
    {
        if ($db->add_user_to_db($nom, $prenom, $date, $genre, $ville, $email, $hash, $loisir) == true)
        {

            echo "success";
        }
    }
}