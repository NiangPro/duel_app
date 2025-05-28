<?php 

if (!isset($_SESSION["user"])) {
    return header("Location:?page=home");
}

if (isset($_POST["ajouter"])) {
    extract($_POST);

    if (notEmpty([$nom])) {
        if (ajouterCohorte($nom)) {
            setmessage("Ajout cohorte avec succès");
            return header("Location:?page=cohorte");
        }
    }else{
        setmessage("Veuillez remplir tous les champs", "danger");
        return header("Location:?page=cohorte&type=add");
    }

}

if (isset($_POST["addapprenant"])) {
    extract($_POST);

    if (notEmpty([$nom, $prenom, $tel])) {
        if (ajouterApprenant($prenom, $nom, $tel, $_GET["id"])) {
            setmessage("Ajout apprenant avec succès");
            return header("Location:?page=cohorte&type=edit&id=".$_GET["id"]);
        }
    }else{
        setmessage("Veuillez remplir tous les champs", "danger");
        // return header("Location:?page=cohorte&type=add");
    }

}

if (isset($_GET["deleteAp"])) {
    if (supprimerApprenant($_GET["deleteAp"])) {
        setmessage("Suppression avec succès");
        return header("Location:?page=cohorte&type=edit&id=".$_GET["id"]);
    }
}



$cohortes = cohortes();

require_once("views/includes/entete.php");
require_once("views/includes/navbar.php");

if (isset($_GET["type"])) {

    if (isset($_GET["id"])) {
        $c = cohorte($_GET["id"]);
    }

    $apprenants = apprenantsCohorte($_GET["id"]);
    require_once("views/cohorte/add.php");
}else{
    require_once("views/cohorte/cohorte.php");
}
require_once("views/includes/footer.php");



