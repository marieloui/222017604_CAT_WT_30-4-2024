-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muragijimana_louise_pt`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `AppointmentID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `AppointmentDate` varchar(20) DEFAULT NULL,
  `Reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`AppointmentID`, `PatientID`, `DoctorID`, `AppointmentDate`, `Reason`) VALUES
(30, 14, 0, '', 'drug control'),
(31, 16, 20, '2022-07-04 09:45:00', 'check up'),
(32, 12, 10, '2023-07-04 09:45:00', 'check up');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `BillID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `BillDate` varchar(20) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`BillID`, `PatientID`, `DoctorID`, `BillDate`, `Amount`) VALUES
(44, 19, 10, '2024-03-30', 444.00),
(51, 16, 10, '2024-03-31', 9000.00);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Specialty` varchar(50) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `FirstName`, `LastName`, `Specialty`, `PhoneNumber`, `Email`) VALUES
(0, 'Albine', 'ishimwe', 'Psychologists', '07956544', 'nasimwe@gmail.com'),
(10, 'Dave', 'Musa', 'Cardiologist ', '07233322', 'dave@gmail.com'),
(20, 'silak', 'mwene', 'Immunologist ', '07236754', 'mwene@gmail.com'),
(30, 'martin', 'chance', 'hgfdfghjk', '666666777', 'mar@gmail.com'),
(50, 'nelly', 'fida', 'orthip', '0789999', 'fida@gmail.com'),
(60, 'fffuu', 'gu', 'senior', '666666777', 'mar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `medical_record`
--

CREATE TABLE `medical_record` (
  `RecordID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `Diagnosis` varchar(255) DEFAULT NULL,
  `Prescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_record`
--

INSERT INTO `medical_record` (`RecordID`, `PatientID`, `DoctorID`, `Diagnosis`, `Prescription`) VALUES
(40, 14, 10, 'Biopsy', 'Benzodiazepine'),
(41, 16, 0, 'Colonoscopy', 'Nonbenzodiazepines '),
(42, 12, 20, 'Electrocardiogram', 'Opioids '),
(50, 27, 50, 'lkjh', 'koko');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `FirstName`, `LastName`, `Gender`, `PhoneNumber`) VALUES
(12, 'kely ', 'kane', 'female', '07812222'),
(14, 'holly', 'hane', 'male', '0793353'),
(16, 'jane', 'jelly', 'male', '07264647'),
(19, 'hirwa', 'david', 'male', '0987654'),
(20, 'gaju', 'benie', 'female', '0788456734'),
(21, 'Ganza', 'John', 'Male', '0788567845'),
(22, 'sdfgh', 'sdfgh', 'dfghj', '23456'),
(23, 'dfghj', NULL, NULL, '09876'),
(24, 'dfghj', 'fghj', NULL, '09876'),
(25, 'dfghj', 'fghj', NULL, '09876'),
(26, 'jhgfdsdfgh', 'mjhgfdsdfghj', 'Female', '666666777'),
(27, 'jhgfdsdfgh', 'mjhgfdsdfghj', 'Female', '666666777'),
(28, 'kokolp', 'juju', 'Female', '0897766'),
(29, 'gfgh', 'tre', 'Female', '0789999'),
(30, 'gfgh', 'tre', 'Female', '0789999');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'marie ', 'marie louse', '21RP06834', 'marielouisemuragijimanauwase@gmail.com', '0788877', '$2y$10$N1w4l3zyKFzvrN3zFIHX4udu9avmC./JEASYvAnM0.qgt/p0mIN4a', '2024-04-30 12:06:50', '2233', 0),
(2, 'mizero', 'hoj', 'ho3', 'mo@gmail.com', '9789', '$2y$10$2FqRCwJdLKDbkuak9CH3xOa0kDmOrDkToXKbB2mSYWNfM543B2jt2', '2024-04-30 12:08:13', '37838', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`AppointmentID`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `FK_Patient_Bill` (`PatientID`),
  ADD KEY `FK_Doctor_Bill` (`DoctorID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`RecordID`),
  ADD KEY `FK_Patient_MR` (`PatientID`),
  ADD KEY `FK_Doctor_MR` (`DoctorID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `BillID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `RecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK_Doctor` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`),
  ADD CONSTRAINT `FK_Patient` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `FK_PatientID` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`);

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `FK_Doctor_Bill` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`),
  ADD CONSTRAINT `FK_Patient_Bill` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`);

--
-- Constraints for table `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `FK_Doctor_MR` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`),
  ADD CONSTRAINT `FK_Patient_MR` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
