UPDATE `gateways` SET `code` = 'bank-transfer' WHERE `gateways`.`id` = 37;
INSERT INTO `general_settings` (`id`, `name`, `display_name`, `value`, `is_specific`, `is_multilang`, `type`, `page`, `created_at`, `updated_at`) VALUES (NULL, 'is_auto_approve', 'Auto Approve Users', '1', '0', '0', 'boolean_selection', NULL, '2024-12-12 16:00:00', '2024-12-12 16:00:00');
ALTER TABLE `fund_bank_transfers` ADD `is_fund` TINYINT NOT NULL DEFAULT '0' AFTER `attachment`;
