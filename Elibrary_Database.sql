-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2016 at 02:40 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elibrarybackup`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `BK_ID` int(11) NOT NULL,
  `BK_TITLE` varchar(200) NOT NULL,
  `BK_AUTHOR` varchar(200) NOT NULL,
  `BK_GENRE` int(11) NOT NULL,
  `BK_SERIES` varchar(200) DEFAULT NULL,
  `BK_PUBLISH` varchar(200) NOT NULL,
  `BK_LANG` int(11) NOT NULL,
  `BK_PAGES` int(11) NOT NULL,
  `BK_SYN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE IF NOT EXISTS `ebooks` (
  `EBK_ID` int(11) NOT NULL,
  `EBK_TITLE` varchar(200) NOT NULL,
  `EBK_AUTHOR` varchar(200) NOT NULL,
  `EBK_GEN` int(11) NOT NULL,
  `EBK_SYN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `GEN_ID` int(11) NOT NULL,
  `GEN_NAME` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`GEN_ID`, `GEN_NAME`) VALUES
(1, 'History'),
(2, 'Sci-Fi & Fantasy'),
(3, 'Mystery & Suspense'),
(4, 'Romance'),
(5, 'Web Design'),
(6, 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `LANG_ID` int(11) NOT NULL,
  `LANG_NAME` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`LANG_ID`, `LANG_NAME`) VALUES
(1, 'English'),
(2, 'Malay');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `M_ID` int(11) NOT NULL,
  `M_FNAME` varchar(200) NOT NULL,
  `M_DOB` date NOT NULL,
  `M_IC` varchar(14) NOT NULL,
  `M_EMAIL` varchar(30) NOT NULL,
  `M_PHONE` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `RAT_ID` int(11) NOT NULL,
  `RAT_STARS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upcomings`
--

CREATE TABLE IF NOT EXISTS `upcomings` (
  `UPC_ID` int(11) NOT NULL,
  `UPC_TITLE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `USR_ID` int(11) NOT NULL,
  `USR_USERN` varchar(200) NOT NULL,
  `USR_PASS` varchar(200) NOT NULL,
  `USR_FNAME` varchar(200) NOT NULL,
  `USR_EMAIL` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USR_ID`, `USR_USERN`, `USR_PASS`, `USR_FNAME`, `USR_EMAIL`) VALUES
(1, 'afzafri', 'Afif12345', 'Afif Zafri', 'afzafri@gmail.com'),
(2, 'admin', '123', 'administrator', 'admin@elibraryinfo.reaperz.net');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BK_ID`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`EBK_ID`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`GEN_ID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`LANG_ID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`M_ID`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`RAT_ID`);

--
-- Indexes for table `upcomings`
--
ALTER TABLE `upcomings`
  ADD PRIMARY KEY (`UPC_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USR_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BK_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `EBK_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `GEN_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LANG_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `M_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RAT_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upcomings`
--
ALTER TABLE `upcomings`
  MODIFY `UPC_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `USR_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
