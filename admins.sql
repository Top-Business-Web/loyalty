-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 04, 2023 at 05:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loyality`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('super_admin','admin','creator') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Bader', 'admin@admin.com', '$2y$10$Tcm/Aq8HbBmyDO3w8id0ruiMHw2t427/XjjycCAKzr3vwKM3FpM16', NULL, '2023-01-26 15:57:49', '2023-06-06 11:33:16', 'super_admin'),
(2, 'محمد الحربي', 'm.nawaf.m.s@gmail.com', '$2y$10$WfkmoKQKIQ5HbyHdQ8QfNe5cbRICfs7W/a1O0f.YEZZd95RF0Yetq', NULL, '2023-06-06 11:34:28', '2023-06-06 11:35:38', 'super_admin'),
(3, 'abdo', 'admin12@admin.com', '$2y$10$Tcm/Aq8HbBmyDO3w8id0ruiMHw2t427/XjjycCAKzr3vwKM3FpM16', NULL, '2023-06-21 11:51:29', '2023-06-21 11:53:31', 'admin'),
(4, 'abdo', 'admin123@admin.com', '$2y$10$Tcm/Aq8HbBmyDO3w8id0ruiMHw2t427/XjjycCAKzr3vwKM3FpM16', NULL, '2023-06-21 11:51:29', '2023-06-21 11:53:31', 'creator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
