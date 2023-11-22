-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 04:38 PM
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
('1111', 'Ts. Dr. Airuddin bin Ahmad', 'A4', 'Phd (IT), UUT'),
('1112', 'Prof. Dr. Ramlan Mahmud', 'PB KUPTM (', 'PhD Artificial Intelligence, Bradford University, UK '),
('1113', 'Nor Zakiah binti Lamin', 'A3', 'Master of Computer Science, UiTM'),
('1114', 'Ab Arif Sanusi bin Arifin', 'A3', 'MSc (Computer Science - Information Security), UTM'),
('1115', 'Zurina binti Jusoh', 'A4', 'Master of Computer Science, UPM'),
('1116', 'Siti Faezah binti Miserom', 'A2', 'Master of Computer Science, UiTM'),
('1117', 'Raznida bt Isa', 'A4', 'MSc Information Technology, UPM'),
('1121', 'Hafiza Haron', 'A4', 'Master of Computer Science, UiTM'),
('8899', 'Ahmad Albab', 'A3', 'Master of business administration, UUM');

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE `programme` (
  `programme` varchar(100) NOT NULL,
  `programmeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme`, `programmeName`) VALUES
('AA002', 'ACCA Foundation in Accountancy (AFIA)'),
('AA103', 'Diploma of Accountancy'),
('AA201', 'Bachelor of Business Administration (Honours) Human Resource Management'),
('AA211', 'Association of Chartered Certified Accountants (ACCA)'),
('AA301', 'Master of Accountancy'),
('AB202', 'Bachelor of Business Administration (Honours)'),
('AB301', 'Master of Business Administration'),
('AB302', 'Master of Business Administration (Corporate Administration and Governance) '),
('AB401', 'Doctor of Philosophy in Business Administration'),
('AC201', 'Bachelor of Corporate Administration (Honours)'),
('BE201', 'Bachelor of Arts (Hons) in Applied English Language Studies'),
('BE202', 'Bachelor of Early Childhood Education (Honours)'),
('BE203', 'Bachelor of Education (Honours) in Teaching English As A Second Language (TESL)'),
('BE301', 'Postgraduate Diploma in Education'),
('BK101', 'Diploma in Corporate Communication'),
('BK201', 'Bachelor of Communication (Hons) in Corporate Communication'),
('CC101', 'Diploma in Computer Science'),
('CC202', 'Diploma in 3D Animation & Multimedia'),
('CC203', 'Cyber Security'),
('CC204', 'Diploma in Computer '),
('CM201', 'Bachelor of Arts in 3D Animation and Digital Media (Honours)'),
('CT203', 'Bachelor of Information Technology (Honours) in Business Computing'),
('CT204', 'Bachelor of Information Technology (Honours) in Computer Application Development'),
('CT206', 'Bachelor of Information Technology (Honours) in Cyber Security'),
('CT301', 'Master of Science in Information Systems'),
('CT401', 'PhD in Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sessionName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sessionName`) VALUES
('0424'),
('0723'),
('1123');

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
('ARC1033', 'Computer Organization and Architecture', 3),
('ARC1043', 'Operating System', 3),
('ARC2043/ARC2153', 'Computer Organization and Architecture', 3),
('ARC2053/ARC2163', 'Operating System', 3),
('ARC3033/ARC3043', 'Linux OS', 3),
('BUS502/ITC4294', 'Business Case for IT Projects', 3),
('CSC206/SWC3233', 'Advanced Object-Oriented Programming', 4),
('CSC303/SWC3213', 'Mobile Applications Development', 4),
('DSC4013', 'Introduction to Data Analytics', 3),
('DSC4023', 'Data Analytics for Business', 3),
('ENT301/UCS3083', 'Enterpreneurship with Digital Application 2', 3),
('FYP4013/FYP4014/IMF402', 'Computing Project 1', 4),
('FYP4025/IMF403/FYP4043', 'Computing Project 2/Information Security Project 2', 5),
('FYP4033/FYP4074', 'Information Security Project 1', 4),
('IMF201/ITC2113/ITC2213', 'Digital Technology and Society', 3),
('IMF204/ITC3053', 'Database Management and Information Retrieval', 3),
('IMF301/SWC3153', 'Object Oriented Analysis and Design', 3),
('IMF302/ITC2103', 'Enterprise Information Systems', 3),
('IMF303/NWC3073/NWC3183', 'Information System Security', 3),
('IMF401/IMF3043/ITC3013', 'Decision Support System', 3),
('IMF401/ITC3043/ITC3103', 'Decision Support System', 3),
('IMF404', 'System Development Tools and Technique', 3),
('IMF405/ITC2073', 'E-Commerce', 3),
('IMF504/ITC4094/ITC4224', 'Strategic Supply Chain Management', 3),
('INT3027', 'Industrial Training', 7),
('INT401', 'Industrial Training', 7),
('INT40110', 'Industrial Training', 7),
('INT4017', 'Industrial Training', 7),
('INT403', 'Industrial Training', 7),
('ITC1023', 'Information Technology Skills & Application', 3),
('ITC1073/ITC2233', 'Business Information Management Strategy', 3),
('ITC1083', 'Business Information Management Strategy', 3),
('ITC1093', 'Introduction to Data Analytics', 3),
('ITC2043/ITC2153', 'Database Fundamental', 3),
('ITC2083/ITC2243', 'E-Business', 3),
('ITC2113/ITC2213/IMF201', 'Digital Technology and Society', 3),
('ITC2133', 'Information Technology for Business', 3),
('ITC2143', 'Database Concepts', 3),
('ITC2173', 'Enterprise Information Systems', 3),
('ITC2193', 'Information Technology Essential', 3),
('ITC2223', 'E-Commerce', 3),
('ITC2253', 'Management Information System', 3),
('ITC2263', 'Introduction to Data Analytics', 3),
('ITC2273/ITC2023/IMF205', 'Computer Application', 3),
('ITC3013', 'Database Management and Administration', 3),
('ITC3014', 'Database Management and Information Retrieval', 4),
('ITC3033', 'Software Project Management', 3),
('ITC4014/ITC4164', 'Strategic Planning for Information Systems', 3),
('ITC4103', 'Management System and E-Business', 4),
('MMC1033', 'Introduction to Corporate Website', 3),
('MMC1063', 'Script Writing & Screenplay', 3),
('MMC1073', 'Fundamental of 3D', 3),
('MMC1083', 'Concept Art Illustration', 3),
('MMC1093', 'Digital Media', 3),
('MMC1103', 'Audio Production', 3),
('MMC1123', 'Human Computer Interaction', 3),
('MMC1133', 'Desktop Publishing', 3),
('MMC201/MMC2013/MMC2213', 'Human Computer Interaction', 3),
('MMC202/MMC1053', 'Basic Drawing', 3),
('MMC2043', 'Basic Rigging', 3),
('MMC210', 'Screenplay', 3),
('MMC211', 'Photography in Production', 3),
('MMC301/MMC1043', 'Graphic and Creative Production', 3),
('MMC30123', 'Perspectives', 4),
('MMC3013/MMC407', 'User Interface Development', 3),
('MMC302/MMC2023', 'Web Design Production/Corporate Web Design', 3),
('MMC304/MMC2054', '3D Background Modeling & Texturing', 4),
('MMC305', '3D Character Modelling and Texturing', 4),
('MMC306', 'Basic Animation', 3),
('MMC307', 'Basic Lighting & Rendering', 4),
('MMC308', '3D Animation Acting & Body 1', 4),
('MMC309', '3D Animation Acting & Body 2', 4),
('MMC310', 'Editing for Production', 4),
('MMC311', 'Production Management', 3),
('MMC401', 'Compositing for Production', 3),
('MMC403', 'Final Year Project 01', 4),
('MMC405', 'Final Year Project 02', 4),
('MPU3233', 'Information Technology and Its Application', 3),
('NET201/NWC2053/NWC2163', 'Computer Systems and Networking (Cisco 1)', 4),
('NET402/CCS6134/NWC4113', 'Digital Forensic', 3),
('NWC1023', 'Networking Essentials', 4),
('NWC2043', 'Introduction to Networks', 4),
('NWC2053', 'Computer Network Security', 3),
('NWC2063', 'Data Communication Concepts', 3),
('NWC2153', 'Data Communication and Network', 3),
('NWC3063/NWC3173', 'Routing and Switching (Cisco 2)', 4),
('NWC3083/NWC3193', 'Fundamental of Cryptography', 3),
('NWC4123/NWC4233', 'Ethical Hacking', 4),
('NWC4133/NWC4243', 'Network Security', 3),
('NWC4143/NWC4253', 'Cybersecurity Operations', 3),
('subjectCode', 'subjectName', 0),
('SWC1323', 'Fundamental of Programming', 3),
('SWC2123', 'Introduction to Object-Oriented Programming', 3),
('SWC2273', 'Programming Language for Data Science', 3),
('SWC2333', 'Object Oriented Programming', 3),
('SWC2353', 'Web Design', 3),
('SWC2363', 'Web Application Project', 3),
('SWC2373', 'Emerging Technologies', 3),
('SWC2383', 'Express Application Development', 3),
('SWC3344', 'Data Structure', 4),
('SWC3393', 'System Analysis and Design', 3),
('SWC3403', 'Web Design', 3),
('SWC3433', 'Web Application Development', 3),
('SWC3493', 'System Analysis and Design', 3),
('SWC3503', 'Secure Programming', 3),
('SWC4133/SWC4423', 'Data Structure and Algorithm', 3),
('SWC4243', 'Advanced Application Development', 4),
('SWC4253', 'Enterprise Application Development', 4),
('SWC4263', 'Software Testing and Quality Assurance', 3),
('SWC4443/SWC4163', 'Web API Development', 3),
('SWE401/ITC3023/ITC3083', 'Project Management', 3),
('TSE3214/FYP304', 'Computing Project', 4),
('UCS2083', 'Enterpreneurship with Digital Application', 3),
('UCS309/UCS3093', 'Creativity & Innovation', 3),
('UCS3133', 'Computing and Multimedia Project for Community', 3);

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
(6, 'admin456', 'admin456', 'admin2', 'admin'),
(7, '1111', 'kptm123', 'Ts. Dr. Airuddin bin Ahmad', 'lecturer'),
(9, '1112', 'kptm123', 'Prof. Dr. Ramlan Mahmud', 'lecturer'),
(10, '1116', 'kptm123', 'Siti Faezah binti Miserom', 'lecturer'),
(11, '1117', 'Kptm1234', 'Eliza Suraiya binti Tahir', 'lecturer'),
(12, '1119', 'Kptm1234', 'Elisza Suraya', 'lecturer'),
(13, '1120', 'Kptm1234', 'Nuri Surina', 'lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE `workload` (
  `No` int(200) NOT NULL,
  `lecturerID` varchar(100) NOT NULL,
  `subjectCode` varchar(100) NOT NULL,
  `programme` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `totalStudent` int(200) NOT NULL,
  `totalContactHours` int(30) NOT NULL,
  `mentor` int(10) NOT NULL,
  `supervising` int(10) NOT NULL,
  `totalWorkload` int(100) NOT NULL,
  `teachingPeriod` varchar(100) NOT NULL,
  `otherRoles` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`No`, `lecturerID`, `subjectCode`, `programme`, `level`, `semester`, `totalStudent`, `totalContactHours`, `mentor`, `supervising`, `totalWorkload`, `teachingPeriod`, `otherRoles`, `session`) VALUES
(1, '1111', 'IMF401/ITC3043/ITC3103', 'BE101/BK101/CC101', 'Diploma', '4', 120, 12, 1, 1, 14, '14', '[\"1. Dean\"]', ''),
(2, '1111', 'ITC4103', 'AA201/AB201/AB202', 'Diploma', '6', 90, 9, 1, 1, 11, '14', '[\"1. Dean\"]', ''),
(5, '1113', 'SWC4263', 'CT203/CT204/CT206', 'Degree', '5', 90, 9, 1, 1, 11, '14', '[\"1. Dean\",\"2. Deputy Dean\"]', ''),
(6, '1113', 'IMF401/ITC3043/ITC3103', 'AA211/AA301/AB202', 'Diploma', '7', 90, 9, 1, 1, 11, '14', '[\"1. Dean\"]', ''),
(7, '1113', 'UCS309/UCS3093', 'CT203/CT204', 'Degree', '8', 90, 9, 1, 1, 11, '14', '[\"1. Dean\"]', ''),
(8, '1112', 'IMF201/ITC2113/ITC2213', 'AB301/AB302/AB401', 'Degree', '6', 90, 9, 1, 1, 11, '14', '[\"silap\"]', ''),
(9, '1114', 'ITC4014/ITC4164', 'AB302/AB401/AC201', 'Degree', '6', 90, 9, 1, 1, 11, '14', '[\"1. Dean\"]', ''),
(10, '1114', 'ITC4103', 'BE201/BE202/BE203', 'Degree', '7', 90, 9, 1, 1, 11, '14', '[\"silap\"]', ''),
(11, '1114', 'ITC4103', 'BE201/BE202/BE203', 'Degree', '7', 90, 9, 1, 1, 11, '14', '[\"1. silap\"]', ''),
(12, '1114', 'SWC4263', 'AB202/AB301/AB302', 'Diploma', '5', 90, 9, 1, 1, 11, '14', '[\"1. silap\",\"2. silap\",\"3. silap\"]', ''),
(13, '1114', 'SWC4263', 'AB202/AB301/AB302', 'Diploma', '5', 90, 9, 1, 1, 11, '14', '[\"1. silap\",\"2. silap\",\"3. silap\"]', ''),
(14, '1114', 'SWC4263', 'AB202/AB301/AB302', 'Diploma', '5', 90, 9, 1, 1, 11, '14', '[\"1. silap\",\"2. silap\",\"3. silap\"]', ''),
(15, '1114', 'SWC4263', 'AB202/AB301/AB302', 'Diploma', '5', 90, 9, 1, 1, 11, '14', '[\"1. silap\",\"2. silap\",\"3. silap\"]', ''),
(16, '1111', 'ITC4103', 'CC101/CC202/CC203', 'Diploma', '2', 120, 12, 1, 1, 14, '14', '[\"1. 1. Dean\",\"2. 2. Head of Department\"]', ''),
(18, '1111', 'UCS309/UCS3093', 'BE201/BE202/BE203', 'Degree', '7', 90, 9, 1, 1, 11, '14', '[\"1. 1. Dean\"]', ''),
(25, '1111', 'ITC4014/ITC4164', 'AA211/AA301', 'Degree', '3', 90, 9, 1, 1, 11, '14', '[\"1. Dean\"]', ''),
(26, '1111', 'DSC4023', 'AA201/AA211', 'Degree', '5', 36, 6, 1, 1, 8, '14', '[\"1. Dean\",\"2. Dean\"]', ''),
(27, '1115', 'ARC3033/ARC3043', 'AA201/AA211', 'Diploma', '4', 6, 3, 0, 0, 3, '14', '[\"1. Ketua inovasi\"]', '1123'),
(28, '1115', 'ARC2053/ARC2163', 'AB202/AB302', 'Degree', '4', 6, 3, 1, 1, 5, '14', '[\"1. Ketua inovasi\"]', '1123'),
(29, '1115', 'CSC303/SWC3213', 'AA201/AA211', 'Diploma', '6', 6, 3, 1, 1, 5, '14', '[\"1. Ketua inovasi\"]', '0723'),
(31, '1116', 'ENT301/UCS3083', 'CT204/CT206', 'Degree', '6', 6, 3, 1, 1, 5, '14', '[\"1. AJK Peperiksaan Fakulti\",\"2. AJK Kecil Konvikesyen UPTM\"]', '0723'),
(33, '1113', 'ARC3033/ARC3043', 'AA201/AA211', 'Degree', '7', 6, 3, 1, 1, 5, '14', '[\"Ketua inovasi\",\"\"]', '1123'),
(34, '1116', 'ARC3033/ARC3043', 'CT204/CT206', 'Degree', '7', 20, 3, 1, 1, 5, '14', '[\"Ketua inovasi\"]', '1123'),
(35, '1117', 'FYP4013/FYP4014/IMF402', 'BK201/CM201', 'Degree', '5', 90, 9, 0, 0, 9, '14', '[\"1. Ketua inovasi\",\"2. AJK Peperiksaan Fakulti\"]', '1123'),
(37, '1112', 'BUS502/ITC4294', 'AB301/AB302', 'Degree', '9', 6, 3, 1, 1, 5, '14', '[\"1. Ketua inovasi\",\"2. AJK Peperiksaan Fakulti\"]', '1123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerID`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`programme`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sessionName`);

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
  ADD PRIMARY KEY (`No`),
  ADD KEY `lecturerID` (`lecturerID`),
  ADD KEY `subjectCode` (`subjectCode`),
  ADD KEY `programme` (`programme`,`session`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `workload`
--
ALTER TABLE `workload`
  MODIFY `No` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

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
