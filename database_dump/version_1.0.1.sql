-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2024 at 04:40 PM
-- Server version: 10.6.12-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hexa_advisor_lawyer`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` char(3) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `direction` varchar(12) DEFAULT NULL,
  `decimal_places` int(1) DEFAULT NULL,
  `value` double(13,8) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `direction`, `decimal_places`, `value`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 'USA Dollar', 'AUD', '€', 'ltr', 4, 1.00000000, 1, 1, '2021-03-19 01:57:02', '2024-01-09 10:27:32');

-- --------------------------------------------------------

--
-- Table structure for table `currency_codes`
--

CREATE TABLE `currency_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `currency_codes`
--

INSERT INTO `currency_codes` (`id`, `code`, `symbol`) VALUES
(1, 'ALL', 'Lek'),
(2, 'USD', '$'),
(3, 'AFN', '?'),
(4, 'ARS', '$'),
(5, 'AWG', 'ƒ'),
(6, 'AUD', '$'),
(7, 'AZN', '???'),
(8, 'BSD', '$'),
(9, 'BBD', '$'),
(10, 'BYR', 'p.'),
(11, 'EUR', '€'),
(12, 'BZD', 'BZ$'),
(13, 'BMD', '$'),
(14, 'BOB', '$b'),
(15, 'BAM', 'KM'),
(16, 'BWP', 'P'),
(17, 'BGN', '??'),
(18, 'BRL', 'R$'),
(19, 'GBP', '£'),
(20, 'BND', '$'),
(21, 'KHR', '?'),
(22, 'CAD', '$'),
(23, 'KYD', '$'),
(24, 'CLP', '$'),
(25, 'CNY', '¥'),
(26, 'COP', '$'),
(27, 'CRC', '?'),
(28, 'HRK', 'kn'),
(29, 'CUP', '?'),
(30, 'EUR', '€'),
(31, 'CZK', 'K?'),
(32, 'DKK', 'kr'),
(33, 'DOP ', 'RD$'),
(34, 'XCD', '$'),
(35, 'EGP', '£'),
(36, 'SVC', '$'),
(37, 'GBP', '£'),
(38, 'EUR', '€'),
(39, 'FKP', '£'),
(40, 'FJD', '$'),
(41, 'EUR', '€'),
(42, 'GHC', '¢'),
(43, 'GIP', '£'),
(44, 'EUR', '€'),
(45, 'GTQ', 'Q'),
(46, 'GGP', '£'),
(47, 'GYD', '$'),
(48, 'EUR', '€'),
(49, 'HNL', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

CREATE TABLE `funds` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `gateway_id` int(10) UNSIGNED DEFAULT NULL,
  `gateway_currency` varchar(191) DEFAULT NULL,
  `amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `rate` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `final_amount` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `btc_amount` decimal(18,8) DEFAULT NULL,
  `btc_wallet` varchar(191) DEFAULT NULL,
  `transaction` varchar(25) DEFAULT NULL,
  `try` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=> Complete, 2=> Pending, 3 => Cancel',
  `detail` text DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `payment_id` varchar(61) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'appointment',
  `transaction_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `user_id`, `gateway_id`, `gateway_currency`, `amount`, `charge`, `rate`, `final_amount`, `btc_amount`, `btc_wallet`, `transaction`, `try`, `status`, `detail`, `feedback`, `payment_id`, `type`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'TA8J9M8HEPTZ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:14:31', '2023-12-13 09:14:31'),
(2, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'QJMW6PY7D5RR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:17:37', '2023-12-13 09:17:37'),
(3, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'RHUERQZDB1XB', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:18:03', '2023-12-13 09:18:03'),
(4, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'RJ4HK9TNNY7V', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:21:38', '2023-12-13 09:21:38'),
(5, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'J8FSW8C1PROQ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:43:32', '2023-12-13 09:43:32'),
(6, 1, 9, 'USD', '10.00000000', '0.50000000', '0.01200000', '0.12600000', '0.00000000', '', 'YHG2GKU8J98J', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 09:51:07', '2023-12-13 09:51:07'),
(7, 1, 9, 'USD', '10.00000000', '0.50000000', '0.01200000', '0.12600000', '0.00000000', '', 'FP8ZZ2HKVSTW', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 10:34:19', '2023-12-13 10:34:19'),
(8, 1, 9, 'USD', '100.00000000', '0.50000000', '0.01200000', '1.20600000', '0.00000000', '', '1U6WOE61KDG3', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 10:35:11', '2023-12-13 10:35:11'),
(9, 1, 1, 'USD', '100.00000000', '1.50000000', '0.01200000', '1.21800000', '0.00000000', '', 'MDGBNC7ETWCB', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 10:41:25', '2023-12-13 10:41:25'),
(10, 1, 9, 'USD', '100.00000000', '0.50000000', '0.01200000', '1.20600000', '0.00000000', '', '9WOEZGA1ZRVR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 10:59:53', '2023-12-13 10:59:53'),
(11, 1, 1, 'USD', '100.00000000', '1.50000000', '0.01200000', '1.21800000', '0.00000000', '', 'XQYJ8VEDKDRT', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 11:09:03', '2023-12-13 11:09:03'),
(12, 1, 2, 'USD', '100.00000000', '0.50000000', '1.00000000', '100.50000000', '0.00000000', 'cs_test_a1KXUKs5FtnTTSfh2GXPef8t4kSv1CEe4FbwNzmRnkGfBk499E1eQWZR59', '75TYVJSVVA3S', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-13 11:11:37', '2023-12-13 11:11:48'),
(13, 1, 2, 'USD', '100.00000000', '0.50000000', '1.00000000', '100.50000000', '0.00000000', 'cs_test_a1gywYhvAsN72BU65vOe8xIRr3QJsK8h5Zq20CQbf9iiLUnt2xSLE911Ub', 'TQY74QPJZV68', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-14 09:26:09', '2023-12-14 09:42:01'),
(14, 1, 9, 'USD', '100.00000000', '0.50000000', '0.01200000', '1.20600000', '0.00000000', '', 'JJ1GE18U9G8S', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-14 09:43:45', '2023-12-14 09:43:45'),
(15, 1, 9, 'USD', '100.00000000', '0.50000000', '0.01200000', '1.20600000', '0.00000000', '', '8EJGU8DWA6P9', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-14 10:30:28', '2023-12-14 10:30:28'),
(16, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'UMQHBFS4E467', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 10:42:46', '2023-12-18 10:42:46'),
(17, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '93BESY7EA6YA', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 10:44:45', '2023-12-18 10:44:45'),
(18, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'XFXSEXDEQ15V', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 10:50:21', '2023-12-18 10:50:21'),
(19, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a183SmXXdRdpha6A8pqvLZ6mfQOuNQlfjnBDKZ3bKObDSUQNZa3Kb1ESIF', '24GRQ3JB4MN6', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:01:01', '2023-12-18 11:01:03'),
(20, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a1VLV0Tl3blLHieSY0syNvme8O3oUHltDk5RQXQpv7BmdnRQrMT6cqC7u0', 'C6C338XCCQ2D', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:04:27', '2023-12-18 11:04:29'),
(21, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a1esRiAicevOamMDpXRLenm45Qz8fbKb2uOQ3EuIy5ZEIdDjwvYPBSx7aa', '7Q8R3VBENPK4', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:05:17', '2023-12-18 11:05:18'),
(22, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a1Q2T5Ze1KUYb6uXkkhVrlFMwJo8oJgG0s8KpJSYi8p0sMEfcvs8iQkQZ9', 'P9XT2T3BZKJN', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:19:57', '2023-12-18 11:19:59'),
(23, 1, 9, 'USD', '10.00000000', '0.50000000', '0.01200000', '0.12600000', '0.00000000', '', 'E93VQA6797R1', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:20:36', '2023-12-18 11:20:36'),
(24, 1, 9, 'USD', '10.00000000', '0.50000000', '0.01200000', '0.12600000', '0.00000000', '', '9F67OXQYVSHR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:23:07', '2023-12-18 11:23:07'),
(25, 1, 1, 'USD', '10.00000000', '0.60000000', '0.01200000', '0.12720000', '0.00000000', '', 'S9H9ZJ6Y7CYR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:23:38', '2023-12-18 11:23:38'),
(26, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a1Ver5a2qN8riLuPimOidzNqE2W4wEmhgcgmn6FEQpR8IePgXL5Cd1vQIO', '6UFO44Z8MPZ1', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-18 11:24:05', '2023-12-18 11:24:06'),
(27, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a1cgFDkqdtNmMfFOvIhSXtfgzWkeJ8bYkDTiLgoXDeZMP5xecNtBfwzzaE', '1ASMXO6EACKR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-20 09:29:28', '2023-12-20 09:29:30'),
(28, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'M72PKBFJERSX', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 05:40:08', '2023-12-27 05:40:08'),
(29, 1, 2, 'USD', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', 'cs_test_a166a5i2kUOhfYXL1tHic3k2jCuGF3LT1jvy2Xj21eSXCf9YuKozLpaDny', 'UB1EBBE7AAJZ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 05:40:53', '2023-12-27 05:40:54'),
(30, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'WENHDJQOETNK', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 05:42:51', '2023-12-27 05:42:51'),
(31, 1, 30, 'RUB', '10.00000000', '0.01000000', '1.00000000', '10.01000000', '0.00000000', '', 'X7DYY8VEMD58', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 05:43:28', '2023-12-27 05:43:28'),
(32, 1, 32, 'NPR', '10.00000000', '0.15000000', '1.00000000', '10.15000000', '0.00000000', '', '8UB7B83T5VHO', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 05:45:21', '2023-12-27 05:45:21'),
(33, 1, 9, 'USD', '10.00000000', '0.50000000', '0.01200000', '0.12600000', '0.00000000', '', 'JEA1H5Y81NO3', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 09:22:33', '2023-12-27 09:22:33'),
(34, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '9QGUK68HY79R', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-27 09:23:29', '2023-12-27 09:23:29'),
(35, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'NWKYPT3WJTUH', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:43:23', '2023-12-28 09:43:23'),
(36, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', '5ZBJYE7WXQP4', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:45:50', '2023-12-28 09:45:50'),
(37, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'EFPWPVVOCRTX', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:49:32', '2023-12-28 09:49:32'),
(38, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', '8FW3O67X3591', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:50:14', '2023-12-28 09:50:14'),
(39, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'WOM49DHD5TXC', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:51:51', '2023-12-28 09:51:51'),
(40, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', '5THCMKCFGUHA', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:57:13', '2023-12-28 09:57:13'),
(41, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'SRYGBP5C352V', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 09:59:55', '2023-12-28 09:59:55'),
(42, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'FP149KVNNBBW', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-28 10:05:34', '2023-12-28 10:05:34'),
(43, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', '84NQZKEXRRPD', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:19:23', '2023-12-29 02:19:23'),
(44, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'RYDT2D3R1U8F', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:20:59', '2023-12-29 02:20:59'),
(45, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', 'E7GPZP867E3V', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:22:44', '2023-12-29 02:22:44'),
(46, 1, 25, 'PKR', '10.00000000', '0.50000000', '0.85000000', '8.92500000', '0.00000000', '', '4HKCHE2GYJS6', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:26:32', '2023-12-29 02:26:32'),
(47, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'H9VVEK4XWTTQ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:51:07', '2023-12-29 02:51:07'),
(48, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'K21GP1QJPEAH', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:51:31', '2023-12-29 02:51:31'),
(49, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'SNAH8SP2ROVP', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:53:40', '2023-12-29 02:53:40'),
(50, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'KZGSD9OEWB93', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:55:36', '2023-12-29 02:55:36'),
(51, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'WJU7QARRHJ6O', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:57:15', '2023-12-29 02:57:15'),
(52, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', '8ZBER5R2SNVA', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 02:57:31', '2023-12-29 02:57:31'),
(53, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'FUZGKRKX9CA6', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:15:30', '2023-12-29 05:15:30'),
(54, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'X439DHDT4E3C', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:16:35', '2023-12-29 05:16:35'),
(55, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', '4AJFDWYUKOAZ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:16:55', '2023-12-29 05:16:55'),
(56, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', '9JKNJ8KDSH9E', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:18:09', '2023-12-29 05:18:09'),
(57, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', 'OWK9WC9U7V6T', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:18:22', '2023-12-29 05:18:22'),
(58, 1, 22, 'BTC', '10.00000000', '0.60000000', '0.00000000', '0.00000000', '0.00000000', '', '4G83ZTPP3X97', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2023-12-29 05:18:33', '2023-12-29 05:18:33'),
(59, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'VOUR9AD9EG9U', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-09 01:56:08', '2024-01-09 01:56:08'),
(60, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'M2NRNBFJF81S', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-09 01:58:18', '2024-01-09 02:01:55'),
(61, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'VNXJKZW3MTUT', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-09 02:39:22', '2024-01-09 02:39:55'),
(63, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '9ADTBQZWO649', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-10 03:53:19', '2024-01-10 04:04:44'),
(64, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'MNUPJ7ASM83F', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-10 04:11:01', '2024-01-10 04:11:01'),
(65, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '755BP7KKR6S8', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 02:47:28', '2024-01-11 02:47:28'),
(66, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'X739MZAMMQEZ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:01:37', '2024-01-11 03:01:37'),
(67, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'YD8WV3RFEYYQ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:03:12', '2024-01-11 03:03:12'),
(68, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'G8YXZO38V7TB', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:03:40', '2024-01-11 03:03:40'),
(69, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'YM463W55NBVD', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:03:47', '2024-01-11 03:03:47'),
(70, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'CYBR256VFZRR', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:08:54', '2024-01-11 03:08:54'),
(71, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'FKFNSUYACK6G', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:14:12', '2024-01-11 03:17:33'),
(72, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '1YEQNB3OA381', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:18:44', '2024-01-11 03:20:46'),
(73, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'GDRU9PW6EXY3', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:27:40', '2024-01-11 03:28:21'),
(74, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '75YWHFUMS6FD', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:30:09', '2024-01-11 03:30:09'),
(75, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '94V9J3WX1BX8', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:45:25', '2024-01-11 03:46:00'),
(76, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'FK23JCM7VBOP', 0, 1, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 03:47:22', '2024-01-11 03:47:55'),
(77, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', '798QEGKQXYMZ', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 07:26:34', '2024-01-11 07:26:34'),
(78, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'NZYBVG1XQ5YN', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 07:59:44', '2024-01-11 07:59:44'),
(79, 1, 10, 'INR', '10.00000000', '0.50000000', '1.00000000', '10.50000000', '0.00000000', '', 'TDR198OXYR8R', 0, 0, NULL, NULL, NULL, 'appointment', NULL, '2024-01-11 09:26:16', '2024-01-11 09:26:16');

-- --------------------------------------------------------

--
-- Table structure for table `gateways`
--

CREATE TABLE `gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `currency` varchar(191) NOT NULL,
  `symbol` varchar(191) NOT NULL,
  `parameters` text DEFAULT NULL,
  `extra_parameters` text DEFAULT NULL,
  `convention_rate` decimal(18,8) NOT NULL DEFAULT 1.00000000,
  `currencies` text DEFAULT NULL,
  `min_amount` decimal(18,8) NOT NULL,
  `max_amount` decimal(18,8) NOT NULL,
  `percentage_charge` decimal(8,4) NOT NULL DEFAULT 0.0000,
  `fixed_charge` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0: inactive, 1: active',
  `note` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `sort_by` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` (`id`, `name`, `code`, `currency`, `symbol`, `parameters`, `extra_parameters`, `convention_rate`, `currencies`, `min_amount`, `max_amount`, `percentage_charge`, `fixed_charge`, `status`, `note`, `image`, `sort_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Paypal', 'paypal', 'USD', 'USD', '{\"cleint_id\":\"asdasd93485\",\"secret\":\"upadasdml234\"}', NULL, '0.01200000', '{\"0\":{\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"GBP\":\"GBP\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"USD\":\"USD\"}}', '1.00000000', '10000.00000000', '1.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075352paypal.png', 14, '2020-09-10 09:05:02', '2024-01-12 16:02:32', NULL),
(2, 'Stripe ', 'stripe', 'USD', 'USD', '{\"secret_key\":\"sk_test_4mIgs731P1pD8aEEO57Ytf5v\",\"publishable_key\":\"pk_test_0OgQlXP7CRZ0AzpdcYQfM496\",\"endpoint_secret\":\"**************\"}', '{\"webhook\":\"ipn\"}', '1.00000000', '{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"SGD\":\"SGD\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075857stripe.png', 23, '2020-09-10 09:05:02', '2024-01-12 16:10:57', NULL),
(3, 'Skrill', 'skrill', 'USD', 'USD', '{\"pay_to_email\":\"**************\",\"secret_key\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"MAD\":\"MAD\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"SAR\":\"SAR\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TND\":\"TND\",\"TRY\":\"TRY\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\",\"COP\":\"COP\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075839skrill.png', 22, '2020-09-10 09:05:02', '2024-01-12 16:10:39', NULL),
(4, 'Perfect Money', 'perfectmoney', 'USD', 'USD', '{\"passphrase\":\"**************\",\"payee_account\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075787perfect-money.png', 18, '2020-09-10 09:05:02', '2024-01-12 16:09:47', NULL),
(5, 'PayTM', 'paytm', 'INR', 'INR', '{\"MID\":\"**************\",\"merchant_key\":\"**************\",\"WEBSITE\":\"**************\",\"INDUSTRY_TYPE_ID\":\"**************\",\"CHANNEL_ID\":\"**************\",\"environment_url\":\"**************\",\"process_transaction_url\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"AUD\":\"AUD\",\"ARS\":\"ARS\",\"BDT\":\"BDT\",\"BRL\":\"BRL\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"GEL\":\"GEL\",\"GHS\":\"GHS\",\"HKD\":\"HKD\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"MYR\":\"MYR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"NGN\":\"NGN\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SGD\":\"SGD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"THB\":\"THB\",\"TRY\":\"TRY\",\"UGX\":\"UGX\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"GBP\":\"GBP\",\"USD\":\"USD\",\"VND\":\"VND\",\"XOF\":\"XOF\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075695payTM.png', 16, '2020-09-10 09:05:02', '2024-01-12 16:08:16', NULL),
(6, 'Payeer', 'payeer', 'RUB', 'USD', '{\"merchant_id\":\"P1109116078\",\"secret_key\":\"m5R81LJ7Ieu33h8Y\"}', '{\"status\":\"ipn\"}', '1.00000000', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\",\"RUB\":\"RUB\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075215payeer.png', 13, '2020-09-10 09:05:02', '2024-01-12 16:00:15', NULL),
(7, 'PayStack', 'paystack', 'NGN', 'NGN', '{\"public_key\":\"***************\",\"secret_key\":\"***************\"}', '{\"callback\":\"ipn\",\"webhook\":\"ipn\"}\r\n', '1.00000000', '{\"0\":{\"USD\":\"USD\",\"NGN\":\"NGN\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075369paystack.png', 15, '2020-09-10 09:05:02', '2024-01-12 16:02:49', NULL),
(8, 'VoguePay', 'voguepay', 'USD', 'USD', '{\"merchant_id\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"NGN\":\"NGN\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"ZAR\":\"ZAR\",\"JPY\":\"JPY\",\"INR\":\"INR\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PLN\":\"PLN\"}}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075868VoguePay .png', 21, '2020-09-10 09:05:02', '2024-01-12 16:11:08', NULL),
(9, 'Flutterwave', 'flutterwave', 'USD', 'USD', '{\"public_key\":\"***************\",\"secret_key\":\"***************\",\"encryption_key\":\"***************\"}', NULL, '0.01200000', '{\"0\":{\"KES\":\"KES\",\"GHS\":\"GHS\",\"NGN\":\"NGN\",\"USD\":\"USD\",\"GBP\":\"GBP\",\"EUR\":\"EUR\",\"UGX\":\"UGX\",\"TZS\":\"TZS\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705074939Flutterwave.png', 8, '2020-09-10 09:05:02', '2024-01-12 15:55:39', NULL),
(10, 'RazorPay', 'razorpay', 'INR', 'INR', '{\"key_id\":\"rzp_test_LbK7OKIrPbCFo3\",\"key_secret\":\"j7Gjtvc6zr4eFkUTqfpuAZVd\"}', NULL, '10.00000000', '{\"0\": {\"INR\": \"INR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705075802razorpay.png', 19, '2020-09-10 09:05:02', '2024-01-12 16:10:02', NULL),
(11, 'instamojo', 'instamojo', 'INR', 'INR', '{\"api_key\":\"***************\",\"auth_token\":\"***************\",\"salt\":\"***************\"}', NULL, '73.51000000', '{\"0\":{\"INR\":\"INR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705074994instamojo.png', 9, '2020-09-10 09:05:02', '2024-01-12 15:56:34', NULL),
(12, 'Mollie', 'mollie', 'USD', 'USD', '{\"api_key\":\"***************\"}', NULL, '0.01200000', '{\"0\":{\"AED\":\"AED\",\"AUD\":\"AUD\",\"BGN\":\"BGN\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"HRK\":\"HRK\",\"HUF\":\"HUF\",\"ILS\":\"ILS\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\",\"USD\":\"USD\",\"ZAR\":\"ZAR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075135mollie.png', 11, '2020-09-10 09:05:02', '2024-01-12 15:58:55', NULL),
(13, '2checkout', 'twocheckout', 'USD', 'USD', '{\"merchant_code\":\"********************\",\"secret_key\":\"********************\"}', '{\"approved_url\":\"ipn\"}', '1.00000000', '{\"0\":{\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"DZD\":\"DZD\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AZN\":\"AZN\",\"BSD\":\"BSD\",\"BDT\":\"BDT\",\"BBD\":\"BBD\",\"BZD\":\"BZD\",\"BMD\":\"BMD\",\"BOB\":\"BOB\",\"BWP\":\"BWP\",\"BRL\":\"BRL\",\"GBP\":\"GBP\",\"BND\":\"BND\",\"BGN\":\"BGN\",\"CAD\":\"CAD\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"HRK\":\"HRK\",\"CZK\":\"CZK\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"XCD\":\"XCD\",\"EGP\":\"EGP\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"GTQ\":\"GTQ\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HUF\":\"HUF\",\"INR\":\"INR\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"JMD\":\"JMD\",\"JPY\":\"JPY\",\"KZT\":\"KZT\",\"KES\":\"KES\",\"LAK\":\"LAK\",\"MMK\":\"MMK\",\"LBP\":\"LBP\",\"LRD\":\"LRD\",\"MOP\":\"MOP\",\"MYR\":\"MYR\",\"MVR\":\"MVR\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MXN\":\"MXN\",\"MAD\":\"MAD\",\"NPR\":\"NPR\",\"TWD\":\"TWD\",\"NZD\":\"NZD\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"PKR\":\"PKR\",\"PGK\":\"PGK\",\"PEN\":\"PEN\",\"PHP\":\"PHP\",\"PLN\":\"PLN\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"WST\":\"WST\",\"SAR\":\"SAR\",\"SCR\":\"SCR\",\"SGD\":\"SGD\",\"SBD\":\"SBD\",\"ZAR\":\"ZAR\",\"KRW\":\"KRW\",\"LKR\":\"LKR\",\"SEK\":\"SEK\",\"CHF\":\"CHF\",\"SYP\":\"SYP\",\"THB\":\"THB\",\"TOP\":\"TOP\",\"TTD\":\"TTD\",\"TRY\":\"TRY\",\"UAH\":\"UAH\",\"AED\":\"AED\",\"USD\":\"USD\",\"VUV\":\"VUV\",\"VND\":\"VND\",\"XOF\":\"XOF\",\"YER\":\"YER\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/17050733572checkout.png', 24, '2020-09-10 09:05:02', '2024-01-12 15:29:17', NULL),
(14, 'Authorize.Net', 'authorizenet', 'USD', 'USD', '{\"login_id\":\"********************\",\"current_transaction_key\":\"********************\"}', NULL, '0.01200000', '{\"0\":{\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"NOK\":\"NOK\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"SEK\":\"SEK\",\"USD\":\"USD\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705073391Authorize-net.png', 1, '2020-09-10 09:05:02', '2024-01-12 15:29:51', NULL),
(15, 'SecurionPay', 'securionpay', 'USD', 'USD', '{\"public_key\":\"**************\",\"secret_key\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"AFN\":\"AFN\", \"DZD\":\"DZD\", \"ARS\":\"ARS\", \"AUD\":\"AUD\", \"BHD\":\"BHD\", \"BDT\":\"BDT\", \"BYR\":\"BYR\", \"BAM\":\"BAM\", \"BWP\":\"BWP\", \"BRL\":\"BRL\", \"BND\":\"BND\", \"BGN\":\"BGN\", \"CAD\":\"CAD\", \"CLP\":\"CLP\", \"CNY\":\"CNY\", \"COP\":\"COP\", \"KMF\":\"KMF\", \"HRK\":\"HRK\", \"CZK\":\"CZK\", \"DKK\":\"DKK\", \"DJF\":\"DJF\", \"DOP\":\"DOP\", \"EGP\":\"EGP\", \"ETB\":\"ETB\", \"ERN\":\"ERN\", \"EUR\":\"EUR\", \"GEL\":\"GEL\", \"HKD\":\"HKD\", \"HUF\":\"HUF\", \"ISK\":\"ISK\", \"INR\":\"INR\", \"IDR\":\"IDR\", \"IRR\":\"IRR\", \"IQD\":\"IQD\", \"ILS\":\"ILS\", \"JMD\":\"JMD\", \"JPY\":\"JPY\", \"JOD\":\"JOD\", \"KZT\":\"KZT\", \"KES\":\"KES\", \"KWD\":\"KWD\", \"KGS\":\"KGS\", \"LVL\":\"LVL\", \"LBP\":\"LBP\", \"LTL\":\"LTL\", \"MOP\":\"MOP\", \"MKD\":\"MKD\", \"MGA\":\"MGA\", \"MWK\":\"MWK\", \"MYR\":\"MYR\", \"MUR\":\"MUR\", \"MXN\":\"MXN\", \"MDL\":\"MDL\", \"MAD\":\"MAD\", \"MZN\":\"MZN\", \"NAD\":\"NAD\", \"NPR\":\"NPR\", \"ANG\":\"ANG\", \"NZD\":\"NZD\", \"NOK\":\"NOK\", \"OMR\":\"OMR\", \"PKR\":\"PKR\", \"PEN\":\"PEN\", \"PHP\":\"PHP\", \"PLN\":\"PLN\", \"QAR\":\"QAR\", \"RON\":\"RON\", \"RUB\":\"RUB\", \"SAR\":\"SAR\", \"RSD\":\"RSD\", \"SGD\":\"SGD\", \"ZAR\":\"ZAR\", \"KRW\":\"KRW\", \"IKR\":\"IKR\", \"LKR\":\"LKR\", \"SEK\":\"SEK\", \"CHF\":\"CHF\", \"SYP\":\"SYP\", \"TWD\":\"TWD\", \"TZS\":\"TZS\", \"THB\":\"THB\", \"TND\":\"TND\", \"TRY\":\"TRY\", \"UAH\":\"UAH\", \"AED\":\"AED\", \"GBP\":\"GBP\", \"USD\":\"USD\", \"VEB\":\"VEB\", \"VEF\":\"VEF\", \"VND\":\"VND\", \"XOF\":\"XOF\", \"YER\":\"YER\", \"ZMK\":\"ZMK\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075825Securionpay.png', 20, '2020-09-10 09:05:02', '2024-01-12 16:10:25', NULL),
(16, 'PayUmoney', 'payumoney', 'INR', 'INR', '{\"merchant_key\":\"**************\",\"salt\":\"**************\"}', NULL, '0.87000000', '{\"0\":{\"INR\":\"INR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075719payumoney.png', 17, '2020-09-10 09:05:02', '2024-01-12 16:08:40', NULL),
(17, 'Mercado Pago', 'mercadopago', 'BRL', 'BRL', '{\"access_token\":\"***************\"}', NULL, '0.06300000', '{\"0\":{\"ARS\":\"ARS\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"DOP\":\"DOP\",\"EUR\":\"EUR\",\"GTQ\":\"GTQ\",\"HNL\":\"HNL\",\"MXN\":\"MXN\",\"NIO\":\"NIO\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PYG\":\"PYG\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"VEF\":\"VEF\",\"VES\":\"VES\"}}', '3715.12000000', '371500000.12000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075107mercado-pago.png', 10, '2020-09-10 09:05:02', '2024-01-12 15:58:27', NULL),
(18, 'Coingate', 'coingate', 'USD', 'USD', '{\"api_key\":\"***************\"}', NULL, '1.00000000', '{\"0\":{\"USD\":\"USD\",\"EUR\":\"EUR\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705074864Coingate.png', 7, '2020-09-10 09:05:02', '2024-01-12 15:54:24', NULL),
(19, 'Coinbase Commerce', 'coinbasecommerce', 'USD', 'USD', '{\"api_key\":\"***************\",\"secret\":\"***************\"}', '{\"webhook\":\"ipn\"}', '1.00000000', '{\"0\":{\"AED\":\"AED\",\"AFN\":\"AFN\",\"ALL\":\"ALL\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZN\":\"AZN\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYN\":\"BYN\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLF\":\"CLF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUC\":\"CUC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHS\":\"GHS\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZN\":\"MZN\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RSD\":\"RSD\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDG\":\"SDG\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SRD\":\"SRD\",\"SSP\":\"SSP\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMT\":\"TMT\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMW\":\"ZMW\",\"ZWL\":\"ZWL\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705074880coinbase-commerce.png', 3, '2020-09-10 09:05:02', '2024-01-12 15:54:40', NULL),
(20, 'Monnify', 'monnify', 'NGN', 'NGN', '{\"api_key\":\"***************\",\"secret_key\":\"***************\",\"contract_code\":\"***************\"}', NULL, '4.52000000', '{\"0\":{\"NGN\":\"NGN\"}}', '1.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705075174monnify.png', 12, '2020-09-10 09:05:02', '2024-01-12 15:59:34', NULL),
(21, 'Block.io', 'blockio', 'BTC', 'BTC', '{\"api_key\":\"1e83-f033-177a-1644\",\"api_pin\":\"A62C503A6032C8C3\"}', '{\"cron\":\"ipn\"}', '0.00004200', '{\"1\":{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}}', '10.10000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076280block-io.png', 2, '2020-09-10 09:05:02', '2024-01-12 16:18:00', NULL),
(22, 'CoinPayments', 'coinpayments', 'BTC', 'BTC', '{\"merchant_id\":\"86ebca4746ea46796e58538f0e6e34f6\",\"private_key\":\"e177C49cc9bBb93b94A83f74229Acf6507E77d955Ba8ac0E742C71d3EC70fc6b\",\"public_key\":\"c8d66aa5e9eeeaffb6c0e9cfa00108d9743bed570523d43e7fe8237841dd1be6\"}', '{\"callback\":\"ipn\"}', '0.00000000', '{\"0\":{\"USD\":\"USD\",\"AUD\":\"AUD\",\"BRL\":\"BRL\",\"CAD\":\"CAD\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"DKK\":\"DKK\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"HKD\":\"HKD\",\"INR\":\"INR\",\"ISK\":\"ISK\",\"JPY\":\"JPY\",\"KRW\":\"KRW\",\"NZD\":\"NZD\",\"PLN\":\"PLN\",\"RUB\":\"RUB\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"THB\":\"THB\",\"TWD\":\"TWD\"},\"1\":{\"BTC\":\"Bitcoin\",\"BTC.LN\":\"Bitcoin (Lightning Network)\",\"LTC\":\"Litecoin\",\"CPS\":\"CPS Coin\",\"VLX\":\"Velas\",\"APL\":\"Apollo\",\"AYA\":\"Aryacoin\",\"BAD\":\"Badcoin\",\"BCD\":\"Bitcoin Diamond\",\"BCH\":\"Bitcoin Cash\",\"BCN\":\"Bytecoin\",\"BEAM\":\"BEAM\",\"BITB\":\"Bean Cash\",\"BLK\":\"BlackCoin\",\"BSV\":\"Bitcoin SV\",\"BTAD\":\"Bitcoin Adult\",\"BTG\":\"Bitcoin Gold\",\"BTT\":\"BitTorrent\",\"CLOAK\":\"CloakCoin\",\"CLUB\":\"ClubCoin\",\"CRW\":\"Crown\",\"CRYP\":\"CrypticCoin\",\"CRYT\":\"CryTrExCoin\",\"CURE\":\"CureCoin\",\"DASH\":\"DASH\",\"DCR\":\"Decred\",\"DEV\":\"DeviantCoin\",\"DGB\":\"DigiByte\",\"DOGE\":\"Dogecoin\",\"EBST\":\"eBoost\",\"EOS\":\"EOS\",\"ETC\":\"Ether Classic\",\"ETH\":\"Ethereum\",\"ETN\":\"Electroneum\",\"EUNO\":\"EUNO\",\"EXP\":\"EXP\",\"Expanse\":\"Expanse\",\"FLASH\":\"FLASH\",\"GAME\":\"GameCredits\",\"GLC\":\"Goldcoin\",\"GRS\":\"Groestlcoin\",\"KMD\":\"Komodo\",\"LOKI\":\"LOKI\",\"LSK\":\"LSK\",\"MAID\":\"MaidSafeCoin\",\"MUE\":\"MonetaryUnit\",\"NAV\":\"NAV Coin\",\"NEO\":\"NEO\",\"NMC\":\"Namecoin\",\"NVST\":\"NVO Token\",\"NXT\":\"NXT\",\"OMNI\":\"OMNI\",\"PINK\":\"PinkCoin\",\"PIVX\":\"PIVX\",\"POT\":\"PotCoin\",\"PPC\":\"Peercoin\",\"PROC\":\"ProCurrency\",\"PURA\":\"PURA\",\"QTUM\":\"QTUM\",\"RES\":\"Resistance\",\"RVN\":\"Ravencoin\",\"RVR\":\"RevolutionVR\",\"SBD\":\"Steem Dollars\",\"SMART\":\"SmartCash\",\"SOXAX\":\"SOXAX\",\"STEEM\":\"STEEM\",\"STRAT\":\"STRAT\",\"SYS\":\"Syscoin\",\"TPAY\":\"TokenPay\",\"TRIGGERS\":\"Triggers\",\"TRX\":\" TRON\",\"UBQ\":\"Ubiq\",\"UNIT\":\"UniversalCurrency\",\"USDT\":\"Tether USD (Omni Layer)\",\"VTC\":\"Vertcoin\",\"WAVES\":\"Waves\",\"XCP\":\"Counterparty\",\"XEM\":\"NEM\",\"XMR\":\"Monero\",\"XSN\":\"Stakenet\",\"XSR\":\"SucreCoin\",\"XVG\":\"VERGE\",\"XZC\":\"ZCoin\",\"ZEC\":\"ZCash\",\"ZEN\":\"Horizen\"}}', '10.00000000', '99999.00000000', '1.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076328Coinpayments.png', 6, '2020-09-10 09:05:02', '2024-01-12 16:18:48', NULL),
(23, 'Blockchain', 'blockchain', 'BTC', 'BTC', '{\"api_key\":\"a82a8a6a-6411-452f-9741-d4ec46e541e6\",\"xpub_code\":\"xpub6Cq2NpFqoqX5DRsyhebKRH2fCsBUneBpBHXyz5mZAZojesJguZJnBpG6MFGdkio1oTd3GrXoCi9HDFTC5xZoSZN7KZUpn24bPdh5dqyrkYK\"}', NULL, '0.00000000', '{\"1\":{\"BTC\":\"BTC\"}}', '100.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076290blockchain.png', 4, '2020-09-10 09:05:02', '2024-01-12 16:18:10', NULL),
(24, 'Midtrans', 'midtrans', 'IDR', 'IDR', '{\"client_key\":\"***************\",\"server_key\":\"***************\"}', '{\"payment_notification_url\":\"ipn\", \"finish redirect_url\":\"ipn\", \"unfinish redirect_url\":\"failed\",\"error redirect_url\":\"failed\"}', '15116.00000000', '{\"0\":{\"IDR\":\"IDR\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705076270midtrans.png', 1, '2023-02-08 06:17:49', '2024-01-12 16:17:50', NULL),
(25, 'cashmaal', 'cashmaal', 'PKR', 'PKR', '{\"web_id\":\"9596\",\"ipn_key\":\"dzgPkLJCBcYW4Q3be2yOl5ot5ApGnqXIxdw\"}', '{\"ipn_url\":\"ipn\"}', '0.85000000', '{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}', '2.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076301cashmaal.png', 5, '2020-09-10 09:05:02', '2024-01-12 16:18:21', NULL),
(26, 'peachpayments', 'peachpayments', 'USD', 'USD', '{\"Authorization_Bearer\":\"**************\",\"Entity_ID\":\"**************\",\"Recur_Channel\":\"**************\"}', NULL, '1.00000000', '{\"0\":{\"AED\":\"AED\",\"AFA\":\"AFA\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZM\":\"AZM\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYR\":\"BYR\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CYP\":\"CYP\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EEK\":\"EEK\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHC\":\"GHC\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LTL\":\"LTL\",\"LVL\":\"LVL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MTL\":\"MTL\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZM\":\"MZM\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PTS\":\"PTS\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDD\":\"SDD\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SIT\":\"SIT\",\"SKK\":\"SKK\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SPL\":\"SPL\",\"SRD\":\"SRD\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMM\":\"TMM\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRL\":\"TRL\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TVD\":\"TVD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMK\":\"ZMK\",\"ZWD\":\"ZWD\"}}', '100.00000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076199peachpayments.png', 11, '2020-09-10 03:05:02', '2024-01-12 16:16:39', NULL),
(27, 'Nowpayments', 'nowpayments', 'BTC', 'BTC', '{\"api_key\":\"***************\"}', '{\"cron\":\"ipn\"}', '1.00000000', '{\"1\":{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}}', '10.10000000', '10000.00000000', '0.0000', '0.50000000', 1, '', '/files/payment_gateways/1705076153now-payments.png', 7, '2020-09-09 21:05:02', '2024-01-12 16:15:53', NULL),
(28, 'Khalti Payment', 'khalti', 'NPR', 'NPR', '{\"secret_key\":\"***************\",\"public_key\":\"***************\"}', NULL, '132.04000000', '{\"0\":{\"NPR\":\"NPR\"}}', '100.00000000', '10000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705076234Khaltipayment.png', 9, '2020-09-09 21:05:02', '2024-01-12 16:17:14', NULL),
(29, 'MAGUA PAY', 'swagger', 'EUR', 'EUR', '{\"MAGUA_PAY_ACCOUNT\":\"***************\",\"MerchantKey\":\"***************\",\"Secret\":\"***************\"}', NULL, '1.00000000', '{\"0\":{\"EUR\":\"EUR\"}}', '100.00000000', '10000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705076258maguapay.png', 8, '2020-09-09 21:05:02', '2024-01-12 16:17:38', NULL),
(30, 'Free kassa', 'freekassa', 'RUB', 'RUB', '{\"merchant_id\":\"***************\",\"merchant_key\":\"***************\",\"secret_word\":\"***************\",\"secret_word2\":\"***************\"}', '{\"ipn_url\":\"ipn\"}', '1.00000000', '{\"0\":{\"RUB\":\"RUB\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"UAH\":\"UAH\",\"KZT\":\"KZT\"}}', '10.00000000', '10000.00000000', '0.1000', '0.00000000', 1, '', '/files/payment_gateways/1705076210free-kassa.png', 5, '2020-09-09 21:05:02', '2024-01-12 16:16:50', NULL),
(31, 'Konnect', 'konnect', 'USD', 'USD', '{\"api_key\":\"**************\",\"receiver_wallet_Id\":\"**************\"}', '{\"webhook\":\"ipn\"}', '1.00000000', '{\"0\":{\"TND\":\"TND\",\"EUR\":\"EUR\",\"USD\":\"USD\"}}', '1.00000000', '10000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705076249konnect.png', 4, '2020-09-09 21:05:02', '2024-01-12 16:17:29', NULL),
(32, 'Mypay Np', 'mypay', 'NPR', 'NPR', '{\"merchant_username\":\"***************\",\"merchant_api_password\":\"***************\",\"merchant_id\":\"***************\",\"api_key\":\"***************\"}', NULL, '1.00000000', '{\"0\":{\"NPR\":\"NPR\"}}', '1.00000000', '100000.00000000', '1.5000', '0.00000000', 1, '', '/files/payment_gateways/1705076139maguapay.png', 10, '2020-09-09 21:05:02', '2024-01-12 16:15:39', NULL),
(33, 'PayThrow', 'paythrow', 'USD', 'USD', '{\"client_id\":\"\",\"client_secret\":\"\"}', '{\"ipn_url\":\"ipn\"}', '1.00000000', '{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '63e3471f5f6de1675839263.jpg', 1, '2023-02-08 06:17:24', '2023-03-03 08:39:25', NULL),
(34, 'IME PAY', 'imepay', 'NPR', 'NPR', '{\"MerchantModule\":\"***************\",\"MerchantCode\":\"***************\",\"username\":\"***************\",\"password\":\"***************\"}', NULL, '1.00000000', '{\"0\":{\"NPR\":\"NPR\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '/files/payment_gateways/1705076221imepay.png', 1, '2023-02-08 06:17:49', '2024-01-12 16:17:01', NULL),
(35, 'Binance', 'binance', 'USDT', 'USDT', '{\"mercent_api_key\":\"***************\",\"mercent_secret\":\"***************\"}', NULL, '1.00000000', '{\"1\":{\"ADA\":\"ADA\",\"ATOM\":\"ATOM\",\"AVA\":\"AVA\",\"BCH\":\"BCH\",\"BNB\":\"BNB\",\"BTC\":\"BTC\",\"BUSD\":\"BUSD\",\"CTSI\":\"CTSI\",\"DASH\":\"DASH\",\"DOGE\":\"DOGE\",\"DOT\":\"DOT\",\"EGLD\":\"EGLD\",\"EOS\":\"EOS\",\"ETC\":\"ETC\",\"ETH\":\"ETH\",\"FIL\":\"FIL\",\"FRONT\":\"FRONT\",\"FTM\":\"FTM\",\"GRS\":\"GRS\",\"HBAR\":\"HBAR\",\"IOTX\":\"IOTX\",\"LINK\":\"LINK\",\"LTC\":\"LTC\",\"MANA\":\"MANA\",\"MATIC\":\"MATIC\",\"NEO\":\"NEO\",\"OM\":\"OM\",\"ONE\":\"ONE\",\"PAX\":\"PAX\",\"QTUM\":\"QTUM\",\"STRAX\":\"STRAX\",\"SXP\":\"SXP\",\"TRX\":\"TRX\",\"TUSD\":\"TUSD\",\"UNI\":\"UNI\",\"USDC\":\"USDC\",\"USDT\":\"USDT\",\"WRX\":\"WRX\",\"XLM\":\"XLM\",\"XMR\":\"XMR\",\"XRP\":\"XRP\",\"XTZ\":\"XTZ\",\"XVS\":\"XVS\",\"ZEC\":\"ZEC\",\"ZIL\":\"ZIL\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '63e3483776e411675839543.png', 1, '2023-02-08 06:17:49', '2024-01-12 15:53:05', NULL),
(36, 'Cashonex ', 'cashonexHosted', 'USD', 'USD', '{\"idempotency_key\":\"\",\"salt\":\"\"}', NULL, '1.00000000', '{\"0\":{\"USD\":\"USD\"}}', '1.00000000', '1000.00000000', '0.0000', '0.00000000', 1, '', '64017c5d76cff1677818973.jpg', 1, '2023-02-08 06:17:49', '2023-03-03 08:39:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payable_type` varchar(255) NOT NULL,
  `payable_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('deposit','withdraw') NOT NULL,
  `amount` decimal(64,0) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `details` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `uuid` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payable_type`, `payable_id`, `wallet_id`, `type`, `amount`, `confirmed`, `details`, `meta`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 19, 1, 'deposit', '5', 1, NULL, '{\"details\": \"Top Up on Wallet\"}', 'dba5a031-10ee-4121-b822-71da29e315e6', '2024-01-12 08:55:56', '2024-01-12 08:55:56');

-- --------------------------------------------------------

--
-- Table structure for table `transfers`
--

CREATE TABLE `transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_type` varchar(255) NOT NULL,
  `from_id` bigint(20) UNSIGNED NOT NULL,
  `to_type` varchar(255) NOT NULL,
  `to_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('exchange','transfer','paid','refund','gift') NOT NULL DEFAULT 'transfer',
  `status_last` enum('exchange','transfer','paid','refund','gift') DEFAULT NULL,
  `deposit_id` bigint(20) UNSIGNED NOT NULL,
  `withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `discount` decimal(64,0) NOT NULL DEFAULT 0,
  `fee` decimal(64,0) NOT NULL DEFAULT 0,
  `uuid` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `holder_type` varchar(255) NOT NULL,
  `holder_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `uuid` char(36) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `balance` decimal(64,0) NOT NULL DEFAULT 0,
  `decimal_places` smallint(5) UNSIGNED NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `holder_type`, `holder_id`, `name`, `slug`, `uuid`, `description`, `meta`, `balance`, `decimal_places`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 19, 'Default Wallet', 'default', '00d460ab-9313-4e8e-89e7-702bd9705bfe', NULL, '[]', '5', 2, '2024-01-12 08:53:03', '2024-01-12 08:55:56'),
(2, 'App\\Models\\User', 17, 'Default Wallet', 'default', '949353f5-ca80-4e18-bdcf-ee21a0354728', NULL, '[]', '0', 2, '2024-01-12 08:57:14', '2024-01-12 08:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_requests`
--

CREATE TABLE `withdraw_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `account_holder` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `additional_note` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `rejected_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_currencies_code` (`code`);

--
-- Indexes for table `currency_codes`
--
ALTER TABLE `currency_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gateways_code_unique` (`code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactions_uuid_unique` (`uuid`),
  ADD KEY `transactions_payable_type_payable_id_index` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_payable_id_ind` (`payable_type`,`payable_id`),
  ADD KEY `payable_type_ind` (`payable_type`,`payable_id`,`type`),
  ADD KEY `payable_confirmed_ind` (`payable_type`,`payable_id`,`confirmed`),
  ADD KEY `payable_type_confirmed_ind` (`payable_type`,`payable_id`,`type`,`confirmed`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfers_uuid_unique` (`uuid`),
  ADD KEY `transfers_from_type_from_id_index` (`from_type`,`from_id`),
  ADD KEY `transfers_to_type_to_id_index` (`to_type`,`to_id`),
  ADD KEY `transfers_deposit_id_foreign` (`deposit_id`),
  ADD KEY `transfers_withdraw_id_foreign` (`withdraw_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wallets_holder_type_holder_id_slug_unique` (`holder_type`,`holder_id`,`slug`),
  ADD UNIQUE KEY `wallets_uuid_unique` (`uuid`),
  ADD KEY `wallets_holder_type_holder_id_index` (`holder_type`,`holder_id`),
  ADD KEY `wallets_slug_index` (`slug`);

--
-- Indexes for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraw_request_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `currency_codes`
--
ALTER TABLE `currency_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw_requests`
--
ALTER TABLE `withdraw_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_deposit_id_foreign` FOREIGN KEY (`deposit_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transfers_withdraw_id_foreign` FOREIGN KEY (`withdraw_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'enable_wallet_system', 'Enable Wallet System', '1', '0', '0', 'boolean_selection', NULL, '2024-01-11 17:22:19', '2024-01-02 08:30:38');

ALTER TABLE `funds` ADD `type` VARCHAR(255) NULL DEFAULT 'appointment' AFTER `payment_id`, ADD `transaction_id` INT NULL DEFAULT NULL AFTER `type`;
ALTER TABLE `booked_appointments` ADD `fund_id` INT NULL DEFAULT NULL AFTER `is_paid`;
