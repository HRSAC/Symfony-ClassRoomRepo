-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 mai 2023 à 12:36
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `app_classroom`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `peut_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `justificatif` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_765AE0C96552D5EA` (`peut_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `periode_debut` date NOT NULL,
  `periode_fin` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eleve_max` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDCA8C9CA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230503085738', '2023-05-03 08:59:14', 630),
('DoctrineMigrations\\Version20230503090551', '2023-05-03 09:05:55', 90);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naiss_eleve` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `telephone_eleve` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `mail`, `nom`, `prenom`, `date_naiss_eleve`, `sexe`, `telephone_eleve`, `adresse`, `profession`, `diplome`, `matricule`) VALUES
(1, 'jakub@pologne.fr', 'Jakub', 'vaauski', '2018-01-01 00:00:00', 1, '06757463', '11 rue de la pologne', NULL, NULL, ''),
(2, 'jakub@pologne.fr', 'Jakub', 'vaauski', '2018-01-01 00:00:00', 1, '06757463', '11 rue de la pologne', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `inscrit`
--

DROP TABLE IF EXISTS `inscrit`;
CREATE TABLE IF NOT EXISTS `inscrit` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit_cours`
--

DROP TABLE IF EXISTS `inscrit_cours`;
CREATE TABLE IF NOT EXISTS `inscrit_cours` (
  `inscrit_id` int NOT NULL,
  `cours_id` int NOT NULL,
  PRIMARY KEY (`inscrit_id`,`cours_id`),
  KEY `IDX_D587C7FB6DCD4FEE` (`inscrit_id`),
  KEY `IDX_D587C7FB7ECF78B0` (`cours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscrit_eleve`
--

DROP TABLE IF EXISTS `inscrit_eleve`;
CREATE TABLE IF NOT EXISTS `inscrit_eleve` (
  `inscrit_id` int NOT NULL,
  `eleve_id` int NOT NULL,
  PRIMARY KEY (`inscrit_id`,`eleve_id`),
  KEY `IDX_C4EC4E906DCD4FEE` (`inscrit_id`),
  KEY `IDX_C4EC4E90A6CC7B2` (`eleve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naiss_user` date NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` int DEFAULT NULL,
  `adresse` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role`, `password`, `nom`, `prenom`, `date_naiss_user`, `mail`, `sexe`, `adresse`, `telephone`) VALUES
(8, '[\"ROLE_ADMIN\"]', '$2y$13$/gSngAYHaIkOPLJxiiZ2OeCYFViBjrK.8z/nswO2oT58.U1w8yAe6', 'Jacqueline', 'Lopez', '2020-05-17', 'clemence.dupre@levy.com', 1, '', '0675847234'),
(9, '[\"ROLE_USER\"]', '$2y$13$1YDR8QB2elNZqXhWusdV1urEsTQdKmiwtA7ABkwVBFUtX3bpMEy5C', 'Étienne', 'Mendes', '1994-08-02', 'vdufour@pottier.fr', 1, '', '0675847234');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_765AE0C96552D5EA` FOREIGN KEY (`peut_id`) REFERENCES `eleve` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `inscrit_cours`
--
ALTER TABLE `inscrit_cours`
  ADD CONSTRAINT `FK_D587C7FB6DCD4FEE` FOREIGN KEY (`inscrit_id`) REFERENCES `inscrit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D587C7FB7ECF78B0` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscrit_eleve`
--
ALTER TABLE `inscrit_eleve`
  ADD CONSTRAINT `FK_C4EC4E906DCD4FEE` FOREIGN KEY (`inscrit_id`) REFERENCES `inscrit` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C4EC4E90A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
