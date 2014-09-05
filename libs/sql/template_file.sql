-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2014 at 11:43 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Cms`
--

INSERT INTO `Cms` (`id`, `selfref`, `content`, `timestamp`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi efficitur efficitur ullamcorper. Curabitur sed feugiat nisi, ac feugiat diam. Nunc posuere mauris sed maximus elementum. Praesent sit amet lectus vitae orci interdum lacinia sit amet a velit. Phasellus turpis orci, lobortis sit amet accumsan eget, tempor a eros. Donec hendrerit interdum sodales. Fusce placerat, ante eget iaculis tempor, libero justo accumsan elit, non aliquam arcu nisl a justo. Aenean hendrerit id nisl sit amet ultrices. Nullam tempus velit eros, et rutrum turpis vestibulum in.\r\n\r\nDuis luctus, dui sit amet tincidunt pellentesque, erat ante feugiat purus, a pretium ante nisl in nunc. Morbi lobortis elit tincidunt eros volutpat, ut porta dolor hendrerit. Nunc et dictum quam, eu condimentum justo. Sed scelerisque fermentum velit at ullamcorper. Ut gravida massa a risus tincidunt sollicitudin. Etiam pharetra malesuada aliquet. Nulla dui felis, tincidunt vitae placerat at, semper at nisl. Curabitur ut nibh quis augue condimentum hendrerit.\r\n\r\nAliquam vel lacinia tortor. Ut fringilla egestas dictum. Vivamus augue odio, posuere a lectus nec, ultricies efficitur enim. Maecenas a quam eu erat molestie accumsan. Morbi nulla nulla, sagittis vel viverra nec, consequat et lacus. Etiam nec justo purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras suscipit est dolor, eget vulputate odio eleifend ut.', '2014-09-05 11:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `plugin` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Menu`
--

INSERT INTO `Menu` (`id`, `link`, `title`, `plugin`) VALUES
(1, '/', 'Frontpage', 'Cms');

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
