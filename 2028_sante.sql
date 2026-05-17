-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 17 mai 2026 à 22:16
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `2028_sante`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `log_date` date NOT NULL,
  `steps` int(11) DEFAULT 0,
  `sedentary_minutes` int(11) DEFAULT 0,
  `alerts_triggered` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `badges`
--

CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `badges`
--

INSERT INTO `badges` (`id`, `name`, `description`, `icon_url`) VALUES
(1, 'Premier Pas', 'Première réservation effectuée', 'icons/first-step.svg'),
(2, 'Marcheur', '10 000 pas en une journée', 'icons/walker.svg'),
(3, 'Anti-Sédentaire', 'Moins de 60 min sédentaires 3 jours de suite', 'icons/active.svg'),
(4, 'Habitué', '5 réservations complétées', 'icons/regular.svg');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(20) DEFAULT 'confirmed',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `start_date`, `end_date`, `status`, `created_at`) VALUES
(1, 3, '2026-05-18', '2026-05-24', 'confirmed', '2026-05-17 20:28:13'),
(2, 3, '2026-05-04', '2026-05-10', 'confirmed', '2026-05-17 20:34:47'),
(3, 3, '2026-05-11', '2026-05-17', 'confirmed', '2026-05-17 20:55:53'),
(4, 6, '2026-05-25', '2026-05-31', 'confirmed', '2026-05-17 20:57:33');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `full_name`, `created_at`) VALUES
(1, 'akotegnonannemarie@gmail.com', 'ccccc', 'AKOTEGNON Anne-Marie', '2026-05-06 15:03:49'),
(2, 'kod@gmail.com', '$2y$10$g29LKk1cp/7aDBHSW2iFiOofjvOl4ynHiYz1aDY4FAFBt8VUiDBVS', 'Amani KODAD', '2026-05-10 18:41:33'),
(3, 'marie@gmail.com', '$2y$10$UNB678vTd0uTFE7hm95H3.XsmCSzCGuR0hnHIXt2ZDTRGDcL.Ln3m', 'Marie', '2026-05-10 18:43:57'),
(4, 'vivi@gmail.com', '$2y$10$e4XT68rEdsSoaZk.yRoei.zZT93llrNdFhUi4W12yBy.CHnkV/a0W', 'vivi', '2026-05-12 08:27:59'),
(5, 'mega@gmail.com', '$2y$10$3pCpx1hqeonECtWfYxolPe3S2PG7quXAfgwpHCd1jvhkh.g7pv8We', 'mega ', '2026-05-12 09:26:41'),
(6, 'jean_pp@gmail.com', '$2y$10$9A5JFbRm8dyAdKKLfHXlPuQ4W0nybtX69grneG.1lcgIcYUNDKm6a', 'Jean pierre', '2026-05-17 20:56:41');

-- --------------------------------------------------------

--
-- Structure de la table `user_badges`
--

CREATE TABLE `user_badges` (
  `user_id` int(11) NOT NULL,
  `badge_id` int(11) NOT NULL,
  `earned_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `waitlist`
--

CREATE TABLE `waitlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `desired_start` date NOT NULL,
  `desired_end` date NOT NULL,
  `notified` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `start_date` (`start_date`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`user_id`,`badge_id`),
  ADD KEY `badge_id` (`badge_id`);

--
-- Index pour la table `waitlist`
--
ALTER TABLE `waitlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `waitlist`
--
ALTER TABLE `waitlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `user_badges`
--
ALTER TABLE `user_badges`
  ADD CONSTRAINT `user_badges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_badges_ibfk_2` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`);

--
-- Contraintes pour la table `waitlist`
--
ALTER TABLE `waitlist`
  ADD CONSTRAINT `waitlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
