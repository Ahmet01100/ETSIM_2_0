-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Client :  db596949605.db.1and1.com
-- Généré le :  Mar 14 Juin 2016 à 16:38
-- Version du serveur :  5.5.49-0+deb7u1-log
-- Version de PHP :  5.4.45-0+deb7u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `db596949605`
--

-- --------------------------------------------------------

--
-- Structure de la table `can_contains`
--

CREATE TABLE IF NOT EXISTS `can_contains` (
  `id_etsim_cc` int(11) NOT NULL AUTO_INCREMENT,
  `id_etsim_plant_game_contains` int(11) NOT NULL,
  `id_etsim_game` int(11) NOT NULL,
  `id_etsim_members` int(11) NOT NULL,
  `id_etsim_round_game` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_etsim_cc`,`id_etsim_plant_game_contains`,`id_etsim_game`,`id_etsim_members`,`id_etsim_round_game`),
  KEY `FK_can_contains_id_etsim_game` (`id_etsim_game`),
  KEY `FK_can_contains_id_etsim_members` (`id_etsim_members`),
  KEY `FK_can_contains_id_etsim_round_game` (`id_etsim_round_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1146 ;

--
-- Vider la table avant d'insérer `can_contains`
--

TRUNCATE TABLE `can_contains`;
--
-- Contenu de la table `can_contains`
--

INSERT INTO `can_contains` (`id_etsim_cc`, `id_etsim_plant_game_contains`, `id_etsim_game`, `id_etsim_members`, `id_etsim_round_game`) VALUES
(311, 78, 1, 9, '0'),
(312, 22, 1, 9, '0'),
(313, 62, 1, 9, '0'),
(314, 38, 1, 9, '0'),
(315, 52, 1, 9, '0'),
(1141, 80, 1, 17, '0'),
(1142, 23, 1, 17, '0'),
(1143, 62, 1, 17, '0'),
(1144, 36, 1, 17, '0'),
(1145, 44, 1, 17, '0');

-- --------------------------------------------------------

--
-- Structure de la table `etsim_game`
--

CREATE TABLE IF NOT EXISTS `etsim_game` (
  `id_etsim_game` int(11) NOT NULL AUTO_INCREMENT,
  `date_etsim_game` datetime NOT NULL,
  `description_etsim_game` text COLLATE utf8_unicode_ci NOT NULL,
  `password_etsim_game` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `salt_etsim_game` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `status_etsim_game` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maxplayer_etsim_game` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_etsim_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Vider la table avant d'insérer `etsim_game`
--

TRUNCATE TABLE `etsim_game`;
--
-- Contenu de la table `etsim_game`
--

INSERT INTO `etsim_game` (`id_etsim_game`, `date_etsim_game`, `description_etsim_game`, `password_etsim_game`, `salt_etsim_game`, `status_etsim_game`, `maxplayer_etsim_game`) VALUES
(1, '2016-01-13 21:42:58', 'test', 'Fky4p3fD/ZZnCzaeScUTv6XcnfKefGdyx6jpm6WEwW1E87wud6rFC43D1ulci66JUXh3nUwih1ZrMbAbfonynQ==', 'xhK3AWdwNdXp51FaPhRaGw==', 'Play', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etsim_game_round_datetime`
--

CREATE TABLE IF NOT EXISTS `etsim_game_round_datetime` (
  `round_number_etsim_game_round_datetime` int(11) NOT NULL,
  `currentdate_etsim_game_round_datetime` datetime NOT NULL,
  `datetime_round_etsim_game_round_datetime` datetime DEFAULT NULL,
  `id_etsim_game` int(11) DEFAULT NULL,
  `demand_power_per_round` int(11) NOT NULL,
  PRIMARY KEY (`round_number_etsim_game_round_datetime`,`currentdate_etsim_game_round_datetime`),
  KEY `FK_etsim_game_round_datetime_id_etsim_game` (`id_etsim_game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `etsim_game_round_datetime`
--

TRUNCATE TABLE `etsim_game_round_datetime`;
--
-- Contenu de la table `etsim_game_round_datetime`
--

INSERT INTO `etsim_game_round_datetime` (`round_number_etsim_game_round_datetime`, `currentdate_etsim_game_round_datetime`, `datetime_round_etsim_game_round_datetime`, `id_etsim_game`, `demand_power_per_round`) VALUES
(1, '2016-01-22 14:29:06', '2016-01-22 14:44:06', 1, 1875),
(2, '2016-01-22 14:44:06', '2016-01-22 14:59:06', 1, 1750),
(3, '2016-01-22 14:59:06', '2016-01-22 15:14:06', 1, 3500),
(4, '2016-01-22 15:14:06', '2016-01-22 15:29:06', 1, 2000),
(5, '2016-01-22 15:29:06', '2016-01-22 15:44:06', 1, 3150),
(6, '2016-01-22 15:44:06', '2016-01-22 15:59:06', 1, 2000),
(7, '2016-01-22 15:59:06', '2016-01-22 16:14:06', 1, 4750),
(8, '2016-01-22 16:14:06', '2016-01-22 16:29:06', 1, 2375),
(9, '2016-01-22 16:29:06', '2016-01-22 16:44:06', 1, 3150),
(10, '2016-01-22 16:44:06', '2016-01-22 16:59:06', 1, 3500);

-- --------------------------------------------------------

--
-- Structure de la table `etsim_login_attempt`
--

CREATE TABLE IF NOT EXISTS `etsim_login_attempt` (
  `user_id_login_attempt` int(11) NOT NULL,
  `time_login_attempt` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `etsim_login_attempt`
--

TRUNCATE TABLE `etsim_login_attempt`;
--
-- Contenu de la table `etsim_login_attempt`
--

INSERT INTO `etsim_login_attempt` (`user_id_login_attempt`, `time_login_attempt`) VALUES
(9, '1448446174'),
(9, '1449688815'),
(9, '1449848949'),
(9, '1449848965'),
(9, '1449848994'),
(9, '1449849007'),
(9, '1449849007'),
(9, '1449849136'),
(9, '1449932842'),
(9, '1451052045'),
(9, '1451052080'),
(4, '1451899827'),
(9, '1451899832'),
(9, '1451902463'),
(9, '1451902481'),
(9, '1451919485'),
(9, '1451919496'),
(9, '1451919573'),
(9, '1451919614'),
(9, '1451919622'),
(9, '1451919675'),
(15, '1452436236');

-- --------------------------------------------------------

--
-- Structure de la table `etsim_members`
--

CREATE TABLE IF NOT EXISTS `etsim_members` (
  `id_etsim_members` int(11) NOT NULL AUTO_INCREMENT,
  `username_etsim_members` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email_etsim_members` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_etsim_members` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `salt_etsim_members` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `role_etsim_members` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enable_etsim_members` tinyint(1) NOT NULL,
  `group_etsim_members` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_etsim_members`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Vider la table avant d'insérer `etsim_members`
--

TRUNCATE TABLE `etsim_members`;
--
-- Contenu de la table `etsim_members`
--

INSERT INTO `etsim_members` (`id_etsim_members`, `username_etsim_members`, `email_etsim_members`, `password_etsim_members`, `salt_etsim_members`, `role_etsim_members`, `enable_etsim_members`, `group_etsim_members`) VALUES
(9, 'Bryan', 'bryan.maisano@gmail.com', 'hAzU8lRiNBOtPMWQY/UHQJJsns9sqVdA3u87SM9FepH3da5IOrVuAYKWFXrHSxoaFpGAqF+jd2RhPoPgC4JmKw==', 'gEOzF8vE0eVXApqrUHnhog==', 'Admin', 1, 'UTBMa'),
(17, 'Admin', 'etsim-serious.game@utbm.fr', 'VDcigNpKcKBmtt+5uteHUL99B4k+K5QKNbpH9cP9GNI2IFl3i8rqsAnO6tyH07cO5umpvcSWhOZ1rRlT8xBuzA==', 'u+3VWVqwNGtz61ze6WZHhA==', 'Admin', 1, 'UTBM GE');

-- --------------------------------------------------------

--
-- Structure de la table `etsim_plant`
--

CREATE TABLE IF NOT EXISTS `etsim_plant` (
  `id_etsim_plant` int(11) NOT NULL AUTO_INCREMENT,
  `nb_unit_etsim_plant` int(2) NOT NULL DEFAULT '1',
  `power_unit_etsim_plant` int(11) NOT NULL,
  `cost_mw_etsim_plant` decimal(11,4) NOT NULL,
  `om_mw_etsim_plant` decimal(10,3) NOT NULL,
  `rdt_etsim_plant` decimal(10,3) NOT NULL,
  `construction_etsim_plant` decimal(10,3) NOT NULL,
  `operation_etsim_plant` int(11) NOT NULL,
  `fixed_costs_etsim_plant` decimal(10,4) DEFAULT NULL,
  `description_etsim_plant` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_etsim_plant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=85 ;

--
-- Vider la table avant d'insérer `etsim_plant`
--

TRUNCATE TABLE `etsim_plant`;
--
-- Contenu de la table `etsim_plant`
--

INSERT INTO `etsim_plant` (`id_etsim_plant`, `nb_unit_etsim_plant`, `power_unit_etsim_plant`, `cost_mw_etsim_plant`, `om_mw_etsim_plant`, `rdt_etsim_plant`, `construction_etsim_plant`, `operation_etsim_plant`, `fixed_costs_etsim_plant`, `description_etsim_plant`) VALUES
(1, 1, 250, '2194000.0000', '6.279', '0.390', '2.000', 20, '1569.7500', 'Plant 1'),
(2, 1, 500, '2194000.0000', '6.279', '0.390', '3.000', 20, '3139.5000', 'Plant 2'),
(3, 1, 800, '2194000.0000', '6.279', '0.390', '4.000', 20, '5023.2000', 'Plant 3'),
(4, 1, 250, '2606000.0000', '8.904', '0.440', '2.000', 20, '2226.0000', 'Plant 4'),
(5, 1, 500, '2606000.0000', '8.904', '0.440', '3.000', 20, '4452.0000', 'Plant 5'),
(6, 1, 800, '2606000.0000', '8.904', '0.440', '4.000', 20, '7123.2000', 'Plant 6'),
(7, 1, 250, '2880000.0000', '9.817', '0.470', '2.000', 20, '2454.2500', 'Plant 7'),
(8, 1, 500, '2880000.0000', '9.817', '0.470', '3.000', 20, '4908.5000', 'Plant 8'),
(9, 1, 800, '2880000.0000', '9.817', '0.470', '4.000', 20, '7853.6000', 'Plant 9'),
(10, 1, 250, '3291000.0000', '13.128', '0.480', '3.000', 20, '3282.0000', 'Plant 10'),
(11, 1, 500, '3291000.0000', '13.128', '0.480', '4.000', 20, '6564.0000', 'Plant 11'),
(12, 1, 800, '3291000.0000', '13.128', '0.480', '5.000', 20, '10502.4000', 'Plant 12'),
(13, 1, 250, '1234000.0000', '3.653', '0.590', '2.000', 20, '913.2500', 'Plant 13'),
(14, 1, 500, '1234000.0000', '3.653', '0.590', '3.000', 20, '1826.5000', 'Plant 14'),
(15, 1, 800, '1234000.0000', '3.653', '0.590', '4.000', 20, '2922.4000', 'Plant 15'),
(16, 1, 50, '686000.0000', '3.082', '0.380', '0.500', 20, '154.1000', 'Plant 16'),
(17, 1, 150, '686000.0000', '3.082', '0.380', '0.500', 20, '462.3000', 'Plant 17'),
(18, 1, 300, '686000.0000', '3.082', '0.380', '0.500', 20, '924.6000', 'Plant 18'),
(19, 1, 900, '5486000.0000', '18.836', '0.330', '10.000', 30, '16952.4000', 'Plant 19'),
(20, 1, 1450, '5486000.0000', '18.836', '0.330', '10.000', 30, '27312.2000', 'Plant 20'),
(21, 1, 1750, '5486000.0000', '18.836', '0.330', '10.000', 30, '32963.0000', 'Plant 21'),
(22, 2, 500, '2194000.0000', '6.279', '0.390', '2.000', 20, '3139.5000', 'Plant 1 2 UNITS'),
(23, 3, 750, '2194000.0000', '6.279', '0.390', '2.000', 20, '4709.2500', 'Plant 1 3 UNITS'),
(24, 4, 1000, '2194000.0000', '6.279', '0.390', '2.000', 20, '6279.0000', 'Plant 1 4 UNITS'),
(25, 2, 1000, '2194000.0000', '6.279', '0.390', '3.000', 20, '6279.0000', 'Plant 2 2 UNITS'),
(26, 3, 1500, '2194000.0000', '6.279', '0.390', '3.000', 20, '9418.5000', 'Plant 2 3 UNITS'),
(27, 4, 2000, '2194000.0000', '6.279', '0.390', '3.000', 20, '12558.0000', 'Plant 2 4 UNITS'),
(28, 2, 1600, '2194000.0000', '6.279', '0.390', '4.000', 20, '10046.4000', 'Plant 3 2 UNITS'),
(29, 3, 2400, '2194000.0000', '6.279', '0.390', '4.000', 20, '15069.6000', 'Plant 3 3 UNITS'),
(30, 4, 3200, '2194000.0000', '6.279', '0.390', '4.000', 20, '20092.8000', 'Plant 3 4 UNITS'),
(31, 2, 500, '2606000.0000', '8.904', '0.440', '2.000', 20, '4452.0000', 'Plant 4 2 UNITS'),
(32, 3, 750, '2606000.0000', '8.904', '0.440', '2.000', 20, '6678.0000', 'Plant 4 3 UNITS'),
(33, 4, 1000, '2606000.0000', '8.904', '0.440', '2.000', 20, '8904.0000', 'Plant 4 4 UNITS'),
(34, 2, 1000, '2606000.0000', '8.904', '0.440', '3.000', 20, '8904.0000', 'Plant 5 2 UNITS'),
(35, 3, 1500, '2606000.0000', '8.904', '0.440', '3.000', 20, '13356.0000', 'Plant 5 3 UNITS'),
(36, 4, 2000, '2606000.0000', '8.904', '0.440', '3.000', 20, '17808.0000', 'Plant 5 4 UNITS'),
(37, 2, 1600, '2606000.0000', '8.904', '0.440', '4.000', 20, '14246.4000', 'Plant 6 2 UNITS'),
(38, 3, 2400, '2606000.0000', '8.904', '0.440', '4.000', 20, '21369.6000', 'Plant 6 3 UNITS'),
(39, 4, 3200, '2606000.0000', '8.904', '0.440', '4.000', 20, '28492.8000', 'Plant 6 4 UNITS'),
(40, 2, 500, '2880000.0000', '9.817', '0.470', '2.000', 20, '4908.5000', 'Plant 7 2 UNITS'),
(41, 3, 750, '2880000.0000', '9.817', '0.470', '2.000', 20, '7362.7500', 'Plant 7 3 UNITS'),
(42, 4, 1000, '2880000.0000', '9.817', '0.470', '2.000', 20, '9817.0000', 'Plant 7 4 UNITS'),
(43, 2, 1000, '2880000.0000', '9.817', '0.470', '3.000', 20, '9817.0000', 'Plant 8 2 UNITS'),
(44, 3, 1500, '2880000.0000', '9.817', '0.470', '3.000', 20, '14725.5000', 'Plant 8 3 UNITS'),
(45, 4, 2000, '2880000.0000', '9.817', '0.470', '3.000', 20, '19634.0000', 'Plant 8 4 UNITS'),
(46, 2, 1600, '2880000.0000', '9.817', '0.470', '4.000', 20, '15707.2000', 'Plant 9 2 UNITS'),
(47, 3, 2400, '2880000.0000', '9.817', '0.470', '4.000', 20, '23560.8000', 'Plant 9 3 UNITS'),
(48, 4, 3200, '2880000.0000', '9.817', '0.470', '4.000', 20, '31414.4000', 'Plant 9 4 UNITS'),
(49, 2, 500, '3291000.0000', '13.128', '0.480', '3.000', 20, '6564.0000', 'Plant 10 2 UNITS'),
(50, 3, 750, '3291000.0000', '13.128', '0.480', '3.000', 20, '9846.0000', 'Plant 10 3 UNITS'),
(51, 4, 1000, '3291000.0000', '13.128', '0.480', '3.000', 20, '13128.0000', 'Plant 10 4 UNITS'),
(52, 2, 1000, '3291000.0000', '13.128', '0.480', '4.000', 20, '13128.0000', 'Plant 11 2 UNITS'),
(53, 3, 1500, '3291000.0000', '13.128', '0.480', '4.000', 20, '19692.0000', 'Plant 11 3 UNITS'),
(54, 4, 2000, '3291000.0000', '13.128', '0.480', '4.000', 20, '26256.0000', 'Plant 11 4 UNITS'),
(55, 2, 1600, '3291000.0000', '13.128', '0.480', '5.000', 20, '21004.8000', 'Plant 12 2 UNITS'),
(56, 3, 2400, '3291000.0000', '13.128', '0.480', '5.000', 20, '31507.2000', 'Plant 12 3 UNITS'),
(57, 4, 3200, '3291000.0000', '13.128', '0.480', '5.000', 20, '42009.6000', 'Plant 12 4 UNITS'),
(58, 2, 500, '1234000.0000', '3.653', '0.590', '2.000', 20, '1826.5000', 'Plant 13 2 UNITS'),
(59, 3, 750, '1234000.0000', '3.653', '0.590', '2.000', 20, '2739.7500', 'Plant 13 3 UNITS'),
(60, 4, 1000, '1234000.0000', '3.653', '0.590', '2.000', 20, '3653.0000', 'Plant 13 4 UNITS'),
(61, 2, 1000, '1234000.0000', '3.653', '0.590', '3.000', 20, '3653.0000', 'Plant 14 2 UNITS'),
(62, 3, 1500, '1234000.0000', '3.653', '0.590', '3.000', 20, '5479.5000', 'Plant 14 3 UNITS'),
(63, 4, 2000, '1234000.0000', '3.653', '0.590', '3.000', 20, '7306.0000', 'Plant 14 4 UNITS'),
(64, 2, 1600, '1234000.0000', '3.653', '0.590', '4.000', 20, '5844.8000', 'Plant 15 2 UNITS'),
(65, 3, 2400, '1234000.0000', '3.653', '0.590', '4.000', 20, '8767.2000', 'Plant 15 3 UNITS'),
(66, 4, 3200, '1234000.0000', '3.653', '0.590', '4.000', 20, '11689.6000', 'Plant 15 4 UNITS'),
(67, 2, 100, '686000.0000', '3.082', '0.380', '0.500', 20, '308.2000', 'Plant 16 2 UNITS'),
(68, 3, 150, '686000.0000', '3.082', '0.380', '0.500', 20, '462.3000', 'Plant 16 3 UNITS'),
(69, 4, 200, '686000.0000', '3.082', '0.380', '0.500', 20, '616.4000', 'Plant 16 4 UNITS'),
(70, 2, 300, '686000.0000', '3.082', '0.380', '0.500', 20, '924.6000', 'Plant 17 2 UNITS'),
(71, 3, 450, '686000.0000', '3.082', '0.380', '0.500', 20, '1386.9000', 'Plant 17 3 UNITS'),
(72, 4, 600, '686000.0000', '3.082', '0.380', '0.500', 20, '1849.2000', 'Plant 17 4 UNITS'),
(73, 2, 600, '686000.0000', '3.082', '0.380', '0.500', 20, '1849.2000', 'Plant 18 2 UNITS'),
(74, 3, 900, '686000.0000', '3.082', '0.380', '0.500', 20, '2773.8000', 'Plant 18 3 UNITS'),
(75, 4, 1200, '686000.0000', '3.082', '0.380', '0.500', 20, '3698.4000', 'Plant 18 4 UNITS'),
(76, 2, 1800, '5486000.0000', '18.836', '0.330', '10.000', 30, '33904.8000', 'Plant 19 2 UNITS'),
(77, 3, 2700, '5486000.0000', '18.836', '0.330', '10.000', 30, '50857.2000', 'Plant 19 3 UNITS'),
(78, 4, 3600, '5486000.0000', '18.836', '0.330', '10.000', 30, '67809.6000', 'Plant 19 4 UNITS'),
(79, 2, 2900, '5486000.0000', '18.836', '0.330', '10.000', 30, '54624.4000', 'Plant 20 2 UNITS'),
(80, 3, 4350, '5486000.0000', '18.836', '0.330', '10.000', 30, '81936.6000', 'Plant 20 3 UNITS'),
(81, 4, 5800, '5486000.0000', '18.836', '0.330', '10.000', 30, '109248.8000', 'Plant 20 4 UNITS'),
(82, 2, 3500, '5486000.0000', '18.836', '0.330', '10.000', 30, '65926.0000', 'Plant 21 2 UNITS'),
(83, 3, 5250, '5486000.0000', '18.836', '0.330', '10.000', 30, '98889.0000', 'Plant 21 3 UNITS'),
(84, 4, 7000, '5486000.0000', '18.836', '0.330', '10.000', 30, '131852.0000', 'Plant 21 4 UNITS');

-- --------------------------------------------------------

--
-- Structure de la table `etsim_round_game`
--

CREATE TABLE IF NOT EXISTS `etsim_round_game` (
  `id_etsim_round_game` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `number_etsim_round_game` int(2) NOT NULL,
  `bid_volume_etsim_round_game` float DEFAULT NULL,
  `bid_price_etsim_round_game` float DEFAULT NULL,
  `demand_voume_etsim_round_game` float DEFAULT NULL,
  `market_price_etsim_round_game` float DEFAULT NULL,
  `income_etsim_round_game` float DEFAULT NULL,
  `cost_etsim_round_game` float DEFAULT NULL,
  `benefit_etsim_round_game` float DEFAULT NULL,
  `capital_etsim_round_game` float DEFAULT NULL,
  PRIMARY KEY (`id_etsim_round_game`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `etsim_round_game`
--

TRUNCATE TABLE `etsim_round_game`;
--
-- Contenu de la table `etsim_round_game`
--

INSERT INTO `etsim_round_game` (`id_etsim_round_game`, `number_etsim_round_game`, `bid_volume_etsim_round_game`, `bid_price_etsim_round_game`, `demand_voume_etsim_round_game`, `market_price_etsim_round_game`, `income_etsim_round_game`, `cost_etsim_round_game`, `benefit_etsim_round_game`, `capital_etsim_round_game`) VALUES
('', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('0', 0, 0, 0, 0, 0, 0, 0, 0, 0),
('1-9-1-1', 1, 1500, 90, 1875, 50, 0, 40909.1, -40909.1, 0),
('1-9-1-101', 1, 0, 0, 1875, 50, 0, 0, 0, 0),
('1-9-1-102', 1, 0, 0, 1875, 50, 0, 0, 0, 0),
('1-9-1-103', 1, 0, 0, 1875, 50, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `etsim_round_game_temp`
--

CREATE TABLE IF NOT EXISTS `etsim_round_game_temp` (
  `idetsimgame_etsim_round_game_temp` int(11) NOT NULL DEFAULT '0',
  `idetsimmember_etsim_round_game_temp` int(11) NOT NULL DEFAULT '0',
  `number_etsim_round_game_temp` int(11) NOT NULL DEFAULT '0',
  `line_etsim_round_game_temp` int(11) NOT NULL,
  `bid_volume_etsim_round_game_temp` float DEFAULT NULL,
  `bid_price_etsim_round_game_temp` float DEFAULT NULL,
  `demand_voume_etsim_round_game_temp` float DEFAULT NULL,
  `market_price_etsim_round_game_temp` float DEFAULT NULL,
  `income_etsim_round_game_temp` float DEFAULT NULL,
  `cost_etsim_round_game_temp` float DEFAULT NULL,
  `benefit_etsim_round_game_temp` float DEFAULT NULL,
  `capital_etsim_round_game_temp` float DEFAULT NULL,
  `idplant_etsim_round_game_temp` int(11) NOT NULL,
  `finnish_etsim_round_game_temp` tinyint(1) NOT NULL,
  PRIMARY KEY (`idetsimgame_etsim_round_game_temp`,`idetsimmember_etsim_round_game_temp`,`number_etsim_round_game_temp`,`line_etsim_round_game_temp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `etsim_round_game_temp`
--

TRUNCATE TABLE `etsim_round_game_temp`;
--
-- Contenu de la table `etsim_round_game_temp`
--

INSERT INTO `etsim_round_game_temp` (`idetsimgame_etsim_round_game_temp`, `idetsimmember_etsim_round_game_temp`, `number_etsim_round_game_temp`, `line_etsim_round_game_temp`, `bid_volume_etsim_round_game_temp`, `bid_price_etsim_round_game_temp`, `demand_voume_etsim_round_game_temp`, `market_price_etsim_round_game_temp`, `income_etsim_round_game_temp`, `cost_etsim_round_game_temp`, `benefit_etsim_round_game_temp`, `capital_etsim_round_game_temp`, `idplant_etsim_round_game_temp`, `finnish_etsim_round_game_temp`) VALUES
(1, 9, 2, 1, 1, 1, 1750, 1, 1, 1, 1, 1, 78, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etsim_type_plant`
--

CREATE TABLE IF NOT EXISTS `etsim_type_plant` (
  `id_etsim_type_plant` int(11) NOT NULL AUTO_INCREMENT,
  `name_etsim_type_plant` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description_etsim_type_plant` text COLLATE utf8_unicode_ci NOT NULL,
  `minv_costs_etsim_type_plant` decimal(20,9) NOT NULL,
  `maxv_costs_etsim_type_plant` decimal(20,9) NOT NULL,
  PRIMARY KEY (`id_etsim_type_plant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Vider la table avant d'insérer `etsim_type_plant`
--

TRUNCATE TABLE `etsim_type_plant`;
--
-- Contenu de la table `etsim_type_plant`
--

INSERT INTO `etsim_type_plant` (`id_etsim_type_plant`, `name_etsim_type_plant`, `description_etsim_type_plant`, `minv_costs_etsim_type_plant`, `maxv_costs_etsim_type_plant`) VALUES
(1, 'Coal subcritical', 'Coal subcritical', '9.718708000', '17.319740000'),
(2, 'Coal supercritical', 'Coal supercritical', '9.718708000', '17.319740000'),
(3, 'Coal ultra-supercritical', 'Coal ultra-supercritical', '9.718708000', '17.319740000'),
(4, 'Coal IGCC', 'Coal IGCC', '9.718708000', '17.319740000'),
(5, 'Gas CCGT', 'Gas CCGT', '32.914283610', '32.914283610'),
(6, 'Gas turbine', 'Gas turbine', '32.914283610', '32.914283610'),
(7, 'Nuclear', 'Nuclear', '0.647625636', '0.647625636');

-- --------------------------------------------------------

--
-- Structure de la table `have`
--

CREATE TABLE IF NOT EXISTS `have` (
  `id_have` int(11) NOT NULL AUTO_INCREMENT,
  `id_etsim_members_have` int(11) NOT NULL DEFAULT '0',
  `v_costs_etsim_members_have` decimal(60,15) NOT NULL DEFAULT '0.000000000000000',
  `id_etsim_plant` int(11) NOT NULL,
  `id_etsim_game` int(11) NOT NULL,
  PRIMARY KEY (`id_have`,`id_etsim_members_have`,`v_costs_etsim_members_have`,`id_etsim_plant`,`id_etsim_game`),
  KEY `FK_have_id_etsim_plant` (`id_etsim_plant`),
  KEY `FK_have_id_etsim_game` (`id_etsim_game`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Vider la table avant d'insérer `have`
--

TRUNCATE TABLE `have`;
--
-- Contenu de la table `have`
--

INSERT INTO `have` (`id_have`, `id_etsim_members_have`, `v_costs_etsim_members_have`, `id_etsim_plant`, `id_etsim_game`) VALUES
(67, 9, '30.769230769231000', 22, 1),
(102, 17, '25.641025641026000', 23, 1),
(104, 17, '36.363636363636000', 36, 1),
(69, 9, '27.272727272727000', 38, 1),
(105, 17, '25.531914893617000', 44, 1),
(70, 9, '35.416666666667000', 52, 1),
(68, 9, '55.786921372881000', 62, 1),
(103, 17, '55.786921372881000', 62, 1),
(66, 9, '1.962501927272700', 78, 1),
(101, 17, '1.962501927272700', 80, 1);

-- --------------------------------------------------------

--
-- Structure de la table `is_type`
--

CREATE TABLE IF NOT EXISTS `is_type` (
  `id_etsim_plant` int(11) NOT NULL,
  `id_etsim_type_plant` int(11) NOT NULL,
  PRIMARY KEY (`id_etsim_plant`,`id_etsim_type_plant`),
  KEY `FK_is_type_id_etsim_type_plant` (`id_etsim_type_plant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Vider la table avant d'insérer `is_type`
--

TRUNCATE TABLE `is_type`;
--
-- Contenu de la table `is_type`
--

INSERT INTO `is_type` (`id_etsim_plant`, `id_etsim_type_plant`) VALUES
(1, 1),
(2, 1),
(3, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(4, 2),
(5, 2),
(6, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(7, 3),
(8, 3),
(9, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(10, 4),
(11, 4),
(12, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(13, 5),
(14, 5),
(15, 5),
(58, 5),
(59, 5),
(60, 5),
(61, 5),
(62, 5),
(63, 5),
(64, 5),
(65, 5),
(66, 5),
(16, 6),
(17, 6),
(18, 6),
(67, 6),
(68, 6),
(69, 6),
(70, 6),
(71, 6),
(72, 6),
(73, 6),
(74, 6),
(75, 6),
(19, 7),
(20, 7),
(21, 7),
(76, 7),
(77, 7),
(78, 7),
(79, 7),
(80, 7),
(81, 7),
(82, 7),
(83, 7),
(84, 7);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `can_contains`
--
ALTER TABLE `can_contains`
  ADD CONSTRAINT `FK_can_contains_id_etsim_game` FOREIGN KEY (`id_etsim_game`) REFERENCES `etsim_game` (`id_etsim_game`),
  ADD CONSTRAINT `FK_can_contains_id_etsim_members` FOREIGN KEY (`id_etsim_members`) REFERENCES `etsim_members` (`id_etsim_members`),
  ADD CONSTRAINT `FK_can_contains_id_etsim_round_game` FOREIGN KEY (`id_etsim_round_game`) REFERENCES `etsim_round_game` (`id_etsim_round_game`);

--
-- Contraintes pour la table `etsim_game_round_datetime`
--
ALTER TABLE `etsim_game_round_datetime`
  ADD CONSTRAINT `FK_etsim_game_round_datetime_id_etsim_game` FOREIGN KEY (`id_etsim_game`) REFERENCES `etsim_game` (`id_etsim_game`);

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_have_id_etsim_game` FOREIGN KEY (`id_etsim_game`) REFERENCES `etsim_game` (`id_etsim_game`),
  ADD CONSTRAINT `FK_have_id_etsim_plant` FOREIGN KEY (`id_etsim_plant`) REFERENCES `etsim_plant` (`id_etsim_plant`);

--
-- Contraintes pour la table `is_type`
--
ALTER TABLE `is_type`
  ADD CONSTRAINT `FK_is_type_id_etsim_plant` FOREIGN KEY (`id_etsim_plant`) REFERENCES `etsim_plant` (`id_etsim_plant`),
  ADD CONSTRAINT `FK_is_type_id_etsim_type_plant` FOREIGN KEY (`id_etsim_type_plant`) REFERENCES `etsim_type_plant` (`id_etsim_type_plant`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
