-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 11:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `Audit_id` int(10) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `type` varchar(10) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`Audit_id`, `user_name`, `type`, `date`) VALUES
(1, 'admin', 'admin', '2024-11-23 12:30:49'),
(2, 'rushi', 'client', '2024-11-23 12:32:47'),
(3, 'admin', 'admin', '2024-11-23 12:34:04'),
(4, 'rushi', 'client', '2024-11-23 13:58:42'),
(5, 'admin', 'admin', '2024-11-23 13:59:15'),
(6, 'vipul', 'user', '2024-11-23 14:28:56'),
(7, 'vipul', 'user', '2024-11-23 14:29:57'),
(8, 'vipul', 'user', '2024-11-23 14:50:58'),
(9, 'vipul', 'user', '2024-11-23 14:58:36'),
(10, 'admin', 'admin', '2024-11-23 14:58:57'),
(11, 'vipul', 'user', '2024-11-23 15:32:11'),
(12, 'vipul', 'user', '2024-11-23 15:32:50'),
(13, 'rushi', 'client', '2024-11-23 15:40:33'),
(14, 'vipul', 'user', '2024-11-23 15:42:12'),
(15, 'rushi', 'client', '2024-11-23 16:14:09'),
(16, 'rushi', 'client', '2024-11-23 16:19:24'),
(17, 'rushi', 'client', '2024-11-23 16:24:03'),
(18, 'harsh', 'user', '2024-11-23 16:42:07'),
(19, 'rushi', 'client', '2024-11-23 16:44:35'),
(20, 'vipul', 'user', '2024-11-24 04:17:13'),
(21, 'rushi', 'client', '2024-11-24 04:40:30'),
(22, 'vipul', 'user', '2024-11-25 06:47:24'),
(23, 'admin', 'admin', '2024-11-25 06:48:53'),
(24, 'admin', 'admin', '2024-11-25 07:07:40'),
(25, 'vipul', 'user', '2024-11-25 07:09:20'),
(26, 'vipul', 'user', '2024-11-25 07:10:10'),
(27, 'vipul', 'user', '2024-11-25 08:36:18'),
(28, 'admin', 'admin', '2024-11-25 08:37:09'),
(29, 'rushi', 'client', '2024-11-25 08:38:55'),
(30, 'vipul', 'user', '2024-11-25 08:51:20'),
(31, 'rushi', 'client', '2024-11-25 08:51:55'),
(32, 'vips', 'client', '2024-11-25 09:07:13'),
(33, 'rushi', 'client', '2024-11-25 09:21:19'),
(34, 'harsh', 'user', '2024-11-25 09:21:54'),
(35, 'rushi', 'client', '2024-11-25 09:22:50'),
(36, 'vipul', 'user', '2024-11-25 09:29:09'),
(37, 'vips', 'client', '2024-11-25 09:31:55'),
(38, 'rushi', 'client', '2024-11-25 09:32:30'),
(39, 'vipul', 'user', '2024-11-25 09:33:02'),
(40, 'vips', 'client', '2024-11-25 09:36:00'),
(41, 'vipul', 'user', '2024-11-25 09:50:29'),
(42, 'vips', 'user', '2024-11-25 09:51:12'),
(43, 'vips', 'client', '2024-11-25 09:51:20'),
(44, 'vips', 'client', '2024-11-25 09:58:27'),
(45, 'vipul', 'user', '2024-11-25 10:03:15'),
(46, 'vips', 'client', '2024-11-25 10:07:02'),
(47, 'harsh', 'user', '2024-11-25 10:07:24'),
(48, 'rushi', 'client', '2024-11-25 10:10:03'),
(49, 'rushi', 'client', '2024-11-25 10:59:58'),
(50, 'harsh', 'user', '2024-11-25 11:24:29'),
(51, 'vips', 'client', '2024-11-25 11:28:13'),
(52, 'vipul', 'user', '2024-11-25 11:35:30'),
(53, 'vips', 'client', '2024-11-25 11:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Id` int(11) NOT NULL,
  `u_name` varchar(50) NOT NULL,
  `u_pass` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `u_name`, `u_pass`, `Email`, `type`, `active`) VALUES
