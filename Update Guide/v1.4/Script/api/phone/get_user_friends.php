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
$json_error_data   = array();
$json_success_data = array();
if (empty($_GET['type']) || !isset($_GET['type'])) {
    $json_error_data = array(
        'api_status' => '400',
        'api_text' => 'failed',
        'api_version' => $api_version,
        'errors' => array(
            'error_id' => '1',
            'error_text' => 'Bad request, no type specified.'
        )
    );
    header("Content-type: application/json");
    echo json_encode($json_error_data, JSON_PRETTY_PRINT);
    exit();
}
$type = Wo_Secure($_GET['type'], 0);
if ($type == 'get_users_friends') {
    if (empty($_POST['user_id'])) {
        $json_error_data = array(
            'api_status' => '400',
            'api_text' => 'failed',
            'api_version' => $api_version,
            'errors' => array(
                'error_id' => '3',
                'error_text' => 'No user id sent.'
            )
        );
    } else if (empty($_POST['s'])) {
        $json_error_data = array(
            'api_status' => '400',
            'api_text' => 'failed',
            'api_version' => $api_version,
            'errors' => array(
                'error_id' => '5',
                'error_text' => 'No session sent.'
            )
        );
    }
    if (empty($json_error_data)) {
        $user_id         = $_POST['user_id'];
        $s      = Wo_Secure(md5($_POST['s']));
        $user_login_data = Wo_UserData($user_id);
        $lang_path = 'assets/languages/' . $user_login_data['language'] . '.php';
        require $lang_path;
        if (empty($user_login_data)) {
            $json_error_data = array(
                'api_status' => '400',
                'api_text' => 'failed',
                'api_version' => $api_version,
                'errors' => array(
                    'error_id' => '6',
                    'error_text' => 'Username is not exists.'
                )
            );
            header("Content-type: application/json");
            echo json_encode($json_error_data, JSON_PRETTY_PRINT);
            exit();
        } else if (Wo_CheckUserSessionID($user_id, $s, 'windows') === false) {
            $json_error_data = array(
                'api_status' => '400',
                'api_text' => 'failed',
                'api_version' => $api_version,
                'errors' => array(
                    'error_id' => '6',
                    'error_text' => 'Session id is wrong.'
                )
            );
            header("Content-type: application/json");
            echo json_encode($json_error_data, JSON_PRETTY_PRINT);
            exit();
        } else {
            $timezone = new DateTimeZone($user_login_data['timezone']);
            $get = Wo_GetFollowing($user_id, 'profile', 15);
            foreach ($get as $user_list) {
                $lastseen = ($user_list['lastseen'] > (time() - 60)) ? 'on' : 'off';
                if (mb_strlen($user_list['name']) > 18) {
                    $user_list['name'] = mb_substr($user_list['name'], 0, 18, "UTF-8") . '..';
                }
                $json_data   = array(
                    'user_id' => $user_list['user_id'],
                    'username' => $user_list['username'],
                    'name' => $user_list['name'],
                    'profile_picture' => $user_list['avatar'],
                    'cover_picture' => $user_list['cover'],
                    'verified' => $user_list['verified'],
                    'lastseen' => $lastseen,
                    'lastseen_unix_time' => $user_list['lastseen'],
                    'lastseen_time_text' => Wo_Time_Elapsed_String($user_list['lastseen']),
                    'url' => $user_list['url']
                );
                array_push($json_success_data, $json_data);
            }
            header("Content-type: application/json");
            echo json_encode(array(
                'api_status' => 200,
                'api_text' => 'success',
                'api_version' => $api_version,
                'theme_url' => $config['theme_url'],
                'users' => $json_success_data
            ));
            exit();
        }
    } else {
        header("Content-type: application/json");
        echo json_encode($json_error_data);
        exit();
    }
}
header("Content-type: application/json");
echo json_encode($json_success_data);
exit();
?>