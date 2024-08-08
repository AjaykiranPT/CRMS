-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 07:54 AM
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
-- Database: `crms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'ams102');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `ApplicationID` int(11) NOT NULL,
  `username` varchar(15) DEFAULT NULL,
  `JobID` varchar(15) DEFAULT NULL,
  `ApplicationDate` date DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `RegID` int(11) NOT NULL,
  `CompanyName` varchar(50) DEFAULT NULL,
  `ContactPerson` varchar(30) DEFAULT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobpostings`
--

CREATE TABLE `jobpostings` (
  `JobID` varchar(15) NOT NULL,
  `RegID` int(11) DEFAULT NULL,
  `JobTitle` varchar(50) DEFAULT NULL,
  `JobDescription` text DEFAULT NULL,
  `Location` varchar(30) DEFAULT NULL,
  `Deadline` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `FirstName` varchar(30) DEFAULT NULL,
  `LastName` varchar(30) DEFAULT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Gender` varchar(10) NOT NULL,
  `Course` varchar(50) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `YearOfPassing` int(11) DEFAULT NULL,
  `City` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`ApplicationID`),
  ADD KEY `JobID` (`JobID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`RegID`);

--
-- Indexes for table `jobpostings`
--
ALTER TABLE `jobpostings`
  ADD PRIMARY KEY (`JobID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`username`) REFERENCES `reguser` (`username`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`JobID`) REFERENCES `jobpostings` (`JobID`);

--
-- Constraints for table `jobpostings`
--
ALTER TABLE `jobpostings`
  ADD CONSTRAINT `jobpostings_ibfk_1` FOREIGN KEY (`RegID`) REFERENCES `company` (`RegID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
