

CREATE TABLE `app_carousel` (
  `id` int(11) NOT NULL,
  `name` longtext,
  `description` longtext,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_carousel`
--

INSERT INTO `app_carousel` (`id`, `name`, `description`, `is_active`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '{\"en\":\"dsd updated\",\"hi\":\"dasd\",\"ar\":\"dasd\"}', '{\"en\":\"<p>dsda</p>\",\"hi\":\"<p>dsad</p>\",\"ar\":\"<p>dsd</p>\"}', 1, '/images/app_carousels/67aded871f627.png', '2025-02-13 08:03:03', '2025-02-13 08:03:19', NULL);


ALTER TABLE `app_carousel`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `app_carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 67; UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 66; UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 65; UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 64; UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 63; UPDATE `general_settings` SET `page` = 'email_settings' WHERE `general_settings`.`id` = 62;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_protected`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'seo_title', 'SEO title', 'Law-Advisor', '0', '1', '0', 'text', 'seo_settings', '2025-01-29 17:18:48', '2025-01-29 12:18:48'),(NULL, 'meta_description', 'Meta Description', '<p>Stay informed and inspired with our Hexathemes, delivering the latest news, trends, and insights in lifestyle, technology, health, and more. Explore exclusive articles, in-depth analysis, and expert opinions tailored for curious minds and savvy readers.</p>', '0', '1', '0', 'textarea', 'seo_settings', '2025-01-29 17:18:48', '2025-01-29 12:18:48'), (NULL, 'meta_keywords', 'Meta Keywords', '[\"websites\",\"law-advisor\",\"lawyers\",\"lawfirm\"]', '0', '1', '0', 'array', 'seo_settings', '2025-01-29 17:18:48', '2025-01-29 12:18:48');
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_protected`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'social_description', 'Social Description', '<p>Stay informed and inspired with our Hexathemes, delivering the latest news, trends, and insights in lifestyle, technology, health, and more. Explore exclusive articles, in-depth analysis, and expert opinions tailored for curious minds and savvy readers.</p>', '0', '1', '0', 'textarea', 'seo_settings', '2025-01-29 17:18:48', '2025-01-29 12:18:48');
UPDATE `general_settings` SET `value` = '2.0.2' WHERE `general_settings`.`id` = 61;
