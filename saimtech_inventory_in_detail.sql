-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2023 at 02:38 PM
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
-- Table structure for table `saimtech_inventory_in_detail`
--

CREATE TABLE `saimtech_inventory_in_detail` (
  `inv_in_detail_id` int(11) NOT NULL,
  `inv_in_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `v1` varchar(60) NOT NULL DEFAULT '',
  `v2` varchar(60) NOT NULL DEFAULT '',
  `v3` varchar(60) NOT NULL DEFAULT '',
  `purch_qty` int(11) NOT NULL,
  `inv_qty` decimal(12,2) NOT NULL,
  `sale_qty` decimal(12,2) NOT NULL,
  `purch_total_price` decimal(10,2) NOT NULL,
  `purch_unit_cost` decimal(10,2) NOT NULL,
  `inv_unit_cost` decimal(10,2) NOT NULL,
  `sale_unit_cost` decimal(10,2) NOT NULL,
  `sale_unit_price` decimal(10,2) NOT NULL,
  `inv_in_desc` varchar(600) NOT NULL,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_inventory_in_detail`
--

INSERT INTO `saimtech_inventory_in_detail` (`inv_in_detail_id`, `inv_in_id`, `product_id`, `supplier_id`, `location_id`, `v1`, `v2`, `v3`, `purch_qty`, `inv_qty`, `sale_qty`, `purch_total_price`, `purch_unit_cost`, `inv_unit_cost`, `sale_unit_cost`, `sale_unit_price`, `inv_in_desc`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 1, 'S', 'Red', 'other variant', 5, '50.00', '750.00', '50000.00', '10000.00', '1000.00', '66.67', '100.00', 'sdf13', 0, '2023-12-06 11:59:20', '2023-12-13 07:59:54'),
(2, 0, 2, 1, 1, '', '', '', 1000, '1000.00', '5000.00', '100000.00', '100.00', '100.00', '20.00', '50.00', 'fsafasfd', 0, '2023-12-06 12:07:08', '2023-12-13 08:00:04'),
(3, 0, 30, 1, 1, 'S', 'Red', '', 1000, '1000.00', '1000.00', '50000.00', '50.00', '50.00', '50.00', '100.00', 'sdfsdf', 0, '2023-12-06 12:13:11', '2023-12-13 08:00:21'),
(4, 0, 1, 1, 1, 'S', 'Red', 'other variant', 10, '100.00', '1500.00', '60000.00', '6000.00', '600.00', '40.00', '60.00', 'sdfsdf', 0, '2023-12-13 12:42:09', '2023-12-13 07:42:09'),
(5, 0, 1, 1, 1, 'S', 'Red', 'other variant', 10, '100.00', '1500.00', '60000.00', '6000.00', '600.00', '40.00', '70.00', 'safsdf', 0, '2023-12-13 17:27:08', '2023-12-13 12:27:08'),
(6, 0, 1, 1, 1, 'S', 'Red', 'other variant', 5, '50.00', '750.00', '30000.00', '6000.00', '600.00', '40.00', '90.00', 'df', 0, '2023-12-13 17:45:59', '2023-12-13 12:45:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_inventory_in_detail`
--
ALTER TABLE `saimtech_inventory_in_detail`
  ADD PRIMARY KEY (`inv_in_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_inventory_in_detail`
--
ALTER TABLE `saimtech_inventory_in_detail`
  MODIFY `inv_in_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
