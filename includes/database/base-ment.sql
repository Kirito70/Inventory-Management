-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2018 at 02:00 PM
-- Server version: 5.7.20-log
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `base-ment`
--
CREATE DATABASE IF NOT EXISTS `base-ment` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `base-ment`;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_user_category`
--

CREATE TABLE IF NOT EXISTS `assigned_user_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_category_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_responsible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `User_Id_idx` (`user_id`),
  KEY `User_Category_ID_idx` (`user_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assigned_user_category`
--

INSERT INTO `assigned_user_category` (`id`, `user_category_id`, `user_id`, `user_responsible`) VALUES
(42, 5, 25, 0),
(43, 17, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `user_status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `user_status`) VALUES
(25, 'admin', 'admin', 'admin', 'm.tayyab9736@gmail.com', '$2y$10$bAeSNMCmpgB9xPSnfoV5TOrR5IZDptA6x0wE0c3JBKcxtQpFr7zxG', 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `user_category`
--

CREATE TABLE IF NOT EXISTS `user_category` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_description` varchar(500) NOT NULL,
  `status` binary(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='		';

--
-- Dumping data for table `user_category`
--

INSERT INTO `user_category` (`id`, `category_name`, `category_description`, `status`) VALUES
(5, 'Admin', 'Site Admin', 0x31),
(17, 'Store Keeper', 'Store Keeper to manage Store.', 0x31),
(18, 'Staff', 'This is category for staff to use items from inventory.', 0x31);

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE IF NOT EXISTS `user_images` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `image_name` varchar(500) DEFAULT NULL,
  `image_type` varchar(50) DEFAULT NULL,
  `size` int(10) UNSIGNED DEFAULT '0',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `User_Id_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_images`
--

INSERT INTO `user_images` (`id`, `image_name`, `image_type`, `size`, `user_id`) VALUES
(11, '11.jpg', 'jpg', 65087, 25);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_user_category`
--
ALTER TABLE `assigned_user_category`
  ADD CONSTRAINT `User_Category_ID_Key` FOREIGN KEY (`user_category_id`) REFERENCES `user_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User_Id_Key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_images`
--
ALTER TABLE `user_images`
  ADD CONSTRAINT `User_Id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
