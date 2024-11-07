-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 04:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logparser`
--

-- --------------------------------------------------------

--
-- Table structure for table `logovi`
--

CREATE TABLE `logovi` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `s-ip` text NOT NULL,
  `cs-method` text NOT NULL,
  `cs-uri-stem` int(11) NOT NULL,
  `cs-uri-query` text NOT NULL,
  `s-port` int(11) NOT NULL,
  `cs-username` text NOT NULL,
  `c-ip` text NOT NULL,
  `cs(User-Agent)` text NOT NULL,
  `sc-status` int(11) NOT NULL,
  `sc-substatus` int(11) NOT NULL,
  `sc-win32-status` int(11) NOT NULL,
  `time-taken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
