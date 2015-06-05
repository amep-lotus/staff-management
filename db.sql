-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 04, 2015 at 03:52 PM
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
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `status`) VALUES
(1, 'With Pay', 1),
(2, 'Without Pay', 1),
(3, 'Casual Leave', 1),
(4, 'Medical Leave', 1),
(5, 'Maternity Leave', 1),
(6, 'Paternity Leave', 1),
(7, 'Educational Leave', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `department_id`, `username`, `password`, `salt`, `hash`, `type`, `staff_type`, `created`, `status`, `gender`, `dob`, `doj`, `description`) VALUES
(1, 'Admin', 0, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, '23e09af39c017c81c827e83c84187c9ba9ff978e', 1, 1, 0, 1, 0, '', '', ''),
(6, 'Tashi', 1, 'Tashi', 'eacc2fb04cce3bb513343ad14812ee0407a4d04a', NULL, NULL, 3, 1, 0, 1, 1, 'July 03, 1984', 'June 03, 2015', 'Tashi'),
(7, 'Tashi 2', 1, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', NULL, NULL, 3, 1, 0, 1, 1, 'July 03, 1984', 'June 03, 2015', 'Admin'),
(8, 'Tashi 3', 1, 'tashi3', '631c200e6b30d2b695419e83a6171be16f075c1d', NULL, NULL, 2, 1, 0, 1, 1, 'July 03, 1984', 'June 03, 2015', 'Tashi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `leave_types` ADD `type` INT( 2 ) NOT NULL DEFAULT '1' COMMENT '1 => Permanent, 2 => Contractual' AFTER `name` ,
ADD `days` INT( 2 ) NOT NULL COMMENT '# of days allowed for the leave type' AFTER `type` ;

