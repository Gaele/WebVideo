CREATE TABLE IF NOT EXISTS `clients` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudonyme` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `motDePasse` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `montantCharge` int(11) COLLATE latin1_general_ci NOT NULL,
  `numeroCarteBanquaire` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `cleCarteBancaire` int(11) COLLATE latin1_general_ci NOT NULL,
  `mail` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nomDuTitulaire` varchar(50) COLLATE latin1_general_ci NOT NULL,
  nomDuTitulaire
  `contenu` text COLLATE latin1_general_ci NOT NULL,
  `dateAjout` datetime NOT NULL,
  `dateModif` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;
