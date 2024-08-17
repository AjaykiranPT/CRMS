-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
('', '$2y$10$yHsURpAInaBNbNrf0m3Da./5IaMXekwIEtF6DFPNIrRc5CdoJspdK', 'company'),
('abc@gmail.com', '$2y$10$fGntJWLk.NZUtPch9wE9EOKYbcfCD6yWR1j2URTuBNcjB7nQlLKIW', 'company'),
('abinms@gmail.com', 'abin121', 'admin'),
('ajay1221@gmail.com', '$2y$10$ntGPci/WkD3Xlr7wCFIwNeLHXKZr8YqL8FlCxeTdG17AF8MuD/68.', 'student'),
('ajaykiran1221@gmail.com', 'ajay121', 'admin'),
('asdfg@gmail.com', '$2y$10$1rhIG58FitDKjyJ6Y.NR0uyn46TiAj862hYWGtkAJ1OivIJSDgG/W', 'company'),
('fgsdgfds@gmail.com', '$2y$10$yGc1iXmAYy9OSLccz8BgVuytVmbmS.WpPGVf7mqRW/WlQ5wp0hhqO', 'company'),
('rahul@gmail.com', 'rahul121', 'company'),
('vipin@gmail.com', 'vipin121', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `id` int(11) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `DOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`id`, `account_email`, `user_name`, `DOB`) VALUES
(1, 'abinms@gmail.com', 'Abin M S', '2004-01-11'),
(2, 'ajaykiran1221@gmail.com', 'AJAYKIRAN P T', '2005-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `company_detatils`
--

CREATE TABLE `company_detatils` (
  `Comapny_ID` int(11) NOT NULL,
  `Company_name` varchar(255) NOT NULL,
  `Contact_person` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `PhoneNum` varchar(255) NOT NULL,
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_detatils`
--

INSERT INTO `company_detatils` (`Comapny_ID`, `Company_name`, `Contact_person`, `account_email`, `PhoneNum`, `date_of_joined`) VALUES
(14, '', '', '', '', '2024-08-11 09:14:50'),
(15, 'ABC', 'abin', 'abc@gmail.com', '1234567890', '2024-08-11 09:58:06'),
(16, 'fdgdf', 'fgdfsgfd', 'fgsdgfds@gmail.com', '1234567890', '2024-08-11 10:05:53'),
(17, 'asdfg', 'asdfg', 'asdfg@gmail.com', '0987654321', '2024-08-11 10:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `student_detatils`
--

CREATE TABLE `student_detatils` (
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
-- Dumping data for table `student_detatils`
--

INSERT INTO `student_detatils` (`student_id`, `First_name`, `Last_name`, `Gender`, `City`, `Course`, `College`, `Year_of_passing`, `PhoneNum`, `account_email`, `date_of_joined`) VALUES
(1, 'ajay', 'ajay', 'male', 'ajay', 'ajay', 'ajay', '1234', '9876543212', 'ajay1221@gmail.com', '2024-08-11 11:12:18');

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
-- Indexes for table `company_detatils`
--
ALTER TABLE `company_detatils`
  ADD PRIMARY KEY (`Comapny_ID`),
  ADD KEY `account_email` (`account_email`);

--
-- Indexes for table `student_detatils`
--
ALTER TABLE `student_detatils`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `account_email` (`account_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_detatils`
--
ALTER TABLE `company_detatils`
  MODIFY `Comapny_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_detatils`
--
ALTER TABLE `student_detatils`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `company_detatils`
--
ALTER TABLE `company_detatils`
  ADD CONSTRAINT `company_detatils_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `student_detatils`
--
ALTER TABLE `student_detatils`
  ADD CONSTRAINT `student_detatils_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
