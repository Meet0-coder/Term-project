-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 03, 2025 at 07:44 PM
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
-- Database: `eshop`
--
CREATE Database IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `eshop`;
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Vraj Gheewala', 'vrajgheewala771@gmail.com', '$2y$10$i2Z/u6U1x9NxtgHN/h9aU.fxz2Oxgi0E2PgpG6DdSn6THZdmXfZZu', '2025-03-24 20:09:16'),
(4, 'Vraj Gheewala', 'vgheewala@algomau.ca', '$2y$10$k.bc27YAvz1BZ4eRzMqLteBJzZ3eXDpRa1p.P9vbExIXqz72O5OF6', '2025-03-27 18:14:08'),
(10, 'Vraj Gheewala', 'vrajgheewala772@gmail.com', '$2y$10$bg67bPdRxoshIjCK7LeAzO8rDIQUN1FMjBbp8uFYxtNyOFDMWMudu', '2025-04-03 15:10:16'),
(11, 'meet', 'meet@gmail.com', '$2y$10$xxgNKWFvjOBbZNQP7WH5w.W0VacGPAJJ/Iu9Iov3LBGWH6iERfrwS', '2025-04-03 17:14:59'),
(12, 'aayushi', 'aayushi@gmail.com', '$2y$10$KVjYPo8e.AMcZ4wvyK90v.2Z74lJ4757jj3PNG/Gj2D1j.xE9kMQy', '2025-04-03 17:19:26'),
(13, 'feni', 'feni@gmail.com', '$2y$10$apqnYj0J16QIdNjtyY1e1eX9W8JgYTpX/QOKf26lFOGlf8ybxgOoO', '2025-04-03 17:19:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
