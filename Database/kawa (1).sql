-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 fév. 2022 à 13:02
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kawa`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `nom_adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `voie` varchar(255) NOT NULL,
  `voie_sup` varchar(250) NOT NULL,
  `code_postal` int NOT NULL,
  `telephone` varchar(250) NOT NULL,
  `fk_id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `fk_id_utilisateur` (`fk_id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(250) NOT NULL,
  `presentation_article` varchar(250) NOT NULL,
  `description_article` text CHARACTER SET utf8mb4 COLLATE utf8_general_ci NOT NULL,
  `prix_article` float NOT NULL,
  `image_article` varchar(250) NOT NULL,
  `sku` varchar(250) NOT NULL,
  `fournisseur` varchar(250) NOT NULL,
  `conditionnement` varchar(100) NOT NULL,
  PRIMARY KEY (`id_article`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `titre_article`, `presentation_article`, `description_article`, `prix_article`, `image_article`, `sku`, `fournisseur`, `conditionnement`) VALUES
(1, 'toto', 'toto', 'toto', 2, 'lol', 'lol', 'lol', ''),
(2, 'kopi luwak', 'Célèbre café traditionnel d \'indonésie au arôme innimitable considérer comme l\'un des meilleur du monde.', 'Le kopi luwak est un café récolté dans les excréments d\'une civette asiatique, le luwak. Du fait d\'une digestion quasi absente et d\'une nourriture variés les civettes contribue au gout unique de se café tant renommé.', 17, '', '100', 'KSU Rahmat Kinara', 'Sachet de 50g'),
(3, 'Blue Mountain', 'Café de jamaique récolté à 2000 mètre d\'altitude dans le massif montagneux de Blue Montains', 'Les experts s’accordent pour reconnaître la qualité supérieure du célèbre cru Blue Mountain. Ses caractéristiques exceptionnelles laissent transparaître des tonalités de goût remarquables qui ne passent pas inaperçues même dans le rang des amateurs de café.', 33, '', '250', 'Domaine Clifton Mount', 'Sachet 300g');

-- --------------------------------------------------------

--
-- Structure de la table `articles_categories_filtre`
--

DROP TABLE IF EXISTS `articles_categories_filtre`;
CREATE TABLE IF NOT EXISTS `articles_categories_filtre` (
  `fk_id_article` int NOT NULL,
  `fk_id_cat_categorie` int NOT NULL,
  `id_parent` int NOT NULL,
  KEY `fk_id_article` (`fk_id_article`),
  KEY `fk_id_cat_categorie` (`fk_id_cat_categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles_tags`
--

DROP TABLE IF EXISTS `articles_tags`;
CREATE TABLE IF NOT EXISTS `articles_tags` (
  `fk_id_tag` int NOT NULL AUTO_INCREMENT,
  `fk_id_article` int NOT NULL,
  PRIMARY KEY (`fk_id_tag`),
  KEY `fk_id_article` (`fk_id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(250) NOT NULL,
  `section` varchar(250) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`, `section`) VALUES
(1, 'Grain', 'PRINCIPALE'),
(2, 'Moulu', 'PRINCIPALE'),
(3, 'Dosette', 'PRINCIPALE'),
(4, '1', 'FORCE'),
(5, '2', 'FORCE'),
(6, '3', 'FORCE'),
(7, '4', 'FORCE'),
(8, '5', 'FORCE'),
(9, 'Acidulé', 'SAVEUR'),
(10, 'Jamaïque', 'PROVENENCE'),
(11, 'Indonesie', 'PROVENENCE'),
(12, 'Arabica', 'VARIÉTÉ'),
(13, 'Robusta', 'VARIÉTÉ'),
(14, 'Fleurie', 'SAVEUR'),
(15, 'Rond', 'SAVEUR'),
(16, 'Equilibré', 'SAVEUR'),
(17, 'Chocolat', 'SAVEUR'),
(18, 'Biologique', 'SPÉCIFICITÉ'),
(19, 'Décaféiné ', 'SPÉCIFICITÉ'),
(20, 'Caramelisé', 'SAVEUR'),
(22, 'Sumatra', 'PROVENENCE'),
(26, 'Réunion', 'PROVENENCE');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `etat_commande` varchar(250) NOT NULL,
  `prix_commande` int NOT NULL,
  `num_commande` int NOT NULL,
  `prix_total` int NOT NULL,
  `date_commande` date NOT NULL,
  `fk_id_utilisateur` int NOT NULL,
  `fk_id_article` int NOT NULL,
  `nb_article` int NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `fk_id_utilisateur` (`fk_id_utilisateur`),
  KEY `fk_id_article` (`fk_id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(250) NOT NULL,
  `fk_id_utilisateur` int NOT NULL,
  `fk_id_article` int NOT NULL,
  PRIMARY KEY (`id_commentaire`),
  KEY `fk_id_utilisateur` (`fk_id_utilisateur`),
  KEY `fk_id_article` (`fk_id_article`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int NOT NULL AUTO_INCREMENT,
  `nom_tag` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `email`, `prenom`, `nom`, `password`, `role`) VALUES
(1, 'thomas@gmail.com', 'thom', 'dodo', 'test', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_articles_like`
--

DROP TABLE IF EXISTS `utilisateurs_articles_like`;
CREATE TABLE IF NOT EXISTS `utilisateurs_articles_like` (
  `id_like` int NOT NULL AUTO_INCREMENT,
  `fk_id_article` int NOT NULL,
  `fk_id_utilisateur` int NOT NULL,
  PRIMARY KEY (`id_like`),
  KEY `fk_id_article` (`fk_id_article`),
  KEY `fk_id_utilisateur` (`fk_id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_ibfk_1` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `articles_categories_filtre`
--
ALTER TABLE `articles_categories_filtre`
  ADD CONSTRAINT `articles_categories_filtre_ibfk_1` FOREIGN KEY (`fk_id_article`) REFERENCES `articles` (`id_article`),
  ADD CONSTRAINT `articles_categories_filtre_ibfk_2` FOREIGN KEY (`fk_id_cat_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `articles_tags`
--
ALTER TABLE `articles_tags`
  ADD CONSTRAINT `articles_tags_ibfk_1` FOREIGN KEY (`fk_id_article`) REFERENCES `articles` (`id_article`),
  ADD CONSTRAINT `articles_tags_ibfk_2` FOREIGN KEY (`fk_id_tag`) REFERENCES `tag` (`id_tag`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `commandes_ibfk_2` FOREIGN KEY (`fk_id_article`) REFERENCES `articles` (`id_article`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`fk_id_article`) REFERENCES `articles` (`id_article`);

--
-- Contraintes pour la table `utilisateurs_articles_like`
--
ALTER TABLE `utilisateurs_articles_like`
  ADD CONSTRAINT `utilisateurs_articles_like_ibfk_1` FOREIGN KEY (`fk_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
