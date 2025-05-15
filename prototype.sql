-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2025 a las 16:59:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prototype`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `real_name` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `size` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `folder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `real_name`, `name`, `type`, `user_id`, `size`, `date`, `folder_id`) VALUES
(1, '6825e415c6a543.72671885.pdf', 'Factura 1.pdf', 'pdf', 95666, 3943, '2025-05-15 12:54:45', 1),
(2, '6825fa467a5475.03473876.pdf', 'Factura 2.pdf', 'pdf', 95666, 30134, '2025-05-15 14:29:26', 1),
(3, '6825fdc77731b2.10982496.pdf', 'Funciona??.pdf', 'pdf', 95666, 3398721, '2025-05-15 14:44:23', 1),
(4, '6825fe1cebe0e9.35371948.pdf', 'Nomina-Marzo.pdf', 'pdf', 7813, 69652, '2025-05-15 14:45:48', 2),
(5, '6825ff67887b37.89967321.jpg', 'Cliente.jpg', 'jpg', 95666, 25676, '2025-05-15 14:51:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`) VALUES
(1, 95666, 'Facturas'),
(2, 7813, 'Documentos'),
(3, 95666, 'Documentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `1surname` varchar(100) DEFAULT NULL,
  `2surname` varchar(100) DEFAULT NULL,
  `dni` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='TABLA DE USUARIOS';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `passwd`, `name`, `1surname`, `2surname`, `dni`, `admin`) VALUES
(1, 1, 'admin', '$2y$10$ZF6AYQrpL6X.MKgcyolXme2Ipk3B5gh5XXu31ipLBkmP8CMRkmmba', '', '', '', '', 1),
(12, 95666, 'marcosj', '$2y$10$AZeGB5ojE7PsLMS0rPlZTe7P1WWQKpcVIZ6Wn5TQekhyhs8cOdi3C', 'Marcos Javier', 'Pérez', 'Gómez', '43857678J', 0),
(13, 7813, 'alexpd', '$2y$10$Fw7PaWPx0X8Vfzz3PDazHOlypXc73dB9zOzrzw9mxBU31306P3qva', 'Alexander', 'Pérez', 'Dominguez', '12345678A', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique` (`username`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
