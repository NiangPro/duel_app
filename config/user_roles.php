<?php

// Configuration des rôles et permissions utilisateurs
class UserRoles {
    // Définition des rôles
    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_USER = 'user';
    
    // Permissions par rôle
    private static $permissions = [
        self::ROLE_ADMIN => [
            'manage_users',
            'manage_challenges',
            'manage_matches',
            'manage_system',
            'view_statistics',
            'manage_notifications',
            'manage_roles'
        ],
        self::ROLE_MODERATOR => [
            'manage_challenges',
            'manage_matches',
            'view_statistics',
            'manage_notifications'
        ],
        self::ROLE_USER => [
            'participate_challenge',
            'view_matches',
            'view_profile',
            'update_profile'
        ]
    ];
    
    // Vérifier si un utilisateur a une permission spécifique
    public static function hasPermission($userRole, $permission) {
        if (!isset(self::$permissions[$userRole])) {
            return false;
        }
        return in_array($permission, self::$permissions[$userRole]);
    }
    
    // Obtenir toutes les permissions d'un rôle
    public static function getRolePermissions($role) {
        return isset(self::$permissions[$role]) ? self::$permissions[$role] : [];
    }
    
    // Vérifier si un rôle est valide
    public static function isValidRole($role) {
        return isset(self::$permissions[$role]);
    }
    
    // Obtenir tous les rôles disponibles
    public static function getAllRoles() {
        return array_keys(self::$permissions);
    }
}