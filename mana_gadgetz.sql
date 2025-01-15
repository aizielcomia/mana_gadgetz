-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 04:31 PM
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
-- Database: `mana_gadgetz`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `email`, `password`, `created_at`) VALUES
(1, 'Joy', 'Boy', 'ian@example.com', '$2y$10$KBhXGNuJNGXLb0uUPuKDIOEfbXUFlP0yDH6iRK2A2xRCrk6Vk3wfe', '2025-01-15 13:54:49'),
(2, 'Ian', 'Purificacion', 'ianp@example.com', '$2y$10$91WsXNaHv6EW1iMsEcP3u.sGQVaHwyTHO1Yxmx4Sbp/MA74pjGw9a', '2025-01-15 14:34:48'),
(3, 'Joy', 'Boy', 'supot@gmail.com', '$2y$10$5.Ja4qsBkDq4ma0cyL598eeykmyxGqkqJwkRQWIg8oyvHXCMVvhiO', '2025-01-15 14:38:41'),
(5, 'Joy', 'Boy', 'loidavelena@gmail.com', '$2y$10$ntg2qLDghxHI1BkpcuOEY.C7t2wWq2Owbb7oGDuCo.F6A7nP.9m4O', '2025-01-15 14:40:27'),
(6, 'Ian', 'Purificacion', 'iap@example.com', '$2y$10$sRIOXujB6s0ukfEPFJDyouZxdbr2yFka6QTixSNTsaGSuBTTkwOai', '2025-01-15 14:41:49'),
(7, 'Joy', 'Boy', 'i@example.com', '$2y$10$Z4Nftb6iD3RI6rYJ9fEqLu7XJW.I6MAmd8FHkHbSQOV1K9UJ4WXoa', '2025-01-15 14:42:36'),
(8, 'Joy', 'Boy', 'Admn@taplokal.com', '$2y$10$fLvrxXajdLeK4hlo9HRF9uzHZiptjLBXJEmnMtp1uts/4sAkTZyTm', '2025-01-15 14:45:58'),
(9, 'Joy', 'Boy', 'an@example.com', '$2y$10$LxZHsg7LudXwEYcUmPtL1.r7Fu6n6j0OuZ5XDwaPGghKF5xP.XbBS', '2025-01-15 14:52:59'),
(10, 'Ian', 'Purificacion', 'Ain@taplokal.com', '$2y$10$H4XOhzOTCQHvyvRz2wQituT6iGiAEHs076thP.3JVuFnx2P0pCkua', '2025-01-15 14:54:29'),
(11, 'Joy', 'Boy', 'dmin@taplokal.com', '$2y$10$BLs3uryohXk7zwpu1SWgKeq/Kr..e2Rii7YFiYY29QYbpfSdHavAS', '2025-01-15 15:07:25'),
(12, 'Joy', 'Boy', 'np@example.com', '$2y$10$vOk0mUmtJ83i/2MOM7VIFelzXDXU2kYBSn8IpCUScZOG3AYdLXGHS', '2025-01-15 15:14:33'),
(13, 'Ian', 'Purificacion', 'loidapucionvelena@gmail.com', '$2y$10$K6nN5.ZZCN2SeohAnRvkN.UrhwUrElIn.BUoeF7KKKmTSeBm4SPUO', '2025-01-15 15:14:55'),
(15, 'Joy', 'Boy', 'sacre2002@gmail.com', '$2y$10$k9K7kYgOvXZAG07DcrpmAu781MxsJgPl/4n.o8bfVZnHhZhDth28W', '2025-01-15 15:15:14'),
(17, 'Joy', 'Boy', 'in@taplokal.com', '$2y$10$gPEL5EJ6S1cVMhbJIUxPeu4tMnkWLTEausnI3doyw5Bf/bKW2NgbC', '2025-01-15 15:17:32'),
(18, 'fds', 'fsd', 'fsdfasdfasdf3e@gmail.com', '$2y$10$EjWSwoQlKWQaimlFia05n.QljpghimRDY08oamLJk9SQ6Oc3AgAh6', '2025-01-15 15:19:40'),
(19, 'Joy', 'Boy', 'iee@example.com', '$2y$10$Kw4BtkEVpUdSwMa73y6NSe3n9cBiKtxpZ7bqAeaJbMWU67YTMwASi', '2025-01-15 15:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `description`, `category`, `price`) VALUES
(1, 'uploads/404093159_1418227908762500_1152310742539312263_n.jpg', 'dfsfdfdsfdsfds', 'sdasd', NULL, 12121.00),
(2, 'uploads/WIN_20231125_19_11_21_Pro.jpg', 'SASAS', 'ASASA', NULL, 1232.00),
(3, 'uploads/WIN_20231126_13_01_16_Pro.jpg', 'IOHNE', 'fdsf', 'iphone15', 11212.00),
(4, 'uploads/OIP.jpeg', 'iPhone 15', 'It\'s an iPhone 15', 'iphone15', 1200.00),
(5, 'uploads/monalisa.jpg', 'Moanlisa', 'fsdfds', 'iphone12', 23232.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
