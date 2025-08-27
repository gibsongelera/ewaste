-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 05:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_code` varchar(100) NOT NULL,
  `login_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `who` int(11) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `collection_date` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `transaction_status` int(11) NOT NULL,
  `lat` varchar(32) DEFAULT NULL,
  `lng` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_code`, `login_id`, `name`, `email`, `phone`, `location`, `who`, `date_created`, `collection_date`, `description`, `transaction_total`, `payment_status`, `transaction_status`, `lat`, `lng`) VALUES
(1, 'E31E68', 2, 'Gibson Gelera', 'gibsongelera@gmail.com', '09166119231', 'San Roque, feleciano street', 1, '1754323200', '1754323200', 'basura', 0, 0, 0, NULL, NULL),
(2, 'FD2B39', 2, 'Gibson Gelera', 'gibsongelera@gmail.com', '9166119231', 'San Roque, feleciano street', 1, '1754323200', '1754323200', 'basura', 0, 0, 0, NULL, NULL),
(3, '3E667D', 2, 'Gibson Gelera', 'gibsongelera@gmail.com', '12124', 'W368+F45, Don Navarro St, Zamboanga City, Zamboanga del Sur, Philippines', 1, '1754323200', '1754323200', 'wewe', 0, 0, 0, NULL, NULL),
(4, '19757C', 2, 'Gibson Gelera', 'gibsongelera@gmail.com', '9166119231', 'W2HW+7VP, San Roque Rd, Zamboanga City, Zamboanga del Sur, Philippines', 1, '1754323200', '1754323200', 'sdfaf', 0, 0, 0, NULL, NULL),
(5, 'C57674', 2, 'Gibson Gelera', 'gibsongelera@gmail.com', '9552100432', 'W2CR+3WF, Zamboanga City, Zamboanga del Sur, Philippines', 1, '1754323200', '1754323200', 'dsfs', 0, 0, 0, NULL, NULL),
(6, '98385C', 2, 'Gibson Gelerafd', 'gibsongelera@gmail.com', '6391661192', 'W377+7VW, Zamboanga City, Zamboanga del Sur, Philippines', 1, '1754323200', '1754323200', 'sfsf', 0, 0, 0, '6.913244195390309', '122.06479502105712');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
