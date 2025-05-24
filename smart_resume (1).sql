-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 03:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_resume`
--

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `template` varchar(100) DEFAULT 'default',
  `title` varchar(255) DEFAULT 'Untitled Resume',
  `type` varchar(100) DEFAULT 'Standard',
  `thumbnail` varchar(255) DEFAULT 'default-thumbnail.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `name`, `email`, `phone`, `summary`, `education`, `experience`, `skills`, `created_at`, `user_id`, `template`, `title`, `type`, `thumbnail`) VALUES
(1, 'Enes nimani', 'enesnimani87@gmail.com', '043891582', 'asxd alk;xmjna hnc', 'SDLCN KCODNSJOKCXN HOPI', ' JDSNCOIPZCHNX PONC', ' DVNSZC NWSP0FDI HNWE', '2025-05-14 19:45:26', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(2, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'as uoxhdiu bqsouib', 'anfasdna oixhnas0dbn ', 'asdoiasdjnsioxn a0isdhn', 'and9osudnbaoisdnas0id', '2025-05-14 19:52:38', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(3, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdadawdawd', 'awdawdawd', 'awdawdawdaw', 'dawdawdawd', '2025-05-14 19:55:23', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(4, 'Enesnimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdas', 'dasdasd', 'asdasdasd', '2025-05-14 20:00:33', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(5, 'Enesnimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdas', 'dasdasd', 'asdasdasd', '2025-05-14 20:00:37', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(6, 'Enesnimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdas', 'dasdasd', 'asdasdasd', '2025-05-14 20:00:56', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(7, 'Enesnimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdas', 'dasdasd', 'asdasdasd', '2025-05-14 20:01:51', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(8, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdawdadw', 'awdawda', 'wdawdawd', 'awdawdawd', '2025-05-14 20:01:58', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(9, 'wdawdawdad', 'enesnimani87@gmail.com', 'wdawdawd', 'awdawd', 'awdawdawd', 'awdawdawda', 'wdawdawdawd', '2025-05-14 20:02:14', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(10, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdawda', 'wdawdawda', 'wdawdawdawd', 'awdawdawd', '2025-05-14 20:04:39', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(11, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdawdad', 'wawdawdawd', 'awdawdawd', 'awdawdawd', '2025-05-14 20:07:25', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(12, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdawdad', 'wawdawdawd', 'awdawdawd', 'awdawdawd', '2025-05-14 20:07:32', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(13, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wdawdadw', 'awdawda', 'wdawdawd', 'awdawdawd', '2025-05-14 20:09:08', NULL, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(14, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wadawdawd', 'awdawdawd', 'awdawdawd', 'wdas', '2025-05-14 20:13:58', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(15, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'wadawdawd', 'awdawdawd', 'awdawdawd', 'awdawdawd', '2025-05-14 20:14:00', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(23, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'qweqw', 'eqweqwe', 'qweqweqwe', 'qweqweqwe', '2025-05-15 15:07:55', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(24, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'qweqw', 'eqweqwe', 'qweqweqwe', 'qweqweqwe', '2025-05-15 15:08:00', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(25, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', '12123', '12313', '123123123', '123123123', '2025-05-15 15:11:53', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(26, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', '12123', '12313', '123123123', '123123123', '2025-05-15 15:11:55', 1, 'default', 'Untitled Resume', 'Standard', 'default-thumbnail.jpg'),
(27, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdasd', 'asdasdasda', 'sdasdasdasd', '2025-05-15 15:18:11', 1, 'template1', 'Enes', 'Standard', 'template1-thumb.jpg'),
(28, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'asdadsasd', 'asdasdasd', 'asdasdasda', 'sdasdasdasd', '2025-05-15 16:55:51', 1, 'template1', 'Enes', 'Standard', 'template1-thumb.jpg'),
(29, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'asdasd', 'asda', 'asdasd', 'asdasdasd', '2025-05-15 17:04:47', 1, 'default', 'Custom Resume', 'Template', 'default-profile.png'),
(30, 'John Doe', 'johndoe@example.com', '+1234567890', 'Motivated professional with proven experience...', 'B.Sc. in Computer Science, XYZ University', 'Software Developer at ABC Corp (2020–2023)', 'JavaScript, PHP, HTML, CSS', '2025-05-15 17:07:30', 1, 'default', 'Custom Resume', 'Template', 'uploads/21JPTHURMANS5-articleLarge.webp'),
(31, 'Enes Nimani', 'enesnimani87@gmail.com', '043891582', 'dfvcsdf', 'vsdvcsfvsdvs', 'dvsdvsdv', 'dvsdvsdvsdvsdv', '2025-05-15 17:17:57', 1, 'default', 'Custom Resume', 'Template', 'default-profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `resume_templates`
--

CREATE TABLE `resume_templates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `template_file` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, 'Enes Nimani', 'enesnimani87@gmail.com', '$2y$10$6NNrIH2XOE0ObsNFlv5bfexcIR3sec5gdxH64t5cn0550q.OVI72e', '2025-05-14 19:49:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_templates`
--
ALTER TABLE `resume_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `resume_templates`
--
ALTER TABLE `resume_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
