-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-05-2021 a las 01:44:22
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `loginsystem`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `answer` varchar(8000) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `responsable_id` varchar(128) DEFAULT NULL,
  `rango` int(6) DEFAULT NULL,
  `topic` varchar(128) DEFAULT NULL,
  `thread` varchar(128) DEFAULT NULL,
  `t_id` int(6) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bans`
--

DROP TABLE IF EXISTS `bans`;
CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `currentdate` varchar(128) DEFAULT NULL,
  `reason` varchar(8000) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `ub_email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logsusers`
--

DROP TABLE IF EXISTS `logsusers`;
CREATE TABLE IF NOT EXISTS `logsusers` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) DEFAULT NULL,
  `action_u` varchar(128) DEFAULT NULL,
  `data_u` varchar(8000) DEFAULT NULL,
  `day` varchar(128) DEFAULT NULL,
  `time_sent` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `img_name` varchar(128) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `responsableid` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texts`
--

DROP TABLE IF EXISTS `texts`;
CREATE TABLE IF NOT EXISTS `texts` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `author` varchar(128) DEFAULT NULL,
  `author_e` varchar(128) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `pdf_name` varchar(128) DEFAULT NULL,
  `section` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `threads`
--

DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `answer` varchar(8000) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `responsable_id` varchar(128) DEFAULT NULL,
  `topic` varchar(128) DEFAULT NULL,
  `rango` varchar(128) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `updates`
--

DROP TABLE IF EXISTS `updates`;
CREATE TABLE IF NOT EXISTS `updates` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `cdate` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_name` varchar(128) NOT NULL,
  `users_email` varchar(128) NOT NULL,
  `users_name` varchar(128) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `rango` int(11) DEFAULT NULL,
  `profile_img` varchar(128) DEFAULT NULL,
  `profile_imgname` varchar(128) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL,
  `code_u` varchar(128) DEFAULT NULL,
  `code_uc` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `img_name` varchar(128) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `responsableid` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos2`
--

DROP TABLE IF EXISTS `videos2`;
CREATE TABLE IF NOT EXISTS `videos2` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `link` varchar(128) DEFAULT NULL,
  `section` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
