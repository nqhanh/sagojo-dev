-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2014 at 04:31 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wordpress`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_pm`
--

CREATE TABLE IF NOT EXISTS `wp_pm` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `content` text NOT NULL,
  `sender` varchar(60) NOT NULL,
  `recipient` varchar(60) NOT NULL,
  `timesender` varchar(200) NOT NULL,
  `read` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `displaynamesender` varchar(200) NOT NULL,
  `displaynamerecipient` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1166 ;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_jobseekers_views` ON SCHEDULE EVERY 1 DAY STARTS '2013-01-01 03:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `wpjb_viewed` WHERE DATEDIFF( CURDATE( ) , `Date` ) > 60$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
