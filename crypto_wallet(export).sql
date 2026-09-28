-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 25 sep. 2026 à 08:32
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `crypto_wallet`
--

-- --------------------------------------------------------

--
-- Structure de la table `cryptomonnaie`
--

DROP TABLE IF EXISTS `cryptomonnaie`;
CREATE TABLE IF NOT EXISTS `cryptomonnaie` (
  `id_cryptomonnaie` int NOT NULL AUTO_INCREMENT,
  `id_niveau_risque` int NOT NULL,
  `id_reseau` int NOT NULL,
  `nom_crypto` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbole_crypto` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `qntte_jetons` decimal(10,6) NOT NULL,
  `date_achat` datetime NOT NULL,
  `note` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_cryptomonnaie`),
  UNIQUE KEY `nom_crypto` (`nom_crypto`),
  UNIQUE KEY `symbole_crypto` (`symbole_crypto`),
  KEY `id_niveau_risque` (`id_niveau_risque`),
  KEY `id_reseau` (`id_reseau`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cryptomonnaie`
--

INSERT INTO `cryptomonnaie` (`id_cryptomonnaie`, `id_niveau_risque`, `id_reseau`, `nom_crypto`, `symbole_crypto`, `prix`, `qntte_jetons`, `date_achat`, `note`) VALUES
(1, 2, 1, 'Bitcoin', 'BTC', 52000.00, 0.125000, '2026-01-10 10:30:00', 'Actif principal du portefeuille'),
(2, 2, 2, 'Ethereum', 'ETH', 2800.00, 1.750000, '2026-01-15 14:20:00', 'Utilise pour les applications decentralisees'),
(3, 3, 3, 'BNB', 'BNB', 450.00, 4.200000, '2026-02-03 09:15:00', 'Jeton de l ecosysteme Binance'),
(4, 3, 4, 'Solana', 'SOL', 120.00, 15.500000, '2026-02-18 16:45:00', 'Blockchain rapide et peu couteuse'),
(5, 3, 5, 'XRP', 'XRP', 0.65, 2500.000000, '2026-03-02 11:10:00', 'Projet oriente vers les paiements'),
(6, 3, 6, 'Cardano', 'ADA', 0.48, 3200.000000, '2026-03-20 13:35:00', 'Projet fonde sur la recherche academique'),
(7, 3, 4, 'Dogecoin', 'DOGE', 0.14, 5000.000000, '2026-04-05 18:00:00', 'Cryptomonnaie communautaire'),
(8, 2, 7, 'Avalanche', 'AVAX', 38.00, 35.000000, '2026-04-22 08:40:00', 'Plateforme de contrats intelligents'),
(9, 3, 8, 'Polkadot', 'DOT', 7.20, 180.000000, '2026-05-11 12:25:00', 'Reseau multichaines interoperable'),
(10, 1, 2, 'USD Coin', 'USDC', 1.00, 1500.000000, '2026-05-30 15:50:00', 'Stablecoin indexe sur le dollar americain');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_risque`
--

DROP TABLE IF EXISTS `niveau_risque`;
CREATE TABLE IF NOT EXISTS `niveau_risque` (
  `id_niveau_risque` int NOT NULL AUTO_INCREMENT,
  `risque` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_niveau_risque`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `niveau_risque`
--

INSERT INTO `niveau_risque` (`id_niveau_risque`, `risque`) VALUES
(1, 'Faible'),
(2, 'Moyen'),
(3, 'Eleve');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `id_notification` int NOT NULL AUTO_INCREMENT,
  `type_notification` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notification`, `type_notification`) VALUES
(1, 'Alerte de hausse de prix'),
(2, 'Alerte de baisse de prix'),
(3, 'Objectif de prix atteint'),
(4, 'Variation importante sur 24 heures'),
(5, 'Rappel de suivi du portefeuille');

-- --------------------------------------------------------

--
-- Structure de la table `notification_crypto`
--

DROP TABLE IF EXISTS `notification_crypto`;
CREATE TABLE IF NOT EXISTS `notification_crypto` (
  `id_cryptomonnaie` int NOT NULL,
  `id_notification` int NOT NULL,
  PRIMARY KEY (`id_cryptomonnaie`,`id_notification`),
  KEY `id_notification` (`id_notification`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notification_crypto`
--

INSERT INTO `notification_crypto` (`id_cryptomonnaie`, `id_notification`) VALUES
(1, 1),
(1, 3),
(2, 1),
(2, 2),
(3, 4),
(4, 1),
(4, 4),
(5, 2),
(6, 3),
(7, 4),
(8, 2),
(8, 5),
(9, 1),
(10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reseau`
--

DROP TABLE IF EXISTS `reseau`;
CREATE TABLE IF NOT EXISTS `reseau` (
  `id_reseau` int NOT NULL AUTO_INCREMENT,
  `nom_blockchain` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_reseau`),
  UNIQUE KEY `nom_blockchain` (`nom_blockchain`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reseau`
--

INSERT INTO `reseau` (`id_reseau`, `nom_blockchain`) VALUES
(1, 'Bitcoin'),
(2, 'Ethereum'),
(3, 'BNB Smart Chain'),
(4, 'Solana'),
(5, 'XRP Ledger'),
(6, 'Cardano'),
(7, 'Avalanche'),
(8, 'Polkadot');

-- --------------------------------------------------------

--
-- Structure de la table `strategies`
--

DROP TABLE IF EXISTS `strategies`;
CREATE TABLE IF NOT EXISTS `strategies` (
  `id_strategies` int NOT NULL AUTO_INCREMENT,
  `nom_strategies` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_strategies`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `strategies`
--

INSERT INTO `strategies` (`id_strategies`, `nom_strategies`) VALUES
(1, 'Conservation a long terme'),
(2, 'Achat periodique'),
(3, 'Trading a court terme'),
(4, 'Staking'),
(5, 'Diversification');

-- --------------------------------------------------------

--
-- Structure de la table `strategies_crypto`
--

DROP TABLE IF EXISTS `strategies_crypto`;
CREATE TABLE IF NOT EXISTS `strategies_crypto` (
  `id_cryptomonnaie` int NOT NULL,
  `id_strategies` int NOT NULL,
  PRIMARY KEY (`id_cryptomonnaie`,`id_strategies`),
  KEY `id_strategies` (`id_strategies`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `strategies_crypto`
--

INSERT INTO `strategies_crypto` (`id_cryptomonnaie`, `id_strategies`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 4),
(3, 3),
(3, 5),
(4, 2),
(4, 4),
(5, 3),
(6, 2),
(6, 4),
(7, 3),
(8, 1),
(8, 4),
(9, 1),
(9, 5),
(10, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
