-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 10:20 AM
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
(1, 1, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:43:27', '2023-07-04 08:53:41', ''),
(2, 3, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:47:57', '2023-07-04 08:53:37', ''),
(3, 3, 2, 2, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:47:59', '2023-07-04 08:52:02', ''),
(4, 3, 2, 3, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:48:01', '2023-07-04 08:51:58', ''),
(5, 3, 2, 3, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:48:05', '2023-07-04 08:51:55', ''),
(6, 3, 2, 4, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:48:13', '2023-07-04 08:51:50', 'กรุงไทย'),
(7, 2, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:27', '2023-07-04 08:51:43', ''),
(8, 2, 2, 2, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:29', '2023-07-04 08:51:39', ''),
(9, 2, 2, 3, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:31', '2023-07-04 08:51:35', ''),
(10, 2, 1, 4, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:35', '2023-07-04 09:06:59', '11111'),
(11, 2, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:37', '2023-07-04 09:01:21', ''),
(12, 2, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 08:50:39', '2023-07-04 09:01:16', ''),
(13, 2, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 09:00:57', '2023-07-04 09:06:34', ''),
(14, 1, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 09:12:17', '2023-07-04 14:17:18', ''),
(15, 1, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-04 09:24:11', '2023-07-04 15:17:40', ''),
(17, 1, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-05 14:33:16', '2023-07-05 14:33:31', ''),
(18, 1, 1, 4, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-05 14:47:32', '2023-07-05 15:19:32', 'fg'),
(19, 1, 2, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-06 11:43:27', '2023-07-10 10:33:24', ''),
(20, 1, 2, 2, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-06 11:43:34', '2023-07-10 10:33:21', ''),
(21, 3, 1, 1, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-06 13:39:58', '2023-07-10 10:32:07', ''),
(22, 3, 1, 2, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-06 13:40:00', '2023-07-10 10:32:12', ''),
(23, 3, 2, 3, 'ดำเนินการเสร็จเรียบร้อย', '2023-07-06 13:40:08', '2023-07-10 10:33:18', '');

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
  `user_level` enum('admin','manager','user') DEFAULT 'user',
  `salary` decimal(10,2) DEFAULT NULL,
  `otherIncome` decimal(10,2) DEFAULT NULL,
  `maritalStatus` varchar(255) DEFAULT NULL,
  `staffType` enum('สายวิชาการ','สายสนับสนุน') NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `idCardNumber`, `password`, `nameTitle`, `fname`, `lname`, `position`, `affiliation`, `employmentContract`, `startDate`, `user_level`, `salary`, `otherIncome`, `maritalStatus`, `staffType`, `image`) VALUES
(1, '1450700222957', '$2y$10$lJgEHysRwY3G/jfsqtEj4uNl8noDs2COlrsYo0tCzxpVTCMN0qpyG', 'นาย', 'admin', 'นะจ้ะ', 'บุคลากร', 'ฝ่ายธุรการ', 'จ้างประจำ', '2023-01-10', 'admin', '10000.00', '10.00', 'โสด', 'สายสนับสนุน', '64a651969a12e.png'),
(2, '12345678910', '$2y$10$HaECQCs3..cc21z5eHad.e9R.Q8Em4XupJgRj1GOW/YFfREmFIrJu', 'นาย', 'ผู้บริหาร', 'ใจดีจัง', 'ผู้บริหาร', 'ฝ่ายธุรการ', 'พนักงานมหาวิทยาลัย', '2023-07-05', 'manager', '10000.00', '0.00', 'โสด', 'สายวิชาการ', '64ab7cef4c688.png'),
(3, '6227527818256', '$2y$10$EogAAxbsoH9Of0a.OA1xeuB3oHS73CCCHls6KBTaKmE/9EzMWiIy6', 'นางสาว', 'ใจดี', 'นะจ้ะ', 'บุคลากร', 'ฝ่ายสวัสดิการ', 'พนักงานมหาวิทยาลัย', '2023-02-01', 'user', '10000.00', '10000.00', 'โสด', 'สายวิชาการ', '64a52776bf9cd.png'),
(4, '9876543210', '$2y$10$7RIbBHHktHgc8N39q1.02ebt1YaSuBdM9wD634Wy6JbmzxyUpl7p2', 'นาย', 'ธนากร', 'นะจ้ะ', 'บุคลากร', 'ฝ่ายพัสดุ', 'พนักงานมหาวิทยาลัย', '2003-12-12', 'user', '10000.00', '0.00', 'โสด', 'สายวิชาการ', '64a51f2cf19f7.jpg');

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
  MODIFY `requestcertificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
