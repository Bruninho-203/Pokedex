-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Jeu 19 Février 2015 à 11:26
-- Version du serveur: 5.6.11-log
-- Version de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pokedex`
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
(28, 1),
(29, 1),
(1, 2),
(5, 2),
(9, 2),
(2, 3),
(22, 3),
(23, 3),
(3, 4),
(19, 4),
(20, 4),
(4, 5),
(24, 5),
(25, 5),
(10, 6),
(33, 6),
(34, 6),
(6, 7),
(26, 7),
(27, 7),
(8, 8),
(21, 8),
(30, 8),
(31, 8),
(32, 8),
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

--
-- Contenu de la table `caracteristique`
--

INSERT INTO `caracteristique` (`PV`, `Attaque`, `Defense`, `Attaque special`, `Defense special`, `Vitesse`, `idPokemon`) VALUES
(39, 52, 43, 60, 50, 65, 1),
(44, 48, 65, 50, 64, 43, 2),
(45, 49, 49, 65, 65, 45, 3),
(35, 55, 30, 50, 40, 90, 4),
(78, 84, 78, 109, 85, 100, 5),
(50, 120, 53, 35, 110, 87, 6),
(160, 110, 65, 65, 110, 30, 7),
(100, 100, 100, 100, 100, 100, 8),
(58, 64, 58, 80, 65, 80, 9),
(61, 84, 65, 70, 70, 70, 10),
(95, 65, 110, 60, 130, 65, 16),
(75, 90, 50, 110, 80, 95, 17),
(65, 130, 60, 75, 60, 75, 18),
(60, 62, 63, 80, 80, 60, 19),
(80, 82, 83, 100, 100, 80, 20),
(106, 110, 90, 154, 90, 130, 21),
(59, 63, 80, 65, 80, 58, 22),
(79, 83, 100, 85, 105, 78, 23),
(20, 40, 15, 35, 35, 60, 24),
(60, 90, 55, 90, 80, 100, 25),
(40, 80, 35, 35, 45, 70, 26),
(65, 105, 60, 60, 70, 95, 27),
(40, 45, 35, 40, 40, 90, 28),
(65, 70, 60, 65, 65, 115, 29),
(25, 20, 15, 105, 55, 90, 30),
(40, 35, 30, 120, 70, 105, 31),
(55, 50, 45, 135, 85, 120, 32),
(41, 64, 45, 50, 50, 50, 33),
(91, 134, 95, 100, 100, 80, 34);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

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
(18, 'Absol', 'img/pokemon/Absol.png', 1.2, 47),
(19, 'Herbizarre', 'img/pokemon/Herbizarre.png', 1, 13),
(20, 'Florizarre', 'img/pokemon/Florizarre.png', 2, 100),
(21, 'Mewtwo', 'img/pokemon/Mewtwo.png', 2, 122),
(22, 'Carabaffe', 'img/pokemon/Carabaffe.png', 1, 22.5),
(23, 'Tortank', 'img/pokemon/Tortank.png', 1.6, 85.5),
(24, 'Pichu', 'img/pokemon/Pichu.png', 0.3, 2),
(25, 'Raichu', 'img/pokemon/Raichu.png', 0.8, 30),
(26, 'Ferosinge', 'img/pokemon/Ferosinge.png', 0.5, 28),
(27, 'Colossinge', 'img/pokemon/Colossinge.png', 1, 32),
(28, 'Miaouss', 'img/pokemon/Miaouss.png', 0.4, 4.2),
(29, 'Persian', 'img/pokemon/Persian.png', 1, 32),
(30, 'Abra', 'img/pokemon/Abra.png', 0.9, 19.5),
(31, 'Kadabra', 'img/pokemon/Kadabra.png', 1.3, 56.5),
(32, 'Alakazam', 'img/pokemon/Alakazam.png', 1.3, 56.5),
(33, 'Minidraco', 'img/pokemon/Minidraco.png', 1.8, 3.3),
(34, 'Dracolosse', 'img/pokemon/Dracolosse.png', 2.2, 210);

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
