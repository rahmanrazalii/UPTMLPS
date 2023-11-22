-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2023 at 09:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loadprojection`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturerID` varchar(100) NOT NULL,
  `lecturerName` varchar(100) NOT NULL,
  `lecturerGrade` varchar(10) NOT NULL,
  `lecturerQualification` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerID`, `lecturerName`, `lecturerGrade`, `lecturerQualification`) VALUES
('1111', 'Ts. Dr. Airuddin bin Ahmad', 'A4', 'Phd (IT), UUM'),
('1112', 'Prof. Dr. Ramlan Mahmud', 'PB KUPTM (', 'PhD Artificial Intelligence, Bradford University, UK '),
('1113', 'Nor Zakiah binti Lamin', 'A3', 'Master of Computer Science, UiTM'),
('1114', 'Ab Arif Sanusi bin Arifin', 'A3', 'MSc (Computer Science - Information Security), UTM'),
('8899', 'Ahmad Albab', 'A3', 'Master of business administration, UUM');

-- --------------------------------------------------------

--
-- Table structure for table `othertask`
--

CREATE TABLE `othertask` (
  `roleID` int(11) NOT NULL,
  `roleDescription` varchar(100) NOT NULL,
  `lecturerID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectCode` varchar(100) NOT NULL,
  `subjectName` varchar(100) NOT NULL,
  `contactHours` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectCode`, `subjectName`, `contactHours`) VALUES
('ENT301/UCS3083', 'Enterpreneurship with Digital Application 2', 3),
('IMF201/ITC2113/ITC2213', 'Digital Technology and Society', 3),
('IMF401/ITC3043/ITC3103', 'Decision Support System', 3),
('ITC4014/ITC4164', 'Strategic Planning for Information Systems', 3),
('ITC4103', 'Management System and E-Business', 3),
('NWC4143/NWC4253', 'Cybersecurity Operations', 3),
('SWC4263', 'Software Testing and Quality Assurance', 3),
('UCS309/UCS3093', 'Creativity & Innovation', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `lecturerID` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `lecturerName` varchar(150) NOT NULL,
  `userType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `lecturerID`, `password`, `lecturerName`, `userType`) VALUES
(1, 'admin123', 'admin123', '', ''),
(2, '123456', 'kptm123', '', ''),
(3, '123456', 'kptm123', 'rahman razali', ''),
(4, '123456', 'kptm123', 'adeeb adli', 'lecturer'),
(5, '34567', 'kptm123', 'aiman bakri', 'lecturer'),
(6, 'admin456', 'admin456', 'admin2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE `workload` (
  `lecturerID` varchar(100) NOT NULL,
  `subjectCode` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `programme` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `totalStudent` int(200) NOT NULL,
  `totalContactHours` int(30) NOT NULL,
  `mentor` varchar(100) NOT NULL,
  `supervising` varchar(100) NOT NULL,
  `totalWorkload` int(100) NOT NULL,
  `teachingPeriod` varchar(100) NOT NULL,
  `otherRoles` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`lecturerID`, `subjectCode`, `session`, `programme`, `level`, `semester`, `totalStudent`, `totalContactHours`, `mentor`, `supervising`, `totalWorkload`, `teachingPeriod`, `otherRoles`) VALUES
('1111', 'IMF401/ITC3043/ITC3103', '', 'CC101', 'Diploma', '5', 90, 9, '1', '1', 11, '14', '[\"silap\",\"silap\"]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerID`);

--
-- Indexes for table `othertask`
--
ALTER TABLE `othertask`
  ADD PRIMARY KEY (`roleID`),
  ADD KEY `lecturerID` (`lecturerID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectCode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workload`
--
ALTER TABLE `workload`
  ADD PRIMARY KEY (`lecturerID`,`subjectCode`),
  ADD KEY `subjectCode` (`subjectCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `othertask`
--
ALTER TABLE `othertask`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `othertask`
--
ALTER TABLE `othertask`
  ADD CONSTRAINT `othertask_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturer` (`lecturerID`);

--
-- Constraints for table `workload`
--
ALTER TABLE `workload`
  ADD CONSTRAINT `workload_ibfk_1` FOREIGN KEY (`lecturerID`) REFERENCES `lecturer` (`lecturerID`),
  ADD CONSTRAINT `workload_ibfk_2` FOREIGN KEY (`subjectCode`) REFERENCES `subject` (`subjectCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
