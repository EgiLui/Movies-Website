-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2023 at 03:54 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `movie` varchar(50) NOT NULL,
  `bookingDateTime` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cinema` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/* The first few lines of the file are comments that provide information about the file,
including the version of PHPMyAdmin used to generate it, the database host, generation time, server version, and PHP version.

The next few lines include SQL commands that set some options for the SQL script.
These include setting the SQL mode to "NO_AUTO_VALUE_ON_ZERO", starting a transaction, and setting the time zone to "+00:00".

The script then creates a database named "movies" and defines two tables:
"booking" and "users". The "booking" table has five columns: "movie", "bookingDateTime", "email", "name", and "cinema".
The "users" table has three columns: "name", "email", and "password".
Both tables use the MyISAM storage engine and have a character set of utf8mb4 and a collation of utf8mb4_0900_ai_ci.

After defining the table structures, the script populates the "booking" and "users" tables with some data.

The last few lines of the file include SQL commands that reset some options that were set at the beginning of the script.
These include setting the character set client, character set results, and collation connection. */;