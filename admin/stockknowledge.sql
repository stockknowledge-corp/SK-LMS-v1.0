-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2020 at 10:47 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

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
(1, 'Users', 'User login', '2020-10-26 17:47:12', 1);

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
  `schoolname` text NOT NULL,
  `preferences` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sk_modes`
--
ALTER TABLE `sk_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sk_students`
--
ALTER TABLE `sk_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_subjects`
--
ALTER TABLE `sk_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk_teachers`
--
ALTER TABLE `sk_teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_topics`
--
ALTER TABLE `sk_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sk_users`
--
ALTER TABLE `sk_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
