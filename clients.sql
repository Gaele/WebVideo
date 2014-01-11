CREATE TABLE IF NOT EXISTS `louer` (
  `idClient` smallint(5) unsigned NOT NULL,
  `idFilm` smallint(5) unsigned NOT NULL,
  `dateFin` datetime NOT NULL
) DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ;
