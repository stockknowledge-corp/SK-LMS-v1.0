-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 04:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockknowledge`
--

-- --------------------------------------------------------

--
-- Table structure for table `sk_history`
--

CREATE TABLE `sk_history` (
  `id` int(11) NOT NULL,
  `module` text NOT NULL,
  `activity` text NOT NULL,
  `datetime` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_history`
--

INSERT INTO `sk_history` (`id`, `module`, `activity`, `datetime`, `user_id`) VALUES
(1, 'Users', 'User login', '2020-10-26 17:47:12', 1),
(2, 'Users', 'User login', '2020-12-02 12:31:16', 1),
(3, 'Users', 'User login', '2020-12-02 12:31:21', 1),
(4, 'Users', 'New user registration: test123', '2020-12-02 12:36:02', 2),
(5, 'Users', 'User login', '2020-12-02 12:36:15', 2),
(6, 'Users', 'New user registration: test', '2020-12-02 16:43:33', 3),
(7, 'Users', 'User login', '2020-12-02 16:43:43', 3),
(8, 'Users', 'New user registration: bug123', '2020-12-02 16:46:08', 4),
(9, 'Users', 'User login', '2020-12-02 16:46:19', 4),
(10, 'Users', 'User login', '2020-12-08 15:44:15', 1),
(48, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:44:31', 2),
(49, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:49:44', 2),
(50, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:50:44', 2),
(51, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:00', 2),
(52, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:39', 2),
(53, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:47', 2),
(54, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:48', 2),
(55, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:48', 2),
(56, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:48', 2),
(57, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:52:49', 2),
(58, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:27', 2),
(59, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:29', 2),
(60, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:29', 2),
(61, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:29', 2),
(62, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:29', 2),
(63, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:30', 2),
(64, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:53:30', 2),
(65, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:03', 2),
(66, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:04', 2),
(67, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:04', 2),
(68, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:30', 2),
(69, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:31', 2),
(70, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:31', 2),
(71, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:32', 2),
(72, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:32', 2),
(73, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:54:32', 2),
(74, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test', '2020-12-09 16:55:00', 2),
(75, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:02', 2),
(76, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:11', 2),
(77, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:22', 2),
(78, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:23', 2),
(79, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:23', 2),
(80, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:23', 2),
(81, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:23', 2),
(82, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:23', 2),
(83, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:32', 2),
(84, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:32', 2),
(85, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:32', 2),
(86, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:32', 2),
(87, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:56:33', 2),
(88, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:58:21', 2),
(89, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test1', '2020-12-09 16:58:52', 2),
(90, 'sk_progress', 'Student ID: 2 gained points from Subject ID: 1 Hotspot: test2', '2020-12-09 16:59:10', 2),
(91, 'Users', 'User Edited: test', '2020-12-16 08:59:32', 1),
(92, 'Users', 'User login', '2020-12-16 09:00:32', 3),
(93, 'Users', 'User login', '2020-12-16 10:25:54', 1),
(94, 'Users', 'User login', '2020-12-16 11:06:18', 1),
(95, 'Users', 'User login', '2020-12-16 11:06:44', 1),
(96, 'Users', 'User login', '2020-12-16 11:09:48', 4),
(97, 'Users', 'User login', '2020-12-16 11:13:31', 1),
(98, 'Users', 'User login', '2020-12-16 11:18:42', 1),
(99, 'Users', 'User login', '2020-12-16 11:20:22', 3),
(100, 'Users', 'User login', '2020-12-16 11:28:03', 1),
(101, 'Users', 'User login', '2020-12-16 11:31:28', 1),
(102, 'Users', 'User login', '2020-12-16 14:43:07', 4),
(103, 'Users', 'User login', '2020-12-16 14:50:01', 4),
(104, 'Users', 'User login', '2020-12-16 14:50:39', 1),
(105, 'Users', 'User login', '2020-12-16 14:51:15', 4),
(106, 'Users', 'User login', '2020-12-16 16:11:51', 3),
(107, 'Users', 'User login', '2020-12-16 16:47:43', 4),
(108, 'Users', 'User login', '2020-12-16 16:55:26', 3),
(109, 'Users', 'User login', '2020-12-16 17:14:01', 4),
(110, 'Topics', 'New topic added: test', '2020-12-16 17:30:38', 4),
(111, 'Users', 'User login', '2020-12-17 14:01:17', 3),
(112, 'Users', 'User login', '2020-12-17 14:03:48', 4),
(113, 'Users', 'User login', '2020-12-17 14:13:29', 3),
(114, 'Users', 'User login', '2020-12-17 15:25:00', 1),
(115, 'Users', 'User login', '2020-12-17 15:51:13', 4),
(116, 'Topics', 'Topic edited: test', '2020-12-17 16:53:52', 1),
(117, 'Topics', 'Topic edited: test', '2020-12-17 16:54:44', 1),
(118, 'Topics', 'Topic edited: test', '2020-12-17 16:56:07', 1),
(119, 'Topics', 'Topic edited: test', '2020-12-17 17:00:42', 4),
(120, 'Topics', 'Topic edited: test', '2020-12-17 17:40:36', 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sk_leaderboard`
-- (See below for the actual view)
--
CREATE TABLE `sk_leaderboard` (
`id` int(11)
,`student_id` int(11)
,`user_id` int(11)
,`firstname` text
,`lastname` text
,`subject_id` int(11)
,`hotspot_title` varchar(255)
,`points` decimal(11,2)
,`gradelevel` text
,`schoolname` text
);

-- --------------------------------------------------------

--
-- Table structure for table `sk_modes`
--

CREATE TABLE `sk_modes` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `content_fields` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_modes`
--

INSERT INTO `sk_modes` (`id`, `name`, `description`, `content_fields`) VALUES
(1, 'Mode 1 - Interactive Lecture', 'Lectures with interactive 3d model', ''),
(2, 'Mode 2 - Activities and Experiments', 'Lectures with draggable elements', ''),
(3, 'Mode 3 - Games', 'Taking the experience to a whole new level', ''),
(4, 'test1', '', ''),
(5, 'test', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sk_progress`
--

CREATE TABLE `sk_progress` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `hotspot_id` int(11) NOT NULL,
  `hotspot_title` varchar(255) NOT NULL,
  `points` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_progress`
--

INSERT INTO `sk_progress` (`id`, `subject_id`, `student_id`, `topic_id`, `hotspot_id`, `hotspot_title`, `points`) VALUES
(1, 1, 1, 2, 1, 'ad', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `sk_students`
--

CREATE TABLE `sk_students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gradelevel` text NOT NULL,
  `schoolname` text NOT NULL,
  `preferences` text NOT NULL,
  `progress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_students`
--

INSERT INTO `sk_students` (`id`, `user_id`, `gradelevel`, `schoolname`, `preferences`, `progress`) VALUES
(1, 3, '1', 'makati science', 'test', ''),
(2, 2, '2', 'makati science', 'test', '');

-- --------------------------------------------------------

--
-- Table structure for table `sk_subjects`
--

CREATE TABLE `sk_subjects` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `background` text NOT NULL,
  `colors` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_subjects`
--

INSERT INTO `sk_subjects` (`id`, `title`, `description`, `background`, `colors`) VALUES
(1, 'Biology', '', '', ''),
(2, 'Chemistry', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sk_teachers`
--

CREATE TABLE `sk_teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gradelevel` int(11) NOT NULL,
  `schoolname` text NOT NULL,
  `preferences` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_teachers`
--

INSERT INTO `sk_teachers` (`id`, `user_id`, `gradelevel`, `schoolname`, `preferences`) VALUES
(1, 2, 1, 'makati science', ''),
(2, 3, 2, 'makati science', ''),
(3, 4, 3, 'Makati Science', '');

-- --------------------------------------------------------

--
-- Table structure for table `sk_topics`
--

CREATE TABLE `sk_topics` (
  `id` int(11) NOT NULL,
  `chapter` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `background` text NOT NULL,
  `content` text NOT NULL,
  `mode_content` text NOT NULL,
  `grade_level` text NOT NULL,
  `subject_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `mode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_topics`
--

INSERT INTO `sk_topics` (`id`, `chapter`, `title`, `description`, `background`, `content`, `mode_content`, `grade_level`, `subject_id`, `author_id`, `mode_id`) VALUES
(1, 'test', 'test', 'test', '', 'test', '{\"3dfile\":\"\",\"instructions\":\"test\",\"hotspots\":[{\"id\":1,\"title\":\"sdf\",\"coordinates\":\"12,2,54\",\"description\":\"test\"}]}', 'test', 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk_users`
--

CREATE TABLE `sk_users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `mobile` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `photo` text NOT NULL,
  `usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_users`
--

INSERT INTO `sk_users` (`id`, `username`, `password`, `email`, `mobile`, `firstname`, `lastname`, `photo`, `usertype`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', 1),
(2, 'test123', '2cec9e12265d8429d206405885163a78', 'adriancleofe@gmail.com', '09777724517', 'adrian', 'cleofe', '', 3),
(3, 'student', 'cd73502828457d15655bbd7a63fb0bc8', 'test@test.com', '09777724517', 'Adrian', 'Cleofe', '', 3),
(4, 'teacher', '8d788385431273d11e8b43bb78f3aa41', 'test@test.com', '09777724517', 'Adrian Manuel', 'Cleofe', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sk_user_types`
--

CREATE TABLE `sk_user_types` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_user_types`
--

INSERT INTO `sk_user_types` (`id`, `title`, `description`) VALUES
(1, 'Administrator', ''),
(2, 'Teacher', ''),
(3, 'Student', '');

-- --------------------------------------------------------

--
-- Structure for view `sk_leaderboard`
--
DROP TABLE IF EXISTS `sk_leaderboard`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sk_leaderboard`  AS  select `sk_progress`.`id` AS `id`,`sk_progress`.`student_id` AS `student_id`,`sk_students`.`user_id` AS `user_id`,`sk_users`.`firstname` AS `firstname`,`sk_users`.`lastname` AS `lastname`,`sk_subjects`.`id` AS `subject_id`,`sk_progress`.`hotspot_title` AS `hotspot_title`,`sk_progress`.`points` AS `points`,`sk_students`.`gradelevel` AS `gradelevel`,`sk_students`.`schoolname` AS `schoolname` from (((`sk_progress` join `sk_students` on(`sk_progress`.`student_id` = `sk_students`.`id`)) join `sk_subjects` on(`sk_progress`.`subject_id` = `sk_subjects`.`id`)) join `sk_users` on(`sk_students`.`user_id` = `sk_users`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sk_history`
--
ALTER TABLE `sk_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sk_modes`
--
ALTER TABLE `sk_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_progress`
--
ALTER TABLE `sk_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `sk_students`
--
ALTER TABLE `sk_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sk_subjects`
--
ALTER TABLE `sk_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sk_teachers`
--
ALTER TABLE `sk_teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sk_topics`
--
ALTER TABLE `sk_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `mode_id` (`mode_id`),
  ADD KEY `sk_topics_ibfk_2` (`author_id`);

--
-- Indexes for table `sk_users`
--
ALTER TABLE `sk_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertype` (`usertype`);

--
-- Indexes for table `sk_user_types`
--
ALTER TABLE `sk_user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sk_history`
--
ALTER TABLE `sk_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `sk_modes`
--
ALTER TABLE `sk_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sk_progress`
--
ALTER TABLE `sk_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sk_students`
--
ALTER TABLE `sk_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_subjects`
--
ALTER TABLE `sk_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_teachers`
--
ALTER TABLE `sk_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sk_topics`
--
ALTER TABLE `sk_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sk_users`
--
ALTER TABLE `sk_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sk_user_types`
--
ALTER TABLE `sk_user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sk_history`
--
ALTER TABLE `sk_history`
  ADD CONSTRAINT `sk_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sk_users` (`id`);

--
-- Constraints for table `sk_progress`
--
ALTER TABLE `sk_progress`
  ADD CONSTRAINT `sk_progress_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `sk_students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sk_progress_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `sk_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_students`
--
ALTER TABLE `sk_students`
  ADD CONSTRAINT `sk_students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sk_users` (`id`);

--
-- Constraints for table `sk_teachers`
--
ALTER TABLE `sk_teachers`
  ADD CONSTRAINT `sk_teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `sk_users` (`id`);

--
-- Constraints for table `sk_topics`
--
ALTER TABLE `sk_topics`
  ADD CONSTRAINT `sk_topics_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `sk_subjects` (`id`),
  ADD CONSTRAINT `sk_topics_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `sk_users` (`id`),
  ADD CONSTRAINT `sk_topics_ibfk_3` FOREIGN KEY (`mode_id`) REFERENCES `sk_modes` (`id`);

--
-- Constraints for table `sk_users`
--
ALTER TABLE `sk_users`
  ADD CONSTRAINT `sk_users_ibfk_1` FOREIGN KEY (`usertype`) REFERENCES `sk_user_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
