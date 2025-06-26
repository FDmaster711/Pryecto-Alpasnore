-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2025 at 05:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alpasnore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `nombre`, `descripcion`, `precio`, `cantidad`) VALUES
(1, '7777', 'siu', 'cr7', 1.99, 58),
(2, '101010', 'messi', 'messiee', 0.99, 3),
(3, '6666', 'bomba nuclear', 'kaboom', 1000.99, 43),
(4, '9999', 'calculadora', 'para salvar la materia', 25.00, 97),
(5, '1234', 'sasa', 'dafwef', 4.00, 28),
(7, '12', 'tyjtyj', 'gertgeg', 20.00, 8);

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `venta_id` int(11) DEFAULT NULL,
  `articulo_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `venta_id`, `articulo_id`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 3, 2, 1000.99),
(2, 1, 4, 1, 25.00),
(3, 2, 5, 35, 4.00),
(4, 2, 5, 35, 4.00),
(5, 3, 3, 8, 1000.99),
(6, 4, 1, 3, 1.99),
(7, 5, 1, 2, 1.99),
(8, 6, 1, 2, 1.99),
(9, 7, 7, 1, 20.00),
(10, 8, 7, 1, 20.00),
(11, 9, 3, 1, 1000.99),
(12, 10, 2, 1, 0.99),
(13, 11, 4, 2, 25.00),
(14, 12, 2, 5, 0.99),
(15, 13, 1, 1, 1.99),
(16, 14, 2, 1, 0.99),
(17, 15, 3, 3, 1000.99),
(18, 16, 3, 1, 1000.99),
(19, 16, 5, 2, 4.00),
(20, 17, 3, 1, 1000.99),
(21, 17, 3, 1, 1000.99),
(22, 17, 3, 1, 1000.99),
(23, 17, 1, 1, 1.99);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `es_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `password`, `es_admin`, `created_at`) VALUES
(8, 'Pastor perez', 'admin', '12345', 1, '2025-06-01 17:07:04'),
(9, 'Fabian dacal', 'fdmini', 'fabiandacal', 0, '2025-06-24 23:49:15'),
(10, 'fabian', 'admin2', '$2y$10$iBch1EIsazEMJ08NoKt5ButCs2NJt.pvrshgTgk/Sw9uj85by2Ucu', 1, '2025-06-25 15:11:57'),
(11, 'susej viscaya', 'susana', '$2y$10$epQ4k/cyqNh/gZKWdssrMeoYEOwqVwKqu5UnURQ.NqafgXWGk0nUW', 1, '2025-06-25 15:12:30'),
(12, 'cristiano ronaldo', 'ronaldo', '$2y$10$IMP07hIZaKU7I19QobHA3ucIKwmvFPbFvO5xjB2EHaP4rPLwwpMiS', 0, '2025-06-25 18:47:58'),
(13, 'arianny peña', 'admin0', '$2y$10$yKqq07R3VbMurt09In/kJetHbKz9vMAuGHT/WvIjDzEGJgGPlCere', 1, '2025-06-25 18:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `cliente` varchar(100) DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `cliente`, `cedula`, `total`, `usuario_id`) VALUES
(1, '2025-06-25 20:03:53', 'fabiola', NULL, 2026.98, 8),
(2, '2025-06-25 20:37:21', 'fabiola', NULL, 280.00, 8),
(3, '2025-06-25 20:39:42', 'fabiola', NULL, 8007.92, 8),
(4, '2025-06-25 20:41:03', 'fabiola', NULL, 5.97, 8),
(5, '2025-06-25 20:42:44', 'fabiola', NULL, 3.98, 8),
(6, '2025-06-25 20:43:16', 'fabiola', NULL, 3.98, 8),
(7, '2025-06-25 20:45:28', 'fabiola', NULL, 20.00, 8),
(8, '2025-06-25 20:55:12', 'fabiola', NULL, 20.00, 8),
(9, '2025-06-25 21:00:19', 'fabiola', NULL, 1000.99, 8),
(10, '2025-06-25 21:00:39', 'fabiola', NULL, 0.99, 8),
(11, '2025-06-25 21:05:04', 'fabiola', NULL, 50.00, 8),
(12, '2025-06-25 21:17:05', 'fabiola', NULL, 4.95, 8),
(13, '2025-06-25 21:17:54', 'sasa', NULL, 1.99, 8),
(14, '2025-06-25 21:26:21', 'fabiola', NULL, 0.99, 8),
(15, '2025-06-26 11:00:18', 'aa', NULL, 3002.97, 8),
(16, '2025-06-26 11:09:46', 'fabiola', NULL, 1008.99, 8),
(17, '2025-06-26 11:19:04', 'fabiola', '31221679', 3004.96, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
