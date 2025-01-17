-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2025 at 08:21 PM
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
(19, 'Joy', 'Boy', 'iee@example.com', '$2y$10$Kw4BtkEVpUdSwMa73y6NSe3n9cBiKtxpZ7bqAeaJbMWU67YTMwASi', '2025-01-15 15:27:13'),
(20, 'aiziel', 'comia', 'aizielrosas@gmail.com', '$2y$10$l7LVuL2.Rsxq4pSUtGSXv.23ga5zZTmpy.IAJzct1OaXWykenn9Zi', '2025-01-17 03:41:16'),
(21, 'ian', 'ian', 'ian@gmail.com', '$2y$10$zvKa8MmSnoAI4wZl3PkM.ugJto8QG.0g/R7PxRTQscwd8MKHBHW/C', '2025-01-17 04:45:28'),
(23, 'aiziel', 'comia', 'comia@gmail.com', '$2y$10$1RQYkQ4KPfyEWrKFzG3bG.8Ex7BtPtqf132BOFvTMJv6wMptJfaoe', '2025-01-17 05:19:26'),
(24, 'aiziel', 'comia', 'nessa@gmail.com', '$2y$10$zuD8miWQrbwGlL71AwoWbO0OSr6nADpiDGrLadOOJ6fOKmuKipab.', '2025-01-17 05:21:47'),
(25, 'mark', 'gil cristobas', 'gray@gmail.com', '$2y$10$9qBwrm7JX4Nf8HMI59fx9Oh0TUr8s/BjzWNaIo0b18AkbjMprVvfS', '2025-01-17 05:27:18'),
(26, 'mark', 'gil cristobas', 'ay@gmail.com', '$2y$10$.DU/kHO/aFReJg5PbYVbMePx6.zNb/EigpG58KI4Hk56Y1RSUgfue', '2025-01-17 05:41:04'),
(27, 'Kups', 'Comia', 'kups@gmail.com', '$2y$10$wle/g4HGZ9f4JGacQNQsHO3eF3NIaiSoFRxM/P.byUOGe4rN1F/8q', '2025-01-17 06:02:42'),
(28, 'admin', 'admin', 'admin@managadgetz.com', '$2y$10$zFAKoqobV.GPDwTxHw1NW..VSSIdFHh4fUn6tWqWs5bmQUuOHhlgK', '2025-01-17 06:43:56'),
(29, 'tubol', 'kaba', 'tubol@gmail.com', '$2y$10$IYAtX6xdEf8nQDou2Br52uPoMY9WkuNbpa1hfYJjp3XAPFNGj3tJS', '2025-01-17 06:53:28'),
(30, 'aiziel', 'comia', 'aas@gmail.com', '$2y$10$W6QNkZEhf3bdJ4NBgRNLG.G4S7V4pFVEewEFrLpkF54ec85iKIA0a', '2025-01-17 06:57:46'),
(31, 'Joy', 'Boy', 'ian@e.com', '$2y$10$J4ZgB04Vr3gOUpajWMoofeC1jY7bK8P77NS.jfuqqEuueNN.S0Ns2', '2025-01-17 13:34:47'),
(32, 'Joy', 'Boy', 'l@example.com', '$2y$10$kn5WSFcnCUsijFL2aQZ1H.cPvcn3hlzj9Vmvx4VGRatKLS2/g.oka', '2025-01-17 16:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(25, 'uploads/[✔] unpredictable ; jaerosé.jpg', 'iPhone 11', '6.1\\\" Liquid Retina display, dual-camera, and A13 Bionic chip for a seamless experience.', 'iphone11', 400.00),
(26, 'uploads/Oportunidade Única_ Leilão da Receita Federal Oferece iPhone 12 por R$ 1 Mil! Saiba Como Participar_.jpg', 'iPhone 12', '6.1\\\" Super Retina HD display, dual-camera, and A14 Bionic chip for a faster and more powerful experience.', 'iphone12', 500.00),
(27, 'uploads/iPhone 14 pro Giveaway.jpg', 'iPhone 13', '6.1\\\" Super Retina HD display, advanced dual-camera, and A15 Bionic chip for a lightning-fast experience.', 'iphone13', 600.00),
(28, 'uploads/Apple iPhone 14 (128 GB) - purple.jpg', 'iPhone 14', '6.1\\\" Super Retina XDR display, upgraded dual-camera, and A16 Bionic chip for a smoother and more powerful experience.', 'iphone14', 700.00),
(29, 'uploads/Apple iPhone 15 Plus 512GB - Pink, MU1J3ZP_A Mobile Phone Handsets.jpg', 'iPhone 15', '6.1\\\" Super Retina XDR display, advanced quad-camera, and A17 Bionic chip for a faster and more immersive experience.', 'iphone15', 800.00),
(30, 'uploads/Pink iPhone 🩷.jpg', 'iPhone 16', '6.1\\\" Super Retina XDR display, cutting-edge quad-camera, and A18 Bionic chip for unparalleled performance and innovation.', 'iphone16', 900.00),
(33, 'uploads/iPhone 16 Pro Rose Pink ❤️ What are your thoughts….jpg', 'iPhone 16 Pro Max', '6.7\\\" Super Retina XDR display, revolutionary quad-camera, and A18 Bionic chip for exceptional power, speed, and photography capabilities.', 'iphone16', 1200.00);

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `product_id` (`product_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `accounts` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `accounts` (`email`) ON DELETE CASCADE,
  ADD CONSTRAINT `checkouts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
