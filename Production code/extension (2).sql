-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 04:17 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `extension`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` bigint(8) NOT NULL,
  `exam_code` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `answersub` varchar(500) DEFAULT NULL,
  `answermcq` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `exam_code`, `email`, `question_id`, `answersub`, `answermcq`) VALUES
(5, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '7', 'Saurabh', NULL),
(6, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '8', 'Yadav', NULL),
(7, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '7', 'Saurabh', NULL),
(8, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '8', 'Yadav', NULL),
(9, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '7', 'Saurabh', NULL),
(10, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', '8', 'Yadav', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `exam_id` bigint(8) NOT NULL,
  `exam_code` varchar(20) NOT NULL,
  `exam_name` varchar(250) DEFAULT NULL,
  `exam_type` varchar(12) DEFAULT NULL,
  `dateOf` date DEFAULT NULL,
  `timestart` time(1) DEFAULT NULL,
  `timeend` time(1) DEFAULT NULL,
  `noQuestion` int(4) DEFAULT NULL,
  `proctor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`exam_id`, `exam_code`, `exam_name`, `exam_type`, `dateOf`, `timestart`, `timeend`, `noQuestion`, `proctor`) VALUES
(20, 'c7c8d95b6986a2fe91cb', 'Programming for fun', 'subjective', '2021-05-22', '10:27:00.9', '17:59:00.0', 2, 'sy425191@gmail.com'),
(21, '634d02a0246e39ec374d', 'what the heck programming', 'mcq', '2021-05-22', '10:20:58.4', '13:46:00.0', 2, 'sy425191@gmail.com'),
(22, '62ca6fa118fbfde6e181', 'demo exam', 'subjective', '2021-05-22', '17:30:00.0', '18:30:00.0', 2, 'jbcsh@gmal.com'),
(23, '634d02a0246e39ec374d', NULL, NULL, NULL, NULL, NULL, NULL, 'cheems@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempt`
--

CREATE TABLE `exam_attempt` (
  `id` int(4) NOT NULL,
  `email` varchar(250) NOT NULL,
  `exam_code` varchar(20) NOT NULL,
  `peer_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_attempt`
--

INSERT INTO `exam_attempt` (`id`, `email`, `exam_code`, `peer_id`) VALUES
(7, 'cheems@gmail.com', 'c7c8d95b6986a2fe91cb', NULL),
(8, 'kunal@gmail.com', '62ca6fa118fbfde6e181', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_join`
--

CREATE TABLE `exam_join` (
  `id` int(4) NOT NULL,
  `exam_code` varchar(250) NOT NULL,
  `email` text NOT NULL,
  `rolelevel` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_join`
--

INSERT INTO `exam_join` (`id`, `exam_code`, `email`, `rolelevel`) VALUES
(5, 'c7c8d95b6986a2fe91cb', 'cheems@gmail.com', 'examinee'),
(8, '634d02a0246e39ec374d', 'cheems@gmail.com', 'examinee'),
(9, '62ca6fa118fbfde6e181', 'kunal@gmail.com', 'examinee');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` bigint(8) NOT NULL,
  `questioninput` varchar(250) NOT NULL,
  `optioninput1` varchar(250) DEFAULT NULL,
  `optioninput2` varchar(1250) DEFAULT NULL,
  `optioninput3` varchar(250) DEFAULT NULL,
  `optioninput4` varchar(250) DEFAULT NULL,
  `exam_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `questioninput`, `optioninput1`, `optioninput2`, `optioninput3`, `optioninput4`, `exam_code`) VALUES
(7, 'What is your name?', NULL, NULL, NULL, NULL, 'c7c8d95b6986a2fe91cb'),
(8, 'How much marks you want?', NULL, NULL, NULL, NULL, 'c7c8d95b6986a2fe91cb'),
(13, 'What is your name?', 'Name', 'what', 'what name', 'idk', '634d02a0246e39ec374d'),
(14, 'How much marks you want?', 'cut mark', 'full marks', 'passing marks', 'none', '634d02a0246e39ec374d'),
(15, 'Demo question1', NULL, NULL, NULL, NULL, '62ca6fa118fbfde6e181'),
(16, 'Demo question2', NULL, NULL, NULL, NULL, '62ca6fa118fbfde6e181');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(4) NOT NULL,
  `room_name` varchar(150) NOT NULL,
  `room_code` varchar(13) NOT NULL,
  `proctor` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(4) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `psw` varchar(500) NOT NULL,
  `usercode` varchar(8) NOT NULL,
  `institute` varchar(200) NOT NULL,
  `rolelevel` varchar(12) NOT NULL,
  `verified` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `fullname`, `email`, `psw`, `usercode`, `institute`, `rolelevel`, `verified`) VALUES
(11, 'SAURABH YADAV', 'sy425191@gmail.com', '24c1b29099c8749194796dfef8b50a40', '', 'MNNIT ALLAHABAD', 'proctor', 'yes'),
(12, 'SAURABH YADAV', 'cheems@gmail.com', '24c1b29099c8749194796dfef8b50a40', '1e2b0022', 'MNNIT ALLAHABAD', 'examinee', 'yes'),
(13, 'KUNAL SHUKLA', 'jbcsh@gmal.com', '0cabe9fed1c3e8dafcc3da32ebbf0ee3', '0ede9d3b', 'MNNIT ALLAHABAD', 'proctor', 'yes'),
(14, 'KUNAL SHUKLA', 'kunal@gmail.com', '0cabe9fed1c3e8dafcc3da32ebbf0ee3', 'ea3e4de5', 'MNNIT ALLAHABAD', 'examinee', 'yes'),
(15, 'SAURABH YADAV', 'vy157212@gmail.com', '24c1b29099c8749194796dfef8b50a40', 'abd3e9ba', 'MNNIT ALLAHABAD', 'proctor', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_join`
--
ALTER TABLE `exam_join`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` bigint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `exam_id` bigint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_join`
--
ALTER TABLE `exam_join`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` bigint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
