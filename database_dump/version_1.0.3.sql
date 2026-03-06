-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 21, 2024 at 03:38 PM
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
-- Database: `lawyer_consultation_live_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_services`
--

CREATE TABLE `booked_services` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `law_firm_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date` varchar(155) NOT NULL,
  `price` float DEFAULT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT '0',
  `fund_id` int(11) DEFAULT NULL,
  `question` longtext,
  `attachment_url` varchar(255) DEFAULT NULL,
  `service_status_code` int(11) DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `ended_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `law_firm_id` int(11) DEFAULT NULL,
  `service_category_id` int(11) DEFAULT NULL,
  `name` longtext,
  `description` longtext,
  `slug` longtext,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_approved` tinyint(1) DEFAULT '0',
  `approved_at` timestamp NULL DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `image` longtext,
  `video` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `lawyer_id`, `law_firm_id`, `service_category_id`, `name`, `description`, `slug`, `is_active`, `is_approved`, `approved_at`, `is_featured`, `image`, `video`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 5, '{\"en\":\"Lawfirm Advisor\",\"ar\":null}', '{\"en\":\"<p>Lawfirm AdvisorLawfirm AdvisorLawfirm AdvisorLawfirm AdvisorLawfirm AdvisorLawfirm Advisor<\\/p>\",\"ar\":null}', 'lawfirm-advisor-1', 1, 0, NULL, 0, '/images/services/6643380171792.png', NULL, NULL, '2024-05-14 10:08:01', '2024-05-14 10:19:38', '2024-05-14 10:19:38'),
