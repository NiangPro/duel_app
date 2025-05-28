<?php 

if (!isset($_SESSION["user"])) {
    return header("Location:?page=home");
}

if (isset($_POST["afficher"])) {
    extract($_POST);

    if (notEmpty([$challenge])) {
        return header("Location:?page=match&challenge=".$challenge);
    }else{
        setmessage("Veuillez selectionner un challenge", "danger");
        return header("Location:?page=match");
    }
}

if (isset($_GET["gagnant"]) && isset($_GET["match"])) {
    if (gagner($_GET["match"], $_GET["gagnant"])) {
        $p = apprenant($_GET["gagnant"]);
        setmessage("Félicitations à {$p->prenom} {$p->nom} de la {$p->nomcohorte}");
        return header("Location:?page=match&challenge=".$_GET["challenge"]);
    }
}

if (isset($_GET["next"])) {
    $matches = matches($_GET["challenge"]);
    $challenge = challenge($_GET["challenge"]);

    
    if ($challenge) {
        if (changerStatut($challenge->id, 2)) {
            $nom = count($matches) == 2 ? $challenge->nom."_final" : $challenge->nom."_1";
            $parent_id = $challenge->parent_id ?:$challenge->id;
            if (ajouterChallenge($nom, $challenge->debut, 1, $parent_id)) {
                $last = challenges()[0];
                foreach ($matches as $m) {
                    ajouterParticipant($m->gagnant_id, $last->id);
                }
    
                $mats = matches($last->id);

                if (count($mats) > 0) {
                    setmessage("Il y a des matches en cours", "warning");
                }else{
                    $teams = participants($last->id);
            
                    if (count($teams) > 0) {
                        // Mélanger aléatoirement les équipes
                        shuffle($teams);
                        
                        /// Vérifier si le nombre d'équipes est impair
                        $bye_team = null;
                        if (count($teams) % 2 !== 0) {
                            // Sélectionner une équipe aléatoire qui passe directement au tour suivant
                            $bye_team = array_pop($teams);
                        }
            
                        // Former les matchs
                        $matches = array_chunk($teams, 2);
                        // print_r($bye_team);
                        // die();
            
            
                        foreach ($matches as $match) {
                            ajouterMatch($match[0]->apprenant_id, $match[1]->apprenant_id, $last->id);
                        }
            
                        // Afficher l'équipe qui passe directement au tour suivant
                        if ($bye_team) {
                            ajouterMatch($bye_team->apprenant_id, null, $last->id, $bye_team->apprenant_id, 1);
            
                            setmessage("Tirage effectué, {$bye_team->prenom} {$bye_team->nom} est automatiquement qualifié(e) pour le prochain tour.");
            
                        }else{
                            setmessage("Tirage effectué");
                        }
                    }else{
                        setmessage("Aucun participant pour le moment", "danger");
                    }
                
                    
                }
                return header("Location:?page=challenge&type=edit&id=$last->id");
            }
        }
        
    }
}

$challenges = challenges();

if (isset($_GET["challenge"])) {
    $matches = matches($_GET["challenge"]);
    $etat = verifierChallenge($_GET["challenge"]);

}


require_once("views/includes/entete.php");
require_once("views/includes/navbar.php");

if (isset($_GET["type"])) {
    if (isset($_GET["id"])) {
        $c = challenge($_GET["id"]);
    }
    require_once("views/challenge/add.php");
}else{
    require_once("views/match/match.php");
}
require_once("views/includes/footer.php");



