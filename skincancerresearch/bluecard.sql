-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 25, 2017 at 05:07 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluecard`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `file` varchar(245) NOT NULL,
  `children_sunsafe` int(11) NOT NULL,
  `children_other` int(11) NOT NULL,
  `children_no` int(11) NOT NULL,
  `adults_sunsafe` int(11) NOT NULL,
  `adults_other` int(11) NOT NULL,
  `adults_no` int(11) NOT NULL,
  `is_easy` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `file`, `children_sunsafe`, `children_other`, `children_no`, `adults_sunsafe`, `adults_other`, `adults_no`, `is_easy`) VALUES
(1, 'quiz_files/1-1.png', 3, 0, 3, 0, 0, 0, 1),
(2, 'quiz_files/2-2.png', 0, 0, 0, 8, 2, 8, 0),
(3, 'quiz_files/3-3.png', 0, 0, 1, 2, 0, 2, 1),
(4, 'quiz_files/4-4.png', 2, 1, 0, 1, 1, 5, 0),
(5, 'quiz_files/5-5.png', 11, 1, 7, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload_details`
--

CREATE TABLE `upload_details` (
  `upload_id` int(11) NOT NULL,
  `filename` varchar(45) DEFAULT NULL,
  `application_details` varchar(200) DEFAULT NULL,
  `application_title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `userid` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `isadmin` varchar(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `blue_card_name` varchar(100) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `issue_number` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `blue_card_status` enum('app_downloaded','test_passed','test_failed','pending','dont_have','submitted','rejected','approved') NOT NULL DEFAULT 'pending',
  `blue_card_comments` longtext,
  `bluecard_application_file` varchar(245) DEFAULT NULL,
  `confirmation_of_identity_file` varchar(245) DEFAULT NULL,
  `alternative_identification_file` varchar(245) DEFAULT NULL,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `appDownloadCode` varchar(45) DEFAULT NULL,
  `account_created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`userid`, `first_name`, `last_name`, `email`, `username`, `password`, `gender`, `isadmin`, `birthdate`, `blue_card_name`, `card_number`, `issue_number`, `expiry_date`, `blue_card_status`, `blue_card_comments`, `bluecard_application_file`, `confirmation_of_identity_file`, `alternative_identification_file`, `updated_time`, `appDownloadCode`, `account_created_time`) VALUES
(1, 'Admin', 'admin', 'admin@suncare.com', 'admin', '5a1760628ea739e61d9bb798b50542d5', 'M', 'Y', NULL, '', 0, 0, '0000-00-00', '', '', NULL, NULL, NULL, '2017-09-20 15:07:59', '', '2017-08-26 18:33:48'),
(2, 'bhargavi', 'rocks', 'bhargavi@gmail.com', 'caper', '1234567890', 'F', NULL, NULL, '', 0, 0, '0000-00-00', 'pending', '', NULL, NULL, NULL, '2017-08-21 01:14:50', '', '2017-08-26 18:33:48'),
(3, 'simple', 'dimple', 'simple@gmail.com', 'simple', 'dimple', 'F', NULL, '2017-05-09', 'anukrit', 12345, 23, '1991-08-01', 'submitted', '', NULL, NULL, NULL, '2017-08-26 18:27:55', '', '2017-08-26 18:33:48'),
(12, 'anukrit', 'rocks', 'anukrit@gmail.com', 'anukrit', '111bc9dd5964151cb588bdee37b1382f', 'F', NULL, '2017-08-16', 'a'' -- b', 1, 1, '2017-09-13', 'pending', '', 'uploads/12-bluecard_application-Quiz image P1010659 chiba cropped and airbrushed finalcensored.jpg', '12-confirmation_of_identity-DJAG039Confirmationofidentity.pdf', '12-alternative_identification-DJAG015Requesttoconsideralternativeidentification.pdf', '2017-09-20 15:55:36', 'abc', '2017-08-26 18:33:48'),
(13, 'asdf', 'adf', 'email@gmail.com', 'email', 'gmail', 'F', NULL, '2017-08-07', '', 0, 0, '0000-00-00', 'pending', '', NULL, NULL, NULL, '2017-08-26 10:58:55', '', '2017-08-26 18:33:48'),
(14, 'a', 'b', 'c@d.em', 'cdem', '5a1760628ea739e61d9bb798b50542d5', 'F', NULL, '2017-09-05', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2017-09-20 15:08:02', NULL, '2017-09-20 15:04:07'),
(15, 'ac', 'n', 's@as.c', 'asdfasd', '111bc9dd5964151cb588bdee37b1382f', 'F', NULL, '2017-09-06', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2017-09-23 12:49:47', NULL, '2017-09-23 12:49:47'),
(16, 'as', 'd', 'd@b.co', 'asd', '111bc9dd5964151cb588bdee37b1382f', 'F', NULL, '2017-09-14', NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2017-09-23 12:54:47', NULL, '2017-09-23 12:54:47'),
(17, 'rajan', 'mehta', 'rajan@gmail.com', 'rajan', 'f6565efd42846497a538b4d08a84bca8', 'F', NULL, '2017-09-13', NULL, NULL, NULL, NULL, 'test_failed', NULL, NULL, NULL, NULL, '2017-09-23 14:02:44', NULL, '2017-09-23 13:59:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_easy` (`is_easy`);

--
-- Indexes for table `upload_details`
--
ALTER TABLE `upload_details`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`),
  ADD KEY `blue_card_status` (`blue_card_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `upload_details`
--
ALTER TABLE `upload_details`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
