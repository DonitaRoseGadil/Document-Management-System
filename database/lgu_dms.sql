-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 06:54 AM
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
-- Database: `lgu_dms`
--

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
(1, '6th regular session', '2025-02-21', '', 'test1', 'test1', 'Draft', 'Approved', 0x75706c6f6164732f285041504552292050696c692d43616e617269756d2d4f766174756d2d50756c702d457874726163742d42696f2d426174746572792d4f706572617465642d506f7765722d42616e6b2e646f63782e706466),
(2, '6th regular session', '2025-02-28', 0x285041504552292050696c692d43616e617269756d2d4f766174756d2d50756c702d457874726163742d42696f2d426174746572792d4f706572617465642d506f7765722d42616e6b2e646f63782e706466, 'Test2', 'Test2', 'Information', 'Information', 0x28),
(3, '7th Regular Session', '2025-02-21', 0x28504150455229204164736f727074696f6e204361706162696c697479206f662054616c69736179205465726d696e616c696120436174617070612053656564204875736b2042696f6368617220666f722052656d6f76616c206f66204361646d69756d20696e20436f6e74616d696e617465642053796e746865746963205761746572202831292e706466, 'Test3', 'Test3', 'Referred to Committee', 'Referred to Committee', 0x5b),
(4, '7th Regular Session', '2025-02-21', 0x28504150455229204164736f727074696f6e204361706162696c697479206f662054616c69736179205465726d696e616c696120436174617070612053656564204875736b2042696f6368617220666f722052656d6f76616c206f66204361646d69756d20696e20436f6e74616d696e617465642053796e746865746963205761746572202831292e706466, 'Test4', 'Test4', 'Approved', 'Approved', 0x31),
(5, '7th Regular Session', '2025-02-25', 0x5f436c617373205363686564756c652e706466, 'Test5', 'Test5', 'Approved', 'Approved', 0x28);

-- --------------------------------------------------------

--
-- Table structure for table `ordinance`
--

CREATE TABLE `ordinance` (
  `id` int(10) NOT NULL,
  `mo_no` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `d_adopted` date NOT NULL,
  `author_sponsor` varchar(100) NOT NULL,
  `co_author` varchar(255) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `d_approved` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `d_approved` date NOT NULL,
  `attachment` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resolution`
--

INSERT INTO `resolution` (`id`, `reso_no`, `title`, `descrip`, `d_adopted`, `author_sponsor`, `co_author`, `remarks`, `d_approved`, `attachment`) VALUES
(1, '044', 'A Resolution Adopting an Ordinance Enacting the Integrated Zoning Ordinance (ZO) of the Municipality of Talisay, Camarines Norte', 'sdfghjkljhgfds', '2019-05-27', 'Mass Motion', '', '', '2019-03-29', NULL),
(3, '', 'Shuta ka', '', '0000-00-00', '', '', 'Draft', '0000-00-00', NULL),
(4, '', 'isakhdhjfbkb', '', '0000-00-00', '', '', 'Referred to Committe', '0000-00-00', NULL),
(5, '006', 'LGU TALISAY', 'shuta ka', '2025-02-13', 'Josevhel ', '', '', '2025-02-28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `minutes`
--
ALTER TABLE `minutes`
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
-- AUTO_INCREMENT for table `minutes`
--
ALTER TABLE `minutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resolution`
--
ALTER TABLE `resolution`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
