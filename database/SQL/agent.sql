-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 20, 2019 at 09:49 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agent`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_event` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `teacher_id`, `student_id`, `is_confirmed`, `title`, `start_event`, `end_event`) VALUES
(23538, 11, NULL, 0, 'Available', '2019-09-13 12:00:00', '2019-09-13 12:30:00'),
(23539, 11, NULL, 0, 'Available', '2019-09-13 13:00:00', '2019-09-13 13:30:00'),
(23542, 11, 2, 1, 'Confirmed', '2019-09-13 10:30:00', '2019-09-13 11:00:00'),
(23543, 11, NULL, 0, 'Available', '2019-09-13 11:00:00', '2019-09-13 11:30:00'),
(23544, 11, NULL, 0, 'Available', '2019-09-13 11:30:00', '2019-09-13 12:00:00'),
(23545, 11, NULL, 0, 'Available', '2019-09-13 12:30:00', '2019-09-13 13:00:00'),
(23546, 11, NULL, 0, 'Available', '2019-09-14 11:30:00', '2019-09-14 12:00:00'),
(23547, 11, NULL, 0, 'Available', '2019-09-14 15:00:00', '2019-09-14 15:30:00'),
(23548, 11, NULL, 0, 'Available', '2019-09-17 09:00:00', '2019-09-17 09:30:00'),
(23549, 11, 2, 0, 'Booked', '2019-09-17 12:00:00', '2019-09-17 12:30:00'),
(23550, 11, NULL, 0, 'Available', '2019-09-18 10:00:00', '2019-09-18 10:30:00'),
(23552, 11, 2, 1, 'Confirmed', '2019-09-18 11:00:00', '2019-09-18 11:30:00'),
(23555, 11, NULL, 0, 'Available', '2019-09-18 12:30:00', '2019-09-18 13:00:00'),
(23558, 11, 2, 0, 'Booked', '2019-09-18 15:00:00', '2019-09-18 15:30:00'),
(23559, 11, NULL, 0, 'Available', '2019-09-18 15:30:00', '2019-09-18 16:00:00'),
(23560, 11, NULL, 0, 'Available', '2019-09-18 16:00:00', '2019-09-18 16:30:00'),
(23561, 11, NULL, 0, 'Available', '2019-09-18 17:00:00', '2019-09-18 17:30:00'),
(23563, 11, NULL, 0, 'Available', '2019-09-18 18:00:00', '2019-09-18 18:30:00'),
(23564, 11, NULL, 0, 'Available', '2019-09-18 17:30:00', '2019-09-18 18:00:00'),
(23570, 20, NULL, 0, 'Available', '2019-09-18 14:30:00', '2019-09-18 15:00:00'),
(23571, 20, NULL, 0, 'Available', '2019-09-18 15:30:00', '2019-09-18 16:00:00'),
(23573, 20, NULL, 0, 'Available', '2019-09-18 16:30:00', '2019-09-18 17:00:00'),
(23574, 11, 2, 1, 'Confirmed', '2019-09-19 06:30:00', '2019-09-19 07:00:00'),
(23575, 11, NULL, 0, 'Available', '2019-09-19 07:00:00', '2019-09-19 07:30:00'),
(23576, 11, NULL, 0, 'Available', '2019-09-19 07:30:00', '2019-09-19 08:00:00'),
(23577, 11, 2, 1, 'Confirmed', '2019-09-19 08:00:00', '2019-09-19 08:30:00'),
(23578, 11, 4, 1, 'Confirmed', '2019-09-19 08:00:00', '2019-09-19 08:30:00'),
(23579, 11, NULL, 0, 'Available', '2019-09-19 08:00:00', '2019-09-19 08:30:00'),
(23580, 11, NULL, 0, 'Available', '2019-09-19 11:00:00', '2019-09-19 11:30:00'),
(23581, 11, NULL, 0, 'Available', '2019-09-19 11:30:00', '2019-09-19 12:00:00'),
(23582, 11, NULL, 0, 'Available', '2019-09-19 12:00:00', '2019-09-19 12:30:00'),
(23583, 11, NULL, 0, 'Available', '2019-09-19 12:30:00', '2019-09-19 13:00:00'),
(23584, 11, 4, 1, 'Confirmed', '2019-09-24 10:00:00', '2019-09-24 10:30:00'),
(23585, 11, NULL, 0, 'Available', '2019-09-19 13:00:00', '2019-09-19 13:30:00'),
(23588, 11, 2, 1, 'Confirmed', '2019-09-24 11:00:00', '2019-09-24 11:30:00'),
(23589, 11, NULL, 0, 'Available', '2019-09-24 12:30:00', '2019-09-24 13:00:00'),
(23590, 11, NULL, 0, 'Available', '2019-09-24 13:30:00', '2019-09-24 14:00:00'),
(23591, 11, NULL, 0, 'Available', '2019-09-25 10:00:00', '2019-09-25 10:30:00'),
(23592, 11, NULL, 0, 'Available', '2019-09-25 11:00:00', '2019-09-25 11:30:00'),
(23593, 11, NULL, 0, 'Available', '2019-09-25 12:30:00', '2019-09-25 13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `jlpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `api_id` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `gender`, `dob`, `jlpt`, `phone`, `nationality`, `description`, `api_id`, `password`, `created_at`) VALUES
(2, 'Nobita', 'Nobi', '1@1.com', 'male', '2019-08-02', 'n4', '88673312632', 'India', 'I like dora cakes and singing', 'dasdas', 'd219af79b45e5891507fda4c4c2139a0', '2019-08-31 15:56:43'),
(3, 'New ', 'Student', 'new@new.com', 'non binary', '2019-09-11', 'n3', '12345678', 'Azerbaijan', NULL, NULL, '1790af845ac5ea46d4aa0387a6f5af9b', '2019-09-05 05:43:26'),
(4, 'raj', 'j', 'r@gmail.com', 'male', '2019-09-18', 'n4', '123', 'Anguilla', 'I like anime', 'rJ.721', '202cb962ac59075b964b07152d234b70', '2019-09-09 09:19:10'),
(5, 'dghkjjk', 'fgkhlj', 'jk@dfls.co', '', '1998-05-31', 'n5', '454678', 'Malta', NULL, NULL, '202cb962ac59075b964b07152d234b70', '2019-09-18 12:10:16');

-- --------------------------------------------------------

--
-- Table structure for table `student_ratings`
--

CREATE TABLE `student_ratings` (
  `id` bigint(20) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(5) DEFAULT NULL,
  `given_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jlpt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `api_id` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `password`, `email`, `gender`, `dob`, `nationality`, `jlpt`, `experience`, `description`, `api_id`, `phone`, `created_at`) VALUES
(10, 'Srikrishna', 'CN', 'd8c881b8e7309202536f41ea9026c8ca', 'qwe1@qwe.com', 'male', '2019-08-07', 'India', 'n2', 'formal', 'sdasdasdasfbarbar', NULL, '8867331263', '2019-08-27 11:40:38'),
(11, 'Srikrishna', 'Rao', 'd219af79b45e5891507fda4c4c2139a0', '1@1.com', 'male', '2019-08-13', 'India', 'n3', 'formal', 'I like teaching students of all ages. I like Cakes. I live in Tokyo.  ', 'rao.krishna.731', '56244234', '2019-08-27 11:48:51'),
(18, 'Gayu', 'kahtir', '202cb962ac59075b964b07152d234b70', 'g@gmail.com', 'female', '2019-09-12', 'Azerbaijan', 'n4', 'formal', 'good at businesslanguage', NULL, '12345678', '2019-09-09 08:55:59'),
(19, 'Ravindra', 'Ravi', '604a2592fdc946151a05706ed0d9978f', 'r@r.com', 'male', '2019-09-13', 'Japan', 'n1', 'informal', 'I like coding, skiing, reading. ', 'rao.krishna.731', '123456', '2019-09-11 04:12:06'),
(20, 'sagvdsadihlasdnk', 'dvgajs', '202cb962ac59075b964b07152d234b70', 'bkds@mksda.ca', 'male', '2019-09-10', 'Afghanistan', 'n3', 'informal', 'klnashdkasbd', 'wbhjab1224sadda', '34234', '2019-09-18 12:37:05');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_ratings`
--

CREATE TABLE `teacher_ratings` (
  `id` bigint(20) NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(5) DEFAULT NULL,
  `given_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`);

--
-- Indexes for table `student_ratings`
--
ALTER TABLE `student_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_ibfk_1` (`teacher_id`),
  ADD KEY `ratings_ibfk_2` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`,`student_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`),
  ADD UNIQUE KEY `teachers_phone_unique` (`phone`);

--
-- Indexes for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_ibfk_2` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`,`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23594;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_ratings`
--
ALTER TABLE `student_ratings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_ratings`
--
ALTER TABLE `student_ratings`
  ADD CONSTRAINT `student_ratings_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_ratings_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teacher_ratings`
--
ALTER TABLE `teacher_ratings`
  ADD CONSTRAINT `teacher_ratings_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `teacher_ratings_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