(1, 'vipul', '123', 'vipulkj608@gmail.com', 'user', 1),
(2, 'harsh', '321', 'harsh@gmail.com', 'user', 1),
(3, 'admin', 'admin', 'admin@gmail.com', 'admin', 1),
(4, 'rushi', 'r123', 'rushi1@gmail.com', 'client', 1),
(6, 'vips', '123', 'v@gmail.com', 'client', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 0, 'Your order with ID ORD17321903027840 has been confirmed.', 0, '2024-11-21 12:01:41'),
(4, 0, 'Your order with ID ORD17322037114592 has been confirmed.', 0, '2024-11-21 15:43:25'),
(5, 0, 'Your order with ID ORD17322037114592 has been confirmed.', 0, '2024-11-21 15:43:36'),
(6, 0, 'Your order with ID ORD17322037114592 has been confirmed.', 0, '2024-11-21 15:44:15'),
(7, 0, 'Your order with ID ORD17321903027840 has been confirmed.', 0, '2024-11-23 11:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `username`, `customer_name`, `item_name`, `from_location`, `to_location`, `quantity`, `order_date`, `user_id`) VALUES
('ORD17325141092640', 'vipul', 'vipul', 'milk', 'anand', 'nadiyad', 10, '2024-11-25 11:25:09', 1),
('ORD17325203093721', 'vipul', 'HARSH', 'milk', 'anand', 'jaipur', 100, '2024-11-25 13:08:29', 1),
('ORD17325229348413', 'harsh', 'bharat', 'kites', 'anand', 'bk', 100, '2024-11-25 13:52:14', 2),
('ORD17325233796645', 'vipul', 'het', 'books', 'anand', 'baroda', 1, '2024-11-25 13:59:39', 1),
('ORD17325233837784', 'vipul', 'het', 'books', 'anand', 'baroda', 1, '2024-11-25 13:59:43', 1),
('ORD17325256652278', 'harsh', 'ridham', 'clock', 'anand', 'nadiyad', 1, '2024-11-25 14:37:45', 2),
('ORD17325309488937', 'vipul', 'rushi', 'milk', 'anand', 'nadiyad', 10, '2024-11-25 16:05:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reactivation_requests`
--

CREATE TABLE `reactivation_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `requested_at` datetime DEFAULT current_timestamp(),
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reactivation_requests`
--

INSERT INTO `reactivation_requests` (`id`, `user_id`, `status`, `requested_at`, `reason`) VALUES
(2, 1, 'approved', '2024-11-23 19:22:58', 'yes'),
(6, 1, 'approved', '2024-11-25 11:19:26', 'yes'),
(7, 1, 'approved', '2024-11-25 11:39:48', 'please sir'),
(8, 1, 'approved', '2024-11-25 13:07:42', 'plzzz'),
(9, 1, 'approved', '2024-11-25 13:07:54', 'plzz');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `shipment_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `dealer_id` int(11) DEFAULT NULL,
  `dealer_name` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `from_location` varchar(255) NOT NULL,
  `to_location` varchar(255) NOT NULL,
  `shipment_date` datetime NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('Pending','Shipped','Delivered') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`shipment_id`, `order_id`, `username`, `dealer_id`, `dealer_name`, `customer_name`, `item_name`, `from_location`, `to_location`, `shipment_date`, `quantity`, `status`) VALUES
(11, 'ORD17325141092640', 'vipul', 6, '', 'vipul', 'milk', 'anand', 'nadiyad', '2024-11-25 11:25:09', 10, 'Shipped'),
(12, 'ORD17325203093721', 'vipul', 6, '', 'HARSH', 'milk', 'Chaklasi', 'jaipur', '2024-11-25 13:08:29', 100, 'Shipped'),
(13, 'ORD17325229348413', 'harsh', 4, '', 'bharat', 'kites', 'anand', 'bk', '2024-11-25 13:52:14', 100, 'Shipped'),
(14, 'ORD17325233796645', 'vipul', 4, '', 'het', 'books', 'vasad', 'baroda', '2024-11-25 13:59:39', 1, 'Shipped'),
(15, 'ORD17325233837784', 'vipul', 6, '', 'het', 'books', 'baroda', 'baroda', '2024-11-25 13:59:43', 1, 'Delivered'),
(16, 'ORD17325256652278', 'harsh', 4, 'rushi', 'ridham', 'clock', 'anand', 'nadiyad', '2024-11-25 14:37:45', 1, 'Pending'),
(17, 'ORD17325309488937', 'vipul', 6, 'vips', 'rushi', 'milk', 'anand', 'nadiyad', '2024-11-25 16:05:48', 10, 'Shipped');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`Audit_id`),
  ADD KEY `idx_user_name` (`user_name`),
  ADD KEY `idx_date` (`date`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `u_name` (`u_name`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Indexes for table `reactivation_requests`
--
ALTER TABLE `reactivation_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`shipment_id`),
  ADD KEY `fk` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `Audit_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reactivation_requests`
--
ALTER TABLE `reactivation_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `shipment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `fk_audit_user_name` FOREIGN KEY (`user_name`) REFERENCES `login` (`u_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `login` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `reactivation_requests`
--
ALTER TABLE `reactivation_requests`
  ADD CONSTRAINT `reactivation_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
