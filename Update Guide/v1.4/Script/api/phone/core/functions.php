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

function Wo_GetMessagesUsersAPP($fetch_array = array()) {
    global $wo, $sqlConnect;
    if (empty($fetch_array['session_id'])) {
        if ($wo['loggedin'] == false) {
            return false;
        }
    }
    if (!is_numeric($fetch_array['user_id']) or $fetch_array['user_id'] < 1) {
        return false;
    }
    if (!isset($fetch_array['user_id'])) {
        $user_id = $wo['user']['user_id'];
    }
    $user_id     = Wo_Secure($fetch_array['user_id']);
    $searchQuery = '';
    if (!empty($fetch_array['searchQuery'])) {
        $searchQuery = Wo_Secure($fetch_array['searchQuery']);
    }
    $data     = array();
    $excludes = array();
    if (isset($searchQuery) AND !empty($searchQuery)) {
        $query_one = "SELECT `user_id` FROM " . T_USERS . " WHERE (`user_id` IN (SELECT `from_id` FROM " . T_MESSAGES . " WHERE `to_id` = {$user_id} AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1' ";
        if (isset($fetch_array['new']) && $fetch_array['new'] == true) {
            $query_one .= " AND `seen` = 0";
        }
        $query_one .= " ORDER BY `user_id` DESC)";
        if (!isset($fetch_array['new']) or $fetch_array['new'] == false) {
            $query_one .= " OR `user_id` IN (SELECT `to_id` FROM " . T_MESSAGES . " WHERE `from_id` = {$user_id} ORDER BY `id` DESC)";
        }
        $query_one .= ") AND ((`username` LIKE '%{$searchQuery}%') OR CONCAT( `first_name`,  ' ', `last_name` ) LIKE  '%{$searchQuery}%')";
        if (!empty($fetch_array['limit'])) {
            $limit = Wo_Secure($fetch_array['limit']);
            $query_one .= "LIMIT {$limit}";
        }
    } else {
        $query_one = "SELECT a.*, (
    SELECT max(time)
    FROM " . T_MESSAGES . " b
    WHERE (b.from_id = a.user_id OR b.to_id = a.user_id)
    ) as ord
    FROM " . T_USERS . " a WHERE (`user_id` IN (SELECT `from_id` FROM " . T_MESSAGES . " WHERE `to_id` = {$user_id} AND `user_id` NOT IN (SELECT `blocked` FROM " . T_BLOCKS . " WHERE `blocker` = '{$user_id}') AND `user_id` NOT IN (SELECT `blocker` FROM " . T_BLOCKS . " WHERE `blocked` = '{$user_id}') AND `active` = '1'";
        if (!isset($fetch_array['new']) or $fetch_array['new'] == true) {
            $query_one .= " AND `seen` = 0";
        }
        $query_one .= " ORDER BY `user_id` DESC)";
        if (!isset($fetch_array['new']) or $fetch_array['new'] == false) {
            $query_one .= " OR `user_id` IN (SELECT `to_id` FROM " . T_MESSAGES . " WHERE `from_id` = {$user_id} ORDER BY `id` DESC)";
        }
        $query_one .= ") ORDER BY ord DESC";
    }
    if (!empty($fetch_array['limit'])) {
        $limit = Wo_Secure($fetch_array['limit']);
        $query_one .= " LIMIT {$limit}";
    }
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    if (mysqli_num_rows($sql_query_one) > 0) {
        while ($sql_fetch_one = mysqli_fetch_assoc($sql_query_one)) {
            $data[] = Wo_UserData($sql_fetch_one['user_id']);
        }
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
        $fetched_data['messageUser'] = array(
            'user_id' => $fetched_data['messageUser']['user_id'],
            'avatar' => $fetched_data['messageUser']['avatar']
        );
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

function Wo_UploadAPPImage($file, $name, $type, $type_file, $user_id = 0, $placement = '') {
    global $wo, $sqlConnect;
    if (empty($file) || empty($name) || empty($type) || empty($user_id)) {
        return false;
    }
    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if (!file_exists('upload/photos/' . date('Y'))) {
        mkdir('upload/photos/' . date('Y'), 0777, true);
    }
    if (!file_exists('upload/photos/' . date('Y') . '/' . date('m'))) {
        mkdir('upload/photos/' . date('Y') . '/' . date('m'), 0777, true);
    }
    $allowed           = 'jpg,png,jpeg,gif';
    $new_string        = pathinfo($name, PATHINFO_FILENAME) . '.' . strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $extension_allowed = explode(',', $allowed);
    $file_extension    = pathinfo($new_string, PATHINFO_EXTENSION);
    if (!in_array($file_extension, $extension_allowed)) {
        return false;
    }
    $ar = array(
        'image/png',
        'image/jpeg',
        'image/gif'
    );
    if (!in_array($type_file, $ar)) {
        return false;
    }
    $dir                   = 'upload/photos/' . date('Y') . '/' . date('m');
    $image_data['user_id'] = Wo_Secure($user_id);
    if ($type == 'cover') {
        $query_one_delete_cover = mysqli_query($sqlConnect, " SELECT `cover` FROM " . T_USERS . " WHERE `user_id` = " . $image_data['user_id'] . " AND `active` = '1'");
        $fetched_data           = mysqli_fetch_assoc($query_one_delete_cover);
        $filename               = $dir . '/' . Wo_GenerateKey() . '_' . date('d') . '_' . md5(time()) . '_cover.' . $ext;
        $image_data['cover']    = $filename;
        if (move_uploaded_file($file, $filename)) {
            $update_data = false;
            $update_data = Wo_UpdateAPPUserData($image_data['user_id'], $image_data);
            if ($update_data) {
                $last_file = $filename;
                $explode2  = @end(explode('.', $filename));
                $explode3  = @explode('.', $filename);
                $last_file = $explode3[0] . '_full.' . $explode2;
                @Wo_CompressImage($filename, $last_file, 50);
            }
            if ($update_data == true) {
                Wo_Resize_Crop_Image(1000, 400, $filename, $filename, 80);
                return true;
            }
            return true;
        }
    } else if ($type == 'avatar') {
        $filename             = $dir . '/' . Wo_GenerateKey() . '_' . date('d') . '_' . md5(time()) . '_avatar.' . $ext;
        $image_data['avatar'] = $filename;
        if (move_uploaded_file($file, $filename)) {
            $image_data['startup_image'] = 1;
            if (Wo_UpdateAPPUserData($image_data['user_id'], $image_data)) {
                $explode2  = @end(explode('.', $filename));
                $explode3  = @explode('.', $filename);
                $last_file = $explode3[0] . '_full.' . $explode2;
                Wo_CompressImage($filename, $last_file, 50);
                Wo_Resize_Crop_Image($wo['profile_picture_width_crop'], $wo['profile_picture_height_crop'], $filename, $filename, $wo['profile_picture_image_quality']);
                return true;
            }
        }
    }
}
function Wo_UpdateAPPUserData($user_id = 0, $update_data = array()) {
    global $wo, $sqlConnect;
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    $user_id = Wo_Secure($user_id);
    if (!empty($update_data['relationship'])) {
        if (!array_key_exists($update_data['relationship'], $wo['relationship'])) {
            $update_data['relationship_id'] = 1;
        }
    } 
    if (isset($update_data['country_id'])) {
        if (!array_key_exists($update_data['country_id'], $wo['countries_name'])) {
            $update_data['country_id'] = 1;
        }
    }
    if (empty($update_data['relationship_id'])) {
        $update_data['relationship_id'] = 0;
    }
    $update = array();
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = " UPDATE " . T_USERS . " SET {$impload} WHERE `user_id` = {$user_id}";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        return true;
    } else {
        return false;
    }
}