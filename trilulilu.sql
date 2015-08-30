-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2015 at 12:21 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trilulilu`
--

-- --------------------------------------------------------

--
-- Table structure for table `descarcari`
--

CREATE TABLE IF NOT EXISTS `descarcari` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(64) NOT NULL,
  `nume` text NOT NULL,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `descarcari`
--

INSERT INTO `descarcari` (`id`, `ip`, `nume`, `data`) VALUES
(7, '188.25.88.10', 'David Guetta feat. Sia - Titanium [320 kbps].mp3', '2015-03-20 16:07:39'),
(8, '188.25.88.10', 'David Guetta feat. Sia - Titanium [320 kbps].mp3', '2015-03-20 16:14:48'),
(9, '188.25.88.10', 'David Guetta feat. Sia - Titanium [320 kbps].mp3', '2015-03-20 16:34:17');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
