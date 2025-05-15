-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2025 a las 13:02:09
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
  `user_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `folder_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `real_name`, `name`, `type`, `user_id`, `size`, `date`, `folder_id`) VALUES
(1, '6825c5ce4c8618.63552584.pdf', 'FacturaMembrete.pdf', 'pdf', 5796, 129150, '2025-05-15 10:45:34', 1),
(2, '6825c8d0464d33.73431653.pdf', 'piriquitingui.pdf', 'pdf', 6448, 3523605, '2025-05-15 10:59:43', 3);

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
(1, 5796, 'Documentos'),
(2, 5796, 'Facturas'),
(3, 6448, 'Documentos'),
(4, 5796, 'Contratos'),
(5, 5796, 'Nominas'),
(6, 5796, 'Horarios');

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
(1, 1, 'admin', 'admin', NULL, NULL, NULL, NULL, 1),
(3, 5796, 'marcosJ', '3003', 'Marcos Javier', 'Pérez', 'Gómez', '43857678J', 0),
(4, 5307, 'carlos', '$2y$10$xVkfnv6elu5KFHaS6qMs1O/lhui/hnZedkRXI1jl9iN4.F2TmiMVC', 'Carlos', 'Gonzales', 'Alboran', '1235327', 0),
(5, 6448, 'alexpd', '3003', 'Alexander', 'Pérez', 'Dominguez', '12345678A', 0),
(6, 67845, 'victfd', '3003', 'Victor', 'Fernandez', 'Diaz', '87654321B', 0);

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
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Unique` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
