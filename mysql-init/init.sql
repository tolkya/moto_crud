-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 28 avr. 2025 à 23:52
-- Version du serveur : 8.0.41
-- Version de PHP : 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moto`
--

-- --------------------------------------------------------

--
-- Structure de la table `motos`
--

CREATE TABLE `motos` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MOTO',
  `Description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `Utilite` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Modele` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Edition` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Couleur` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Annee` year DEFAULT NULL,
  `Categorie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Cylindree` int DEFAULT NULL,
  `Chevaux` decimal(4,1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `motos`
--

INSERT INTO `motos` (`id`, `user_id`, `Image`, `Description`, `Utilite`, `Modele`, `Edition`, `Couleur`, `Annee`, `Categorie`, `Cylindree`, `Chevaux`, `created_at`) VALUES
(7, 1, 'hondacmx500rebel.jpg', 'Bicylindre très agréable', 'Balade', 'CMX500 REBEL', '', 'Noir Mat', '2025', 'Cruiser', 471, 46.0, '2025-03-04 18:33:33'),
(8, 1, 'Hornet1000.jpg', '4 cylindres en lignes très coupleux', 'Balade, travail par beau temps', 'CB1000 Hornet', 'SSP', 'Gris Mat', '2025', 'Roadster', 1000, 152.0, '2025-03-04 18:42:05'),
(9, 1, 'africa_twin.jpg', 'design idéale pour son usage tous terrain', 'Balade, sortis dans le bois et sentiers', 'CRF1100L Africa Twin', '', 'Noir Mat', '2025', 'Adventure', 1084, 102.0, '2025-03-04 18:48:25'),
(10, 1, 'monkey125.jpg', 'passe partout faible consommation très agréable', 'petite course, bord de plage', 'Monkey 125', '', 'Rouge', '2024', '', 124, 12.0, '2025-03-04 23:32:16'),
(11, 2, 'cb1251.webp', 'Bonne accélération pour une 125, idéal pour la ville.', 'Petit trajet quotidien lors des beaux jours, balade.', 'CB 125', 'Néo sport café', 'Bleu foncé', '2023', 'Roadster', 125, 15.0, '2025-03-09 21:29:22'),
(12, 1, 'Honda-XL-750-Transalp-2023.webp', 'Pleins d&#039;assistance au pilotage,', 'Un peu de off-road, aller au boulot, balade occasionnelle', 'Honda XL 750 Transalp', '', 'Bleu Blanc Rouge', '2025', 'Trail', 750, 92.0, '2025-03-09 21:45:42'),
(13, 1, 'gl 1800 goldwing.jpeg', 'Un velouté de 6 cylindres avec pourtant une ligne dynamique.', 'Balades, week-end vacances, boulot. Seconde voiture au final.', 'GL 1800 GOLDWING DCT', '', 'Bleu nuit', '2022', 'Routiere', 1833, 126.0, '2025-03-09 22:03:28'),
(14, 1, 'CRF250R.jpg', 'Idéale pour du off-road de campagne ou en foret, très gros jouet. facilité de démontage entretien.', 'off-road, balade en chemin.', 'CRF 250 R', '', 'Rouge vif', '2025', 'Cross', 249, 46.0, '2025-03-09 22:12:22'),
(15, 1, 'GB350S.webp', 'Un moteur super carré, un vrai plaisir en balade détente.', 'Balade, petit trajet du week-end.', 'GB 350 S', '', 'Black', '2025', 'Roadster', 348, 21.0, '2025-03-09 22:18:04'),
(16, 1, 'cb650Rblack.jpg', 'très agréable, moteur coupleux qui réagis correctement.', 'Balade, quotidien.', 'CB650R', 'Néeo rétro sport café', 'Black', '2023', 'Roadster', 649, 95.0, '2025-03-17 15:13:28'),
(17, 4, 'honda-nx-650-dominator-1987.jpg', 'Moteur très joueur', 'Balade du week-end', 'NX 650 Dominatore', '', 'Black', '1987', 'Trail', 644, 46.0, '2025-03-20 08:51:12'),
(18, 5, 'hondacmx125-rebel1985.jpg', 'Moto facile a entretenir, une consommation très faible', 'Petite balade, quand je veux me détendre c\'est la compagne idéale.', 'CMX 250 Peronist', 'Custom', 'Verte', '1986', 'Cruiser', 234, 18.0, '2025-03-20 09:39:21'),
(20, 7, 'honda-cbx-honda-cbx-1000-1980-125-cm3-moto-routiere-45-000-km-gris-75009-paris-09-gris_245611516.webp', 'Chassis robuste', 'Balade', 'CB X 1000', '', 'GRIS', '1980', 'Roadster', 1000, 105.0, '2025-04-28 22:05:52'),
(21, 7, 'honda cb 550 1978.webp', 'Excellent moteur', 'Balade le week-end', 'CB 550', 'Super sport Four', 'Ruby', '1978', 'Roadster', 550, 50.0, '2025-04-28 22:16:52'),
(22, 8, '750 honda.jpg', 'Moteur construit par M3 racing', 'Exposition', 'CR 750', 'Daytona', 'GRIS / ROUGE', '1996', 'Sportive', 750, 93.0, '2025-04-28 22:22:23'),
(23, 9, 'honda-vt-honda-vt-750-shadow-ace-c2-bj-1999-von-1-hand_156314233.jpg', 'Bon gabarit et moteur simple', 'Profiter du beau temps', 'VT 750', 'Shadow', 'Blanche', '1998', '', 745, 46.0, '2025-04-28 23:28:19'),
(24, 10, 'cx 500 1981.webp', 'Moteur délicat', 'balade au lac, restaurant.', 'CX 500', '', 'Bleu/vert canard', '1981', 'Cruiser', 497, 78.0, '2025-04-28 23:34:42'),
(25, 11, 'honda-cmx300-rebel-300-detailed-specs-background-performance-and-more_23be2ba3-8068-4c20-84df-b3d5ef587f37.webp', 'Le mixe d&#039;un cruiser classic et les nouvelles technologies comme les leds et accessoires', 'balade, aller en ville, profiter des beaux jours.', 'Rebel CMX 300', '', 'Black', '2022', 'Cruiser', 286, 27.0, '2025-04-28 23:44:22'),
(26, 12, '-125-MSX-1.webp', 'Simple et robuste, très marrante.', 'Aller en ville durant les beau jours', 'MSX 125', '', 'Rouge', '2018', 'Roadster', 125, 10.0, '2025-04-28 23:52:04');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `statut`, `created_at`) VALUES
(1, 'Talkya', 'test1@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$djN5dFJWOGVhRXEuLjlJZg$HAScvNbF81h54SvToPv9Rbs/5zO9K1M/FbJVnXDV4Zw', NULL, '2025-02-27 12:34:11'),
(2, 'Chloe', 'chloe@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$aHZ1U1R5dnBya3Nwcnc0Tw$ej6SDz+EJE5z9d80KSQVO+3vex9J7DG8uvYtm0IAcQs', NULL, '2025-03-01 19:32:32'),
(3, 'NIKOS', 'nico87@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$Y2Q1ME9TZW14UTNCZnUwWQ$kgK/Eqiwz4xL7DzN9gxmEutsRq7TbyLf8ftTjUs/4mQ', NULL, '2025-03-03 00:31:13'),
(4, 'Benjamin', 'benjamin@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$dGouL0NrVy5wcXU3UzVmcw$8GvYhyuE5ZknMuZXaQSdhRrsfpiURHSw9cp6UDlDB7Y', NULL, '2025-03-20 08:32:48'),
(5, 'Mervin', 'mervin@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$M1F0VWZVaEZBc1hGa090Rw$lrqdD3I/5AY+Rh5VZpT7+tZWTTjHwR2L1CHRIyIy3pQ', NULL, '2025-03-20 09:20:00'),
(6, 'nolan', 'nolan@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$a3VDWU90akpzdEc1QzF3VQ$CfXE6UQSeYjfvEcmB3gV2rBQqnCu8XDqmfzIEi6qpws', NULL, '2025-03-20 12:33:21'),
(7, 'huo', 'hugo@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$ZlVxQU1tUUNsM2IwRWE5RQ$6C0JeXC42gd7soBtO9uB7yPGCv96aRDZ0ThEYXtZaHY', NULL, '2025-04-28 22:01:59'),
(8, 'Mulon', 'T.mulon@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$S2p6R2RzMngvTEk5TFg0aQ$dPZKZTGXxdbL6wxEhO367V9iKth5mJ2+bi0x+rOdZPs', NULL, '2025-04-28 22:17:41'),
(9, 'Léo', 'L.natte@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$bFZoQnFDVWYubDhnc0VwSw$ftMHqheDCr4uEE9xizBfYc9Yc0WSAaGzWx/mO0zojUk', NULL, '2025-04-28 22:26:05'),
(10, 'Alice', 'A.liu@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$NFQ3T3VSYUVwZ1IuR0VZZg$lKoae4cBGQtPwpJI2+72W9Q7TXF3hkPK6G1IDfpVR2M', NULL, '2025-04-28 23:28:58'),
(11, 'Juliette', 'J.emerau@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$emE0UnNkNk1UekNtUTdWLw$b/vqysNdKmPKvlw/X83sA8U18WQNrwpS4XU5itjYxOk', NULL, '2025-04-28 23:36:18'),
(12, 'Maeva', 'M.roux@email.fr', '$argon2id$v=19$m=65536,t=4,p=1$OWU4MFZVQTd2QkJYMnVrNA$uU3vUDskjctgUqOF9o9BbTRtwZEViroUSwlMiQoasbA', NULL, '2025-04-28 23:45:38');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `motos`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `motos`
--
ALTER TABLE `motos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `motos`
--
ALTER TABLE `motos`
  ADD CONSTRAINT `motos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
