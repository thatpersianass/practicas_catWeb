-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2025 a las 17:05:42
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
-- Base de datos: `catweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE `files` (
  `id` bigint(20) NOT NULL,
  `folder_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `real_name` varchar(200) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `folder_id`, `name`, `real_name`, `size`, `type`, `created`) VALUES
(8, 1, 'factura1.pdf', '682de82b4bd1e7.85134887.pdf', 30134, 'pdf', '2025-05-21 14:50:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`) VALUES
(1, 6, 'Facturas'),
(2, 6, 'Imagenes'),
(3, 6, 'Videos'),
(4, 14, 'Documentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `1surname` varchar(100) NOT NULL,
  `2surname` varchar(100) NOT NULL,
  `dni` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `passwd`, `name`, `1surname`, `2surname`, `dni`, `color`, `created`, `admin`) VALUES
(1, 'admin', '$2y$10$ZPRjsFjiq7VufzXwNiuP4uyLKf8sAP6cLA1gsinPgoFOM2qk2lSsO', '', '', '', '', '', '2025-05-20 12:25:36', 1),
(6, 'marcosj', '$2y$10$gVI5SarMolOUudxcxxwR1ur3LAnTP2Zc9ABO3sBO0veAhVFx4XT6i', 'Marcos Javier', 'Pérez', 'Gómez', '43857678J', 'aqua', '2025-05-20 12:45:18', 0),
(7, 'alexp', '$2y$10$0DSAEz52rmp3p/9AQCIqU.3QPVqzCMfgM0Hw4YQ7xTrFrY4GMB82m', 'Alexander', 'Pérez', 'Dominguez', '20234157M', 'cyan', '2025-05-20 14:23:43', 0),
(8, 'laurafd', '$2y$10$OqfU0w/leSMSRTrMmWJWr.2Tsii8OdIF66QA98ipzLPyhRB9xjH7q', 'Laura', 'Fernandez', 'Díaz', '30519847G', 'aqua', '2025-05-20 14:24:38', 0),
(9, 'javimt', '$2y$10$bCmkp58lFYR8NCiT5kB8su34dsHeSnFzX1UHaF987ZB/pSdovK7sS', 'Javier', 'Martinez', 'Torres', '49827163K', 'aqua', '2025-05-20 14:25:07', 0),
(10, 'carmenrs', '$2y$10$W0kIg7r2Ry3WXWcUFcRwNuYOTsJslNnXpPdbUxsglXJPOVmpVWV/i', 'Carmen', 'Rodriguez', 'Sanchez', '78165432L', 'blue', '2025-05-20 14:25:58', 0),
(11, 'pablogr', '$2y$10$xX8Ia2C5G.pBt2gFVWgX6u4AhL0JYkNI6.bL654rsy6BWh/qKPsZq', 'Pablo', 'Gomez', 'Ruiz', '16382749Z', 'yellow', '2025-05-20 14:26:17', 0),
(12, 'yelitzavr', '$2y$10$LbUJjXpyw6x2ZEveZxdHfO1OcPgJlSBZODNia3V9SRPmlhKtxFnPi', 'Yelitza', 'del Valle', 'Rojas', '28419375K', 'purple', '2025-05-20 14:27:47', 0),
(13, 'ronnyar', '$2y$10$ODuQnYlIyo3Q2vYobsmQru580ljg2xUANVOJoafP2U5B7wGV6oH8.', 'Ronny', 'Alejandro', 'Rojas', '50298371D', 'blue', '2025-05-20 14:28:13', 0),
(14, 'orianadb', '$2y$10$nvJovRb5wCeX5.vv6iV8wOgL0jIenvs9T2U0ud4c5we593Ph54qV.', 'Oriana', 'Daniela', 'Briceño', '18305294Z', 'orange', '2025-05-20 14:28:38', 0),
(15, 'jpablo', '$2y$10$Wqf0KLM8NTzHGXWZ3nLw3ePeBNuWC7tEPCBKc7fQUzB2LYDRq0WAa', 'Juan Pablo', 'Alborán', '', '12345678A', 'orange', '2025-05-21 09:32:16', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`folder_id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
