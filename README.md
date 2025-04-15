# Application de Gestion de Défis

Une application web permettant de gérer des défis, des cohortes, des matchs et des tirages.

## Prérequis

- PHP
- MySQL
- XAMPP (ou un serveur web compatible)

## Installation

1. Clonez ce dépôt dans votre répertoire htdocs de XAMPP
2. Importez le fichier `duel_app.sql` dans votre base de données MySQL
3. Configurez les paramètres de connexion à la base de données dans `models/database.php`
4. Accédez à l'application via votre navigateur

## Structure du Projet

```
├── controllers/          # Contrôleurs de l'application
├── models/              # Modèles et connexion base de données
├── views/               # Vues de l'application
│   ├── challenge/       # Vues liées aux défis
│   ├── cohorte/        # Vues liées aux cohortes
│   ├── match/          # Vues liées aux matchs
│   └── includes/       # Éléments communs (navbar, footer...)
├── css/                # Fichiers CSS (MDB)
├── js/                 # Fichiers JavaScript
└── img/                # Images du projet
```

## Fonctionnalités

- Système d'authentification (login/logout)
- Gestion des cohortes
- Création et gestion des défis
- Système de matchs
- Fonctionnalité de tirage
- Interface utilisateur avec Material Design Bootstrap

## Technologies Utilisées

- PHP (Backend)
- MySQL (Base de données)
- Material Design Bootstrap (Frontend)
- JavaScript

## Licence

Ce projet est sous licence MIT.