(2, NULL, NULL, 1, '{\"en\":\"Legal Consultation\",\"hi\":\"\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0930\\u093e\\u092e\\u0930\\u094d\\u0936\",\"ar\":\"\\u0627\\u0644\\u0627\\u0633\\u062a\\u0634\\u0627\\u0631\\u0629 \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0629\"}', '{\"en\":\"<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged<\\/p>\",\"hi\":\"<p>\\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e \\u0915\\u0947\\u0935\\u0932 \\u092e\\u0941\\u0926\\u094d\\u0930\\u0923 \\u0914\\u0930 \\u091f\\u093e\\u0907\\u092a\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917 \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0915\\u093e \\u0928\\u0915\\u0932\\u0940 \\u092a\\u093e\\u0920 \\u0939\\u0948\\u0964 \\u0932\\u094b\\u0930\\u0947\\u092e \\u0907\\u092a\\u094d\\u0938\\u092e 1500 \\u0915\\u0947 \\u0926\\u0936\\u0915 \\u0938\\u0947 \\u0939\\u0940 \\u0909\\u0926\\u094d\\u092f\\u094b\\u0917 \\u0915\\u093e \\u092e\\u093e\\u0928\\u0915 \\u0921\\u092e\\u0940 \\u092a\\u093e\\u0920 \\u0930\\u0939\\u093e \\u0939\\u0948, \\u091c\\u092c \\u090f\\u0915 \\u0905\\u091c\\u094d\\u091e\\u093e\\u0924 \\u092a\\u094d\\u0930\\u093f\\u0902\\u091f\\u0930 \\u0928\\u0947 \\u090f\\u0915 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0917\\u0948\\u0932\\u0940 \\u0932\\u0940 \\u0914\\u0930 \\u0909\\u0938\\u0947 \\u090f\\u0915 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u0940 \\u0928\\u092e\\u0942\\u0928\\u093e \\u092a\\u0941\\u0938\\u094d\\u0924\\u0915 \\u092c\\u0928\\u093e\\u0928\\u0947 \\u0915\\u0947 \\u0932\\u093f\\u090f \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u093f\\u092f\\u093e\\u0964 \\u092f\\u0939 \\u0928 \\u0915\\u0947\\u0935\\u0932 \\u092a\\u093e\\u0901\\u091a \\u0936\\u0924\\u093e\\u092c\\u094d\\u0926\\u093f\\u092f\\u094b\\u0902 \\u0924\\u0915 \\u091c\\u0940\\u0935\\u093f\\u0924 \\u0930\\u0939\\u093e \\u0939\\u0948, \\u092c\\u0932\\u094d\\u0915\\u093f \\u0907\\u0932\\u0947\\u0915\\u094d\\u091f\\u094d\\u0930\\u0949\\u0928\\u093f\\u0915 \\u091f\\u093e\\u0907\\u092a\\u0938\\u0947\\u091f\\u093f\\u0902\\u0917 \\u092e\\u0947\\u0902 \\u092d\\u0940 \\u091b\\u0932\\u093e\\u0902\\u0917 \\u0932\\u0917\\u093e\\u0924\\u093e \\u0930\\u0939\\u093e \\u0939\\u0948, \\u092e\\u0942\\u0932\\u0924\\u0903 \\u0905\\u092a\\u0930\\u093f\\u0935\\u0930\\u094d\\u0924\\u093f\\u0924 \\u0930\\u0939\\u093e \\u0939\\u0948<\\/p>\",\"ar\":\"<p>\\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0628\\u0628\\u0633\\u0627\\u0637\\u0629 \\u0646\\u0635 \\u0648\\u0647\\u0645\\u064a \\u0645\\u0646 \\u0635\\u0646\\u0627\\u0639\\u0629 \\u0627\\u0644\\u0637\\u0628\\u0627\\u0639\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0646\\u0636\\u064a\\u062f. \\u0644\\u0642\\u062f \\u0643\\u0627\\u0646 \\u0644\\u0648\\u0631\\u064a\\u0645 \\u0625\\u064a\\u0628\\u0633\\u0648\\u0645 \\u0647\\u0648 \\u0627\\u0644\\u0646\\u0635 \\u0627\\u0644\\u0648\\u0647\\u0645\\u064a \\u0627\\u0644\\u0642\\u064a\\u0627\\u0633\\u064a \\u0641\\u064a \\u0647\\u0630\\u0647 \\u0627\\u0644\\u0635\\u0646\\u0627\\u0639\\u0629 \\u0645\\u0646\\u0630 \\u0627\\u0644\\u0642\\u0631\\u0646 \\u0627\\u0644\\u0633\\u0627\\u062f\\u0633 \\u0639\\u0634\\u0631\\u060c \\u0639\\u0646\\u062f\\u0645\\u0627 \\u0623\\u062e\\u0630\\u062a \\u0637\\u0627\\u0628\\u0639\\u0629 \\u063a\\u064a\\u0631 \\u0645\\u0639\\u0631\\u0648\\u0641\\u0629 \\u0644\\u0648\\u062d \\u0627\\u0644\\u0643\\u062a\\u0627\\u0628\\u0629 \\u0648\\u062e\\u0644\\u0637\\u062a\\u0647 \\u0644\\u0635\\u0646\\u0639 \\u0646\\u0645\\u0648\\u0630\\u062c \\u0643\\u062a\\u0627\\u0628. \\u0644\\u0642\\u062f \\u0635\\u0645\\u062f\\u062a \\u0644\\u064a\\u0633 \\u0641\\u0642\\u0637 \\u0644\\u062e\\u0645\\u0633\\u0629 \\u0642\\u0631\\u0648\\u0646\\u060c \\u0628\\u0644 \\u0642\\u0641\\u0632\\u062a \\u0623\\u064a\\u0636\\u064b\\u0627 \\u0625\\u0644\\u0649 \\u0627\\u0644\\u062a\\u0646\\u0636\\u064a\\u062f \\u0627\\u0644\\u0625\\u0644\\u0643\\u062a\\u0631\\u0648\\u0646\\u064a\\u060c \\u0648\\u0628\\u0642\\u064a\\u062a \\u062f\\u0648\\u0646 \\u062a\\u063a\\u064a\\u064a\\u0631 \\u0628\\u0634\\u0643\\u0644 \\u0623\\u0633\\u0627\\u0633\\u064a<\\/p>\"}', 'legal-consultation-2', 1, 0, NULL, 0, '/images/services/66433924c6413.png', NULL, NULL, '2024-05-14 10:12:52', '2024-05-15 10:51:04', '2024-05-15 10:51:04'),
(3, NULL, NULL, 1, '{\"en\":\"Lawyer Directories\",\"hi\":\"\\u0935\\u0915\\u0940\\u0932 \\u0928\\u093f\\u0930\\u094d\\u0926\\u0947\\u0936\\u093f\\u0915\\u093e\\u090f\\u0901\",\"ar\":\"\\u0623\\u062f\\u0644\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u064a\\u0646\"}', '{\"en\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<\\/p>\",\"hi\":\"<p>\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964<\\/p>\",\"ar\":\"<p>\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645.<\\/p>\"}', 'lawyer-directories-3', 1, 0, NULL, 0, '/images/services/6643399803341.png', NULL, NULL, '2024-05-14 10:14:48', '2024-05-15 10:51:25', '2024-05-15 10:51:25'),
(4, NULL, NULL, 1, '{\"en\":\"Court Filings\",\"hi\":\"\\u0915\\u094b\\u0930\\u094d\\u091f \\u092b\\u093e\\u0907\\u0932\\u093f\\u0902\\u0917\",\"ar\":\"\\u0645\\u0644\\u0641\\u0627\\u062a \\u0627\\u0644\\u0645\\u062d\\u0643\\u0645\\u0629\"}', '{\"en\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<\\/p>\",\"hi\":\"<p>\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964<\\/p>\",\"ar\":\"<p>\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645.<\\/p>\"}', 'court-filings-4', 1, 0, NULL, 0, '/images/services/66433a22da6f0.png', NULL, NULL, '2024-05-14 10:17:06', '2024-05-15 10:51:22', '2024-05-15 10:51:22'),
(5, NULL, NULL, 1, '{\"en\":\"Paralegal Services\",\"hi\":\"\\u092a\\u0948\\u0930\\u093e\\u0932\\u0940\\u0917\\u0932 \\u0938\\u0947\\u0935\\u093e\\u090f\\u0901\",\"ar\":\"\\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0634\\u0628\\u0647 \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0629\"}', '{\"en\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<\\/p>\",\"hi\":\"<p>\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964<\\/p>\",\"ar\":\"<p>\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645.<\\/p>\"}', 'paralegal-services-5', 1, 0, NULL, 0, '/images/services/66433aae534b6.png', NULL, NULL, '2024-05-14 10:19:26', '2024-05-15 10:51:18', '2024-05-15 10:51:18'),
(6, 1, NULL, 1, '{\"en\":\"Lawyer Directories\",\"hi\":\"\\u0935\\u0915\\u0940\\u0932 \\u0928\\u093f\\u0930\\u094d\\u0926\\u0947\\u0936\\u093f\\u0915\\u093e\\u090f\\u0901\",\"ar\":\"\\u0623\\u062f\\u0644\\u0629 \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u064a\\u0646\"}', '{\"en\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\",\"hi\":\"\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964\",\"ar\":\"\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\"}', 'adl-almhamyn-6', 1, 1, '2024-05-14 13:55:08', 0, '/images/lawyer_services/66436d3c215cf.png', NULL, 100, '2024-05-14 13:55:08', '2024-05-14 13:55:08', NULL),
(7, 1, NULL, 1, '{\"en\":\"Paralegal Services\",\"hi\":\"\\u092a\\u0948\\u0930\\u093e\\u0932\\u0940\\u0917\\u0932 \\u0938\\u0947\\u0935\\u093e\\u090f\\u0901\",\"ar\":\"\\u0627\\u0644\\u062e\\u062f\\u0645\\u0627\\u062a \\u0634\\u0628\\u0647 \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646\\u064a\\u0629\"}', '{\"en\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\",\"hi\":\"\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964\",\"ar\":\"\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\"}', 'paralegal-services-7', 1, 1, '2024-05-14 13:57:44', 0, '/images/lawyer_services/66436e1125653.png', NULL, 200, '2024-05-14 13:57:44', '2024-05-14 13:58:41', NULL),
(8, 1, NULL, 1, '{\"en\":\"Court Filings\",\"hi\":\"\\u0915\\u094b\\u0930\\u094d\\u091f \\u092b\\u093e\\u0907\\u0932\\u093f\\u0902\\u0917\",\"ar\":\"\\u0645\\u0644\\u0641\\u0627\\u062a \\u0627\\u0644\\u0645\\u062d\\u0643\\u0645\\u0629\"}', '{\"en\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\",\"hi\":\"\\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u092c\\u0939\\u0941\\u0924 \\u092e\\u0939\\u0924\\u094d\\u0935\\u092a\\u0942\\u0930\\u094d\\u0923 \\u0939\\u0948, \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0915\\u0947 \\u092a\\u0940\\u091b\\u0947 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915 \\u0939\\u0940 \\u0930\\u0939\\u0947\\u0917\\u093e\\u0964 \\u0932\\u0947\\u0915\\u093f\\u0928 \\u0938\\u093e\\u0925 \\u0939\\u0940 \\u0935\\u0947 \\u092c\\u0921\\u093c\\u0947 \\u092a\\u0930\\u093f\\u0936\\u094d\\u0930\\u092e \\u0914\\u0930 \\u092a\\u0940\\u0921\\u093c\\u093e \\u0915\\u0947 \\u0938\\u093e\\u0925 \\u0918\\u091f\\u093f\\u0924 \\u0939\\u0941\\u090f\\u0964 \\u0938\\u092c\\u0938\\u0947 \\u091b\\u094b\\u091f\\u0940 \\u092c\\u093e\\u0924 \\u0915\\u0947 \\u0932\\u093f\\u090f, \\u0915\\u093f\\u0938\\u0940 \\u0915\\u094b \\u092d\\u0940 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092a\\u094d\\u0930\\u0915\\u093e\\u0930 \\u0915\\u093e \\u0915\\u093e\\u0930\\u094d\\u092f \\u0924\\u092c \\u0924\\u0915 \\u0928\\u0939\\u0940\\u0902 \\u0915\\u0930\\u0928\\u093e \\u091a\\u093e\\u0939\\u093f\\u090f \\u091c\\u092c \\u0924\\u0915 \\u0915\\u093f \\u0909\\u0938\\u0947 \\u0909\\u0938\\u0938\\u0947 \\u0915\\u0941\\u091b \\u0932\\u093e\\u092d \\u0928 \\u0939\\u094b\\u0964 \\u0921\\u093e\\u0902\\u091f \\u092e\\u0947\\u0902 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0928\\u093e\\u0930\\u093e\\u091c \\u0928 \\u0939\\u094b, \\u0916\\u0941\\u0936\\u0940 \\u092e\\u0947\\u0902 \\u0935\\u0939 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u092c\\u093e\\u0932 \\u092c\\u093e\\u0902\\u0915\\u093e \\u0939\\u094b\\u0928\\u093e \\u091a\\u093e\\u0939\\u0924\\u093e \\u0939\\u0948, \\u0909\\u0938\\u0947 \\u0926\\u0930\\u094d\\u0926 \\u0938\\u0947 \\u0926\\u0942\\u0930 \\u092d\\u093e\\u0917\\u0928\\u0947 \\u0926\\u0947\\u0964\",\"ar\":\"\\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0645\\u0647\\u0645 \\u062c\\u062f\\u064b\\u0627\\u060c \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644 \\u0633\\u064a\\u062a\\u0628\\u0639\\u0647 \\u0627\\u0644\\u0639\\u0645\\u064a\\u0644. \\u0648\\u0644\\u0643\\u0646 \\u0641\\u064a \\u0646\\u0641\\u0633 \\u0627\\u0644\\u0648\\u0642\\u062a \\u062d\\u062f\\u062b \\u0630\\u0644\\u0643 \\u0628\\u062c\\u0647\\u062f \\u0648\\u0623\\u0644\\u0645 \\u0643\\u0628\\u064a\\u0631\\u064a\\u0646. \\u0641\\u0628\\u0627\\u0644\\u0646\\u0633\\u0628\\u0629 \\u0644\\u0623\\u062f\\u0642 \\u0627\\u0644\\u062a\\u0641\\u0627\\u0635\\u064a\\u0644\\u060c \\u0644\\u0627 \\u064a\\u062c\\u0648\\u0632 \\u0644\\u0623\\u062d\\u062f \\u0623\\u0646 \\u064a\\u0645\\u0627\\u0631\\u0633 \\u0623\\u064a \\u0639\\u0645\\u0644 \\u0625\\u0644\\u0627 \\u0625\\u0630\\u0627 \\u0627\\u0633\\u062a\\u0641\\u0627\\u062f \\u0645\\u0646\\u0647 \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0634\\u064a\\u0621. \\u0644\\u0627 \\u062a\\u063a\\u0636\\u0628 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645 \\u0641\\u064a \\u0627\\u0644\\u062a\\u0648\\u0628\\u064a\\u062e\\u060c \\u0641\\u0641\\u064a \\u0627\\u0644\\u0644\\u0630\\u0629 \\u064a\\u0631\\u064a\\u062f \\u0623\\u0646 \\u064a\\u0643\\u0648\\u0646 \\u0634\\u0639\\u0631\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0644\\u0645\\u060c \\u0641\\u0644\\u064a\\u0647\\u0631\\u0628 \\u0645\\u0646 \\u0627\\u0644\"}', 'court-filings-8', 1, 1, '2024-05-14 14:00:58', 0, '/images/lawyer_services/66436e9a91132.png', NULL, 300, '2024-05-14 14:00:58', '2024-05-16 11:51:57', NULL),
(9, 15, NULL, 1, '{\"en\":\"test Service\",\"hi\":\"test Service\",\"ar\":\"test Service\"}', '{\"en\":\"test Service test Service test Service test Service\",\"hi\":\"test Service test Service test Service\",\"ar\":\"test Service test Service test Service\"}', 'test-service-9', 1, 1, '2024-05-16 09:47:14', 0, '/images/lawyer_services/6645d6227fbdc.png', NULL, 20, '2024-05-16 09:47:14', '2024-05-17 05:43:07', '2024-05-17 05:43:07'),
(10, NULL, 1, 5, '{\"en\":\"Corporis laudantium\",\"hi\":\"Corporis laudantium\",\"ar\":\"Corporis laudantium\"}', '{\"en\":\"Tempor vero qui ex e\",\"hi\":\"Corporis laudantiumCorporis laudantiumCorporis laudantium\",\"ar\":\"Corporis laudantiumCorporis laudantiumCorporis laudantiumCorporis laudantium\"}', 'corporis-laudantium-10', 1, 1, '2024-05-16 09:49:52', 0, '/images/law_firm_services/6645d6c06ff79.png', NULL, 200, '2024-05-16 09:49:52', '2024-05-16 09:49:52', NULL),
(11, NULL, 1, 1, '{\"en\":\"test Lawfirm\",\"hi\":\"test Lawfirm\",\"ar\":\"test Law\"}', '{\"en\":\"test Lawfirm\",\"hi\":\"test Lawfirmtest Lawfirmtest Lawfirm\",\"ar\":\"test Lawfirmtest Lawfirm\"}', 'test-lawfirm-11', 1, 1, '2024-05-16 09:51:09', 0, '/images/law_firm_services/6645d70d3e645.png', NULL, 20, '2024-05-16 09:51:09', '2024-05-17 05:43:00', '2024-05-17 05:43:00'),
(12, NULL, 1, 5, '{\"en\":\"test Lawfirmtest Lawfirm\",\"hi\":\"test Lawfirm\",\"ar\":\"test Lawfirm\"}', '{\"en\":\"test Lawfirmtest Lawfirmtest Lawfirm\",\"hi\":\"test Lawfirmtest Lawfirm\",\"ar\":\"test Lawfirmtest Lawfirm\"}', 'test-lawfirmtest-lawfirm-12', 1, 1, '2024-05-16 09:53:33', 0, '/images/law_firm_services/6645d79d39490.png', NULL, 78, '2024-05-16 09:53:33', '2024-05-17 05:42:55', '2024-05-17 05:42:55'),
(13, NULL, 1, 1, '{\"en\":\"test AutoApprove\",\"hi\":\"test AutoApprove\",\"ar\":\"test AutoApprove\"}', '{\"en\":\"test AutoApprove\",\"hi\":\"test AutoApprove\",\"ar\":\"test AutoApprove\"}', 'test-autoapprove-13', 1, 0, NULL, 0, '/images/law_firm_services/6645dabe3f33f.png', NULL, 20, '2024-05-16 10:06:54', '2024-05-17 05:42:48', '2024-05-17 05:42:48'),
(14, 15, NULL, 1, '{\"en\":\"test AutoApprove\",\"hi\":\"test AutoApprove\",\"ar\":\"test AutoApprove\"}', '{\"en\":\"test AutoApprove\",\"hi\":\"test AutoApprove\",\"ar\":\"test AutoApprove\"}', 'test-autoapprove-14', 1, 1, '2024-05-16 10:09:14', 0, '/images/lawyer_services/6645db393765c.png', NULL, 20, '2024-05-16 10:08:57', '2024-05-17 05:42:44', '2024-05-17 05:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `id` int(11) NOT NULL,
  `name` longtext NOT NULL,
  `description` longtext,
  `slug` longtext,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`id`, `name`, `description`, `slug`, `is_active`, `sort_order`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"en\":\"Criminal Law\",\"hi\":\"\\u092b\\u094c\\u091c\\u0926\\u093e\\u0930\\u0940 \\u0915\\u093e\\u0928\\u0942\\u0928\",\"ar\":\"\\u0642\\u0627\\u0646\\u0648\\u0646 \\u062c\\u0646\\u0627\\u0626\\u064a\"}', '{\"en\":\"<p>Criminal Law, often referred to simply as criminal law, encompasses the legal principles governing the activities of administrative agencies of government. It involves the procedures, rules, and regulations that these agencies create and enforce to ensure compliance with laws enacted by<\\/p>\",\"hi\":\"<ul>\\r\\n\\t<li>\\u0915\\u0941\\u0916\\u094d\\u092f\\u093e\\u0924\\u093f \\u0915\\u093e\\u0928\\u0942\\u0928 \\u0915\\u093e \\u092a\\u0930\\u093f\\u091a\\u092f<\\/li>\\r\\n\\t<li>\\u0915\\u0941\\u0916\\u094d\\u092f\\u093e\\u0924\\u093f \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e<\\/li>\\r\\n\\t<li>\\u0938\\u092b\\u0947\\u0926 \\u0915\\u0949\\u0932\\u0930 \\u0905\\u092a\\u0930\\u093e\\u0927<\\/li>\\r\\n\\t<li>\\u0938\\u093e\\u0907\\u092c\\u0930 \\u0905\\u092a\\u0930\\u093e\\u0927 \\u0914\\u0930 \\u0915\\u0902\\u092a\\u094d\\u092f\\u0942\\u091f\\u0930 \\u0915\\u093e\\u0928\\u0942\\u0928<\\/li>\\r\\n<\\/ul>\",\"ar\":\"<ul>\\r\\n\\t<li>\\u0645\\u0642\\u062f\\u0645\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062c\\u0646\\u0627\\u0626\\u064a<\\/li>\\r\\n\\t<li>\\u0625\\u062c\\u0631\\u0627\\u0621\\u0627\\u062a \\u0627\\u0644\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062c\\u0646\\u0627\\u0626\\u064a<\\/li>\\r\\n\\t<li>\\u0627\\u0644\\u062c\\u0631\\u064a\\u0645\\u0629 \\u0630\\u0627\\u062a \\u0627\\u0644\\u064a\\u0627\\u0642\\u0648\\u062a \\u0627\\u0644\\u0623\\u0628\\u064a\\u0636<\\/li>\\r\\n\\t<li>\\u062c\\u0631\\u064a\\u0645\\u0629 \\u0627\\u0644\\u0625\\u0646\\u062a\\u0631\\u0646\\u062a \\u0648\\u0642\\u0627\\u0646\\u0648\\u0646 \\u0627\\u0644\\u062d\\u0627\\u0633\\u0648\\u0628<\\/li>\\r\\n<\\/ul>\"}', 'criminal-law-1', 1, NULL, '/images/service_categories/664745efe249d.png', '2023-10-04 09:09:03', '2024-05-17 11:56:31', NULL),
(2, '{\"en\":\"asdas\",\"hi\":\"sdas\",\"ar\":\"asd\"}', '{\"en\":\"dasdas\",\"hi\":\"dasdas\",\"ar\":\"asdasd\"}', 'asdas-2', 1, NULL, '/images/archive_categories/6543a98e6fd69.png', '2023-11-02 13:52:14', '2023-11-02 13:52:24', '2023-11-02 13:52:24'),
(3, '{\"en\":\"Religious Freedom and Expression\",\"hi\":\"\\u0936\\u093f\\u0915\\u094d\\u0937\\u093e \\u0915\\u093e\\u0928\\u0942\\u0928\",\"ar\":\"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631\"}', '{\"en\":\"asdasd\",\"hi\":\"asdasd\",\"ar\":\"asdasdasdad\"}', 'religious-freedom-and-expression-3', 1, NULL, '/images/archive_categories/6543a9b29612d.png', '2023-11-02 13:52:50', '2023-11-02 13:52:59', '2023-11-02 13:52:59'),
(4, '{\"en\":\"Religious Freedom and Expression\",\"hi\":\"\\u0927\\u093e\\u0930\\u094d\\u092e\\u093f\\u0915 \\u0938\\u094d\\u0935\\u0924\\u0902\\u0924\\u094d\\u0930\\u0924\\u093e \\u0914\\u0930 \\u0905\\u092d\\u093f\\u0935\\u094d\\u092f\\u0915\\u094d\\u0924\\u093f\",\"ar\":\"\\u0627\\u0644\\u062d\\u0631\\u064a\\u0629 \\u0627\\u0644\\u062f\\u064a\\u0646\\u064a\\u0629 \\u0648\\u0627\\u0644\\u062a\\u0639\\u0628\\u064a\\u0631\"}', '{\"en\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\",\"hi\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\",\"ar\":\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.\"}', 'religious-freedom-and-expression-4', 1, NULL, '/images/archive_categories/6544c627836f7.png', '2023-11-03 10:06:31', '2023-11-03 10:07:25', '2023-11-03 10:07:25'),
(5, '{\"en\":\"Regulation Law\",\"hi\":\"Walter Robbins\",\"ar\":\"Christen Kline\"}', '{\"en\":\"<p>Regulation law, often referred to simply as regulatory law, encompasses the legal principles governing the activities of administrative agencies of government. It involves the procedures, rules, and regulations that these agencies create and enforce to ensure compliance with laws enacted by<\\/p>\",\"hi\":\"<p>sdfdsfd<\\/p>\",\"ar\":\"<p>sdfdsfdf<\\/p>\"}', 'regulation-law-5', 1, NULL, '/images/service_categories/6647455797cc4.png', '2024-05-14 09:33:20', '2024-05-17 11:53:59', NULL),
(6, '{\"en\":\"Trademark Registration\",\"hi\":\"\\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923\",\"ar\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\"}', '{\"en\":\"<p>Legal professionals help clients secure trademarks to protect their brand names, logos, and other identifying marks. This involves conducting trademark searches, preparing and filing trademark applications, and responding to any issues that arise during the registration process.<\\/p>\",\"hi\":\"<p>\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0947\\u0936\\u0947\\u0935\\u0930 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915\\u094b\\u0902 \\u0915\\u094b \\u0909\\u0928\\u0915\\u0947 \\u092c\\u094d\\u0930\\u093e\\u0902\\u0921 \\u0928\\u093e\\u092e, \\u0932\\u094b\\u0917\\u094b \\u0914\\u0930 \\u0905\\u0928\\u094d\\u092f \\u092a\\u0939\\u091a\\u093e\\u0928\\u0928\\u0947 \\u092f\\u094b\\u0917\\u094d\\u092f \\u091a\\u093f\\u0939\\u094d\\u0928\\u094b\\u0902 \\u0915\\u0940 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0932\\u093f\\u090f \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u094d\\u0930\\u093e\\u092a\\u094d\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0939\\u093e\\u092f\\u0924\\u093e \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0907\\u0938\\u092e\\u0947\\u0902 \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0916\\u094b\\u091c \\u0915\\u0930\\u0928\\u093e, \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0906\\u0935\\u0947\\u0926\\u0928 \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0928\\u093e \\u0914\\u0930 \\u0926\\u093e\\u0916\\u093f\\u0932 \\u0915\\u0930\\u0928\\u093e, \\u0914\\u0930 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923 \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928 \\u0909\\u0924\\u094d\\u092a\\u0928\\u094d\\u0928 \\u0939\\u094b\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092e\\u0941\\u0926\\u094d\\u0926\\u0947 \\u0915\\u093e \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u0915\\u0930\\u0928\\u093e \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u0948\\u0964<\\/p>\",\"ar\":\"<p>\\u064a\\u0633\\u0627\\u0639\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0641\\u064a \\u062a\\u0623\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0623\\u0633\\u0645\\u0627\\u0621 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\\u0647\\u0645 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629. \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0630\\u0644\\u0643 \\u0625\\u062c\\u0631\\u0627\\u0621 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0625\\u0639\\u062f\\u0627\\u062f \\u0648\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0623\\u064a \\u0645\\u0633\\u0627\\u0626\\u0644 \\u0642\\u062f \\u062a\\u0646\\u0634\\u0623 \\u062e\\u0644\\u0627\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644.<\\/p>\"}', 'trademark-registration-6', 0, NULL, '/images/service_categories/6647472f78016.png', '2024-05-17 12:01:51', '2024-05-17 12:04:39', '2024-05-17 12:04:39'),
(7, '{\"en\":\"Trademark Register\",\"hi\":\"\\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923\",\"ar\":\"\\u062a\\u0633\\u062c\\u064a\\u0644 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\"}', '{\"en\":\"<p>Legal professionals help clients secure trademarks to protect their brand names, logos, and other identifying marks. This involves conducting trademark searches, preparing and filing trademark applications, and responding to any issues that arise during the registration process.<\\/p>\",\"hi\":\"<p>\\u0915\\u093e\\u0928\\u0942\\u0928\\u0940 \\u092a\\u0947\\u0936\\u0947\\u0935\\u0930 \\u0917\\u094d\\u0930\\u093e\\u0939\\u0915\\u094b\\u0902 \\u0915\\u094b \\u0909\\u0928\\u0915\\u0947 \\u092c\\u094d\\u0930\\u093e\\u0902\\u0921 \\u0928\\u093e\\u092e, \\u0932\\u094b\\u0917\\u094b \\u0914\\u0930 \\u0905\\u0928\\u094d\\u092f \\u092a\\u0939\\u091a\\u093e\\u0928\\u0928\\u0947 \\u092f\\u094b\\u0917\\u094d\\u092f \\u091a\\u093f\\u0939\\u094d\\u0928\\u094b\\u0902 \\u0915\\u0940 \\u0938\\u0941\\u0930\\u0915\\u094d\\u0937\\u093e \\u0915\\u0947 \\u0932\\u093f\\u090f \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u092a\\u094d\\u0930\\u093e\\u092a\\u094d\\u0924 \\u0915\\u0930\\u0928\\u0947 \\u092e\\u0947\\u0902 \\u0938\\u0939\\u093e\\u092f\\u0924\\u093e \\u0915\\u0930\\u0924\\u0947 \\u0939\\u0948\\u0902\\u0964 \\u0907\\u0938\\u092e\\u0947\\u0902 \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0916\\u094b\\u091c \\u0915\\u0930\\u0928\\u093e, \\u091f\\u094d\\u0930\\u0947\\u0921\\u092e\\u093e\\u0930\\u094d\\u0915 \\u0906\\u0935\\u0947\\u0926\\u0928 \\u0924\\u0948\\u092f\\u093e\\u0930 \\u0915\\u0930\\u0928\\u093e \\u0914\\u0930 \\u0926\\u093e\\u0916\\u093f\\u0932 \\u0915\\u0930\\u0928\\u093e, \\u0914\\u0930 \\u092a\\u0902\\u091c\\u0940\\u0915\\u0930\\u0923 \\u092a\\u094d\\u0930\\u0915\\u094d\\u0930\\u093f\\u092f\\u093e \\u0915\\u0947 \\u0926\\u094c\\u0930\\u093e\\u0928 \\u0909\\u0924\\u094d\\u092a\\u0928\\u094d\\u0928 \\u0939\\u094b\\u0928\\u0947 \\u0935\\u093e\\u0932\\u0947 \\u0915\\u093f\\u0938\\u0940 \\u092d\\u0940 \\u092e\\u0941\\u0926\\u094d\\u0926\\u0947 \\u0915\\u093e \\u0938\\u092e\\u093e\\u0927\\u093e\\u0928 \\u0915\\u0930\\u0928\\u093e \\u0936\\u093e\\u092e\\u093f\\u0932 \\u0939\\u0948\\u0964<\\/p>\",\"ar\":\"<p>\\u064a\\u0633\\u0627\\u0639\\u062f \\u0627\\u0644\\u0645\\u062d\\u0627\\u0645\\u0648\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0645\\u0644\\u0627\\u0621 \\u0641\\u064a \\u062a\\u0623\\u0645\\u064a\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0644\\u062d\\u0645\\u0627\\u064a\\u0629 \\u0623\\u0633\\u0645\\u0627\\u0621 \\u0639\\u0644\\u0627\\u0645\\u0627\\u062a\\u0647\\u0645 \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0634\\u0639\\u0627\\u0631\\u0627\\u062a \\u0648\\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u0623\\u062e\\u0631\\u0649 \\u0627\\u0644\\u0645\\u0645\\u064a\\u0632\\u0629. \\u064a\\u062a\\u0636\\u0645\\u0646 \\u0630\\u0644\\u0643 \\u0625\\u062c\\u0631\\u0627\\u0621 \\u0639\\u0645\\u0644\\u064a\\u0627\\u062a \\u0627\\u0644\\u0628\\u062d\\u062b \\u0639\\u0646 \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0625\\u0639\\u062f\\u0627\\u062f \\u0648\\u062a\\u0642\\u062f\\u064a\\u0645 \\u0637\\u0644\\u0628\\u0627\\u062a \\u0627\\u0644\\u0639\\u0644\\u0627\\u0645\\u0627\\u062a \\u0627\\u0644\\u062a\\u062c\\u0627\\u0631\\u064a\\u0629\\u060c \\u0648\\u0627\\u0644\\u0631\\u062f \\u0639\\u0644\\u0649 \\u0623\\u064a \\u0645\\u0633\\u0627\\u0626\\u0644 \\u0642\\u062f \\u062a\\u0646\\u0634\\u0623 \\u062e\\u0644\\u0627\\u0644 \\u0639\\u0645\\u0644\\u064a\\u0629 \\u0627\\u0644\\u062a\\u0633\\u062c\\u064a\\u0644.<\\/p>\"}', 'trademark-register-7', 1, NULL, '/images/service_categories/6647472fac8ea.png', '2024-05-17 12:01:51', '2024-05-17 12:04:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_faqs`
--

CREATE TABLE `service_faqs` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `question` mediumtext,
  `answer` mediumtext,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_faqs`
--

INSERT INTO `service_faqs` (`id`, `service_id`, `question`, `answer`, `is_active`, `sort_order`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, '{\"en\":\"What is a lawyer directory?\"}', '{\"en\":\"A lawyer directory is an online or printed resource that lists lawyers, law firms, and legal professionals. These directories typically include contact information, areas of practice, credentials, and sometimes client reviews and ratings.\"}', 1, NULL, NULL, '2024-05-14 13:55:08', '2024-05-14 13:55:08', NULL),
(2, 7, '{\"en\":\"What are paralegal services?\"}', '{\"en\":\"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks.\"}', 1, NULL, NULL, '2024-05-14 13:57:44', '2024-05-14 13:58:41', '2024-05-14 13:58:41'),
(3, 7, '{\"en\":\"What are paralegal services?\"}', '{\"en\":\"Paralegal services are professional legal assistance provided by trained individuals known as paralegals. They support lawyers by conducting legal research, drafting documents, organizing files, and managing cases, among other tasks.\"}', 1, NULL, NULL, '2024-05-14 13:58:41', '2024-05-14 13:58:41', NULL),
(4, 8, '{\"en\":\"What are court filings?\"}', '{\"en\":\"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process.\"}', 1, NULL, NULL, '2024-05-14 14:00:58', '2024-05-16 11:51:57', '2024-05-16 11:51:57'),
(5, 8, '{\"en\":\"What are court filings?\"}', '{\"en\":\"Court filings are legal documents submitted to the court in connection with a case. These documents include complaints, motions, briefs, and other papers necessary for the legal process.\"}', 1, NULL, NULL, '2024-05-16 11:51:57', '2024-05-16 11:51:57', NULL),
(6, 8, '{\"en\":\"Do I have to pay a fee to file documents with the court?\"}', '{\"en\":\"Yes, in many jurisdictions, filing documents with the court requires payment of a filing fee. The amount depends on the type of document and the court\'s fee schedule. Some parties may qualify for fee waivers based on financial hardship.\"}', 1, NULL, NULL, '2024-05-16 11:51:57', '2024-05-16 11:51:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_reviews`
--

CREATE TABLE `service_reviews` (
  `id` int(11) NOT NULL,
  `booked_service_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `lawyer_id` int(11) DEFAULT NULL,
  `law_firm_id` int(11) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `experience` float DEFAULT '0',
  `communication` float DEFAULT '0',
  `service` float DEFAULT '0',
  `comment` text,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_approved` tinyint(1) DEFAULT '0',
  `is_featured` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_statuses`
--

CREATE TABLE `service_statuses` (
  `id` int(11) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status_code` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_statuses`
--

INSERT INTO `service_statuses` (`id`, `display_name`, `description`, `status_code`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pending', 'Pending', 1, 1, '2023-05-29 16:22:47', '2023-05-29 16:22:47', NULL),
(2, 'Accepted', 'Accepted', 2, 1, '2023-05-29 16:24:39', '2023-05-29 16:24:39', NULL),
(3, 'Rejected', 'Rejected', 3, 1, '2023-05-29 16:24:56', '2023-05-29 16:24:56', NULL),
(4, 'Cancelled', 'Cancelled', 4, 1, '2023-05-29 16:25:18', '2023-05-29 16:25:18', NULL),
(5, 'Completed', 'Completed', 5, 1, '2023-06-03 13:04:25', '2023-06-03 13:04:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_tag`
--

CREATE TABLE `service_tag` (
  `id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_tag`
--

INSERT INTO `service_tag` (`id`, `service_id`, `tag_id`) VALUES
(1, 1, 3),
(2, 2, 1),
(3, 3, 4),
(4, 4, 1),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 5),
(9, 9, 1),
(10, 9, 4),
(11, 10, 3),
(12, 10, 5),
(13, 11, 4),
(14, 11, 5),
(15, 12, 1),
(16, 12, 5),
(17, 13, 1),
(18, 13, 4),
(19, 13, 3),
(20, 14, 1),
(21, 14, 5),
(22, 14, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_services`
--
ALTER TABLE `booked_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_faqs`
--
ALTER TABLE `service_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_reviews`
--
ALTER TABLE `service_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_statuses`
--
ALTER TABLE `service_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_tag`
--
ALTER TABLE `service_tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_services`
--
ALTER TABLE `booked_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_faqs`
--
ALTER TABLE `service_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_reviews`
--
ALTER TABLE `service_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_statuses`
--
ALTER TABLE `service_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service_tag`
--
ALTER TABLE `service_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 21, 2024 at 03:40 PM
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
-- Database: `lawyer_consultation_live_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `in_app_notifications`
--

CREATE TABLE `in_app_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `redirect_url` text,
  `is_seen` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `in_app_notifications`
--

INSERT INTO `in_app_notifications` (`id`, `user_id`, `name`, `description`, `redirect_url`, `is_seen`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 44, 'approve_or_reject_lawyer', 'approve_or_reject_lawyer', NULL, 1, '2024-05-02 06:33:56', '2024-05-07 06:13:19', NULL),
(2, 1, 'Lawyer Approved Successfully', 'You have a new notification', 'super_admin/lawyers', 0, '2024-05-02 07:05:47', '2024-05-02 07:05:47', NULL),
(3, 1, 'Lawyer Approved Successfully', 'You have a new notification', 'super_admin/lawyers', 0, '2024-05-02 07:06:03', '2024-05-02 07:06:03', NULL),
(4, 47, 'Appointment Booked Successfully', 'You have a new notification', '/appointment_log/detail/256', 0, '2024-05-02 08:00:37', '2024-05-02 08:00:37', NULL),
(5, 17, 'Appointment Booked Successfully', 'You have a new notification', '/appointment_log/detail/256', 0, '2024-05-02 08:00:37', '2024-05-02 08:00:37', NULL),
(6, 47, 'Lawyer Approved Successfully', 'You have a new notification', 'super_admin/lawyers', 0, '2024-05-06 01:16:06', '2024-05-06 01:16:06', NULL),
(7, 17, 'Appointment Booked Successfully', 'You have a new notification', '/appointment_log/detail/261', 0, '2024-05-06 01:21:50', '2024-05-06 01:21:50', NULL),
(8, 17, 'Appointment Booked Successfully', 'You have a new notification', '/appointment_log/detail/261', 0, '2024-05-06 01:21:50', '2024-05-06 01:21:50', NULL),
(9, 58, 'Lawyer Approved Successfully', 'You have a new notification', 'super_admin/lawyers', 0, '2024-05-06 01:28:15', '2024-05-06 01:28:15', NULL),
(10, 48, 'Lawyer Approved Successfully', 'You have a new notification', 'super_admin/lawyers', 0, '2024-05-17 05:33:07', '2024-05-17 05:33:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `setting_name` varchar(255) DEFAULT NULL,
  `is_email_send` tinyint(1) DEFAULT '0',
  `is_push_notification_send` tinyint(1) DEFAULT NULL,
  `is_in_app_notification_send` tinyint(4) NOT NULL DEFAULT '0',
  `notification_category` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `display_name`, `setting_name`, `is_email_send`, `is_push_notification_send`, `is_in_app_notification_send`, `notification_category`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'New SignUp Customer', 'new-signup-customer', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(2, 'New SignUp Law', 'new-signup-law', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(3, 'New SignUp LawFirm', 'new-signup-law-firm', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(4, 'Change Password', 'change_password', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(5, 'Reset Password', 'reset_password', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(6, 'Approve/Reject Lawyer', 'approve_or_reject_lawyer', 1, 0, 1, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 11:30:30', NULL),
(7, 'Approve/Reject LawFirm', 'approve_or_reject_law_firm', 0, 0, 0, 'Register', 1, '2024-04-29 09:03:30', '2024-05-02 11:30:16', NULL),
(8, 'New Appointment Registration', 'new_appointment_registration', 1, 0, 1, 'Appointment', 1, '2024-04-29 09:03:30', '2024-05-02 13:00:13', NULL),
(9, 'Change Appointment Status', 'change_appointment_status', 1, 0, 1, 'Appointment', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(10, 'Before One Hour Appointment Notification', 'before_hour_appointment_notification', 1, 0, 0, 'Appointment', 1, '2024-04-29 09:03:30', '2024-05-02 05:59:39', NULL),
(11, 'Quick Service Registered', 'book_quick_service', 0, 0, 0, 'Quick Services', 1, '2024-04-29 14:03:30', '2024-05-02 10:59:39', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `in_app_notifications`
--
ALTER TABLE `in_app_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `in_app_notifications`
--
ALTER TABLE `in_app_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 21, 2024 at 03:40 PM
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
-- Database: `lawyer_consultation_live_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `account_number` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `iban_number` varchar(255) DEFAULT NULL,
  `bic_swift` varchar(255) DEFAULT NULL,
  `sort_code` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `description`, `account_number`, `account_holder_name`, `iban_number`, `bic_swift`, `sort_code`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Habib Bank Limited', 'Habib Bank Limited', '0321654987123654789', 'Joe Doe', 'abcd1235458798751dsad', 'bicswift15451435', '1', 1, NULL, NULL, NULL),
(2, 'Al Habib', NULL, '12132154548474564', 'Rhea Baxter updated', 'ABC123654789', 'adsdasd', NULL, 1, '2024-05-10 08:44:02', '2024-05-11 00:03:54', '2024-05-11 00:03:54'),
(3, 'Meezan Bank', '<p>asdaqdasdasdasd</p>', '78965412332145', 'Mr.Haseeb', '594651654976516njgdasd', 'dadasd', NULL, 1, '2024-05-11 00:06:30', '2024-05-11 00:06:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fund_bank_transfers`
--

CREATE TABLE `fund_bank_transfers` (
  `id` int(11) NOT NULL,
  `bank_account_id` int(11) DEFAULT NULL,
  `fund_id` int(11) DEFAULT NULL,
  `date` varchar(155) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fund_bank_transfers`
--

INSERT INTO `fund_bank_transfers` (`id`, `bank_account_id`, `fund_id`, `date`, `attachment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, '2024-05-11 04:56:59', '2024-05-11 04:56:59', NULL),
(2, 1, 237, NULL, NULL, '2024-05-11 05:05:20', '2024-05-11 05:05:20', NULL),
(3, 3, 237, NULL, NULL, '2024-05-11 05:06:09', '2024-05-11 05:06:09', NULL),
(4, 3, 237, NULL, '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpfTqexs', '2024-05-11 05:09:24', '2024-05-11 05:09:24', NULL),
(5, 3, 237, '2024-05-11 10:10:38', '/private/var/folders/ck/2t30ht_s2374bknm0d14v3vr0000gn/T/phpUjhqfa', '2024-05-11 05:10:38', '2024-05-11 05:10:38', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fund_bank_transfers`
--
ALTER TABLE `fund_bank_transfers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fund_bank_transfers`
--
ALTER TABLE `fund_bank_transfers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


ALTER TABLE `messages` ADD `booked_service_id` INT NULL DEFAULT NULL AFTER `appointment_id`;
INSERT INTO `pricing_plan_modules` (`id`, `display_name`, `module_code`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES (NULL, 'Lawyer Services', 'lawyer-services', 'lawyer', '9', '2023-02-18 21:32:21', '2023-02-13 20:11:58');
INSERT INTO `pricing_plan_modules` (`id`, `display_name`, `module_code`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES (NULL, 'LawFirm Services', 'law_firm-services', 'law_firm', '9', '2023-02-18 21:32:21', '2023-02-13 20:11:58');
INSERT INTO `role_permissions` (`id`, `display_name`, `permission_code`, `display_group`, `created_at`, `updated_at`) VALUES (NULL, 'Delete Bank Account', 'bank_accounts.delete', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Show Bank Account', 'bank_accounts.show', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Edit Bank Account', 'bank_accounts.edit', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Add Bank Account', 'bank_accounts.add', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Bank Accounts Index', 'bank_accounts.index', 'Bank Account', '2024-02-22 18:47:17', NULL);
INSERT INTO `role_permissions` (`id`, `display_name`, `permission_code`, `display_group`, `created_at`, `updated_at`) VALUES (NULL, 'Export Bank Account', 'bank_accounts.export', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Import Bank Account', 'bank_accounts.import', 'Bank Account', '2024-02-22 18:47:17', NULL);
INSERT INTO `role_permissions` (`id`, `display_name`, `permission_code`, `display_group`, `created_at`, `updated_at`) VALUES (NULL, 'Bank Transactions Index', 'bank_transactions.index', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Add Bank Transaction', 'bank_transactions.add', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Edit Bank Transactions', 'bank_transactions.edit', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Show Bank Transactions', 'bank_transactions.show', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Delete BankTransaction', 'bank_transactions.delete', 'Bank Account', '2024-02-22 18:47:17', NULL), (NULL, 'Export Bank Transactions', 'bank_transactions.export', 'Bank Account', '2024-05-14 17:26:07', NULL), (NULL, 'Import Bank Transaction', 'bank_transactions.import', 'Bank Account', '2024-05-14 17:26:07', NULL);

INSERT INTO `gateways` (`id`, `name`, `code`, `currency`, `symbol`, `parameters`, `extra_parameters`, `convention_rate`, `currencies`, `min_amount`, `max_amount`, `percentage_charge`, `fixed_charge`, `status`, `note`, `image`, `sort_by`, `created_at`, `updated_at`, `deleted_at`) VALUES ('37', 'Bank Transfer', 'banktransfer', 'USD', 'USD', '{}', NULL, '1.00000000', '{\"0\":{\"NGN\":\"NGN\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"GBP\":\"GBP\",\"ZAR\":\"ZAR\",\"JPY\":\"JPY\",\"INR\":\"INR\",\"AUD\":\"AUD\",\"CAD\":\"CAD\",\"NZD\":\"NZD\",\"NOK\":\"NOK\",\"PLN\":\"PLN\"}}\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '1', '', '/files/payment_gateways/1715846548bank-transfer.png', '22', '2020-09-10 14:05:02', '2024-05-16 08:02:28', NULL);
INSERT INTO `role_permissions` (`id`, `display_name`, `permission_code`, `display_group`, `created_at`, `updated_at`) VALUES (NULL, 'Notification Setting Index', 'notification_setting.index', 'Setting', '2024-02-22 18:47:17', NULL);
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'application_current_version', 'Application Current Version', '1.0.2', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45');
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'mail_driver', 'Mail Driver', 'smtp', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45'), (NULL, 'mail_host', 'Mail Host', 'sandbox.smtp.mailtrap.io', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45'), (NULL, 'mail_port', 'Mail Port', '587', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45'),  (NULL, 'mail_username', 'Mail Username', '5e61912602edf9', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45'), (NULL, 'mail_password', 'Mail Password', '275f0deee12cf5', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45'), (NULL, 'mail_encryption', 'Mail Encryption', 'null', '0', '0', 'text', NULL, '2024-05-14 16:59:45', '2024-05-14 11:59:45');
INSERT INTO `notification_settings` (`id`, `display_name`, `setting_name`, `is_email_send`, `is_push_notification_send`, `is_in_app_notification_send`, `notification_category`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES (NULL, 'Quick Service Registered', 'book_quick_service', '0', '0', '0', 'Quick Services', '1', '2024-04-29 14:03:30', '2024-05-02 10:59:39', NULL);
UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 66; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 67; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 68; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 69; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 70; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 71;
UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 62; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 63; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 64; UPDATE `general_settings` SET `is_specific` = '1', `page` = 'configurations' WHERE `general_settings`.`id` = 65;
UPDATE `general_settings` SET `is_specific` = '1' WHERE `general_settings`.`id` = 61;
ALTER TABLE `funds` ADD `deleted_at` TIMESTAMP NULL DEFAULT NULL AFTER `updated_at`;
