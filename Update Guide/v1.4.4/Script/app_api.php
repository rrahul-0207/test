<?php
// +------------------------------------------------------------------------+
// | @author Deen Doughouz (DoughouzForest)
// | @author_url 1: http://www.wowonder.com
// | @author_url 2: http://codecanyon.net/user/doughouzforest
// | @author_email: wowondersocial@gmail.com   
// +------------------------------------------------------------------------+
// | WoWonder - The Ultimate Social Networking Platform
// | Copyright (c) 2017 WoWonder. All rights reserved.
// +------------------------------------------------------------------------+
require_once('assets/init.php');
$api_version = '1.4';
$type        = '';
$applications = array('phone', 'windows_app');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$application = 'windows_app';
if (!empty($_GET['application'])) {
    if (in_array($_GET['application'], $applications)) {
        $application = Wo_Secure($_GET['application']);
    }
}
if (!empty($_GET['type'])) {
    $type = Wo_Secure($_GET['type']);
}
require_once('./api/' . $application . '/core/functions.php');
if ($application == 'windows_app') {
    switch ($type) {
        case 'user_login':
            include "api/$application/login.php";
            break;
        case 'get_users_list':
            include "api/$application/get_users_list.php";
            break;
        case 'get_user_data':
            include "api/$application/get_user_data.php";
            break;
        case 'get_multi_users':
            include "api/$application/get_multi_users.php";
            break;
        case 'get_user_posts':
            include "api/$application/get_user_posts_friends.php";
            break;
        case 'get_user_messages':
            include "api/$application/get_user_messages.php";
            break;
        case 'insert_new_message':
            include "api/$application/insert_new_message.php";
            break;
        case 'update_user_lastseen':
            include "api/$application/update_user_lastseen.php";
            break;
        case 'get_settings':
            include "api/$application/get_settings.php";
            break;
        case 'logout':
            include "api/$application/logout.php";
            break;
        case 'register_typing':
            include "api/$application/register_typing.php";
            break;
        case 'remove_typing':
            include "api/$application/remove_typing.php";
            break;   
    }
} else if ($application == 'phone') {
    require_once('assets/import/vendor/autoload.php');
    require_once('assets/import/config.php');
    require_once('assets/import/vendor/hybridauth/hybridauth/hybridauth/Hybrid/thirdparty/Facebook/autoload.php');
    switch ($type) {
        case 'user_login':
            include "api/$application/login.php";
            break;
        case 'user_login_with':
            include "api/$application/login-with.php";
            break;
        case 'check_hash':
            include "api/$application/check-hash.php";
            break;
        case 'get_suggestions':
            include "api/$application/get_suggestions.php";
            break;    
        case 'user_registration':
            include "api/$application/register_user.php";
            break;   
        case 'update_profile_picture':
            include "api/$application/update_profile_picture.php";
            break;    
        case 'get_users_list':
            include "api/$application/get_users_list.php";
            break;
        case 'get_users_friends':
            include "api/$application/get_user_friends.php";
            break;    
        case 'get_user_data':
            include "api/$application/get_user_data.php";
            break;
        case 'get_multi_users':
            include "api/$application/get_multi_users.php";
            break;
        case 'get_user_posts':
            include "api/$application/get_user_posts_friends.php";
            break;
        case 'get_user_messages':
            include "api/$application/get_user_messages.php";
            break;
        case 'insert_new_message':
            include "api/$application/insert_new_message.php";
            break;
        case 'update_user_lastseen':
            include "api/$application/update_user_lastseen.php";
            break;
        case 'get_settings':
            include "api/$application/get_settings.php";
            break;
        case 'logout':
            include "api/$application/logout.php";
            break;
        case 'register_typing':
            include "api/$application/register_typing.php";
            break;
        case 'remove_typing':
            include "api/$application/remove_typing.php";
            break;   
        case 'follow_user':
            include "api/$application/follow_user.php";
            break; 
        case 'search_public_users':
            include "api/$application/search_public_users.php";
            break; 
        case 'update_user_data':
            include "api/$application/update_user_data.php";
            break;
        case 'delete_messages':
            include "api/$application/delete_messages.php";
            break;
        case 'get_push_notifications':
            include "api/$application/get_push_notifications.php";
            break;    
    }
}
mysqli_close($sqlConnect);
unset($wo);
?>