-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2022 at 05:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

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
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblparks`
--

CREATE TABLE `tblparks` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `imagepark` varchar(200) NOT NULL,
  `location` varchar(45) NOT NULL,
  `descriptions` varchar(100) NOT NULL,
  `Status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblparks`
--

INSERT INTO `tblparks` (`id`, `name`, `imagepark`, `location`, `descriptions`, `Status`) VALUES
(2, 'musanze park ', 'IMG-6203d7037b0de1.13437692.jpg', 'Musanze', 'For those keen to stay closer to the edge of the Volcanoes National Park, there are various boutique', 1),
(4, 'Gorilla musanze park', 'IMG-6203d8106ee6a5.91032043.jpg', 'Musanze', 'For those keen to stay closer to the edge of the Volcanoes National Park, there are various boutique', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblreservation`
--

CREATE TABLE `tblreservation` (
  `rid` int(11) NOT NULL,
  `parkid` varchar(11) NOT NULL,
  `visitor` varchar(11) NOT NULL,
  `Status` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblreservation`
--

INSERT INTO `tblreservation` (`rid`, `parkid`, `visitor`, `Status`) VALUES
(5, '4', '4', 1);

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
(1, '$reference', '$fname', '$lname', '$phone', '$email', '$hashpassword', 0, 0, 0),
(2, '2846', 'enock', 'ndagijimana', '0783982872', 'ndagijimanaenock11@gmail.com', '$2y$10$89PsTBbL0Gs6iojINRRxKOiyM7k7T0mFCNupwbtf/zY9ozcPMVOdi', 1, 3, 0),
(4, '6300', 'Eric', 'ndikumana', '0780805318', 'ndikumanaeric001@gmail.com', '$2y$10$b/gY1SM8i10OKrzjBeC0OeZuxx3xEoqnrHevEkzKFQ1FF24jk97.6', 1, 0, 0);

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
  MODIFY `adid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblparks`
--
ALTER TABLE `tblparks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblreservation`
--
ALTER TABLE `tblreservation`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblvisitors`
--
ALTER TABLE `tblvisitors`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
