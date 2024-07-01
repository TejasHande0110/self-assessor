-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 01:05 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sr` int(5) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sr`, `name`, `email`, `password`, `datetime`) VALUES
(1, 'Admin', 'admin@admin.com', 'admin', '2021-11-14 10:18:23');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `qid` varchar(15) NOT NULL,
  `eid` varchar(15) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `sr` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`qid`, `eid`, `answer`, `sr`) VALUES
('61a0567dbfd6c', '1', 'Option C', 37),
('61a0567dbfd6c', '2', 'Option C', 38),
('61b9f9d0837e4', '1', 'Option A', 41),
('61b9f9d0837e4', '2', 'Option B', 42);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sr` int(5) NOT NULL,
  `name` text NOT NULL,
  `subject` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `textarea` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`sr`, `name`, `subject`, `email`, `textarea`, `datetime`) VALUES
(23, 'Namrata Bidaye', 'Performance', 'namratabidaye33@gmail.com', 'Effective', '2021-11-26 09:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `qid` varchar(15) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `que solved` int(5) NOT NULL,
  `right que` int(5) NOT NULL,
  `wrong que` int(5) NOT NULL,
  `score` decimal(5,0) NOT NULL,
  `email` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `sr` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(15) NOT NULL,
  `eid` varchar(15) NOT NULL,
  `option a` varchar(500) NOT NULL,
  `option b` varchar(500) NOT NULL,
  `option c` varchar(500) NOT NULL,
  `option d` varchar(500) NOT NULL,
  `sr` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `eid`, `option a`, `option b`, `option c`, `option d`, `sr`) VALUES
('61a0567dbfd6c', '1', 'HighText Machine Language', 'HyperText and links Markup Language', 'HyperText Markup Language', 'None of these', 73),
('61a0567dbfd6c', '2', 'pre tag', 'a tag', 'b tag', 'br tag\r\n\r\n', 74),
('61b9f9d0837e4', '1', 'New Delhi', 'Mumbai', 'Pune', 'Nashik', 77),
('61b9f9d0837e4', '2', 'New Delhi', 'Mumbai', 'Pune', 'Nashik', 78);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qid` varchar(15) NOT NULL,
  `eid` varchar(15) NOT NULL,
  `question` varchar(500) NOT NULL,
  `marks` float NOT NULL,
  `sr` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `eid`, `question`, `marks`, `sr`) VALUES
('61a0567dbfd6c', '2', 'Which of the following element is responsible for making the text bold in HTML?', 2, 39),
('61a0567dbfd6c', '1', 'HTML stand for-', 2, 40),
('61b9f9d0837e4', '1', 'Capital of India-', 2, 43),
('61b9f9d0837e4', '2', 'Financial Capital of India-', 2, 44);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `qid` varchar(15) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `total que` int(5) NOT NULL,
  `marks` float NOT NULL,
  `time limit` int(30) NOT NULL,
  `Des` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`qid`, `topic`, `total que`, `marks`, `time limit`, `Des`) VALUES
('61a0567dbfd6c', 'Basic HTML Test', 2, 4, 2, 'This is Demo Test'),
('61b9f9d0837e4', 'Demo Test', 2, 4, 1, 'Demo test');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `name` varchar(30) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `clg` varchar(30) NOT NULL,
  `score` int(5) NOT NULL,
  `sr` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sr` int(5) NOT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL,
  `clg` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sr`, `name`, `gender`, `clg`, `email`, `password`, `datetime`) VALUES
(2, 'Tejas Hande', 'Male', 'GPM', 'tejashande08@gmail.com', 'tejas', '2021-11-14 16:20:27'),
(6, 'Nivedi kondlekar', 'Female', 'GPM', '', 'nivedi', '2021-11-15 12:28:28'),
(8, 'Sakshi Sali', 'Female', 'GPM', 's', 'sakshi', '2021-11-15 12:29:57'),
(12, 'Namrata Bidaye', 'Female', 'GPM', '', 'namrata', '2021-11-22 15:25:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`sr`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ranking`
--
ALTER TABLE `ranking`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sr` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
