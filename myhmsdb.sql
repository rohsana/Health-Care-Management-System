-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 16, 2020 at 02:34 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintb`
--

CREATE TABLE `admintb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintb`
--

INSERT INTO `admintb` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttb`
--

CREATE TABLE `appointmenttb` (
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `docFees` int(5) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `userStatus` int(5) NOT NULL,
  `doctorStatus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointmenttb`
--

INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `apptime`, `userStatus`, `doctorStatus`) VALUES
(4, 1, 'Kshitij', 'sharma', 'Male', 'kshitij.msharma@gmail.com', '9765483290', 'suryansh', 600, '2024-05-26', '10:00:00', 1, 0),
(4, 2, 'suryansh', 'Talukdar', 'Male', 'suryansh.t0@gmail.com', '9765483290', 'vastav', 700, '2024-02-28', '10:00:00', 0, 1),
(4, 3, 'vastav', 'verma', 'Male', 'vastavsmart0@gmail.com', '9765483290', 'Amit', 1000, '2024-02-19', '03:00:00', 0, 1),
(11, 4, 'archana', 'Kapoor', 'Female', 'ak@gmail.com', '9768946252', 'chetan', 500, '2024-02-29', '20:00:00', 1, 1),
(4, 5, 'vastav', 'verma', 'Male', 'vastavsmart0@gmail.com', '9765483290', 'chetan', 700, '2024-02-28', '12:00:00', 1, 1),
(4, 6, 'vastav', 'verma', 'Male', 'vastavsmart0@gmail.com', '9765483290', 'suryansh', 550, '2024-02-26', '15:00:00', 0, 1),
(2, 8, 'Nisha', 'jain', 'Female', 'Nisha@gmail.com', '8976897689', 'Saurav', 550, '2024-03-21', '10:00:00', 1, 1),
(5, 9, 'Kshitij', 'Shankararam', 'Male', 'KS@gmail.com', '9765483290', 'suryansh', 550, '2024-03-19', '20:00:00', 1, 0),
(4, 10, 'Kshitij', 'sharma', 'Male', 'kshitij0@gmail.com', '9765483290', 'chetan', 550, '2024-10-09', '14:00:00', 1, 0),
(4, 11, 'Amit', 'Lal', 'Male', 'amit0@gmail.com', '9765483290', 'kshitij', 700, '2024-03-27', '15:00:00', 1, 1),
(9, 12, 'Amit', 'Bodi', 'Male', 'amit@gmail.com', '9765483290', 'Kaustubh', 800, '2024-03-26', '12:00:00', 1, 1),
(9, 13, 'chetan', 'Bodi', 'Male', 'chetan@gmail.com', '9765483290', 'suryansh', 450, '2024-03-26', '14:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(10) NOT NULL,
  `message` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES
('Tarun', 'Tarun@gmail.com', '8762947234', 'Hey there Group'),
(' Viking', 'viking@gmail.com', '9899775646', 'yokoso'),
('kshitij', 'kshitij@gmail.com', '8762947234', 'great consulting'),
('vastav', 'vastav@gmail.com', '8788979967', 'excellent'),
('Manimaran', 'manimaran@gmail.com', '8762947234', 'Want some rice?'),
('Kaju', 'kaju@gmail.com', '9899775646', 'Good service'),
('Agram', 'agram@gmail.com', '8762947234', 'Love your service'),
('chetan', 'chetan@gmail.com', '9899775646', 'Love your expertise. Thank you!'),
('jiorno jiovvano', 'jj@gmail.com', '7869869757', 'I feel good now!');

-- --------------------------------------------------------

--
-- Table structure for table `doctb`
--

CREATE TABLE `doctb` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `spec` varchar(50) NOT NULL,
  `docFees` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctb`
--

INSERT INTO `doctb` (`username`, `password`, `email`, `spec`, `docFees`) VALUES
('kshitij', 'kshitij234', 'kshitij@gmail.com', 'General', 500),
('suryansh', 'surya123', 'suryansh@gmail.com', 'Cardiologist', 600),
('vastav', 'vas123', 'vastav@gmail.com', 'General', 700),
('Geny', 'geny123', 'geny@gmail.com', 'Pediatrician', 550),
('amit', 'pal123', 'ap@gmail.com', 'Pediatrician', 800),
('chetan', 'chetan123', 'chetan@gmail.com', 'Cardiologist', 1000),
('Saurav', 'saurav123', 'saurav@gmail.com', 'Neurologist', 1500),
('divyansh', 'divyansh123', 'divyansh@gmail.com', 'Pediatrician', 450);

-- --------------------------------------------------------

--
-- Table structure for table `patreg`
--

CREATE TABLE `patreg` (
  `pid` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cpassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patreg`
--

INSERT INTO `patreg` (`pid`, `fname`, `lname`, `gender`, `email`, `contact`, `password`, `cpassword`) VALUES
(1, 'kshitij', 'sharma', 'Male', 'kshitij@gmail.com', '7643543210', 'ks123', 'ks123'),
(2, 'Suryansh', 'talukdar', 'Male', 'surya@gmail.com', '9976897689', 'st123', 'st123'),
(3, 'saurav', 'kumar', 'Male', 'saurav@gmail.com', '7976898463', 'sk123', 'sk123'),
(4, 'vastav', 'verma', 'Male', 'vastav0@gmail.com', '8838489464', 'vv123', 'vv123'),
(5, 'yash', 'jain', 'Male', 'yash@gmail.com', '8070897653', 'yash123', 'yash123'),
(6, 'chetan', 'beti', 'Male', 'chetan@gmail.com', '9549986865', 'cb123', 'cb123'),
(7, 'nita', 'singh', 'Female', 'nita@gmail.com', '9328972454', 'ns123', 'ns123'),
(8, 'divyansh', 'Singh', 'Male', 'divyansh@gmail.com', '7809879868', 'ds123', 'ds123'),
(9, 'aayush', 'haddi', 'Male', 'aayush@gmail.com', '9683619153', 'aayush123', 'aayush123'),
(10, 'karna', 'kumar', 'Male', 'kk@gmail.com', '8609362815', 'kk123', 'kk123'),
(11, 'anchal', 'Kapoor', 'Female', 'anchal@gmail.com', '9768946252', 'anchal123', 'anchal123');

-- --------------------------------------------------------

--
-- Table structure for table `prestb`
--

CREATE TABLE `prestb` (
  `doctor` varchar(50) NOT NULL,
  `pid` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `appdate` date NOT NULL,
  `apptime` time NOT NULL,
  `disease` varchar(250) NOT NULL,
  `allergy` varchar(250) NOT NULL,
  `prescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prestb`
--

INSERT INTO `prestb` (`doctor`, `pid`, `ID`, `fname`, `lname`, `appdate`, `apptime`, `disease`, `allergy`, `prescription`) VALUES
('Suryansh', 4, 11, 'kshitij', 'sharma', '2024-03-27', '15:00:00', 'Cough', 'Nothing', 'Just take a teaspoon of Benadryl every night'),
('Saurav', 2, 8, 'suryansh', 'Talukdar', '2024-03-21', '10:00:00', 'Severe Fever', 'Nothing', 'Take bed rest'),
('aakash', 9, 12, 'vastav', 'verma', '2024-03-26', '12:00:00', 'Sever fever', 'nothing', 'Paracetamol -> 1 every morning and night'),
('Chetan', 9, 13, 'vastav', 'verma', '2024-03-26', '14:00:00', 'Cough', 'Skin dryness', 'Intake fruits with more water content');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `patreg`
--
ALTER TABLE `patreg`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmenttb`
--
ALTER TABLE `appointmenttb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `patreg`
--
ALTER TABLE `patreg`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
