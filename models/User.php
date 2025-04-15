<?php
require_once(__DIR__ . '/../config/user_roles.php');

class User {
    private $id;
    private $email;
    private $mdp;
    private $nom;
    private $prenom;
    private $role;
    private $photo;
    private $date_creation;
    private $derniere_connexion;
    private $preferences;
    
    // Getters
    public function getId() { return $this->id; }
    public function getEmail() { return $this->email; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getRole() { return $this->role; }
    public function getPhoto() { return $this->photo; }
    public function getDateCreation() { return $this->date_creation; }
    public function getDerniereConnexion() { return $this->derniere_connexion; }
    public function getPreferences() { return json_decode($this->preferences, true); }
    
    // Setters avec validation
    public function setEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Email invalide');
        }
        $this->email = $email;
    }
    
    public function setMdp($mdp) {
        if (strlen($mdp) < 8) {
            throw new Exception('Le mot de passe doit contenir au moins 8 caractères');
        }
        $this->mdp = password_hash($mdp, PASSWORD_DEFAULT);
    }
    
    public function setNom($nom) {
        if (empty(trim($nom))) {
            throw new Exception('Le nom ne peut pas être vide');
        }
        $this->nom = SecurityConfig::escapeHtml(trim($nom));
    }
    
    public function setPrenom($prenom) {
        if (empty(trim($prenom))) {
            throw new Exception('Le prénom ne peut pas être vide');
        }
        $this->prenom = SecurityConfig::escapeHtml(trim($prenom));
    }
    
    public function setRole($role) {
        if (!UserRoles::isValidRole($role)) {
            throw new Exception('Rôle invalide');
        }
        $this->role = $role;
    }
    
    public function setPhoto($photo) {
        // Validation du format et de la taille de l'image
        $this->photo = $photo;
    }
    
    public function setPreferences($preferences) {
        $this->preferences = json_encode($preferences);
    }
    
    // Méthodes de vérification des permissions
    public function hasPermission($permission) {
        return UserRoles::hasPermission($this->role, $permission);
    }
    
    // Méthode de mise à jour de la dernière connexion
    public function updateDerniereConnexion() {
        $this->derniere_connexion = date('Y-m-d H:i:s');
    }
    
    // Méthode de création d'un nouvel utilisateur
    public static function create($data) {
        $user = new self();
        $user->setEmail($data['email']);
        $user->setMdp($data['mdp']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        $user->setRole(UserRoles::ROLE_USER); // Rôle par défaut
        $user->date_creation = date('Y-m-d H:i:s');
        $user->derniere_connexion = date('Y-m-d H:i:s');
        $user->preferences = json_encode([]);
        
        return $user;
    }
}