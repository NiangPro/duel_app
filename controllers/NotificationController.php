<?php
require_once(__DIR__ . '/../middleware/NotificationMiddleware.php');

class NotificationController {
    public function __construct() {
        NotificationMiddleware::init();
    }
    
    // Vérification des nouvelles notifications via AJAX
    public function checkNotifications() {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
            header('HTTP/1.1 403 Forbidden');
            exit('Accès interdit');
        }
        
        header('Content-Type: application/json');
        echo json_encode(NotificationMiddleware::getNotifications());
        exit;
    }
    
    // Marquer une notification comme lue
    public function markAsRead() {
        if (!isset($_POST['notification_id'])) {
            return false;
        }
        
        $notificationId = SecurityConfig::sanitizeInput($_POST['notification_id']);
        // Logique pour marquer comme lue
        return true;
    }
    
    // Récupérer les préférences de notifications de l'utilisateur
    public function getUserPreferences() {
        $user = AuthController::getCurrentUser();
        if (!$user) {
            return [];
        }
        
        return $user->getPreferences()['notifications'] ?? [];
    }
    
    // Mettre à jour les préférences de notifications
    public function updatePreferences($preferences) {
        $user = AuthController::getCurrentUser();
        if (!$user) {
            return false;
        }
        
        $userPrefs = $user->getPreferences();
        $userPrefs['notifications'] = $preferences;
        $user->setPreferences($userPrefs);
        
        return true;
    }
}