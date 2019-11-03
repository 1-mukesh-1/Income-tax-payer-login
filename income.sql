-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2019 at 08:48 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `income`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `user` varchar(30) NOT NULL,
  `acno` varchar(30) NOT NULL,
  `salary` int(15) NOT NULL,
  `pay` int(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user`, `acno`, `salary`, `pay`) VALUES
('102', 'qwetdbcdw', 1234567, 70370),
('103', 'lkjhgfd', 1234567890, 370070367),
('104', 'asdfghj', 90000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `user` int(3) NOT NULL,
  `tax` int(15) NOT NULL,
  `paid` int(15) NOT NULL,
  `balance` int(15) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`user`, `tax`, `paid`, `balance`) VALUES
(101, 20000, 20000, 0),
(104, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`username`, `password`) VALUES
('101', 'admin'),
('103', '103'),
('102', 'ki'),
('104', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `taxpayer`
--

DROP TABLE IF EXISTS `taxpayer`;
CREATE TABLE IF NOT EXISTS `taxpayer` (
  `username` int(3) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `salary` int(15) NOT NULL,
  `address` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phno` varchar(10) NOT NULL,
  `accno` varchar(15) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxpayer`
--

INSERT INTO `taxpayer` (`username`, `password`, `fname`, `lname`, `salary`, `address`, `email`, `phno`, `accno`) VALUES
(101, 'admin', 'admin', 'admin', 600000, 'abcdef', 'admin@gmail.com', '9876543210', 'qwertyuiopasdfg'),
(102, 'ki', 'mukesh', 'efgh', 1234567, 'qwertyuiopsdfghjklcvbn', 'abhaym0109@gmail.com', '2032898109', 'qwetdbcdw'),
(103, '103', 'mukesh', 'chemma', 1234567890, 'lkjhgfdsa', 'mukky@gmail.com', '987654321', 'lkjhgfd');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
