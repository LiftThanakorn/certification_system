-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 08:38 AM
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

--
-- Dumping data for table `requestcertificate`
--

INSERT INTO `requestcertificate` (`requestcertificate_id`, `user_id`, `approver_id`, `certificate_type_id`, `status`, `request_date`, `update_date`, `additional_data`) VALUES
(1, 3, 1, 1, 'รอดำเนินการ', '2023-06-28 14:06:54', '2023-06-29 10:48:53', ''),
(2, 2, 1, 1, 'กำลังดำเนินการ', '2023-06-28 14:12:13', '2023-06-29 11:12:32', ''),
(3, 1, 1, 4, 'ดำเนินการเสร็จเรียบร้อย', '2023-06-28 15:12:22', '2023-06-29 11:48:49', 'เทสจ้า'),
(4, 1, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-06-29 11:31:39', '2023-06-29 13:24:01', ''),
(5, 1, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-06-29 11:31:40', '2023-06-29 13:24:07', ''),
(6, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:42', '2023-06-29 11:31:42', ''),
(7, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:44', '2023-06-29 11:31:44', ''),
(8, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:45', '2023-06-29 11:31:45', ''),
(9, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:47', '2023-06-29 11:31:47', ''),
(10, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:49', '2023-06-29 11:31:49', ''),
(11, 1, NULL, 1, 'รอดำเนินการ', '2023-06-29 11:31:52', '2023-06-29 11:31:52', '');

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
(1, '1450700222957', '$2y$10$Bn2mhhRYp2aS4mIZD2BkG..pZAx2utJpC4AxklvGogww.ICsuKvda', 'นาย', 'admin', 'admin', 'บุคลากร', 'การเจ้าหน้าที่', 'สัญญาจ้างชั่วคราว', '2023-06-08', 'แอดมิน', '90000.00', '10000.00', 'โสด'),
(2, '12345678910', '$2y$10$WLM..GEuLmMLYmWvDnkjs.UWElxZkqET6vEZWCBSGjvL13Rbk6T7W', 'นาย', 'ผู้บริหาร', 'ผู้บริหาร', 'ผู้บริหาร', 'ผู้บริหาร', 'สัญญาจ้างชั่วคราว', '2019-02-28', 'ผู้บริหาร', '90000.00', '15000.00', 'โสด'),
(3, '6227527818256', '$2y$10$VD4U/kTo/FhL559zDJ1yL.FgqM.4p1c40oJBhVG/lCWgl2GqWFDuq', 'นางสาว', 'piyapun', 'piyapun', 'เจ้าหน้าที่บริหารงานทั่วไป', 'การเจ้าหน้าที่', 'สัญญาจ้างชั่วคราว', '2023-06-09', 'ผู้ใช้ทั่วไป', '90000.00', '10000.00', 'โสด');

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
  MODIFY `requestcertificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
