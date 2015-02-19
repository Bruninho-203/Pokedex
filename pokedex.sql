-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 19 Février 2015 à 10:15
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pokedex`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE IF NOT EXISTS `appartenir` (
  `idPokemon` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  PRIMARY KEY (`idPokemon`,`idType`),
  KEY `FK_APPARTENIR_idType` (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `appartenir`
--

INSERT INTO `appartenir` (`idPokemon`, `idType`) VALUES
(7, 1),
(1, 2),
(5, 2),
(9, 2),
(2, 3),
(3, 4),
(4, 5),
(10, 6),
(6, 7),
(8, 8),
(16, 9),
(17, 9),
(18, 9);

-- --------------------------------------------------------

--
-- Structure de la table `caracteristique`
--

CREATE TABLE IF NOT EXISTS `caracteristique` (
  `PV` int(3) NOT NULL,
  `Attaque` int(3) NOT NULL,
  `Defense` int(3) NOT NULL,
  `Attaque special` int(3) NOT NULL,
  `Defense special` int(3) NOT NULL,
  `Vitesse` int(3) NOT NULL,
  `idPokemon` int(10) NOT NULL,
  PRIMARY KEY (`idPokemon`),
  KEY `idPokemon` (`idPokemon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pokemon`
--

CREATE TABLE IF NOT EXISTS `pokemon` (
  `idPokemon` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(35) NOT NULL,
  `cheminImage` varchar(50) DEFAULT NULL,
  `Taille` double NOT NULL,
  `Poids` double NOT NULL,
  PRIMARY KEY (`idPokemon`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `pokemon`
--

INSERT INTO `pokemon` (`idPokemon`, `Nom`, `cheminImage`, `Taille`, `Poids`) VALUES
(1, 'Salameche', 'img/pokemon/Salameche.png', 0.6, 8.5),
(2, 'Carapuce', 'img/pokemon/Carapuce.png', 0.5, 9),
(3, 'Bulbizarre', 'img/pokemon/Bulbizarre.png', 0.7, 6.9),
(4, 'Pikachu', 'img/pokemon/Pikachu.png', 0.4, 6),
(5, 'Dracaufeu', 'img/pokemon/Dracaufeu.png', 1.7, 90.5),
(6, 'Kicklee', 'img/pokemon/Kicklee.png', 1.5, 49.8),
(7, 'Ronflex', 'img/pokemon/Ronflex.png', 2.1, 460),
(8, 'Mew', 'img/pokemon/Mew.png', 0.4, 4),
(9, 'Reptincel', 'img/pokemon/Reptincel.png', 1.1, 19),
(10, 'Draco', 'img/pokemon/Draco.png', 4, 16.5),
(16, 'Noctali', 'img/pokemon/Noctali.png', 1, 27),
(17, 'Demolosse', 'img/pokemon/Demolosse.png', 1.4, 35),
(18, 'Absol', 'img/pokemon/Absol.png', 1.2, 47);

-- --------------------------------------------------------

--
-- Structure de la table `rangs`
--

CREATE TABLE IF NOT EXISTS `rangs` (
  `idRang` int(11) NOT NULL AUTO_INCREMENT,
  `NomRang` varchar(25) NOT NULL,
  PRIMARY KEY (`idRang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `rangs`
--

INSERT INTO `rangs` (`idRang`, `NomRang`) VALUES
(1, 'Connecté'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `NomType` varchar(25) NOT NULL,
  `cheminImage` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`idType`, `NomType`, `cheminImage`) VALUES
(1, 'Normal', 'img/categorie/normal.png'),
(2, 'Feu', 'img/categorie/feu.png'),
(3, 'Eau', 'img/categorie/eau.png'),
(4, 'Plante', 'img/categorie/plante.png'),
(5, 'Electrique', 'img/categorie/electrique.png'),
(6, 'Dragon', 'img/categorie/dragon.png'),
(7, 'Combat', 'img/categorie/combat.png'),
(8, 'Psy', 'img/categorie/psy.png'),
(9, 'Tenebre', 'img/categorie/tenebre.png');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Pseudo` varchar(25) NOT NULL,
  `Mdp` varchar(30) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `idRang` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  KEY `idRang` (`idRang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idUtilisateur`, `Nom`, `Prenom`, `Pseudo`, `Mdp`, `Email`, `idRang`) VALUES
(1, 'truck', 'truck', 'truck', 'Super', 'truck@orange.fr', 1),
(2, 'Administrateur', 'Admin', 'Admin', 'Super', 'admin@gmail.com', 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD CONSTRAINT `FK_APPARTENIR_idPokemon` FOREIGN KEY (`idPokemon`) REFERENCES `pokemon` (`idPokemon`),
  ADD CONSTRAINT `FK_APPARTENIR_idType` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`);

--
-- Contraintes pour la table `caracteristique`
--
ALTER TABLE `caracteristique`
  ADD CONSTRAINT `caracteristique_ibfk_1` FOREIGN KEY (`idPokemon`) REFERENCES `pokemon` (`idPokemon`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`idRang`) REFERENCES `rangs` (`idRang`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
