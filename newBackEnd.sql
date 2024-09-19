-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 03:41 PM
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
('abinms@gmail.com', '$2y$10$ydDbNNADpBHIKFhxuiCJX.hCHhdW0l9tlXHxrUY7jlWPJH.Jyv.mK', 'admin'),
('ajaykiran1221@gmail.com', '$2y$10$96Pt5YZPMec4qKlJ3HQRD.5ylegJc4GnzifL5VQQSnRjwQbR4H7RK', 'admin'),
('rahul@gmail.com', '$2y$10$98G5Mnysrp6g5nr39WTXi.JmXErAFNUMKj8gmwuDTb.zQNSH6.HhW', 'company'),
('vini@gmail.com', '$2y$10$OIwcjF/lpv1gJGAy5VfT7OTN2B82D2xv5UpFJabt8lcGhyqVDqLae', 'student'),
('vipin@gmail.com', '$2y$10$igu4zSJQCQPcCY40FUvv/eoBqg9RBtH6b6LNpAis/xt7kf5jMfI0O', 'company');

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
  `application_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `application_date` date DEFAULT curdate(),
  `appliaction_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `student_id`, `company_id`, `job_id`, `application_date`, `appliaction_status`) VALUES
(1000, 4, 30, 2, '2024-09-19', 'pending');

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
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval` enum('approved','waiting','rejected') DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`Company_id`, `Company_name`, `Contact_person`, `account_email`, `PhoneNum`, `date_of_joined`, `approval`) VALUES
(29, 'Hawkey Design', 'Rahul Rajendran', 'rahul@gmail.com', '9074697248', '2024-08-22 17:38:24', 'approved'),
(30, 'Gramitt', 'Vipindas', 'vipin@gmail.com', '7907604380', '2024-08-22 17:40:33', 'approved');

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
  `date_of_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `approval` enum('approved','waiting','rejected') DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`student_id`, `First_name`, `Last_name`, `Gender`, `City`, `Course`, `College`, `Year_of_passing`, `PhoneNum`, `account_email`, `date_of_joined`, `approval`) VALUES
(4, 'Vinitha', 'S', 'female', 'Pampanar', 'Bachelor of Computer Applications', 'Marian College Kuttikkanam (Autonomous)', '2025', '8590916553', 'vini@gmail.com', '2024-08-22 17:42:15', 'approved');

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
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `job_id` (`job_id`);

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
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

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
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_details` (`student_id`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`Company_id`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`job_id`) REFERENCES `job_posting` (`job_id`);

--
-- Constraints for table `company_details`
--
ALTER TABLE `company_details`
  ADD CONSTRAINT `company_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `job_posting`
--
ALTER TABLE `job_posting`
  ADD CONSTRAINT `job_posting_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_details` (`company_id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
