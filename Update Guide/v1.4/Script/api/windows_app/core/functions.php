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
$non_allowed = array(
    'password',
    'background_image',
    'background_image_status',
    'email_code',
    'follow_privacy',
    'post_privacy',
    'message_privacy',
    'confirm_followers',
    'show_activities_privacy',
    'birth_privacy',
    'visit_privacy',
    'emailNotification',
    'e_liked',
    'e_wondered',
    'e_shared',
    'e_followed',
    'e_commented',
    'e_visited',
    'e_mentioned',
    'e_liked_page',
    'e_joined_group',
    'e_accepted',
    'e_profile_wall_post',
    'type',
    'start_up',
    'start_up_info',
    'startup_follow',
    'startup_image',
    'id',
    'cover_full',
    'cover_org',
    'avatar_org',
    'app_session',
    'last_email_sent',
    'sms_code',
    'pro_time',
    'css_file',
    'src',
    'country_id'
);
function Wo_GetMessagesUsersAPP($user_id, $searchQuery = '', $limit = 50, $new = false, $update = 0, $session_id = 0) {
    global $wo, $sqlConnect;
    if (empty($session_id)) {
        if ($wo['loggedin'] == false) {
           return false;
        }
    }
    if (!is_numeric($user_id) or $user_id < 1) {
        return false;
    }
    if (!isset($user_id)) {
        $user_id = $wo['user']['user_id'];
    }
    $data     = array();
    $excludes = array();
    if (isset($searchQuery) AND !empty($searchQuery)) {
        $query_one = " SELECT `user_id` FROM " . T_USERS . " WHERE (`user_id` IN (SELECT `from_id` FROM " . T_MESSAGES . " WHERE `to_id` = {$user_id} AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1' ";
        if (isset($new) && $new == true) {
            $query_one .= " AND `seen` = 0";
        }
        $query_one .= " ORDER BY `user_id` DESC)";
        if (!isset($new) or $new == false) {
            $query_one .= " OR `user_id` IN (SELECT `to_id` FROM " . T_MESSAGES . " WHERE `from_id` = {$user_id} ORDER BY `id` DESC)";
        }
        $query_one .= ") AND ((`username` LIKE '%{$searchQuery}%') OR CONCAT( `first_name`,  ' ', `last_name` ) LIKE  '%{$searchQuery}%')";
    } else {
       $query_one = "SELECT a.*, (
    SELECT max(time)
    FROM " . T_MESSAGES . " b
    WHERE b.from_id = a.user_id OR b.to_id = a.user_id
    ) as ord
    FROM " . T_USERS . " a WHERE (`user_id` IN (SELECT `from_id` FROM " . T_MESSAGES . " WHERE `to_id` = {$user_id} AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1'";
        if (isset($new) && $new == true) {
            $query_one .= " AND `seen` = 0";
        }
        $query_one .= " ORDER BY `user_id` DESC)";
        if (!isset($new) or $new == false) {
            $query_one .= " OR `user_id` IN (SELECT `to_id` FROM " . T_MESSAGES . " WHERE `from_id` = {$user_id} ORDER BY `id` DESC)";
        }
        $query_one .= ") ORDER BY ord DESC LIMIT 15";
    }
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    if (mysqli_num_rows($sql_query_one) > 0) {
        while ($sql_fetch_one = mysqli_fetch_assoc($sql_query_one)) {
            $data[]     = Wo_UserData($sql_fetch_one['user_id']);
            $excludes[] = $sql_fetch_one['user_id'];
        }
    }
    $exclude_query_string = 0;
    $exclude_i            = 0;
    $excludes_num         = count($excludes);
    if ($excludes_num > 0) {
        $exclude_query_string = '';
        foreach ($excludes as $exclude) {
            $exclude_i++;
            $exclude_query_string .= $exclude;
            if ($exclude_i != $excludes_num) {
                $exclude_query_string .= ',';
            }
        }
    }
    $query_two = "SELECT `user_id` FROM " . T_USERS . " WHERE `user_id` IN (SELECT `following_id` FROM " . T_FOLLOWERS . " WHERE `follower_id` = {$user_id} AND `following_id` NOT IN ({$user_id}, {$exclude_query_string}) AND `active` = '1') AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1'";
    if (!empty($searchQuery)) {
        $query_two .= " AND ((`username` LIKE '%$searchQuery%') OR CONCAT( first_name,  ' ', last_name ) LIKE  '%{$searchQuery}%')";
    }
    if (empty($limit) || $limit < 1) {
        $limit = 30;
    }
    $query_two .= " ORDER BY `user_id` DESC LIMIT 15";
    $sql_query_two = mysqli_query($sqlConnect, $query_two);
    while ($sql_fetch_two = mysqli_fetch_assoc($sql_query_two)) {
        $data[] = Wo_UserData($sql_fetch_two['user_id']);
    }
    return $data;
}

function Wo_ChatSearchUsersAPP($search_query = '', $user_session = '', $user_id = 0) {
    global $sqlConnect, $wo;
    if (empty($user_session)) {
        if ($wo['loggedin'] == false) {
           return false;
        }
    }
    if (empty($user_id)) {
        return false;
    }
    $data         = array();
    $search_query = Wo_Secure($search_query);
    $user_id      = Wo_Secure($user_id);
    $query_one    = "SELECT `user_id` FROM " . T_USERS . " WHERE (`user_id` IN (SELECT `following_id` FROM " . T_FOLLOWERS . " WHERE `follower_id` = {$user_id} AND `following_id` <> {$user_id} AND `active` = '1') AND `active` = '1'";
    if (isset($search_query) && !empty($search_query)) {
        $query_one .= " AND ((`username` LIKE '%$search_query%') OR CONCAT(`first_name`,  ' ', `last_name`) LIKE  '%{$search_query}%'))";
    }
    $query_one .= " ORDER BY `first_name` LIMIT 20";
    $query = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = Wo_UserData($fetched_data['user_id']);
    }
    return $data;
}

