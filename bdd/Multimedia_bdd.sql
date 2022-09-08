-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 20 sep. 2021 à 09:37
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `multimedia`
--
CREATE DATABASE IF NOT EXISTS `multimedia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `multimedia`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `texte` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_membre` (`id_membre`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_membre`, `id_produit`, `texte`, `date`) VALUES
(1, 1, 40, 'test\r\ntest\r\ntest', '2021-09-20 09:24:19'),
(2, 1, 40, 'test\r\ntest\r\ntest', '2021-09-21 09:24:19'),
(3, 1, 40, 'test\r\ntest\r\ntest', '2021-09-19 09:24:47'),
(4, 1, 40, 'test\r\ntest\r\ntest', '2021-09-08 09:24:47'),
(5, 1, 40, 'test 1', '2021-09-20 10:34:20'),
(6, 1, 40, 'test 1', '2021-09-20 10:34:34'),
(7, 1, 40, 'test 23', '2021-09-20 10:34:49');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `mdp`, `mail`, `image`, `level`) VALUES
(1, 'Jordan', '$2y$10$BOJDtNK050TeUaYbXoMivO1GYfPIwVzieR/7axzKfwN2zBUWag5Hi', 'berti@epse.be', NULL, 'administrateur'),
(2, 'epse1', '$2y$10$fQl9DB/Cxh0ohqS43aRVM.OlR7qvFCdn8K9CRebfMjLO9VjMWAjfq', 'berti@epse.be', NULL, 'membre'),
(4, 'Admin', '$2y$10$sedJs3HGZ1GOu5vA7QTlTev76Ku2Bc5xrVlJmHzxm9uK5QjkzXajC', 'berti@epse.be', NULL, 'membre'),
(5, 'mytest', '$2y$10$XFBzUDBMi25uLlC1X331EOiPd1dSSrwrI6.7W8ZgDRtTZjUpWdWfa', 'mytest@epse.be', NULL, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(60) NOT NULL,
  `marque` varchar(60) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `prix`, `description`, `type`, `marque`, `image`) VALUES
(25, 'Galaxy S10', '699.00', 'Faites connaissance avec le nouveau venu dans la famille Galaxy : le Samsung Galaxy S10 ! Au rayon des atouts ? Un superbe écran qui offre des images exceptionnelles, une grande capacité de stockage ou encore une très longue autonomie de batterie. ', 'Smartphone', 'Samsung', '1821646589galaxyS10.jpg'),
(26, 'Iphone 4S', '80.00', 'Le dernier Iphone de la marque Apple dont Steve Jobs a participé comme concepteur.', 'Smartphone', 'Apple', '1051158939iphone4s.jpg'),
(27, 'Iphone 6s', '160.00', 'description', 'Smartphone', 'Apple', '1085771687iphone6s.jpg'),
(29, 'Iphone Xs', '920.00', 'L’iPhone XS détient un écran Super Retina de 5,8 pouces et l’iPhone XS Max un écran de 6,5 pouces avec des panneaux OLED créés spécialement, pour un affichage HDR offrant des couleurs d’une qualité supérieure. La technologie Face ID avancée vous permet de déverrouiller votre téléphone portable, de vous connecter à des apps et de régler vos achats instantanément.', 'Smartphone', 'Apple', '652142162iphonexs.jpeg'),
(30, 'Galaxy S7', '200.00', 'description', 'Smartphone', 'Samsung', '1220640304samsungs7.jpg'),
(31, 'Mate 20 pro', '650.00', 'description', 'Smartphone', 'Huawei', '836518146mate20pro.jpg'),
(32, '7 pro', '750.00', 'description', 'Smartphone', 'One plus', '1100495064oneplus.jpg'),
(33, 'Fifa 20', '60.00', 'description', 'Jeux vidéo', 'PS4', '1558637456fifa20.jpg'),
(38, 'Anno 1800', '45.00', 'description', 'Jeux vidéo', 'PC', '1422647385anno1800.jpg'),
(39, 'Borderlands 3', '48.00', 'description', 'Jeux vidéo', 'PC', '1292647089borderlands3.jpg'),
(40, 'Cyberpunk 2077', '49.00', 'Description', 'Jeux vidéo', 'PC', '1429033006cyberpunk-2077-cover.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
