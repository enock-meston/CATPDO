-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 10:56 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musanze`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `adid` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`adid`, `username`, `password`, `status`) VALUES
(1, 'enock1', '$2y$10$XMrBLdU4bBRhQQa.X3mpFefsvWyw9TW6MS6LEyExHrLptrOyGnmIu', 1),
(3, 'dj', '$2y$10$XMrBLdU4bBRhQQa.X3mpFefsvWyw9TW6MS6LEyExHrLptrOyGnmIu', 1),
(4, 'dj1', '$2y$10$XMrBLdU4bBRhQQa.X3mpFefsvWyw9TW6MS6LEyExHrLptrOyGnmIu', 1),
(5, 'enock12', '$2y$10$BEjitUHif5IgwL2uxGt5zObiU.Ij7gfWsa4YvRwIjw/cy/ikVajnK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblparks`
--

CREATE TABLE `tblparks` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `imagepark` varchar(200) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `Status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblparks`
--

INSERT INTO `tblparks` (`id`, `name`, `location`, `imagepark`, `descriptions`, `Status`) VALUES
(7, 'Mount Roraima', 'Brazil,Venezuela,Guiana', 'IMG-62849e5c8c97d7.01735796.jpg', '21 Oct 2014 — Post with 2 votes and 1850 views. Tagged with ; Mount Roraima, Brazil/Venezuela/Guiana', 1),
(8, 'nigoote', 'rwanda', 'IMG-62849ead486da9.00527889.jpg', 'nigoote. Products List. Nigoote Tutorials Projects. To Day is On 17 Tue-May-2022 -- at 04:05. Apple ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `rid` int(11) NOT NULL,
  `parkid` varchar(200) NOT NULL,
  `visitor` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`rid`, `parkid`, `visitor`, `date`, `Status`) VALUES
(20, '8', '9', '2022-05-18 07:30:30', 2),
(21, '8', '9', '2022-05-18 07:30:30', 2),
(22, '8', '10', '2022-05-21 12:55:14', 2),
(23, '7', '11', '2022-05-22 08:20:43', 1),
(24, '7', '11', '2022-05-22 08:20:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblvisitors`
--

CREATE TABLE `tblvisitors` (
  `vid` int(11) NOT NULL,
  `reference` varchar(11) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastnmae` varchar(45) NOT NULL,
  `phonenumber` varchar(18) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(3) NOT NULL,
  `vkey` int(3) NOT NULL,
  `verified` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblvisitors`
--

INSERT INTO `tblvisitors` (`vid`, `reference`, `firstname`, `lastnmae`, `phonenumber`, `email`, `password`, `status`, `vkey`, `verified`) VALUES
(7, '3459', 'nshimiyimana', 'dieudone', '0782185745', 'eric@gmail.com', '$2y$10$qQg429Di0uNHlotZ.3xQ5OG.1MVZjya4ZDVPBwwOqb9P5A9i9/FOO', 1, 2147483647, 0),
(8, '2597', 'mpayimana', 'cyiza', '0781990786', 'landryne@gmail.com', '$2y$10$bd5XsUSsZn/Sor5MwXQICe0CeX6/UjkPMJWRWJ2tQWXdCUVh6aD0C', 1, 36412, 0),
(9, '9470', 'prince', 'ngabo', '0787193329', 'ngaboprincemiller@gmail.com', '$2y$10$XMrBLdU4bBRhQQa.X3mpFefsvWyw9TW6MS6LEyExHrLptrOyGnmIu', 1, 3, 0),
(10, '2111', 'umuhoza', 'cynthia', '078218589', 'cynthia@gmail.com', '$2y$10$H4lQOGc8wYwcFXS1Whk9iuw5VAI4Xjyt05opc.NLD1Zq33mxgjZy.', 1, 581, 0),
(11, '8027', 'nsengimana', 'aime', '0781990678', 'nsengimanae068@gmail.com', '$2y$10$VXI0.hfGD7QDq4psetnuVeLU0ezLkiWF.69ZVDTbJJJ.7D890HTwq', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`adid`);

--
-- Indexes for table `tblparks`
--
ALTER TABLE `tblparks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblreservation`
--
ALTER TABLE `tblreservation`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `tblvisitors`
--
ALTER TABLE `tblvisitors`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `adid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblparks`
--
ALTER TABLE `tblparks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tblvisitors`
--
ALTER TABLE `tblvisitors`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
