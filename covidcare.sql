-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 04:35 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covidcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `addhospital`
--

CREATE TABLE `addhospital` (
  `email_address` varchar(30) NOT NULL,
  `hospital_code` varchar(20) NOT NULL,
  `hospital_password` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_data`
--

CREATE TABLE `hospital_data` (
  `hospital_code` varchar(20) NOT NULL,
  `hospital_name` text NOT NULL,
  `hospital_address` text NOT NULL,
  `normal_bed` int(5) NOT NULL,
  `icu_bed` int(5) NOT NULL,
  `vent_bed` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hospital_operations`
--

CREATE TABLE `hospital_operations` (
  `hospital_code` varchar(20) NOT NULL,
  `hospital_name` varchar(30) NOT NULL,
  `hospital_address` varchar(30) NOT NULL,
  `normal_bed` int(5) NOT NULL,
  `icu_bed` int(5) NOT NULL,
  `vent_bed` int(5) NOT NULL,
  `query` varchar(20) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patientdata`
--

CREATE TABLE `patientdata` (
  `srfid` varchar(20) NOT NULL,
  `hospital_code` varchar(20) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `patient_address` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `oxygen_level` int(5) NOT NULL,
  `bed_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_operations`
--

CREATE TABLE `patient_operations` (
  `srfid` varchar(20) NOT NULL,
  `hospital_code` varchar(20) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `patient_address` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `oxygen_level` int(3) NOT NULL,
  `bed_type` varchar(10) NOT NULL,
  `query` varchar(20) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_signup`
--

CREATE TABLE `user_signup` (
  `email` varchar(30) NOT NULL,
  `srfid` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addhospital`
--
ALTER TABLE `addhospital`
  ADD PRIMARY KEY (`email_address`),
  ADD UNIQUE KEY `UNIQUE` (`hospital_code`);

--
-- Indexes for table `hospital_data`
--
ALTER TABLE `hospital_data`
  ADD PRIMARY KEY (`hospital_code`);

--
-- Indexes for table `hospital_operations`
--
ALTER TABLE `hospital_operations`
  ADD KEY `hospital_code` (`hospital_code`);

--
-- Indexes for table `patientdata`
--
ALTER TABLE `patientdata`
  ADD PRIMARY KEY (`srfid`);

--
-- Indexes for table `user_signup`
--
ALTER TABLE `user_signup`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `UNIQUE` (`srfid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hospital_operations`
--
ALTER TABLE `hospital_operations`
  ADD CONSTRAINT `hospital_operations_ibfk_1` FOREIGN KEY (`hospital_code`) REFERENCES `addhospital` (`hospital_code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;