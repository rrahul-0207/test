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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', '?????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', '?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', '?????????? ???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', '?????? ?????????? ?????????? ?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', '???? ?????? ?????????? ?????? ???????? ?????? ?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', '?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', '???? ?????? ???????????? ?????? ?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', '?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', '?????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', '???????????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', '?????? ???????? ???? ???????? ?????????? ?????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', '???????? ???????????? ???????? ???? ???????? ???? ???????????? 20 ?????????? ???? ?????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', '?????? ?????????? ?????????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', '?????????? ???????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', '???? ?????????? ?????????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', '?????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', '???????? ?????????? ???? ?????? ???????????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', '???????????? ???? ?????????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', '?????????????? ???? ???????????? ???? ???????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', '?????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', '???????? ?????????? ???????? ???? ???????? ???????? / ???? & ???????? ?????????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', '???????? ?????????? / ?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', '???????? ?????????? ???????? ?????????? / ???????? ??????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', '?????? ???? ???????? ???????? ???????????? / ???????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', '?????? ???? ???????? ???????? ???????????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', '???? ?????????? ???????? ???????????? ???? ???????????????? ???????????? ?????? ?????? ???????? ??????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', '?????? ?????????? ???????????????? ?????????? ?????? ???????????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', '??????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', '???????? ???????????? ?????? ???? ???????? ?????????? ?????? ?????????????????? ???????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', '?????????? ???????? ???? ?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', '?????????? ???????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', '?????????? ???????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', '???? ???????? ?????????? ?????? ????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', '???? ?????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', '???????? ???? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', '?????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', '?????????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', '?????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', '?????????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', '?????????????? ???? ?????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', '?????????????? ???? ?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', '?????????????? ???? ?????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', '?????? ???????? ?????? ???????????? ???? ??????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', '???????? ??????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', '???? ?????? ???????????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', '?????? ?????????? ???????????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', '?????? ???? ???????? ???????? ?????????????????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', '???????????? ?????????? ?????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', '???????? ?????????? ?????????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', '???????????? ?????????? ???????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', '???????????? ?????????? ?????? ???????? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', '????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', '?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', '???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', '?????? ????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', '?????? ???? (????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', '?????? ???? (????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', '????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', '?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', '???? ?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', '???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', '?????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', '?????? ?????????? ???? ?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', '???????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', '???????? " ???? ?????????? ???? ???? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', '?????????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', '???????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', '???????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', '???????????? (???????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', '???????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', '?????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', '???????? ???????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', '?????? ???????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', '?????? ???? (???????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', '???????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', '???????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', '???????? ???????????? (???????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', '???????????? ???????????? (???????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', '???????????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', '???????? ?????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', '???????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', '?????? ?????????? (?????????? ??????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', '?????????? ?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', '?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', '?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', '???????? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', '???? ???????? ???????????????? ?????????? ?????? ?????????? ???? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', '?????? ?????????? ?????? ???????? ?????????? ?????? ?????????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', '???? ?????????? ???????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', '???????? ???????? ?????????? ?????????? ???? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', '?????????????? ???? ?????? ???? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', '???? ?????? ???????????? ?????? ?????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', '???? ???????????????? ????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', '?????????? ????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', '?????????? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', '???????????? ????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', '?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', '?????? ???????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', '?????? ?????? ???????????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', '?????? ???? ?????? ??????????: ???????????? ?????????? ???????? ?????????????? ???? ({file_size}) ?????? ???????? ????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', '???????? ?????????? ??????: ?????? ?????????? ?????? ?????? ????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', '???????????? ?????? ???????????????? ???? ???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', '?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', '???????? ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', '?????????? ???? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', '??????????: ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', '?????????????? ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', '?????????? ????????????');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Bestandsgrootte fout: Het bestand overschrijdt de limiet toegestaan ??????({file_size}) en kan niet worden ge??pload.');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Ench??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Clics');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'Public');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'S??lectionnez une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mon solde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'R??cup??rer mon solde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continuer');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Votre solde a ??t?? reconstitu?? par');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Publicit??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', '??tes-vous s??r de vouloir supprimer cette annonce?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Supprimer lannonce');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Aucune annonce na ??t?? trouv??e');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Pas actif');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Placement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barre lat??rale');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'S??lectionnez une page ou entrez un lien vers votre site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'R??cit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Le nombre maximal ne peut pas d??passer 20 fichiers ?? la fois!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Votre statut a ??t?? ajout?? avec succ??s!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Cr??er un nouvel ??tat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsoris??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Votre notification a ??t?? envoy??e avec succ??s');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Masquer la publication');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Votre demande de v??rification sera bient??t prise en consid??ration!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'V??rification du profil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'F??licitations, votre profil est v??rifi??!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'T??l??charger des documents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Veuillez t??l??charger une photo avec votre passeport / ID & amp; Votre photo distincte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passeport / carte didentit??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Ta photo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'S??lectionnez votre passeport / id et photo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Limage passeport / id doit ??tre une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Limage utilisateur doit ??tre une image');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Votre demande a ??t?? envoy??e avec succ??s, dans un avenir tr??s proche, nous lexaminerons!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'partag??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Le message a ??t?? ajout?? avec succ??s ?? votre calendrier!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Important!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Veuillez noter que si vous modifiez le nom dutilisateur, vous allez perdre la v??rification');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Qui peut voir mes amis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'A ajout?? votre page admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Ajoute ton administrateur de groupe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Aucun message n\'est encore ici.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'La conversation a ??t?? supprim??e!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Vous avez d??j?? not?? cette page!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', '??valuation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Avis');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Taux');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Donnez votre avis.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Votre annonce a ??t?? enregistr??e avec succ??s!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Votre annonce a ??t?? ajout??e avec succ??s!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'L\'image des publicit??s doit ??tre une image!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Entrez une description valable!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Entrez un titre valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Veuillez entrer un lien valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Entrez un nom d\'entreprise valide!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'M??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'P??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'S??ur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Fr??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tata');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Oncle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Ni??ce');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Neveu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Cousine)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Cousin Male)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Grand-m??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Grand-p??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Petite fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Petit fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Demi-soeur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Beau-fr??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stepmother');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Beau-p??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Belle fille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Belle-soeur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Beau-fr??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Belle-m??re');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Beau-p??re');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', '??chec-fr??re (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sage-fr??re (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Parent-en-loi (neutre pour le genre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Bien-??tre (genre neutre)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Ajouter ?? la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Acceptez');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membre de la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membres de la famille');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Ajouter comme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', '??tes-vous s??r de vouloir supprimer ce membre de votre famille?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Un nouveau membre a ??t?? ajout?? avec succ??s ?? votre liste de famille!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Votre demande a ??t?? envoy??e avec succ??s!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'A accept?? votre demande pour ??tre votre @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Vous l\'avez consid??r?? comme son @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Demandes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'Aucune demande trouv??e!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'En relation avec');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Mari?? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Fianc?? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'Statut de la relation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Demande de relation');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'A accept?? votre demande @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rejet?? votre demande de relation @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Erreur de taille de fichier: le fichier d??passe autoris?? la limite ({image_fichier}) et ne peut pas ??tre t??l??charg??.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Impossible de t??l??charger un fichier: ce type de fichier n\'est pas pris en charge.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'ans');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Trouver des amis ?? proximit??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Distance demplacement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'pr??s de vous');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'W??hlen Sie ein Bild aus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Mein Gleichgewicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'F??lle meine Balance auf');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Fortsetzen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Ihr Gleichgewicht wurde erg??nzt durch');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Werbung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'M??chten Sie diese Anzeige wirklich l??schen?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Anzeige l??schen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Keine Anzeigen gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Nicht aktiv');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Platzierung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Seitenleiste');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'W??hlen Sie eine Seite aus oder geben Sie einen Link zu Ihrer Website ein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Geschichte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Die maximale Anzahl darf maximal 20 Dateien nicht ??berschreiten!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Ihr Status wurde erfolgreich hinzugef??gt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Neuen Status anlegen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Gef??rdert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Ihre Benachrichtigung wurde erfolgreich gesendet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Beitrag ausblenden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Ihre Best??tigungsanforderung wird bald ber??cksichtigt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', '??berpr??fung des Profils!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Herzlichen Gl??ckwunsch, Ihr Profil wird best??tigt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Dokumente hochladen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Bitte laden Sie ein Foto mit Ihrem Pass / ID & amp; Ihr eigenes Foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pass / ID-Karte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Dein Foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Bitte w??hlen Sie Ihren Pass / id und Foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Das Pass / id Bild muss ein Bild sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Das Benutzerbild muss ein Bild sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Ihre Anfrage wurde erfolgreich gesendet, in naher Zukunft werden wir es betrachten!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Geteilt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Post wurde erfolgreich zu deinem Zeitplan hinzugef??gt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Wichtig!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Bitte beachten Sie, dass Sie bei der ??nderung des Benutzernamens die Best??tigung verlieren');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Wer kann meine Freunde sehen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'F??gte Ihnen die Seite admin hinzu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'F??gte Ihnen gruppe admin hinzu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Noch keine Nachrichten.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'Konversation wurde gel??scht!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Schlie??en');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Mitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Exit-Gruppe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Geschichte l??schen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Gruppenmitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Teilnehmer hinzuf??gen');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Ihre Anzeige wurde erfolgreich hinzugef??gt!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'Das Anzeigenbild muss ein Bild sein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Bitte geben Sie eine g??ltige Beschreibung ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Bitte geben Sie einen g??ltigen Titel ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Bitte geben Sie einen g??ltigen Link ein!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Bitte geben Sie einen g??ltigen Firmennamen ein!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Gro??vater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Enkelin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Enkel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Stiefschwester');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Stiefbruder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Stiefmutter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Stiefvater');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Stieftochter');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Schw??gerin');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Gro??eltern (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Enkelkind (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Schritt-Geschwister (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Schritt-Elternteil (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Schwangerschaft (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Schwiegertochter (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Schwiegervater (geschlechtsneutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Zu Familie hinzuf??gen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Akzeptieren');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Familienmitglied');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Familienmitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Hinzuf??gen Als');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Sind Sie sicher, dass Sie dieses Mitglied aus Ihrer Familie entfernen m??chten?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Neues Mitglied wurde erfolgreich zu Ihrer Familienliste hinzugef??gt!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Dateigr????enfehler: Die Datei ??berschreitet die Begrenzung ({file_size}) und kann nicht hochgeladen werden.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Kann eine Datei nicht hochladen: Dieser Dateityp wird nicht unterst??tzt.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'Jahre alt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Freunde in der N??he finden');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Il tuo equilibrio ?? stato riempito da');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Pubblicit??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Sei sicuro di voler cancellare questo annuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Elimina annuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Nessun annuncio trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Non attivo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Posizionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Sidebar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Seleziona una pagina o inserisci un link al tuo sito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Storia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Il numero massimo non pu?? superare 20 file alla volta!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Il tuo stato ?? stato aggiunto con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Crea nuovo stato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'sponsorizzati');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'La tua notifica ?? stata inviata correttamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Nascondi post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'La tua richiesta di verifica sar?? presto presa in considerazione!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verifica del profilo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Complimenti il ??????tuo profilo ?? verificato!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Carica i documenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Carica una foto con il tuo passaporto / ID & amp; La tua foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passaporto / id carta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'La tua foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Seleziona il tuo passaporto / id e foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Limmagine del passaporto / id deve essere unimmagine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Limmagine dellutente deve essere unimmagine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'La tua richiesta ?? stata inviata con successo, nel prossimo futuro lo considereremo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'diviso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Lalberino ?? stato aggiunto con successo alla tua timeline!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Si prega di notare che se si modifica il nome utente perder?? la verifica');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Chi pu?? vedere i miei amici');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Aggiunto l\'amministratore di pagina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Ha aggiunto l\'amministratore di gruppo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Non ci sono ancora messaggi qui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'La conversazione ?? stata cancellata!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Hai gi?? valutato questa pagina!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Valutazione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Recensioni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Vota');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Scrivi la tua recensione.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Il tuo annuncio ?? stato salvato con successo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Il tuo annuncio ?? stato aggiunto con successo!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Fratellanza del genitore (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Bambino di fratelli (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Cugino (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Nonno (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Nipote (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Step-parent (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (genere neutro)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Sibling-in-law (gender neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Genitore di sesso (neutralit?? di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Suono (neutrale di genere)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Aggiungi alla famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Accettare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membro della famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membri della famiglia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Aggiungi come');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Sei sicuro di voler rimuovere questo membro dalla tua famiglia?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Nuovo membro ?? stato aggiunto con successo alla tua lista di famiglia!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'La tua richiesta ?? stata inviata con successo!');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Errore di dimensione del file: il file supera il limite consentito ({file_size}) e non pu?? essere caricato.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Impossibile caricare un file: questo tipo di file non ?? supportato.');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'Licita????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'Cliques');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'Url');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'P??blico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Selecione uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Meu saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Reabaste??a meu saldo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Continuar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Seu saldo foi reabastecido por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Publicidade');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Tem certeza de que quer apagar este an??ncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Eliminar an??ncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Nenhum an??ncio encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'N??o ativo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Coloca????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barra Lateral');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Selecione uma p??gina ou insira um link para o seu site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Hist??ria');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'O n??mero m??ximo n??o pode exceder 20 arquivos de cada vez!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Seu status foi adicionado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Criar novo status');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Patrocinadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Sua notifica????o foi enviada com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Ocultar postagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Seu pedido de verifica????o em breve ser?? considerado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verifica????o do perfil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Parab??ns seu perfil est?? verificado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Carregar documentos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Carregue uma foto com seu passaporte / ID & amp; Sua foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Passaporte / cart??o de identifica????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Sua foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Selecione seu passaporte / id e foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'A imagem de passaporte / id deve ser uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'A imagem do usu??rio deve ser uma imagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Seu pedido foi enviado com sucesso, no futuro muito pr??ximo, vamos consider??-lo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Compartilhado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'O post foi adicionado com sucesso ?? sua linha de tempo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', 'Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Observe que se voc?? alterar o nome de usu??rio, voc?? perder?? a verifica????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Quem pode ver meus amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Adicionou voc?? admin da p??gina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Adicionou voc?? administrador do grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Ainda n??o h?? mensagens aqui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', 'A conversa foi exclu??da!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Fechar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Membros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Grupo de sa??da');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Apagar o hist??rico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Membros do grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Adicionar participante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancelar relat??rio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Denunciar este usu??rio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Informe esta p??gina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Denunciar este grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Voc?? j?? avaliou esta p??gina!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Avalia????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Rever');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Taxa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Escreva sua revis??o.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Seu an??ncio foi salvo com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Seu an??ncio foi adicionado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'A imagem dos an??ncios deve ser uma imagem!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Digite uma descri????o v??lida!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'Digite um t??tulo v??lido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Digite um link v??lido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Digite um nome v??lido da empresa!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'M??e');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Pai');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Filha');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Filho');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Irm??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Irm??o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'Tia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Tio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Sobrinha');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Sobrinho');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Prima)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Primo)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Av??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Av??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Neta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Neto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Meia-irm??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Meio-irm??o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Madrasta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Padrasto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Enteada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Cunhada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Cunhado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Sogra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Sogro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Nora');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Genro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Irm??o (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Pais (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Crian??a (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Sibling of Parent (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Crian??a do irm??o (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Primo (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Av??s (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Neto (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Irm??o-irm??o (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Etapa-pai (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Irm??o-irm??o (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Sogro (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Nora (neutro em termos de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Adicionar ?? fam??lia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Aceitar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Membro da fam??lia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Membros da fam??lia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Adicionar como');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Tem certeza de que deseja remover esse membro da sua fam??lia?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Novo membro foi adicionado com sucesso ?? sua lista de fam??lia!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Seu pedido foi enviado com sucesso!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Aceitou seu pedido para ser seu @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listou voc?? como seu @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'solicita????es de');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'N??o foram encontrados pedidos!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Em rela????o com');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Casado com');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'noivo de');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'status de relacionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Pedido de relacionamento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Aceitou seu pedido @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rejeitou sua solicita????o de relacionamento @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Erro de tamanho de arquivo: o arquivo excede permitido o limite ({file_size}) e n??o pode ser carregado.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'N??o ?? poss??vel carregar um arquivo: esse tipo de arquivo n??o ?? suportado.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'anos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Encontre amigos nas proximidades');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Dist??ncia de localiza????o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'perto de voc??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Encontrar amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'dist??ncia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Dist??ncia de voc??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Mostrar localiza????o');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', '??????-????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', '???????????????? ??????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', '?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', '?????????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', '????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', '?????? ???????????? ?????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', '???? ??????????????, ?????? ???????????? ?????????????? ?????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', '?????????????? ????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', '???????????????????? ???? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', '???? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', '????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', '?????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', '???????????????? ???????????????? ?????? ?????????????? ???????????? ???? ???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', '???????????????????????? ?????????? ???? ?????????? ?????????????????? 20 ???????????? ???? ??????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', '?????? ???????????? ?????????????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', '?????????????? ?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', '???????? ?????????????????????? ???????????????????? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', '???????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', '?????? ???????????? ???? ?????????????????????????? ?????????? ?????????? ????????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', '???????????????? ??????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', '?????????????????????? ?????? ?????????????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', '?????????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', '????????????????????, ?????????????????? ???????????????????? ?? ?????????? ?????????????????? / ID ?? amp; ???????? ???????????????? ????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', '?????????????? / ?????????????????????????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', '???????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', '???????????????? ???????? ?????????????? / ?????????????????????????? ???????????????? ?? ????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', '?????????????? / ?????????????????????????? ???????????? ???????? ????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', '?????????????????????? ???????????????????????? ???????????? ???????? ????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', '?????? ???????????? ?????? ?????????????? ??????????????????, ?? ?????????? ?????????????????? ?????????????? ???? ?????? ????????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', '?????????????????? ???????? ?????????????? ?????????????????? ???? ?????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', '??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', '???????????????? ????????????????, ?????? ???????? ???? ???????????????? ?????? ????????????????????????, ???? ?????????????????? ??????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', '?????? ?????????? ???????????? ???????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', '?????????????????? ?????????????????????????????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', '???????????????? ?????????????????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', '???????? ?????????????????? ??????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', '???????????????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', '???????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', '?????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', '?????????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', '???????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', '???????????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', '???????????????? ???? ???????? ????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', '???????????????? ???? ???????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', '???????????????? ???? ???????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', '???? ?????? ?????????????? ?????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', '???????????????? ???????? ??????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', '???????? ???????????????????? ?????????????? ??????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', '???????? ???????????????????? ???????? ?????????????? ??????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', '?????????????????????? ???????????????????? ???????????? ???????? ????????????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', '?????????????? ???????????????????????????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', '?????????????? ???????????????????????????? ??????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', '????????????????????, ?????????????? ?????????????????????? ????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', '?????????????? ???????????????????????????? ???????????????? ????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', '????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', '???????????????????? ????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', '???????????????????? ????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', '?????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', '?????????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', '?????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', '???????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', '?????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', '???????????????? ?????????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', '?????????????? ???????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', '?????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', '?????????????? ?? ?????????????? (?????????????????? ????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', '?????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Step-sibling (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', '?????????????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', '?????????????? ?? ???????????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', '???????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', '?????? (???????????????? ??????????????????????)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', '???????????????? ?? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', '???????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', '?????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', '???????????????? ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', '???? ??????????????, ?????? ???????????? ?????????????? ?????????? ?????????????????? ???? ?????????? ???????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', '?????????? ???????? ?????? ?????????????? ???????????????? ?? ???????????? ?????????? ??????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', '?????? ???????????? ?????? ?????????????? ??????????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', '???????????? ?????? ???????????? ?????? ?????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', '???????????????????? ?????? ?????? ?????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', '???????????????? ???? ??????????????!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', '?? ???????????????????? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', '?? ?????????? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', '???????????????????? ??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', '???????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', '???????????? ???? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', '????????????(??) ?????? ???????????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', '????????????????(a) ?????? ???????????? ?????????????????? @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', '???????????? ?????????????? ??????????: ???????? ?????????????????? ???????????????????? ???????????? ({file_size}) ?? ???? ?????????? ???????? ????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', '???? ?????????????? ?????????????????? ????????. ???????? ?????? ?????????? ???? ????????????????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', '?????????? ???????????? ????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', '??????????????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', '???????????? ?? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', '?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', '????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', '???????????????????? ???? ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', '???????????????? ???? ??????????');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Est??s seguro de que quieres eliminar esta publicidad');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Eliminar anuncio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'No se han encontrado anuncios');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'No activo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Colocaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Barra lateral');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Seleccione una p??gina o ingrese un enlace a su sitio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', 'Historia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', '??El n??mero m??ximo no puede superar los 20 archivos a la vez!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', '??Tu estado se ha agregado correctamente!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Crear nuevo estado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Patrocinado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Tu notificaci??n se ha enviado correctamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Esconder la publicaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Su solicitud de verificaci??n pronto ser?? considerada!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Verificaci??n del perfil!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', '??Felicidades tu perfil est?? verificado!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Subir documentos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'Cargue una foto con su pasaporte / ID & amp; Tu foto distinta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pasaporte / tarjeta de identificaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Tu foto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'Por favor, seleccione su pasaporte / identificaci??n y foto!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'La imagen del pasaporte / id debe ser una imagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'La imagen del usuario debe ser una imagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', 'Su solicitud fue enviada con ??xito, en un futuro muy pr??ximo lo consideraremos!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Compartido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', '??Se ha agregado el mensaje a tu l??nea de tiempo!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', '??Importante!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Tenga en cuenta que si cambia el nombre de usuario, perder?? la verificaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', '??Qui??n puede ver a mis amigos?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Agreg?? tu p??gina admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Agreg?? tu grupo de administraci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'A??n no hay mensajes.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', '??Se ha eliminado la conversaci??n!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Cerca');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Miembros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Salir del grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Borrar historial');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Miembros del grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'A??ada participante');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Cancelar informe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Reportar a este usuario');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Informar sobre esta p??gina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Reportar este grupo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', '??Ya has calificado esta p??gina!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'Clasificaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'Comentarios');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'Tarifa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Escribe tu rese??a.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Tu anuncio se ha guardado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Su anuncio se ha agregado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', '??La imagen de los anuncios debe ser una imagen!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'Por favor ingrese una descripci??n v??lida!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', '??Por favor ingrese un t??tulo v??lido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'Ingrese un enlace v??lido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'Introduzca un nombre de empresa v??lido!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'Madre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'Padre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'Hija');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'Hijo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'Hermana');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Hermano');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'T??a');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'T??o');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Sobrina');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Sobrino');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Prima)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Primo var??n)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'Abuela');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'Abuelo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'Nieta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Nieto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', 'Hermanastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', 'Hermanastro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', 'Madrastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', 'Padrastro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', 'Hijastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Cu??ada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Cu??ado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Suegra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Suegro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Hijastra');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Yerno');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Hermano (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Padre (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', 'Ni??o (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Hermano de padre (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Hijo de hermano (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Primo (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'Abuelo (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Nieto (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Hermanastro (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'El padrastro (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', 'Stepchild (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Cu??ados (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Suegro (neutral de g??nero)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Ni??o (s) (g??nero neutral)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'A??adir a la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Aceptar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Miembro de la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Miembros de la familia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Agregar como');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', '??Est??s seguro de que deseas eliminar este miembro de tu familia?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', '??El nuevo miembro se agreg?? a su lista de familia!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', '??Su solicitud ha sido enviada correctamente!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', 'Aceptado su solicitud para ser su @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Listado como su @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', 'Peticiones');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', 'No se han encontrado solicitudes!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'En las relaciones con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Casado con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'comprometido con');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'estado civil');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Solicitud de relaci??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', 'Aceptado su solicitud @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Rechaz?? su solicitud de relaci??n @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Error de tama??o de archivo: El archivo excede el l??mite permitido ({file_size}) y no se puede cargar.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'No se puede cargar un archivo: este tipo de archivo no es compatible.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'a??os');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Encuentra amigos cercanos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Ubicaci??n distancia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'cerca de usted');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Encontrar amigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'distancia');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Distancia de ti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Mostrar ubicaci??n');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wallet', 'C??zdan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'company', '??irket');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'bidding', 'teklif verme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clicks', 'T??klanma');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'url', 'URL');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'audience', 'seyirci');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_image', 'Bir resim se??in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_balance', 'Bakiyem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenish_my_balance', 'Bakiyemi yenile');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'continue', 'Devam et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replenishment_notif', 'Bakiyeniz, taraf??ndan yeniden dolduruldu.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ads', 'Ilan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_ad', 'Bu reklam?? silmek istedi??inizden emin misiniz');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'delete_ad', 'Reklam?? sil');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_ads_found', 'Hi?? ilan bulunamad??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'not_active', 'Aktif de??il');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'appears', 'Yerle??tirme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sidebar', 'Kenar ??ubu??u');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_a_page_or_link', 'Bir sayfa se??in veya sitenize bir ba??lant?? girin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'story', '??yk??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'max_number_status', 'Maksimum say??, ayn?? anda 20 dosya a??amaz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'status_added', 'Durumunuz ba??ar??yla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_status', 'Yeni Durum Olu??tur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sponsored', 'Sponsor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'notification_sent', 'Bildiriminiz ba??ar??yla g??nderildi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'hide_post', 'Postay?? gizle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_sent', 'Do??rulama iste??iniz yak??nda de??erlendirilecek!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'profile_verification', 'Profilin do??rulanmas??!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_complete', 'Tebrikler, profiliniz do??ruland??!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'upload_docs', 'Belgeleri y??kle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select_verif_images', 'L??tfen pasaportunuzla bir foto??raf y??kleyin / kimli??i ve amp; Farkl?? foto??raf??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id', 'Pasaport / kimlik kart??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_photo', 'Senin resmin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_select_passport_id', 'L??tfen pasaportunuzun / kimlik numaran??z?? ve foto??raf??n??z?? se??in!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'passport_id_invalid', 'Pasaport / id resmi bir resim olmal??d??r');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'user_picture_invalid', 'Kullan??c?? resmi bir resim olmal??d??r');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'verification_request_sent', '??ste??iniz ba??ar??yla g??nderildi, ??ok yak??n bir zamanda bunu d??????n??yoruz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'shared', 'Payla????lan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_shared', 'Mesaj, zaman ??izelgesine ba??ar??yla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'important', '??nemli!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unverify', 'Kullan??c?? ad??n?? de??i??tirirseniz do??rulamay?? kaybedece??inizi l??tfen unutmay??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friend_privacy', 'Arkada??lar??m?? kim g??rebilir?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_page_admin', 'Size sayfa admin ekledi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'added_group_admin', 'Grup y??neticisi ekledi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages', 'Hen??z mesaj yok.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conversation_deleted', '??leti dizisi silindi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close', 'Kapat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', '??yeler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'exit_group', 'Grubundan ????k');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'clear_history', 'Ge??mi??i temizle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_members', 'Grup ??yeleri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_parts', 'Kat??l??mc?? ekle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'unreport', 'Raporu ??ptal Et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_user', 'Bu kullan??c??y?? rapor et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_page', 'Bu sayfay?? bildir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'report_group', 'Bu Grubu Rapor Et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'page_rated', 'Bu sayfaya zaten puan verdiniz!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rating', 'De??erlendirme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reviews', 'yorumlar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'rate', 'oran');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_review', 'Yorumunuzu yaz??n.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_saved', 'Reklam??n??z ba??ar??yla kaydedildi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'ad_added', 'Reklam??n??z ba??ar??yla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_ad_picture', 'Reklam resimleri bir resim olmal??d??r!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_desc', 'L??tfen ge??erli bir a????klama girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_titile', 'L??tfen ge??erli bir ba??l??k girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_url', 'L??tfen ge??erli bir ba??lant?? girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invalid_company_name', 'L??tfen ge??erli bir ??irket ad?? girin!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother', 'anne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father', 'baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter', 'K??z evlat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son', 'O??ul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister', 'K??z karde??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother', 'Erkek karde??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'auntie', 'teyzeci??im');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'uncle', 'Amca day??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'niece', 'Ye??en');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'nephew', 'Erkek ye??en');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_female', 'Kuzenim (kad??n)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_male', 'Erkek kuzen)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandmother', 'b??y??kanne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandfather', 'B??y??k baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'granddaughter', 'K??z torun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandson', 'Erkek torun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepsister', '??vey k??zkarde??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepbrother', '??vey erkek karde??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepmother', '??vey anne');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepfather', '??vey baba');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepdaughter', '??vey k??z');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sister_in_law', 'Bald??z');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'brother_in_law', 'Kay??nbirader');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'mother_in_law', 'Kay??nvalide');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'father_in_law', 'Kay??npeder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'daughter_in_law', 'Gelin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'son_in_law', 'Damat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_gender_neutral', 'Karde??lik (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_gender_neutral', 'Ebeveyn (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_gender_neutral', '??ocuk (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_of_parent_gender_neutral', 'Ebeveynin Karde??li??i (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_of_sibling_gender_neutral', 'Karde??lik ??ocu??u (cinsiyete dayal?? tarafs??z)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'cousin_gender_neutral', 'Kuzenim (cinsiyete ayk??r??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandparent_gender_neutral', 'B??y??kbaba (cinsiyet e??itli??i yok)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'grandchild_gender_neutral', 'Torun (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_sibling_gender_neutral', 'Ad??m karde?? (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'step_parent_gender_neutral', 'Veli-ebeveyn (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'stepchild_gender_neutral', '??vey ??ocuk (cinsiyete ayk??r??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sibling_in_law_gender_neutral', 'Kay??n ??st?? (cinsiyete dayal??)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'parent_in_law_gender_neutral', 'Kay??nvalides (cinsiyet e??itli de??il)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'child_in_law_gender_neutral', 'Kay??n-ku??un (cinsiyet e??itli)');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_to_family', 'Ailenize ekleyin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'accept', 'Kabul etmek');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member', 'Aile ??yesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_members', 'Aile ??yeleri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'add_as', 'Olarak ekle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_remove_family_member', 'Bu ??yeyi ailenden kald??rmak istedi??inizden emin misiniz?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'family_member_added', 'Yeni ??ye, aileniz listesine ba??ar??yla eklendi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_sent', 'Talebiniz ba??ar??yla g??nderildi!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'request_accepted', '@ Olmak iste??inizi kabul ettiniz');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'sent_u_request', 'Seni onun @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'requests', '??stekler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_requests_found', '??stek bulunamad??!');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_with', 'Ile ili??kilerinde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'married_to', 'Evli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'engaged_to', 'Etkile??im kurdu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_status', 'ili??ki durumu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relationship_request', 'Ili??ki talebi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relhip_request_accepted', '??ste??iniz kabul edildi @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'relation_rejected', 'Ili??ki iste??ini reddetti @');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_too_big', 'Dosya boyutu hatas??: Dosya limiti a??t?? ({file_size}) ve y??klenemiyor.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'file_not_supported', 'Dosya y??klenemiyor: Bu dosya t??r?? desteklenmiyor.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'years_old', 'ya????nda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends_nearby', 'Yak??nlarda arkada?? bul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location_dist', 'Yer mesafesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'close_to_u', 'sana yak??n');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'find_friends', 'Arkada??lar?? bul');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance', 'mesafe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'distance_from_u', 'Senden uzakl??k');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'show_location', 'Yeri g??ster');
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