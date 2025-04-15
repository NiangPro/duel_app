<?php 
require_once("views/includes/fonctions.php");
require_once("models/database.php");

if (isset($_POST["login"])) {
    extract($_POST);

    $user = seconnecter($email, $mdp);
    if ($user) {
        $_SESSION["user"] = $user;
        return header("Location:?page=dashboard");
    }else{
        setmessage("Identifiants incorrects", "danger");
    }


}
require_once("views/includes/entete.php");
require_once("views/login.php");



