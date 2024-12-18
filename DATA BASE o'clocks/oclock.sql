-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 09:00 AM
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
-- Database: `oclock`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp(1) NOT NULL DEFAULT current_timestamp(1) ON UPDATE current_timestamp(1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'Paula', '12345', 'paulabnc04@gmail.com', '0000-00-00 00:00:00.0');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`, `price`, `total_price`) VALUES
(21, 2, 1, 1, '2024-12-16 23:06:52', 0.00, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `items_summary` text DEFAULT NULL,
  `total_items` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `email`, `phone`, `payment_method`, `total_price`, `status`, `created_at`, `updated_at`, `items_summary`, `total_items`) VALUES
(8, 2, 'ian david', 'Salvacion', 'davidrovician@gmail.com', '09205889114', 'Cash on Delivery', 1000.00, 'Pending', '2024-12-16 22:52:27', '2024-12-16 22:52:27', 'casio (x1)', 1),
(9, 3, 'Paula Bianca', 'Nagotgot', 'samanthamusa989@gmail.com', '09784516134', 'Cash on Delivery', 1000.00, 'Pending', '2024-12-16 23:43:54', '2024-12-17 01:11:10', 'casio (x1)', 1),
(10, 3, 'Sid Dione', 'Sorsogon', 'siddione@gmail.com', '09452897436', 'Cash on Delivery', 737732.00, 'Pending', '2024-12-17 04:25:49', '2024-12-17 04:25:49', 'Cartier Baignoire (x2), casio (x1)', 3),
(11, 3, 'Paula Bianca', 'Legazpi City', 'samanthamusa989@gmail.com', '09452897436', 'Cash on Delivery', 1302465.90, 'Cancelled', '2024-12-17 05:55:12', '2024-12-17 06:18:29', 'Cartier Baignoire (x1), Santos De Cartier Medium Watch (x2), Cartier Silver Delux Vintage (x1)', 4),
(12, 3, 'Aina', 'Masbate', 'paula@gmail.com', '09452897436', 'Cash on Delivery', 826140.95, 'To Deliver', '2024-12-17 05:57:35', '2024-12-17 06:23:49', 'Cartier Baignoire (x1), casio (x1), Santos De Cartier Medium Watch (x1)', 3),
(13, 3, 'Siopao', 'Korea', 'paula@gmail.com', '09452897436', 'Cash on Delivery', 1000.00, 'Pending', '2024-12-17 07:00:20', '2024-12-17 07:00:20', 'casio (x1)', 1),
(14, 3, 'Samantha', 'Camalig', 'samanthamusa989@gmail.com', '09452897436', 'Cash on Delivery', 1000.00, 'Pending', '2024-12-17 07:29:20', '2024-12-17 07:29:20', 'casio (x1)', 1),
(15, 3, 'Mina', 'Bong City', 'paulaaaa@gmail.com', '09452897436', 'Cash on Delivery', 632050.00, 'Pending', '2024-12-17 07:31:02', '2024-12-17 07:31:02', 'casio (x1), Rolex Oyster Perpetual (x3)', 4),
(16, 7, 'Paula Bianca', 'Manito', 'paula@gmail.com', '09452897436', 'Cash on Delivery', 1067780.95, 'Pending', '2024-12-17 07:54:04', '2024-12-17 07:54:04', 'Cartier Baignoire (x1), Santos De Cartier Medium Watch (x1), Casio Vintage (x1), Rolex Day Date-40 (x2), casio (x1)', 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(6, 8, 1, 1, 1000.00),
(7, 9, 1, 1, 1000.00),
(8, 10, 13, 2, 368366.00),
(9, 10, 1, 1, 1000.00),
(10, 11, 13, 1, 368366.00),
(11, 11, 12, 2, 456774.95),
(12, 11, 15, 1, 20550.00),
(13, 12, 13, 1, 368366.00),
(14, 12, 1, 1, 1000.00),
(15, 12, 12, 1, 456774.95),
(16, 13, 1, 1, 1000.00),
(17, 14, 1, 1, 1000.00),
(18, 15, 1, 1, 1000.00),
(19, 15, 20, 3, 210350.00),
(20, 16, 13, 1, 368366.00),
(21, 16, 12, 1, 456774.95),
(22, 16, 16, 1, 1080.00),
(23, 16, 17, 2, 120280.00),
(24, 16, 1, 1, 1000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `stock`) VALUES
(1, 'casio', 1000.00, 'casio6.jpg', 0),
(12, 'Santos De Cartier Medium Watch', 456774.95, 'prod1.jpg', 19),
(13, 'Cartier Baignoire', 368366.00, 'prod2.jpg', 9),
(14, 'Cartier Drive De Cartier', 200580.00, 'prod3.jpg', 10),
(15, 'Cartier Silver Delux Vintage', 20550.00, 'prod4.jpg', 12),
(16, 'Casio Vintage', 1080.00, 'prod5.jpg', 9),
(17, 'Rolex Day Date-40', 120280.00, 'prod6.jpg', 45),
(18, 'Rolex Milgauss', 130280.00, 'prod7.jpg', 20),
(19, 'Rolex Lady-Datejust', 220350.00, 'prod8.jpg', 10),
(20, 'Rolex Oyster Perpetual', 210350.00, 'prod9.jpg', 10),
(21, 'Cartier Ronde Louis Cartier', 175290.00, 'prod10.jpg', 23);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `zip_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `first_name`, `middle_name`, `last_name`, `user_name`, `email`, `password`, `address`, `created_at`, `updated_at`, `zip_code`) VALUES
(2, 'Rovic ian', 'santiago', 'david', 'iansdavid1', 'iandavid9923@gmail.com', '$2y$10$dZ0Gt0lqBzQG0ByY0KrM0eHhmrl.Y7jA85AcjkvhXGvlROEyOsnVC', 'Salvacion', '2024-12-13 01:26:01', '2024-12-16 07:02:29', '4501'),
(3, 'Samantha Mae', 'Alemania', 'Musa', 'sam', 'samanthamusa989@gmail.com', '$2y$10$H.ke2OWCo1ZYsRXdbOkBLu9E7AaBrfYql.HvBeAG.I7XYCiplH/G.', 'Gapo, Camalig,Albay', '2024-12-16 23:40:34', '2024-12-16 23:41:48', '4502'),
(7, 'Maria Cecilia', 'Baloloy', 'Dela Paz', 'cecil', 'bncxx04@gmail.com', '$2y$10$r24W1.5mLybMexM6zmMKVO4mpRQ9iFluccmDK2TRIS4K0QgHEhRou', 'Taysan, Legazpi City', '2024-12-17 07:48:18', '2024-12-17 07:48:18', '4512');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_account` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
