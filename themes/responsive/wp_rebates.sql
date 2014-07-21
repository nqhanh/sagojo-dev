-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2013 at 03:55 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sagojo`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_rebates`
--

CREATE TABLE IF NOT EXISTS `wp_rebates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rank` int(10) NOT NULL,
  `nickname` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wp_rebates`
--

INSERT INTO `wp_rebates` (`id`, `rank`, `nickname`, `amount`) VALUES
(1, 1, 'hanh', 'hehehe'),
(2, 2, 'hau', 'hahaha'),
(3, 3, 'chinh', 'hihihi');

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_jobseekers_views` ON SCHEDULE EVERY 1 DAY STARTS '2013-01-01 03:00:00' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM `wpjb_viewed` WHERE DATEDIFF( CURDATE( ) , `Date` ) > 60$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
