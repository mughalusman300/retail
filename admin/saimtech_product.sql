-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 11:04 AM
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
-- Table structure for table `saimtech_product`
--

CREATE TABLE `saimtech_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(200) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `product_desc` varchar(300) NOT NULL,
  `v1` varchar(50) NOT NULL DEFAULT '',
  `v2` varchar(50) NOT NULL DEFAULT '',
  `v3` varchar(50) NOT NULL DEFAULT '',
  `inv_unit` varchar(50) NOT NULL,
  `purch_unit` varchar(50) NOT NULL,
  `sale_unit` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keywords` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_product`
--

INSERT INTO `saimtech_product` (`product_id`, `product_name`, `product_code`, `product_img`, `category_id`, `group_id`, `product_desc`, `v1`, `v2`, `v3`, `inv_unit`, `purch_unit`, `sale_unit`, `is_active`, `is_deleted`, `created_at`, `updated_at`, `keywords`) VALUES
(1, 'Iphone 12 pro', 'Iph-12', 'product/product-1.png', 1, 1, 'Iphone 12 pro blue color', 'Size', 'Color', 'Other', 'MM', 'KG', 'LM', 0, 1, '2023-07-09 00:53:50', '2023-10-26 07:40:59', 'phone,mobile,iphone'),
(2, 'Laptope', 'lp-12', 'product/laptope.png', 1, 1, 'laptope', '', '', '', '', '', '', 1, 1, '2023-07-09 00:53:50', '2023-10-10 06:38:08', ''),
(30, 'Iphone 12 pro test', 'IPH-12TEST', 'product/1698309685_f1d293bbbbcd24082776.png', 1, 1, 'Iphone 12 pro blue color test', 'Size', 'Color', 'Other', 'MM', 'KG', 'LM', 1, 1, '2023-10-26 13:41:25', '2023-10-26 08:41:25', 'phone,mobile,iphone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_product`
--
ALTER TABLE `saimtech_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_product`
--
ALTER TABLE `saimtech_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
