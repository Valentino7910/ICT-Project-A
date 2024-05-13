-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.infinityfree.com
-- Generation Time: May 13, 2024 at 05:09 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36401780_golden_care`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `username` varchar(245) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `date`, `time`, `service_type`, `username`) VALUES
(0, 'Michael Johnson', 'michaeljohnson@gmail.com', '0456120934', '2024-05-15', '07:43:00', 'Consultation', 'user'),
(0, 'patient', 'patient@gmail.com', '123456789', '2024-05-19', '16:41:00', 'facility', 'Patient'),
(0, 'Macbook', 'patient@gmail.com', '123', '2024-05-30', '17:16:00', 'facility', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_available` enum('Yes','No') NOT NULL,
  `max_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `is_available`, `max_stock`) VALUES
(1, 'Med A', 'Yes', 100),
(2, 'Med B', 'Yes', 200),
(3, 'Uniform', 'Yes', 50),
(4, 'Redsheets', 'Yes', 30),
(5, 'Clothes', 'No', NULL),
(6, 'Water', 'Yes', 20),
(12, 'grocery', 'Yes', 50);

-- --------------------------------------------------------

--
-- Table structure for table `member_login`
--

CREATE TABLE `member_login` (
  `member_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` enum('patient','doctor','admin','') DEFAULT NULL,
  `security_question1` varchar(255) NOT NULL,
  `security_answer1` varchar(255) NOT NULL,
  `security_question2` varchar(255) NOT NULL,
  `security_answer2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_login`
--

INSERT INTO `member_login` (`member_id`, `username`, `password`, `permission`, `security_question1`, `security_answer1`, `security_question2`, `security_answer2`) VALUES
(1, 'user', 'user', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(9, 'user11', 'user11', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(10, 'halo', 'halo', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(11, 'Hugo', 'Wj3W8g5X', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(12, 'Yotsume', 'Wj3', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(13, 'Poo', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(14, 'VV', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(15, 'chris', 'abc123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(16, 'admin', 'admin', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(17, 'doctor', 'doctor', 'doctor', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(18, 'bb', 'Poo', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(19, 'shru', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(20, 'hugo', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(21, 'shao', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(22, 'lucie', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(23, 'bill', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(24, 'valentino', '123', 'admin', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(25, 'product', 'povdaz-zecwe3-xutraZ', 'patient', 'What city were you born in?', 'Melbourne', 'What is the name of your first school?', 'shiv Ashish'),
(26, 'aa', 'aa', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(27, 'add', 'add', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(28, 'Patient', 'patient', 'patient', 'What city were you born in?', 'Melbourne', 'What is the name of your first school?', 'Swinburne'),
(29, '2222', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(30, '333', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(31, '666', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(32, '55', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(33, '3232', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(34, '2323', '123', 'patient', 'What city were you born in?', '123', 'What is the name of your first school?', '123'),
(35, 'hugotang', 'hugo', 'patient', 'What city were you born in?', 'melbourne', 'What is the name of your first school?', 'swinburne');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CarePlans` enum('Basic','Regular','Premium','') DEFAULT NULL,
  `MedicationRequirements` varchar(255) DEFAULT NULL,
  `FamilyContacts` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientID`, `FirstName`, `LastName`, `PhoneNumber`, `CarePlans`, `MedicationRequirements`, `FamilyContacts`, `username`) VALUES
(4, 'John', 'Doe', '0422334408', 'Regular', 'Dementia Medications', '0432556677', 'John'),
(5, 'Michael', 'Johnson', '0456120934', 'Regular', 'Osteoporosis Medications', '043311995', 'user'),
(6, 'Chris', 'John', '0421227689', 'Basic', 'Pain Management', '08212245678', 'Chris23');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Monday` varchar(255) NOT NULL,
  `Tuesday` varchar(255) NOT NULL,
  `Wednesday` varchar(255) NOT NULL,
  `Thursday` varchar(255) NOT NULL,
  `Friday` varchar(255) NOT NULL,
  `Saturday` varchar(255) NOT NULL,
  `Sunday` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Monday`, `Tuesday`, `Wednesday`, `Thursday`, `Friday`, `Saturday`, `Sunday`, `Position`, `ID`) VALUES
('Tess Brown', 'Tess Brown', 'Tess Brown', 'Tess Brown', 'Tess Brown', 'Alex Young', 'Alex Young', 'Front Staff', 1),
('Rick Jones', 'Rick Jones', 'Rick Jones', 'Rick Jones', 'Rick Jones', '-', '-', 'Doctor', 2),
('Byron Dallas', 'Byron Dallas', 'Byron Dallas', 'Byron Dallas', 'Byron Dallas', '-', '-', 'Administrator', 3),
('Kevin Nye', 'Kevin Nye', 'Alex Young', 'Alex Young', 'Alex Young', 'Kevin Nye', 'Kevin Nye', 'Caretaker1', 4),
('Lisa Rose', 'Lisa Rose', 'Lisa Rose', '-', 'Kevin Nye', 'Lisa Rose', 'Lisa Rose', 'Caretaker2', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_login`
--
ALTER TABLE `member_login`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `member_login`
--
ALTER TABLE `member_login`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
