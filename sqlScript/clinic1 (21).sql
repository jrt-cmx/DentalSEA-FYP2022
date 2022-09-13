-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 04:53 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic1`
--
CREATE DATABASE IF NOT EXISTS `clinic1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinic1`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `loginID` varchar(20) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`loginID`, `fName`, `lName`) VALUES
('AdminTest', 'test3', 'test4'),
('zq', 'zq', 'c'),
('zq1', 'test1', 'test2');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointmentID` int(11) NOT NULL,
  `ICorPassportNo` varchar(20) NOT NULL,
  `dentistID` varchar(20) DEFAULT NULL,
  `assistantID` varchar(20) DEFAULT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `type` enum('Cleaning','Tooth Extraction','Other Services') NOT NULL,
  `remarks` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointmentID`, `ICorPassportNo`, `dentistID`, `assistantID`, `startTime`, `endTime`, `type`, `remarks`) VALUES
(7, '6EFYFYK', 'dentist1', 'Assistant1', '2022-07-27 10:30:00', '2022-07-27 11:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clinicaccount`
--

CREATE TABLE `clinicaccount` (
  `clinicloginID` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinicaccount`
--

INSERT INTO `clinicaccount` (`clinicloginID`, `password`) VALUES
('d123', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF'),
('dSEA123', '40BD001563085FC35165329EA1FF5C5ECBDBBEEF');

-- --------------------------------------------------------

--
-- Table structure for table `dentalassistant`
--

CREATE TABLE `dentalassistant` (
  `loginID` varchar(20) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dentalassistant`
--

INSERT INTO `dentalassistant` (`loginID`, `fName`, `lName`) VALUES
('Assistant1', 'Johnny ', 'Test1');

-- --------------------------------------------------------

--
-- Table structure for table `dentist`
--

CREATE TABLE `dentist` (
  `loginID` varchar(20) NOT NULL,
  `fName` varchar(20) NOT NULL,
  `lName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dentist`
--

INSERT INTO `dentist` (`loginID`, `fName`, `lName`) VALUES
('dentist1', 'DentistTest1', '123'),
('dentist2', 'dentist2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `no` int(10) UNSIGNED NOT NULL,
  `idNo` varchar(20) NOT NULL,
  `filename` varchar(1000) NOT NULL,
  `imageText` varchar(1000) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`no`, `idNo`, `filename`, `imageText`, `date`) VALUES
(23, 'A123562', 'berserker.PNG', '456', '2022-07-09 16:31:58'),
(30, '3Q1BSV6', 'bf-2042-blog-image-aricaharbor.jpg.adapt.crop16x9.818p.jpg', '456', '2022-08-01 17:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoiceID` int(100) NOT NULL,
  `prescriptionID` int(10) NOT NULL,
  `NRIC` varchar(20) NOT NULL,
  `patientName` varchar(1000) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(1000) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `consultationCost` int(10) NOT NULL,
  `payment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoiceID`, `prescriptionID`, `NRIC`, `patientName`, `date`, `time`, `location`, `remarks`, `price`, `consultationCost`, `payment`) VALUES
(12, 11, 'A123562', 'Junior Tantono    ', '2022-07-11', '11:50:30', '461 Clementi Rd,Singapore 599491', 'Cash Payment', 245, 125, 'PAID'),
(13, 33, 'A123562', 'Junior Tantono    ', '2022-07-29', '08:47:55', '461 Clementi Rd,Singapore 599491', 'Card Payment', 200, 100, 'PAID'),
(15, 35, '45HVHPQ', 'Donna Burch', '2022-07-30', '01:19:38', '461 Clementi Rd,Singapore 599491', 'Card Payment', 75, 45, 'PAID');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `medicationID` int(11) NOT NULL,
  `medicationName` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` int(11) NOT NULL,
  `expiryDate` date NOT NULL,
  `quantity` int(100) NOT NULL,
  `lowThreshold` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`medicationID`, `medicationName`, `description`, `price`, `expiryDate`, `quantity`, `lowThreshold`) VALUES
(2, 'ANALGESICS', 'Non-narcotic analgesics are the most commonly used drugs for relief of toothache or pain following dental treatment as well as fever. ', 10, '2023-06-03', 1000, 10),
(3, 'ANESTHETICS', 'Topical anesthetics come in ointments, sprays, or liquids. Topical anesthetics are used to prevent pain on the surface level of the lining of the mouth. They also can be used to reduce pain from superficial sores in the mouth or to numb an area before an injectable local anesthetic is given.', 10, '2023-06-03', 1000, 10),
(4, 'benzocaine', 'asd', 10, '2023-06-03', 1000, 10),
(5, 'Orajel', 'asdasdasd', 10, '2023-06-03', 1000, 10),
(1, 'PANADOL', 'cold and flu', 5, '2023-07-01', 1000, 10),
(6, 'testMed1', 'TestMed1', 10, '2023-07-27', 1000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `nextofkin`
--

CREATE TABLE `nextofkin` (
  `ICorPassportNo` varchar(50) NOT NULL,
  `nokName` varchar(50) NOT NULL,
  `nokICorPassportNo` varchar(50) NOT NULL,
  `nokIdType` enum('NRIC','FIN','Passport','Birth Certificate','Others') NOT NULL DEFAULT 'NRIC',
  `relationship` varchar(50) NOT NULL,
  `contactNo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nextofkin`
--

INSERT INTO `nextofkin` (`ICorPassportNo`, `nokName`, `nokICorPassportNo`, `nokIdType`, `relationship`, `contactNo`) VALUES
('3Q1BSV6', 'test2', 's1234567h', 'FIN', 'mom', '81234455'),
('3Q1BSV6', 'test', 's1234567o', 'Birth Certificate', 'mom', '87345678'),
('3Q1BSV6', 'test', 's1234567s', 'Birth Certificate', 'mom', '81234567'),
('3Q1BSV6', 'test', 's1234567u', 'NRIC', 'mom', '81234567'),
('3Q1BSV6', 'test', 's1234567v', 'Birth Certificate', 'mom', '81234577'),
('Q1F66Y6', 'Madam Cook Ducklett', 'G8487762A', 'NRIC', 'Sister', '64440705'),
('Q1F66Y6', 'Madam Cook Duck', 'S4988142H', 'NRIC', 'Mother', '62984342 ');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientID` int(11) NOT NULL,
  `patientName` varchar(50) NOT NULL,
  `ICorPassportNo` varchar(20) NOT NULL,
  `idType` enum('NRIC','FIN','Passport','Birth Certificate','Others') NOT NULL DEFAULT 'NRIC',
  `DoB` date NOT NULL,
  `allergy` enum('Yes','No','Unknown') NOT NULL DEFAULT 'No',
  `allergyNote` varchar(100) DEFAULT NULL,
  `source` enum('Insurance','Friend/Family of staff','Doctor referal','Google/Search engine','Social Media','Influencers','TV/Radio','News','Walk-in') NOT NULL,
  `sourceNote` varchar(50) NOT NULL,
  `title` enum('Mr','Miss','Ms','Mrs','Madam','Dr','Prof','Master') DEFAULT 'Mr',
  `sex` enum('Male','Female','Unspecified') NOT NULL DEFAULT 'Male',
  `maritalStatus` enum('Single','Married','Divorced','Separated','Widowed','Unspecified') NOT NULL DEFAULT 'Single',
  `postalcode` int(6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phoneNO` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nextOfKinIC` varchar(50) DEFAULT NULL,
  `relationship` varchar(10) DEFAULT NULL,
  `contactInfo` varchar(20) DEFAULT NULL,
  `preferredLang` varchar(20) DEFAULT NULL,
  `origin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `patientName`, `ICorPassportNo`, `idType`, `DoB`, `allergy`, `allergyNote`, `source`, `sourceNote`, `title`, `sex`, `maritalStatus`, `postalcode`, `address`, `phoneNO`, `email`, `nextOfKinIC`, `relationship`, `contactInfo`, `preferredLang`, `origin`) VALUES
(3, 'Randy Vasquez', '3Q1BSV6', 'NRIC', '1994-03-01', 'No', NULL, 'Friend/Family of staff', '', 'Prof', 'Unspecified', 'Single', NULL, NULL, '98456345', 'anastacio.zemlak@hotmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Indonesia'),
(4, 'Donna Burch', '45HVHPQ', 'NRIC', '1990-07-11', 'No', NULL, 'Friend/Family of staff', '', 'Master', 'Male', 'Single', NULL, NULL, '80594564', 'coy_buckridge@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Malaysia'),
(6, 'Libby Jordan', '6EFYFYK', 'NRIC', '2000-11-14', 'Unknown', NULL, 'Friend/Family of staff', '', 'Mrs', 'Female', 'Single', NULL, NULL, '95554345', 'claud_lubowitz46@hotmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Singapore'),
(7, 'Amelie Cooley', '7B5LY2O', 'NRIC', '1987-12-15', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Madam', 'Female', 'Single', NULL, NULL, '87653433', 'lazaro29@hotmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Indonesia'),
(8, 'Adam Grimes', '8O3GJG5', 'NRIC', '1988-01-13', 'Unknown', NULL, 'Friend/Family of staff', '', 'Prof', 'Male', 'Single', NULL, NULL, '93423455', 'fern.buckridge68@hotmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Singapore'),
(9, 'Junior Tantono    ', 'A123562', 'NRIC', '1996-06-10', 'No', '', 'Friend/Family of staff', '', 'Mr', 'Male', 'Single', 999777, 'blk 111', '81234567', 'dentalsea123@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Indonesia'),
(10, 'Allan Kelley', 'B5AOIQG', 'NRIC', '2000-04-10', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Ms', 'Female', 'Single', NULL, NULL, '85853453', 'kaya_denesik12@hotmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Indonesia'),
(11, 'Sienna Willis', 'DDQ95SE', 'NRIC', '1994-10-24', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Master', 'Female', 'Single', NULL, NULL, '88345343', 'monserrate71@yahoo.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Singapore'),
(12, 'Simeon Hartman', 'JDEYXZM', 'NRIC', '1992-12-23', 'Unknown', NULL, 'Friend/Family of staff', '', 'Miss', 'Female', 'Single', NULL, NULL, '94356673', 'lauryn35@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Indonesia'),
(13, 'Madden Cook Chicken', 'Q1F66Y6', 'NRIC', '1981-02-12', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Miss', 'Female', 'Single', 135791, '', '98765443', 'sister.hettinger@yahoo.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Singapore'),
(14, 'Marlee Herrera', 'SPDZKY3', 'NRIC', '1994-11-22', 'Unknown', NULL, 'Friend/Family of staff', '', 'Mr', 'Male', 'Single', NULL, NULL, '99345534', 'sister.hettinger@yahoo.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Malaysia'),
(15, 'Sebastian Hanna', 'U5LO35O', 'NRIC', '2001-12-07', 'No', NULL, 'Friend/Family of staff', '', 'Madam', 'Female', 'Single', NULL, NULL, '89345343', 'lord13@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Malaysia'),
(16, 'Emmanuel Stephens', 'WE9M3F2', 'NRIC', '1992-12-07', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Mr', 'Male', 'Single', NULL, NULL, '97567445', 'marcelle51@yahoo.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Thailand'),
(17, 'Enzo Key', 'XFJT1IN', 'NRIC', '1993-06-18', 'Yes', 'peanut', 'Friend/Family of staff', '', 'Mrs', 'Female', 'Single', NULL, NULL, '92345245', 'joesph.jast56@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Malaysia'),
(18, 'Bruce Mays', 'ZNB4MLM', 'NRIC', '1993-10-07', 'Unknown', NULL, 'Friend/Family of staff', '', 'Madam', 'Female', 'Single', NULL, NULL, '82346264', 'fiona62@gmail.com', 'NUL', 'NUL', 'NUL', 'NUL', 'Thailand');

-- --------------------------------------------------------

--
-- Table structure for table `patientnotes`
--

CREATE TABLE `patientnotes` (
  `number` int(10) UNSIGNED NOT NULL,
  `idNo` varchar(20) NOT NULL,
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patientnotes`
--

INSERT INTO `patientnotes` (`number`, `idNo`, `remarks`) VALUES
(1, '7B5LY2O', 'TEST'),
(2, 'A123562', 'TEST2131231231321313213132132123132132132132 '),
(3, 'A123562', 'aaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbdddddddddddddddddddddddddddddddccccccccccccccccccccccccccccccccccccccccccccccccasdasdasdasdasd'),
(4, 'A123562', 'testest'),
(5, 'A123562', 'hellow 1 2 3 4 5 '),
(14, '3Q1BSV6', '8766\r\n'),
(16, '3Q1BSV6', 'testt'),
(17, '3Q1BSV6', 'asdasdasdad');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescriptionID` int(11) NOT NULL,
  `NRIC` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescriptionID`, `NRIC`, `date`, `time`) VALUES
(11, 'A123562', '2022-07-11', '11:50:30'),
(12, 'A123562', '2022-07-10', '02:28:45'),
(33, 'A123562', '2022-07-29', '08:47:55'),
(34, '3Q1BSV6', '2022-07-29', '11:15:03'),
(35, '45HVHPQ', '2022-07-30', '01:19:38'),
(36, '3Q1BSV6', '2022-07-31', '08:03:48'),
(37, '3Q1BSV6', '2022-07-31', '09:31:53'),
(38, '3Q1BSV6', '2022-07-31', '09:43:46'),
(39, '3Q1BSV6', '2022-07-31', '09:49:02'),
(40, '3Q1BSV6', '2022-08-01', '02:11:23'),
(41, '3Q1BSV6', '2022-08-04', '11:43:23'),
(42, '3Q1BSV6', '2022-08-04', '11:47:31'),
(43, '3Q1BSV6', '2022-08-04', '11:50:28'),
(49, '3Q1BSV6', '2022-08-05', '12:06:32'),
(50, '45HVHPQ', '2022-08-05', '12:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptiondetails`
--

CREATE TABLE `prescriptiondetails` (
  `prescriptionID` int(11) NOT NULL,
  `medicationName` varchar(100) NOT NULL,
  `dosage` int(11) NOT NULL,
  `amtToTake` varchar(100) NOT NULL,
  `amtTimeFrame` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescriptiondetails`
--

INSERT INTO `prescriptiondetails` (`prescriptionID`, `medicationName`, `dosage`, `amtToTake`, `amtTimeFrame`) VALUES
(11, 'PANADOL', 4, '4', '4'),
(12, 'ANESTHETICS', 3, '32', 'test3'),
(11, 'ANESTHETICS', 2, '3', '2'),
(11, 'benzocaine', 5, '1', '2'),
(11, 'Orajel', 3, '3', '3'),
(33, 'ANALGESICS', 1, '5', '5'),
(33, 'ANESTHETICS', 2, '5', '5'),
(33, 'benzocaine', 3, '5', '5'),
(33, 'Orajel', 4, '5', '5'),
(34, 'PANADOL', 2, '3', '4'),
(34, 'testMed1', 3, '3', '4'),
(35, 'ANALGESICS', 1, '3', '3'),
(35, 'Orajel', 1, '3', '3'),
(35, 'testMed1', 1, '3', '3'),
(36, 'ANALGESICS', 2, '3', '3'),
(36, 'ANESTHETICS', 3, '3', '3'),
(37, 'testMed1', 5, '5', '5'),
(38, 'benzocaine', 3, '3', '3'),
(39, 'Orajel', 2, '3', '3'),
(40, 'testMed1', 1, '1', '1'),
(40, 'testMed1', 1, '1', '1'),
(40, 'PANADOL', 1, '5', '5 days'),
(41, 'benzocaine', 1, '1', '1'),
(41, 'ANALGESICS', 2, '1', '1'),
(42, 'benzocaine', 2, '32', '5 days'),
(42, 'PANADOL', 1, '5', '5 days'),
(43, 'benzocaine', 1, '1', '1'),
(43, 'ANESTHETICS', 1, '1', '1'),
(49, 'PANADOL', 1, '32', '5 days'),
(50, 'ANESTHETICS', 2, '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `loginID` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` enum('Dentist','Assistant','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`loginID`, `password`, `userType`) VALUES
('admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin'),
('AdminTest', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin'),
('assistant', '8cb2237d0679ca88db6464eac60da96345513964', 'Assistant'),
('Assistant1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Assistant'),
('dentist', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dentist'),
('dentist1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dentist'),
('dentist2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Dentist'),
('zq', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin'),
('zq1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `adminIDFkey` (`loginID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `ICorPassportNo` (`ICorPassportNo`),
  ADD KEY `dentistID` (`dentistID`),
  ADD KEY `assistantid` (`assistantID`);

--
-- Indexes for table `clinicaccount`
--
ALTER TABLE `clinicaccount`
  ADD PRIMARY KEY (`clinicloginID`);

--
-- Indexes for table `dentalassistant`
--
ALTER TABLE `dentalassistant`
  ADD KEY `assistantIDFkey` (`loginID`);

--
-- Indexes for table `dentist`
--
ALTER TABLE `dentist`
  ADD KEY `dentistID` (`loginID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoiceID`),
  ADD KEY `FK_prescriptionID1` (`prescriptionID`),
  ADD KEY `FK_NRIC1` (`NRIC`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`medicationName`),
  ADD UNIQUE KEY `medicationID` (`medicationID`);

--
-- Indexes for table `nextofkin`
--
ALTER TABLE `nextofkin`
  ADD PRIMARY KEY (`ICorPassportNo`,`nokICorPassportNo`),
  ADD KEY `ICorPassportNo` (`ICorPassportNo`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`),
  ADD UNIQUE KEY `ICorPassportNo` (`ICorPassportNo`);

--
-- Indexes for table `patientnotes`
--
ALTER TABLE `patientnotes`
  ADD PRIMARY KEY (`number`),
  ADD KEY `fk_foreign_key_name` (`idNo`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescriptionID`),
  ADD KEY `FK_nric` (`NRIC`);

--
-- Indexes for table `prescriptiondetails`
--
ALTER TABLE `prescriptiondetails`
  ADD KEY `FK_prescriptionID` (`prescriptionID`),
  ADD KEY `FK_medicationName` (`medicationName`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`loginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `no` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoiceID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `medicationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `patientnotes`
--
ALTER TABLE `patientnotes`
  MODIFY `number` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `assistantid` FOREIGN KEY (`assistantID`) REFERENCES `dentalassistant` (`loginID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dentistid` FOREIGN KEY (`dentistID`) REFERENCES `dentist` (`loginID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `icorpassportno` FOREIGN KEY (`ICorPassportNo`) REFERENCES `patient` (`ICorPassportNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `FK_NRIC1` FOREIGN KEY (`NRIC`) REFERENCES `prescription` (`NRIC`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prescriptionID1` FOREIGN KEY (`prescriptionID`) REFERENCES `prescription` (`prescriptionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nextofkin`
--
ALTER TABLE `nextofkin`
  ADD CONSTRAINT `nextofkin_fk_1` FOREIGN KEY (`ICorPassportNo`) REFERENCES `patient` (`ICorPassportNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patientnotes`
--
ALTER TABLE `patientnotes`
  ADD CONSTRAINT `fk_foreign_key_name` FOREIGN KEY (`idNo`) REFERENCES `patient` (`ICorPassportNo`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `FK_nric` FOREIGN KEY (`NRIC`) REFERENCES `patient` (`ICorPassportNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescriptiondetails`
--
ALTER TABLE `prescriptiondetails`
  ADD CONSTRAINT `FK_medicationName` FOREIGN KEY (`medicationName`) REFERENCES `medication` (`medicationName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_prescriptionID` FOREIGN KEY (`prescriptionID`) REFERENCES `prescription` (`prescriptionID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
