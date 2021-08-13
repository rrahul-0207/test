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
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'amazone_s3', '0'), (NULL, 'bucket_name', ''), (NULL, 'amazone_s3_key', ''), (NULL, 'amazone_s3_s_key', ''), (NULL, 'region', 'us-east-1') ;") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `deleted_one` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `seen`, ADD `deleted_two` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `deleted_one`, ADD INDEX (`deleted_two`), ADD INDEX (`deleted_one`);") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "TRUNCATE `Wo_AppsSessions`;") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_UsersChat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `conversation_user_id` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UsersChat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `conversation_user_id` (`conversation_user_id`),
  ADD KEY `time` (`time`);") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UsersChat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;") or die(mysqli_error($sqlConnect));

if ($query) {
  $query_two = mysqli_query($sqlConnect, "SELECT * FROM Wo_Messages") or die(mysqli_error($sqlConnect));
  while ($row = mysqli_fetch_assoc($query_two)) {
     $from_id = $row['from_id'];
     $to_id = $row['to_id'];
     $time = $row['time'];
     $query_one = mysqli_query($sqlConnect, "SELECT COUNT(`id`) as count FROM " . T_U_CHATS . " WHERE `conversation_user_id` = '$to_id' AND `user_id` = '$from_id'");
     $query_one_fetch = mysqli_fetch_assoc($query_one);
     if ($query_one_fetch['count'] == 0) {
      $query_five = mysqli_query($sqlConnect, "INSERT INTO " . T_U_CHATS . " (`user_id`, `conversation_user_id`, `time`) VALUES ('$from_id', '$to_id', '$time')");
      $query_three = mysqli_query($sqlConnect, "SELECT COUNT(`id`) as count FROM " . T_U_CHATS . " WHERE `conversation_user_id` = '$from_id' AND `user_id` = '$to_id'");
        $query_three_fetch = mysqli_fetch_assoc($query_three);
        if ($query_three_fetch['count'] == 0) {
          $query_six = mysqli_query($sqlConnect, "INSERT INTO " . T_U_CHATS . " (`user_id`, `conversation_user_id`, `time`) VALUES ('$to_id', '$from_id', '$time')");
        }
     }
  }
  echo 'The script is successfully updated to v1.4.2!';
  $name = md5(microtime()) . '_updated.php';
  rename('update.php', $name);
  exit();
} else {
  echo 'Error found while updating, please contact us.';
}
?>