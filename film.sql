CREATE TABLE IF NOT EXISTS `film` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `genre` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `acteurs` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `realisateurs` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `langue` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `duree` int(50) COLLATE latin1_general_ci NOT NULL,
  `dateDeSortie` datetime NOT NULL,
  `prixLocation` int(50) COLLATE latin1_general_ci NOT NULL,
  `prixAchat` int(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;
