-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 10:21 PM
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
-- Database: `charity`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proj_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `pay_meth_id` int(11) NOT NULL,
  `payment_plan_id` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sec_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `org_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `user_id`, `proj_id`, `amount`, `pay_meth_id`, `payment_plan_id`, `start_time`, `sec_name`, `email`, `address`, `phone`, `org_id`) VALUES
(20, 5, 21, 100, 2, 2, '2023-05-09 11:50:07', 'ahmed', 'donor@gmail.com', 'giza', '01153459875', 1),
(25, 5, 21, 5000, 2, 1, '2023-05-10 02:33:38', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(26, 5, 21, 5000, 2, 1, '2023-05-10 02:37:23', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(27, 5, 21, 5000, 2, 1, '2023-05-10 02:41:46', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(28, 5, 21, 5000, 2, 1, '2023-05-10 02:42:39', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(29, 5, 21, 5000, 2, 1, '2023-05-10 02:43:12', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(30, 5, 21, 5000, 2, 1, '2023-05-10 02:44:07', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(31, 5, 21, 5000, 2, 1, '2023-05-10 02:44:26', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(32, 5, 21, 5000, 2, 1, '2023-05-10 02:45:20', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(33, 5, 21, 5000, 2, 1, '2023-05-10 02:46:05', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '2121212131', 1),
(34, 5, 22, 3000, 1, 1, '2023-05-10 02:50:00', 'Ahmed Bassiouny', 'ahmedmbassiouni5@gmail.com', '6 شارع الشهيد محمود ', '345', 1);

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `id` int(11) NOT NULL,
  `total_amount` float NOT NULL,
  `points` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `donations_num` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`id`, `total_amount`, `points`, `user_id`, `donations_num`) VALUES
(1, 8100, 810, 5, 2),
(2, 10, 10, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `req_id`) VALUES
(14, 39);

-- --------------------------------------------------------

--
-- Table structure for table `event_req`
--

CREATE TABLE `event_req` (
  `id` int(11) NOT NULL,
  `name` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` varchar(50) NOT NULL,
  `information` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `location` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `state` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'waiting',
  `img_url` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_req`
--

INSERT INTO `event_req` (`id`, `name`, `time`, `information`, `location`, `state`, `img_url`, `org_id`) VALUES
(31, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(32, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(33, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(34, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(35, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(36, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(37, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(38, 'event', '2023-05-17', 'event_info', 'Cairo ', 'waiting', '../images/10-52-4706-22-465.jpg', 1),
(39, 'event', '2023-05-17', 'event_info', 'Cairo ', 'accepted', '../images/10-52-4706-22-465.jpg', 1),
(40, 'event', '2023-05-17', 'event_info', 'Cairo ', 'rejected', '../images/10-52-4706-22-465.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `discription` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `discription`, `user_id`, `email`) VALUES
(1, 'hi ', 3, 'org@.org'),
(2, 'ok', 5, 'donor@gmail.com'),
(3, '454646', 5, 'donor@gmail.com'),
(4, '454646', 5, 'donor@gmail.com'),
(5, '454646', 5, 'donor@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `no_of_project` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `name`, `no_of_project`) VALUES
(1, 'Donate To 57357', 0),
(2, 'orphan Guarantee', 0),
(3, 'Zakat Money', 0),
(4, 'satisfying guarantee', 0),
(5, '75375', 0),
(6, 'mersal', 0);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(11) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `account_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `address`, `user_id`, `account_no`) VALUES
(1, '88 street', 3, 12345);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`) VALUES
(1, 'visa'),
(2, 'Vodafone Cash ');

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE `payment_plan` (
  `id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `duration`, `name`) VALUES
(1, 3, '3_months '),
(2, 6, '6_months'),
(3, 9, '9_months'),
(4, 12, '12_months'),
(5, 18, '18_months');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `req_id`) VALUES
(23, 1),
(24, 2),
(26, 6),
(21, 9),
(22, 10),
(25, 11);

-- --------------------------------------------------------

--
-- Table structure for table `project_req`
--

CREATE TABLE `project_req` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `state` varchar(10) NOT NULL DEFAULT 'waiting',
  `org_id` int(11) NOT NULL,
  `proj_name` varchar(20) NOT NULL,
  `target_amount` float NOT NULL,
  `field_id` int(11) NOT NULL,
  `img_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_req`
--

