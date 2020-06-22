-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 05:06 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akash_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`id`, `first_name`, `last_name`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Akash', 'Shrimali', '', '2020-06-14 10:25:05', '2020-06-14 10:25:05'),
(2, 'John', 'Deo', '', '2020-06-14 20:04:36', '2020-06-14 20:04:36'),
(3, 'Deo', 'John', '', '2020-06-14 20:12:58', '2020-06-14 20:12:58'),
(4, 'Manoj', 'Vaghela', 'uploads/profile.jpg', '2020-06-14 20:23:05', '2020-06-14 20:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `isLogin` tinyint(1) NOT NULL DEFAULT 0,
  `isBlock` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `userid`, `role`, `email`, `password`, `isLogin`, `isBlock`) VALUES
(1, 1, 1, 'akashshrimali1995@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 0, 0),
(2, 2, 2, 'john@mailinator.com', 'f925916e2754e5e03f75dd58a5733251', 0, 0),
(3, 3, 2, 'deo@yopmail.com', 'f925916e2754e5e03f75dd58a5733251', 0, 0),
(4, 4, 3, 'manoj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_other`
--

CREATE TABLE `tbl_other` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_other`
--

INSERT INTO `tbl_other` (`id`, `role`, `permission`) VALUES
(1, 'Admin', 'Block Customer,Block Manager,Add Customer,Add Manager,Update Customer,Update Manager'),
(2, 'Manager', 'Block Customer'),
(3, 'Customer', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`),
  ADD KEY `userid` (`userid`) USING BTREE;

--
-- Indexes for table `tbl_other`
--
ALTER TABLE `tbl_other`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_other`
--
ALTER TABLE `tbl_other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `tbl_login_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tbl_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_login_ibfk_2` FOREIGN KEY (`role`) REFERENCES `tbl_other` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
