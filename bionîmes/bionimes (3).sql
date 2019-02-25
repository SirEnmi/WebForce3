-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 18 avr. 2018 à 17:19
-- Version du serveur :  10.1.31-MariaDB
-- Version de PHP :  7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bionimes`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `idArticle` int(11) NOT NULL,
  `libelle` varchar(30) NOT NULL,
  `prix` decimal(5,2) NOT NULL,
  `conditionnement` varchar(10) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `description` text,
  `photo` varchar(40) DEFAULT NULL,
  `idProducteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des articles';

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`idArticle`, `libelle`, `prix`, `conditionnement`, `idCategorie`, `description`, `photo`, `idProducteur`) VALUES
(1, 'Cerise', '3.50', 'Kg', 1, 'Des cerises toutes fraîches !', 'cerise.jpg', 1),
(2, 'Patate', '1.40', 'Kg', 2, 'Des pommes de terre sans terre !', 'patate.jpg', 1),
(3, 'Salade', '0.60', 'Piece', 2, 'Aussi verte qu\'une rainette !', 'salade.jpg', 1),
(4, 'Pêche', '1.60', 'Kg', 1, 'Pour garder la peche !', 'peche.jpg', 1),
(5, 'Poire', '1.45', 'Kg', 1, 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même.', 'poire.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `libCategorie` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='categories de produits';

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `libCategorie`) VALUES
(1, 'Fruits'),
(2, 'Legumes'),
(3, 'Gateaux'),
(4, 'Apéritif'),
(5, '100% BIO'),
(6, 'Vin');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `idClient` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(62) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `consentement` varchar(1) DEFAULT '0' COMMENT '0: non, 1: oui',
  `role` varchar(1) DEFAULT '0' COMMENT '0: user, 1: admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des clients';

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`idClient`, `nom`, `prenom`, `email`, `password`, `tel`, `adresse`, `cp`, `ville`, `token`, `consentement`, `role`) VALUES
(2, 'Barbieri', 'Mickael', 'nonnon@non.fr', '$2y$10$0FgZoCDjqG7Sb3KomdwdaO7AuhC8.qZqa2DDYAtMHW.dGwV/6UES.', '0606060606', 'Rue du Dessert', '30000', 'Nimes', NULL, '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `detfactures`
--

CREATE TABLE `detfactures` (
  `idFacture` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='detail des factures';

--
-- Déchargement des données de la table `detfactures`
--

INSERT INTO `detfactures` (`idFacture`, `idArticle`, `quantite`) VALUES
(5, 1, 2),
(6, 1, 2),
(7, 1, 2),
(8, 1, 2),
(9, 1, 2),
(10, 4, 2),
(11, 1, 50),
(12, 4, 73),
(12, 5, 25),
(12, 3, 34),
(13, 3, 1),
(14, 1, 1),
(15, 1, 2),
(16, 5, 2),
(17, 4, 2),
(18, 4, 9),
(19, 1, 2),
(20, 4, 12),
(21, 4, 1),
(22, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `idFacture` int(11) NOT NULL,
  `idclient` int(11) NOT NULL,
  `dateFacture` datetime NOT NULL,
  `montant` decimal(6,2) NOT NULL,
  `idReglement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Entetes de factures';

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`idFacture`, `idclient`, `dateFacture`, `montant`, `idReglement`) VALUES
(1, 2, '2018-04-17 14:25:47', '9.00', 1),
(2, 2, '2018-04-17 14:26:25', '9.00', 1),
(3, 2, '2018-04-17 14:55:07', '9.00', 1),
(4, 2, '2018-04-17 14:57:39', '9.00', 1),
(5, 2, '2018-04-17 14:58:20', '9.00', 1),
(6, 2, '2018-04-17 15:15:28', '9.00', 1),
(7, 2, '2018-04-17 15:15:32', '9.00', 1),
(8, 2, '2018-04-17 15:17:04', '9.00', 1),
(9, 2, '2018-04-17 15:18:12', '9.00', 1),
(10, 2, '2018-04-17 15:18:44', '3.20', 1),
(11, 2, '2018-04-17 15:19:59', '225.00', 1),
(12, 2, '2018-04-17 15:20:30', '173.45', 1),
(13, 2, '2018-04-17 15:20:56', '0.60', 1),
(14, 2, '2018-04-17 15:35:52', '4.50', 1),
(15, 2, '2018-04-17 15:36:06', '9.00', 1),
(16, 2, '2018-04-17 15:40:53', '2.90', 1),
(17, 2, '2018-04-17 15:44:43', '3.20', 1),
(18, 2, '2018-04-17 15:50:33', '14.40', 1),
(19, 2, '2018-04-17 15:51:10', '9.00', 1),
(20, 2, '2018-04-17 15:51:49', '19.20', 1),
(21, 2, '2018-04-17 15:53:33', '1.60', 1),
(22, 2, '2018-04-17 15:54:27', '1.60', 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='panier des clients';

-- --------------------------------------------------------

--
-- Structure de la table `producteurs`
--

CREATE TABLE `producteurs` (
  `idproducteur` int(11) NOT NULL,
  `RS` varchar(50) DEFAULT NULL,
  `SIRET` varchar(15) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des producteurs';

--
-- Déchargement des données de la table `producteurs`
--

INSERT INTO `producteurs` (`idproducteur`, `RS`, `SIRET`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `pays`, `email`, `tel`) VALUES
(1, 'LeBonPrimeur', '1234567890', 'Michel', 'Jean', 'Rue du Dessert', '30000', 'Nimes', 'France', 'Michel@jean.fr', '0466676869');

-- --------------------------------------------------------

--
-- Structure de la table `reglements`
--

CREATE TABLE `reglements` (
  `idReglement` int(11) NOT NULL,
  `libReglement` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Modes de règlements';

--
-- Déchargement des données de la table `reglements`
--

INSERT INTO `reglements` (`idReglement`, `libReglement`) VALUES
(1, 'Cheque'),
(2, 'CB'),
(3, 'BitCoin'),
(4, 'PayPal'),
(5, 'Espece');

-- --------------------------------------------------------

--
-- Structure de la table `stocks`
--

CREATE TABLE `stocks` (
  `idArticle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='stocks';

--
-- Déchargement des données de la table `stocks`
--

INSERT INTO `stocks` (`idArticle`, `quantite`) VALUES
(1, 0),
(2, 45),
(3, 100),
(4, 75),
(5, 20);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idCategorie` (`idCategorie`),
  ADD KEY `idProducteur` (`idProducteur`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `detfactures`
--
ALTER TABLE `detfactures`
  ADD KEY `idFacture` (`idFacture`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`idFacture`),
  ADD KEY `idClient` (`idclient`),
  ADD KEY `idReglement` (`idReglement`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `idArticle` (`idArticle`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `producteurs`
--
ALTER TABLE `producteurs`
  ADD PRIMARY KEY (`idproducteur`);

--
-- Index pour la table `reglements`
--
ALTER TABLE `reglements`
  ADD PRIMARY KEY (`idReglement`);

--
-- Index pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`idArticle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `producteurs`
--
ALTER TABLE `producteurs`
  MODIFY `idproducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `reglements`
--
ALTER TABLE `reglements`
  MODIFY `idReglement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`idProducteur`) REFERENCES `producteurs` (`idproducteur`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`idCategorie`) REFERENCES `categories` (`idCategorie`);

--
-- Contraintes pour la table `detfactures`
--
ALTER TABLE `detfactures`
  ADD CONSTRAINT `detfactures_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`),
  ADD CONSTRAINT `detfactures_ibfk_2` FOREIGN KEY (`idFacture`) REFERENCES `factures` (`idFacture`);

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_ibfk_1` FOREIGN KEY (`idReglement`) REFERENCES `reglements` (`idReglement`),
  ADD CONSTRAINT `factures_ibfk_2` FOREIGN KEY (`idclient`) REFERENCES `clients` (`idClient`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `clients` (`idClient`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`);

--
-- Contraintes pour la table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `articles` (`idArticle`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