function Wo_GetChatUsersAPP($user_id = 0, $type = 'online', $search_query = '') {
    global $sqlConnect, $wo;
    $data       = array();
    $time       = time() - 60;
    $user_id    = Wo_Secure($user_id);
    $query_text = "SELECT `user_id` FROM " . T_USERS . " WHERE `user_id` IN (SELECT `following_id` FROM " . T_FOLLOWERS . " WHERE `follower_id` = {$user_id} AND `following_id` <> {$user_id} AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1')";
    if ($type == 'online') {
        $query_text .= " AND `lastseen` > {$time}";
    } else if ($type == 'offline') {
        $query_text .= " AND `lastseen` < {$time}";
    }
    if (isset($search_query) && !empty($search_query)) {
        $search_query = Wo_Secure($search_query);
        $query_one .= " AND ((`username` LIKE '%$search_query%') OR CONCAT(`first_name`,  ' ', `last_name`) LIKE  '%{$search_query}%'))";
    }
    $query_text .= " AND `active` = '1' ORDER BY `lastseen` DESC";
    if ($type == 'offline') {
        $query_text .= ' LIMIT 30';
    }
    $query = mysqli_query($sqlConnect, $query_text);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = Wo_UserData($fetched_data['user_id']);
    }
    return $data;
}

