-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 09:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dentalsea`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(20) NOT NULL,
  `adminFName` varchar(20) NOT NULL,
  `adminLName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminFName`, `adminLName`) VALUES
('jun', 'Jun Kuan', 'Lee'),
('zq', 'Zhen Quan', 'Chow');

-- --------------------------------------------------------

--
-- Table structure for table `clinicprofile`
--

CREATE TABLE `clinicprofile` (
  `clinicloginID` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinicprofile`
--

INSERT INTO `clinicprofile` (`clinicloginID`, `password`) VALUES
('dSEA123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `dentalassistant`
--

CREATE TABLE `dentalassistant` (
  `assistantID` varchar(20) NOT NULL,
  `assistantFName` varchar(20) NOT NULL,
  `assistantLName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dentalassistant`
--

INSERT INTO `dentalassistant` (`assistantID`, `assistantFName`, `assistantLName`) VALUES
('owen', 'Hong Jun', 'Lim'),
('pon', 'Pongsin', 'Lertchawalit');

-- --------------------------------------------------------

--
-- Table structure for table `dentist`
--

CREATE TABLE `dentist` (
  `dentistID` varchar(11) NOT NULL,
  `dentistFName` varchar(20) NOT NULL,
  `dentistLName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dentist`
--

INSERT INTO `dentist` (`dentistID`, `dentistFName`, `dentistLName`) VALUES
('jtantono', 'Junior', 'Tantono');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `patientName` varchar(50) NOT NULL,
  `ICorPassport` varchar(20) NOT NULL,
  `DoB` date NOT NULL,
  `title` set('Mr','Miss','Ms','Mrs','Madam','Dr','Prof','Master','Professor','Dato','Datin') NOT NULL,
  `sex` set('Male','Female','Unspecified') NOT NULL,
  `maritalStatus` set('Single','Married','Divorced','Separated','Widowed','Unspecified') NOT NULL DEFAULT 'Single',
  `postalcode` int(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNO` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nextOfKin` varchar(50) DEFAULT NULL,
  `relationship` varchar(10) DEFAULT NULL,
  `contactInfo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `patientName`, `ICorPassport`, `DoB`, `title`, `sex`, `maritalStatus`, `postalcode`, `address`, `phoneNO`, `email`, `nextOfKin`, `relationship`, `contactInfo`) VALUES
(1, 'Junior Tantono', 'A123562', '1996-06-10', 'Mr', 'Male', 'Single', NULL, NULL, '81234567', 'dentalsea123@gmail.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `loginID` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`loginID`, `password`) VALUES
('admin', '123'),
('jtantono', '123'),
('jun', '123'),
('owen', '123'),
('pon', '123'),
('zq', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `adminIDFkey` (`adminID`);

--
-- Indexes for table `clinicprofile`
--
ALTER TABLE `clinicprofile`
  ADD PRIMARY KEY (`clinicloginID`);

--
-- Indexes for table `dentalassistant`
--
ALTER TABLE `dentalassistant`
  ADD KEY `assistantIDFkey` (`assistantID`);

--
-- Indexes for table `dentist`
--
ALTER TABLE `dentist`
  ADD KEY `dentistID` (`dentistID`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`loginID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `adminIDFkey` FOREIGN KEY (`adminID`) REFERENCES `userprofile` (`loginID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dentalassistant`
--
ALTER TABLE `dentalassistant`
  ADD CONSTRAINT `assistantIDFkey` FOREIGN KEY (`assistantID`) REFERENCES `userprofile` (`loginID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dentist`
--
ALTER TABLE `dentist`
  ADD CONSTRAINT `DentistIDFkey` FOREIGN KEY (`dentistID`) REFERENCES `userprofile` (`loginID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
