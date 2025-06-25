-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 25, 2025 at 09:14 PM
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
(1, '7777', 'siu', 'cr7', 1.99, 7),
(2, '101010', 'messi', 'messiee', 0.99, 10),
(3, '6666', 'bomba nuclear', 'kaboom', 1000.99, 11),
(4, '9999', 'calculadora', 'para salvar la materia', 25.00, 100),
(5, '1234', 'sasa', 'dafwef', 4.00, 40),
(7, '12', 'tyjtyj', 'gertgeg', 20.00, 10);

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
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
