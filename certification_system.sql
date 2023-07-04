-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 11:25 AM
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
-- Table structure for table `certificate_type`
--

CREATE TABLE `certificate_type` (
  `certificate_type_id` int(11) NOT NULL,
  `certificate_type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `certificate_type`
--

INSERT INTO `certificate_type` (`certificate_type_id`, `certificate_type_name`) VALUES
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
  `user_id` int(11) NOT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `certificate_type_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `request_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `additional_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `maritalStatus` varchar(255) DEFAULT NULL,
  `staffType` enum('สายวิชาการ','สายสนับสนุน') NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_type`
--
ALTER TABLE `certificate_type`
  ADD PRIMARY KEY (`certificate_type_id`);

--
-- Indexes for table `requestcertificate`
--
ALTER TABLE `requestcertificate`
  ADD PRIMARY KEY (`requestcertificate_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `approver_id` (`approver_id`),
  ADD KEY `category_id` (`certificate_type_id`);

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
-- AUTO_INCREMENT for table `requestcertificate`
--
ALTER TABLE `requestcertificate`
  MODIFY `requestcertificate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requestcertificate`
--
ALTER TABLE `requestcertificate`
  ADD CONSTRAINT `requestcertificate_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `requestcertificate_ibfk_2` FOREIGN KEY (`approver_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `requestcertificate_ibfk_3` FOREIGN KEY (`certificate_type_id`) REFERENCES `certificate_type` (`certificate_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
