-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 03:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retail`
--

-- --------------------------------------------------------

--
-- Table structure for table `saimtech_attachments`
--

CREATE TABLE `saimtech_attachments` (
  `attachment_id` int(11) NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `rec_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `attach_desc` text NOT NULL DEFAULT '',
  `file` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saimtech_attachments`
--

INSERT INTO `saimtech_attachments` (`attachment_id`, `table_name`, `rec_id`, `name`, `attach_desc`, `file`, `created_at`) VALUES
(3, 'saimtech_product', 35, '', '', 'product/1698491981_d9932275777b747ceccc.jpg', '2023-10-28 16:19:41'),
(9, 'saimtech_product', 1, '', '', 'product/1699182167_62f0d5aacf101b895211.jpg', '2023-11-05 16:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `saimtech_attachments`
--
ALTER TABLE `saimtech_attachments`
  ADD PRIMARY KEY (`attachment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saimtech_attachments`
--
ALTER TABLE `saimtech_attachments`
  MODIFY `attachment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
