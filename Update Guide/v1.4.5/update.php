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
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Forums` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(300) NOT NULL DEFAULT '',
  `sections` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `last_post` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_ForumThreadReplies` (
  `id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL DEFAULT '0',
  `forum_id` int(11) NOT NULL DEFAULT '0',
  `poster_id` int(11) NOT NULL DEFAULT '0',
  `post_subject` varchar(300) NOT NULL DEFAULT '',
  `post_text` text NOT NULL,
  `post_quoted` int(11) NOT NULL DEFAULT '0',
  `posted_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Forum_Sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(300) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Forum_Threads` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `headline` varchar(300) NOT NULL DEFAULT '',
  `post` text NOT NULL,
  `posted` varchar(20) NOT NULL DEFAULT '0',
  `last_post` int(11) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `description` (`description`(255)),
  ADD KEY `posts` (`posts`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_ForumThreadReplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_id` (`thread_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `post_subject` (`post_subject`(255)),
  ADD KEY `post_quoted` (`post_quoted`),
  ADD KEY `posted_time` (`posted_time`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forum_Sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_name` (`section_name`),
  ADD KEY `description` (`description`(255));");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forum_Threads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `views` (`views`),
  ADD KEY `posted` (`posted`),
  ADD KEY `headline` (`headline`(255)),
  ADD KEY `forum` (`forum`);");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Egoing` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Einterested` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Einvited` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `inviter_id` int(11) NOT NULL,
  `invited_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Events` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '',
  `location` varchar(300) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `poster_id` int(11) NOT NULL,
  `cover` varchar(500) NOT NULL DEFAULT 'upload/photos/d-cover.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Egoing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Einterested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Einvited`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `inviter_id` (`invited_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poster_id` (`poster_id`),
  ADD KEY `name` (`name`),
  ADD KEY `start_date` (`start_date`),
  ADD KEY `start_time` (`start_time`),
  ADD KEY `end_time` (`end_time`),
  ADD KEY `end_date` (`end_date`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Egoing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Einterested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Einvited`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forums` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_ForumThreadReplies` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forum_Sections` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Forum_Threads` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UsersChat` ADD `color` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `time`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_VideoCalles` DROP `call_id`, DROP `call_id_2`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `sent_push` INT NOT NULL DEFAULT '0' AFTER `deleted_two`, ADD INDEX (`sent_push`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `notification_id` VARCHAR(50) NOT NULL DEFAULT '' AFTER `sent_push`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `event_id` INT NOT NULL DEFAULT '0' AFTER `group_id`, ADD INDEX (`event_id`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Notifications` ADD `event_id` INT NOT NULL AFTER `group_id`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `device_id` VARCHAR(50) NOT NULL DEFAULT '' AFTER `social_login`;");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'push', '0');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'push_id', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'push_key', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'events', '1');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'forum', '1');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_PinnedPosts` ADD `event_id` INT NOT NULL DEFAULT '0' AFTER `post_id`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `page_event_id` INT NOT NULL DEFAULT '0' AFTER `event_id`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Notifications` ADD `thread_id` INT NOT NULL DEFAULT '0' AFTER `event_id`;");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'forum')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'replies')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'last_post')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'topic')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'thread_search')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_topic')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'jump_to')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'my_threads')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'my_messages')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'headline')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'your_post')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'reply')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'started_by')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'site_admin')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'registered')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'posts')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'reply_to_topic')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'topic_review')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'your_reply')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'list_of_users')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'post_count')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'referrals')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'last_visit')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'general_search_terms')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_for_term')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_in')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_in_forums')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_in_threads')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_in_messages')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_subject_only')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'threads')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'action')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'posted')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_forums_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'never')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_replies_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_threads_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_members_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_sections_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'wrote')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'edit')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'edit_topic')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'reply_saved')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'reply_added')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'forum_post_added')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'members')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'help')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'search_terms_more4')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'events')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'going')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'interested')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'past')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'invited')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'you_are_going')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'you_are_interested')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'start_date')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'end_date')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'location')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'event')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_events_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'event_you_may_like')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'going_people')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'interested_people')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'invited_people')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'event_added')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'event_saved')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'confirm_delete_event')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'load_more')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'subject')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'go')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'created_new_event')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'my_events')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'is_interested')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'is_going')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'invited_you_event')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'replied_to_topic')");

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
    $value = Wo_Secure($value);
    if ($value == 'arabic') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'منتدى');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'ردود');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'آخر مشاركة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'موضوع');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'بحث المواضي ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'إنشاء موضوع جديد ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'انتقل الى ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'المواضيع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'رسائلي ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'العنوان ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'منشورك ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'الرد على هذا الموضوع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'بدأ ب ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'مسؤول الموقع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'مسجل ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'الرد ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'المشاركات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'مراجعة الموضوع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'ردك ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'قائمة المستخدمين ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'عدد المشاركات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'الإحالات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'الزيارة الأخيرة ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'عبارات البحث العامة ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'البحث عن مصطلح ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'بحث في ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'البحث في المنتديات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'البحث في المواضيع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'البحث في الرسائل ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'موضوع البحث فقط ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'اكتب عبارة بحث واحدة أو أكثر، ويجب ألا يقل عدد الأحرف عن 4 أحرف ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'الخيوط ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'عمل ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'تم النشر ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'لم يتم العثور على منتديات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'أبدا ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'لم يتم العثور على أية ردود ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'لم يتم العثور على سلاسل محادثات ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'لم يتم العثور على أي أعضاء ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'كتب ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'تصحيح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'تعديل الموضوع ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'تم حفظ ردك بنجاح ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'تمت إضافة ردك بنجاح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'تمت إضافة مشاركة المنتدى بنجاح ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'أفراد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'مساعدة ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'تحميل أكثر');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'أحداث');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'ذاهب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'يستفد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'الماضي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'دعوة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'انت ذاهب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'كنت مهتما');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'تاريخ البدء');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'تاريخ الانتهاء');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'هدف');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'لم يتم العثور على أية أحداث');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'الأحداث التي قد تعجبك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'الذهاب الناس');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'الناس المهتمين');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'الأشخاص المدعوون');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'تمت إضافة هذا الحدث الخاص بك بنجاح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'تم حفظ هذا الحدث الخاص بك');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'كنت متأكدا من أنك تريد حذف هذا الحدث');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'تحميل أكثر');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'موقع');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'موضوع');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'اذهب');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'حدث جديد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'أحداثي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'مهتم بحدثك "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'هو الذهاب إلى الحدث "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'دعاك إلى الذهاب إلى الحدث "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'أجاب على الموضوع');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Antwoorden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Laatste bericht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'onderwerp');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Zoek naar discussies');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Maak een nieuw onderwerp aan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Spring naar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Mijn draden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Mijn berichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'opschrift');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Uw bericht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Antwoord');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Begonnen door');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Site Admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Geregistreerd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'posts');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Antwoord op dit onderwerp');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Onderwerp review');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Uw reactie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Lijst van gebruikers');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Berichten tellen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Verwijzingen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Laatste bezoek');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Algemene zoektermen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Zoek naar term');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Zoek in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Zoeken in forums');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Zoek in discussies');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Zoek in berichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Zoek alleen onderwerp');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Actie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Geplaatst');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Geen forums gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Nooit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Geen antwoorden gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Geen discussies gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Er zijn geen leden gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'schreef');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Bewerk');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Bewerk onderwerp');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Uw antwoord is succesvol opgeslagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Je antwoord is succesvol toegevoegd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Uw forum is succesvol toegevoegd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'leden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Helpen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Typ één of meer zoektermen, ieder moet minstens 4 karakters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Meer laden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Evenementen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'gaand');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Geïnteresseerd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Verleden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Uitgenodigd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Jij gaat');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Je bent geïnteresseerd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Begin datum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Einddatum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Evenement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Geen evenementen gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Evenementen die je misschien leuk vindt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Mensen gaan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Geïnteresseerde mensen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Uitgenodigde mensen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Uw evenement is toegevoegd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Uw evenement is opgeslagen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Bent u zeker dat u wilt dit evenement verwijderen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Meer laden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Plaats');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Onderwerpen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Gaan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Aangemaakt nieuw evenement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Mijn gebeurtenissen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Is geïnteresseerd in je evenement "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Gaat naar je evenement "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Heeft u uitgenodigd om het evenement te gaan "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Antwoordde op je onderwerp');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Réponses');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Dernier commentaire');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Recherche de threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Créer un nouveau sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Sauter à');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Mes fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Mes messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Gros titre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Votre publication');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Répondre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Commencé par');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Administrateur du site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Inscrit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'des postes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Répondre à ce sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Examen de sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Votre réponse');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Liste des utilisateurs');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Nombre de postes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Renvois');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Derniere visite');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Conditions générales de recherche');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Rechercher un terme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Rechercher dans');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Rechercher dans les forums');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Rechercher dans les discussions');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Rechercher dans les messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Rechercher uniquement sur le sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'Fils');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'action');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Publié');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Aucun forum trouvé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Jamais');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Aucune réponse trouvée');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Aucun sujet trouvé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Aucun membre trouvé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'a écrit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'modifier');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Modifier le sujet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Votre réponse a été enregistrée avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Votre réponse a été ajoutée avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Votre forum a été ajouté avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Membres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Aidez-moi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Tapez un ou plusieurs termes de recherche, chacun doit être dau moins 4 caractères');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Chargez plus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Événements');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Aller');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Intéressé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Passé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Invité');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Vous allez');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Tu es intéressé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Date de début');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Date de fin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'un événement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Aucun événement trouvé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Événements que vous aimeriez');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Aller aux gens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Les personnes intéressées');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Personnes invitées');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Votre événement a été ajouté avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Votre événement a été enregistré');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Vous êtes sûr que vous voulez supprimer cet événement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Chargez plus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Emplacement');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Assujettir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Aller');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Nouvel événement créé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Mes événements');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Est intéressé par votre événement "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Va à votre événement "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Vous a invité à aller à l\'événement "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'A répondu à votre sujet');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Antworten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Letzter Beitrag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'Thema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Threads suchen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Neues Thema erstellen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Springen zu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Meine Fäden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Meine Nachrichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Überschrift');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Deine Post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Antworten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Angefangen von');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Site Admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Eingetragen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'Beiträge');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Antwort auf dieses Thema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Thema Bewertung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Deine Antwort');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Liste der Benutzer');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Beiträge zählen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Verweise');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Letzter Besuch');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Allgemeine Suchbegriffe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Suche nach Begriff');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Suchen in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Foren durchsuchen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Suche in Threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Suche in Nachrichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Nur Suchbegriff suchen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'Fäden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Aktion');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Gesendet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Keine Foren gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Nie');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Keine Antworten gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Keine Fäden gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Keine Mitglieder gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'schrieb');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Bearbeiten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Thema bearbeiten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Ihre Antwort wurde erfolgreich gespeichert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Ihre Antwort wurde erfolgreich hinzugefügt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Dein Forum wurde erfolgreich hinzugefügt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Mitglieder');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Hilfe');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Geben Sie einen oder mehrere Suchbegriffe ein, die jeweils muss mindestens 4 Zeichen lang sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'laden Sie mehr');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Veranstaltungen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Gehen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interessiert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Vergangenheit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Eingeladen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Du gehst');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Sie sind interessiert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Anfangsdatum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Enddatum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Keine Veranstaltungen gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Veranstaltungen, die Sie mögen können');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Leute gehen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Interessierte Leute');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Eingeladene Leute');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Ihre Veranstaltung wurde erfolgreich hinzugefügt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Ihre Veranstaltung wurde gespeichert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Sie sind sicher, dass Sie dieses Ereignis löschen möchten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'laden Sie mehr');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Lage');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Fach');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Gehen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Neue Veranstaltung erstellt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Meine ereignisse');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Interessiert sich für deine Veranstaltung "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Geht zu deiner Veranstaltung "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Lud dich ein, die Veranstaltung zu starten "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Antwortete auf dein Thema');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'risposte');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Ultimo messaggio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'argomento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Ricerca di thread');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Crea nuovo argomento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Salta a');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'I miei fili');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'I miei messaggi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Titolo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Il tuo post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'rispondere');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Iniziato da');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Amministrazione del sito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Registrato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'messaggi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Rispondi a questo argomento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Revisione degli argomenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'La tua risposta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Elenco degli utenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'I numeri contano');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Referenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Lultima visita');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Termini di ricerca generali');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Cerca termine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Cerca nel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Cerca i forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Cerca nei thread');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Cerca nei messaggi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Cerca solo il soggetto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'fili');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Azione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Pubblicato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Nessun forum trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Mai');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Nessuna risposta trovata');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Non sono stati trovati thread');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Nessun membro trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'ha scritto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Modifica');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Modifica argomento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'La tua risposta è stata salvata correttamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'La tua risposta è stata aggiunta con successo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Il tuo forum è stato aggiunto con successo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Utenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Aiuto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Geben Sie einen oder mehrere Suchbegriffe ein, die jeweils muss mindestens 4 Zeichen lang sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'caricare più');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'eventi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Andando');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interessato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Passato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Invitato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Stai andando');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Sei interessato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Data dinizio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Data di fine');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Nessun evento trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Eventi che ti piacciono');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Andando gente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Persone interessate');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Persone invitate');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Il vostro evento è stato aggiunto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Il vostro evento è stato salvato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Sei sicuro di voler eliminare questo evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'caricare più');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Posizione');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Soggetto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Partire');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Ha creato un nuovo evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'I miei eventi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'È interessato al tuo evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Sta andando al tuo evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Ti ha invitato a partecipare all\'evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Ha risposto al tuo argomento');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Fórum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Respostas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Última postagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Pesquisa de Threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Criar novo tópico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Pule para');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Meus tópicos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Minhas mensagens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Título');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Sua postagem');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Resposta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Começado por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Administrador do Site');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Registrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'Postagens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Responder a este tópico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Revisão do tópico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Sua resposta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Lista de usuários');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Posts count');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Referências');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Ultima visita');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Termos gerais de pesquisa');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Pesquisar termo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Procure em');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Pesquisar Fóruns');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Pesquisar nos tópicos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Pesquisar em mensagens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Procurar somente assunto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'tópicos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Açao');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Postou');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Nenhum fórum encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Nunca');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Nenhuma resposta encontrada');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Nenhum tópico encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Nenhum membro encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'escrevi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Editar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Editar tópico');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Sua resposta foi salva com êxito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Sua resposta foi adicionada com êxito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Seu fórum foi adicionado com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Membros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Socorro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Digite um ou mais termos de pesquisa, cada um deve ter pelo menos 4 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Coloque mais');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Eventos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Indo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interessado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Passado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Convidamos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Você está indo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Você está interessado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Data de início');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Data final');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Nenhum evento encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Eventos que você pode gostar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Indo as pessoas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Pessoas interessadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Pessoas convidadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Seu evento foi adicionado com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Seu evento foi salvo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Você tem certeza de que deseja excluir este evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Coloque mais');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'localização');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Sujeito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Ir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Criou um novo evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Meus eventos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Está interessado no seu evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Está indo para o seu evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Convidou você para ir ao evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Respondeu ao seu tópico');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Форум');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Ответы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Последний пост');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'тема');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Поиск по темам');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Создать новую тему');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Перейти к');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Мои темы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Мои сообщения');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Заголовок');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Ваше сообщение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Ответить');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Начато');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Администратор сайта');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'зарегистрированный');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'сообщений');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Ответить в эту тему Открыть новую тему');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Обзор темы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Ваш ответ');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Список пользователей');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Количество сообщений');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Переходов');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Последнее посещение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Общие условия поиска');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Поиск термина');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Поиск в');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Поиск по форуму Главная страница форума Форум');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Искать в темах');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Искать в сообщениях');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Только поиск');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'потоки');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'действие');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Сообщение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Форум не найден');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Никогда');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Нет ответов');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Темы не найдены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Участники не найдены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'писал');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'редактировать');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Изменить тему');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Ваш ответ был успешно сохранен');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Ваш ответ был успешно добавлен');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Ваш форум успешно добавлен');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'члены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Помощь');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Введите одно или несколько поисковых терминов, каждый из них должен быть не менее 4-х символов');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Показать еще');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Мероприятия');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Пойду');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'интересное');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'прошлые');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'приглашенни');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Вы собираетесь');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Вы заинтересованы');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Дата начала');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Дата окончания');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Мероприятие');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'События не найдены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Мероприятия, которые могут вам понравиться');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Идущие люди');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Заинтересованные лица');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Приглашенные люди');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Ваше мероприятие успешно добавлено');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Ваше мероприятие успешно сохранено');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Вы уверены что Вы хотите удалить это событие');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Показать еще');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Расположение');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Предмет');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Идти');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Создано новое мероприятие');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Мои мероприятия');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Заинтересовано в вашем мероприятии "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Идет на ваше мероприятие "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Приглашает вас на мероприятие "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Ответил на вашу тему');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Foro');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Respuestas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Ultima publicación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Búsqueda de hilos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Crear nuevo tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Salta a');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Mis hilos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Mis mensajes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Titular');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Tu mensaje');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Respuesta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Comenzado por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Administrador del sitio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Registrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'Mensajes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Responder a este tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Revisión de temas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Tu respuesta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Lista de usuarios');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Los posts cuentan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Referencias');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Última visita');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Términos generales de búsqueda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Buscar término');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Busca en');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Buscar en los foros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Buscar en temas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Buscar en mensajes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Solo tema de búsqueda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'trapos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Acción');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Al corriente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'No se encontraron foros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Nunca');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'No se encontraron respuestas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'No se encontraron hilos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'No se encontraron miembros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'Escribió');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Editar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Editar tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Tu respuesta se ha guardado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Tu respuesta se ha agregado correctamente.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Tu foro se ha agregado correctamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Miembros');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Ayuda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Tipo de uno o más términos de búsqueda, cada uno debe tener al menos 4 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Cargar más');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Eventos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Yendo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interesado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Pasado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Invitado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Usted va');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'Tú estás interesado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Fecha de inicio');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Fecha final');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'No se han encontrado eventos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Eventos que te pueden gustar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Personas que van');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Personas interesadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Personas invitadas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Su caso se ha añadido con éxito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Su caso se ha guardado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Está seguro de que desea eliminar este evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Cargar más');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Ubicación');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Tema');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Ir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Creó nuevo evento');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Mis eventos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'Está interesado en su evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'Va a su evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Te invitó a ir al evento "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Respondió a su tema');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Cevaplar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Son Posta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'konu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Konular arama');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Yeni konu oluştur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Atlamak');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'Konuları ekle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'Mesajlarım');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'manşet');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Senin gönderin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'cevap');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Başlatan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Site Yöneticisi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Kayıtlı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'Mesajları');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Bu konuyu cevapla');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Konu incelemesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Cevabınızı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'Kullanıcı listesi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Mesaj sayısı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Tavsiye');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Son ziyaret');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'Genel arama terimleri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Terimi ara');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Araştır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Forumlarda Ara');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Konuları ara');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Mesajlarda ara');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Sadece konu ara');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'ipler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Aksiyon');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Gönderildi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'Hiçbir forum bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Asla');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'Yanıt bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'Konu bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'Üye bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'yazdı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Düzenleme');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Konuyu düzenle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Yanıtınız başarıyla kaydedildi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Yanıtınız başarıyla eklendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Forumunuz başarıyla eklendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'Üyeler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'yardım et');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Bir veya daha fazla arama terimi girin, her En Az 4 karakter olmalıdır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'daha fazla yükle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Olaylar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'gidiş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'ilgili');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'geçmiş');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'Davetli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'Gidiyorsun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'İlgilisin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Başlangıç tarihi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'Bitiş tarihi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Olay');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'Etkinlik bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Beğeneceğiniz etkinlikler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'İnsanlara gidiyor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'İlgilenen insanlar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Davet edilenler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Etkinliğiniz başarıyla eklendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Etkinlik kaydedildi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'Sen bu etkinliği silmek istediğinizden emin misiniz');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Konum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'konu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Gitmek');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'Yeni bir etkinlik yarattı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'Etkinliklerim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', '"{Event_name}" etkinliğinizle ilgileniyor.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', '"{Event_name}" etkinliğine gidiyor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'Sizi "{event_name}" etkinliğine davet etti.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'Cevabınız cevaplandı');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Replies');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Last Post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Threads search');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Create new topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Jump to');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'My threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'My Messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Headline');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Your post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Reply');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Started by');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Site Admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Registered');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'posts');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Reply to this topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Topic review');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Your Reply');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'List of users');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Posts count');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Referrals');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Last visit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'General search terms');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Search for term');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Search in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Search Forums');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Search in threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Search in messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Search subject only');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Action');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Posted');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'No forums found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Never');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'No replies found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'No threads found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'No members found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'wrote');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Edit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Edit topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Your reply was successfully saved');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Your reply was successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Your forum has been successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'New Members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Help');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Type in one or more search terms, each must be at least 4 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Load more');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Events');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Going');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interested');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Pastor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'invited');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'You are going');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'You are interested');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Start date');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'End date');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'No events found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Events you may like');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Going people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Interested people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Invited people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Your event was successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Your event was successfully saved.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'You are sure that you want to delete this event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Location');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Subject');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Go');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'created new event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'My events');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'is interested on your event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'is going to your event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'invited you to go the event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'replied to your topic');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum', 'Forum');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replies', 'Replies');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_post', 'Last Post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic', 'topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thread_search', 'Threads search');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_topic', 'Create new topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'jump_to', 'Jump to');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_threads', 'My threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_messages', 'My Messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'headline', 'Headline');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_post', 'Your post');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply', 'Reply');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'started_by', 'Started by');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'site_admin', 'Site Admin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'registered', 'Registered');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posts', 'posts');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_to_topic', 'Reply to this topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'topic_review', 'Topic review');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'your_reply', 'Your Reply');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'list_of_users', 'List of users');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'post_count', 'Posts count');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'referrals', 'Referrals');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'last_visit', 'Last visit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'general_search_terms', 'General search terms');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_for_term', 'Search for term');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in', 'Search in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_forums', 'Search Forums');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_threads', 'Search in threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_in_messages', 'Search in messages');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_subject_only', 'Search subject only');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'threads', 'threads');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'action', 'Action');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted', 'Posted');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_forums_found', 'No forums found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'never', 'Never');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_replies_found', 'No replies found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_threads_found', 'No threads found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_members_found', 'No members found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'wrote', 'wrote');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit', 'Edit');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'edit_topic', 'Edit topic');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_saved', 'Your reply was successfully saved');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'reply_added', 'Your reply was successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'forum_post_added', 'Your forum has been successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'members', 'New Members');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'help', 'Help');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'search_terms_more4', 'Type in one or more search terms, each must be at least 4 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more', 'Load more');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'events', 'Events');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going', 'Going');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested', 'Interested');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'past', 'Pastor');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited', 'invited');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_going', 'You are going');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'you_are_interested', 'You are interested');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'start_date', 'Start date');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'end_date', 'End date');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event', 'Event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_events_found', 'No events found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_you_may_like', 'Events you may like');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'going_people', 'Going people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'interested_people', 'Interested people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_people', 'Invited people');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_added', 'Your event was successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'event_saved', 'Your event was successfully saved.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'confirm_delete_event', 'You are sure that you want to delete this event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'location', 'Location');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'subject', 'Subject');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'go', 'Go');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_event', 'created new event');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_events', 'My events');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_interested', 'is interested on your event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'is_going', 'is going to your event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'invited_you_event', 'invited you to go the event "{event_name}"');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'replied_to_topic', 'replied to your topic'); 
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.4.5!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();