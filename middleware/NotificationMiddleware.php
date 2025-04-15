<?php

class NotificationMiddleware {
    private static $notifications = [];
    
    // Types de notifications
    const TYPE_INFO = 'info';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_ERROR = 'error';
    
    // Initialisation du système de notifications
    public static function init() {
        if (!isset($_SESSION['notifications'])) {
            $_SESSION['notifications'] = [];
        }
    }
    
    // Ajout d'une nouvelle notification
    public static function add($message, $type = self::TYPE_INFO, $duration = 5000) {
        $notification = [
            'id' => uniqid('notif_'),
            'message' => SecurityConfig::escapeHtml($message),
            'type' => $type,
            'duration' => $duration,
            'timestamp' => time()
        ];
        
        $_SESSION['notifications'][] = $notification;
    }
    
    // Récupération des notifications non lues
    public static function getNotifications() {
        $notifications = $_SESSION['notifications'] ?? [];
        $_SESSION['notifications'] = [];
        return $notifications;
    }
    
    // Notification pour les nouveaux défis
    public static function notifyNewChallenge($challenge) {
        self::add(
            "Nouveau défi créé : {$challenge['titre']}",
            self::TYPE_INFO
        );
    }
    
    // Notification pour les matchs à venir
    public static function notifyUpcomingMatch($match) {
        self::add(
            "Match à venir : {$match['titre']}",
            self::TYPE_WARNING
        );
    }
    
    // Notification de succès d'une action
    public static function notifySuccess($message) {
        self::add($message, self::TYPE_SUCCESS);
    }
    
    // Notification d'erreur
    public static function notifyError($message) {
        self::add($message, self::TYPE_ERROR);
    }
}