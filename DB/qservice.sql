-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2020 at 07:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` int(13) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `fname`, `lname`, `phone`, `password`) VALUES
(1, 'example@gmail.com', 'john', 'dexter', 799904209, '11a747d614dabad28003f2919f253d4c7f9d2bfe'),


-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `available_from` time NOT NULL,
  `available_to` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `contractor_id`, `date`, `available_from`, `available_to`) VALUES
(11, 1, '2020-05-30', '14:00:00', '21:30:00'),
(12, 1, '2020-05-31', '14:00:00', '22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE `contractors` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `phone` int(13) NOT NULL,
  `type` varchar(25) NOT NULL DEFAULT 'contractor',
  `speciality` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `rate` int(64) DEFAULT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'pending',
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`id`, `email`, `fname`, `lname`, `phone`, `type`, `speciality`, `location`, `rate`, `state`, `time_created`, `password`) VALUES
(1, 'contractorTemp1@gmail.com', 'Ahmad', 'Ali', 787878542, 'contractor', 'ELECTRICITY', 'irbid', NULL, 'verified', '2020-06-02 17:15:27', '4a488deb5fb91fb3afcf14bab1adf65881ecc4a2'),
(2, 'contractorTemp2@gmail.com', 'Mosa', 'Adham', 798578574, 'contractor', 'PLUMBING', 'amman', 8, 'verified', '2020-06-02 17:15:35', 'd7db448eca0525db20c1355c81053cd80444ea48'),
(3, 'contractorTemp3@gmail.com', 'Abdallah', 'Khaled', 770107860, 'contractor', 'HEATING', 'irbid', NULL, 'pending', '2020-06-02 17:15:47', '3cae58584952b7af3b02a65fede2cf891c09b107'),
(4, 'contractorTemp4@gmail.com', 'Jood', 'Rahem', 791155234, 'contractor', 'SECURITY SYSTEMS', 'irbid', NULL, 'pending', '2020-06-02 17:15:58', '5e9c6c622adaa5afb77eb4369af79522ae37e1a7');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` int(13) NOT NULL,
  `state` varchar(25) NOT NULL DEFAULT 'active',
  `type` varchar(25) NOT NULL DEFAULT 'customer',
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `location` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `fname`, `lname`, `phone`, `state`, `type`, `time_created`, `location`, `password`) VALUES
(1, 'customerTemp1@gmail.com', 'Tawfeq', 'Bahaa', 798578821, 'active', 'customer', '2020-05-30 15:12:06', 'irbid', '104a0286cee27e976432818387bcea3d5ec4e55e'),
(2, 'customerTemp2@gmail.com', 'Faisal', 'Samer', 771542648, 'blocked', 'customer', '2020-05-30 15:57:04', 'irbid', '75de4c0fe6234e89279d9ac4e11b388f50413745'),
(3, 'customerTemp3@gmail.com', 'Tahane', 'Noor', 794456875, 'active', 'customer', '2020-05-30 15:12:07', 'irbid', '62da8a1ba89abf434e108402ded03a10578d650c'),
(4, 'customerTemp4@gmail.com', 'Ahmad', 'Khaled', 775246132, 'active', 'customer', '2020-05-30 15:12:07', 'irbid', 'eb9da91d42dd01f976c90cf7c21259265c2ff23e'),
(5, 'customerTemp5@gmail.com', 'Abdallah', 'Ahmad', 785421987, 'blocked', 'customer', '2020-05-30 15:55:30', 'amman', '906b60631fc09243d7f443fafe8d753cabab9f46'),
(6, 'customerTemp6@gmail.com', 'Ramy', 'Waleed', 795887431, 'blocked', 'customer', '2020-05-30 15:12:07', 'amman', '843f2edfed04b1e0a47da759548836065be5ef91'),
(7, 'customerTemp7@gmail.com', 'Jamal', 'Loay', 790031249, 'active', 'customer', '2020-05-30 15:12:07', 'amman', 'f9f4b8fc216b4c99982d9012088c0adafb4db4b5'),
(8, 'customerTemp8@gmail.com', 'Sara', 'Maen', 791233423, 'blocked', 'customer', '2020-05-30 15:12:07', 'aqaba', '691955c578f48f605ef573844c0a87b4d29bdd56'),
(9, 'customerTemp9@gmail.com', 'Toleen', 'Zaid', 771231234, 'active', 'customer', '2020-05-30 15:12:07', 'aqaba', 'd11b5bf3a8e86053c923bcc33a7874c0f718fc21'),
(10, 'customerTemp10@gmail.com', 'Alaa', 'Jehad', 785647892, 'active', 'customer', '2020-05-30 15:12:07', 'zarqa', '5dcb15386448e822299448ffdcc0f32604a4412c'),
(11, 'customerTemp11@gmail.com', 'Ola', 'Aleem', 781200423, 'active', 'customer', '2020-05-30 15:12:07', 'ramtha', '4629ea7ed122c9cf7713bd900c8e0950f43aa96a');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` int(13) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `email`, `fname`, `lname`, `phone`, `time_created`, `password`) VALUES
(1, 'employeeTemp1@gmail.com', 'Mohamad', 'yaser', 258258, '2020-05-30 15:13:04', '11a747d614dabad28003f2919f253d4c7f9d2bfe'),
(2, 'employeeTemp2@gmail.com', 'Laith', 'asem', 123123, '2020-05-30 15:13:31', 'ce8fa1a1e227f18433dffef97941e385151dcbc8'),
(3, 'employeeTemp3@gmail.com', 'yahya', 'omar', 0000000, '2020-05-30 15:13:42', '24b0a668b5f934ecd4ad2ced520f501d37863f44');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `type`, `description`) VALUES
(1, 'ELECTRICITY', 'Electrician Wiring, Fans,Lighting, Fitting or Installation or repairing.'),
(2, 'PLUMBING', 'Filters, Pipelines, Pumps, Water Tanks, Tap, Wash Basin and Sinks, Leakages.'),
(3, 'SATELLITE', 'Install, maintenance, troubleshooting and wiring for satellite systems.'),
(4, 'GARDENING & LANDSCAPING', 'Maintaining beautiful, functional outdoor spaces and gardens.'),
(5, 'AIR CONDITIONING', 'AC Repairing, installation, Gas top-up and refill and Repair.'),
(6, 'REMODELING & CONSTRUCTIONS', 'General construction works, interior and exterior remodeling.</'),
(7, 'HEATING', 'Heating systems (Gas, Diesel), Radiators repair and fitting.'),
(8, 'PAINTING & INTERIOR', 'Painting walls, assembling wallpapers and Interior design work.'),
(9, 'SECURITY SYSTEMS', 'Security systems, Security Cameras and CCTV monitoring.');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `ID` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `cost` double NOT NULL,
  `Rating` int(5) DEFAULT NULL,
  `service_ID` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `contractor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`ID`, `state`, `time_created`, `Date`, `Time`, `location`, `description`, `cost`, `Rating`, `service_ID`, `customer_ID`, `contractor_ID`) VALUES
