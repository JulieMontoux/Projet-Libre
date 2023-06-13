-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 13 juin 2023 à 11:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vente`
--

-- --------------------------------------------------------

--
-- Structure de la table `poids`
--

DROP TABLE IF EXISTS `poids`;
CREATE TABLE IF NOT EXISTS `poids` (
  `idPoids` int NOT NULL,
  `kg` int NOT NULL,
  PRIMARY KEY (`idPoids`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prix`
--

DROP TABLE IF EXISTS `prix`;
CREATE TABLE IF NOT EXISTS `prix` (
  `idPrix` int NOT NULL,
  `montant` float NOT NULL,
  PRIMARY KEY (`idPrix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_idVariete` int NOT NULL,
  `id_idPoids` int NOT NULL,
  `id_idQuantite` int NOT NULL,
  `id_idPrix` int NOT NULL,
  PRIMARY KEY (`id_idVariete`,`id_idPoids`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
CREATE TABLE IF NOT EXISTS `quantite` (
  `idQuantite` int NOT NULL,
  `nombre` int NOT NULL,
  PRIMARY KEY (`idQuantite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `idType` int NOT NULL,
  `nomT` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `variete`
--

DROP TABLE IF EXISTS `variete`;
CREATE TABLE IF NOT EXISTS `variete` (
  `idVariete` int NOT NULL,
  `nomV` varchar(50) NOT NULL,
  `idType_id` int NOT NULL,
  PRIMARY KEY (`idVariete`)
  FOREIGN KEY (idType_id) REFERENCES Type(idType)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
