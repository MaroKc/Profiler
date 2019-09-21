-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Set 21, 2019 alle 13:09
-- Versione del server: 5.7.24
-- Versione PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profiler`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `filtri_ricerca`
--

DROP TABLE IF EXISTS `filtri_ricerca`;
CREATE TABLE IF NOT EXISTS `filtri_ricerca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `operazioni` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `filtri_ricerca`
--

INSERT INTO `filtri_ricerca` (`id`, `nome`, `operazioni`) VALUES
(1, 'Maggiore di N Visite', ''),
(2, 'Numero Giorni Dall\'ultima Regency', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `interazioni`
--

DROP TABLE IF EXISTS `interazioni`;
CREATE TABLE IF NOT EXISTS `interazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sezione` int(11) NOT NULL,
  `tipo_filtro` int(11) NOT NULL,
  `valore_filtro` int(11) NOT NULL,
  `tipo_interazione` int(11) NOT NULL,
  `testo_interazione` varchar(255) NOT NULL,
  `nome_filtro` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `interazioni`
--

INSERT INTO `interazioni` (`id`, `id_sezione`, `tipo_filtro`, `valore_filtro`, `tipo_interazione`, `testo_interazione`, `nome_filtro`) VALUES
(12, 1, 1, 2, 2, 'dfsffgdhf', 'dffd'),
(13, 1, 2, 2, 2, 'dfsffgdhf', 'dffd');

-- --------------------------------------------------------

--
-- Struttura della tabella `sezioni`
--

DROP TABLE IF EXISTS `sezioni`;
CREATE TABLE IF NOT EXISTS `sezioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `tipo_pagina` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sezioni`
--

INSERT INTO `sezioni` (`id`, `url`, `nome`, `tipo_pagina`) VALUES
(1, 'http://localhost/sito/', 'quelle con pagina\r\n', '1');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_interazione`
--

DROP TABLE IF EXISTS `tipo_interazione`;
CREATE TABLE IF NOT EXISTS `tipo_interazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `operazione` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tipo_interazione`
--

INSERT INTO `tipo_interazione` (`id`, `nome`, `operazione`) VALUES
(1, 'Popup', ''),
(2, 'Header', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_pagina`
--

DROP TABLE IF EXISTS `tipo_pagina`;
CREATE TABLE IF NOT EXISTS `tipo_pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `operazione` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `tipo_pagina`
--

INSERT INTO `tipo_pagina` (`id`, `nome`, `operazione`) VALUES
(1, 'Single Page', ''),
(2, 'Multi Page', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `visitatori`
--

DROP TABLE IF EXISTS `visitatori`;
CREATE TABLE IF NOT EXISTS `visitatori` (
  `token` int(11) NOT NULL AUTO_INCREMENT,
  `visite` int(11) NOT NULL DEFAULT '0',
  `ultima_visita` timestamp NOT NULL,
  `giorno_registrazione` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `visitatori`
--

INSERT INTO `visitatori` (`token`, `visite`, `ultima_visita`, `giorno_registrazione`) VALUES
(1, 1, '2019-09-21 09:00:50', '2019-09-21 09:00:50'),
(2, 1, '2019-09-21 09:46:35', '2019-09-21 09:46:35'),
(3, 1, '2019-09-21 09:46:49', '2019-09-21 09:46:49'),
(4, 1, '2019-09-21 09:46:55', '2019-09-21 09:46:55'),
(5, 1, '2019-09-21 09:47:10', '2019-09-21 09:47:10'),
(6, 4, '2019-09-21 11:15:25', '2019-09-21 09:48:02'),
(7, 1, '2019-09-21 09:49:06', '2019-09-21 09:49:06'),
(8, 1, '2019-09-21 09:49:43', '2019-09-21 09:49:43'),
(9, 1, '2019-09-21 09:51:08', '2019-09-21 09:51:08'),
(10, 1, '2019-09-21 09:55:46', '2019-09-21 09:55:46'),
(11, 1, '2019-09-21 09:56:04', '2019-09-21 09:56:04'),
(12, 1, '2019-09-21 09:56:09', '2019-09-21 09:56:09'),
(13, 1, '2019-09-21 10:00:48', '2019-09-21 10:00:48'),
(14, 1, '2019-09-21 10:01:33', '2019-09-21 10:01:33'),
(15, 1, '2019-09-21 10:01:47', '2019-09-21 10:01:47'),
(16, 2, '2019-09-21 11:26:07', '2019-09-21 11:25:14');

-- --------------------------------------------------------

--
-- Struttura della tabella `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id_sezione` int(11) NOT NULL,
  `token_utente` int(11) NOT NULL,
  `visite` int(11) NOT NULL DEFAULT '0',
  `tempo` timestamp NULL DEFAULT NULL,
  `ultima_visita` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sezione`,`token_utente`),
  KEY `fk_token_utente` (`token_utente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `visite`
--

INSERT INTO `visite` (`id_sezione`, `token_utente`, `visite`, `tempo`, `ultima_visita`) VALUES
(2, 6, 4, NULL, '2019-09-21 11:17:34'),
(2, 1, 4, NULL, '2019-09-21 09:03:48'),
(1, 1, 2, NULL, '2019-09-21 09:13:12'),
(1, 6, 89, NULL, '2019-09-21 11:23:16'),
(1, 3, 1, NULL, '2019-09-21 09:46:49'),
(1, 4, 1, NULL, '2019-09-21 09:46:55'),
(1, 5, 1, NULL, '2019-09-21 09:47:10'),
(1, 7, 1, NULL, '2019-09-21 09:49:06'),
(1, 8, 1, NULL, '2019-09-21 09:49:43'),
(2, 11, 1, NULL, '2019-09-21 09:56:04'),
(1, 16, 17, NULL, '2019-09-21 11:37:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
