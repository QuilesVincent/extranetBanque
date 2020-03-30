-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 30 mars 2020 à 19:31
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phpopcproject`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteurpartenaire`
--

CREATE TABLE `acteurpartenaire` (
  `id_actor` int(11) NOT NULL,
  `name_actor` varchar(255) NOT NULL,
  `presentation_actor` text NOT NULL,
  `like_actor` int(11) NOT NULL,
  `dislike_actor` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acteurpartenaire`
--

INSERT INTO `acteurpartenaire` (`id_actor`, `name_actor`, `presentation_actor`, `like_actor`, `dislike_actor`) VALUES
(1, 'Formation&co', 'Formation&co est une association française présente sur tout le territoire.\r\nNous proposons à des personnages issues de tout millieu de devenir entrepreneur grâce à un crédit et un accompagnement professionel et personnalisé.', 1, 1),
(2, 'Protectpeople', 'Protectpeople finance la solidarité nationale.\r\nNous appliquons le principe édifié par la sécurité sociale française en 1945 : permettre à chacun de bénéficier d\'une protection sociale.', 0, 0),
(3, 'DSA France', 'Dsa France accélère la croissance du territoire et s\'engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\nNotre philosophie : s\'adapter à chaque entreprise.\r\nNous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises', 0, 0),
(4, 'CDE', 'La CDE (Chambres Des Entrepreneurs) accompagne les entreprises dans leur démarches de formation.\r\nSon président est élu pour 3 ans par ses pairs, chef d\'entreprises et présidents de CDE.', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_targetActor` int(11) NOT NULL,
  `id_targetUser` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_targetActor`, `id_targetUser`, `comment_content`, `comment_date`) VALUES
(23, 1, 37, 'Quelle est la valeur du xrp ?', '2020-03-23');

-- --------------------------------------------------------

--
-- Structure de la table `dislikeactor`
--

CREATE TABLE `dislikeactor` (
  `id_dislike` int(11) NOT NULL,
  `id_targetActorDislike` int(11) NOT NULL,
  `id_targetUserDislike` int(11) NOT NULL,
  `dislike_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `dislikeactor`
--

INSERT INTO `dislikeactor` (`id_dislike`, `id_targetActorDislike`, `id_targetUserDislike`, `dislike_number`) VALUES
(90, 1, 38, 1),
(95, 1, 37, 1);

-- --------------------------------------------------------

--
-- Structure de la table `likeactor`
--

CREATE TABLE `likeactor` (
  `id_like` int(11) NOT NULL,
  `id_targetActorLike` int(11) NOT NULL,
  `id_targetUserLike` int(11) NOT NULL,
  `like_number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `likeactor`
--

INSERT INTO `likeactor` (`id_like`, `id_targetActorLike`, `id_targetUserLike`, `like_number`) VALUES
(164, 1, 39, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `secretQuestion` varchar(255) NOT NULL,
  `secretQuestionAnswer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `lastName`, `firstName`, `userName`, `userPassword`, `secretQuestion`, `secretQuestionAnswer`) VALUES
(38, 'po', 'po', 'po', '$2y$10$ojEmy57yNV7OH8E7V/kateR6IDww66oX/d2x76xHyrehnZQO5o8XK', '1', 'po'),
(39, 'bob', 'bob', 'bob', '$2y$10$pID8V2UWmQcOBPjOLkJDSek5uhXpL5McgSsulFJ/GtyR6zfaPkF6q', '1', 'bob'),
(37, 'hackerPro', 'hackerPro', 'hackerPro', '$2y$10$nctVFhCoFmRZ1Jvg5/98KOzmf1aulzFfTulHyNpMtI0g/mpTp662W', '1', 'hackerPro');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acteurpartenaire`
--
ALTER TABLE `acteurpartenaire`
  ADD PRIMARY KEY (`id_actor`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `dislikeactor`
--
ALTER TABLE `dislikeactor`
  ADD PRIMARY KEY (`id_dislike`);

--
-- Index pour la table `likeactor`
--
ALTER TABLE `likeactor`
  ADD PRIMARY KEY (`id_like`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acteurpartenaire`
--
ALTER TABLE `acteurpartenaire`
  MODIFY `id_actor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `dislikeactor`
--
ALTER TABLE `dislikeactor`
  MODIFY `id_dislike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `likeactor`
--
ALTER TABLE `likeactor`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
