-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 08:19 AM
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
-- Table structure for table `saimtech_location`
--

CREATE TABLE `saimtech_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(30) NOT NULL,
  `location_city` varchar(30) NOT NULL,
  `location_country` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_location`
--

INSERT INTO `saimtech_location` (`location_id`, `location_name`, `location_city`, `location_country`, `is_active`, `created_at`) VALUES
(1, 'LW12', 'Lakha', 'Morocco', 1, '2023-10-27 10:30:50'),
(2, 'ISM', 'Islamabad', 'Pakistan', 1, '2023-10-27 11:07:19'),
(3, 'Test', 'Ahmed Nager', 'Pakistan', 1, '2023-10-27 11:11:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_location`
--
ALTER TABLE `saimtech_location`
  ADD PRIMARY KEY (`location_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_location`
--
ALTER TABLE `saimtech_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
