-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2015 at 03:46 PM
-- Server version: 5.5.40
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `staff_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'New Department'),
(2, 'Department 2'),
(3, 'New Department 3'),
(4, 'Test 20'),
(5, 'Test 21');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `leave_type_id` int(8) NOT NULL,
  `from` bigint(12) NOT NULL,
  `to` bigint(12) NOT NULL,
  `single` int(2) NOT NULL,
  `half` int(2) NOT NULL,
  `days` int(4) NOT NULL,
  `remarks` text NOT NULL,
  `status` int(2) NOT NULL,
  `created` bigint(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `from`, `to`, `single`, `half`, `days`, `remarks`, `status`, `created`) VALUES
(1, 6, 1, 1, 1, 1, 1, 1, '1', 1, 0),
(2, 6, 1, 1, 1, 1, 1, 1, '1', 1, 0),
(3, 7, 4, 1, 1, 1, 1, 1, '1', 1, 0),
(4, 7, 2, 1, 1, 1, 1, 3, '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '1' COMMENT '1 => Permanent, 2 => Contractual',
  `days` int(2) NOT NULL COMMENT '# of days allowed for the leave type',
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `type`, `days`, `status`) VALUES
(1, 'With Pay', 1, 12, 1),
(2, 'Without Pay', 2, 12, 1),
(3, 'Casual Leave', 1, 12, 1),
(4, 'Medical Leave', 2, 12, 1),
(5, 'Maternity Leave', 1, 12, 1),
(6, 'Paternity Leave', 2, 12, 1),
(7, 'Educational Leave', 1, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `department_id` int(8) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(50) DEFAULT NULL,
  `hash` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1 => Admin, 2 => Department Admin, 3 => Staff',
  `staff_type` int(2) NOT NULL DEFAULT '1' COMMENT '1 => Permanent, 2 => Contractual',
  `created` int(32) NOT NULL,
  `status` int(2) DEFAULT '1' COMMENT '1 => Active, 2 => Inactive',
  `gender` int(2) NOT NULL COMMENT '1 is male and 2 is female',
  `dob` varchar(20) NOT NULL,
  `doj` varchar(20) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `department_id`, `username`, `password`, `salt`, `hash`, `type`, `staff_type`, `created`, `status`, `gender`, `dob`, `doj`, `description`) VALUES
(1, 'Admin', 0, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, '83f625dbed46f170ac970f29ec4f809bd1602def', 1, 1, 0, 1, 0, '', '', ''),
(6, 'Tashi', 2, 'tashi2', 'fc7793bb94c8bcc73173de08e6523a1a3ed7ae58', NULL, '', 2, 1, 0, 1, 1, 'July 03, 1990', 'June 03, 2013', 'Tashi test'),
(7, 'Tashi 2', 2, 'tashi2', 'fc7793bb94c8bcc73173de08e6523a1a3ed7ae58', NULL, NULL, 3, 2, 0, 1, 2, 'July 03, 1988', 'June 03, 2014', 'Test'),
(8, 'Tashi 3', 1, 'tashi3', '631c200e6b30d2b695419e83a6171be16f075c1d', NULL, NULL, 3, 1, 0, 1, 1, 'July 03, 1984', 'June 03, 2015', 'Tashi'),
(9, 'Tashi 4', 3, 'tashi3', '631c200e6b30d2b695419e83a6171be16f075c1d', NULL, NULL, 2, 1, 0, 1, 1, 'July 03, 1984', 'June 03, 2015', 'T4');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
