-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2018 at 05:17 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cm`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `courseName` varchar(100) DEFAULT NULL,
  `stdLimit` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `imagename` varchar(255) DEFAULT NULL,
  `image_path` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `courseName`, `stdLimit`, `created_at`, `updated_at`, `imagename`, `image_path`) VALUES
(6, 'Python', 20, '2018-03-05 00:45:17', '2018-03-05 00:45:17', 'python.jpg', 'uploads/python.jpg'),
(7, 'HTML', 0, '2018-03-05 00:46:26', '2018-03-05 00:46:26', 'html.png', 'uploads/html.png'),
(8, 'Laravel', 22, '2018-03-05 00:54:21', '2018-03-05 00:54:21', 'laravelp.png', 'uploads/laravelp.png'),
(9, 'MEAN Stack', 10, '2018-03-05 00:55:34', '2018-03-05 00:55:34', 'meanstack.jpg', 'uploads/meanstack.jpg'),
(10, 'Android Development', 22, '2018-03-05 00:57:16', '2018-03-05 00:57:16', 'and.png', 'uploads/and.png');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `e_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `c_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_awaiting` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollment`
--

INSERT INTO `enrollment` (`e_id`, `user_id`, `c_id`, `created_at`, `updated_at`, `is_awaiting`) VALUES
(1, 1, 6, '2018-03-05 18:41:27', '0000-00-00 00:00:00', 0),
(3, 6, 6, '2018-03-05 18:48:17', '0000-00-00 00:00:00', NULL),
(4, 5, 6, '2018-03-05 23:56:39', '2018-03-05 23:56:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `n_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `c_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('theirfanullah@gmail.com', '$2y$10$YelP1YBfqjOHdZ..aGxMkOz6YhIK3n36PXqRfxptSeYq01YWDu34K', '2018-03-06 01:23:15'),
('theirfanirfi@gmail.com', '$2y$10$OtxuIWQDMv.VU5cYX4lTIOjIQuxsCBPW7w02XUilGB2C.kWbanrKW', '2018-03-06 01:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) DEFAULT '0' COMMENT '1 for adming - 2 for students',
  `age` int(11) DEFAULT NULL,
  `year_level` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isProfile` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `age`, `year_level`, `isProfile`) VALUES
(1, 'Irfan Ullah', 'testingadmin@designS2dio.com', '$2y$10$2NwsGrCMRlbE3LWEaJEm8uXs/kFr5OeACN1zbschUVwYJ/CYdMkB6', 'ZNc1Ji2SLd4kn17NTvOljrIzdfcAFJcFtiqyIO4siHOU9Ensa2b0oKLD7hnO', '2018-03-02 07:46:25', '2018-03-02 12:09:03', 1, 22, '3rd', 0),
(5, 'Testing account', 'theirfanirfi@gmail.com', '$2y$10$yj08Gc4gaa3guX0mJ666Be9Z/RGXGNFAZbMqnukiKKdGWB16aUCiC', 'q6hwl28jr8dolJpgycrgNzbyIKyYlfWFmPZ21pWSC6vC3QpIKJemcrixMUlG', '2018-03-05 00:47:44', '2018-03-05 23:56:26', 0, 22, '3rd level', 1),
(6, 'fsfa', 'fsdafdf', '', NULL, NULL, NULL, 0, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
