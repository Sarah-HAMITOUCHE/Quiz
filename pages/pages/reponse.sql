-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 fév. 2025 à 13:44
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz_night`
--

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `option_id` int NOT NULL,
  `texte_reponse` varchar(255) NOT NULL,
  `est_correcte` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `question_id`, `option_id`, `texte_reponse`, `est_correcte`) VALUES
(1, 1, 1, 'Windows', 1),
(2, 1, 2, 'Linux', 0),
(3, 1, 3, 'MacOS', 0),
(4, 1, 4, 'Android', 0),
(5, 2, 1, 'JavaScript', 1),
(6, 2, 2, 'C++', 0),
(7, 2, 3, 'Java', 0),
(8, 2, 4, 'PHP', 0),
(9, 3, 1, 'SQL', 1),
(10, 3, 2, 'PHP', 0),
(11, 3, 3, 'Python', 0),
(12, 3, 4, 'C#', 0),
(13, 4, 1, 'Python', 1),
(14, 4, 2, 'C++', 0),
(15, 4, 3, 'Java', 0),
(16, 4, 4, 'PHP', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
