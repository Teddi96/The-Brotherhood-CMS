-- phpMyAdmin SQL Dump
-- version 4.1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2015 at 01:17 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bh`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `profile_link` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  `reason` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci;


-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE IF NOT EXISTS `guides` (
  `P_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `link_description` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  `link_address` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  `sector` varchar(30) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `info` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  PRIMARY KEY (`P_id`),
  UNIQUE KEY `g_id` (`P_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `B_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_icelandic_ci,
  `profile_link` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  `sector` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  PRIMARY KEY (`B_id`),
  UNIQUE KEY `b_id` (`B_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `n_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  PRIMARY KEY (`n_id`),
  UNIQUE KEY `n_id` (`n_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `description` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  PRIMARY KEY (`s_id`),
  UNIQUE KEY `s_id` (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci AUTO_INCREMENT=3 ;


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_icelandic_ci NOT NULL,
  `password` text COLLATE utf8mb4_icelandic_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_icelandic_ci AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
