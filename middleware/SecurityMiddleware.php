<?php
require_once(__DIR__ . '/../config/security.php');

class SecurityMiddleware {
    public static function handle() {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['csrf_token'])) {
                SecurityConfig::generateCsrfToken();
            }
        }
        
        // Configurer les en-têtes de sécurité
        SecurityConfig::setSecurityHeaders();
        
        // Valider la session
        if (!SecurityConfig::validateSession()) {
            header('Location: ?page=login');
            exit();
        }
        
        // Vérifier le token CSRF pour les requêtes POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || !SecurityConfig::validateCsrfToken($_POST['csrf_token'])) {
                die('Token CSRF invalide');
            }
        }
        
        // Nettoyer les entrées
        $_GET = SecurityConfig::sanitizeInput($_GET);
        $_POST = SecurityConfig::sanitizeInput($_POST);
        
        // Générer un nouveau token CSRF uniquement si nécessaire
        if (!isset($_SESSION['csrf_token'])) {
            $csrf_token = SecurityConfig::generateCsrfToken();
            define('CSRF_TOKEN', $csrf_token);
        }
    }
}