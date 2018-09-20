-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2018 at 05:43 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testx3`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(10) UNSIGNED NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, '1. MT'),
(2, '2. MT'),
(3, '3. MT'),
(4, '4. MT'),
(5, '1. ET'),
(6, '2. ET'),
(7, '3. ET'),
(8, '4. ET'),
(9, '1. PT'),
(11, '2. PT'),
(12, '3. PT'),
(13, '4. PT');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `field_id` int(10) UNSIGNED NOT NULL,
  `field_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_subj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`field_id`, `field_name`, `field_subj_id`) VALUES
(1, 'gradivo1', 1),
(2, 'gradivo2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_07_19_211203_create_classes_table', 1),
(2, '2018_07_19_211339_create_fields_table', 1),
(3, '2018_07_19_211341_create_users_table', 1),
(4, '2018_07_19_211355_create_subjects_table', 1),
(5, '2018_07_19_211452_create_questions_table', 1),
(6, '2018_07_19_211509_create_tests_table', 1),
(7, '2018_07_19_211523_create_testsdone_table', 1),
(8, '2019_10_12_100000_create_password_resets_table', 1),
(9, '2018_09_07_100437_create_teacher_subjects_table', 2),
(10, '2018_09_07_102731_create_class_test_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `ques_id` int(10) UNSIGNED NOT NULL,
  `ques_subj_id` int(11) NOT NULL,
  `ques_field_id` int(11) NOT NULL,
  `ques_questions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques_id`, `ques_subj_id`, `ques_field_id`, `ques_questions`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '{\"1\":{\"question\":\"Pitanje\",\"type\":\"1\",\"ans1\":\"Odgvorrr\",\"ans2\":\"Odg1\",\"ans3\":\"Odgovor jedan\",\"ans4\":\"Odgvr\",\"correct\":[\"ans3\",\"ans4\"]},\"2\":{\"question\":\"QUestions\",\"type\":\"1\",\"ans1\":\"Yes\",\"ans2\":\"Ja\",\"ans3\":\"Da\",\"ans4\":\"Ne\",\"correct\":[\"ans1\",\"ans2\"]},\"3\":{\"question\":\"Pitanjeeeeeeeeee\",\"type\":\"1\",\"ans1\":\"Zadnja\",\"ans2\":\"Proba\",\"ans3\":\"Prije\",\"ans4\":\"Dalje\",\"correct\":[\"ans4\"]}}', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subj_id` int(10) UNSIGNED NOT NULL,
  `subj_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subj_author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subj_id`, `subj_name`, `subj_author`) VALUES
(1, 'test1', 'bruno.rehak');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(10) UNSIGNED NOT NULL,
  `test_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_class` int(11) NOT NULL,
  `test_ques` int(11) NOT NULL,
  `test_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testsdone`
--

CREATE TABLE `testsdone` (
  `testdone_id` int(10) UNSIGNED NOT NULL,
  `test_id` int(11) NOT NULL,
  `test_user_id` int(11) NOT NULL,
  `test_grade` int(11) NOT NULL,
  `test_complete` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_uid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_pwd` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_uid`, `user_email`, `user_pwd`, `user_class`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bruno Rehak', 'bruno.rehak', 'bruno.rehak@gmail.com', '$2y$10$5J0X9tBqODs2vlsfdkxIret9g/mGMKamwOdpvIqieGoqUXs3lDNne', 'admin', 'seRZ0o2cs63KERigqgc6t3Mil1ojjSocVZ7GXjuco8JDA3rHkBN8nhsfy5tl', NULL, NULL),
(2, 'Teo Opic', 'teo.opic', 'teo.opic@skole.hr', '$2y$10$S8Q0kjE2T4D8U1PZVzJ7I.K1s00F18xe3ZRXxy/tiRV.jFeLPa02m', '2', NULL, '2018-09-03 06:19:16', '2018-09-03 06:19:16'),
(3, 'Mario Kaucki', 'marko.kaucki', 'marko.kaucki@skole.hr', '$2y$10$lKeXtsUWcIhSdYuhw5MGQOTj0HNj7aqkdXuNPGwp4IqQfiFLxIBlS', '4', NULL, '2018-09-07 09:19:12', '2018-09-07 09:19:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ques_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subj_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `testsdone`
--
ALTER TABLE `testsdone`
  ADD PRIMARY KEY (`testdone_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_user_uid_unique` (`user_uid`),
  ADD UNIQUE KEY `users_user_email_unique` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `field_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `ques_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subj_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testsdone`
--
ALTER TABLE `testsdone`
  MODIFY `testdone_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
