-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2026 at 06:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vgss_grading`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_code` varchar(20) NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_code`, `academic_year`, `section`, `created_at`, `updated_at`) VALUES
(5, '10A', '10ano', '2026', 'IPA', '2026-05-20 17:12:42', '2026-05-22 18:00:06'),
(6, '12A', '11ano', '2025', 'IPS', '2026-05-20 17:13:53', '2026-05-22 18:01:51'),
(7, '11A', '12ano', '2025', 'IPA', '2026-05-21 16:40:58', '2026-05-22 18:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `academic_term` enum('Term 1','Term 2','Term 3') NOT NULL,
  `academic_year` varchar(20) NOT NULL,
  `score` decimal(5,2) NOT NULL,
  `grade_letter` varchar(2) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `entered_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student_id`, `subject_id`, `class_id`, `academic_term`, `academic_year`, `score`, `grade_letter`, `remarks`, `entered_by`, `created_at`, `updated_at`) VALUES
(11, 12, 7, 5, 'Term 1', '2025', 10.00, 'A+', 'Excellent', 1, '2026-05-25 17:24:33', '2026-05-25 17:24:33'),
(12, 12, 8, 5, 'Term 1', '2025', 9.00, 'A+', 'Excellent', 1, '2026-05-25 17:25:51', '2026-05-25 17:25:51'),
(13, 12, 9, 5, 'Term 1', '2025', 7.00, 'B', 'Good', 1, '2026-05-25 17:26:47', '2026-05-25 17:26:47'),
(14, 12, 11, 5, 'Term 1', '2025', 8.00, 'A-', 'Very Good', 1, '2026-05-25 18:34:27', '2026-05-25 18:34:27'),
(15, 12, 10, 5, 'Term 1', '2025', 8.00, 'A-', 'Very Good', 1, '2026-05-26 03:29:22', '2026-05-26 03:29:22'),
(16, 12, 13, 5, 'Term 1', '2025', 7.00, 'B', 'Good', 1, '2026-05-26 03:30:23', '2026-05-26 03:30:23'),
(17, 12, 15, 5, 'Term 1', '2025', 8.00, 'A-', 'Very Good', 1, '2026-05-26 03:34:41', '2026-05-26 03:34:41'),
(18, 12, 16, 5, 'Term 1', '2025', 10.00, 'A+', 'Excellent', 1, '2026-05-26 03:38:22', '2026-05-26 03:38:22'),
(19, 12, 17, 5, 'Term 1', '2025', 7.00, 'B', 'Good', 1, '2026-05-26 03:38:55', '2026-05-26 03:38:55'),
(20, 12, 14, 5, 'Term 1', '2025', 7.00, 'B', 'Good', 1, '2026-05-26 03:39:53', '2026-05-26 03:39:53'),
(21, 12, 18, 5, 'Term 1', '2025', 9.00, 'A+', 'Excellent', 1, '2026-05-26 03:40:23', '2026-05-26 03:40:23'),
(22, 12, 19, 5, 'Term 1', '2025', 6.00, 'C+', 'Satisfactory', 1, '2026-05-26 03:41:11', '2026-05-26 03:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `class_id` int(11) NOT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `enrollment_date` date NOT NULL,
  `status` enum('active','inactive','graduated') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `full_name`, `gender`, `date_of_birth`, `class_id`, `parent_name`, `parent_phone`, `address`, `enrollment_date`, `status`, `created_at`, `updated_at`) VALUES
(12, '1234', 'Zaulino Ribeiro', 'male', '1998-12-25', 5, 'Andre', '+670 77684403', 'Beto', '2026-05-26', 'active', '2026-05-25 17:21:31', '2026-05-25 17:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`, `description`, `created_at`, `updated_at`) VALUES
(7, 'MTK', 'Matematica', 'Calculasaun Matematica', '2026-05-20 17:06:04', '2026-05-22 17:33:48'),
(8, 'Ttm', 'Tetum', 'Lingua Tetum', '2026-05-20 17:07:35', '2026-05-20 17:07:35'),
(9, 'Pgs', 'Portugues', 'Lingua Portugues', '2026-05-20 17:08:24', '2026-05-20 17:08:24'),
(10, 'Igs', 'Inglesh', 'Lingua Inglesh', '2026-05-21 16:37:35', '2026-05-21 16:38:25'),
(11, 'MTL', 'Multimedia', 'Teknologia Multimedia', '2026-05-21 16:40:10', '2026-05-21 16:40:10'),
(13, 'FS', 'Fisica', 'Ciensia Fisica', '2026-05-26 03:22:14', '2026-05-26 03:22:14'),
(14, 'QM', 'Quimica', 'Ciensia Quimica', '2026-05-26 03:22:52', '2026-05-26 03:22:52'),
(15, 'Bg', 'Biologia', 'Ciensia Biologia', '2026-05-26 03:23:28', '2026-05-26 03:23:28'),
(16, 'Cd', 'Cidadania', 'Ciensia Fisica e Cidadania', '2026-05-26 03:24:29', '2026-05-26 03:24:29'),
(17, 'Dp', 'Desportu', 'Desportivu', '2026-05-26 03:25:12', '2026-05-26 03:25:12'),
(18, 'Rg', 'Religiao', 'Moral e Religiao', '2026-05-26 03:25:44', '2026-05-26 03:25:44'),
(19, 'Gga', 'Geologia', 'Ciencia Geologia', '2026-05-26 03:27:51', '2026-05-26 03:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','teacher') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@vgss.edu.tl', '$2y$10$lmCn//hs2Di4UJV2JIlDHOS/8IQI6qjOw04ZmYz26zP7DAFp1S7Ne', 'System Administrator', 'admin', '2026-05-09 14:33:39', '2026-05-09 14:36:35'),
(2, 'teacher1', 'teacher1@vgss.edu.tl', '$2y$10$lmCn//hs2Di4UJV2JIlDHOS/8IQI6qjOw04ZmYz26zP7DAFp1S7Ne', 'John Teacher', 'teacher', '2026-05-09 14:33:39', '2026-05-09 14:36:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `entered_by` (`entered_by`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grades_ibfk_4` FOREIGN KEY (`entered_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
