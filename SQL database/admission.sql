-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 02:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admission`
--

-- --------------------------------------------------------

--
-- Table structure for table `admissioninfo`
--

CREATE TABLE `admissioninfo` (
  `userID` int(11) NOT NULL,
  `Entry` varchar(255) NOT NULL,
  `TypeOfStud` varchar(255) NOT NULL,
  `ApplicantType` varchar(255) NOT NULL,
  `SHSstrand` varchar(255) NOT NULL,
  `LRN` varchar(15) NOT NULL,
  `ProgramName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admissioninfo`
--

INSERT INTO `admissioninfo` (`userID`, `Entry`, `TypeOfStud`, `ApplicantType`, `SHSstrand`, `LRN`, `ProgramName`) VALUES
(1, 'New', 'Grade 12 student', 'Filipino Applicant', 'TVL', '', 'Bachelor of Science In Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `educationalbackground`
--

CREATE TABLE `educationalbackground` (
  `userID` int(11) NOT NULL,
  `ElemSchoolName` varchar(255) NOT NULL,
  `ElemSchoolAddress` varchar(255) NOT NULL,
  `ElemYearGraduated` varchar(255) NOT NULL,
  `ElemType` varchar(255) NOT NULL,
  `HighSchoolName` varchar(255) NOT NULL,
  `HighSchoolAddress` varchar(255) NOT NULL,
  `HighSchoolGraduated` varchar(255) NOT NULL,
  `HighSchoolType` varchar(255) NOT NULL,
  `SHSName` varchar(255) NOT NULL,
  `SHSAddress` varchar(255) NOT NULL,
  `SHSYearGraduated` varchar(255) NOT NULL,
  `SHSTYPE` varchar(255) NOT NULL,
  `VocName` varchar(255) NOT NULL,
  `VocAddress` varchar(255) NOT NULL,
  `VocYearGraduated` varchar(255) NOT NULL,
  `VocType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educationalbackground`
--

INSERT INTO `educationalbackground` (`userID`, `ElemSchoolName`, `ElemSchoolAddress`, `ElemYearGraduated`, `ElemType`, `HighSchoolName`, `HighSchoolAddress`, `HighSchoolGraduated`, `HighSchoolType`, `SHSName`, `SHSAddress`, `SHSYearGraduated`, `SHSTYPE`, `VocName`, `VocAddress`, `VocYearGraduated`, `VocType`) VALUES
(1, 'School', 'SchoolAddress', '2016', 'Public', 'HighSchool', 'SchoolAddress', '2020', 'Public', 'SHS', 'SHSAddress', '2022', 'Public', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `familybackground`
--

CREATE TABLE `familybackground` (
  `userID` int(11) NOT NULL,
  `FathersName` varchar(255) NOT NULL,
  `FathersContact` varchar(255) NOT NULL,
  `FathersOccu` varchar(255) NOT NULL,
  `MothersName` varchar(255) NOT NULL,
  `MothersContact` varchar(255) NOT NULL,
  `MothersOccu` varchar(255) NOT NULL,
  `MonthlyIncome` varchar(255) NOT NULL,
  `NumOfSib` varchar(255) NOT NULL,
  `BirthOrder` varchar(255) NOT NULL,
  `GuardiansName` varchar(255) NOT NULL,
  `GuardiansContact` varchar(255) NOT NULL,
  `GuardiansOccu` varchar(255) NOT NULL,
  `SoloParent` varchar(255) NOT NULL,
  `FamWorkingAbroad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `familybackground`
--

INSERT INTO `familybackground` (`userID`, `FathersName`, `FathersContact`, `FathersOccu`, `MothersName`, `MothersContact`, `MothersOccu`, `MonthlyIncome`, `NumOfSib`, `BirthOrder`, `GuardiansName`, `GuardiansContact`, `GuardiansOccu`, `SoloParent`, `FamWorkingAbroad`) VALUES
(1, '', '', '', '', '', '', '0', '', '', 'Julie', '09123911333', 'Occupation', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `medicalhistory`
--

CREATE TABLE `medicalhistory` (
  `userID` int(11) NOT NULL,
  `Medications` text NOT NULL,
  `typeOfIllness` varchar(255) NOT NULL,
  `PWD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicalhistory`
--

INSERT INTO `medicalhistory` (`userID`, `Medications`, `typeOfIllness`, `PWD`) VALUES
(1, '', '', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo`
--

CREATE TABLE `personalinfo` (
  `userID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Suffix` varchar(255) NOT NULL,
  `Region` varchar(255) NOT NULL,
  `Province` varchar(255) NOT NULL,
  `Town` varchar(255) NOT NULL,
  `Barangay` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `ZipCode` varchar(255) NOT NULL,
  `CellphoneNumber` varchar(255) NOT NULL,
  `LandlineNumber` varchar(255) NOT NULL,
  `CivilStatus` varchar(255) NOT NULL,
  `Sex` varchar(255) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `PlaceOfBirth` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `Indigenous` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personalinfo`
--

INSERT INTO `personalinfo` (`userID`, `FirstName`, `MiddleName`, `LastName`, `Suffix`, `Region`, `Province`, `Town`, `Barangay`, `Street`, `ZipCode`, `CellphoneNumber`, `LandlineNumber`, `CivilStatus`, `Sex`, `DateOfBirth`, `PlaceOfBirth`, `Religion`, `Indigenous`) VALUES
(1, 'Meg', '', 'Fabian', '', 'IVA', 'Cavite', 'Imus', 'Malagasang-1D', 'Jade', '4103', '09478645104', '', '', '', '2003-12-08', 'Manila', '', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `control_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`userID`, `email`, `name`, `control_number`) VALUES
(1, 'fabian.megangeline2003@gmail.com', 'Meg Angeline Fabian', 38710);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
