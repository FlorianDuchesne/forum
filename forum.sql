-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 30 avr. 2021 à 12:30
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `img` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `name`, `dateCreation`, `img`) VALUES
(1, 'Japon', '2021-04-15 10:55:16', 'http://localhost/forum/public/css/img/japon.jpg'),
(2, 'Australie', '2021-04-15 10:55:26', 'http://localhost/forum/public/css/img/australie.jpg'),
(3, 'Nouvelle-Zelande', '2021-04-15 10:55:40', 'http://localhost/forum/public/css/img/newzeland.jpg'),
(4, 'Canada', '2021-04-15 10:55:47', 'http://localhost/forum/public/css/img/canada.jpg'),
(13, 'Administration', '2021-04-28 09:05:58', 'http://localhost/forum/public/css/img/administration.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `content`, `dateCreation`, `topic_id`, `user_id`) VALUES
(3, 'Bon, quelqu\'un m\'explique la religion Shintô please ?', '2021-04-15 11:27:47', 1, 2),
(7, 'Ça coûte cher n&#39;est-ce pas de vivre au Canada ?…', '2021-04-23 16:40:18', 10, 5),
(8, 'J&#39;aimerais bien parler des kangourous.', '2021-04-23 16:40:56', 11, 5),
(11, 'Avouez que personne ***NE*** connaissait la Nouvelle-Zélande avant ces films !', '2021-04-23 18:20:07', 12, 4),
(12, 'Oui je crois. Mais bon ailleurs aussi.', '2021-04-23 18:20:36', 10, 4),
(15, 'Est-ce que c&#39;est vrai qu&#39;ils savent boxer ?', '2021-04-26 10:59:18', 11, 4),
(25, 'J&#39;aime trop les hobbits. Je veux leur lifestyle.', '2021-04-26 16:38:51', 12, 5),
(31, '<figure><blockquote>Avouez que personne ***NE*** connaissait la Nouvelle-Zélande avant ces films !</blockquote><figcaption><small> Par fff le 2021-04-23 18:20:07</small></figcaption></figure><p>okay j&#39;avoue.\r\nMais depuis qu&#39;est-ce qu&#39;on kiffe. Ça a l&#39;air si beau. </p>', '2021-04-30 10:49:45', 12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT current_timestamp(),
  `lock` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `dateCreation`, `lock`, `user_id`, `category_id`) VALUES
(1, 'Culture japonaise', '2021-04-15 11:24:47', 1, 2, 1),
(10, 'coût de la vie', '2021-04-23 16:40:18', 0, 5, 4),
(11, 'kangourous', '2021-04-23 16:40:56', 0, 5, 2),
(12, 'Seigneur des anneaux', '2021-04-23 18:20:07', 0, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `dateRegistration` datetime NOT NULL DEFAULT current_timestamp(),
  `icon` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `statut` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `email`, `password`, `dateRegistration`, `icon`, `description`, `statut`) VALUES
(2, 'bidule', 'bidule@hotmail.fr', 'bidule', '2021-04-14 16:07:01', NULL, NULL, 0),
(4, 'fff', 'flamby@hotmail.fr', '$2y$10$2neAm4N0g/5RzXsfqDxmouya7ZWegDCwmp2sUYvuYoK8xD.pmvpeW', '2021-04-22 15:11:37', NULL, NULL, 1),
(5, 'jeremy', 'jeremy@hotmail.com', '$2y$10$Cc2WSCPVDh0rDVfbN28tAedDoR0xbB2fwyuJl9MxHsfyUGAGbKKxC', '2021-04-22 15:58:30', NULL, NULL, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `fk` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `pseudo` (`pseudo`,`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id_user`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `Topic` (`id_topic`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `User` (`id_user`),
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
