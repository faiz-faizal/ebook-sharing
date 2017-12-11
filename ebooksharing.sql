-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2017 at 12:06 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebooksharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_USERN` varchar(200) NOT NULL,
  `ADMIN_PASS` varchar(200) NOT NULL,
  `ADMIN_FNAME` varchar(200) NOT NULL,
  `ADMIN_EMAIL` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_USERN`, `ADMIN_PASS`, `ADMIN_FNAME`, `ADMIN_EMAIL`) VALUES
(1, 'afzafri', 'Afif12345', 'Afif Zafri', 'afzafri@gmail.com'),
(2, 'admin', '123', 'administrator', 'admin@elibraryinfo.reaperz.net');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BK_ID` varchar(100) NOT NULL,
  `BK_TITLE` varchar(200) NOT NULL,
  `BK_AUTHOR` varchar(200) NOT NULL,
  `BK_GENRE` int(11) NOT NULL,
  `BK_SERIES` varchar(200) DEFAULT NULL,
  `BK_PUBLISH` varchar(200) NOT NULL,
  `BK_LANG` int(11) NOT NULL,
  `BK_PAGES` int(11) NOT NULL,
  `BK_SYN` text NOT NULL,
  `BK_EXT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BK_ID`, `BK_TITLE`, `BK_AUTHOR`, `BK_GENRE`, `BK_SERIES`, `BK_PUBLISH`, `BK_LANG`, `BK_PAGES`, `BK_SYN`, `BK_EXT`) VALUES
('asdfjaslkdfjasl', 'naslfjklsda', 'SJALKDJ', 2, 'LKJslKCz', 'zXcjzlj', 1, 21321, '				   ljslkjaslkjl\r\n				', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `GEN_ID` int(11) NOT NULL,
  `GEN_NAME` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `languages` (
  `LANG_ID` int(11) NOT NULL,
  `LANG_NAME` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `membership` (
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

CREATE TABLE `ratings` (
  `RAT_ID` int(11) NOT NULL,
  `RAT_STARS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upcomings`
--

CREATE TABLE `upcomings` (
  `UPC_ID` int(11) NOT NULL,
  `UPC_TITLE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` varchar(30) NOT NULL,
  `USER_FNAME` varchar(30) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_PASS` varchar(50) NOT NULL,
  `USER_USERN` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_FNAME`, `USER_EMAIL`, `USER_PASS`, `USER_USERN`) VALUES
('2015411572', 'Muhammad Faiz', 'poulsmith96@gmail.com', '123', 'admin'),
('20154115727', 'Muhammad Faiz Bin Mohd Faizal', 'poulsmith96@gmail.com', 'fareast12321', 'Muhd97'),
('2015411573', 'Muhammad ', 'mfaiz.mfm@gmail.com', '12321', 'Faiz'),
('2015411574', 'Muhamamd', 'faiz123@gmail.com', '12321', 'faiz123'),
('asdfasdfd', 'asdfsafa', 'faiz123@asas', 'admin123', 'asdfas'),
('Faiz', 'asfas', 'faiz123@asdfasdf', 'admin123', 'asfas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BK_ID`);

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
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `GEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LANG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `UPC_ID` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
