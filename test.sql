-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 05:29 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `saimtech_category`
--

CREATE TABLE `saimtech_category` (
  `category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `desc` varchar(200) NOT NULL,
  `code` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_category`
--

INSERT INTO `saimtech_category` (`category_id`, `title`, `desc`, `code`, `is_active`, `created_at`) VALUES
(1, 'Electronics', 'none', 'ELE-123', 1, '2023-06-27 15:29:59'),
(2, 'test', 'none', 'TEST-123', 1, '2023-06-27 15:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `saimtech_users`
--

CREATE TABLE `saimtech_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `power` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_enable` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_users`
--

INSERT INTO `saimtech_users` (`id`, `name`, `email`, `power`, `password`, `is_enable`, `created_at`) VALUES
(1, 'usman', 'mughalusman@gmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2023-06-27 15:28:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_category`
--
ALTER TABLE `saimtech_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `saimtech_users`
--
ALTER TABLE `saimtech_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_category`
--
ALTER TABLE `saimtech_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saimtech_users`
--
ALTER TABLE `saimtech_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
