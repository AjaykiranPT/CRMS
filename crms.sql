-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 09:00 AM
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
-- Table structure for table `account_login`
--

CREATE TABLE `account_login` (
  `account_email` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_type` enum('admin','company','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_login`
--

INSERT INTO `account_login` (`account_email`, `account_password`, `account_type`) VALUES
('abinms@gmail.com', '$2y$10$0f6O3NJmxWxjfP9SgtHuHO408qQX3ItOcxqLesM.B8FPI095B1NrW', 'admin'),
('ajaykiran1221@gmail.com', '$2y$10$pxtZSe0M7cMEzQPaMCvi/eu/Ve6tBH0bINk4kQ7T7IQGf/0KkoJT2', 'admin'),
('rahul@gmail.com', '$2y$10$6yAN/Mri1oVfb37JFm9s2udsPNrdHLH7.OG7I.0pa2zHfv9LtCuyC', 'company'),
('vini@gmail.com', '$2y$10$wQMKPjrqwCKp0tZXGv5wj.mDS0N1IJ8AlttnuZ.1vSnqa3yWqzPye', 'student'),
('vipin@gmail.com', '$2y$10$ZusBSefBq.Oa9hvVViMntufrHTnH1zn7du03WOsEQiLmXDovy9oXa', 'company');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `PhoneNum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `account_email`, `user_name`, `PhoneNum`) VALUES
(3, 'ajaykiran1221@gmail.com', 'Ajaykiran', '9207363669'),
(4, 'abinms@gmail.com', 'Anin M S', '6238474286');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `ApplicationID` int(11) NOT NULL,
  `UserName` varchar(15) NOT NULL,
  `JobID` varchar(10) NOT NULL,
  `ApplicationDate` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`ApplicationID`, `UserName`, `JobID`, `ApplicationDate`, `Status`) VALUES
(10054, 'Abin M S', 'JOB2253', '2024-02-11', 'Applied'),
(10023, 'Ajaykiran P T', 'JOB2253', '2024-02-12', 'Applied');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `Company_id` int(11) NOT NULL,
  `Company_name` varchar(255) NOT NULL,
  `Contact_person` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `PhoneNum` varchar(255) NOT NULL,
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`Company_id`, `Company_name`, `Contact_person`, `account_email`, `PhoneNum`, `date_of_joined`) VALUES
(29, 'Hawkey Design', 'Rahul Rajendran', 'rahul@gmail.com', '9074697248', '2024-08-22 17:38:24'),
(30, 'Gramitt', 'Vipindas', 'vipin@gmail.com', '7907604380', '2024-08-22 17:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `job_posting`
--

CREATE TABLE `job_posting` (
  `job_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `job_description` varchar(255) NOT NULL,
  `job_location` varchar(255) NOT NULL,
  `posted_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `deadline` date NOT NULL,
  `course` varchar(255) NOT NULL,
  `jobtype` enum('fulltime','parttime') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_posting`
--

INSERT INTO `job_posting` (`job_id`, `company_id`, `jobtitle`, `job_description`, `job_location`, `posted_date`, `deadline`, `course`, `jobtype`) VALUES
(2, 29, 'testing', 'software testing', 'anakkara', '2024-09-04 06:04:13', '2024-09-27', 'bca', 'fulltime');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `student_id` int(11) NOT NULL,
  `First_name` varchar(255) NOT NULL,
  `Last_name` varchar(255) NOT NULL,
  `Gender` enum('male','female','others') NOT NULL,
  `City` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `College` varchar(255) NOT NULL,
  `Year_of_passing` varchar(4) NOT NULL,
  `PhoneNum` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`student_id`, `First_name`, `Last_name`, `Gender`, `City`, `Course`, `College`, `Year_of_passing`, `PhoneNum`, `account_email`, `date_of_joined`) VALUES
(4, 'Vinitha', 'S', 'female', 'Pampanar', 'Bachelor of Computer Applications', 'Marian College Kuttikkanam (Autonomous)', '2025', '8590916553', 'vini@gmail.com', '2024-08-22 17:42:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_login`
--
ALTER TABLE `account_login`
  ADD PRIMARY KEY (`account_email`);

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_email` (`account_email`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`Company_id`),
  ADD KEY `account_email` (`account_email`);

--
-- Indexes for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `account_email` (`account_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `Company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `job_posting`
--
ALTER TABLE `job_posting`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `company_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD CONSTRAINT `job_posting_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`Company_id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
