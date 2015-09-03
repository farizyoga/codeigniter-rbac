-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 03, 2015 at 01:53 PM
-- Server version: 5.5.44
-- PHP Version: 5.3.10-1ubuntu3.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

CREATE TABLE IF NOT EXISTS `controllers` (
  `id_controller` int(11) NOT NULL AUTO_INCREMENT,
  `controller_allias` varchar(50) NOT NULL,
  `controller_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_controller`),
  KEY `controller_name` (`controller_name`),
  KEY `controller_name_2` (`controller_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `controllers`
--

INSERT INTO `controllers` (`id_controller`, `controller_allias`, `controller_name`, `description`) VALUES
(1, 'Home', 'home', 'Ini untuk Halaman Home'),
(2, 'Profile', 'profile', 'Ini untuk halaman Profile'),
(3, 'Userize_admin', 'userize_admin', 'HALAMAN ADMIN UNTUK APLIKASI USERIZE'),
(4, 'File', 'data/file', 'File');

-- --------------------------------------------------------

--
-- Table structure for table `controller_access`
--

CREATE TABLE IF NOT EXISTS `controller_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(2) NOT NULL,
  `controller_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `controller_access`
--

INSERT INTO `controller_access` (`id`, `id_role`, `controller_name`) VALUES
(1, 1, 'userize_admin'),
(3, 1, 'home'),
(5, 2, 'home'),
(6, 2, 'profile'),
(7, 3, 'home'),
(8, 3, 'profile'),
(9, 3, 'data/file'),
(10, 1, 'profile'),
(11, 1, 'data/file');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `role_name`) VALUES
(1, 'Administrator'),
(2, 'Customers'),
(3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` int(2) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `role`) VALUES
(1, 'fariz.yoga@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', 1),
(2, 'john@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
