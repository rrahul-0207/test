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
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (file_exists('assets/init.php')) {
    require 'assets/init.php';
} else {
    die('Please put this file in the home directory !');
}

$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '1.5.3.1' WHERE `name` = 'script_version'");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'ads_currency', 'USD');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'web_push', '1');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `web_device_id` VARCHAR(100) NOT NULL DEFAULT '' AFTER `device_id`;");

if (file_exists('.htaccess') && file_exists('htaccess.txt')) {
    $put = @file_put_contents('.htaccess', file_get_contents('htaccess.txt'));
}

echo 'The script is successfully updated to v1.5.3.1!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();