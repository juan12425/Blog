-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2021 a las 03:08:24
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

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
-- Estructura de tabla para la tabla `sections`
--

CREATE TABLE `sections` (
  `id` int(5) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  `img_name` varchar(128) DEFAULT NULL,
  `responsable` varchar(128) DEFAULT NULL,
  `responsableid` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sections`
--

INSERT INTO `sections` (`id`, `title`, `description`, `status`, `img_name`, `responsable`, `responsableid`) VALUES
(16, 'Ponencias', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius commodo purus, sed faucibus erat tincidunt aPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nunc tellus, fermentum vitae felis eu, facilisis fermentum mauris. Fusce volutpat nibh mauris, at luctus purus tincidunt sit ame. Sed ullamcorper nulla non lectus congue, ut dapibus purus aliquam. Vestibulum viverra tristique odio, quis aliquam erat aliquam non.', 'none', 'NULL', 'ejemplo@ljrj.net', 14),
(17, 'Ensayos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius commodo purus, sed faucibus erat tincidunt aPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nunc tellus, fermentum vitae felis eu, facilisis fermentum mauris. Fusce volutpat nibh mauris, at luctus purus tincidunt sit ame. Sed ullamcorper nulla non lectus congue, ut dapibus purus aliquam. Vestibulum viverra tristique odio, quis aliquam erat aliquam non.', 'none', 'NULL', 'ejemplo@ljrj.net', 14),
(18, 'Ensayos2020', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque varius commodo purus, sed faucibus erat tincidunt aPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nunc tellus, fermentum vitae felis eu, facilisis fermentum mauris. Fusce volutpat nibh mauris, at luctus purus tincidunt sit ame. Sed ullamcorper nulla non lectus congue, ut dapibus purus aliquam. Vestibulum viverra tristique odio, quis aliquam erat aliquam non.', 'none', NULL, 'ejemplo@ljrj.net', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `texts`
--

CREATE TABLE `texts` (
  `id` int(6) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `author` varchar(128) DEFAULT NULL,
  `author_e` varchar(128) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `description` varchar(8000) DEFAULT NULL,
  `pdf_name` varchar(128) DEFAULT NULL,
  `section` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `u_name` varchar(128) NOT NULL,
  `users_email` varchar(128) NOT NULL,
  `users_name` varchar(128) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `rango` int(11) DEFAULT NULL,
  `profile_img` varchar(128) DEFAULT NULL,
  `profile_imgname` varchar(128) DEFAULT NULL,
  `rol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `u_name`, `users_email`, `users_name`, `pwd`, `rango`, `profile_img`, `profile_imgname`, `rol`) VALUES
(14, 'Juan', 'ejemplo@ljrj.net', 'Juan', '$2y$10$KZXpxszMT4Hl4OJzcco3ruM9cumcCusOn0UNSejnKiKoOQKA2.GGy', 1, 'set', '14.png', 'Estudiante'),
(16, 'nombre', 'usuario@ljrj.net', 'usuario', '$2y$10$UZLhsC.O47F/5VSrYDVf/Ov10E3CliAB2CA3mztr2ChlY3X8NgBtm', 4, 'none', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `texts`
--
ALTER TABLE `texts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `texts`
--
ALTER TABLE `texts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
