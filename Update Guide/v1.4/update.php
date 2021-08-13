<?php 
// +------------------------------------------------------------------------+
// | @author Deen Doughouz (DoughouzForest)
// | @author_url 1: http://www.wowonder.com
// | @author_url 2: http://codecanyon.net/user/doughouzforest
// | @author_email: wowondersocial@gmail.com   
// +------------------------------------------------------------------------+
// | WoWonder - The Ultimate Social Networking Platform
// | Copyright (c) 2016 WoWonder. All rights reserved.
// +------------------------------------------------------------------------+
if (file_exists('assets/init.php')) {
	require 'assets/init.php';
} else {
	die('Please put this file in the home directory !');
}

$query = "CREATE TABLE `Wo_Affiliates_Requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `amount` varchar(100) NOT NULL DEFAULT '0',
  `full_amount` varchar(100) NOT NULL DEFAULT '',
  `status` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Wo_AppsSessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(120) NOT NULL DEFAULT '',
  `platform` varchar(32) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Wo_CustomPages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_content` text COLLATE utf8_unicode_ci,
  `page_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Wo_Polls` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `text` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Wo_Products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci,
  `category` int(11) NOT NULL DEFAULT '0',
  `price` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '0',
  `type` enum('0','1') COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL DEFAULT '0',
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Wo_Products_Media` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Wo_ProfileFields` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci,
  `type` text COLLATE utf8_unicode_ci,
  `length` int(11) NOT NULL DEFAULT '0',
  `placement` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'profile',
  `registration_page` int(11) NOT NULL DEFAULT '0',
  `profile_page` int(11) NOT NULL DEFAULT '0',
  `select_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'none',
  `active` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Wo_UserFields` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Wo_Votes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `option_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `Wo_Affiliates_Requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `time` (`time`),
  ADD KEY `status` (`status`);
ALTER TABLE `Wo_AppsSessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`),
  ADD KEY `platform` (`platform`);
ALTER TABLE `Wo_CustomPages`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `Wo_Polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);
ALTER TABLE `Wo_Products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category` (`category`),
  ADD KEY `price` (`price`),
  ADD KEY `status` (`status`);
ALTER TABLE `Wo_Products_Media`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `Wo_ProfileFields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registration_page` (`registration_page`),
  ADD KEY `active` (`active`),
  ADD KEY `profile_page` (`profile_page`);
ALTER TABLE `Wo_UserFields` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);
ALTER TABLE `Wo_Votes` ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `post_id` (`post_id`), ADD KEY `option_id` (`option_id`);
ALTER TABLE `Wo_Affiliates_Requests` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_AppsSessions` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_CustomPages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_Polls` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_Products` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_Products_Media` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_ProfileFields` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_UserFields` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `Wo_Votes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'windows_app_version', '1.0');
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'widnows_app_api_id', '" . md5(microtime()) . "'), (NULL, 'widnows_app_api_key', '" . md5(microtime()) . "');
ALTER TABLE `Wo_Users` ADD `timezone` VARCHAR(50) NOT NULL DEFAULT 'UTC' AFTER `css_file`, ADD INDEX (`timezone`);
ALTER TABLE `Wo_Users` ADD `youtube` VARCHAR(100) NOT NULL DEFAULT '' AFTER `linkedin`;
ALTER TABLE `Wo_Posts` ADD `product_id` INT NOT NULL DEFAULT '0' AFTER `boosted`, ADD INDEX (`product_id`);
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'stripe_id', ''), (NULL, 'stripe_secret', '');
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'credit_card', 'yes'), (NULL, 'bitcoin', 'yes');
ALTER TABLE `Wo_Posts` ADD `poll_id` INT NOT NULL DEFAULT '0' AFTER `product_id`, ADD INDEX (`poll_id`);
ALTER TABLE `Wo_Users` ADD `referrer` INT NOT NULL DEFAULT '0' AFTER `timezone`, ADD INDEX (`referrer`);
ALTER TABLE `Wo_Users` ADD `balance` VARCHAR(100) NOT NULL DEFAULT '0' AFTER `referrer`;
ALTER TABLE `Wo_Users` ADD `paypal_email` VARCHAR(100) NOT NULL DEFAULT '' AFTER `balance`;
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'm_withdrawal', '50'), (NULL, 'amount_ref', '0.10');
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'affiliate_type', '0'), (NULL, 'affiliate_system', '1');
INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'classified', '1');
ALTER TABLE `Wo_Users` ADD `notifications_sound` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `paypal_email`;
ALTER TABLE `Wo_Users` ADD `order_posts_by` ENUM('0','1') NOT NULL DEFAULT '1' AFTER `notifications_sound`;
INSERT INTO `Wo_Ads` (`id`, `type`, `code`, `active`) VALUES (NULL, 'post_first', NULL, '0'), (NULL, 'post_second', NULL, '0'), (NULL, 'post_third', NULL, '0');
ALTER TABLE `Wo_Pages` ADD `background_image` VARCHAR(200) NOT NULL DEFAULT '' AFTER `call_action_type_url`, ADD `background_image_status` INT NOT NULL DEFAULT '0' AFTER `background_image`;";

$query = mysqli_multi_query($sqlConnect, $query);
if ($query) {
  echo 'The script is successfully updated to v1.4!';
  $name = md5(microtime()) . '_updated.php';
  rename('update.php', $name);
  exit();
} else {
  echo 'Error found while updating, please contact us.';
}
?>