<?php
require 'assets/init.php';
@ini_set("memory_limit", "-1");
@set_time_limit(0);
$query = mysqli_query($sqlConnect, "ALTER TABLE " . T_USERS . " CHANGE `password` `password` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '';");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'update_db_15', '" . time() . "');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'wallet')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'company')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'bidding')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'clicks')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'url')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'audience')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'select_image')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'my_balance')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'replenish_my_balance')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'continue')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'replenishment_notif')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'ads')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'confirm_delete_ad')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'delete_ad')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_ads_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'not_active')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'appears');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sidebar');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'select_a_page_or_link');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'story');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'max_number_status');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'status_added');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_status');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sponsored');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'notification_sent');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'hide_post');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'verification_sent');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'profile_verification');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'verification_complete');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'upload_docs');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'select_verif_images');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'passport_id');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'your_photo');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'please_select_passport_id');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'passport_id_invalid');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'user_picture_invalid');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'verification_request_sent');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'shared')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'post_shared')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'important')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'unverify')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'friend_privacy')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'added_group_admin')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'added_page_admin')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_messages')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'conversation_deleted')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'close')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'members')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'exit_group')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'clear_history')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'group_members')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'add_parts')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'unreport')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'report_user')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'report_page')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'report_group')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'page_rated')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'rating')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'reviews')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'rate')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'your_review')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'ad_saved')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'ad_added')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'invalid_ad_picture')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'enter_valid_desc')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'enter_valid_titile')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'enter_valid_url')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'invalid_company_name')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'mother')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'father')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'daughter')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'son')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sister')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'brother')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'auntie')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'uncle')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'niece')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'nephew')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'cousin_female')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'cousin_male')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'grandmother')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'grandfather')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'granddaughter')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'grandson')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepsister')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepbrother')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepmother')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepfather')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepdaughter')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sister_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'brother_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'mother_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'father_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'daughter_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'son_in_law')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sibling_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'parent_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'child_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sibling_of_parent_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'child_of_sibling_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'cousin_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'grandparent_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'grandchild_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'step_sibling_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'step_parent_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stepchild_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sibling_in_law_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'parent_in_law_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'child_in_law_gender_neutral')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'add_to_family')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'accept')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'family_member')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'family_members')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'add_as')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'confirm_remove_family_member')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'family_member_added')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'request_sent')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'request_accepted')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'sent_u_request')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'requests')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_requests_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'relation_with')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'married_to')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'engaged_to')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'relationship_status')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'relationship_request')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'relhip_request_accepted')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'relation_rejected')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'file_too_big')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'file_not_supported')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'years_old')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'find_friends_nearby')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'location_dist')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'close_to_u')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'find_friends')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'distance')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'distance_from_u')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'show_location')");
// ================== //
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_BlogMovieDisLikes` (
  `id` int(11) NOT NULL,
  `blog_comm_id` int(20) NOT NULL DEFAULT '0',
  `blog_commreply_id` int(20) NOT NULL DEFAULT '0',
  `movie_comm_id` int(20) NOT NULL DEFAULT '0',
  `movie_commreply_id` int(20) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(50) NOT NULL DEFAULT '0',
  `movie_id` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_BlogMovieLikes` (
  `id` int(11) NOT NULL,
  `blog_comm_id` int(20) NOT NULL DEFAULT '0',
  `blog_commreply_id` int(20) NOT NULL DEFAULT '0',
  `movie_comm_id` int(20) NOT NULL DEFAULT '0',
  `movie_commreply_id` int(20) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(50) NOT NULL DEFAULT '0',
  `movie_id` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_BlogMovieLikes` (
  `id` int(11) NOT NULL,
  `blog_comm_id` int(20) NOT NULL DEFAULT '0',
  `blog_commreply_id` int(20) NOT NULL DEFAULT '0',
  `movie_comm_id` int(20) NOT NULL DEFAULT '0',
  `movie_commreply_id` int(20) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(50) NOT NULL DEFAULT '0',
  `movie_id` int(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogMovieDisLikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comm_id` (`blog_comm_id`),
  ADD KEY `movie_comm_id` (`movie_comm_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_commreply_id` (`blog_commreply_id`),
  ADD KEY `movie_commreply_id` (`movie_commreply_id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `movie_id` (`movie_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogMovieLikes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_comm_id`),
  ADD KEY `movie_id` (`movie_comm_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `blog_commreply_id` (`blog_commreply_id`),
  ADD KEY `movie_commreply_id` (`movie_commreply_id`),
  ADD KEY `blog_id_2` (`blog_id`),
  ADD KEY `movie_id_2` (`movie_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieComments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogMovieDisLikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogMovieLikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieComments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_BlogCommentReplies` (
  `id` int(11) NOT NULL,
  `comm_id` int(11) NOT NULL DEFAULT '0',
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `likes` int(11) NOT NULL DEFAULT '0',
  `posted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_BlogComments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `likes` int(11) NOT NULL DEFAULT '0',
  `posted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogCommentReplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comm_id` (`comm_id`),
  ADD KEY `blog_id` (`blog_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogComments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`),
  ADD KEY `user_id` (`user_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogCommentReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_BlogComments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_MovieCommentReplies` (
  `id` int(11) NOT NULL,
  `comm_id` int(11) NOT NULL DEFAULT '0',
  `movie_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `text` text,
  `likes` int(11) NOT NULL DEFAULT '0',
  `posted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieCommentReplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comm_id` (`comm_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_MovieCommentReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `wallet` VARCHAR(20) 
    CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci 
    NOT NULL DEFAULT '0.00' AFTER `device_id`, ADD INDEX (`wallet`)");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES 
    (NULL, 'ad_v_price', '0.01'), 
    (NULL, 'ad_c_price', '0.05');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'emo_cdn', 'https://cdnjs.cloudflare.com/ajax/libs/emojione/2.1.4/assets/png/');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Notifications` CHANGE `event_id` `event_id` INT(11) NOT NULL DEFAULT '0';");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_UserAds` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(3000) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `headline` varchar(200) NOT NULL DEFAULT '',
  `description` text,
  `location` varchar(1000) NOT NULL DEFAULT 'us',
  `audience` longtext,
  `image` varchar(3000) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `gender` varchar(15) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL DEFAULT 'all',
  `bidding` varchar(15) CHARACTER SET utf8mb4 NOT NULL DEFAULT '',
  `clicks` int(15) NOT NULL DEFAULT '0',
  `views` int(15) NOT NULL DEFAULT '0',
  `posted` varchar(15) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '1',
  `appears` varchar(10) NOT NULL DEFAULT 'post',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_UserStory` (
  `id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(300) NOT NULL DEFAULT '',
  `posted` varchar(50) NOT NULL DEFAULT '',
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_UserStoryMedia` (
  `id` int(11) NOT NULL,
  `story_id` int(30) NOT NULL DEFAULT '0',
  `type` varchar(30) NOT NULL DEFAULT '',
  `filename` text,
  `expire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserAds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appears` (`appears`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `location` (`location`(255)),
  ADD KEY `gender` (`gender`),
  ADD KEY `status` (`status`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserStory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `expires` (`expire`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserStoryMedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expire` (`expire`),
  ADD KEY `story_id` (`story_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserAds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` CHANGE `birthday` `birthday` VARCHAR(50) CHARACTER 
	SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0000-00-00';");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserStory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserStoryMedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Notifications` ADD `full_link` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `url`;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_HiddenPosts` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `post_id` int(11) NOT NULL DEFAULT '0',
 `user_id` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `post_id` (`post_id`),
 KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Verification_Requests`
  ADD `message` TEXT CHARACTER SET 
  utf8 COLLATE utf8_general_ci NULL 
  DEFAULT NULL AFTER `page_id`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Verification_Requests` 
  ADD `user_name` VARCHAR(150) CHARACTER
  SET utf8 COLLATE utf8_general_ci NOT NULL 
  DEFAULT '' AFTER `message`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Verification_Requests` 
  ADD `passport` VARCHAR(3000) CHARACTER
  SET utf8 COLLATE utf8_general_ci NOT NULL 
  DEFAULT '' AFTER `user_name`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Verification_Requests` ADD 
  `photo` VARCHAR(3000) CHARACTER SET 
  utf8 COLLATE utf8_general_ci NOT NULL 
  DEFAULT '' AFTER `passport`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `shared_from` INT(15) 
  NOT NULL DEFAULT '0' AFTER `postRecord`, 
  ADD INDEX (`shared_from`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `post_url` TEXT CHARACTER 
  SET utf8 COLLATE utf8_general_ci NULL DEFAULT 
  NULL AFTER `shared_from`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `parent_id` INT(15) NOT 
  NULL DEFAULT '0' AFTER `post_url`;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_AdminInvitations` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `code` varchar(300) NOT NULL DEFAULT '0',
 `posted` varchar(50) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'user_ads', '1');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'user_status', '1');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'date_style', 'Y/m/d');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `friend_privacy` 
  ENUM('0','1','2','3') CHARACTER SET utf8 
  COLLATE utf8_general_ci NOT NULL DEFAULT '0' 
  AFTER `follow_privacy`, ADD INDEX (`friend_privacy`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Hashtags` ADD `expire` 
  DATE NULL DEFAULT NULL 
  AFTER `trend_use_num`, 
  ADD INDEX (`expire`);");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'stickers', '1');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'giphy_api', '420d477a542b4287b2bf91ac134ae041');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Movies` ADD `iframe` 
  VARCHAR(1000) CHARACTER SET utf8 
  COLLATE utf8_general_ci NOT NULL 
  DEFAULT '' AFTER `source`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Movies` ADD `video` VARCHAR(3000) 
  CHARACTER SET utf8 COLLATE utf8_general_ci 
  NOT NULL DEFAULT '' AFTER `iframe`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `postSticker` 
  TEXT CHARACTER SET utf8 COLLATE 
  utf8_general_ci NULL DEFAULT 
  NULL AFTER `postRecord`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `stickers` 
  TEXT CHARACTER SET utf8 COLLATE 
  utf8_general_ci NULL DEFAULT 
  NULL AFTER `type_two`;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_GroupAdmins` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL DEFAULT '0',
 `group_id` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_PageAdmins` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL DEFAULT '0',
 `page_id` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 KEY `page_id` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `group_id` INT(11) 
  NOT NULL DEFAULT '0' AFTER `from_id`, 
  ADD INDEX (`group_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Reports` ADD `profile_id` INT(11) 
  NOT NULL DEFAULT '0' AFTER `post_id`, 
  ADD INDEX (`profile_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Reports` ADD `page_id` INT(15) 
  NOT NULL DEFAULT '0' AFTER `profile_id`, 
  ADD INDEX (`page_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Reports` ADD `group_id` INT(15) 
  NOT NULL DEFAULT '0' AFTER `page_id`, 
  ADD INDEX (`group_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Reports` ADD `text` TEXT CHARACTER 
  SET utf8 COLLATE utf8_general_ci NULL 
  DEFAULT NULL AFTER `user_id`;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_GroupChatUsers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `group_id` int(11) NOT NULL,
 `active` enum('1','0') NOT NULL DEFAULT '1',
 `last_seen` varchar(50) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 KEY `group_id` (`group_id`),
 KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_GroupChat` (
 `group_id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `group_name` varchar(20) NOT NULL DEFAULT '',
 `avatar` varchar(3000) NOT NULL DEFAULT 'upload/photos/d-group.jpg',
 `time` varchar(30) NOT NULL DEFAULT '',
 PRIMARY KEY (`group_id`),
 KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_PageRating` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL DEFAULT '0',
 `page_id` int(11) NOT NULL DEFAULT '0',
 `valuation` int(11) DEFAULT '0',
 `review` text,
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 KEY `page_id` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `lat` VARCHAR(200) CHARACTER 
  SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' 
  AFTER `wallet`, ADD INDEX (`lat`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `lng` VARCHAR(200) CHARACTER 
  SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' 
  AFTER `lat`, ADD INDEX (`lng`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `last_location_update` VARCHAR(30) CHARACTER 
  SET utf8 COLLATE utf8_general_ci NOT NULL 
  DEFAULT '0' AFTER `lng`;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Family` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `member_id` int(11) NOT NULL,
 `member` int(11) NOT NULL DEFAULT '0',
 `active` enum('0','1') NOT NULL DEFAULT '0',
 `user_id` int(11) NOT NULL DEFAULT '0',
 `requesting` int(11) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `member_id` (`member_id`),
 KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Relationship` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `from_id` int(11) NOT NULL DEFAULT '0',
 `to_id` int(11) NOT NULL DEFAULT '0',
 `relationship` int(11) NOT NULL DEFAULT '0',
 `active` enum('0','1') NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 KEY `from_id` (`from_id`),
 KEY `relationship` (`relationship`),
 KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'find_friends', '1');");

// ================== //
$data  = array();
$query = mysqli_query($sqlConnect, "SHOW COLUMNS FROM `Wo_Langs`");
while ($fetched_data = mysqli_fetch_assoc($query)) {
    $data[] = $fetched_data['Field'];
}
unset($data[0]);
unset($data[1]);
function Wo_UpdateLangs($lang, $key, $value) {
    $update_query         = "UPDATE Wo_Langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
    $update_replace_array = array(
        "{lang}",
        "{lang_text}",
        "{lang_key}"
    );
    return str_replace($update_replace_array, array(
        $lang,
        $value,
        $key
    ), $update_query);
}
$lang_update_queries = array();
foreach ($data as $key => $value) {
    $value = ($value);
    if ($value == 'arabic') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'محفظة نقود');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'شركة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'مزايدة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'نقرات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'رابط');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'جمهور');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'حدد صورة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'رصيدي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'تجديد رصيد بلدي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'استمر');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'تمت إعادة تجديد رصيدك بواسطة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'إعلان');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'هل أنت متأكد أنك تريد حذف هذا الإعلان');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'حذف الإعلان');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'لم يتم العثور على أية إعلانات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'غير فعال');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'تحديد مستوى');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'الشريط الجانبي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'حدد صفحة أو أدخل رابطا إلى موقعك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'قصة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'الحد الأقصى لعدد لا يمكن أن يتجاوز 20 ملفات في وقت واحد!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'تمت إضافة حالتك بنجاح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'إنشاء حالة جديدة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'برعاية');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'تم إرسال الإشعار بنجاح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'آخر اخفاء');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'سيتم النظر في طلب التحقق قريبا!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'التحقق من الملف الشخصي!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'تهانينا تم التحقق من ملفك الشخصي!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'تحميل المستندات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'يرجى تحميل صورة مع جواز سفرك / إد & أمب؛ صورتك المميزة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'جواز السفر / بطاقة الهوية');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'صورتك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'يرجى تحديد جواز السفر / معرف والصورة!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'يجب أن تكون صورة الجواز / الصورة صورة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'يجب أن تكون صورة المستخدم صورة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'تم إرسال طلبك بنجاح، في المستقبل القريب جدا سوف ننظر فيه!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'مشترك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'تمت إضافة المشاركة بنجاح إلى المخطط الزمني!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'مهم!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'يرجى ملاحظة أنه في حالة تغيير اسم المستخدم، فستفقد التحقق');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'الذين يمكن أن نرى أصدقائي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'أضافك مشرف الصفحة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'أضافك مشرف المجموعة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'لا توجد رسائل حتى الآن.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'تم حذف المحادثة!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'قريب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'أفراد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'خروج من المجموعة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'تاريخ واضح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'أعضاء المجموعة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'إضافة مشارك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'إلغاء التقرير');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'الإبلاغ عن هذا المستخدم');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'الإبلاغ عن هذه الصفحة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'الإبلاغ عن هذه المجموعة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'لقد قيمت هذه الصفحة من قبل!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'تقييم');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'التعليقات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'معدل');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'اكتب مراجعتك.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'تم حفظ إعلانك بنجاح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'تمت إضافة إعلانك بنجاح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'يجب أن تكون صورة الإعلانات صورة!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'الرجاء إدخال وصف صالح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'يرجى إدخال عنوان صالح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'الرجاء إدخال رابط صالح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'الرجاء إدخال اسم شركة صالح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'أم');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'الآب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'ابنة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'ابن');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'أخت');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'شقيق');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'عمة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'اخو الام');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'ابنة الاخ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'ابن أخ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'ابن عم (أنثى)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'ابن عم (ذكور)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'جدة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'جد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'حفيدة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'حفيد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'مثل اختي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'أخ غير شقيق');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'زوجة الأب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'زوج الأم');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'ربيبة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'أخت الزوج أو اخت الزوجة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'شقيق الزوج');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'حماة " أم الزوج أو أم الزوجة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'ووالد بالتبنى');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'ابنة بالنسب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'ابنه قانونياً');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'الأخوة (محايدة جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'الوالد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'الطفل (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'شقيق الوالد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'طفل الأخوة (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'ابن عم (محايدة جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'الجد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'حفيد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'أخوة الخطوة (محايدة جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'الخطوة الوالد (محايدة جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'ستيبشيلد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'شقيق الزوج (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'الوالد (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'صهر الطفل (محايد جنسانيا)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'إضافة إلى الأسرة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'قبول');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'عضو الأسرة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'أفراد الأسرة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'أضفه ك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'هل تريد بالتأكيد إزالة هذا العضو من عائلتك؟');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'تمت إضافة عضو جديد بنجاح إلى قائمة عائلتك!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'تم إرسال طلبك بنجاح!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'قبلت طلبك ليكون الخاص بك @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'المدرجة لك كما له @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'طلبات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'لم يتم العثور على أية طلبات!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'في العلاقات مع');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'متزوج من');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'مخطوب ل');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'الحالة الاجتماعية');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'طلب العلاقة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'قبل طلبك @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'رفض طلب علاقتك @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'خطأ في حجم الملف: يتجاوز الملف الحد المسموح به ({file_size}) ولا يمكن تحميله.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'تعذر تحميل ملف: نوع الملف هذا غير متوافق.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'سنوات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'العثور على الأصدقاء في مكان قريب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'مسافة الموقع');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'قريب منك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'البحث عن أصدقاء');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'مسافه: بعد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'المسافة منك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'إظهار الموقع');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Portemonnee');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Bedrijf');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'bod');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'klikken');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Publiek');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Selecteer een afbeelding');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mijn balans');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Herstel mijn saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'voortzetten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Uw saldo is aangevuld door');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Reclame');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Weet u zeker dat u deze advertentie wilt verwijderen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Verwijder advertentie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Geen advertenties gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Niet actief');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Plaatsing');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'sidebar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Selecteer een pagina of voer een link in op uw site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Verhaal');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Het maximaal aantal kan niet meer dan 20 bestanden tegelijkertijd overschrijden!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Uw status is succesvol toegevoegd!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Maak een nieuwe status aan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsored');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Uw melding is succesvol verzonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Verberg post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Uw verificatieaanvraag zal binnenkort worden overwogen!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verificatie van het profiel!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Gefeliciteerd, uw profiel is geverifieerd!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Documenten uploaden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Upload een foto met uw paspoort / ID & amp; Jouw eigen foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Paspoort / ID kaart');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Je foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Selecteer alstublieft uw paspoort / id en foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'De paspoort / id foto moet een afbeelding zijn');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'De gebruikersfoto moet een afbeelding zijn');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Uw aanvraag is succesvol verzonden, in de nabije toekomst zullen we het overwegen!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'gedeelde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Post is succesvol toegevoegd aan je tijdlijn!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Belangrijk!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Houd er rekening mee dat als u de gebruikersnaam wijzigt, u de verificatie verliest');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Wie kan mijn vrienden zien');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Toegevoegd u pagina admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Toegevoegd je groep admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Nog geen berichten hier.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Conversatie is verwijderd!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Dichtbij');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'leden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Exitgroep');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Geschiedenis wissen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Groepsleden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Voeg deelnemer toe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Annuleren rapport');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Rapporteer deze gebruiker');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Meld deze pagina aan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Meld deze groep aan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'U heeft deze pagina al beoordeeld!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Beoordeling');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'beoordelingen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'tarief');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Schrijf je beoordeling.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Uw advertentie is succesvol opgeslagen!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Uw advertentie is succesvol toegevoegd!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'De advertentie foto moet een afbeelding zijn!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Vul alstublieft een geldige omschrijving in!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Vul alstublieft een geldige titel in!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Vul alstublieft een geldige link in!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Vul alstublieft een geldige bedrijfsnaam in!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Moeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Vader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Dochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Zoon');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Zus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Broer');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Oom');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Nicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Neef');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Neef (vrouwelijk)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Neef)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Grootmoeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Grootvader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Kleindochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Kleinzoon');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Stiefzuster');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'stiefbroeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stiefmoeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Stiefvader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Stiefdochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Schoonzuster');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Zwager');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Schoonmoeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Schoonvader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Schoondochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Schoonzoon');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Broers en zussen (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Ouder (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Kind (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Broers en zussen van ouder (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Kind van broer en zus (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Neef (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Grootouder (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Grootkind (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (gender neutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (gender neutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (gender neutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sibling-in-law (gender neutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Schoonmoeder (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Schoonzoon (geslachtsneutraal)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Voeg toe aan familie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Accepteren');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Familielid');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Familieleden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Toevoegen als');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Weet u zeker dat u dit lid van uw familie wilt verwijderen?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Nieuw lid is succesvol toegevoegd aan je familielijst!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Uw verzoek is succesvol verzonden!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Geaccepteerd uw verzoek om uw @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Heb je gezien als zijn @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'verzoeken');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Geen verzoeken gevonden!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'In relaties met');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Getrouwd met');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'verloofd met');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Relatie status');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Verzoek om relatie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Geaccepteerd uw aanvraag @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Heeft uw relatieverzoek geweigerd @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Bestandsgrootte fout: Het bestand overschrijdt de limiet toegestaan ​​({file_size}) en kan niet worden geüpload.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Kan een bestand niet uploaden: dit bestandstype wordt niet ondersteund.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'jaar oud');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Vind vrienden in de buurt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Locatie afstand');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'dicht bij jou');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Zoek vrienden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'afstand');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Afstand van jou');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Toon locatie');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Portefeuille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Compagnie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Enchère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Clics');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Public');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Sélectionnez une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mon solde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Récupérer mon solde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continuer');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Votre solde a été reconstitué par');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Publicité');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Êtes-vous sûr de vouloir supprimer cette annonce?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Supprimer lannonce');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Aucune annonce na été trouvée');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Pas actif');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Placement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barre latérale');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Sélectionnez une page ou entrez un lien vers votre site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Récit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Le nombre maximal ne peut pas dépasser 20 fichiers à la fois!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Votre statut a été ajouté avec succès!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Créer un nouvel état');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsorisé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Votre notification a été envoyée avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Masquer la publication');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Votre demande de vérification sera bientôt prise en considération!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Vérification du profil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Félicitations, votre profil est vérifié!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Télécharger des documents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Veuillez télécharger une photo avec votre passeport / ID & amp; Votre photo distincte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passeport / carte didentité');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Ta photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Sélectionnez votre passeport / id et photo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Limage passeport / id doit être une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Limage utilisateur doit être une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Votre demande a été envoyée avec succès, dans un avenir très proche, nous lexaminerons!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'partagé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Le message a été ajouté avec succès à votre calendrier!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Important!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Veuillez noter que si vous modifiez le nom dutilisateur, vous allez perdre la vérification');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Qui peut voir mes amis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'A ajouté votre page admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Ajoute ton administrateur de groupe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Aucun message n\'est encore ici.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'La conversation a été supprimée!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Fermer');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Membres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Groupe de sortie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Histoire claire');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Les membres du groupe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Ajouter un participant');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Annuler le rapport');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Signaler cet utilisateur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Signaler cette page');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Signaler ce groupe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Vous avez déjà noté cette page!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Évaluation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Avis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Taux');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Donnez votre avis.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Votre annonce a été enregistrée avec succès!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Votre annonce a été ajoutée avec succès!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'L\'image des publicités doit être une image!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Entrez une description valable!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Entrez un titre valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Veuillez entrer un lien valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Entrez un nom d\'entreprise valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Mère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Père');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Sœur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Frère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tata');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Oncle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Nièce');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Neveu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cousine)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cousin Male)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Grand-mère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Grand-père');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Petite fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Petit fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Demi-soeur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Beau-frère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stepmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Beau-père');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Belle fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Belle-soeur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Beau-frère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Belle-mère');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Beau-père');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Belle-fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Beau fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Sibling (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Parent (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Enfant (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Sibling of Parent (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Enfant de fratrie (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cousin (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Grandparent (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Petit-fils (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Échec-frère (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sage-frère (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Parent-en-loi (neutre pour le genre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Bien-être (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Ajouter à la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Acceptez');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membre de la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membres de la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Ajouter comme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Êtes-vous sûr de vouloir supprimer ce membre de votre famille?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Un nouveau membre a été ajouté avec succès à votre liste de famille!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Votre demande a été envoyée avec succès!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'A accepté votre demande pour être votre @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Vous l\'avez considéré comme son @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Demandes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Aucune demande trouvée!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'En relation avec');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Marié à');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Fiancé à');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Statut de la relation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Demande de relation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'A accepté votre demande @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rejeté votre demande de relation @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Erreur de taille de fichier: le fichier dépasse autorisé la limite ({image_fichier}) et ne peut pas être téléchargé.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Impossible de télécharger un fichier: ce type de fichier n\'est pas pris en charge.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'ans');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Trouver des amis à proximité');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Distance demplacement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'près de vous');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Trouver des amis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Distance de vous');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Afficher l\'emplacement');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Brieftasche');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Unternehmen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Bieten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Klicks');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Publikum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Wählen Sie ein Bild aus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mein Gleichgewicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Fülle meine Balance auf');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Fortsetzen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Ihr Gleichgewicht wurde ergänzt durch');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Werbung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Möchten Sie diese Anzeige wirklich löschen?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Anzeige löschen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Keine Anzeigen gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Nicht aktiv');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Platzierung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Seitenleiste');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Wählen Sie eine Seite aus oder geben Sie einen Link zu Ihrer Website ein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Geschichte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Die maximale Anzahl darf maximal 20 Dateien nicht überschreiten!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Ihr Status wurde erfolgreich hinzugefügt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Neuen Status anlegen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Gefördert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Ihre Benachrichtigung wurde erfolgreich gesendet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Beitrag ausblenden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Ihre Bestätigungsanforderung wird bald berücksichtigt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Überprüfung des Profils!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Herzlichen Glückwunsch, Ihr Profil wird bestätigt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Dokumente hochladen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Bitte laden Sie ein Foto mit Ihrem Pass / ID & amp; Ihr eigenes Foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pass / ID-Karte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Dein Foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Bitte wählen Sie Ihren Pass / id und Foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Das Pass / id Bild muss ein Bild sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Das Benutzerbild muss ein Bild sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Ihre Anfrage wurde erfolgreich gesendet, in naher Zukunft werden wir es betrachten!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Geteilt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Post wurde erfolgreich zu deinem Zeitplan hinzugefügt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Wichtig!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Bitte beachten Sie, dass Sie bei der Änderung des Benutzernamens die Bestätigung verlieren');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Wer kann meine Freunde sehen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Fügte Ihnen die Seite admin hinzu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Fügte Ihnen gruppe admin hinzu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Noch keine Nachrichten.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Konversation wurde gelöscht!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Schließen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Mitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Exit-Gruppe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Geschichte löschen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Gruppenmitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Teilnehmer hinzufügen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Bericht abbrechen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Diesen Nutzer melden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Diese Seite melden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Diese Gruppe melden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Sie haben diese Seite bereits bewertet!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Bewertung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Bewertungen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Preis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Schreiben Sie eine Bewertung.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Ihre Anzeige wurde erfolgreich gespeichert!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Ihre Anzeige wurde erfolgreich hinzugefügt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'Das Anzeigenbild muss ein Bild sein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Bitte geben Sie eine gültige Beschreibung ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Bitte geben Sie einen gültigen Titel ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Bitte geben Sie einen gültigen Link ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Bitte geben Sie einen gültigen Firmennamen ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Mutter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Vater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Tochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Sohn');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Schwester');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Bruder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Onkel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Nichte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Neffe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cousine)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cousin)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Oma');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Großvater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Enkelin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Enkel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Stiefschwester');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Stiefbruder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stiefmutter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Stiefvater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Stieftochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Schwägerin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Schwager');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Schwiegermutter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Schwiegervater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Schwiegertochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Schwiegersohn');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Geschwister (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Elternteil (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Kind (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Geschwister der Eltern (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Kind des Geschwisters (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cousin (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Großeltern (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Enkelkind (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Schritt-Geschwister (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Schritt-Elternteil (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Schwangerschaft (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Schwiegertochter (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Schwiegervater (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Zu Familie hinzufügen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Akzeptieren');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Familienmitglied');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Familienmitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Hinzufügen Als');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Sind Sie sicher, dass Sie dieses Mitglied aus Ihrer Familie entfernen möchten?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Neues Mitglied wurde erfolgreich zu Ihrer Familienliste hinzugefügt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Ihre Anfrage wurde erfolgreich gesendet!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Akzeptiert Ihre Anfrage zu Ihrem @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listed Sie als seine @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Anfragen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Keine Anfragen gefunden!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Im Zusammenhang mit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Verheiratet mit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'verlobt mit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Beziehungsstatus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Beziehungsanfrage');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Akzeptiert Ihre Anfrage @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Abgelehnt Ihre Beziehung Anfrage @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Dateigrößenfehler: Die Datei überschreitet die Begrenzung ({file_size}) und kann nicht hochgeladen werden.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Kann eine Datei nicht hochladen: Dieser Dateityp wird nicht unterstützt.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'Jahre alt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Freunde in der Nähe finden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Standortabstand');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'nah bei dir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Freunde finden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'Entfernung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Entfernung von Ihnen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Lage anzeigen');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Portafoglio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Azienda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'offerta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'clic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Pubblico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Selezionare unimmagine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Il mio equilibrio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Riempire il mio equilibrio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continua');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Il tuo equilibrio è stato riempito da');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Pubblicità');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Sei sicuro di voler cancellare questo annuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Elimina annuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Nessun annuncio trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Non attivo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Posizionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Sidebar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Seleziona una pagina o inserisci un link al tuo sito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Storia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Il numero massimo non può superare 20 file alla volta!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Il tuo stato è stato aggiunto con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Crea nuovo stato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'sponsorizzati');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'La tua notifica è stata inviata correttamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Nascondi post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'La tua richiesta di verifica sarà presto presa in considerazione!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verifica del profilo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Complimenti il ​​tuo profilo è verificato!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Carica i documenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Carica una foto con il tuo passaporto / ID & amp; La tua foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passaporto / id carta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'La tua foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Seleziona il tuo passaporto / id e foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Limmagine del passaporto / id deve essere unimmagine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Limmagine dellutente deve essere unimmagine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'La tua richiesta è stata inviata con successo, nel prossimo futuro lo considereremo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'diviso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Lalberino è stato aggiunto con successo alla tua timeline!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Si prega di notare che se si modifica il nome utente perderà la verifica');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Chi può vedere i miei amici');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Aggiunto l\'amministratore di pagina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Ha aggiunto l\'amministratore di gruppo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Non ci sono ancora messaggi qui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'La conversazione è stata cancellata!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Vicino');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Utenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Esci dal gruppo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Cancellare la cronologia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Membri del gruppo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Aggiungi partecipante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Annulla rapporto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Segnala questo utente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Segnala questa pagina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Segnala questo gruppo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Hai già valutato questa pagina!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Valutazione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Recensioni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Vota');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Scrivi la tua recensione.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Il tuo annuncio è stato salvato con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Il tuo annuncio è stato aggiunto con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'L\'immagine degli annunci deve essere un\'immagine!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Inserisci una descrizione valida!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Si prega di inserire un titolo valido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Inserisci un link valido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Inserisci un nome aziendale valido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Madre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Padre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Figlia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Figlio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Sorella');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Fratello');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Auntie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Zio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Nipote');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Nipote');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cugina)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cugino maschio)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Nonna');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Nonno');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Nipotina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Nipote');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Sorellastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Fratellastro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Matrigna');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Patrigno');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Figliastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Cognata');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Cognato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Suocera');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Suocero');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Nuora');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Genero');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Fidanzamento (genere neutro)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Genitore (genere neutro)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Bambino (sesso neutro)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Fratellanza del genitore (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Bambino di fratelli (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cugino (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Nonno (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Nipote (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (genere neutro)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sibling-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Genitore di sesso (neutralità di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Suono (neutrale di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Aggiungi alla famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Accettare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membro della famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membri della famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Aggiungi come');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Sei sicuro di voler rimuovere questo membro dalla tua famiglia?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Nuovo membro è stato aggiunto con successo alla tua lista di famiglia!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'La tua richiesta è stata inviata con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Accettato la tua richiesta per essere il tuo @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Ti ha elencato come suo @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'richieste');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Nessuna richiesta trovata!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Nelle relazioni con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Sposato con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'fidanzato con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'stato delle relazioni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Richiesta di relazione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Accettato la tua richiesta @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Ha respinto la tua richiesta di relazione @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Errore di dimensione del file: il file supera il limite consentito ({file_size}) e non può essere caricato.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Impossibile caricare un file: questo tipo di file non è supportato.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'Anni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Trova amici nelle vicinanze');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Distanza della posizione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'vicino a te');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Trova amici');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distanza');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Distanza da te');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Mostra la posizione');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Carteira');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Empresa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Licitação');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Cliques');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Público');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Selecione uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Meu saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Reabasteça meu saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continuar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Seu saldo foi reabastecido por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Publicidade');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Tem certeza de que quer apagar este anúncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Eliminar anúncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Nenhum anúncio encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Não ativo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Colocação');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barra Lateral');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Selecione uma página ou insira um link para o seu site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'História');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'O número máximo não pode exceder 20 arquivos de cada vez!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Seu status foi adicionado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Criar novo status');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Patrocinadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Sua notificação foi enviada com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Ocultar postagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Seu pedido de verificação em breve será considerado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verificação do perfil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Parabéns seu perfil está verificado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Carregar documentos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Carregue uma foto com seu passaporte / ID & amp; Sua foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passaporte / cartão de identificação');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Sua foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Selecione seu passaporte / id e foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'A imagem de passaporte / id deve ser uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'A imagem do usuário deve ser uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Seu pedido foi enviado com sucesso, no futuro muito próximo, vamos considerá-lo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Compartilhado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'O post foi adicionado com sucesso à sua linha de tempo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Observe que se você alterar o nome de usuário, você perderá a verificação');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Quem pode ver meus amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Adicionou você admin da página');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Adicionou você administrador do grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Ainda não há mensagens aqui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'A conversa foi excluída!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Fechar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Membros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Grupo de saída');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Apagar o histórico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Membros do grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Adicionar participante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancelar relatório');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Denunciar este usuário');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Informe esta página');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Denunciar este grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Você já avaliou esta página!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Avaliação');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Rever');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Taxa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Escreva sua revisão.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Seu anúncio foi salvo com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Seu anúncio foi adicionado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'A imagem dos anúncios deve ser uma imagem!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Digite uma descrição válida!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Digite um título válido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Digite um link válido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Digite um nome válido da empresa!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Mãe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Pai');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Filha');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Filho');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Irmã');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Irmão');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Tio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Sobrinha');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Sobrinho');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Prima)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Primo)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Avó');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Avô');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Neta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Neto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Meia-irmã');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Meio-irmão');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Madrasta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Padrasto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Enteada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Cunhada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Cunhado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Sogra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Sogro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Nora');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Genro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Irmão (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Pais (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Criança (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Sibling of Parent (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Criança do irmão (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Primo (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Avós (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Neto (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Irmão-irmão (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Etapa-pai (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Irmão-irmão (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Sogro (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Nora (neutro em termos de gênero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Adicionar à família');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Aceitar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membro da família');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membros da família');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Adicionar como');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Tem certeza de que deseja remover esse membro da sua família?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Novo membro foi adicionado com sucesso à sua lista de família!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Seu pedido foi enviado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Aceitou seu pedido para ser seu @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listou você como seu @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'solicitações de');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Não foram encontrados pedidos!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Em relação com');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Casado com');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'noivo de');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'status de relacionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Pedido de relacionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Aceitou seu pedido @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rejeitou sua solicitação de relacionamento @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Erro de tamanho de arquivo: o arquivo excede permitido o limite ({file_size}) e não pode ser carregado.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Não é possível carregar um arquivo: esse tipo de arquivo não é suportado.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'anos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Encontre amigos nas proximidades');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Distância de localização');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'perto de você');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Encontrar amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distância');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Distância de você');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Mostrar localização');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Бумажник');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Компания');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'торги');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'щелчки');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Веб-сайт');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Аудитория');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Выберите изображение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Мой баланс');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Пополнить баланс');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Продолжить');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Ваш баланс был пополнен');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Реклама');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Вы уверены, что хотите удалить эту рекламу');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Удалить объявление');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Объявления не найдены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Не активен');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'размещение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Боковая панель');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Выберите страницу или введите ссылку на свой сайт');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'История');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Максимальное число не может превышать 20 файлов за раз!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Ваш статус успешно добавлен!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Создать новый статус');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Рекламные');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Ваше уведомление отправлено успешно');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Скрыть сообщение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Ваш запрос на подтверждение скоро будет рассмотрен!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Проверка профиля!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Поздравляем Ваш профиль проверен!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Загрузить документы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Пожалуйста, загрузите фотографию с вашим паспортом / ID и amp; Твоя отличная фотография');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Паспорт / удостоверение личности');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Твое фото');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Выберите свой паспорт / удостоверение личности и фото!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Паспорт / идентификатор должен быть изображением');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Изображение пользователя должно быть изображением');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Ваш запрос был успешно отправлен, в самом ближайшем будущем мы это рассмотрим!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Поделился');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Сообщение было успешно добавлено на ваш график!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Важно!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Обратите внимание, что если вы измените имя пользователя, вы потеряете подтверждение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Кто может видеть моих друзей');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Добавлено администратором страницы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Добавлен администратор группы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Пока сообщений нет.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Разговор удален!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Закрыть');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'члены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Группа выхода');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Удалить переписку');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Участники группы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Добавить участника');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Отменить отчет');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Сообщить об этом пользователе');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Сообщить об этой странице');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Сообщить об этой группе');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Вы уже оценили эту страницу!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Рейтинг');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Отзывы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Ставка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Напишите свой отзыв.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Ваше объявление успешно сохранено!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Ваше объявление было успешно добавлено!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'Изображение объявления должно быть изображением!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Введите действительное описание!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Введите действительный заголовок!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Пожалуйста, введите действующую ссылку!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Укажите действительное название компании!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Мама');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Отец');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Дочь');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Сын');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Сестра');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Брат');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'тетушка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Дядя');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Племянница');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Племянник');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Двоюродная сестра)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Двоюродный брат)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Бабушка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Дед');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Внучка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Внук');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Сводная сестра');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Сводный брат');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Мачеха');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Отчим');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Падчерица');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Золовка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Шурин');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Свекровь');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Тесть');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Невестка');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Зять');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Сиблинг (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Родитель (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Ребенок (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Братство родителей (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Ребенок Сиблинга (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Кузен (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Бабушка и дедушка (гендерный нейтраль)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Внуки (гендерно нейтральные)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Пошаговый (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Сиблинг в законе (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Зять (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Тед (гендерно нейтральный)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Добавить в подборку');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'принимать');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Член семьи');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Члены семьи');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Добавить как');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Вы уверены, что хотите удалить этого участника из своей семьи?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Новый член был успешно добавлен в список ваших семей!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Ваш запрос был успешно отправлен!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Принял ваш запрос как ваш @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Перечислил вас как его @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Запросы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Запросов не найдено!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'В отношениях с');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'В браке с');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Помолвлены с');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Семейное положение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Запрос на отношении');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Принял(а) ваш запрос @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Отклонил(a) ваш запрос отношения @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Ошибка размера файла: файл превышает допустимый предел ({file_size}) и не может быть загружен.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Не удалось загрузить файл. Этот тип файла не поддерживается.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'лет');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Найти друзей поблизости');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Месторасположение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'близко к тебе');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Найти друзей');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'расстояние');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Расстояние от вас');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Показать на карте');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Billetera');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Empresa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Ofertas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Clics');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Audiencia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Seleccione una imagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mi balance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Reponer mi saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continuar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Tu saldo ha sido reabastecido por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Publicidad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Estás seguro de que quieres eliminar esta publicidad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Eliminar anuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'No se han encontrado anuncios');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'No activo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Colocación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barra lateral');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Seleccione una página o ingrese un enlace a su sitio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Historia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', '¡El número máximo no puede superar los 20 archivos a la vez!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', '¡Tu estado se ha agregado correctamente!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Crear nuevo estado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Patrocinado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Tu notificación se ha enviado correctamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Esconder la publicación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Su solicitud de verificación pronto será considerada!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verificación del perfil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', '¡Felicidades tu perfil está verificado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Subir documentos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Cargue una foto con su pasaporte / ID & amp; Tu foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pasaporte / tarjeta de identificación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Tu foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Por favor, seleccione su pasaporte / identificación y foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'La imagen del pasaporte / id debe ser una imagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'La imagen del usuario debe ser una imagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Su solicitud fue enviada con éxito, en un futuro muy próximo lo consideraremos!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Compartido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', '¡Se ha agregado el mensaje a tu línea de tiempo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', '¡Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Tenga en cuenta que si cambia el nombre de usuario, perderá la verificación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', '¿Quién puede ver a mis amigos?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Agregó tu página admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Agregó tu grupo de administración');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Aún no hay mensajes.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', '¡Se ha eliminado la conversación!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Cerca');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Miembros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Salir del grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Borrar historial');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Miembros del grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Añada participante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancelar informe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Reportar a este usuario');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Informar sobre esta página');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Reportar este grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', '¡Ya has calificado esta página!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Clasificación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Comentarios');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Tarifa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Escribe tu reseña.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Tu anuncio se ha guardado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Su anuncio se ha agregado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', '¡La imagen de los anuncios debe ser una imagen!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Por favor ingrese una descripción válida!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', '¡Por favor ingrese un título válido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Ingrese un enlace válido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Introduzca un nombre de empresa válido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Madre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Padre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Hija');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Hijo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Hermana');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Hermano');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tía');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Tío');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Sobrina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Sobrino');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Prima)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Primo varón)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Abuela');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Abuelo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Nieta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Nieto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Hermanastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Hermanastro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Madrastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Padrastro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Hijastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Cuñada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Cuñado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Suegra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Suegro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Hijastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Yerno');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Hermano (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Padre (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Niño (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Hermano de padre (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Hijo de hermano (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Primo (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Abuelo (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Nieto (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Hermanastro (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'El padrastro (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Cuñados (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Suegro (neutral de género)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Niño (s) (género neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Añadir a la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Aceptar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Miembro de la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Miembros de la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Agregar como');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', '¿Estás seguro de que deseas eliminar este miembro de tu familia?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', '¡El nuevo miembro se agregó a su lista de familia!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', '¡Su solicitud ha sido enviada correctamente!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Aceptado su solicitud para ser su @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listado como su @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Peticiones');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'No se han encontrado solicitudes!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'En las relaciones con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Casado con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'comprometido con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'estado civil');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Solicitud de relación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Aceptado su solicitud @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rechazó su solicitud de relación @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Error de tamaño de archivo: El archivo excede el límite permitido ({file_size}) y no se puede cargar.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'No se puede cargar un archivo: este tipo de archivo no es compatible.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'años');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Encuentra amigos cercanos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Ubicación distancia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'cerca de usted');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Encontrar amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distancia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Distancia de ti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Mostrar ubicación');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Cüzdan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'şirket');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'teklif verme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Tıklanma');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'URL');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'seyirci');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Bir resim seçin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Bakiyem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Bakiyemi yenile');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Devam et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Bakiyeniz, tarafından yeniden dolduruldu.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Ilan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Bu reklamı silmek istediğinizden emin misiniz');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Reklamı sil');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Hiç ilan bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Aktif değil');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Yerleştirme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Kenar çubuğu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Bir sayfa seçin veya sitenize bir bağlantı girin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Öykü');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Maksimum sayı, aynı anda 20 dosya aşamaz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Durumunuz başarıyla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Yeni Durum Oluştur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Bildiriminiz başarıyla gönderildi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Postayı gizle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Doğrulama isteğiniz yakında değerlendirilecek!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Profilin doğrulanması!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Tebrikler, profiliniz doğrulandı!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Belgeleri yükle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Lütfen pasaportunuzla bir fotoğraf yükleyin / kimliği ve amp; Farklı fotoğrafın');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pasaport / kimlik kartı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Senin resmin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Lütfen pasaportunuzun / kimlik numaranızı ve fotoğrafınızı seçin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Pasaport / id resmi bir resim olmalıdır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Kullanıcı resmi bir resim olmalıdır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'İsteğiniz başarıyla gönderildi, çok yakın bir zamanda bunu düşünüyoruz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Paylaşılan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Mesaj, zaman çizelgesine başarıyla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Önemli!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Kullanıcı adını değiştirirseniz doğrulamayı kaybedeceğinizi lütfen unutmayın');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Arkadaşlarımı kim görebilir?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Size sayfa admin ekledi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Grup yöneticisi ekledi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Henüz mesaj yok.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'İleti dizisi silindi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Kapat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Üyeler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Grubundan çık');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Geçmişi temizle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Grup üyeleri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Katılımcı ekle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Raporu İptal Et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Bu kullanıcıyı rapor et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Bu sayfayı bildir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Bu Grubu Rapor Et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Bu sayfaya zaten puan verdiniz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Değerlendirme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'yorumlar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'oran');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Yorumunuzu yazın.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Reklamınız başarıyla kaydedildi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Reklamınız başarıyla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'Reklam resimleri bir resim olmalıdır!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Lütfen geçerli bir açıklama girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Lütfen geçerli bir başlık girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Lütfen geçerli bir bağlantı girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Lütfen geçerli bir şirket adı girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'anne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Kız evlat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Oğul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Kız kardeş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Erkek kardeş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'teyzeciğim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Amca dayı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Yeğen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Erkek yeğen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Kuzenim (kadın)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Erkek kuzen)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'büyükanne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Büyük baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Kız torun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Erkek torun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Üvey kızkardeş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Üvey erkek kardeş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'üvey anne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'üvey baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'üvey kız');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Baldız');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Kayınbirader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Kayınvalide');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Kayınpeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Gelin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Damat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Kardeşlik (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Ebeveyn (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Çocuk (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Ebeveynin Kardeşliği (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Kardeşlik çocuğu (cinsiyete dayalı tarafsız)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Kuzenim (cinsiyete aykırı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Büyükbaba (cinsiyet eşitliği yok)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Torun (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Adım kardeş (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Veli-ebeveyn (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Üvey çocuk (cinsiyete aykırı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Kayın üstü (cinsiyete dayalı)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Kayınvalides (cinsiyet eşitli değil)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Kayın-kuşun (cinsiyet eşitli)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Ailenize ekleyin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Kabul etmek');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Aile üyesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Aile üyeleri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Olarak ekle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Bu üyeyi ailenden kaldırmak istediğinizden emin misiniz?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Yeni üye, aileniz listesine başarıyla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Talebiniz başarıyla gönderildi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', '@ Olmak isteğinizi kabul ettiniz');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Seni onun @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'İstekler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'İstek bulunamadı!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Ile ilişkilerinde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Evli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Etkileşim kurdu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'ilişki durumu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Ilişki talebi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'İsteğiniz kabul edildi @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Ilişki isteğini reddetti @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Dosya boyutu hatası: Dosya limiti aştı ({file_size}) ve yüklenemiyor.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Dosya yüklenemiyor: Bu dosya türü desteklenmiyor.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'yaşında');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Yakınlarda arkadaş bul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Yer mesafesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'sana yakın');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Arkadaşları bul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'mesafe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Senden uzaklık');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Yeri göster');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Wallet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Company');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Bidding');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Clicks');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Audience');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Select an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'My balance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Replenish my balance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continue');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Your balance has been replenished by');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Advetising');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Are you sure you want to delete this ad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Delete ad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'No ads found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Not active');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Placement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Sidebar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Select a page or enter a link to your site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Story');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'The maximum number can not exceed 20 files at a time!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Your status has been successfully added!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Create New Status');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsored');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Your notification has been sent successfully');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Hide post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Your verification request  soon will be considered!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verification of the profile!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Congratulations your profile is verified!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Upload documents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Please upload a photo with your passport / ID  & your distinct photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passport / id card');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Your photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Please select your passport/id and photo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'The passport/id picture must be an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'The user picture must be an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Your request was successfully sent, in the very near future we will consider it!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'shared');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Post was successfully added to your timeline!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Important!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Please note that if you change the username you will lose verification');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Who can see my friends?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'added you page admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'added you group admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'No messages yet here.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Conversation has been deleted!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Close');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Exit group');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Clear history');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Group members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Add participant');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancel Report');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Report this User');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Report this Page');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Report this Group');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'You have already rated this page!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Rating');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Reviews');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Rate');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Write your review.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Your ad has been successfully saved!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Your ad has been successfully added!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'The ads picture must be an image!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Please enter a valid description!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Please enter a valid title!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Please enter a valid link!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Please enter a valid company name!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Mother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Father');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Daughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Son');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Sister');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Brother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Auntie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Uncle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Niece');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Nephew');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cousin (female)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cousin (male)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Grandmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Grandfather');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Granddaughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Grandson');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Stepsister');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Stepbrother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stepmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Stepfather');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Stepdaughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Sister-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Brother-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Mother-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Father-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Daughter-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Son-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Child (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Sibling of Parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Child of Sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cousin (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Grandparent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Grandchild (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sibling-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Parent-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Child-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Add to family');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Accept');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Family Member');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Family members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Add as');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Are you sure that you want to remove this member from your family?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'New member was successfully added to your family list!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Your request was successfully sent!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Accepted your request to be your @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listed you as his @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Requests');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'No requests found!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'In relations with ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Married to ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Engaged to ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Relationship Status ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Relationship request ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Accepted your request @ ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'rejected your relation request @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'File size error: The file exceeds allowed the limit ({file_size}) and can not be uploaded.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Unable to upload a file: This file type is not supported.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'years old');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Find friends nearby');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Location distance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'close to you');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Find Friends');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'distance from you');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Show location');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'Wallet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', 'Company');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Bidding');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Clicks');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Audience');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Select an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'My balance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Replenish my balance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continue');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Your balance has been replenished by');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Advetising');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Are you sure you want to delete this ad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Delete ad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'No ads found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Not active');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Placement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Sidebar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Select a page or enter a link to your site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Story');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'The maximum number can not exceed 20 files at a time!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Your status has been successfully added!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Create New Status');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsored');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Your notification has been sent successfully');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Hide post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Your verification request  soon will be considered!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verification of the profile!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Congratulations your profile is verified!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Upload documents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Please upload a photo with your passport / ID  & your distinct photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passport / id card');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Your photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Please select your passport/id and photo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'The passport/id picture must be an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'The user picture must be an image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Your request was successfully sent, in the very near future we will consider it!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'shared');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Post was successfully added to your timeline!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Important!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Please note that if you change the username you will lose verification');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Who can see my friends?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'added you page admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'added you group admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'No messages yet here.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Conversation has been deleted!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Close');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Exit group');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Clear history');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Group members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Add participant');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancel Report');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Report this User');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Report this Page');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Report this Group');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'You have already rated this page!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Rating');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Reviews');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Rate');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Write your review.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Your ad has been successfully saved!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Your ad has been successfully added!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'The ads picture must be an image!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Please enter a valid description!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Please enter a valid title!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Please enter a valid link!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Please enter a valid company name!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Mother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Father');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Daughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Son');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Sister');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Brother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Auntie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Uncle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Niece');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Nephew');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cousin (female)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cousin (male)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Grandmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Grandfather');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Granddaughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Grandson');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Stepsister');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Stepbrother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stepmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Stepfather');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Stepdaughter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Sister-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Brother-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Mother-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Father-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Daughter-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Son-in-law');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Child (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Sibling of Parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Child of Sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cousin (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Grandparent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Grandchild (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sibling-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Parent-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Child-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Add to family');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Accept');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Family Member');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Family members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Add as');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Are you sure that you want to remove this member from your family?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'New member was successfully added to your family list!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Your request was successfully sent!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Accepted your request to be your @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listed you as his @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Requests');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'No requests found!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'In relations with ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Married to ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Engaged to ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Relationship Status ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Relationship request ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Accepted your request @ ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'rejected your relation request @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'File size error: The file exceeds allowed the limit ({file_size}) and can not be uploaded.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Unable to upload a file: This file type is not supported.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'years old');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Find friends nearby');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Location distance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'close to you');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Find Friends');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distance');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'distance from you');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Show location');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.5!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();