INSERT INTO `project_req` (`id`, `description`, `state`, `org_id`, `proj_name`, `target_amount`, `field_id`, `img_url`) VALUES
(1, 'yyyyyyyyyy', 'accepted', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(2, 'yyyyyyyyyy', 'accepted', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(3, 'yyyyyyyyyy', 'rejected', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(4, 'yyyyyyyyyy', 'waiting', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(5, 'yyyyyyyyyy', 'waiting', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(6, 'yyyyyyyyyy', 'accepted', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(7, 'yyyyyyyyyy', 'rejected', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(8, 'yyyyyyyyyy', 'rejected', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(9, 'yyyyyyyyyy', 'accepted', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(10, 'yyyyyyyyyy', 'accepted', 1, 'project 2', 200, 2, '../images/03-15-4711-27-01bg_1.jpg'),
(11, 'proj', 'accepted', 1, 'proj', 1000, 4, '../images/09-13-15shuffle-04.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `vol_id` int(11) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `event_id`, `vol_id`, `phone_no`, `address`, `message`) VALUES
(1, 39, 1, '+2011260705', '٦شارع الشهيد محمود قرني', 'go to ....');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'organization');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `img_url` varchar(100) NOT NULL DEFAULT '../images/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_id`, `img_url`) VALUES
(3, 'org', 'org@gmail.org', 'org', 3, '../images/11-19-54skills-01.jpg'),
(4, 'Ahmed', 'absywny212@gmail.com', '11', 1, '../images/01-53-4301-50-41..images11-19-54skills-01.jpg'),
(5, 'donor', 'donor@gmail.com', 'donor', 2, '../images/default.png'),
(6, 'ahmed', 'ahmed@gmail.com', 'ahmed', 2, '../uploads/default.png'),
(7, 'mohsen', 'mohsen@gmail.com', 'mohsen', 2, '../uploads/default.png'),
(8, 'ezzat', 'ezzat@gmail.com', 'ezzat', 2, '../images/default.png'),
(9, 'ali', 'ali@gmail.com', 'ali', 2, '../uploads/default.png'),
(10, 'mohamed', 'mohamed@gmail.com', 'mohamed', 2, '../uploads/default.png'),
(11, 'belal', 'belal@gmail.com', 'belal', 2, '../uploads/default.png'),
(12, 'admin', 'admin50@gmail.com', 'admin50', 1, '../images/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `vcash`
--

CREATE TABLE `vcash` (
  `id` int(11) NOT NULL,
  `tran_id` int(11) NOT NULL,
  `phoneNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vcash`
--

INSERT INTO `vcash` (`id`, `tran_id`, `phoneNo`) VALUES
(14, 45, '01029387559'),
(15, 47, '011235987'),
(16, 48, '01254897'),
(17, 49, '012545'),
(18, 50, '0125488'),
(19, 51, '0115487'),
(20, 26, '6'),
(21, 27, '6'),
(22, 28, '6'),
(23, 29, '6'),
(24, 30, '6'),
(25, 31, '6'),
(26, 32, '6'),
(27, 33, '6');

-- --------------------------------------------------------

--
-- Table structure for table `visa`
--

CREATE TABLE `visa` (
  `tran_id` int(11) NOT NULL,
  `RankNo` int(11) NOT NULL,
  `VisaOwner` varchar(50) NOT NULL,
  `CardNo` varchar(20) NOT NULL,
  `ExpYear` int(11) NOT NULL,
  `ExpMonth` int(11) NOT NULL,
  `cvv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visa`
--

INSERT INTO `visa` (`tran_id`, `RankNo`, `VisaOwner`, `CardNo`, `ExpYear`, `ExpMonth`, `cvv`) VALUES
(46, 27, 'ahmed', '4215464518651468', 2019, 4, 254),
(34, 28, '324234234234234', '2343242342342342', 234, 234342342, 234);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `id` int(11) NOT NULL,
  `no_of_event` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `no_of_event`, `user_id`, `phone_no`, `email`) VALUES
(1, 3, 5, '01005987456', 'ahmed@gmail.com'),
(2, 1, 6, '01505987456', 'ali@gmail.com'),
(3, 1, 7, '01196987456', 'mohamed@gmail.com'),
(4, 1, 8, '01512987456', 'mohamed@gmail.com'),
(5, 1, 9, '01152987456', 'ezzat@gmail.com'),
(6, 1, 10, '01278987456', 'belal@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`id`,`user_id`,`proj_id`) USING BTREE,
  ADD KEY `proj_id` (`proj_id`),
  ADD KEY `pay_meth_id` (`pay_meth_id`),
  ADD KEY `donor_id` (`user_id`),
  ADD KEY `payment_plan_id` (`payment_plan_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_ibfk_1` (`req_id`);

--
-- Indexes for table `event_req`
--
ALTER TABLE `event_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `req_id` (`req_id`);

--
-- Indexes for table `project_req`
--
ALTER TABLE `project_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_id` (`field_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`,`event_id`,`vol_id`),
  ADD KEY `vol_id` (`vol_id`),
  ADD KEY `regestration_ibfk_1` (`event_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `vcash`
--
ALTER TABLE `vcash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tran_id` (`tran_id`);

--
-- Indexes for table `visa`
--
ALTER TABLE `visa`
  ADD PRIMARY KEY (`RankNo`),
  ADD KEY `tran_id` (`tran_id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event_req`
--
ALTER TABLE `event_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `project_req`
--
ALTER TABLE `project_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vcash`
--
ALTER TABLE `vcash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `visa`
--
ALTER TABLE `visa`
  MODIFY `RankNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_3` FOREIGN KEY (`proj_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_ibfk_4` FOREIGN KEY (`pay_meth_id`) REFERENCES `payment_method` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_ibfk_5` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_ibfk_6` FOREIGN KEY (`payment_plan_id`) REFERENCES `payment_plan` (`id`),
  ADD CONSTRAINT `donation_ibfk_7` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`req_id`) REFERENCES `event_req` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_req`
--
ALTER TABLE `event_req`
  ADD CONSTRAINT `event_req_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_2` FOREIGN KEY (`req_id`) REFERENCES `project_req` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_req`
--
ALTER TABLE `project_req`
  ADD CONSTRAINT `project_req_ibfk_3` FOREIGN KEY (`field_id`) REFERENCES `field` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_req_ibfk_4` FOREIGN KEY (`org_id`) REFERENCES `organization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
