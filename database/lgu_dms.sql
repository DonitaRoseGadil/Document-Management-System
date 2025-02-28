-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 06:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lgu_dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`) VALUES
(2, 'test@test.com', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa'),
(3, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE `history_log` (
  `id` int(11) NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history_log`
--

INSERT INTO `history_log` (`id`, `action`, `file_type`, `file_id`, `title`, `timestamp`) VALUES
(1, 'Created', 'Minutes', 3, 'dd', '2025-02-27 01:34:45'),
(2, 'Created', 'Resolution', 0, 'TEST 1', '2025-02-28 01:51:45'),
(3, 'Created', 'Ordinance', 6, 'TEST 1', '2025-02-28 02:27:05'),
(4, 'Created', 'Ordinance', 7, 'TEST 2', '2025-02-28 02:50:36'),
(5, 'Created', 'Ordinance', 8, 'TEST 3', '2025-02-28 03:04:01'),
(6, 'Created', 'Resolution', 9, 'TEST 4', '2025-02-28 03:09:45'),
(7, 'Deleted', 'Resolution', 6, '', '2025-02-28 04:36:19'),
(8, 'Deleted', 'Resolution', 7, '', '2025-02-28 04:36:32'),
(9, 'Deleted', 'Minutes', 3, '', '2025-02-28 04:36:46'),
(10, 'Deleted', 'Resolution', 8, '', '2025-02-28 04:37:15'),
(11, 'Created', 'Resolution', 10, 'TEST 5', '2025-02-28 04:37:55');

-- --------------------------------------------------------

--
-- Table structure for table `minutes`
--

CREATE TABLE `minutes` (
  `id` int(11) NOT NULL,
  `no_regSession` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `genAttachment` longblob NOT NULL,
  `resNo` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `attachment` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minutes`
--

INSERT INTO `minutes` (`id`, `no_regSession`, `date`, `genAttachment`, `resNo`, `title`, `type`, `status`, `attachment`) VALUES
(2, '9th Regular Session', '2025-02-24', '', 'Test1', 'Test1', 'Draft', 'Draft', 0x75706c6f6164732f32323830352d41727469636c652d3237373832312d312d31302d32303231313132372e706466);

-- --------------------------------------------------------

--
-- Table structure for table `ordinance`
--

CREATE TABLE `ordinance` (
  `id` int(10) NOT NULL,
  `mo_no` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_adopted` date NOT NULL,
  `author_sponsor` varchar(100) NOT NULL,
  `date_fwd` varchar(20) NOT NULL,
  `date_signed` date NOT NULL,
  `sp_approval` varchar(255) NOT NULL,
  `attachment` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordinance`
--

INSERT INTO `ordinance` (`id`, `mo_no`, `title`, `date_adopted`, `author_sponsor`, `date_fwd`, `date_signed`, `sp_approval`, `attachment`) VALUES
(10, 'MO1', '', '0000-00-00', '', '', '0000-00-00', '', ''),
(11, '9', 'as', '2025-02-12', 'Josevhel', '2025-02-28', '2025-02-22', 'Approved - Thru LCE', 0x75706c6f6164732f285041504552292050696c692d43616e617269756d2d4f766174756d2d50756c702d457874726163742d42696f2d426174746572792d4f706572617465642d506f7765722d42616e6b2e646f63782e706466);

-- --------------------------------------------------------

--
-- Table structure for table `resolution`
--

CREATE TABLE `resolution` (
  `id` int(10) NOT NULL,
  `reso_no` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `d_adopted` date NOT NULL,
  `author_sponsor` varchar(100) NOT NULL,
  `co_author` varchar(255) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `d_forward` date NOT NULL,
  `d_signed` date NOT NULL,
  `d_approved` date NOT NULL,
  `attachment` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `reso_no`, `title`, `descrip`, `d_adopted`, `author_sponsor`, `co_author`, `remarks`, `d_forward`, `d_signed`, `d_approved`, `attachment`) VALUES
(9, '050', 'TEST 4', 'eyyyyyyyy', '0000-00-00', 'Councilor: Angelo L. Calimlim & Dionnie P. Zabala', 'Josie', 'Forwarded to LCE', '2025-02-24', '0000-00-00', '0000-00-00', 0x75706c6f6164732f4c65747465725f6f665f456e646f7273656d656e742e706466),
(10, '055', 'TEST 5', 'eyyyyyyyyyyyy', '0000-00-00', 'Councilor: Angelo L. Calimlim & Dionnie P. Zabala', 'Josie', 'Signed by LCE', '2025-02-24', '2025-02-28', '0000-00-00', 0x75706c6f6164732f53686f72742d46696c6d2d44414c55594f4e472e706466);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_log`
--
ALTER TABLE `history_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minutes`
--
ALTER TABLE `minutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordinance`
--
ALTER TABLE `ordinance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resolution`
--
ALTER TABLE `resolution`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history_log`
--
ALTER TABLE `history_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `minutes`
--
ALTER TABLE `minutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordinance`
--
ALTER TABLE `ordinance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
