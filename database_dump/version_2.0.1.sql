ALTER TABLE `general_settings` ADD `is_protected` TINYINT NOT NULL DEFAULT '0' AFTER `value`;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 43;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 45;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 50;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 51;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 52;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 53;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 54;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 55;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 62;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 63;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 64;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 65;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 66;
UPDATE `general_settings` SET `is_protected` = '1' WHERE `general_settings`.`id` = 67;
UPDATE `general_settings` SET `value` = '2.0.1' WHERE `general_settings`.`id` = 61;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_protected`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'favicon', 'FavIcon', '/images/settings/favicon.png', '0', '0', '0', 'image', NULL, '2025-01-02 16:47:50', '2025-01-02 11:47:50');

--
-- Table structure for table `home_component_orders`
--

CREATE TABLE `home_component_orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `display_name` varchar(191) NOT NULL,
  `description` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `home_component_orders`
--

INSERT INTO `home_component_orders` (`id`, `name`, `display_name`, `description`, `sort_order`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'FeaturedEventSection', 'Featured Event Section', 'Description of Featured Event', 11, 1, '2025-01-10 06:25:24', '2025-01-15 09:35:14', NULL),
(12, 'FreeConsultationSection', 'Free Consultation Section', 'Description of Free Consultation', 8, 1, '2025-01-10 06:25:24', '2025-01-15 09:34:13', NULL),
(11, 'ServiceCategoriesSection', 'Quick Buy Services Section', 'Description of Service Categories', 7, 1, '2025-01-10 06:25:24', '2025-01-15 10:32:52', NULL),
(10, 'FeaturedLawfirmSection', 'Featured Law Firm Section', 'Description of Featured Law Firm', 6, 1, '2025-01-10 06:25:24', '2025-01-15 09:33:57', NULL),
(9, 'LawyersTabsSection', 'Qualified Lawyer Section', 'Description of Lawyers Tabs', 5, 1, '2025-01-10 06:25:24', '2025-01-15 10:34:11', NULL),
(8, 'NearestTabSection', 'Find Nearest Lawyer Section', 'Description of Nearest Tab', 4, 1, '2025-01-10 06:25:24', '2025-01-15 09:33:35', NULL),
(7, 'SpotlightLawyerSection', 'Premium Lawyer Section', 'Description of Spotlight Lawyer', 3, 1, '2025-01-10 06:25:24', '2025-01-15 10:32:51', NULL),
(5, 'HomeStatisticsBar', 'Home Statistics Bar', 'Description of Home Statistics', 1, 1, '2025-01-10 06:25:24', '2025-01-10 05:30:21', NULL),
(6, 'HomeStaticCardsSection', 'Law Categories Section', 'Description of Static Cards', 2, 1, '2025-01-10 06:25:24', '2025-01-15 09:33:09', NULL),
(14, 'FeaturedTestimonialsSection', 'About Our Services Section', 'Description of Featured Testimonials', 9, 1, '2025-01-10 06:25:24', '2025-01-15 09:34:20', NULL),
(15, 'AppSection', 'Consultant App Section', 'Description of App Section', 10, 1, '2025-01-10 06:25:24', '2025-01-15 10:34:12', NULL),
(16, 'FaqsSection', 'FAQs Section', 'Description of FAQs Section', 12, 1, '2025-01-10 06:25:24', '2025-01-15 09:35:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theme_settings`
--

CREATE TABLE `theme_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `theme_code` varchar(255) DEFAULT NULL,
  `is_editable` tinyint(4) DEFAULT NULL,
  `is_protected` tinyint(4) NOT NULL DEFAULT 0,
  `is_specific` int(11) NOT NULL DEFAULT 0,
  `is_multilang` tinyint(4) NOT NULL DEFAULT 0,
  `type` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `theme_settings`
--

INSERT INTO `theme_settings` (`id`, `name`, `color`, `display_name`, `value`, `theme_code`, `is_editable`, `is_protected`, `is_specific`, `is_multilang`, `type`, `page`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'custom_primary_color', 'primary_color', 'Custom Primary color', '#cab083', 'custom', 1, 0, 1, 0, 'color', 'theme', NULL, 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(2, 'custom_secondary_color', 'secondary_color', 'Custom Secondary Color', '#003c40', 'custom', 1, 0, 1, 0, 'color', 'theme', NULL, 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(3, 'theme_1_primary_color', 'primary_color', 'Theme 1 Primary Color', '#f66e00', 'theme_1', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_1.jpg', 1, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(4, 'theme_1_secondary_color', 'secondary_color', 'theme 1 Secondary color', '#483f3b', 'theme_1', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_1.jpg', 1, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(5, 'theme_2_primary_color', 'primary_color', 'Theme 2 Primary Color', '#CBA672', 'theme_2', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_2.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(6, 'theme_2_secondary_color', 'secondary_color', 'theme 2 Secondary color', '#003C40', 'theme_2', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_2.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(8, 'default_primary_color', 'primary_color', 'Default Primary Color', '#cab083', 'default', 0, 0, 1, 0, 'color', 'theme', '/images/themes/default.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(9, 'default_secondary_color', 'secondary_color', 'Default Secondary Color', '#262929', 'default', 0, 0, 1, 0, 'color', 'theme', '/images/themes/default.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(10, 'custom_tertiary_color', 'tertiary_color', 'Custom Tertiary Color', '#cee6e7', 'custom', 1, 0, 1, 0, 'color', 'theme', NULL, 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(11, 'theme_1_tertiary_color', 'tertiary_color', 'theme 1 Tertiary color', '#F1EAE7', 'theme_1', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_1.jpg', 1, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(12, 'theme_2_tertiary_color', 'tertiary_color', 'theme 2 Tertiary color', '#cee6e7', 'theme_2', 0, 0, 1, 0, 'color', 'theme', '/images/themes/theme_2.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16'),
(13, 'default_tertiary_color', 'tertiary_color', 'Default Tertiary Color', '#FCECCB', 'default', 0, 0, 1, 0, 'color', 'theme', '/images/themes/default.jpg', 0, '2025-01-16 08:42:16', '2025-01-16 08:42:16');

--
-- Indexes for table `home_component_orders`
--
ALTER TABLE `home_component_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theme_settings`
--
ALTER TABLE `theme_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `home_component_orders`
--
ALTER TABLE `home_component_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `theme_settings`
--
ALTER TABLE `theme_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
