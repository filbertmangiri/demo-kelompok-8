-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2021 at 05:10 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_kelompok_8`
--

CREATE DATABASE `demo_kelompok_8`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` bit NOT NULL DEFAULT b'0',
  `is_admin` bit NOT NULL DEFAULT b'0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`email`, `username`, `password`, `first_name`, `last_name`, `birth_date`, `gender`, `is_admin`, `created_at`, `updated_at`, `deleted_at`) VALUES
('filbert.mangiri@student.umn.ac.id', 'filbertmangiri', '$2y$10$8oVDCcuvxpuZrryJtONsj.E4UCyb/DcOxs6Mr8fpwTP8C8p8O2i2i', 'Filbert', 'Mangiri', '2003-03-09', b'0', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('admin@kelompok8.com', 'admin', '$2y$10$uzHIJpUcQm1ciOfTsZq3WuazAydq61TPeoas1.W2pRibu9UPD0Gae', 'Admin', 'Admin', '2021-11-06', b'0', b'1', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('testing1@kelompok8.asd', 'testing1', '$2y$10$jYlP4FxBWeevwSAcskiWG.UQ6v6SUbNvhBY9YzIk4xbGbeT2CCsny', 'Testing', 'Satu', '2021-11-06', b'0', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('testing2@kelompok8.asd', 'testing2', '$2y$10$jYlP4FxBWeevwSAcskiWG.UQ6v6SUbNvhBY9YzIk4xbGbeT2CCsny', 'Testing', 'Dua', '2021-11-06', b'1', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('testing3@kelompok8.asd', 'testing3', '$2y$10$jYlP4FxBWeevwSAcskiWG.UQ6v6SUbNvhBY9YzIk4xbGbeT2CCsny', 'Testing', 'Tiga', '2021-11-06', b'0', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('testing4@kelompok8.asd', 'testing4', '$2y$10$jYlP4FxBWeevwSAcskiWG.UQ6v6SUbNvhBY9YzIk4xbGbeT2CCsny', 'Testing', 'Empat', '2021-11-06', b'1', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL),
('testing5@kelompok8.com', 'testing5', '$2y$10$jYlP4FxBWeevwSAcskiWG.UQ6v6SUbNvhBY9YzIk4xbGbeT2CCsny', 'Testing', 'Lima', '2021-11-06', b'1', b'0', '2021-11-06 23:31:55', '2021-11-06 23:31:55', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
