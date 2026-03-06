-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 06, 2024 at 11:05 AM
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
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_type_id` bigint(20) NOT NULL,
  `rate` float NOT NULL,
  `commission_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `appointment_type_id`, `rate`, `commission_type`, `created_at`, `updated_at`) VALUES
(13, 1, 20, 'percentage', '2024-02-22 07:44:31', '2024-02-22 07:44:31'),
(14, 2, 20, 'fixed_rate', '2024-02-22 07:44:31', '2024-02-22 07:44:31'),
(15, 3, 20, 'fixed_rate', '2024-02-22 07:44:31', '2024-02-22 07:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `permission_code` varchar(199) NOT NULL,
  `display_group` varchar(2555) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `display_name`, `permission_code`, `display_group`, `created_at`, `updated_at`) VALUES
(1, 'Lawyer Index', 'lawyer.index', 'Lawyer', '2024-02-22 11:47:43', NULL),
(2, 'Add Lawyer', 'lawyer.add', 'Lawyer', '2024-02-22 11:47:43', NULL),
(3, 'Edit Lawyer', 'lawyer.edit', 'Lawyer', '2024-02-22 11:47:43', NULL),
(4, 'Delete Lawyer', 'lawyer.delete', 'Lawyer', '2024-02-22 11:47:43', NULL),
(5, 'Show Lawyer', 'lawyer.show', 'Lawyer', '2024-02-22 11:47:43', NULL),
(6, 'Approve Lawyer', 'lawyer.approve', 'Lawyer', '2024-02-22 11:47:43', NULL),
(7, 'Import Lawyer', 'lawyer.import', 'Lawyer', '2024-02-22 11:47:43', NULL),
(8, 'Export Lawyer', 'lawyer.export', 'Lawyer', '2024-02-22 11:47:43', NULL),
(9, 'Add Lawyer Education', 'lawyer.add_education', 'Lawyer', '2024-02-22 11:47:43', NULL),
(10, 'Add Lawyer Certification', 'lawyer.add_certification', 'Lawyer', '2024-02-22 11:47:43', NULL),
(11, 'Add Lawyer Experience', 'lawyer.add_experience', 'Lawyer', '2024-02-22 11:47:43', NULL),
(12, 'Add Lawyer Blog', 'lawyer.add_blog', 'Lawyer', '2024-02-22 11:47:43', NULL),
(13, 'Add Lawyer Event', 'lawyer.add_event', 'Lawyer', '2024-02-22 11:47:43', NULL),
(14, 'Add Lawyer Archive', 'lawyer.add_archive', 'Lawyer', '2024-02-22 11:47:43', NULL),
(15, 'Add Lawyer Podcast', 'lawyer.add_podcast', 'Lawyer', '2024-02-22 11:47:43', NULL),
(16, 'Add Lawyer Media', 'lawyer.add_media', 'Lawyer', '2024-02-22 11:47:43', NULL),
(17, 'Lawyer Main Category Index', 'lawyer_main_category.index', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(18, 'Add Lawyer Main Category', 'lawyer_main_category.add', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(19, 'Edit Lawyer Main Category', 'lawyer_main_category.edit', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(20, 'Delete Lawyer Main Category', 'lawyer_main_category.delete', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(21, 'Show Lawyer Main Category', 'lawyer_main_category.show', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(22, 'Import Lawyer Main Category', 'lawyer_main_category.import', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(23, 'Export Lawyer Main Category', 'lawyer_main_category.export', 'Lawyer Main Categories', '2024-02-22 11:54:49', NULL),
(24, 'Lawyer Category Index', 'lawyer_category.index', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(25, 'Add Lawyer Category', 'lawyer_category.add', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(26, 'Edit Lawyer Category', 'lawyer_category.edit', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(27, 'Delete Lawyer Category', 'lawyer_category.delete', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(28, 'Show Lawyer Category', 'lawyer_category.show', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(29, 'Import Lawyer Category', 'lawyer_category.import', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(30, 'Export Lawyer Category', 'lawyer_category.export', 'Lawyer Categories', '2024-02-22 11:57:11', NULL),
(31, 'Law Firm Index', 'law_firm.index', 'Law Firm', '2024-02-22 11:59:18', NULL),
(32, 'Add Law Firm', 'law_firm.add', 'Law Firm', '2024-02-22 11:59:18', NULL),
(33, 'Edit Law Firm', 'law_firm.edit', 'Law Firm', '2024-02-22 11:59:18', NULL),
(34, 'Delete Law Firm', 'law_firm.delete', 'Law Firm', '2024-02-22 11:59:18', NULL),
(35, 'Show Law Firm', 'law_firm.show', 'Law Firm', '2024-02-22 11:59:18', NULL),
(36, 'Approve Law Firm', 'law_firm.approve', 'Law Firm', '2024-02-22 11:59:18', NULL),
(37, 'Import Law Firm', 'law_firm.import', 'Law Firm', '2024-02-22 11:59:18', NULL),
(38, 'Export Law Firm', 'law_firm.export', 'Law Firm', '2024-02-22 11:59:18', NULL),
(40, 'Add Law Firm Certification', 'law_firm.add_certification', 'Law Firm', '2024-02-22 11:59:18', NULL),
(42, 'Add Law Firm Blog', 'law_firm.add_blog', 'Law Firm', '2024-02-22 11:59:18', NULL),
(43, 'Add Law Firm Event', 'law_firm.add_event', 'Law Firm', '2024-02-22 11:59:18', NULL),
(44, 'Add Law Firm Archive', 'law_firm.add_archive', 'Law Firm', '2024-02-22 11:59:18', NULL),
(45, 'Add Law Firm Podcast', 'law_firm.add_podcast', 'Law Firm', '2024-02-22 11:59:18', NULL),
(46, 'Add Law Firm Media', 'law_firm.add_media', 'Law Firm', '2024-02-22 11:59:18', NULL),
(47, 'Law Firm Main Category Index', 'law_firm_main_category.index', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(48, 'Add Law Firm Main Category', 'law_firm_main_category.add', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(49, 'Edit Law Firm Main Category', 'law_firm_main_category.edit', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(50, 'Delete Law Firm Main Category', 'law_firm_main_category.delete', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(51, 'Show Law Firm Main Category', 'law_firm_main_category.show', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(52, 'Import Law Firm Main Category', 'law_firm_main_category.import', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(53, 'Export Law Firm Main Category', 'law_firm_main_category.export', 'Law Firm Main Categories', '2024-02-22 12:01:31', NULL),
(54, 'Law Firm Category Index', 'law_firm_category.index', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(55, 'Add Law Firm Category', 'law_firm_category.add', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(56, 'Edit Law Firm Category', 'law_firm_category.edit', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(57, 'Delete Law Firm Category', 'law_firm_category.delete', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(58, 'Show Law Firm Category', 'law_firm_category.show', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(59, 'Import Law Firm Category', 'law_firm_category.import', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(60, 'Export Law Firm Category', 'law_firm_category.export', 'Law Firm Categories', '2024-02-22 12:02:51', NULL),
(61, 'Customer Index', 'customer.index', 'Customer', '2024-02-22 12:05:49', NULL),
(62, 'Add Customer', 'customer.add', 'Customer', '2024-02-22 12:05:49', NULL),
(63, 'Edit Customer', 'customer.edit', 'Customer', '2024-02-22 12:05:49', NULL),
(64, 'Delete Customer', 'customer.delete', 'Customer', '2024-02-22 12:05:49', NULL),
(65, 'Show Customer', 'customer.show', 'Customer', '2024-02-22 12:05:49', NULL),
(66, 'Event Index', 'event.index', 'Event', '2024-02-22 12:15:36', NULL),
(67, 'Add Event', 'event.add', 'Event', '2024-02-22 12:15:36', NULL),
(68, 'Edit Event', 'event.edit', 'Event', '2024-02-22 12:15:36', NULL),
(69, 'Delete Event', 'event.delete', 'Event', '2024-02-22 12:15:36', NULL),
(70, 'Show Event', 'event.show', 'Event', '2024-02-22 12:15:36', NULL),
(71, 'Approve Event', 'event.approve', 'Event', '2024-02-22 12:15:36', NULL),
(72, 'Event Category Index', 'event_category.index', 'Event Category', '2024-02-22 12:17:10', NULL),
(73, 'Add Event Category', 'event_category.add', 'Event Category', '2024-02-22 12:17:10', NULL),
(74, 'Edit Event Category', 'event_category.edit', 'Event Category', '2024-02-22 12:17:10', NULL),
(75, 'Delete Event Category', 'event_category.delete', 'Event Category', '2024-02-22 12:17:10', NULL),
(76, 'Show Event Category', 'event_category.show', 'Event Category', '2024-02-22 12:17:10', NULL),
(77, 'Booked Appointments Index', 'booked_appointements.index', 'Booked Appointments', '2024-02-22 12:18:41', NULL),
(78, 'Show Booked Appointments', 'booked_appointements.show', 'Booked Appointments', '2024-02-22 12:18:41', NULL),
(79, 'Podcast Index', 'podcast.index', 'Podcast', '2024-02-22 12:19:21', NULL),
(80, 'Add Podcast', 'podcast.add', 'Podcast', '2024-02-22 12:19:21', NULL),
(81, 'Edit Podcast', 'podcast.edit', 'Podcast', '2024-02-22 12:19:21', NULL),
(82, 'Delete Podcast', 'podcast.delete', 'Podcast', '2024-02-22 12:19:21', NULL),
(83, 'Show Podcast', 'podcast.show', 'Podcast', '2024-02-22 12:20:02', NULL),
(84, 'Podcast Category Index', 'podcast_category.index', 'Podcast Category', '2024-02-22 12:20:59', NULL),
(85, 'Add Podcast Category', 'podcast_category.add', 'Podcast Category', '2024-02-22 12:20:59', NULL),
(86, 'Edit Podcast Category', 'podcast_category.edit', 'Podcast Category', '2024-02-22 12:20:59', NULL),
(87, 'Delete Podcast Category', 'podcast_category.delete', 'Podcast Category', '2024-02-22 12:20:59', NULL),
(88, 'Show Podcast Category', 'podcast_category.show', 'Podcast Category', '2024-02-22 12:20:59', NULL),
(89, 'Media Index', 'media.index', 'Media', '2024-02-22 12:21:33', NULL),
(90, 'Add Media', 'media.add', 'Media', '2024-02-22 12:21:33', NULL),
(91, 'Edit Media', 'media.edit', 'Media', '2024-02-22 12:21:33', NULL),
(92, 'Delete Media', 'media.delete', 'Media', '2024-02-22 12:21:33', NULL),
(93, 'Show Media', 'media.show', 'Media', '2024-02-22 12:21:33', NULL),
(94, 'Media Category Index', 'media_category.index', 'Media Category', '2024-02-22 12:22:09', NULL),
(95, 'Media Category Index', 'media_category.index', 'Media Category', '2024-02-22 12:22:09', NULL),
(96, 'Add Media Category', 'media_category.add', 'Media Category', '2024-02-22 12:22:09', NULL),
(97, 'Add Media Category', 'media_category.add', 'Media Category', '2024-02-22 12:22:09', NULL),
(98, 'Edit Media Category', 'media_category.edit', 'Media Category', '2024-02-22 12:22:09', NULL),
(99, 'Edit Media Category', 'media_category.edit', 'Media Category', '2024-02-22 12:22:09', NULL),
(100, 'Delete Media Category', 'media_category.delete', 'Media Category', '2024-02-22 12:22:09', NULL),
(101, 'Delete Media Category', 'media_category.delete', 'Media Category', '2024-02-22 12:22:09', NULL),
(102, 'Show Media Category', 'media_category.show', 'Media Category', '2024-02-22 12:22:09', NULL),
(103, 'Show Media Category', 'media_category.show', 'Media Category', '2024-02-22 12:22:09', NULL),
(104, 'FAQ Index', 'faq.index', 'FAQ', '2024-02-22 12:24:37', NULL),
(105, 'Add FAQ', 'faq.add', 'FAQ', '2024-02-22 12:24:37', NULL),
(106, 'Edit FAQ', 'faq.edit', 'FAQ', '2024-02-22 12:24:37', NULL),
(107, 'Delete FAQ', 'faq.delete', 'FAQ', '2024-02-22 12:24:37', NULL),
(108, 'Show FAQ', 'faq.show', 'FAQ', '2024-02-22 12:24:37', NULL),
(109, 'Import FAQ', 'faq.import', 'FAQ', '2024-02-22 12:24:37', NULL),
(110, 'Export FAQ', 'faq.export', 'FAQ', '2024-02-22 12:24:37', NULL),
(111, 'FAQ Category Index', 'faq_category.index', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(112, 'Add FAQ Category', 'faq_category.add', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(113, 'Edit FAQ Category', 'faq_category.edit', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(114, 'Delete FAQ Category', 'faq_category.delete', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(115, 'Show FAQ Category', 'faq_category.show', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(116, 'Import FAQ Category', 'faq_category.import', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(117, 'Export FAQ Category', 'faq_category.export', 'FAQ Category', '2024-02-22 12:26:10', NULL),
(118, 'Contact Index', 'contact.index', 'Contact Us', '2024-02-22 12:55:46', NULL),
(119, 'Show Contact', 'contact.show', 'Contact Us', '2024-02-22 12:55:46', NULL),
(120, 'Gateway Index', 'gateway.index', 'Gateway', '2024-02-22 12:56:58', NULL),
(121, 'Edit Gateway', 'gateway.edit', 'Gateway', '2024-02-22 12:56:58', NULL),
(122, 'Show Gateway', 'gateway.show', 'Gateway', '2024-02-22 12:56:58', NULL),
(123, 'Pricing Plan Index', 'pricing_plane.index', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(124, 'Add Pricing Plan', 'pricing_plane.add', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(125, 'Edit Pricing Plan', 'pricing_plane.edit', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(126, 'Delete Pricing Plan', 'pricing_plane.delete', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(127, 'Show Pricing Plan', 'pricing_plane.show', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(128, 'Import Pricing Plan', 'pricing_plane.import', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(129, 'Export Pricing Plan', 'pricing_plane.export', 'Pricing Plan', '2024-02-22 12:59:23', NULL),
(130, 'Blog Index', 'blog.index', 'Blog', '2024-02-22 12:59:59', NULL),
(131, 'Add Blog', 'blog.add', 'Blog', '2024-02-22 12:59:59', NULL),
(132, 'Edit Blog', 'blog.edit', 'Blog', '2024-02-22 12:59:59', NULL),
(133, 'Delete Blog', 'blog.delete', 'Blog', '2024-02-22 12:59:59', NULL),
(134, 'Show Blog', 'blog.show', 'Blog', '2024-02-22 12:59:59', NULL),
(135, 'Blog Category Index', 'blog_category.index', 'Blog Category', '2024-02-22 13:00:53', NULL),
(136, 'Add Blog Category', 'blog_category.add', 'Blog Category', '2024-02-22 13:00:53', NULL),
(137, 'Edit Blog Category', 'blog_category.edit', 'Blog Category', '2024-02-22 13:00:53', NULL),
(138, 'Delete Blog Category', 'blog_category.delete', 'Blog Category', '2024-02-22 13:00:53', NULL),
(139, 'Show Blog Category', 'blog_category.show', 'Blog Category', '2024-02-22 13:00:53', NULL),
(140, 'Cource Index', 'cource.index', 'Cource', '2024-02-22 13:02:01', NULL),
(141, 'Add Cource', 'cource.add', 'Cource', '2024-02-22 13:02:01', NULL),
(142, 'Edit Cource', 'cource.edit', 'Cource', '2024-02-22 13:02:01', NULL),
(143, 'Delete Cource', 'cource.delete', 'Cource', '2024-02-22 13:02:02', NULL),
(144, 'Show Cource', 'cource.show', 'Cource', '2024-02-22 13:02:02', NULL),
(145, 'Cource Category Index', 'cource_category.index', 'Cource Category', '2024-02-22 13:02:59', NULL),
(146, 'Add Cource Category', 'cource_category.add', 'Cource Category', '2024-02-22 13:03:00', NULL),
(147, 'Edit Cource Category', 'cource_category.edit', 'Cource Category', '2024-02-22 13:03:00', NULL),
(148, 'Delete Cource Category', 'cource_category.delete', 'Cource Category', '2024-02-22 13:03:00', NULL),
(149, 'Show Cource Category', 'cource_category.show', 'Cource Category', '2024-02-22 13:03:00', NULL),
(150, 'Testimonial Index', 'testimonial.index', 'Testimonial', '2024-02-22 13:03:47', NULL),
(151, 'Add Testimonial', 'testimonial.add', 'Testimonial', '2024-02-22 13:03:47', NULL),
(152, 'Edit Testimonial', 'testimonial.edit', 'Testimonial', '2024-02-22 13:03:47', NULL),
(153, 'Delete Testimonial', 'testimonial.delete', 'Testimonial', '2024-02-22 13:03:47', NULL),
(154, 'Show Testimonial', 'testimonial.show', 'Testimonial', '2024-02-22 13:03:47', NULL),
(155, 'Import Testimonial', 'testimonial.import', 'Testimonial', '2024-02-22 13:03:47', NULL),
(156, 'Export Testimonial', 'testimonial.export', 'Testimonial', '2024-02-22 13:03:47', NULL),
(157, 'Tag Index', 'tag.index', 'Tag', '2024-02-22 13:04:33', NULL),
(158, 'Add Tag', 'tag.add', 'Tag', '2024-02-22 13:04:33', NULL),
(159, 'Edit Tag', 'tag.edit', 'Tag', '2024-02-22 13:04:33', NULL),
(160, 'Delete Tag', 'tag.delete', 'Tag', '2024-02-22 13:04:33', NULL),
(161, 'Show Tag', 'tag.show', 'Tag', '2024-02-22 13:04:33', NULL),
(162, 'Import Tag', 'tag.import', 'Tag', '2024-02-22 13:04:33', NULL),
(163, 'Export Tag', 'tag.export', 'Tag', '2024-02-22 13:04:33', NULL),
(164, 'Currency Index', 'currency.index', 'Currency', '2024-02-22 13:05:30', NULL),
(165, 'Add Currency', 'currency.add', 'Currency', '2024-02-22 13:05:30', NULL),
(166, 'Edit Currency', 'currency.edit', 'Currency', '2024-02-22 13:05:30', NULL),
(167, 'Delete Currency', 'currency.delete', 'Currency', '2024-02-22 13:05:30', NULL),
(168, 'Show Currency', 'currency.show', 'Currency', '2024-02-22 13:05:30', NULL),
(169, 'Withdraw Request Index', 'withdraw_request.index', 'Withdraw Request', '2024-02-22 13:06:49', NULL),
(170, 'Edit Withdraw Request', 'withdraw_request.edit', 'Withdraw Request', '2024-02-22 13:06:49', NULL),
(171, 'Show Withdraw Request', 'withdraw_request.show', 'Withdraw Request', '2024-02-22 13:06:49', NULL),
(172, 'Company Page Index', 'company_page.index', 'Company Page', '2024-02-22 13:38:45', NULL),
(173, 'Add Company Page', 'company_page.add', 'Company Page', '2024-02-22 13:38:45', NULL),
(174, 'Edit Company Page', 'company_page.edit', 'Company Page', '2024-02-22 13:38:45', NULL),
(175, 'Delete Company Page', 'company_page.delete', 'Company Page', '2024-02-22 13:38:45', NULL),
(176, 'Show Company Page', 'company_page.show', 'Company Page', '2024-02-22 13:38:45', NULL),
(177, 'Site Content Index', 'site_content.index', 'Site Content Index', '2024-02-22 13:39:51', NULL),
(178, 'Country Index', 'country.index', 'Country', '2024-02-22 13:40:45', NULL),
(179, 'Add Country', 'country.add', 'Country', '2024-02-22 13:40:45', NULL),
(180, 'Edit Country', 'country.edit', 'Country', '2024-02-22 13:40:45', NULL),
(181, 'Delete Country', 'country.delete', 'Country', '2024-02-22 13:40:45', NULL),
(182, 'Show Country', 'country.show', 'Country', '2024-02-22 13:40:45', NULL),
(183, 'Import Country', 'country.import', 'Country', '2024-02-22 13:40:45', NULL),
(184, 'Export Country', 'country.export', 'Country', '2024-02-22 13:40:45', NULL),
(185, 'State Index', 'state.index', 'State', '2024-02-22 13:41:18', NULL),
(186, 'Add State', 'state.add', 'State', '2024-02-22 13:41:18', NULL),
(187, 'Edit State', 'state.edit', 'State', '2024-02-22 13:41:18', NULL),
(188, 'Delete State', 'state.delete', 'State', '2024-02-22 13:41:18', NULL),
(189, 'Show State', 'state.show', 'State', '2024-02-22 13:41:18', NULL),
(190, 'Import State', 'state.import', 'State', '2024-02-22 13:41:18', NULL),
(191, 'Export State', 'state.export', 'State', '2024-02-22 13:41:18', NULL),
(192, 'City Index', 'city.index', 'City', '2024-02-22 13:41:47', NULL),
(193, 'Add City', 'city.add', 'City', '2024-02-22 13:41:47', NULL),
(194, 'Edit City', 'city.edit', 'City', '2024-02-22 13:41:47', NULL),
(195, 'Delete City', 'city.delete', 'City', '2024-02-22 13:41:47', NULL),
(196, 'Show City', 'city.show', 'City', '2024-02-22 13:41:47', NULL),
(197, 'Import City', 'city.import', 'City', '2024-02-22 13:41:47', NULL),
(198, 'Export City', 'city.export', 'City', '2024-02-22 13:41:47', NULL),
(199, 'Language Index', 'language.index', 'Language', '2024-02-22 13:42:27', NULL),
(200, 'Add Language', 'language.add', 'Language', '2024-02-22 13:42:27', NULL),
(201, 'Edit Language', 'language.edit', 'Language', '2024-02-22 13:42:27', NULL),
(202, 'Delete Language', 'language.delete', 'Language', '2024-02-22 13:42:27', NULL),
(203, 'Show Language', 'language.show', 'Language', '2024-02-22 13:42:27', NULL),
(204, 'Import Language', 'language.import', 'Language', '2024-02-22 13:42:27', NULL),
(205, 'Export Language', 'language.export', 'Language', '2024-02-22 13:42:27', NULL),
(206, 'Role Index', 'role.index', 'Role', '2024-02-22 13:44:29', NULL),
(207, 'Add Role', 'role.add', 'Role', '2024-02-22 13:44:29', NULL),
(208, 'Edit Role', 'role.edit', 'Role', '2024-02-22 13:44:29', NULL),
(209, 'Delete Role', 'role.delete', 'Role', '2024-02-22 13:44:29', NULL),
(210, 'Show Role', 'role.show', 'Role', '2024-02-22 13:44:29', NULL),
(211, 'Import Role', 'role.import', 'Role', '2024-02-22 13:44:29', NULL),
(212, 'Export Role', 'role.export', 'Role', '2024-02-22 13:44:29', NULL),
(213, 'General Setting Index', 'general_setting.index', 'Setting', '2024-02-22 13:47:17', NULL),
(214, 'Configurations Setting Index', 'configurations_setting.index', 'Setting', '2024-02-22 13:47:17', NULL),
(215, 'Social Links Setting Index', 'social_links_setting.index', 'Setting', '2024-02-22 13:47:17', NULL),
(216, 'Subscription Methods Setting Index', 'subscription_methods_etting.index', 'Setting', '2024-02-22 13:47:17', NULL),
(217, 'Commission Index', 'commission.index', 'Setting', '2024-02-22 13:47:17', NULL),
(218, 'Users Index', 'users.index', 'User', '2024-02-22 13:47:17', NULL),
(219, 'Add Users', 'users.add', 'User', '2024-02-22 13:47:17', NULL),
(220, 'Edit Users', 'users.edit', 'User', '2024-02-22 13:47:17', NULL),
(221, 'Show Users', 'users.show', 'User', '2024-02-22 13:47:17', NULL),
(222, 'Delete Users', 'users.delete', 'User', '2024-02-22 13:47:17', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'commission_type', 'Select Commission Type', 'subscription', '0', '0', 'select_option', NULL, '2024-01-11 22:22:19', '2024-01-02 13:30:38');
ALTER TABLE `appointment_schedules` ADD `commission_amont` INT NULL DEFAULT NULL AFTER `fee`;
ALTER TABLE `commission_categories` CHANGE `rate_type` `commission_type` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `users` ADD `role_id` INT NULL DEFAULT NULL AFTER `password`;
ALTER TABLE `roles` ADD `is_editable` INT NOT NULL DEFAULT '0' AFTER `is_active`;