(1, 'finished', '2020-05-29 18:02:40', '2020-04-08', '13:23:33', 'irbid', 'Wires and lights repair', 10.5, 4, 1, 1, 1),
(2, 'finished', '2020-05-29 18:02:26', '2020-04-08', '11:53:19', 'amman', 'Plumping Maintenance.', 18, 5, 2, 1, 2),
(3, 'finished', '2020-05-29 17:57:03', '2020-04-09', '01:56:58', 'irbid', 'Plumping Installation.', 5, NULL, 2, 1, 2),
(4, 'finished', '2020-05-26 18:05:57', '2222-02-22', '14:22:00', 'amman', 'Wires Installation.', 32, NULL, 1, 1, 1),
(5, 'live', '2020-05-26 18:06:05', '2222-02-22', '14:22:00', 'irbid', '', 0, NULL, 2, 1, 2),
(6, 'live', '2020-05-29 17:25:00', '2020-05-29', '14:22:00', 'amman', '', 0, NULL, 3, 1, 3),
(7, 'live', '2020-05-30 14:27:26', '2020-06-02', '14:02:00', 'aqaba', '', 0, NULL, 1, 1, 1),
(8, 'live', '2020-05-29 05:31:08', '2020-02-02', '15:03:00', 'zarqa', '', 0, NULL, 3, 1, 3),
(9, 'pending', '2020-05-29 18:01:37', '2020-05-30', '14:30:00', 'irbid', '', 0, NULL, 1, 1, 1),
(10, 'pending', '2020-05-29 18:29:47', '2020-05-30', '19:40:00', 'amman', '', 0, NULL, 2, 1, NULL),
(11, 'pending', '2020-06-02 17:35:15', '2020-05-31', '17:00:00', 'aqaba', '', 0, NULL, 3, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contractor_id` (`contractor_id`);

--
-- Indexes for table `contractors`
--
ALTER TABLE `contractors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_serviceID` (`service_ID`),
  ADD KEY `FK_cusID` (`customer_ID`),
  ADD KEY `FK_cont_ID` (`contractor_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contractors`
--
ALTER TABLE `contractors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `availability_ibfk_1` FOREIGN KEY (`contractor_id`) REFERENCES `contractors` (`id`);

--
-- Constraints for table `service_list`
--
ALTER TABLE `service_list`
  ADD CONSTRAINT `FK_cont_ID` FOREIGN KEY (`contractor_ID`) REFERENCES `contractors` (`id`),
  ADD CONSTRAINT `FK_cusID` FOREIGN KEY (`customer_ID`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `FK_serviceID` FOREIGN KEY (`service_ID`) REFERENCES `services` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
