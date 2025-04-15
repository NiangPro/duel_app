<?php

class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $dsn = 'mysql:host=localhost;dbname=duel_app;charset=utf8';
        $username = 'root';
        $password = '';

        try {
            $this->pdo = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->pdo;
    }

    private function __clone() {}
    public function __wakeup() {}
}

function ajouterParticipant($prenom, $nom, $cohorte_id, $challenge_id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("INSERT INTO participant(prenom, nom, cohorte_id, challenge_id) VALUES(:prenom, :nom, :cohorte_id, :challenge_id)");
        return $q->execute([
            "prenom" => ucfirst($prenom),
            "nom" => ucfirst($nom),
            "cohorte_id" => $cohorte_id,
            "challenge_id" => $challenge_id,
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function supprimerMatches($challenge_id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("DELETE FROM matches WHERE challenge_id =:challenge_id");
        return $q->execute(["challenge_id" => $challenge_id]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function matches($idchallenge) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM matches WHERE challenge_id = :idchallenge");
        $q->execute(["idchallenge" => $idchallenge]);
        return $q->fetchAll();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function parcours($idpart) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * 
            FROM matches
         WHERE id_part1 = :idpart OR id_part2 = :idpart");
        $q->execute([
            "idpart" => $idpart,
        ]);
        return $q->fetch();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function cursus($idpart) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * 
            FROM participant
         WHERE id = :idpart OR existant = :idpart ORDER BY id ASC");
        $q->execute([
            "idpart" => $idpart,
        ]);
        return $q->fetchAll();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function ajouterMatch($id_part1, $id_part2, $challenge_id, $gagnant = null, $statut = 0) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("INSERT INTO matches(id_part1, id_part2, challenge_id, gagnant_id, statut) VALUES(:id_part1, :id_part2, :challenge_id, :gagnant, :statut)");
        return $q->execute([
            "id_part1" => $id_part1,
            "id_part2" => $id_part2,
            "challenge_id" => $challenge_id,
            "gagnant" => $gagnant,
            "statut" => $statut,
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function gagner($id, $gagnant) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("UPDATE matches SET gagnant_id =:gagnant, statut =:statut WHERE id =:id");
        return $q->execute([
            "id" => $id,
            "gagnant" => $gagnant,
            "statut" => 1,
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function ajouterCohorte($nom) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("INSERT INTO cohortes(nom) VALUES(:nom)");
        return $q->execute([
            "nom" => ucfirst($nom),
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function cohortes() {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM cohortes ORDER BY id DESC");
        $q->execute();
        return $q->fetchAll();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function cohorte($id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM cohortes WHERE id =:id");
        $q->execute([
            "id" => $id,
        ]);
        return $q->fetch();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function challenges() {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM challenges ORDER BY id DESC");
        $q->execute();
        return $q->fetchAll();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function dernierChallenge($parent_id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM challenges WHERE parent_id=:parent_id ORDER BY id DESC");
        $q->execute(["parent_id" => $parent_id]);
        return $q->fetch();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function supprimerChallenge($id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("DELETE FROM challenges WHERE id =:id");
        return $q->execute(["id" => $id]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function participants($challenge_id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT p.*, c.nom as nomcohorte FROM participant p LEFT JOIN cohortes c ON p.cohorte_id = c.id WHERE p.challenge_id = :challenge_id");
        $q->execute(["challenge_id" => $challenge_id]);
        return $q->fetchAll();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
        return [];
    }
}

function participant($id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT p.*, c.nom as nomcohorte FROM participant p LEFT JOIN cohortes c ON p.cohorte_id = c.id WHERE p.id = :id");
        $q->execute(["id" => $id]);
        return $q->fetch();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
        return null;
    }
}

function ajouterChallenge($nom, $debut, $statut = 0) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("INSERT INTO challenges(nom, debut, statut) VALUES(:nom, :debut, :statut)");
        return $q->execute([
            "nom" => ucfirst($nom),
            "debut" => $debut,
            "statut" => $statut,
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function changerStatut($id, $statut) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("UPDATE challenges SET statut =:statut WHERE id =:id");
        return $q->execute([
            "statut" => $statut,
            "id" => $id,
        ]);
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function challenge($id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM challenges WHERE id =:id");
        $q->execute([
            "id" => $id,
        ]);
        return $q->fetch();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}

function verifierChallenge($id) {
    try {
        $db = Database::getInstance();
        $q = $db->prepare("SELECT * FROM matches WHERE challenge_id =:id AND statut = :statut");
        $q->execute([
            "id" => $id,
            "statut" => 0,
        ]);
        return $q->fetchALL();
    } catch (PDOException $th) {
        setmessage("Erreur: ".$th->getMessage()." a la ligne: ".__LINE__, "danger");
    }
}
