-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2014 at 08:43 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `twohand`
--
CREATE DATABASE IF NOT EXISTS `twohand` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `twohand`;

-- --------------------------------------------------------

--
-- Table structure for table `catalog`
--

CREATE TABLE IF NOT EXISTS `catalog` (
  `c_id` int(2) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catalog`
--

INSERT INTO `catalog` (`c_id`, `c_name`) VALUES
(1, 'mobile phone'),
(2, 'tablet PC'),
(3, 'musical instrument'),
(4, 'sport'),
(5, 'bike'),
(6, 'mother and child'),
(7, 'bag'),
(8, 'clock'),
(9, 'shoes'),
(10, 'clothing'),
(11, 'health and beauty'),
(12, 'home and garden'),
(13, 'collection'),
(14, 'camera'),
(15, 'lectric appliance'),
(16, 'games'),
(17, 'pet'),
(18, 'proterty'),
(19, 'used car'),
(20, 'motorcycle');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `f_id` int(6) NOT NULL AUTO_INCREMENT,
  `m_user` varchar(32) NOT NULL,
  `f_ment` varchar(255) NOT NULL,
  `f_rate` int(1) NOT NULL,
  PRIMARY KEY (`f_id`),
  KEY `m_user` (`m_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `m_user` varchar(32) NOT NULL,
  `m_pass` varchar(32) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `m_tel` varchar(15) NOT NULL,
  `m_email` varchar(100) NOT NULL,
  `m_address` varchar(255) NOT NULL,
  PRIMARY KEY (`m_user`),
  KEY `m_user` (`m_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `p_id` int(6) NOT NULL AUTO_INCREMENT,
  `m_user` varchar(32) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `c_id` int(2) NOT NULL,
  `p_price` int(6) NOT NULL,
  `p_quality` int(3) NOT NULL,
  `p_otherinfo` varchar(255) NOT NULL,
  `p_lat` varchar(10) NOT NULL,
  `p_long` varchar(10) NOT NULL,
  `p_pic1` varchar(255) NOT NULL,
  `p_pic2` varchar(255) NOT NULL,
  `p_pic3` varchar(255) NOT NULL,
  `p_pic4` varchar(255) NOT NULL,
  `p_status` int(1) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `m_user` (`m_user`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`m_user`) REFERENCES `member` (`m_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`m_user`) REFERENCES `member` (`m_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `catalog` (`c_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
