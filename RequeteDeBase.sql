-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 10 Janvier 2014 à 23:15
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `news`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudonyme` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `motDePasse` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `montantCharge` int(11) NOT NULL,
  `numeroCarteBanquaire` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `cleCarteBancaire` int(11) NOT NULL,
  `mail` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nomDuTitulaire` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `dateInscription` datetime NOT NULL,
  `dateExpiration` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudonyme` (`pseudonyme`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`id`, `pseudonyme`, `motDePasse`, `montantCharge`, `numeroCarteBanquaire`, `cleCarteBancaire`, `mail`, `nomDuTitulaire`, `dateInscription`, `dateExpiration`) VALUES
(1, 'vincent', 'vanhecke', 2587, '2587', 123, 'vincent.vanheck@gmail.com', 'vincent', '2014-01-10 07:22:36', '2014-01-24 00:00:00'),
(2, 'Benji', 'tari', 856, '856', 234, 'benji.tari@gmail.com', 'benji', '2014-01-10 10:54:53', '2014-01-31 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `news` smallint(6) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `news`, `auteur`, `contenu`, `date`) VALUES
(1, 2, 'Vincent', 'Mon Premier commentaire', '2014-01-07 01:27:55'),
(2, 2, 'Bertrand', 'Un second !', '2014-01-07 01:29:10');

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `genre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `acteurs` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `realisateurs` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `langue` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `duree` int(50) NOT NULL,
  `dateDeSortie` datetime NOT NULL,
  `prixLocation` int(50) NOT NULL,
  `prixAchat` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`id`, `titre`, `description`, `genre`, `acteurs`, `realisateurs`, `langue`, `duree`, `dateDeSortie`, `prixLocation`, `prixAchat`) VALUES
(1, 'Quebec Original Hiver', 'Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit, sic in amicum sit animatus. Quam multa enim, quae nostra causa numquam faceremus, facimus causa amicorum! precari ab indigno, supplicare, tum acerbius in aliquem invehi insectarique vehementius, quae in nostris rebus non satis honeste, in amicorum fiunt honestissime; multaeque res sunt in quibus de suis commodis viri boni multa detrahunt detrahique patiuntur, ut iis amici potius quam ipsi fruantur.', 'Action,Cinéma', 'Jean Reve,Paul Apeine', 'Yves Net,Margo Bacc', 'fr', 20, '2010-01-14 00:00:00', 10, 100),
(3, 'Le poisson', 'Le poisson est-il fais pour tout le monde ?', 'Marketing', 'Jean poisson', 'Marmotte Audi', 'de', 5, '2007-01-11 00:00:00', 30, 300);

-- --------------------------------------------------------

--
-- Structure de la table `louer`
--

CREATE TABLE IF NOT EXISTS `louer` (
  `idClient` smallint(5) unsigned NOT NULL,
  `idFilm` smallint(5) unsigned NOT NULL,
  `dateFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `auteur`, `titre`, `contenu`, `dateAjout`, `dateModif`) VALUES
(1, 'VVV', 'MonTitre', 'Le contenu...', '2014-01-05 00:00:00', '2014-01-06 00:00:00'),
(2, 'Korn', 'Wahaha !', 'Si vous aimez mon grand rire maléfique, frappez dans vos mains !\r\n\r\nWahaha, wohoho, wihihi !....', '2014-01-05 00:00:00', '2014-01-06 00:00:00'),
(4, 'Vincent', 'Nouveau top top', 'Que du neuf !\r\nQue du beau !\r\nerastu ist anakel abernae um.\r\nEt une ligne en plus', '2014-01-09 17:24:10', '2014-01-09 17:41:42');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