function Wo_GetMessagesAPP($data = array(), $limit = 50) {
    global $wo, $sqlConnect;
    $message_data   = array();
    $user_id        = Wo_Secure($data['recipient_id']);
    $logged_user_id = Wo_Secure($data['user_id']);
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    $query_one = " SELECT * FROM " . T_MESSAGES;
    if (isset($data['new']) && $data['new'] == true) {
        $query_one .= " WHERE `seen` = 0 AND `from_id` = {$user_id} AND `to_id` = {$logged_user_id}";
    } else {
        $query_one .= " WHERE ((`from_id` = {$user_id} AND `to_id` = {$logged_user_id}) OR (`from_id` = {$logged_user_id} AND `to_id` = {$user_id}))";
    }
    if (!empty($data['message_id'])) {
        $data['message_id'] = Wo_Secure($data['message_id']);
        $query_one .= " AND `id` = " . $data['message_id'];
    } else if (!empty($data['before_message_id']) && is_numeric($data['before_message_id']) && $data['before_message_id'] > 0) {
        $data['before_message_id'] = Wo_Secure($data['before_message_id']);
        $query_one .= " AND `id` < " . $data['before_message_id'] . " AND `id` <> " . $data['before_message_id'];
    } else if (!empty($data['after_message_id']) && is_numeric($data['after_message_id']) && $data['after_message_id'] > 0) {
        $data['after_message_id'] = Wo_Secure($data['after_message_id']);
        $query_one .= " AND `id` > " . $data['after_message_id'] . " AND `id` <> " . $data['after_message_id'];
    }
    $sql_query_one    = mysqli_query($sqlConnect, $query_one);
    $query_limit_from = mysqli_num_rows($sql_query_one) - 50;
    if ($query_limit_from < 1) {
        $query_limit_from = 0;
    }
    if (isset($limit)) {
        if (!empty($data['before_message_id']) && is_numeric($data['before_message_id']) && $data['before_message_id'] > 0) {
            $query_one .= " ORDER BY `id` DESC LIMIT {$query_limit_from}, 50";
        } else {
            $query_one .= " ORDER BY `id` ASC LIMIT {$query_limit_from}, 50";
        }
    }
    $query = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['messageUser'] = Wo_UserData($fetched_data['from_id']);
        $fetched_data['messageUser'] = array('user_id' => $fetched_data['messageUser']['user_id'], 'avatar' => $fetched_data['messageUser']['avatar']);
        $fetched_data['text']        = Wo_EditMarkup($fetched_data['text']);
        $message_data[]              = $fetched_data;
        if ($fetched_data['messageUser']['user_id'] == $user_id && $fetched_data['seen'] == 0) {
            mysqli_query($sqlConnect, " UPDATE " . T_MESSAGES . " SET `seen` = " . time() . " WHERE `id` = " . $fetched_data['id']);
        }
    }
    return $message_data;
}

function Wo_GetFilePosition($file) {
    $file_type = 'text';
    if (empty($file)) {
        return $file_type;
    }
    $file_extension = pathinfo($file, PATHINFO_EXTENSION);
    if ($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif') {
        $file_type = 'image';
    } else if ($file_extension == 'mp4' || $file_extension == 'mkv' || $file_extension == 'avi' || $file_extension == 'mov') {
        $file_type = 'video';
    } else if ($file_extension == 'mp3' || $file_extension == 'wav') {
        $file_type = 'audio';
    } else {
        $file_type = 'file';
    } 
    return $file_type;
}


function Wo_RegisterAPPTyping($user_id = 0, $recipient_id = 0, $isTyping = 1) {
    global $wo, $sqlConnect;
    if (empty($recipient_id) || !is_numeric($recipient_id) || $recipient_id < 0) {
        return false;
    }
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    $user_id      = Wo_Secure($user_id);
    $recipient_id = Wo_Secure($recipient_id);
    $typing       = 1;
    if ($isTyping == 0) {
        $typing = 0;
    }
    /*if (Wo_IsFollowing($user_id, $recipient_id) === false) {
        //return false;
    }*/
    $query = mysqli_query($sqlConnect, "UPDATE " . T_FOLLOWERS . " SET `is_typing` = '$typing' WHERE `following_id` = '{$user_id}' AND `follower_id` = {$recipient_id}");
    if ($query) {
        return true;
    }
}

function Wo_IsAppTyping($user_id = 0, $recipient_id = 0) {
    global $wo, $sqlConnect;
    if (empty($recipient_id) || !is_numeric($recipient_id) || $recipient_id < 0) {
        return false;
    }
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    $user_id      = Wo_Secure($user_id);
    $recipient_id = Wo_Secure($recipient_id);
    $query        = "SELECT `is_typing` FROM " . T_FOLLOWERS . " WHERE `follower_id` = '{$user_id}' AND `following_id` = '{$recipient_id}' AND `is_typing` = '1'";
    $query_one    = mysqli_query($sqlConnect, $query);
    return (Wo_Sql_Result($query_one, 0) == 1) ? true : false;
}