-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 06:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmfki`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin1`
--

CREATE TABLE `admin1` (
  `id` int(3) NOT NULL,
  `name` varchar(20) NOT NULL,
  `matric_no` varchar(20) NOT NULL,
  `course_code` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin1`
--

INSERT INTO `admin1` (`id`, `name`, `matric_no`, `course_code`) VALUES
(1, 'Anndrea', 'BI17110003', 'HC00');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `file` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL,
  `size` int(11) NOT NULL,
  `uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `name`, `file`, `type`, `size`, `uploaded`) VALUES
(9, 'Annual dinner Minute ', '38514-Anual Dinner.docx', 'applicatio', 12571, '2021-01-15 15:29:34'),
(19, 'weekly meeting - 12/1', '75610-Test document.docx', 'applicatio', 12558, '2021-01-21 00:01:59'),
(20, 'FKI game night proposal ', '29445-Test document.docx', 'applicatio', 12558, '2021-01-21 00:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `event1`
--

CREATE TABLE `event1` (
  `event_name` varchar(50) NOT NULL,
  `event_des` text NOT NULL,
  `event_date` date DEFAULT NULL,
  `event_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event1`
--

INSERT INTO `event1` (`event_name`, `event_des`, `event_date`, `event_text`) VALUES
('Annual Dinner', 'A night to remember ', '2020-12-18', 'A night where students and teachers come together to have a night to remember. An event filled with games, lucky draw and performances. get you fancy dresses and suits ready as we will be dinning at The Hilton Hotel at 7:00 PM. Tickets are sold at RM75 per person. You may make your purchase with your class representatives. '),
('FKI Dinner', 'Dine for charity ', '2020-11-12', 'FKI is inviting you to dine for a greater cause which is to provide education for the stateless kids of Sabah. The event will be filled with exciting shows and also informational charity education for us to have fun and learn as we indulge in the delicious food prepared by the student of the school of food science and nutrition. Dinner starts at 6:30 PM at FKJ foyer. Tickets are sold at RM 35 per person and you may make you purchases with your class representatives. see you all there! '),
('FKI Explorace', 'Unleash your business talent ', '2021-01-15', 'This is a great opportunity for student to unleash their talents in business as we held a three day business explorace where student race to see who can sell the most items in a short period of time'),
('FKI Game Night ', 'Get your mobiles ready Its game night!', '2021-01-27', 'FKI Game Night is an annual event held every year where we gather students around to have a chill gaming sessions with their buddies. Games Included for tonight - Mobile Legend and Among us!\r\n'),
('FKI Hackathon 2020', 'Calling all Hackers!', '2021-01-22', 'Get your laptop and skills ready. We are looking out for hackers to join this event on the 22nd of January. Cash prizes to be won!');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback` varchar(500) NOT NULL,
  `event_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback`, `event_name`) VALUES
('awesome stuff', 'Annual Dinner'),
('awesome, i had fun', 'FKI Game Night '),
('great event, hoping to see it again next year ', 'FKI Hackathon 2020'),
('I really enjoyed it ', 'Annual Dinner'),
('I think they can do better', 'FKI Dinner'),
('just fine', 'FKI Dinner'),
('organizers did a great job', 'FKI Hackathon 2020'),
('Overall event was ok ', 'FKI Hackathon 2020'),
('quite bad planning, too much people ', 'FKI Dinner'),
('The dinner was great. I really enjoyed myself', 'FKI Dinner'),
('the event was enjoyable ', 'FKI Hackathon 2020'),
('the event was messy ', 'FKI Game Night '),
('the event was not organized well ', 'Annual Dinner'),
('the event was really great. good job to all of the team', 'Annual Dinner'),
('The game night was amazing ', 'FKI Game Night '),
('The game night was super great', 'FKI Game Night '),
('there was no sdp points', 'FKI Dinner'),
('there was not enough time, wish they would give better timing', 'FKI Hackathon 2020'),
('there was too many people', 'Annual Dinner'),
('this event was okay', 'FKI Game Night '),
('this was a great event', 'Annual Dinner'),
('this was an awesome event ', 'FKI Game Night ');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_result`
--

CREATE TABLE `feedback_result` (
  `score` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `event` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback_result`
--

INSERT INTO `feedback_result` (`score`, `feedback`, `event`) VALUES
('Positive', 'awesome stuff', 'Annual Dinner'),
('Positive', 'awesome, i had fun', 'FKI Game Night '),
('Negative', 'great event, hoping to see it again next year ', 'FKI Hackathon 2020'),
('Positive', 'I really enjoyed it ', 'Annual Dinner'),
('Neutral', 'I think they can do better', 'FKI Dinner'),
('Neutral', 'just fine', 'FKI Dinner'),
('Positive', 'organizers did a great job', 'FKI Hackathon 2020'),
('Neutral', 'Overall event was ok ', 'FKI Hackathon 2020'),
('Negative', 'quite bad planning, too much people ', 'FKI Dinner'),
('Positive', 'The dinner was great. I really enjoyed myself', 'FKI Dinner'),
('Negative', 'the event was enjoyable ', 'FKI Hackathon 2020'),
('Negative', 'the event was messy ', 'FKI Game Night '),
('Negative', 'the event was not organized well ', 'Annual Dinner'),
('Positive', 'the event was really great. good job to all of the team', 'Annual Dinner'),
('Positive', 'The game night was amazing ', 'FKI Game Night '),
('Positive', 'The game night was super great', 'FKI Game Night '),
('Negative', 'there was no sdp points', 'FKI Dinner'),
('Negative', 'there was not enough time, wish they would give better timing', 'FKI Hackathon 2020'),
('Negative', 'there was too many people', 'Annual Dinner'),
('Neutral', 'this event was okay', 'FKI Game Night '),
('Positive', 'this was a great event', 'Annual Dinner'),
('Positive', 'this was an awesome event ', 'FKI Game Night ');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `adminID` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`adminID`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `member1`
--

CREATE TABLE `member1` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `matric_no` varchar(10) NOT NULL,
  `course_code` varchar(4) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member1`
--

INSERT INTO `member1` (`id`, `name`, `matric_no`, `course_code`, `email`, `phone`) VALUES
(2, 'Amir Ahmad', 'BI17110005', 'HC00', 'amir@gmail.com', '0132500987'),
(3, 'Maya Karin', 'bi18119876', 'HC05', 'maya@gmail.com', '0182980232'),
(5, 'Akim', 'BI19110967', 'HC00', 'akim@gmail', '0176395433'),
(6, 'Sally Lee', 'BI19110209', 'HC00', 'sallylee@gmail.com', '0117325643'),
(7, 'Alexander Wang', 'BI19110209', 'HC05', 'alex1234@gmail.com', '0102675290'),
(8, 'Mia', 'BI16110020', 'HC05', 'miasara@gmail.com', '0168265330'),
(10, 'Natalie', 'BI19110209', 'HC00', 'natalie2001@gmail.co', '0111457792'),
(22, 'Karen Yong', 'BI19110967', 'HC00', 'karen@gmail.com', '0187256390'),
(25, 'Ali ahmad', 'BI17110009', 'HC00', 'ali@gmail.com', '0192345768'),
(28, 'Marina azim', 'BI19110209', 'HC00', 'marina@gmai.com', '1987656743');

-- --------------------------------------------------------

--
-- Table structure for table `new_member`
--

CREATE TABLE `new_member` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `matric_no` varchar(10) NOT NULL,
  `course` varchar(4) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_member`
--

INSERT INTO `new_member` (`id`, `name`, `matric_no`, `course`, `email`, `phone`) VALUES
(4, 'Catarina', 'BI19110209', 'HC00', 'catarina@gmail.com', 198812996),
(5, 'Abu Razak', 'BI17110055', 'HC00', 'Aburazak@gmail.com', 187678653),
(6, 'Ali', 'BI17110009', 'HC00', 'ali@gmail.com', 192345768);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event1`
--
ALTER TABLE `event1`
  ADD PRIMARY KEY (`event_name`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `member1`
--
ALTER TABLE `member1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_member`
--
ALTER TABLE `new_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `adminID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member1`
--
ALTER TABLE `member1`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `new_member`
--
ALTER TABLE `new_member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
