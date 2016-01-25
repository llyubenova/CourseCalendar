-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 24, 2016 at 08:31 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE EVENT (
  `TYPE` enum('HOMEWORK','EXAM','LECTURE','PROJECT','PRESENTANTION','PRACTICE','EVENT') COLLATE utf8_unicode_ci NOT NULL,
  `STARTDATE` datetime NOT NULL,
  `ENDDATE` datetime NOT NULL,
  `TITLE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LECTURER` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `LOCATION` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`TYPE`, `STARTDATE`, `ENDDATE`, `TITLE`, `DESCRIPTION`, `LECTURER`, `LOCATION`) VALUES
('EXAM', '2016-01-29 09:00:00', '2016-01-29 11:00:00', 'WWW Technoligies', NULL, NULL, 'FMI'),
('HOMEWORK', '2016-01-15 00:00:00', '2016-01-26 23:30:00', 'WWW Technilogies', NULL, NULL, NULL),
('LECTURE', '2016-02-03 13:00:00', '2016-02-03 16:00:00', 'Artificial Intelligence', NULL, NULL, 'FMI');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

