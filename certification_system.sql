-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2023 at 08:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `certification_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificate_categories`
--

CREATE TABLE `certificate_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `certificate_categories`
--

INSERT INTO `certificate_categories` (`category_id`, `category_name`) VALUES
(1, 'หนังสือรับรองเงินเดือน'),
(2, 'หนังสือรับรองการปฏิบัติงาน'),
(3, 'หนังสือรับรองสถานภาพโสด'),
(4, 'หนังสือรับรองอื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `requestcertificate`
--

CREATE TABLE `requestcertificate` (
  `requestcertificate_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'รอดำเนินการ',
  `request_date` datetime DEFAULT current_timestamp(),
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `requestcertificate`
--

INSERT INTO `requestcertificate` (`requestcertificate_id`, `user_id`, `status`, `request_date`, `update_date`, `category_id`) VALUES
(0, 8, 'รอดำเนินการ', '2023-06-22 01:37:15', '2023-06-21 18:37:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `idCardNumber` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nameTitle` enum('นาย','นางสาว','นาง') NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `affiliation` varchar(100) NOT NULL,
  `employmentContract` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `user_level` enum('ผู้ใช้ทั่วไป','ผู้บริหาร','แอดมิน') DEFAULT 'ผู้ใช้ทั่วไป',
  `salary` decimal(10,2) DEFAULT NULL,
  `otherIncome` decimal(10,2) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `idCardNumber`, `password`, `nameTitle`, `fname`, `lname`, `position`, `affiliation`, `employmentContract`, `startDate`, `user_level`, `salary`, `otherIncome`, `maritalStatus`) VALUES
(7, '1450700222957', '$2y$10$10CK76G6ABb1Gwgx2daP2uIB3MbD7UfDuAEfkqL10GTP2fsrYaAcC', 'นาย', 'admin', 'admin', 'บุคลากร', 'การเจ้าหน้าที่', 'สัญญาจ้างชั่วคราว', '0000-00-00', 'แอดมิน', '43000.00', '10000.00', 'โสด'),
(8, '12345678910', '$2y$10$LW/VSbzPrrMuSulo9zmynOCW7G9N00L8W.zP34mmAT20Qk7oLgn9i', 'นาย', 'ธนากร', 'อินทพันธ์', 'บุคลากร', 'การเจ้าหน้าที่', 'สัญญาจ้างชั่วคราว', '0000-00-00', 'ผู้ใช้ทั่วไป', '10000.00', '10000.00', 'โสด');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_categories`
--
ALTER TABLE `certificate_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `requestcertificate`
--
ALTER TABLE `requestcertificate`
  ADD PRIMARY KEY (`requestcertificate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `idCardNumber` (`idCardNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_categories`
--
ALTER TABLE `certificate_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
