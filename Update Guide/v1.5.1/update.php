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


$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_MovieComments` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `posted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieComments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);");
  $query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieComments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
$query = @mysqli_query($sqlConnect, "UPDATE `Wo_Langs` SET `english` = 'Advertising' WHERE `lang_key` = 'ads'");

echo 'The script is successfully updated to v1.5.1!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();