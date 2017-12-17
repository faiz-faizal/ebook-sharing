-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2017 at 06:44 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

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
(1, 'afifah', '12345', 'Afifah Bt Mansor', 'afifah@gmail.com'),
(2, 'faiz', '12345', 'Muhammad Faiz', 'mfaiz.mfm@gmail.com');

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
('125-2590-92285-6125', 'A Day in the Life of Muhammad', 'Abd al-Wahhab b. Nasir al-Turayri', 1, '1', 'Islam Today', 1, 101, 'Here is the city of palm dates and lively hearts; here lives his heart. It is his place, his city, his people. It is the city in which everything came alight when he arrived. Its people and its very nature loved him. Here is Mount Uhud with which he had a relation of mutual love. These narrow alleyways will recognize his footsteps. Here will be his mosque will also gather a great band of men, eager to follow him and do his bidding. With them he will have a pure relation of mutual love. He is always with them; but his special relation is with God..We will look at Prophet Muhammad\'\'s management of his day.', 'pdf'),
('977998787988', 'Donald Duck Family Comics', 'Carl Barks', 4, '', 'Fantagraphics Books', 1, 6, 'If you think this comic is ducky then shake\r\na tail-feather and pick up the collections\r\nof Disney duck comics by the great Carl\r\nBarks! Join Donald, his nephews and\r\nUncle Scrooge on their globe-trotting\r\nadventures and hilarious\r\nescapades in some of the\r\nbest comics ever made!', 'pdf'),
('978-1-909437-75-3', 'Effective Teaching', 'Pamela Sammons, Linda Bakkum', 1, '1', 'Oxford University Department of Education', 1, 64, '				   				   				   				   				   				   				   Education Development Trustâ€¦ weâ€™ve changed from CfBT\r\n\r\nWe changed our name from CfBT Education Trust in January 2016. Our aim is to transform lives by improving education around the world and to help achieve this, we work in different ways in many locations.\r\n\r\nCfBT was established nearly 50 years ago; since then our work has naturally diversified and intensified and so today, the name CfBT (which used to stand for Centre for British Teachers) is not representative of who we are or what we do. We believe that our new company name, Education Development Trust â€“ while it is a signature, not an autobiography â€“ better represents both what we do and, as a not for profit organisation strongly guided by our core values, the outcomes we want for young people around the world.\r\n', 'pdf'),
('asjf;asldf', 'Lord of the Flies', 'William Golding', 3, '', 'Faber and Faber', 1, 162, 'Lord of the Flies is a 1954 novel by Nobel Prize-winning British author William Golding. The book focuses on a group of British boys stranded on an uninhabited island and their disastrous attempt to govern themselves.\r\n\r\nThe novel has been generally well received. It was named in the Modern Library 100 Best Novels, reaching number 41 on the editor\'s list, and 25 on the reader\'s list. In 2003 it was listed at number 70 on the BBC\'s The Big Read poll, and in 2005 Time magazine named it as one of the 100 best English-language novels from 1923 to 2005.\r\n				', 'pdf'),
('zvv.x', 'Easy Sudoku Puzzles ', 'Krazy Dad', 4, '1', 'Krazy Dad', 1, 10, '				   The phrase \"we(I)(you) simply MUST ...\" designates something that need not\r\nbe done. \"That goes without saying\" is a red warning. \"Of course\" means you\r\nhad best check it yourself. These small-change cliches and others like them,\r\nwhen read correctly, are reliable channel markers.\r\n-- Lazarus Long\r\n				', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_NAME` varchar(200) NOT NULL,
  `FED_EMAIL` varchar(200) NOT NULL,
  `FED_MSG` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_NAME`, `FED_EMAIL`, `FED_MSG`) VALUES
('Muhammad Faiz', 'poulsmith96@gmail.com', 'TQ Mizi');

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
(1, 'Education'),
(2, 'Sci-Fi & Fantasy'),
(3, 'Novel'),
(4, 'Others');

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
-- Table structure for table `upcomings`
--

CREATE TABLE `upcomings` (
  `UPC_ID` int(11) NOT NULL,
  `UPC_TITLE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upcomings`
--

INSERT INTO `upcomings` (`UPC_ID`, `UPC_TITLE`) VALUES
(1, 'The Da Vinci Code');

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
('2015203914', 'Muhammad Syafiq Akmal', 'syafiqakmal97@gmail.com', '12345', 'syafiq'),
('2015411572', 'Muhammad Faiz', 'poulsmith96@gmail.com', '12345', 'faiz'),
('20154115727', 'Muhammad Faiz Bin Mohd Faizal', 'poulsmith96@gmail.com', 'fareast12321', 'Muhd97'),
('2015411573', 'Muhammad ', 'mfaiz.mfm@gmail.com', '12321', 'Faiz'),
('2015411574', 'Muhamamd', 'faiz123@gmail.com', '12321', 'faiz123'),
('2015411575', 'Muhammad Faiz', 'poulsmith96@gmail.com', '12345', 'ffaiz'),
('2015411577', 'Muhammad Faiz', 'poulsmith96@gmail.com', '1234', 'faiz-faizal'),
('2016693694', 'Amirul Faiz', 'amirulfaiz@gmail.com', '123456789', 'amirulfaiz'),
('asdfasdfd', 'asdfsafa', 'faiz123@asas', 'admin123', 'asdfas'),
('dsfds', 'fsds', 'admin@gmail.com', '12345', 'sdfsd'),
('Faiz', 'asfas', 'faiz123@asdfasdf', 'admin123', 'asfas'),
('sdfsad', 'sadf', 'admin@sdfdsf', 'sfsfd', 'sdfsdaf');

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
  MODIFY `GEN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LANG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `upcomings`
--
ALTER TABLE `upcomings`
  MODIFY `UPC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
