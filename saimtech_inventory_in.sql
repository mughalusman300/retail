-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2023 at 09:02 AM
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

CREATE TABLE `saimtech_inventory_in` (
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
  `barcode` varchar(100) NOT NULL,
  `inv_in_desc` varchar(600) NOT NULL,
  `created_by` int(11) NOT NULL,
  `update_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_inventory_in`
--

INSERT INTO `saimtech_inventory_in` (`inv_in_id`, `product_id`, `supplier_id`, `location_id`, `v1`, `v2`, `v3`, `purch_qty`, `inv_qty`, `sale_qty`, `purch_total_price`, `purch_unit_cost`, `inv_unit_cost`, `sale_unit_cost`, `sale_unit_price`, `barcode`, `inv_in_desc`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'S', 'Red', 'other variant', 5, '50.00', '750.00', '50000.00', '10000.00', '1000.00', '66.67', '100.00', 'sdf12313', 'sdf13', 1, 0, '2023-12-06 11:59:20', '2023-12-06 07:02:01'),
(2, 2, 1, 1, '', '', '', 1000, '1000.00', '5000.00', '100000.00', '100.00', '100.00', '20.00', '50.00', 'asdf4646', 'fsafasfd', 1, 0, '2023-12-06 12:07:08', '2023-12-06 07:07:08'),
(3, 30, 1, 1, 'S', 'Red', '', 1000, '1000.00', '1000.00', '50000.00', '50.00', '50.00', '50.00', '100.00', '123sdf464', 'sdfsdf', 1, 0, '2023-12-06 12:13:11', '2023-12-06 07:13:11');

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
  MODIFY `inv_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
