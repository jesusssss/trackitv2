-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2014 at 10:45 AM
-- Server version: 5.5.35-1ubuntu1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baademedia_template`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cms`
--

CREATE TABLE IF NOT EXISTS `Cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selfref` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Cms`
--

INSERT INTO `Cms` (`id`, `selfref`, `content`, `timestamp`) VALUES
(1, 1, 'Dette.', '2014-09-02 07:00:17'),
(2, 2, 'Bum bum.', '2014-09-02 07:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `plugin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Menu`
--

INSERT INTO `Menu` (`id`, `link`, `plugin`) VALUES
(1, '/', 'Cms'),
(2, '/about', 'Cms');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `admin`) VALUES
(1, 'rbp', '1000koder', 'Rene', 'Pedersen', 'rbp@tigermedia.dk', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
