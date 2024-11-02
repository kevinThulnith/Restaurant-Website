-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2024 at 01:02 PM
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
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_Id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `food_sts` tinyint(4) NOT NULL DEFAULT 1,
  `image` longblob NOT NULL,
  `cousin` enum('Sri Lankan','Chinese','Italian','Indian','French','Korean') NOT NULL,
  `food_type` int(11) DEFAULT NULL,
  `score` int(11) NOT NULL DEFAULT 0 COMMENT 'number of times bought or coocked'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food type`
--

CREATE TABLE `food type` (
  `type_Id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer` int(5) DEFAULT NULL,
  `order_table` int(11) DEFAULT NULL,
  `time_stamp` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','ready to pickup','completed','cancelled') NOT NULL DEFAULT 'pending',
  `type` enum('online','physical','','') NOT NULL DEFAULT 'online'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `menu_item` int(5) NOT NULL,
  `amount` int(5) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resavation_table`
--

CREATE TABLE `resavation_table` (
  `resavatio_table_id` int(5) NOT NULL,
  `resavation` int(5) NOT NULL,
  `reserved_table` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(5) NOT NULL,
  `number_of_people` int(3) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `user` int(5) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `resavaton_type` int(11) NOT NULL,
  `status` enum('pending','confirmed','canceled','completed') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rstrnt_table`
--

CREATE TABLE `rstrnt_table` (
  `table_id` int(3) NOT NULL,
  `table_no` varchar(10) NOT NULL,
  `table type` int(11) DEFAULT NULL,
  `table state` enum('free','in use') DEFAULT 'free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table types`
--

CREATE TABLE `table types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `dob` date NOT NULL DEFAULT '2000-02-20',
  `username` varchar(18) NOT NULL,
  `password` varchar(18) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(18) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_staff` tinyint(1) NOT NULL DEFAULT 0,
  `is_customer` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_Id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `image` (`image`) USING HASH,
  ADD KEY `food_type` (`food_type`);

--
-- Indexes for table `food type`
--
ALTER TABLE `food type`
  ADD PRIMARY KEY (`type_Id`),
  ADD UNIQUE KEY `name_type` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user` (`customer`),
  ADD KEY `ordder_table` (`order_table`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_item` (`menu_item`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `resavation_table`
--
ALTER TABLE `resavation_table`
  ADD PRIMARY KEY (`resavatio_table_id`),
  ADD KEY `resaavtion` (`resavation`),
  ADD KEY `reserved_table` (`reserved_table`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `customer` (`user`),
  ADD KEY `resavation_type` (`resavaton_type`);

--
-- Indexes for table `rstrnt_table`
--
ALTER TABLE `rstrnt_table`
  ADD PRIMARY KEY (`table_id`),
  ADD UNIQUE KEY `table_no` (`table_no`),
  ADD KEY `table type` (`table type`);

--
-- Indexes for table `table types`
--
ALTER TABLE `table types`
  ADD PRIMARY KEY (`type_id`),
  ADD UNIQUE KEY `type_name` (`type_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_Id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food type`
--
ALTER TABLE `food type`
  MODIFY `type_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resavation_table`
--
ALTER TABLE `resavation_table`
  MODIFY `resavatio_table_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rstrnt_table`
--
ALTER TABLE `rstrnt_table`
  MODIFY `table_id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table types`
--
ALTER TABLE `table types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_type` FOREIGN KEY (`food_type`) REFERENCES `food type` (`type_Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordder_table` FOREIGN KEY (`order_table`) REFERENCES `rstrnt_table` (`table_id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`customer`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `menu_item` FOREIGN KEY (`menu_item`) REFERENCES `food` (`food_Id`),
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `resavation_table`
--
ALTER TABLE `resavation_table`
  ADD CONSTRAINT `resaavtion` FOREIGN KEY (`resavation`) REFERENCES `reservation` (`reservation_id`),
  ADD CONSTRAINT `resavation_table_ibfk_1` FOREIGN KEY (`reserved_table`) REFERENCES `rstrnt_table` (`table_id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `customer` FOREIGN KEY (`user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `resavation_type` FOREIGN KEY (`resavaton_type`) REFERENCES `table types` (`type_id`);

--
-- Constraints for table `rstrnt_table`
--
ALTER TABLE `rstrnt_table`
  ADD CONSTRAINT `table type` FOREIGN KEY (`table type`) REFERENCES `table types` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
