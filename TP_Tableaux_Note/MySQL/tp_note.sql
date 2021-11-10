-----------------------------------------------------------------------------------------------------------------------------
DROP TABLE IF EXISTS `table_etudiant`;
CREATE TABLE IF NOT EXISTS `table_etudiant` (
  `id_etudiant` int(10) COLLATE latin1_general_cs NOT NULL,
  `nom_etudiant` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `prenom_etudiant` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `login_etudiant` varchar(25) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_etudiant` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `login_etudiant`) VALUES
(1, 'KUNZ', 'Quentin', 'qkunz'),
(2, 'SCHWARTZ', 'Marine', 'mschwartz'),
(3, 'EITEL', 'Hugo', 'heitel'),
(4, 'BOHNERT', 'Alexandre', 'abohnert');

-----------------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `table_prof`;
CREATE TABLE IF NOT EXISTS `table_prof` (
  `id_prof` int(10) COLLATE latin1_general_cs NOT NULL,
  `nom_prof` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `prenom_prof` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `login_prof` varchar(25) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_prof` (`id_Prof`, `nom_Prof`, `prenom_Prof`, `loginProf`) VALUES
(1, 'MADEMBO', 'Grace', 'gmadembo'),
(2, 'LEHMANN', 'Nicolas', 'nlehmann'),
(3, 'VALENTIN', 'Nicolas', 'nvalentin'),
(4, 'HATTON', 'Jerome', 'jhatton');

-----------------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `table_matiere`;
CREATE TABLE IF NOT EXISTS `table_matiere` (
  `id_matiere` int(10) COLLATE latin1_general_cs NOT NULL,
  `matiere` varchar(25) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_matiere` (`id_matiere`, `matiere`) VALUES
(1, 'Web'),
(2, 'GD'),
(3, 'Algo'),
(4, 'BDD'),
(5, 'C++');

-----------------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `table_enseignement`;
CREATE TABLE IF NOT EXISTS `table_enseignement` (
  `id_prof` int(10) COLLATE latin1_general_cs NOT NULL,
  `id_matiere` int(10) COLLATE latin1_general_cs NOT NULL,
  KEY `enseignement_ibfk_1` (`id_prof`),
  KEY `enseignement_ibfk_2` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_enseignement` (`id_Prof`, `id_matiere`) VALUES
(1, 1),
(2, 5),
(3, 2),
(4, 3),
(1, 4);

-----------------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `table_note`;
CREATE TABLE IF NOT EXISTS `table_note` (
  `id_note` int(10) COLLATE latin1_general_cs NOT NULL,
  `login_etudiant` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `matiere` varchar(25) COLLATE latin1_general_cs NOT NULL,
  `note` int(10) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_note`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_note` (`id_note`, `login_etudiant`, `matiere`, `note`) VALUES
(1, 'qkunz', 'Web', 10),
(2, 'qkunz', 'GD', 16),
(3, 'qkunz', 'Algo', 12),
(4, 'qkunz', 'SQL', 11),
(5, 'qkunz', 'C++', 12,
(6, 'mschwartz', 'Web', 16),
(7, 'mschwartz', 'GD', 15),
(8, 'mschwartz', 'Algo', 18),
(9, 'mschwartz', 'SQL', 12),
(10, 'mschwartz', 'C++', 19),
(11, 'heitel', 'Web', 6),
(12, 'heitel', 'GD', 12),
(13, 'heitel', 'Algo', 15),
(14, 'heitel', 'SQL', 10),
(15, 'heitel', 'C++', 16),
(16, 'abohnert', 'Web', 10),
(17, 'abohnert', 'GD', 11),
(18, 'abohnert', 'Algo', 10),
(19, 'abohnert', 'SQL', 13),
(20, 'abohnert', 'C++', 14);

-----------------------------------------------------------------------------------------------------------------------------

DROP TABLE IF EXISTS `table_utilisateur`;
CREATE TABLE IF NOT EXISTS `table_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `login_utilisateur` varchar(20) COLLATE latin1_general_cs NOT NULL,
  `mdp_utilisateur` varchar(20) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;


INSERT INTO `table_utilisateur` (`id_utilisateur`, `login_utilisateur`, `mdp_utilisateur`) VALUES
(1, 'gmadembo', '1111'),
(2, 'nlehmann', '2222'),
(3, 'nvalentin', '3333'),
(4, 'jhatton', '4444'),
(5, 'qkunz', '5555'),
(6, 'mschwartz', '6666'),
(7, 'heitel', '7777'),
(8, 'abohnert', '8888');

-----------------------------------------------------------------------------------------------------------------------------