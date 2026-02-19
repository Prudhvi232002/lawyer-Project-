UPDATE `general_settings` SET `value` = '2.0.3' WHERE `general_settings`.`id` = 61;
ALTER TABLE `posts` ADD `is_community_post` BOOLEAN NOT NULL DEFAULT FALSE AFTER `is_featured`;