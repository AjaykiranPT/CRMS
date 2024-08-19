-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 03:13 PM
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
('abinms@gmail.com', 'abin121', 'admin'),
('ajaykiran111@gmail.com', '$2y$10$ZQwlxvygNfOX6EXRG20rhOBpVH5RvsbmOBgNPLjbV3P9QTZ5J4dNK', 'company'),
('ajaykiran1221@gmail.com', 'ajay121', 'admin'),
('gameon3@gmail.com', '$2y$10$GQN0PoPLWZf74/NlTNpdEeGdDo3sbrGEBi9Nrny.w5N2.nBtWXduK', 'company'),
('johncycherian@gmail.com', '$2y$10$6KxMAKuIsFHZarWuMpOD2.wkmgVAygqZD0ybRE7s5DGWRuEHWwty.', 'student'),
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
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `Comapny_ID` int(11) NOT NULL,
  `Company_name` varchar(255) NOT NULL,
  `Contact_person` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `PhoneNum` varchar(255) NOT NULL,
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`Comapny_ID`, `Company_name`, `Contact_person`, `account_email`, `PhoneNum`, `date_of_joined`) VALUES
(25, 'GAMEON', 'nasil', 'gameon3@gmail.com', '9754561234', '2024-08-14 07:42:04'),
(26, 'AjayKiran', 'ajaykiran', 'ajaykiran111@gmail.com', '9898989898', '2024-08-19 13:01:51');

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
(2, 'johncy', 'Cherian', 'male', 'kattappana', 'BCA', 'Marian', '2025', '9876123451', 'johncycherian@gmail.com', '2024-08-14 07:46:48');

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
  ADD PRIMARY KEY (`Comapny_ID`),
  ADD KEY `account_email` (`account_email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `Comapny_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
