-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 02:37 PM
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
-- Table structure for table `saimtech_inventory_in`
--

DROP TABLE IF EXISTS `saimtech_inventory_in`;
CREATE TABLE `saimtech_inventory_in` (
  `inv_in_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `v1` varchar(60) NOT NULL DEFAULT '',
  `v2` varchar(60) NOT NULL DEFAULT '',
  `v3` varchar(60) NOT NULL DEFAULT '',
  `sale_qty` decimal(12,2) NOT NULL,
  `sale_unit_price` decimal(10,2) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_inventory_in`
--

INSERT INTO `saimtech_inventory_in` (`inv_in_id`, `product_id`, `v1`, `v2`, `v3`, `sale_qty`, `sale_unit_price`, `barcode`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(2, 2, '', '', '', '1500.00', '100.00', '653854123545', 1, 1, '2023-12-06 12:07:08', '2023-12-13 12:38:53'),
(3, 30, 'S', 'Red', '', '1000.00', '100.00', '853854333545', 1, 0, '2023-12-06 12:13:11', '2023-12-13 08:00:21'),
(4, 1, 'S', 'Red', 'other variant', '8000.00', '90.00', '253654123545', 1, 1, '2023-12-13 12:42:09', '2023-12-13 12:45:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_inventory_in`
--
ALTER TABLE `saimtech_inventory_in`
  ADD PRIMARY KEY (`inv_in_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_inventory_in`
--
ALTER TABLE `saimtech_inventory_in`
  MODIFY `inv_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
