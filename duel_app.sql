-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 15 avr. 2025 à 15:13
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `duel_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `debut` datetime NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `challenges`
--

INSERT INTO `challenges` (`id`, `nom`, `debut`, `statut`, `parent_id`) VALUES
(1, 'Duel 1', '2025-04-16 12:44:00', 2, NULL),
(2, 'Duel 1_final', '2025-04-16 12:44:00', 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cohortes`
--

CREATE TABLE `cohortes` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cohortes`
--

INSERT INTO `cohortes` (`id`, `nom`) VALUES
(1, 'Cohorte 10'),
(2, 'Cohorte 11');

-- --------------------------------------------------------

--
-- Structure de la table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `id_part1` int(11) NOT NULL,
  `id_part2` int(11) DEFAULT NULL,
  `challenge_id` int(11) NOT NULL,
  `gagnant_id` int(11) DEFAULT NULL,
  `statut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matches`
--

INSERT INTO `matches` (`id`, `id_part1`, `id_part2`, `challenge_id`, `gagnant_id`, `statut`) VALUES
(1, 2, 1, 1, 2, 1),
(2, 3, NULL, 1, 3, 1),
(3, 4, 5, 2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `cohorte_id` int(11) NOT NULL,
  `challenge_id` int(11) DEFAULT NULL,
  `existant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`id`, `prenom`, `nom`, `cohorte_id`, `challenge_id`, `existant`) VALUES
(1, 'Abdou', 'Fall', 2, 1, NULL),
(2, 'Mouhamed', 'Diop', 1, 1, NULL),
(3, 'Rokha', 'Fall', 2, 1, NULL),
(4, 'Mouhamed', 'Diop', 1, 2, NULL),
(5, 'Rokha', 'Fall', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `prenom`, `nom`, `email`, `mdp`, `role`) VALUES
(1, 'bassirou', 'niang', 'admin@gmail.com', '$2y$12$/sCrCRz4pJYpbNfyovv8vuUSJ8Nx1/ep4TwLV8mX6YNea7DYH8UAS', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cohortes`
--
ALTER TABLE `cohortes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cohortes`
--
ALTER TABLE `cohortes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
