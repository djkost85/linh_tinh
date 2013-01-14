-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2009 at 03:32 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `img`
--

-- --------------------------------------------------------

--
-- Table structure for table `anh`
--

CREATE TABLE IF NOT EXISTS `anh` (
  `maanh` int(11) NOT NULL auto_increment,
  `matheloai` int(11) NOT NULL,
  `linkanh` varchar(300) NOT NULL,
  PRIMARY KEY  (`maanh`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `anh`
--

INSERT INTO `anh` (`maanh`, `matheloai`, `linkanh`) VALUES
(1, 1, 'chiplove9_sm1ngonghinh60.gif'),
(2, 1, 'chiplove504_sm6rabbit2_15.gif'),
(3, 2, 'chiplove113_sm6teacup2.gif'),
(4, 2, 'chiplove140_sm4bears13.gif'),
(5, 2, 'chiplove333_sm1mimimo13.gif');

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE IF NOT EXISTS `theloai` (
  `matheloai` int(11) NOT NULL auto_increment,
  `icon` varchar(300) NOT NULL,
  `tentheloai` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`matheloai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`matheloai`, `icon`, `tentheloai`) VALUES
(1, 'www.chiplove.biz_98_sm4cute_smiley36.gif', 'Máº·t cÆ°á»i 1'),
(2, 'chiplove9_sm1ngonghinh60.gif', 'Máº·t cÆ°á»i 2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `tendn` varchar(30) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `group` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `tendn`, `pass`, `group`) VALUES
(1, 'chip', '218f9aae1a5cd6d4ddf306cc7ba7fd88', 0),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0);
