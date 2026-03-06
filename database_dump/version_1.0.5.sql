-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 29, 2024 at 06:39 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consultation`
--

ALTER TABLE `commissions` ADD `service_type_id` INT NULL DEFAULT NULL AFTER `appointment_type_id`;
ALTER TABLE `languages` ADD `country_code` VARCHAR(255) NULL DEFAULT NULL AFTER `code`;
UPDATE `languages` SET `country_code` = 'US', `deleted_at` = NULL WHERE `languages`.`id` = 4; UPDATE `languages` SET `country_code` = 'IN', `deleted_at` = NULL WHERE `languages`.`id` = 16; UPDATE `languages` SET `country_code` = 'AE', `deleted_at` = NULL WHERE `languages`.`id` = 17;

ALTER TABLE `posts` CHANGE `description` `description` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NULL DEFAULT NULL;
ALTER TABLE `posts` ADD `is_shared` TINYINT NOT NULL DEFAULT '0' AFTER `is_featured`, ADD `share_with` INT NULL DEFAULT NULL AFTER `is_shared`;
ALTER TABLE `posts` ADD `video` LONGTEXT NULL DEFAULT NULL AFTER `image`;
ALTER TABLE `posts` ADD `shared_description` LONGTEXT NULL DEFAULT NULL AFTER `share_with`;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'is_community_form_show', 'Show Community Form', '1', '0', '0', 'boolean_selection', '', '2024-05-14 17:49:16', '2023-02-16 02:08:43');
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'is_ai_chatbot_enable', 'Is AI chatBot Enable', '1', '0', '0', 'boolean_selection', '', '2024-09-05 10:15:08', '2023-02-16 02:08:43');
-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `content` text,
  `is_like` tinyint(4) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `user_id`, `lawyer_id`, `content`, `is_like`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, 21, 21, 'Excellent Post Man', 1, NULL, '2024-08-15 06:40:08', '2024-08-16 06:16:16', NULL),
(2, 8, 17, 17, 'Comment somethimng', 0, NULL, '2024-08-16 01:15:34', '2024-08-16 06:16:11', NULL),
(3, 9, 17, NULL, 'Comment for Real Estate Law', 0, NULL, '2024-08-16 01:28:02', '2024-08-16 01:28:02', NULL),
(4, 11, 17, NULL, 'This Comment for Real law advisor', 0, NULL, '2024-08-16 01:29:43', '2024-08-16 01:29:43', NULL),
(5, 12, 17, NULL, 'comment for A Guide to Special Education Law', 0, NULL, '2024-08-16 01:34:28', '2024-08-16 01:34:28', NULL),
(6, 13, 17, NULL, 'comment for Balancing Rights and Responsibilities', 0, NULL, '2024-08-16 01:37:16', '2024-08-16 01:37:16', NULL),
(7, 13, 17, NULL, 'comment for Balancing Rights and Responsibilities', 0, NULL, '2024-08-16 01:38:10', '2024-08-16 01:38:10', NULL),
(8, 8, 17, NULL, 'Another Comment', 0, NULL, '2024-08-16 01:39:30', '2024-08-16 01:39:30', NULL),
(9, 20, 17, NULL, 'comment for  A Guide to Special Education Law', 0, NULL, '2024-08-16 01:48:45', '2024-08-16 01:48:45', NULL),
(11, 8, 17, NULL, 'testing', 0, NULL, '2024-08-16 02:16:27', '2024-08-16 02:16:27', NULL),
(12, 143, 17, NULL, 'Testing', 0, NULL, '2024-08-19 01:57:42', '2024-08-19 01:57:42', NULL),
(13, 151, 17, NULL, 'Onw', 0, NULL, '2024-08-19 05:20:57', '2024-08-19 05:20:57', NULL),
(14, 151, 17, NULL, 'This is Reply Message ', 0, 13, '2024-08-19 05:20:57', '2024-08-19 05:20:57', NULL),
(15, 151, 17, NULL, 'Hello', 0, NULL, '2024-08-20 01:36:09', '2024-08-20 01:36:09', NULL),
(16, 151, 17, NULL, 'This is another Reply Message ', 0, 13, '2024-08-19 05:20:57', '2024-08-19 05:20:57', NULL),
(20, 151, 17, NULL, 'Automatically reply recorded', 0, 13, '2024-08-20 02:42:00', '2024-08-20 02:42:00', NULL),
(21, 151, 17, NULL, 'Hello There', 0, 15, '2024-08-20 02:44:33', '2024-08-20 02:44:33', NULL),
(22, 149, 17, NULL, 'Comment recorded', 0, NULL, '2024-08-20 02:49:33', '2024-08-20 02:49:33', NULL),
(23, 149, 17, NULL, 'Another Comment', 0, NULL, '2024-08-20 02:51:17', '2024-08-20 02:51:17', NULL),
(24, 151, 17, NULL, 'Comment', 0, NULL, '2024-08-20 02:52:40', '2024-08-20 02:52:40', NULL),
(25, 151, 17, NULL, 'ewplyyyyyyyyy', 0, 24, '2024-08-20 02:58:16', '2024-08-20 02:58:16', NULL),
(26, 146, 17, NULL, 'commentttttttt', 0, NULL, '2024-08-20 03:00:36', '2024-08-20 03:00:36', NULL),
(27, 146, 17, NULL, 'another reply', 0, 26, '2024-08-20 03:00:54', '2024-08-20 03:00:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `is_like` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `lawyer_id`, `is_like`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 10, NULL, 15, 0, '2024-08-15 07:18:45', '2024-08-16 01:47:52', NULL),
(2, 10, NULL, 21, 1, '2024-08-15 07:18:45', '2024-08-15 07:36:41', NULL),
(3, 10, NULL, 15, 1, '2024-08-15 03:18:44', '2024-08-15 03:18:44', NULL),
(4, 11, NULL, 15, 1, '2024-08-15 03:19:27', '2024-08-16 01:48:02', NULL),
(5, 8, NULL, 17, 1, '2024-08-15 03:25:25', '2024-08-15 07:26:46', NULL),
(6, 10, NULL, 15, 1, '2024-08-15 03:25:31', '2024-08-15 03:25:31', NULL),
(7, 12, NULL, 21, 1, '2024-08-15 03:48:55', '2024-08-15 06:32:39', NULL),
(8, 14, 17, 21, 0, '2024-08-15 04:06:52', '2024-08-16 01:48:18', NULL),
(9, 9, NULL, 17, 1, '2024-08-15 04:07:03', '2024-08-16 01:46:22', NULL),
(10, 13, NULL, 21, 1, '2024-08-15 06:32:55', '2024-08-15 06:32:55', NULL),
(11, 18, NULL, 14, 1, '2024-08-15 06:33:09', '2024-08-15 06:33:09', NULL),
(12, 20, NULL, 14, 1, '2024-08-16 01:48:23', '2024-08-16 01:48:23', NULL),
(13, 151, NULL, 15, 1, '2024-08-19 05:20:48', '2024-08-19 05:20:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_shares`
--

CREATE TABLE `post_shares` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `shared_with` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_shares`
--

INSERT INTO `post_shares` (`id`, `post_id`, `user_id`, `lawyer_id`, `shared_with`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 151, NULL, NULL, NULL, '2024-08-20 05:48:45', '2024-08-20 05:48:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_shares`
--
ALTER TABLE `post_shares`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `post_shares`
--
ALTER TABLE `post_shares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
