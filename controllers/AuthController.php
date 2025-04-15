<?php
require_once(__DIR__ . '/../models/User.php');
require_once(__DIR__ . '/../config/security.php');

class AuthController {
    // Gestion de la connexion
    public static function login($email, $password) {
        try {
            // Validation des entrées
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
                throw new Exception('Email invalide');
            }
            
            if (strlen($password) < 8) {
                throw new Exception('Mot de passe invalide');
            }
            
            // Récupération de l'utilisateur
            $user = self::getUserByEmail($email);
            if (!$user || !password_verify($password, $user->getMdp())) {
                throw new Exception('Identifiants incorrects');
            }
            
            // Mise à jour de la dernière connexion
            $user->updateDerniereConnexion();
            
            // Création de la session sécurisée
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['user_role'] = $user->getRole();
            $_SESSION['last_activity'] = time();
            
            // Régénération de l'ID de session pour prévenir la fixation de session
            session_regenerate_id(true);
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    // Déconnexion sécurisée
    public static function logout() {
        // Destruction de toutes les données de session
        $_SESSION = array();
        
        // Destruction du cookie de session
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
        
        // Destruction de la session
        session_destroy();
    }
    
    // Vérification de l'authentification
    public static function isAuthenticated() {
        return isset($_SESSION['user_id']) && SecurityConfig::validateSession();
    }
    
    // Vérification des permissions
    public static function hasPermission($permission) {
        if (!self::isAuthenticated()) {
            return false;
        }
        return UserRoles::hasPermission($_SESSION['user_role'], $permission);
    }
    
    // Récupération de l'utilisateur courant
    public static function getCurrentUser() {
        if (!self::isAuthenticated()) {
            return null;
        }
        return self::getUserById($_SESSION['user_id']);
    }
    
    // Méthodes privées d'accès aux données
    private static function getUserByEmail($email) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetchObject('User');
    }
    
    private static function getUserById($id) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchObject('User');
    }
}