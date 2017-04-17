-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2017 at 07:22 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mu_marksheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `sem1`
--

CREATE TABLE `sem1` (
  `seat_no` varchar(8) NOT NULL,
  `code` varchar(6) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `creditE` decimal(2,1) NOT NULL,
  `creditI` decimal(2,1) NOT NULL,
  `ese` varchar(2) NOT NULL,
  `ia` varchar(2) NOT NULL,
  `avgE` varchar(2) NOT NULL,
  `pr` varchar(2) NOT NULL,
  `tw` varchar(2) NOT NULL,
  `avgI` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sem1`
--

INSERT INTO `sem1` (`seat_no`, `code`, `subject`, `creditE`, `creditI`, `ese`, `ia`, `avgE`, `pr`, `tw`, `avgI`) VALUES
('3346', 'FEC101', 'APPLIED MATHEMATICS-I', '4.0', '1.0', 'C', 'O', 'B', '--', 'B', 'A'),
('3346', 'FEC102', 'APPLIED PHYSICS-I', '4.0', '1.0', 'O', 'O', 'O', 'O', 'O', 'O'),
('3346', 'FEC103', 'APPLIED CHEMISTRY-I', '4.0', '1.0', 'C', 'B', 'C', 'O', 'D', 'B'),
('3346', 'FEC104', 'ENGINEERING MECHANICS', '4.0', '1.0', 'D', 'B', 'C', 'B', 'A', 'B'),
('3346', 'FEC105', 'BASIC ELECTRONICS & ELECTRICAL ENGG', '3.0', '1.0', 'A', 'D', 'B', 'O', 'O', 'O'),
('3346', 'FEL101', 'BASIC WORKSHOP & PRACTICE-I', '3.0', '1.0', 'E', 'E', 'E', 'O', 'D', 'B'),
('3456', 'FEC101', 'APPLIED MATHEMATICS-I', '4.0', '1.0', 'A', 'O', 'A', 'O', 'A', 'A'),
('3456', 'FEC102', 'APPLIED PHYSICS-I', '4.0', '1.0', 'A', 'O', 'A', 'O', 'A', 'A'),
('3456', 'FEC103', 'APPLIED CHEMISTRY-I', '4.0', '1.0', 'O', 'O', 'O', 'O', 'B', 'A'),
('3456', 'FEC104', 'ENGINEERING MECHANICS', '4.0', '1.0', 'O', 'O', 'O', 'O', 'O', 'O'),
('3456', 'FEC105', 'BASIC ELECTRONICS & ELECTRICAL ENGG', '3.0', '1.0', 'A', 'O', 'A', 'O', 'A', 'A'),
('3456', 'FEL101', 'BASIC WORKSHOP & PRACTICE-I', '3.0', '1.0', 'O', 'O', 'O', 'O', 'O', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `sem2`
--

CREATE TABLE `sem2` (
  `seat_no` varchar(8) NOT NULL,
  `code` varchar(6) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `creditE` decimal(2,1) NOT NULL,
  `creditI` decimal(2,1) NOT NULL,
  `ese` varchar(2) NOT NULL,
  `ia` varchar(2) NOT NULL,
  `avgE` varchar(2) NOT NULL,
  `pr` varchar(2) NOT NULL,
  `tw` varchar(2) NOT NULL,
  `avgI` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `student_name` varchar(40) NOT NULL,
  `exam` varchar(4) NOT NULL,
  `seat_no` varchar(8) NOT NULL,
  `reg_no` varchar(11) NOT NULL,
  `result` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`student_name`, `exam`, `seat_no`, `reg_no`, `result`) VALUES
('NAIR ABHISHEK P', 'sem1', '3346', '2015134233', 1),
('AKAI SHUICHI', 'sem1', '3456', '2017888', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sem1`
--
ALTER TABLE `sem1`
  ADD PRIMARY KEY (`seat_no`,`code`);

--
-- Indexes for table `sem2`
--
ALTER TABLE `sem2`
  ADD PRIMARY KEY (`seat_no`,`code`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`seat_no`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
