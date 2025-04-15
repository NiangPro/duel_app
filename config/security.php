<?php

// Configuration de sécurité globale
class SecurityConfig {
    // Clé secrète pour les tokens CSRF
    private static $csrfSecret = 'votre_cle_secrete_ici';
    
    // Durée de validité du token CSRF en secondes (1 heure)
    private static $csrfTokenExpiration = 3600;
    
    // Configuration des en-têtes de sécurité
    public static function setSecurityHeaders() {
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Content-Type-Options: nosniff');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline';");
    }
    
    // Génération d'un token CSRF
    public static function generateCsrfToken() {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time();
        return $token;
    }
    
    // Validation du token CSRF
    public static function validateCsrfToken($token) {
        if (!isset($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time'])) {
            return false;
        }
        
        if ($_SESSION['csrf_token'] !== $token) {
            return false;
        }
        
        if (time() - $_SESSION['csrf_token_time'] > self::$csrfTokenExpiration) {
            return false;
        }
        
        return true;
    }
    
    // Échappement des données pour prévenir les XSS
    public static function escapeHtml($data) {
        if (is_array($data)) {
            return array_map([self::class, 'escapeHtml'], $data);
        }
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    // Validation et nettoyage des entrées
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        return strip_tags(trim($data));
    }
    
    // Validation des sessions
    public static function validateSession() {
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
            session_unset();
            session_destroy();
            return false;
        }
        $_SESSION['last_activity'] = time();
        return true;
    }
}