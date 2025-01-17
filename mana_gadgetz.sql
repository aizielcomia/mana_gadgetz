-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:4306
-- Generation Time: Jan 17, 2025 at 08:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(30, 'aiziel', 'comia', 'aas@gmail.com', '$2y$10$W6QNkZEhf3bdJ4NBgRNLG.G4S7V4pFVEewEFrLpkF54ec85iKIA0a', '2025-01-17 06:57:46');

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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_email`, `product_id`, `quantity`, `added_at`) VALUES
(17, 'kups@gmail.com', 10, 1, '2025-01-17 06:09:19'),
(18, 'kups@gmail.com', 10, 1, '2025-01-17 06:10:04'),
(19, 'kups@gmail.com', 10, 1, '2025-01-17 06:11:51'),
(20, 'kups@gmail.com', 10, 1, '2025-01-17 06:12:13'),
(21, 'kups@gmail.com', 10, 1, '2025-01-17 06:12:55'),
(22, 'kups@gmail.com', 10, 1, '2025-01-17 06:16:08');

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

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `user_email`, `product_id`, `quantity`, `price`, `order_date`) VALUES
(1, 'ay@gmail.com', 13, 1, 1200.00, '2025-01-17 06:01:17'),
(2, 'kups@gmail.com', 14, 1, 1200.00, '2025-01-17 06:03:10'),
(3, 'kups@gmail.com', 15, 1, 1200.00, '2025-01-17 06:06:09'),
(4, 'kups@gmail.com', 16, 1, 1200.00, '2025-01-17 06:06:29'),
(13, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:23:18'),
(14, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:23:18'),
(15, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:23:18'),
(22, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:36:26'),
(23, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:36:26'),
(24, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:36:26'),
(25, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:36:26'),
(26, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:38:35'),
(27, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:39:26'),
(28, 'aizielrosas@gmail.com', 10, 1, 1200.00, '2025-01-17 06:39:26'),
(29, 'aizielrosas@gmail.com', 16, 1, 1100.00, '2025-01-17 06:42:05'),
(30, 'aizielrosas@gmail.com', 15, 1, 1050.00, '2025-01-17 06:42:05'),
(31, 'aizielrosas@gmail.com', 14, 1, 800.00, '2025-01-17 06:42:05'),
(32, 'aizielrosas@gmail.com', 13, 1, 650.00, '2025-01-17 06:42:05'),
(33, 'aizielrosas@gmail.com', 12, 1, 500.00, '2025-01-17 06:42:05'),
(34, 'tubol@gmail.com', 10, 1, 1200.00, '2025-01-17 06:54:40'),
(35, 'tubol@gmail.com', 16, 1, 1100.00, '2025-01-17 06:54:40'),
(36, 'tubol@gmail.com', 15, 1, 1050.00, '2025-01-17 06:54:40'),
(37, 'tubol@gmail.com', 14, 1, 800.00, '2025-01-17 06:54:40'),
(38, 'tubol@gmail.com', 13, 1, 650.00, '2025-01-17 06:54:40'),
(39, 'tubol@gmail.com', 12, 1, 500.00, '2025-01-17 06:54:40'),
(40, 'aas@gmail.com', 12, 1, 500.00, '2025-01-17 06:58:15');

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
(10, 'uploads/Pink iPhone 🩷.jpg', 'iPhone 16', 'Elevate your mobile experience: iPhone 16\\\'s sleek design, cutting-edge tech, and seamless usability.', 'iphone16', 1200.00),
(12, 'uploads/[✔] unpredictable ; jaerosé.jpg', 'iPhone 11', 'Capture life\\\'s beauty with iPhone 11\\\'s pro-grade cameras, effortless usability, and cutting-edge tech.', 'iphone11', 500.00),
(13, 'uploads/Oportunidade Única_ Leilão da Receita Federal Oferece iPhone 12 por R$ 1 Mil! Saiba Como Participar_.jpg', 'iPhone 12', 'Elevate your mobile experience: iPhone 12\\\'s stunning OLED display, dual cameras, and A14 Bionic chip.', 'iphone12', 650.00),
(14, 'uploads/iPhone 14 pro Giveaway.jpg', 'iPhone 13', 'Experience seamless innovation: iPhone 13\\\'s efficient battery life, durable design and iOS elegance.', 'iphone13', 800.00),
(15, 'uploads/Apple iPhone 14 (128 GB) - purple.jpg', 'iPhone 14', 'Capture life\\\'s moments: iPhone 14\\\'s enhanced Portrait mode, Night mode and cinematic video.', 'iphone14', 1050.00),
(16, 'uploads/Apple iPhone 15 Plus 512GB - Pink, MU1J3ZP_A Mobile Phone Handsets.jpg', 'iPhone 15', 'Experience the future: iPhone 15\\\'s efficient battery, durable design and intuitive iOS.', 'iphone15', 1100.00);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
