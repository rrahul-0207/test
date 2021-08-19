<?php

require_once('assets/init.php');
// use Aws\S3\S3Client;
// use Twilio\Jwt\AccessToken;
// use Twilio\Jwt\Grants\VideoGrant;

use Plivo\RestClient;
$f = '';
$s = '';
if (isset($_GET['f'])) {
    $f = Wo_Secure($_GET['f'], 0);
}
if (isset($_GET['s'])) {
    $s = Wo_Secure($_GET['s'], 0);
}
//if(isset($_POST))//{echo '<pre>';print_r($_POST);die;}
$hash_id = '';
if (!empty($_POST['hash_id'])) {
    $hash_id = $_POST['hash_id'];
} else if (!empty($_GET['hash_id'])) {
    $hash_id = $_GET['hash_id'];
} else if (!empty($_GET['hash'])) {
    $hash_id = $_GET['hash'];
} else if (!empty($_POST['hash'])) {
    $hash_id = $_POST['hash'];
}
$data = array();
if ($f == 'session_status') {
    if ($wo['loggedin'] == false) {
        $data = array(
            'status' => 200
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_welcome_users') {
    $html = '';
    foreach (Wo_WelcomeUsers() as $wo['user']) {
        $html .= Wo_LoadPage('welcome/user-list');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'upass') {
    $newpass =$_POST['newpass'];
    $confirmpass=$_POST['confirmpass'];
    if (empty($newpass) || empty($confirmpass) ) {
        $errors = $error_icon . $wo['lang']['please_check_details'];
    } /*else if($html!=$_SESSION['otp'])
        {
          $errors = $error_icon . "Your OTP is incorrect";
        }*/
    if($newpass != $confirmpass){
        $errors = $error_icon . "Passwords do not match.";
    }        
     else{
         $email=$_GET['phno'];
          $user=Wo_UserExistsViaPhone($email);
          $new_pass=$_POST['newpass'];
          $result=Wo_UpdatePassword($user,$new_pass);
            $data = array(
                'status' => 200,
                'html' => $email
            );
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
    
}

if ($f == 'otpCode') {
  
    $html =$_POST['register_otp'];
   
    if (empty($html)) {
        $errors = $error_icon . $wo['lang']['please_check_details'];
    } else if($html!=$_SESSION['otp'])
        {
          $errors = $error_icon . "Your OTP is incorrect";
       }
     else{
    
    
        $data = array(
            'status' => 200,
            'html' => $html
        );
        
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
    
}


if ($f == 'load_posts') {
    $load = Wo_LoadPage('home/load-posts');
    echo $load;
    exit();
}
if ($f == 'save_user_location' && isset($_POST['lat']) && isset($_POST['lng'])) {
    $lat          = $_POST['lat'];
    $lng          = $_POST['lng'];
    $update_array = array(
        'lat' => $lat,
        'lng' => $lng,
        'last_location_update' => (strtotime("+1 week"))
    );
    $data         = array(
        'status' => 304
    );
    if (Wo_UpdateUserData($wo['user']['id'], $update_array)) {
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'load-more-groups') {
    $offset = (isset($_GET['offset']) && is_numeric($_GET['offset'])) ? $_GET['offset'] : false;
    $query  = $_GET['query'];
    $html   = "";
    $data   = array(
        "status" => 404,
        "html" => $html
    );
    if ($offset) {
        $groups = Wo_GetSearchAdv($query, 'groups', $offset);
        if (count($groups) > 0) {
            foreach ($groups as $wo['result']) {
                $html .= Wo_LoadPage('search/result');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'load-more-pages') {
    $offset = (isset($_GET['offset']) && is_numeric($_GET['offset'])) ? $_GET['offset'] : false;
    $query  = $_GET['query'];
    $html   = "";
    $data   = array(
        "status" => 404,
        "html" => $html
    );
    if ($offset) {
        $groups = Wo_GetSearchAdv($query, 'pages', $offset);
        if (count($groups) > 0) {
            foreach ($groups as $wo['result']) {
                $html .= Wo_LoadPage('search/result');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'load-more-users') {
    $offset = (isset($_GET['offset']) && is_numeric($_GET['offset'])) ? $_GET['offset'] : false;
    $query  = $_GET['query'];
    $html   = "";
    $data   = array(
        "status" => 404,
        "html" => $html
    );
    if ($offset) {
        $groups = Wo_GetSearchFilter(array(
            'query' => $query
        ), 10, $offset);
        if (count($groups) > 0) {
            foreach ($groups as $wo['result']) {
                $html .= Wo_LoadPage('search/result');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'load_profile_posts') {
    if (!empty($_GET['user_id'])) {
        $wo['page']         = 'timeline';
        $wo['user_profile'] = Wo_UserData($_GET['user_id']);
        $load               = Wo_LoadPage('timeline/load-posts');
        echo $load;
        exit();
    }
}
if ($f == 'confirm_user') {
    if (isset($_POST['confirm_code']) && isset($_POST['user_id'])) {
        $confirm_code = $_POST['confirm_code'];
        $user_id      = $_POST['user_id'];
        if (empty($_POST['confirm_code'])) {
            $errors = $error_icon . $wo['lang']['please_check_details'];
        } else if (empty($_POST['user_id'])) {
            $errors = $error_icon . $wo['lang']['error_while_activating'];
        }
        $confirm_code = Wo_ConfirmUser($user_id, $confirm_code);
        if ($confirm_code === false) {
            $errors = $error_icon . $wo['lang']['wrong_confirmation_code'];
        }
        if (empty($errors) && $confirm_code === true) {
            $session             = Wo_CreateLoginSession($user_id);
            $data                = array(
                'status' => 200
            );
            $_SESSION['user_id'] = $session;
            setcookie("user_id", $session, time() + (10 * 365 * 24 * 60 * 60));
            if (!empty($_POST['last_url'])) {
                $data['location'] = $_POST['last_url'];
            } else {
                $data['location'] = $wo['config']['site_url'];
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'resned_code') {
    if (isset($_POST['user_id'])) {
        $user = Wo_UserData($_POST['user_id']);
        if (empty($user) || empty($_POST['user_id']) || empty($_POST['phone_number'])) {
            $errors = $wo['lang']['failed_to_send_code'];
        }
        if (!preg_match('/^\+?\d+$/', $_POST['phone_number'])) {
            $errors = $wo['lang']['worng_phone_number'];
        }
        if (Wo_PhoneExists($_POST['phone_number']) === true) {
            if ($user['phone_number'] != $_POST['phone_number']) {
                $errors = $wo['lang']['phone_already_used'];
            }
        }
        if (empty($errors)) {
            $random_activation = Wo_Secure(rand(11111, 99999));
            $message           = "Your confirmation code is: {$random_activation}";
            $user_id           = $_POST['user_id'];
            $query             = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `sms_code` = '{$random_activation}' WHERE `user_id` = {$user_id}");
            if ($query) {
                if (Wo_SendSMSMessage($_POST['phone_number'], $message) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['sms_has_been_sent']
                    );
                } else {
                    $errors = $wo['lang']['error_while_sending_sms'];
                }
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'resned_code_ac') {
    if (isset($_SESSION['code_id'])) {
        $user = Wo_UserData($_SESSION['code_id']);
        if (empty($user) || empty($_SESSION['code_id']) || empty($user['phone_number'])) {
            $errors[] = $error_icon . $wo['lang']['failed_to_send_code'];
        }
        if (empty($errors)) {
            $random_activation = Wo_Secure(rand(11111, 99999));
            $message           = "Your confirmation code is: {$random_activation}";
            $user_id           = $user['user_id'];
            $query             = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `sms_code` = '{$random_activation}' WHERE `user_id` = {$user_id}");
            if ($query) {
                if (Wo_SendSMSMessage($user['phone_number'], $message) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['sms_has_been_sent']
                    );
                } else {
                    $errors[] = $error_icon . $wo['lang']['error_while_sending_sms'];
                }
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'resned_ac_email') {
    if (isset($_SESSION['code_id'])) {
        $email   = 0;
        $phone   = 0;
        $user_id = $_SESSION['code_id'];
        $user    = Wo_UserData($_SESSION['code_id']);
        if (empty($user) || empty($_SESSION['code_id']) || (empty($_POST['phone_number']) && empty($_POST['email']))) {
            $errors[] = $error_icon . $wo['lang']['failed_to_send_code_fill'];
        }
        if (!empty($_POST['email'])) {
            if (Wo_EmailExists($_POST['email']) === true && $user['email'] != $_POST['email']) {
                $errors[] = $error_icon . $wo['lang']['email_exists'];
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = $error_icon . $wo['lang']['email_invalid_characters'];
            }
            if (empty($errors)) {
                $email = 1;
                $phone = 0;
            }
        } else if (!empty($_POST['phone_number'])) {
            if (!preg_match('/^\+?\d+$/', $_POST['phone_number'])) {
                $errors[] = $error_icon . $wo['lang']['worng_phone_number'];
            }
            if (Wo_PhoneExists($_POST['phone_number']) === true) {
                if ($user['phone_number'] != $_POST['phone_number']) {
                    $errors[] = $error_icon . $wo['lang']['phone_already_used'];
                }
            }
            if (empty($errors)) {
                $email = 0;
                $phone = 1;
            }
        }
        if (empty($errors)) {
            if ($email == 1 && $phone == 0) {
                $wo['user']             = $_POST;
                $wo['user']['username'] = $user['username'];
                $body                   = Wo_LoadPage('emails/activate');
                $send_message_data      = array(
                    'from_email' => $wo['config']['siteEmail'],
                    'from_name' => $wo['config']['siteName'],
                    'to_email' => $_POST['email'],
                    'to_name' => $user['username'],
                    'subject' => $wo['lang']['account_activation'],
                    'charSet' => 'utf-8',
                    'message_body' => $body,
                    'is_html' => true
                );
                $query                  = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `email` = '" . Wo_Secure($_POST['email']) . "' WHERE `user_id` = {$user_id}");
                $send                   = Wo_SendMessage($send_message_data);
                if ($send) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['email_sent_successfully']
                    );
                }
            } else if ($email == 0 && $phone == 1) {
                $random_activation = Wo_Secure(rand(11111, 99999));
                $message           = "Your confirmation code is: {$random_activation}";
                $user_id           = $_SESSION['code_id'];
                $phone_num         = Wo_Secure($_POST['phone_number']);
                $query             = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `phone_number` = '{$phone_num}' WHERE `user_id` = {$user_id}");
                $query             = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `sms_code` = '{$random_activation}' WHERE `user_id` = {$user_id}");
                if ($query) {
                    if (Wo_SendSMSMessage($_POST['phone_number'], $message) === true) {
                        $data = array(
                            'status' => 600,
                            'message' => $success_icon . $wo['lang']['sms_has_been_sent']
                        );
                    } else {
                        $errors[] = $error_icon . $wo['lang']['error_while_sending_sms'];
                    }
                }
            }
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'contact_us') {
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['message'])) {
        $errors[] = $error_icon . $wo['lang']['please_check_details'];
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = $error_icon . $wo['lang']['email_invalid_characters'];
    }
    if (empty($errors)) {
        $first_name        = Wo_Secure($_POST['first_name']);
        $last_name         = Wo_Secure($_POST['last_name']);
        $email             = Wo_Secure($_POST['email']);
        $message           = Wo_Secure($_POST['message']);
        $name              = $first_name . ' ' . $last_name;
        $send_message_data = array(
            'from_email' => $wo['config']['siteEmail'],
            'from_name' => $name,
            'reply-to' => $email,
            'to_email' => $wo['config']['siteEmail'],
            'to_name' => $wo['config']['siteName'],
            'subject' => 'Contact us new message',
            'charSet' => 'utf-8',
            'message_body' => $message,
            'is_html' => false
        );
        $send              = Wo_ContactSendMessage($send_message_data);
        if ($send) {
            $data = array(
                'status' => 200,
                'message' => $success_icon . $wo['lang']['email_sent']
            );
        } else {
            $errors[] = $error_icon . $wo['lang']['processing_error'];
        }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'login') {
    $data_ = array();
    $phone = 0;
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if (empty($_POST['captcha_response']) || verify_captcha($_POST['captcha_response'])) {
            $username = Wo_Secure($_POST['username']);
            $password = Wo_Secure($_POST['password']);
            $result   = Wo_Login($username, $password);
            if ($result === false) {
                $errors[] = $error_icon . $wo['lang']['incorrect_username_or_password_label'];
                if (empty($_SESSION['wrong_password']))
                    $_SESSION['wrong_password'] = 1;
                else
                    $_SESSION['wrong_password']++;
            } else if (Wo_UserInactive($_POST['username']) === true) {
                unset($_SESSION['wrong_password']);
                $errors[] = $error_icon . $wo['lang']['account_disbaled_contanct_admin_label'];
            } else if (Wo_UserActive($_POST['username']) === false) {
                unset($_SESSION['wrong_password']);
                $_SESSION['code_id'] = Wo_UserIdForLogin($username);
                $data_               = array(
                    'status' => 600,
                    'location' => Wo_SeoLink('index.php?link1=user-activation')
                );
                $phone               = 1;
            }
        } else {
            $errors[] = $error_icon . 'Are you human? Verify!' /**. $wo['lang']['are_you_human']*/;
        }
        if (empty($errors) && $phone == 0) {
            $userid              = Wo_UserIdForLogin($username);
            $ip                  = Wo_Secure(get_ip_address());
            $update              = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `ip_address` = '{$ip}' WHERE `user_id` = '{$userid}'");
            $session             = Wo_CreateLoginSession(Wo_UserIdForLogin($username));
            $_SESSION['user_id'] = $session;
            setcookie("user_id", $session, time() + (10 * 365 * 24 * 60 * 60));
            setcookie('ad-con', htmlentities(serialize(array(
                'date' => date('Y-m-d'),
                'ads' => array()
            ))), time() + (10 * 365 * 24 * 60 * 60));
            $data = array(
                'status' => 200
            );
            if (!empty($_POST['last_url'])) {
                $data['location'] = $_POST['last_url'];
            } else {
                $data['location'] = $wo['config']['site_url'];
            }
            
           /* $to_userid=Wo_UserIdFromPhone($_POST['username']);
          $data_id=Wo_FromUserId($_POST['username']);
        $data_message=Wo_FromUserMessage($_POST['username']);
       
       if (!empty($data_id)) {
        Wo_SecretMessage($to_userid,$data_id,$data_message);
        Wo_UserChatMessage($to_userid,$data_id);
         
         
        }
        $updatefeedback=Wo_Updatefeedback($_POST['username']);
         
        /*$datatime1=Wo_Seen($to_userid);
         if ($datatime1!='00:00:00')
            {
               $updatefeedback=Wo_Updatefeedback($_POST['username']);
            }*/
     
       
        
        
        
         }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors,
            'captcha' => (!empty($wo['config']['reCaptchaKey']) && !empty($_SESSION['wrong_password']) && $_SESSION['wrong_password'] > 2)
        ));
    } else if (!empty($data_)) {
        echo json_encode($data_);
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'register') {
    // include 'register-code.php';
    //echo '<pre>';print_r($_POST);die;
    $fields = Wo_GetWelcomeFileds();
    if (empty($_POST['phone_num']) || empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['password']) || empty($_POST['confirm_password'])) {
        $errors = $error_icon . $wo['lang']['please_check_details'];
    } elseif(empty($_POST['otp'])){
        $_SESSION['otp']=rand(100000,999999);
        $otp=$_SESSION['otp'];
    $messages="Welcome to Mitrah.in. Your one time password is ".$otp;
    $m=$_POST['phone_num'];
    $query = http_build_query([
            "username" => "rsingh",
            "password" => "469585348",
            "sendername" =>"Mitrah",
            "mobileno" => $m,
            "message" =>$messages
    ]);
$url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?".$query;
$ch = curl_init($url);
  	curl_setopt($ch, CURLOPT_POST, true);
  	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  	$response = curl_exec($ch); // This is the result from the API
	//pr($result);
  	curl_close($ch);
        
        $errors = $error_icon . $otp . "Please Enter Your OTP Now ";
        

    }
    else {
        
        if($_POST['otp']!=$_SESSION['otp'])
        {
          $errors = $error_icon . "Your OTP is incorrect";
        }
        if(empty($_POST['username']))
          $_POST['username']=rand(999,9999)."user".rand(10000,99999);
        $is_exist = Wo_IsNameExist($_POST['username'], 0);
        if (empty($_POST['phone_num']) && $wo['config']['sms_or_email'] == 'sms') {
            $errors = $error_icon . $wo['lang']['worng_phone_number'];
        }
        if (in_array(true, $is_exist)) {
            $errors = $error_icon . $wo['lang']['username_exists'];
        }
        if (Wo_CheckIfUserCanRegister($wo['config']['user_limit']) === false) {
            $errors = $error_icon . $wo['lang']['limit_exceeded'];
        }
        if (in_array($_POST['username'], $wo['site_pages'])) {
            $errors = $error_icon . $wo['lang']['username_invalid_characters'];
        }
        if (strlen($_POST['username']) < 5 OR strlen($_POST['username']) > 32) {
            $errors = $error_icon . $wo['lang']['username_characters_length'];
        }
        if (!preg_match('/^[\w]+$/', $_POST['username'])) {
            $errors = $error_icon . $wo['lang']['username_invalid_characters'];
        }
        if (!empty($_POST['phone_num'])) {
            if (!preg_match('/^\+?\d+$/', $_POST['phone_num'])) {
                $errors = $error_icon . $wo['lang']['worng_phone_number'];
            } else {
                if (Wo_PhoneExists($_POST['phone_num']) === true) {
                    $errors = $error_icon . $wo['lang']['phone_already_used'];
                }
            }
        }
        // if (Wo_EmailExists($_POST['email']) === true) {
        //     $errors = $error_icon . $wo['lang']['email_exists'];
        // }
        // if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //     $errors = $error_icon . $wo['lang']['email_invalid_characters'];
        // }
        if (strlen($_POST['password']) < 6) {
            $errors = $error_icon . $wo['lang']['password_short'];
        }
        if ($_POST['password'] != $_POST['confirm_password']) {
            $errors = $error_icon . $wo['lang']['password_mismatch'];
        }
        if ($config['reCaptcha'] == 1) {
            if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
                $errors = $error_icon . $wo['lang']['reCaptcha_error'];
            }
        }
        $gender = 'male';
        if (!empty($_POST['gender'])) {
            if ($_POST['gender'] != 'male' && $_POST['gender'] != 'female') {
                $gender = 'male';
            } else {
                $gender = $_POST['gender'];
            }
        }
        if (!empty($fields) && count($fields) > 0) {
            foreach ($fields as $key => $field) {
                if (empty($_POST[$field['fid']])) {
                    $errors = $error_icon . $field['name'] . ' is required';
                }
                if (mb_strlen($_POST[$field['fid']]) > $field['length']) {
                    $errors = $error_icon . $field['name'] . ' field max characters is ' . $field['length'];
                }
            }
        }
    }
    $field_data = array();
    if (empty($errors)) {
        if (!empty($fields) && count($fields) > 0) {
            foreach ($fields as $key => $field) {
                if (!empty($_POST[$field['fid']])) {
                    $name = $field['fid'];
                    if (!empty($_POST[$name])) {
                        $field_data[] = array(
                            $name => $_POST[$name]
                        );
                    }
                }
            }
        }
        $activate = ($wo['config']['emailValidation'] == '1') ? '0' : '1';
        $re_data  = array(
            //'email' => Wo_Secure($_POST['email'], 0),
            'first_name' => Wo_Secure($_POST['first_name'], 0),
            'last_name' => Wo_Secure($_POST['last_name'], 0),
            'username' => Wo_Secure($_POST['username'], 0),
            'password' => Wo_Secure($_POST['password'], 0),
            'email_code' => Wo_Secure(md5($_POST['username']), 0),
            'src' => 'site',
            'gender' => Wo_Secure($gender),
            'lastseen' => time(),
            'active' => Wo_Secure($activate),
            'birthday' => '0000-00-00'
        );
        if (!empty($_SESSION['ref']) && $wo['config']['affiliate_type'] == 0) {
            $ref_user_id = Wo_UserIdFromUsername($_SESSION['ref']);
            if (!empty($ref_user_id) && is_numeric($ref_user_id)) {
                $re_data['referrer'] = Wo_Secure($ref_user_id);
                $re_data['src']      = Wo_Secure('Referrer');
                $update_balance      = Wo_UpdateBalance($ref_user_id, $wo['config']['amount_ref']);
                unset($_SESSION['ref']);
            }
        }
        if (!empty($_POST['phone_num'])) {
            $re_data['phone_number'] = Wo_Secure($_POST['phone_num']);
        }
        $in_code  = (isset($_POST['invited'])) ? Wo_Secure($_POST['invited']) : false;
        $register = Wo_RegisterUser($re_data, $in_code);
        $recepient_id=Wo_UserIdFromPhone($_POST['phone_num']);
        $user_id=Wo_Fromid($_POST['phone_num']);
        $type=Wo_Type($_POST['phone_num']);
        $message=Wo_FromUserMessage($_POST['phone_num']);
        $url="https://mitrah.in/index.php?link1=feedback#groups";
        if (!empty($user_id)) {
        $notification=Wo_Feednotification($user_id,$recepient_id,$message,$url,$type);
        }
        if ($register === true) {
            if ($activate == 1) {
                $data  = array(
                    'status' => 200,
                    'message' => $success_icon . $wo['lang']['successfully_joined_label']
                );
                $login = Wo_Login($_POST['username'], $_POST['password']);
                if ($login === true) {
                    $session             = Wo_CreateLoginSession(Wo_UserIdFromUsername($_POST['username']));
                    $_SESSION['user_id'] = $session;
                    setcookie("user_id", $session, time() + (10 * 365 * 24 * 60 * 60));
                }
                $data['location'] = Wo_SeoLink('index.php?link1=start-up');
            } else if ($wo['config']['sms_or_email'] == 'mail') {
                $wo['user']        = $_POST;
                $body              = Wo_LoadPage('emails/activate');
                $send_message_data = array(
                    'from_email' => $wo['config']['siteEmail'],
                    'from_name' => $wo['config']['siteName'],
                    'to_email' => $_POST['email'],
                    'to_name' => $_POST['username'],
                    'subject' => $wo['lang']['account_activation'],
                    'charSet' => 'utf-8',
                    'message_body' => $body,
                    'is_html' => true
                );
                $send              = Wo_SendMessage($send_message_data);
                $errors            = $success_icon . $wo['lang']['successfully_joined_verify_label'];
            } else if ($wo['config']['sms_or_email'] == 'sms' && !empty($_POST['phone_num'])) {
                $random_activation = Wo_Secure(rand(11111, 99999));
                $message           = "Your confirmation code is: {$random_activation}";
                $user_id           = Wo_UserIdFromUsername($_POST['username']);
                $query             = mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `sms_code` = '{$random_activation}' WHERE `user_id` = {$user_id}");
                if ($query) {
                    if (Wo_SendSMSMessage($_POST['phone_num'], $message) === true) {
                        $data = array(
                            'status' => 300,
                            'location' => Wo_SeoLink('index.php?link1=confirm-sms?code=' . Wo_Secure(md5($_POST['username']), 0))
                        );
                    } else {
                        $errors = $error_icon . $wo['lang']['failed_to_send_code_email'];
                    }
                }
            }
        }
        if (!empty($_SESSION['user_id']) && !empty($field_data)) {
            $user_id = Wo_GetUserFromSessionID($_SESSION['user_id']);
            $insert  = Wo_UpdateUserCustomData($user_id, $field_data, false);
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'recover') {
   include 'demo.php';
    if (empty($_POST['recoveremail'])) {
        $errors = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (!preg_match('/^\+?\d+$/', $_POST['recoveremail'])) {
            $errors[] = $error_icon . $wo['lang']['worng_phone_number'];

        }
        else if(Wo_UserExistsViaPhone($_POST['recoveremail'])==0){
            $errors[] = $error_icon . "Number doesn't exist";
        }
        // if (!filter_var($_POST['recoveremail'], FILTER_VALIDATE_EMAIL)) {
        //     $errors = $error_icon . $wo['lang']['email_invalid_characters'];
        // }
        // else if (Wo_EmailExists($_POST['recoveremail']) === false) {
        //     $errors = $error_icon . $wo['lang']['email_not_found'];
        // }
    }
    $phone_op=1;
    $email_op=0;
    if (empty($errors)) {
        if($phone_op==1){
          $user=Wo_UserExistsViaPhone($_POST['recoveremail']);
          $new_pass='np'.rand(100000,999999);
          $_SESSION['otp']=rand(100000,999999);
          $resut=Wo_UpdatePassword($user,$new_pass);
          //echo $resut;die;
          if($resut==1){
            require('textlocal.class.php');
            $username = "mantdemo1";
            $hash = "d179cdbf113fbdbad44e838edcdab5a35fadbab924a672703678af84dfb0f23e";
            $pass="1415811203";
            $Textlocal = new Textlocal($username, $hash,$pass);
    
            $test = "0";
            $sender = "SMDEMO"; // This is who the message appears to be from.
            $numbers = "91".$_POST['recoveremail']; // A single number or a comma-seperated list of numbers
            $message = "Welcome to Mitrah.in. Your one time password is ".$_SESSION['otp'];// 612 chars or less
            $response = $Textlocal->sendMessageCustom($message,$sender,$numbers,$test);
         // $response=json_decode($response);
         
            $data = array(
                'status' => 200,
                'message' => $response
            );
            
          }
        }
        if($email_op==1){
          $user_recover_data         = Wo_UserData(Wo_UserIdFromEmail($_POST['recoveremail']));
          $subject                   = $config['siteName'] . ' ' . $wo['lang']['password_rest_request'];
          $user_recover_data['link'] = Wo_Link('index.php?link1=reset-password&code=' . $user_recover_data['user_id'] . '_' . $user_recover_data['password']);
          $wo['recover']             = $user_recover_data;
          $body                      = Wo_LoadPage('emails/recover');
          $send_message_data         = array(
              'from_email' => $wo['config']['siteEmail'],
              'from_name' => $wo['config']['siteName'],
              'to_email' => $_POST['recoveremail'],
              'to_name' => '',
              'subject' => $subject,
              'charSet' => 'utf-8',
              'message_body' => $body,
              'is_html' => true
          );
          $send                      = Wo_SendMessage($send_message_data);
          $data                      = array(
              'status' => 200,
              'message' => $success_icon . $wo['lang']['email_sent']
          );
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}

if ($f == 'reset_password') {
    if (isset($_POST['id'])) {
        if (Wo_isValidPasswordResetToken($_POST['id']) === false) {
            $errors = $error_icon . $wo['lang']['invalid_token'];
        } elseif (empty($_POST['id'])) {
            $errors = $error_icon . $wo['lang']['processing_error'];
        } elseif (empty($_POST['password'])) {
            $errors = $error_icon . $wo['lang']['please_check_details'];
        } elseif (strlen($_POST['password']) < 5) {
            $errors = $error_icon . $wo['lang']['password_short'];
        }
        if (empty($errors)) {
            $user_id  = explode("_", $_POST['id']);
            $password = Wo_Secure($_POST['password']);
            if (Wo_ResetPassword($user_id[0], $password) === true) {
                $_SESSION['user_id'] = Wo_CreateLoginSession($user_id[0]);
            }
            $data = array(
                'status' => 200,
                'message' => $success_icon . $wo['lang']['password_changed'],
                'location' => $wo['config']['site_url']
            );
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "search") {
    $data = array(
        'status' => 200,
        'html' => ''
    );
    if ($s == 'recipients' AND $wo['loggedin'] == true && isset($_GET['query'])) {
        foreach (Wo_GetMessagesUsers($wo['user']['user_id'], $_GET['query']) as $wo['recipient']) {
            $data['html'] .= Wo_LoadPage('messages/messages-recipients-list');
        }
    }
    if ($s == 'normal' && isset($_GET['query'])) {
        foreach (Wo_GetSearch($_GET['query']) as $wo['result']) {
            $data['html'] .= Wo_LoadPage('header/search');
        }
    }
    if ($s == 'hash' && isset($_GET['query'])) {
        foreach (Wo_GetSerachHash($_GET['query']) as $wo['result']) {
            $data['html'] .= Wo_LoadPage('header/hashtags-result');
        }
    }
    if ($s == 'recent' && $wo['loggedin'] == true) {
        foreach (Wo_GetRecentSerachs() as $wo['result']) {
            $data['html'] .= Wo_LoadPage('header/search');
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "get_search_filter") {
    $data = array(
        'status' => 200,
        'html' => ''
    );
    if (isset($_POST)) {
        foreach (Wo_GetSearchFilter($_POST) as $wo['result']) {
            $data['html'] .= Wo_LoadPage('search/result');
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "update_announcement_views") {
    if (isset($_GET['id'])) {
        $UpdateAnnouncementViews = Wo_UpdateAnnouncementViews($_GET['id']);
        if ($UpdateAnnouncementViews === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_more_hashtag_posts') {
    $html = '';
    if (isset($_POST['after_post_id'])) {
        $is_api = false;
        if (!empty($_POST['is_api'])) {
            $is_api = true;
        }
        $after_post_id = Wo_Secure($_POST['after_post_id']);
        foreach (Wo_GetHashtagPosts($_POST['hashtagName'], $after_post_id, 20) as $wo['story']) {
            if ($is_api == true) {
                $html .= Wo_LoadPage('story/api-posts');
            } else {
                $html .= Wo_LoadPage('story/content');
            }
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($wo['loggedin'] == false) {
    exit("Please login or signup to continue.");
}
if ($f == "get_more_following") {
    $html = '';
    if (isset($_GET['user_id']) && isset($_GET['after_last_id'])) {
        foreach (Wo_GetFollowing($_GET['user_id'], 'profile', 10, $_GET['after_last_id']) as $wo['UsersList']) {
            $html .= Wo_LoadPage('timeline/follow-list');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "get_more_followers") {
    $html = '';
    if (isset($_GET['user_id']) && isset($_GET['after_last_id'])) {
        foreach (Wo_GetFollowers($_GET['user_id'], 'profile', 10, $_GET['after_last_id']) as $wo['UsersList']) {
            $html .= Wo_LoadPage('timeline/follow-list');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_username') {
    if (isset($_GET['username'])) {
        $usename = Wo_Secure($_GET['username']);
        if ($usename == $wo['user']['username']) {
            $data['status']  = 200;
            $data['message'] = $wo['lang']['available'];
        } else if (strlen($usename) < 5) {
            $data['status']  = 400;
            $data['message'] = $wo['lang']['too_short'];
        } else if (strlen($usename) > 32) {
            $data['status']  = 500;
            $data['message'] = $wo['lang']['too_long'];
        } else if (!preg_match('/^[\w]+$/', $_GET['username'])) {
            $data['status']  = 600;
            $data['message'] = $wo['lang']['username_invalid_characters_2'];
        } else {
            $is_exist = Wo_IsNameExist($_GET['username'], 0);
            if (in_array(true, $is_exist)) {
                $data['status']  = 300;
                $data['message'] = $wo['lang']['in_use'];
            } else {
                $data['status']  = 200;
                $data['message'] = $wo['lang']['available'];
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "update_general_settings") {
  //pr($_POST);
    if (isset($_POST) && Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['username'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else {
            $Userdata = Wo_UserData($_POST['user_id']);
            $age_data = '0000-00-00';
            if (!empty($Userdata['user_id'])) {
                if(!empty($_POST['email'])){
                  if ($_POST['email'] != $Userdata['email']) {
                      if (Wo_EmailExists($_POST['email'])) {
                          $errors[] = $error_icon . $wo['lang']['email_exists'];
                      }
                  }
                }
                if ($_POST['username'] != $Userdata['username']) {
                    $is_exist = Wo_IsNameExist($_POST['username'], 0);
                    if (in_array(true, $is_exist)) {
                        $errors[] = $error_icon . $wo['lang']['username_exists'];
                    }
                }
                if (in_array($_POST['username'], $wo['site_pages'])) {
                    $errors[] = $error_icon . $wo['lang']['username_invalid_characters'];
                }
                if(!empty($_POST['email'])){
                  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                      $errors[] = $error_icon . $wo['lang']['email_invalid_characters'];
                  }
                }
                if (strlen($_POST['username']) < 5 || strlen($_POST['username']) > 32) {
                    $errors[] = $error_icon . $wo['lang']['username_characters_length'];
                }
                if (!preg_match('/^[\w]+$/', $_POST['username'])) {
                    $errors[] = $error_icon . $wo['lang']['username_invalid_characters'];
                }
                if (!empty($_POST['age_year']) || !empty($_POST['age_day']) || !empty($_POST['age_month'])) {
                    if (empty($_POST['age_year']) || empty($_POST['age_day']) || empty($_POST['age_month'])) {
                        $errors[] = $error_icon . $wo['lang']['please_choose_correct_date'];
                    } else {
                        $age_data = $_POST['age_year'] . '-' . $_POST['age_month'] . '-' . $_POST['age_day'];
                    }
                }
                $active = $Userdata['active'];
                if (!empty($_POST['active'])) {
                    if ($_POST['active'] == 'active') {
                        $active = 1;
                    } else {
                        $active = 2;
                    }
                    if ($active == $Userdata['active']) {
                        $active = $Userdata['active'];
                    }
                }
                $type = $Userdata['admin'];
                if (!empty($_POST['type']) && Wo_IsAdmin()) {
                    if ($_POST['type'] == 'admin') {
                        $type = 1;
                    } else if ($_POST['type'] == 'user') {
                        $type = 0;
                    } else if ($_POST['type'] == 'mod') {
                        $type = 2;
                    }
                    if ($type == $Userdata['admin']) {
                        $type = $Userdata['admin'];
                    }
                }
                $member_type = $Userdata['pro_type'];
                $member_pro  = $Userdata['is_pro'];
                $time        = $Userdata['pro_time'];
                if (!empty($_POST['pro_type']) && (Wo_IsAdmin() || Wo_IsModerator())) {
                    if ($_POST['pro_type'] == 'free') {
                        $member_type = 0;
                        $member_pro  = 0;
                        $down        = Wo_DownUpgradeUser($Userdata['user_id']);
                    } else if ($_POST['pro_type'] == 'star') {
                        $member_type = 1;
                        $member_pro  = 1;
                        $time        = time();
                    } else if ($_POST['pro_type'] == 'hot') {
                        $member_type = 2;
                        $member_pro  = 1;
                        $time        = time();
                    } else if ($_POST['pro_type'] == 'ultima') {
                        $member_type = 3;
                        $member_pro  = 1;
                        $time        = time();
                    } else if ($_POST['pro_type'] == 'vip') {
                        $member_type = 4;
                        $member_pro  = 1;
                        $time        = time();
                    }
                }
                $gender       = 'male';
                $gender_array = array(
                    'male',
                    'female'
                );
                if (!empty($_POST['gender'])) {
                    if (in_array($_POST['gender'], $gender_array)) {
                        $gender = $_POST['gender'];
                    }
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'username' => $_POST['username'],
                        'state_id'=>$_POST['state'],
                        'city_id'=>$_POST['city'],
                        'email' => $_POST['email'],
                        'birthday' => $age_data,
                        'gender' => $gender,
                        'religion' => $_POST['religion'],
                        'religion_other' => $_POST['religion_other'],
                        'work_profile' => $_POST['work_profile'],
                        'country_id' => $_POST['country'],
                        'active' => $active,
                        'admin' => $type,
                        'is_pro' => $member_pro,
                        'pro_type' => $member_type,
                        'pro_time' => $time
                    );
                    if (!empty($_POST['verified'])) {
                        if ($_POST['verified'] == 'verified') {
                            $Verification = 1;
                        } else {
                            $Verification = 0;
                        }
                        if ($Verification == $Userdata['verified']) {
                            $Verification = $Userdata['verified'];
                        }
                        $Update_data['verified'] = $Verification;
                    }
                    $unverify = false;
                    if ($Userdata['username'] != $_POST['username']) {
                        $unverify = true;
                    }
                    // var_dump(Wo_UpdateUserData($_POST['user_id'], $Update_data,$unverify));
                    // exit();
                    if (Wo_UpdateUserData($_POST['user_id'], $Update_data, $unverify)) {
                        $field_data = array();
                        if (!empty($_POST['custom_fields'])) {
                            $fields = Wo_GetProfileFields('general');
                            foreach ($fields as $key => $field) {
                                $name = $field['fid'];
                                if (isset($_POST[$name])) {
                                    if (mb_strlen($_POST[$name]) > $field['length']) {
                                        $errors[] = $error_icon . $field['name'] . ' field max characters is ' . $field['length'];
                                    }
                                    $field_data[] = array(
                                        $name => $_POST[$name]
                                    );
                                }
                            }
                        }
                        if (!empty($field_data)) {
                            $insert = Wo_UpdateUserCustomData($_POST['user_id'], $field_data);
                        }
                        if (empty($errors)) {
                            $data = array(
                                'status' => 200,
                                'message' => $success_icon . $wo['lang']['setting_updated'],
                                'username' => Wo_SeoLink('index.php?link1=timeline&u=' . Wo_Secure($_POST['username']))
                            );
                        }
                    }
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_privacy_settings") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $message_privacy         = 0;
        $follow_privacy          = 0;
        $post_privacy            = 'ifollow';
        $showlastseen            = 0;
        $confirm_followers       = 0;
        $show_activities_privacy = 0;
        $status                  = 0;
        $visit_privacy           = 0;
        $birth_privacy           = 0;
        $friend_privacy          = 0;
        $share_my_location       = 0;
        $array                   = array(
            '0',
            '1'
        );
        $array_2                 = array(
            '0',
            '1',
            '2'
        );
        $array_two               = array(
            'everyone',
            'ifollow',
            'nobody'
        );
        $array_three             = array(
            '0',
            '1',
            '2',
            '3'
        );
        if (!empty($_POST['share_my_location'])) {
            if (in_array($_POST['share_my_location'], $array)) {
                $share_my_location = $_POST['share_my_location'];
            }
        }
        if (!empty($_POST['post_privacy'])) {
            if (in_array($_POST['post_privacy'], $array_two)) {
                $post_privacy = $_POST['post_privacy'];
            }
        }
        if (!empty($_POST['confirm_followers'])) {
            if (in_array($_POST['confirm_followers'], $array)) {
                $confirm_followers = $_POST['confirm_followers'];
            }
        }
        if (!empty($_POST['follow_privacy'])) {
            if (in_array($_POST['follow_privacy'], $array)) {
                $follow_privacy = $_POST['follow_privacy'];
            }
        }
        if (!empty($_POST['show_activities_privacy'])) {
            if (in_array($_POST['show_activities_privacy'], $array)) {
                $show_activities_privacy = $_POST['show_activities_privacy'];
            }
        }
        if (!empty($_POST['showlastseen'])) {
            if (in_array($_POST['showlastseen'], $array)) {
                $showlastseen = $_POST['showlastseen'];
            }
        }
        if (!empty($_POST['message_privacy'])) {
            if (in_array($_POST['message_privacy'], $array)) {
                $message_privacy = $_POST['message_privacy'];
            }
        }
        if (!empty($_POST['status'])) {
            if (in_array($_POST['status'], $array)) {
                $status = $_POST['status'];
            }
        }
        if (!empty($_POST['visit_privacy'])) {
            if (in_array($_POST['visit_privacy'], $array)) {
                $visit_privacy = $_POST['visit_privacy'];
            }
        }
        if (!empty($_POST['birth_privacy'])) {
            if (in_array($_POST['birth_privacy'], $array_2)) {
                $birth_privacy = $_POST['birth_privacy'];
            }
        }
        if (!empty($_POST['friend_privacy'])) {
            if (in_array($_POST['friend_privacy'], $array_three)) {
                $friend_privacy = $_POST['friend_privacy'];
            }
        }
        $userdata = Wo_UserData($_POST['user_id']);
        if ($wo['config']['pro'] == 1 && empty($_POST['showlastseen']) && empty($_POST['profileVisit'])) {
            if ($userdata['is_pro'] == 0) {
                $visit_privacy = 1;
                $showlastseen  = 1;
            }
        }
        $Update_data = array(
            'message_privacy' => $message_privacy,
            'follow_privacy' => $follow_privacy,
            'friend_privacy' => $friend_privacy,
            'post_privacy' => $post_privacy,
            'showlastseen' => $showlastseen,
            'confirm_followers' => $confirm_followers,
            'show_activities_privacy' => $show_activities_privacy,
            'visit_privacy' => $visit_privacy,
            'birth_privacy' => $birth_privacy,
            'status' => $status,
            'share_my_location' => $share_my_location
        );
        if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
            $data = array(
                'status' => 200,
                'message' => $success_icon . $wo['lang']['setting_updated']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "update_email_settings") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $e_liked             = 0;
        $e_shared            = 0;
        $e_wondered          = 0;
        $e_commented         = 0;
        $e_followed          = 0;
        $e_liked_page        = 0;
        $e_visited           = 0;
        $e_mentioned         = 0;
        $e_joined_group      = 0;
        $e_accepted          = 0;
        $e_profile_wall_post = 0;
        $array               = array(
            '0',
            '1'
        );
        if (!empty($_POST['e_liked'])) {
            if (in_array($_POST['e_liked'], $array)) {
                $e_liked = 1;
            }
        }
        if (!empty($_POST['e_shared'])) {
            if (in_array($_POST['e_shared'], $array)) {
                $e_shared = 1;
            }
        }
        if (!empty($_POST['e_wondered'])) {
            if (in_array($_POST['e_wondered'], $array)) {
                $e_wondered = 1;
            }
        }
        if (!empty($_POST['e_commented'])) {
            if (in_array($_POST['e_commented'], $array)) {
                $e_commented = 1;
            }
        }
        if (!empty($_POST['e_followed'])) {
            if (in_array($_POST['e_followed'], $array)) {
                $e_followed = 1;
            }
        }
        if (!empty($_POST['e_liked_page'])) {
            if (in_array($_POST['e_liked_page'], $array)) {
                $e_liked_page = 1;
            }
        }
        if (!empty($_POST['e_visited'])) {
            if (in_array($_POST['e_visited'], $array)) {
                $e_visited = 1;
            }
        }
        if (!empty($_POST['e_mentioned'])) {
            if (in_array($_POST['e_mentioned'], $array)) {
                $e_mentioned = 1;
            }
        }
        if (!empty($_POST['e_joined_group'])) {
            if (in_array($_POST['e_joined_group'], $array)) {
                $e_joined_group = 1;
            }
        }
        if (!empty($_POST['e_accepted'])) {
            if (in_array($_POST['e_accepted'], $array)) {
                $e_accepted = 1;
            }
        }
        if (!empty($_POST['e_profile_wall_post'])) {
            if (in_array($_POST['e_profile_wall_post'], $array)) {
                $e_profile_wall_post = 1;
            }
        }
        $Update_data = array(
            'e_liked' => $e_liked,
            'e_shared' => $e_shared,
            'e_wondered' => $e_wondered,
            'e_commented' => $e_commented,
            'e_followed' => $e_followed,
            'e_accepted' => $e_accepted,
            'e_mentioned' => $e_mentioned,
            'e_joined_group' => $e_joined_group,
            'e_liked_page' => $e_liked_page,
            'e_visited' => $e_visited,
            'e_profile_wall_post' => $e_profile_wall_post
        );
        if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
            $data = array(
                'status' => 200,
                'message' => $success_icon . $wo['lang']['setting_updated']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_new_logged_user_details') {
    if (empty($_POST['new_password']) || empty($_POST['username']) || empty($_POST['repeat_new_password']) || Wo_CheckSession($hash_id) === false) {
        $errors[] = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if ($_POST['new_password'] != $_POST['repeat_new_password']) {
            $errors[] = $error_icon . $wo['lang']['password_mismatch'];
        }
        if (strlen($_POST['new_password']) < 6) {
            $errors[] = $error_icon . $wo['lang']['password_short'];
        }
        if (strlen($_POST['username']) > 32) {
            $errors[] = $error_icon . $wo['lang']['username_characters_length'];
        }
        if (strlen($_POST['username']) < 5) {
            $errors[] = $error_icon . $wo['lang']['username_characters_length'];
        }
        if (!preg_match('/^[\w]+$/', $_POST['username'])) {
            $errors[] = $error_icon . $wo['lang']['username_invalid_characters'];
        }
        if (Wo_UserExists($_POST['username']) === true) {
            $errors[] = $error_icon . $wo['lang']['username_exists'];
        }
        if (empty($errors)) {
            $Update_data = array(
                'password' => sha1($_POST['new_password']),
                'username' => $_POST['username'],
                'social_login' => 0
            );
            if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                $get_user = Wo_UserData($_POST['user_id']);
                $data     = array(
                    'status' => 200,
                    'message' => $success_icon . $wo['lang']['setting_updated'],
                    'url' => $get_user['url']
                );
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_user_password") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            if ($_POST['user_id'] != $wo['user']['user_id']) {
                $_POST['current_password'] = 1;
            }
            if (empty($_POST['current_password']) OR empty($_POST['new_password']) OR empty($_POST['repeat_new_password'])) {
                $errors[] = $error_icon . $wo['lang']['please_check_details'];
            } else {
                if ($_POST['user_id'] == $wo['user']['user_id']) {
                    if (Wo_HashPassword($_POST['current_password'], $Userdata['password']) == false) {
                        $errors[] = $error_icon . $wo['lang']['current_password_mismatch'];
                    }
                }
                if ($_POST['new_password'] != $_POST['repeat_new_password']) {
                    $errors[] = $error_icon . $wo['lang']['password_mismatch'];
                }
                if (strlen($_POST['new_password']) < 6) {
                    $errors[] = $error_icon . $wo['lang']['password_short'];
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'password' => sha1($_POST['new_password'])
                    );
                    if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                        $user_id    = Wo_Secure($_POST['user_id']);
                        $session_id = (!empty($_SESSION['user_id'])) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
                        $session_id = Wo_Secure($session_id);
                        $mysqli     = mysqli_query($sqlConnect, "DELETE FROM " . T_APP_SESSIONS . " WHERE `user_id` = '{$user_id}' AND `session_id` <> '{$session_id}'");
                        $data       = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated']
                        );
                    }
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_profile_setting") {//pr($_POST);
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {        if($_POST['interests']!=0)
        {
            Wo_InsertUserInterest($_POST['user_id'],$_POST['interest_sub']);
        }
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            $pattern = '/(?:https?:\/\/)?(?:[a-zA-Z0-9.-]+?\.(?:[a-zA-Z])|\d+\.\d+\.\d+\.\d+)/';
            if (!empty($_POST['website'])) {
                if (!preg_match($pattern, $_POST['website'])) {
                    $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
                }
            }
            if (!empty($_POST['working_link'])) {
                if (!preg_match($pattern, $_POST['working_link'])) {
                    $errors[] = $error_icon . $wo['lang']['company_website_invalid'];
                }
            }
            if (!is_numeric($_POST['relationship']) || empty($_POST['relationship'])) {
                $_POST['relationship'] = 0;
                Wo_DeleteMyRelationShip();
            }
            if (isset($_POST['relationship_user']) && is_numeric($_POST['relationship_user']) && $_POST['relationship_user'] > 0) {
                if (is_numeric($_POST['relationship']) && $_POST['relationship'] > 0 && $_POST['relationship'] <= 4) {
                    $relationship_user = Wo_Secure($_POST['relationship_user']);
                    $user              = Wo_Secure($wo['user']['id']);
                    if (!Wo_IsRelationRequestExists($user, $relationship_user, $_POST['relationship'])) {
                        $registration_data = array(
                            'from_id' => $user,
                            'to_id' => $relationship_user,
                            'relationship' => Wo_Secure($_POST['relationship']),
                            'active' => 0
                        );
                        $registration_id   = Wo_RegisterRelationship($registration_data);
                        if ($registration_id) {
                            $relationship_user_data  = Wo_UserData($relationship_user);
                            $notification_data_array = array(
                                'recipient_id' => $relationship_user,
                                'type' => 'added_u_as',
                                'user_id' => $wo['user']['id'],
                                'text' => $wo['lang']['relationship_request'],
                                'url' => 'index.php?link1=timeline&u=' . $relationship_user_data['username'] . '&type=requests'
                            );
                            Wo_RegisterNotification($notification_data_array);
                        }
                    }
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'website' => $_POST['website'],
                    'about' => $_POST['about'],
                    'working' => $_POST['working'],
                    'working_link' => $_POST['working_link'],
                    'address' => $_POST['address'],
                    'school' => $_POST['school'],
                    'relationship_id' => $_POST['relationship']
                );
                if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                    $field_data = array();
                    if (!empty($_POST['custom_fields'])) {
                        $fields = Wo_GetProfileFields('profile');
                        foreach ($fields as $key => $field) {
                            $name = $field['fid'];
                            if (isset($_POST[$name])) {
                                if (mb_strlen($_POST[$name]) > $field['length']) {
                                    $errors[] = $error_icon . $field['name'] . ' field max characters is ' . $field['length'];
                                }
                                $field_data[] = array(
                                    $name => $_POST[$name]
                                );
                            }
                        }
                    }
                    if (!empty($field_data)) {
                        $insert = Wo_UpdateUserCustomData($_POST['user_id'], $field_data);
                    }
                    if (empty($errors)) {
                        $data = array(
                            'status' => 200,
                            'first_name' => Wo_Secure($_POST['first_name']),
                            'last_name' => Wo_Secure($_POST['last_name']),
                            'message' => $success_icon . $wo['lang']['setting_updated']
                        );
                    }
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_socialinks_setting") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            if (empty($errors)) {
                $Update_data = array(
                    'facebook' => $_POST['facebook'],
                    'google' => $_POST['google'],
                    'linkedin' => $_POST['linkedin'],
                    'vk' => $_POST['vk'],
                    'instagram' => $_POST['instagram'],
                    'twitter' => $_POST['twitter'],
                    'youtube' => $_POST['youtube']
                );
                if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                    $field_data = array();
                    if (!empty($_POST['custom_fields'])) {
                        $fields = Wo_GetProfileFields('social');
                        foreach ($fields as $key => $field) {
                            $name = $field['fid'];
                            if (isset($_POST[$name])) {
                                if (mb_strlen($_POST[$name]) > $field['length']) {
                                    $errors[] = $error_icon . $field['name'] . ' field max characters is ' . $field['length'];
                                }
                                $field_data[] = array(
                                    $name => $_POST[$name]
                                );
                            }
                        }
                    }
                    if (!empty($field_data)) {
                        $insert = Wo_UpdateUserCustomData($_POST['user_id'], $field_data);
                    }
                    if (empty($errors)) {
                        $data = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated']
                        );
                    }
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_images_setting") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            if (isset($_FILES['avatar']['name'])) {
                if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['user_id']) === true) {
                    $Userdata = Wo_UserData($_POST['user_id']);
                }
            }
            if (isset($_FILES['cover']['name'])) {
                if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['user_id']) === true) {
                    $Userdata = Wo_UserData($_POST['user_id']);
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'lastseen' => time()
                );
                if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                    $userdata2 = Wo_UserData($_POST['user_id']);
                    $data      = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated'],
                        'cover' => $userdata2['cover'],
                        'avatar' => $userdata2['avatar']
                    );
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "update_proBox_setting") {
	
    $media=array();
    $media['blank']=1;
    $proboxType=$_POST['probox_type'];
    $media['type']=$proboxType;
	$hash_id = $_POST['hash_id'];
    if (isset($_POST['user_id']) && isset($hash_id)) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            if ($proboxType==1) {
                if(isset($_POST['probox_textarea'])){
                    $media['blank']=0;
                    $media['text']=$_POST['probox_textarea'];
                }
            }
            if($proboxType==2){
                if (isset($_FILES['probox_image']['name'])) {
                    if ($_FILES['probox_image']['size'] > $wo['config']['maxUpload']) {
                        $invalid_file = 1;
                    } else if (Wo_IsFileAllowed($_FILES['probox_image']['name']) == false) {
                        $invalid_file = 2;
                    } else {
                        $fileInfo = array(
                            'file' => $_FILES["probox_image"]["tmp_name"],
                            'name' => $_FILES['probox_image']['name'],
                            'size' => $_FILES["probox_image"]["size"],
                            'type' => $_FILES["probox_image"]["type"],
                        );
                        $media    = Wo_ShareFile($fileInfo);
                        
                        if (!empty($media)) {
                            $media['blank']=0;
                        }
                    }
                }
            }
            if($proboxType==3){
                if (isset($_FILES['probox_video']['name'])) {
                    if ($_FILES['probox_video']['size'] > $wo['config']['maxUpload']) {
                        $invalid_file = 1;
                    } else if (Wo_IsFileAllowed($_FILES['probox_video']['name']) == false) {
                        $invalid_file = 2;
                    } else {
                        $fileInfo = array(
                            'file' => $_FILES["probox_video"]["tmp_name"],
                            'name' => $_FILES['probox_video']['name'],
                            'size' => $_FILES["probox_video"]["size"],
                            'type' => $_FILES["probox_video"]["type"],
                            'types' => 'mp4,m4v,webm,flv,mov,mpeg'
                        );
                        $media    = Wo_ShareFile($fileInfo);
                        if (!empty($media)) {
                            
                            $media['blank']=0;
                            
                        }
                    }
                
                }
            }
            
            if (empty($errors)) {
                $result=Wo_AddProboxContent($media,$_POST['user_id']);
                if($result){
                    $data      = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == "get_homebgimg") {

    if (isset($wo['user']['user_id']))
    {
    $sql_query             = mysqli_query($sqlConnect, "Select * from " . T_USERS. " WHERE `user_id` = " . $wo['user']['user_id']);
       $fetched_data = mysqli_fetch_assoc($sql_query) ;
        $bg= $fetched_data['home_background'];
    
    $data      = array(
                        'status' => 200,
                        'img' =>$bg
                    );
        header("Content-type: application/json");             
    echo json_encode($data);
    }
}
if ($f == "update_design_setting") {
    if (isset($_POST['user_id']) && Wo_CheckSession($hash_id) === true) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            $background_image_status = 0;
            $background_homeimage_status = 0;

           if (isset($_FILES['avatar']['name'])) {
                 $file=$_FILES["avatar"]["tmp_name"];
                 
                 $avdir = 'upload/photos/' .'2018'. '/' .'07'.'/'.$_FILES['avatar']['name'];

                  $filename            =  $avdir;
                if (move_uploaded_file($file,$filename)) {
                    $background_homeimage_status = 1;
                }
            }
            if (isset($_FILES['background_image']['name'])) {
                if (Wo_UploadImage($_FILES["background_image"]["tmp_name"], $_FILES['background_image']['name'], 'background_image', $_FILES['background_image']['type'], $_POST['user_id']) === true) {
                    $background_image_status = 1;
                }
            }
             if (isset($_FILES['background_homeimage']['name'])) {
                 $file=$_FILES["background_homeimage"]["tmp_name"];
                 
                 $dir = 'upload/photos/' .'2018'. '/' .'07'.'/'.$_FILES['background_homeimage']['name'];
                 $_SESSION['home_path']=$dir;
                  $filename            = $dir;
                if (move_uploaded_file($file,$filename)) {
                    $background_homeimage_status = 1;
                }
            }
            if (!empty($_POST['background_image_status'])) {
                if ($_POST['background_image_status'] == 'defualt') {
                    $background_image_status = 0;
                } else if ($_POST['background_image_status'] == 'my_background') {
                    $background_image_status = 1;
                } else {
                    $background_image_status = 0;
                }
            }
            $mediaFilename = $Userdata['css_file'];
            if (isset($_FILES['css_file']['name']) && $wo['config']['css_upload'] == 1) {
                $fileInfo      = array(
                    'file' => $_FILES["css_file"]["tmp_name"],
                    'name' => $_FILES['css_file']['name'],
                    'size' => $_FILES["css_file"]["size"],
                    'type' => $_FILES["css_file"]["type"],
                    'types' => 'css,CSS'
                );
                $media         = Wo_ShareFile($fileInfo);
                $mediaFilename = $media['filename'];
            }
            if (empty($errors)) {
               if (isset($_FILES['avatar']['name'])) { 
                $Update_data = array(
                    'avatar' => $avdir,
                
                );
               } else if(isset($_FILES['background_image']['name'])){
                   $Update_data = array(
                    
                   'background_image_status' => $background_image_status,
                
                );
               }
               else if (isset($_FILES['background_homeimage']['name'])) {
                   $Update_data = array(
                  'home_background' =>$_SESSION['home_path'],
                    'background_homeimage_status' => $background_homeimage_status,

                );
               }
               else {
                   $Update_data = array(
                    'avatar' => $avdir,
                    'home_background' =>$_SESSION['home_path'],
                    'background_image_status' => $background_image_status,
                    'background_homeimage_status' => $background_homeimage_status,
                    'css_file' => $mediaFilename
                );
               }
                $css_status  = 1;
                if (!empty($_POST['css_status'])) {
                    if ($_POST['css_status'] == 1) {
                        $Update_data['css_file'] = '';
                    } else if ($_POST['css_status'] == 2) {
                        $Update_data['css_file'] = $mediaFilename;
                    }
                }
                if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                    $userdata2 = Wo_UserData($_POST['user_id']);
                    $data      = array(
                        'status' => 200,
                        'avatar'=>"https://mitrah.in/".$avdir,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'update_page_design_setting') {
    if (isset($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
        $Userdata = Wo_PageData($_POST['page_id']);
        if (!empty($Userdata['id'])) {
            $background_image_status = 0;
            if (isset($_FILES['background_image']['name'])) {
                if (Wo_UploadImage($_FILES["background_image"]["tmp_name"], $_FILES['background_image']['name'], 'page_background_image', $_FILES['background_image']['type'], $_POST['page_id'], 'page') === true) {
                    $background_image_status = 1;
                }
            }
            if (!empty($_POST['background_image_status'])) {
                if ($_POST['background_image_status'] == 'defualt') {
                    $background_image_status = 0;
                } else if ($_POST['background_image_status'] == 'my_background') {
                    $background_image_status = 1;
                } else {
                    $background_image_status = 0;
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'background_image_status' => $background_image_status
                );
                if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                    $userdata2 = Wo_PageData($_POST['page_id']);
                    $data      = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'update_user_avatar_picture') {
    if (isset($_FILES['avatar']['name'])) {
        if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['user_id']) === true) {
            $img  = Wo_UserData($_POST['user_id']);
            $data = array(
                'status' => 200,
                'img' => $img['avatar'],
                'img_or' => $img['avatar_org'],
                'big_text' => $wo['lang']['looks_good'],
                'small_text' =>'You will be able to change and add more to your profile later.' 
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_user_cover_picture') {
    if (isset($_FILES['cover']['name'])) {
        if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['user_id']) === true) {
            $img              = Wo_UserData($_POST['user_id']);
            $_SESSION['file'] = $img['cover_org'];
            $data             = array(
                'status' => 200,
                'img' => $img['cover'],
                'cover_or' => $img['cover_org'],
                'cover_full' => Wo_GetMedia($img['cover_full']),
                'session' => $_SESSION['file'],
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'set_admin_alert_cookie') {
    setcookie('profileAlert', '1', time() + 86000);
}
if ($f == 'delete_user_account') {
    if (isset($_POST['password'])) {
        if (Wo_HashPassword($_POST['password'], $wo['user']['password']) == false) {
            $errors[] = $error_icon . $wo['lang']['current_password_mismatch'];
        }
        if (empty($errors)) {
            if (Wo_DeleteUser($wo['user']['user_id']) === true) {
                $data = array(
                    'status' => 200,
                    'message' => $success_icon . $wo['lang']['account_deleted'],
                    'location' => Wo_SeoLink('index.php?link1=logout')
                );
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'deactivate_user_account') {
    //pr($_POST);
    if (isset($_POST['password'])) {
        if (Wo_HashPassword($_POST['password'], $wo['user']['password']) == false) {
            $errors[] = $error_icon . $wo['lang']['current_password_mismatch'];
        }
        
        $deact=$_POST['deactivate'];
        $addit=$_POST['additional'];
        if (empty($errors)) {
            if (Wo_DeactivateAccount($wo['user']['user_id'],$deact,$addit) === true) {
                $data = array(
                    'status' => 200,
                    'message' => $success_icon . "Account has been deactivated",
                    'location' => Wo_SeoLink('index.php?link1=logout')
                );
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'update_sidebar_users') {
    $html = '';
    foreach (Wo_UserSug(5) as $wo['UsersList']) {
        $wo['UsersList']['user_name'] = $wo['UsersList']['name'];
        if (!empty($wo['UsersList']['last_name'])) {
            $wo['UsersList']['user_name'] = $wo['UsersList']['first_name'];
        }
        $html .= Wo_LoadPage('sidebar/sidebar-user-list');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_sidebar_groups') {
    $html = '';
    foreach (Wo_GroupSug(5) as $wo['GroupList']) {
        $html .= Wo_LoadPage('sidebar/sidebar-group-list');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'follow_user') {
    if (isset($_GET['following_id']) && Wo_CheckMainSession($hash_id) === true) {
        if (Wo_IsFollowing($_GET['following_id'], $wo['user']['user_id']) === true || Wo_IsFollowRequested($_GET['following_id'], $wo['user']['user_id']) === true) {
            if (Wo_DeleteFollow($_GET['following_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'can_send' => 0,
                    'html' => ''
                );
            }
        } else {
            if (Wo_RegisterFollow($_GET['following_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'can_send' => 0,
                    'html' => ''
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'accept_follow_request') {
    if (isset($_GET['following_id'])) {
        if (Wo_AcceptFollowRequest($_GET['following_id'], $wo['user']['user_id'])) {
            $data = array(
                'status' => 200,
                'html' => Wo_GetFollowButton($_GET['following_id'])
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'delete_follow_request') {
    if (isset($_GET['following_id'])) {
        if (Wo_DeleteFollowRequest($_GET['following_id'], $wo['user']['user_id'])) {
            $data = array(
                'status' => 200,
                'html' => Wo_GetFollowButton($_GET['following_id'])
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_follow_requests') {
    $data     = array(
        'status' => 200,
        'html' => ''
    );
    $requests = Wo_GetFollowRequests();
    if (count($requests) > 0) {
        foreach ($requests as $wo['request']) {
            $data['html'] .= Wo_LoadPage('header/follow-requests');
        }
    } else {
        $data['message'] = $wo['lang']['no_new_requests'];
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_notifications') {
    $data             = array(
        'status' => 200,
        'html' => ''
    );
    $notifications    = Wo_GetNotifications();
    $notification_ids = array();
    if (count($notifications) > 0) {
        foreach ($notifications as $wo['notification']) {
            $data['html'] .= Wo_LoadPage('header/notifecation');
            if ($wo['notification']['seen'] == 0) {
                $notification_ids[] = $wo['notification']['id'];
            }
        }
        if (!empty($notification_ids)) {
            $query_where = '\'' . implode('\', \'', $notification_ids) . '\'';
            $query       = "UPDATE " . T_NOTIFICATION . " SET `seen` = " . time() . " WHERE `id` IN ($query_where)";
            $sql_query   = mysqli_query($sqlConnect, $query);
        }
    } else {
        $data['message'] = $wo['lang']['no_new_notification'];
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_messages') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $data     = array(
            'status' => 200,
            'html' => ''
        );
        $messages = Wo_GetMessagesUsers($wo['user']['user_id'], '', 4);
        if (count($messages) > 0) {
            foreach ($messages as $wo['message']) {
                $data['html'] .= Wo_LoadPage('header/messages');
            }
        } else {
            $data['message'] = $wo['lang']['no_more_message_to_show'];
        }
        $data['messages_url']  = Wo_SeoLink('index.php?link1=messages');
        $data['messages_text'] = $wo['lang']['see_all'];
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_data') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $sql_query             = mysqli_query($sqlConnect, "UPDATE " . T_APP_SESSIONS . " SET `time` = " . time() . " WHERE `platform` = 'web' AND `user_id` = " . $wo['user']['user_id']);
        $data['pop']           = 0;
        $data['status']        = 200;
        $data['notifications'] = Wo_CountNotifications(array(
            'unread' => true
        ));
        $data['html']          = '';
        $notifications         = Wo_GetNotifications(array(
            'type_2' => 'popunder',
            'unread' => true,
            'limit' => 1
        ));
        foreach ($notifications as $wo['notification']) {
            $data['html']              = Wo_LoadPage('header/notifecation');
            $data['icon']              = $wo['notification']['notifier']['avatar'];
            $data['title']             = $wo['notification']['notifier']['name'];
            $data['notification_text'] = $wo['notification']['type_text'];
            $data['url']               = $wo['notification']['url'];
            $data['pop']               = 200;
            if ($wo['notification']['seen'] == 0) {
                $query     = "UPDATE " . T_NOTIFICATION . " SET `seen_pop` = " . time() . " WHERE `id` = " . $wo['notification']['id'];
                $sql_query = mysqli_query($sqlConnect, $query);
            }
        }
        $data['messages'] = Wo_CountMessages(array(
            'new' => true
        ), 'interval');
        $data['calls']    = 0;
        $data['is_call']  = 0;
        $check_calles     = Wo_CheckFroInCalls();
        if ($check_calles !== false && is_array($check_calles)) {
            $wo['incall']                 = $check_calles;
            $wo['incall']['in_call_user'] = Wo_UserData($check_calles['from_id']);
            $data['calls']                = 200;
            $data['is_call']              = 1;
            $data['calls_html']           = Wo_LoadPage('modals/in_call');
        }
        $data['audio_calls']   = 0;
        $data['is_audio_call'] = 0;
        $check_calles          = Wo_CheckFroInCalls('audio');
        if ($check_calles !== false && is_array($check_calles)) {
            $wo['incall']                 = $check_calles;
            $wo['incall']['in_call_user'] = Wo_UserData($check_calles['from_id']);
            $data['audio_calls']          = 200;
            $data['is_audio_call']        = 1;
            $data['audio_calls_html']     = Wo_LoadPage('modals/in_audio_call');
        }
        $data['followRequests']      = Wo_CountFollowRequests();
        $data['notifications_sound'] = $wo['user']['notifications_sound'];
    }
    $data['count_num'] = 0;
    if ($_GET['check_posts'] == 'true') {
        if (!empty($_GET['before_post_id']) && isset($_GET['user_id'])) {
            $html              = '';
            $postsData         = array(
                'before_post_id' => $_GET['before_post_id'],
                'publisher_id' => $_GET['user_id'],
                'limit' => 20,
                'ad-id' => 0
            );
            $posts             = Wo_GetPosts($postsData);
            $count             = count($posts);
            $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_posts']);
            $data['count_num'] = $count;
        }
    } else if ($_GET['hash_posts'] == 'true') {
        if (!empty($_GET['before_post_id']) && isset($_GET['user_id'])) {
            $html              = '';
            $posts             = Wo_GetHashtagPosts($_GET['hashtagName'], 0, 20, $_GET['before_post_id']);
            $count             = count($posts);
            $data['count']     = str_replace('{count}', $count, $wo['lang']['view_more_posts']);
            $data['count_num'] = $count;
        }
    }
    $send_messages_to_phones = Wo_MessagesPushNotifier();
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_lastseen') {
    if (Wo_CheckMainSession($hash_id) === true) {
        if (Wo_LastSeen($wo['user']['user_id']) === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'messages') {
    if ($s == 'get_user_messages') {
        if (!empty($_GET['user_id']) AND is_numeric($_GET['user_id']) AND $_GET['user_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $html       = '';
            $user_id    = $_GET['user_id'];
            $can_replay = true;
            $recipient  = Wo_UserData($user_id);
            $messages   = Wo_GetMessages(array(
                'user_id' => $user_id
            ));
            if (!empty($recipient['user_id']) && $recipient['message_privacy'] == 1) {
                if (Wo_IsFollowing($wo['user']['user_id'], $recipient['user_id']) === false) {
                    $can_replay = false;
                }
            }
            foreach ($messages as $wo['message']) {
                $html .= Wo_LoadPage('messages/messages-text-list');
            }
            $wo['chat']['color'] = Wo_GetChatColor($wo['user']['user_id'], $recipient['user_id']);
            $data = array(
                'status' => 200,
                'html' => $html,
                'can_replay' => $can_replay,
                'view_more_text' => $wo['lang']['view_more_messages'],
                'video_call' => 0,
                'audio_call' => 0,
                'color' => $wo['chat']['color'],
            );
            if ($wo['config']['video_chat'] == 1) {
                if ($recipient['lastseen'] > time() - 60) {
                    $data['video_call'] = 200;
                }
            }
            if ($wo['config']['audio_chat'] == 1) {
                if ($recipient['lastseen'] > time() - 60) {
                    $data['audio_call'] = 200;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_group_messages' && isset($_GET['group_id']) && is_numeric($_GET['group_id']) && $_GET['group_id'] > 0 && Wo_CheckMainSession($hash_id)) {
        $html     = '';
        $group_id = $_GET['group_id'];
        $messages = Wo_GetGroupMessages(array(
            'group_id' => $group_id
        ));
        @Wo_UpdateGChatLastSeen($group_id);
        foreach ($messages as $wo['message']) {
            $html .= Wo_LoadPage('messages/group-text-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html,
            'view_more_text' => $wo['lang']['view_more_messages']
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'send_message') {
        if (isset($_POST['user_id']) && is_numeric($_POST['user_id']) && $_POST['user_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $html          = '';
            $media         = '';
            $mediaFilename = '';
            $mediaName     = '';
            $invalid_file  = 0;
            if (isset($_FILES['sendMessageFile']['name'])) {
                if ($_FILES['sendMessageFile']['size'] > $wo['config']['maxUpload']) {
                    $invalid_file = 1;
                } else if (!in_array($_FILES["sendMessageFile"]["type"], explode(',', $wo['config']['mime_types']))) {
                    $invalid_file = 2;
                } else {
                    $fileInfo      = array(
                        'file' => $_FILES["sendMessageFile"]["tmp_name"],
                        'name' => $_FILES['sendMessageFile']['name'],
                        'size' => $_FILES["sendMessageFile"]["size"],
                        'type' => $_FILES["sendMessageFile"]["type"]
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            } else if (!empty($_POST['record-file']) && !empty($_POST['record-name'])) {
                $mediaFilename = $_POST['record-file'];
                $mediaName     = $_POST['record-name'];
            }
            $messages = Wo_RegisterMessage(array(
                'from_id' => Wo_Secure($wo['user']['user_id']),
                'to_id' => Wo_Secure($_POST['user_id']),
                'text' => Wo_Secure($_POST['textSendMessage']),
                'media' => Wo_Secure($mediaFilename),
                'mediaFileName' => Wo_Secure($mediaName),
                'time' => time()
            ));
            if ($messages > 0) {
                $messages = Wo_GetMessages(array(
                    'message_id' => $messages,
                    'user_id' => $_POST['user_id']
                ));
                foreach ($messages as $wo['message']) {
                    $html .= Wo_LoadPage('messages/messages-text-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'invalid_file' => $invalid_file
                );
            }
            if ($invalid_file > 0 && empty($messages)) {
                $data = array(
                    'status' => 500,
                    'invalid_file' => $invalid_file
                );
            }
        } else if (isset($_POST['group_id']) && is_numeric($_POST['group_id']) && $_POST['group_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $html          = '';
            $media         = '';
            $mediaFilename = '';
            $mediaName     = '';
            $invalid_file  = 0;
            if (isset($_FILES['sendMessageFile']['name'])) {
                if ($_FILES['sendMessageFile']['size'] > $wo['config']['maxUpload']) {
                    $invalid_file = 1;
                } else if (!in_array($_FILES["sendMessageFile"]["type"], explode(',', $wo['config']['mime_types']))) {
                    $invalid_file = 2;
                } else {
                    $fileInfo      = array(
                        'file' => $_FILES["sendMessageFile"]["tmp_name"],
                        'name' => $_FILES['sendMessageFile']['name'],
                        'size' => $_FILES["sendMessageFile"]["size"],
                        'type' => $_FILES["sendMessageFile"]["type"]
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            } else if (!empty($_POST['record-file']) && !empty($_POST['record-name'])) {
                $mediaFilename = $_POST['record-file'];
                $mediaName     = $_POST['record-name'];
            }
            $message_id = Wo_RegisterGroupMessage(array(
                'from_id' => Wo_Secure($wo['user']['user_id']),
                'group_id' => Wo_Secure($_POST['group_id']),
                'text' => Wo_Secure($_POST['textSendMessage']),
                'media' => Wo_Secure($mediaFilename),
                'mediaFileName' => Wo_Secure($mediaName),
                'time' => time()
            ));
            if ($message_id > 0) {
                $message = Wo_GetGroupMessages(array(
                    'id' => $message_id,
                    'group_id' => $_POST['group_id']
                ));
                foreach ($message as $wo['message']) {
                    $html .= Wo_LoadPage('messages/group-text-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'invalid_file' => $invalid_file
                );
            }
            if ($invalid_file > 0 && empty($message_id)) {
                $data = array(
                    'status' => 500,
                    'invalid_file' => $invalid_file
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_message_record') {
        if (isset($_POST['audio-filename']) && isset($_FILES['audio-blob']['name'])) {
            $fileInfo       = array(
                'file' => $_FILES["audio-blob"]["tmp_name"],
                'name' => $_FILES['audio-blob']['name'],
                'size' => $_FILES["audio-blob"]["size"],
                'type' => $_FILES["audio-blob"]["type"]
            );
            $media          = Wo_ShareFile($fileInfo);
            $data['url']    = $media['filename'];
            $data['status'] = 200;
            $data['name']   = $media['name'];
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'upload_record') {
        if (isset($_POST['audio-filename']) && isset($_FILES['audio-blob']['name'])) {
            $fileInfo       = array(
                'file' => $_FILES["audio-blob"]["tmp_name"],
                'name' => $_FILES['audio-blob']['name'],
                'size' => $_FILES["audio-blob"]["size"],
                'type' => $_FILES["audio-blob"]["type"]
            );
            $media          = Wo_ShareFile($fileInfo);
            $data['status'] = 200;
            $data['url']    = $media['filename'];
            $data['name']   = $media['name'];
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_previous_messages') {
        $html = '';
        if (!empty($_GET['user_id']) && is_numeric($_GET['user_id']) && $_GET['user_id'] > 0 && !empty($_GET['before_message_id'])) {
            $user_id           = Wo_Secure($_GET['user_id']);
            $before_message_id = Wo_Secure($_GET['before_message_id']);
            $messages          = Wo_GetMessages(array(
                'user_id' => $user_id,
                'before_message_id' => $before_message_id
            ));
            if ($messages > 0) {
                foreach ($messages as $wo['message']) {
                    $html .= Wo_LoadPage('messages/messages-text-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html
                );
            }
        } else if (!empty($_GET['group_id']) && is_numeric($_GET['group_id']) && $_GET['group_id'] > 0 && !empty($_GET['before_message_id'])) {
            $group_id          = Wo_Secure($_GET['group_id']);
            $before_message_id = Wo_Secure($_GET['before_message_id']);
            $messages          = Wo_GetGroupMessages(array(
                'group_id' => $group_id,
                'offset' => $before_message_id,
                'old' => true
            ));
            if ($messages > 0) {
                foreach ($messages as $wo['message']) {
                    $html .= Wo_LoadPage('messages/group-text-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_recipients') {
        $html  = '';
        $users = Wo_GetMessagesUsers($wo['user']['user_id']);
        $data  = array(
            'status' => 404
        );
        if (count($users) > 0) {
            foreach ($users as $wo['recipient']) {
                $html .= Wo_LoadPage('messages/messages-recipients-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_new_messages') {
        $html                        = '';
        $data['update_group_status'] = Wo_CheckLastGroupAction();
        if (isset($_GET['user_id']) && is_numeric($_GET['user_id']) && $_GET['user_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $user_id = Wo_Secure($_GET['user_id']);
            if (!empty($user_id)) {
                $user_id  = $_GET['user_id'];
                $messages = Wo_GetMessages(array(
                    'after_message_id' => $_GET['message_id'],
                    'user_id' => $user_id
                ));
                if (count($messages) > 0) {
                    foreach ($messages as $wo['message']) {
                        $html .= Wo_LoadPage('messages/messages-text-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html,
                        'sender' => $wo['user']['user_id']
                    );
                }
            }
        } else if (isset($_GET['group_id']) && is_numeric($_GET['group_id']) && $_GET['group_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $group_id = Wo_Secure($_GET['group_id']);
            if (!empty($group_id)) {
                $group_id = $group_id;
                $messages = Wo_GetGroupMessages(array(
                    'offset' => $_GET['message_id'],
                    'group_id' => $group_id,
                    'new' => true
                ));
                if (count($messages) > 0) {
                    foreach ($messages as $wo['message']) {
                        $html .= Wo_LoadPage('messages/group-text-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html
                    );
                    @Wo_UpdateGChatLastSeen($group_id);
                }
            }
        }
        if (!empty($user_id)) {
            $data['color'] = Wo_GetChatColor($wo['user']['user_id'], $user_id);
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_message') {
        if (isset($_GET['message_id']) && Wo_CheckMainSession($hash_id) === true) {
            $message_id = Wo_Secure($_GET['message_id']);
            if (!empty($message_id) || is_numeric($message_id) || $message_id > 0) {
                if (Wo_DeleteMessage($message_id) === true) {
                    $data = array(
                        'status' => 200
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_conversation') {
        if (isset($_GET['user_id']) && Wo_CheckMainSession($hash_id) === true) {
            $user_id = Wo_Secure($_GET['user_id']);
            if (!empty($user_id) || is_numeric($user_id) || $user_id > 0) {
                if (Wo_DeleteConversation($user_id) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $wo['lang']['conver_deleted']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'clear_group_chat') {
        if (isset($_GET['id']) && Wo_CheckMainSession($hash_id) === true) {
            $id = Wo_Secure($_GET['id']);
            if (!empty($id) || is_numeric($id) || $id > 0) {
                if (Wo_DeleteConversation($user_id) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $wo['lang']['no_messages_here_yet']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_last_message_seen_status') {
        if (isset($_GET['last_id'])) {
            $message_id = Wo_Secure($_GET['last_id']);
            if (!empty($message_id) || is_numeric($message_id) || $message_id > 0) {
                $seen = Wo_SeenMessage($message_id);
                if ($seen > 0) {
                    $data = array(
                        'status' => 200,
                        'time' => $seen['time'],
                        'seen' => $seen['seen']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'admin_setting' AND (Wo_IsAdmin() || Wo_IsModerator())) {
    if ($s == 'top_up_wallet') {
        if (!empty($_POST['amount'])) {
            $update = Wo_UpdateUserData($wo['user']['user_id'], array('wallet' => $_POST['amount']));
            if ($update) {
                $data = array('status' => 200);
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_custom_code') {
        $data     = array('status' => 400);
        $theme    = $wo['config']['theme'];
        $request  = (isset($_POST['cheader']) && isset($_POST['cfooter']) && isset($_POST['css']));
        if ($request === true){
            if (is_writable("themes/$theme/custom")) {
                $up_data = array(
                    $_POST['cheader'],
                    $_POST['cfooter'],
                    $_POST['css']
                );
                $save           = Wo_CustomCode('p',$up_data);
                $data['status'] = 200;
            }

            else{
                $data['status'] = 500;
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'verfiy_apps') {
        $arrContextOptions             = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false
            )
        );
        $data['android_status']        = 0;
        $data['windows_status']        = 0;
        $data['android_native_status'] = 0;
        if (!empty($_POST['android_purchase_code'])) {
            $android_code = Wo_Secure($_POST['android_purchase_code']);
            $file         = file_get_contents("http://www.wowonder.com/access_token.php?code={$android_code}&type=android", false, stream_context_create($arrContextOptions));
            $check        = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    $update                 = Wo_SaveConfig('footer_background', '#aaa');
                    $data['android_status'] = 200;
                } else {
                    $data['android_status'] = 400;
                    $data['android_text']   = $check['ERROR_NAME'];
                }
            }
        }
        if (!empty($_POST['android_native_purchase_code'])) {
            $android_code = Wo_Secure($_POST['android_native_purchase_code']);
            $file         = file_get_contents("http://www.wowonder.com/access_token.php?code={$android_code}&type=android", false, stream_context_create($arrContextOptions));
            $check        = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    $update                        = Wo_SaveConfig('footer_background_n', '#aaa');
                    $data['android_native_status'] = 200;
                } else {
                    $data['android_native_status'] = 400;
                    $data['android_text']          = $check['ERROR_NAME'];
                }
            }
        }
        if (!empty($_POST['windows_purchase_code'])) {
            $windows_code = Wo_Secure($_POST['windows_purchase_code']);
            $file         = file_get_contents("http://www.wowonder.com/access_token.php?code={$windows_code}&type=windows_desktop", false, stream_context_create($arrContextOptions));
            $check        = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    $update                 = Wo_SaveConfig('footer_text_color', '#ddd');
                    $data['windows_status'] = 200;
                } else {
                    $data['windows_status'] = 400;
                    $data['windows_text']   = $check['ERROR_NAME'];
                }
            }
        }
        if (!empty($_POST['ios_purchase_code'])) {
            $windows_code = Wo_Secure($_POST['ios_purchase_code']);
            $file         = file_get_contents("http://www.wowonder.com/access_token.php?code={$windows_code}&type=ios", false, stream_context_create($arrContextOptions));
            $check        = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    $update                 = Wo_SaveConfig('footer_background_2', '#aaa');
                    $data['ios_status'] = 200;
                } else {
                    $data['ios_status'] = 400;
                    $data['ios_text']   = $check['ERROR_NAME'];
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_lang_key') {
        if (Wo_CheckSession($hash_id) === true) {
            $array_langs = array();
            $lang_key    = Wo_Secure($_POST['id_of_key']);
            $langs       = Wo_LangsNamesFromDB();
            foreach ($_POST as $key => $value) {
                if (in_array($key, $langs)) {
                    $key   = Wo_Secure($key);
                    $value = Wo_Secure($value);
                    $query = mysqli_query($sqlConnect, "UPDATE " . T_LANGS . " SET `{$key}` = '{$value}' WHERE `lang_key` = '{$lang_key}'");
                    if ($query) {
                        $data['status'] = 200;
                    }
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_new_lang') {
        if (Wo_CheckSession($hash_id) === true) {
            $mysqli = Wo_LangsNamesFromDB();
            if (in_array($_POST['lang'], $mysqli)) {
                $data['status']  = 400;
                $data['message'] = 'This lang is already used.';
            } else {
                $lang_name = Wo_Secure($_POST['lang']);
                $lang_name = strtolower($lang_name);
                $query     = mysqli_query($sqlConnect, "ALTER TABLE " . T_LANGS . " ADD `$lang_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
                if ($query) {
                    $content = file_get_contents('assets/languages/extra/english.php');
                    $fp      = fopen("assets/languages/extra/$lang_name.php", "wb");
                    fwrite($fp, $content);
                    fclose($fp);
                    $english = Wo_LangsFromDB('english');
                    foreach ($english as $key => $lang) {
                        $lang  = Wo_Secure($lang);
                        $query = mysqli_query($sqlConnect, "UPDATE " . T_LANGS . " SET `{$lang_name}` = '$lang' WHERE `lang_key` = '{$key}'");
                    }
                    $data['status'] = 200;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_new_lang_key') {
        if (Wo_CheckSession($hash_id) === true) {
            if (!empty($_POST['lang_key'])) {
                $lang_key  = Wo_Secure($_POST['lang_key']);
                $mysqli    = mysqli_query($sqlConnect, "SELECT COUNT(id) as count FROM " . T_LANGS . " WHERE `lang_key` = '$lang_key'");
                $sql_fetch = mysqli_fetch_assoc($mysqli);
                if ($sql_fetch['count'] == 0) {
                    $mysqli = mysqli_query($sqlConnect, "INSERT INTO " . T_LANGS . " (`lang_key`) VALUE ('$lang_key')");
                    if ($mysqli) {
                        $data['status'] = 200;
                        $data['url']    = Wo_LoadAdminLinkSettings('manage-languages');
                    }
                } else {
                    $data['status']  = 400;
                    $data['message'] = 'This key is already used, please use other one.';
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_lang') {
        if (Wo_CheckMainSession($hash_id) === true) {
            $mysqli = Wo_LangsNamesFromDB();
            if (in_array($_GET['id'], $mysqli)) {
                $lang_name = Wo_Secure($_GET['id']);
                $query     = mysqli_query($sqlConnect, "ALTER TABLE " . T_LANGS . " DROP COLUMN `$lang_name`");
                if ($query) {
                    unlink("assets/languages/extra/$lang_name.php");
                    $data['status'] = 200;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'reset_windows_app_keys') {
        $app_key    = sha1(microtime());
        $data_array = array(
            'widnows_app_api_key' => $app_key
        );
        foreach ($data_array as $key => $value) {
            $saveSetting = Wo_SaveConfig($key, $value);
        }
        if ($saveSetting === true) {
            $data['status']  = 200;
            $data['app_key'] = $app_key;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'cancel_pro') {
        $cancel = Wo_DeleteProMemebership();
        if ($cancel) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_ref_system') {
        $saveSetting = false;
        if (!empty($_POST['affiliate_type'])) {
            $_POST['affiliate_type'] = 1;
        } else {
            $_POST['affiliate_type'] = 0;
        }
        foreach ($_POST as $key => $value) {
            if ($key != 'hash_id') {
                $saveSetting = Wo_SaveConfig($key, $value);
            }
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'mark_as_paid') {
        if (!empty($_GET['id']) && Wo_CheckSession($hash_id)) {
            $get_payment_info = Wo_GetPaymentHistory($_GET['id']);
            if (!empty($get_payment_info)) {
                $id     = $get_payment_info['id'];
                $update = mysqli_query($sqlConnect, "UPDATE " . T_A_REQUESTS . " SET status = '1' WHERE id = {$id}");
                if ($update) {
                    $body              = Wo_LoadPage('emails/payment-sent');
                    $body              = str_replace('{name}', $get_payment_info['user']['name'], $body);
                    $body              = str_replace('{amount}', $get_payment_info['amount'], $body);
                    $body              = str_replace('{site_name}', $config['siteName'], $body);
                    $send_message_data = array(
                        'from_email' => $wo['config']['siteEmail'],
                        'from_name' => $wo['config']['siteName'],
                        'to_email' => $get_payment_info['user']['email'],
                        'to_name' => $get_payment_info['user']['name'],
                        'subject' => 'New Payment | ' . $wo['config']['siteName'],
                        'charSet' => 'utf-8',
                        'message_body' => $body,
                        'is_html' => true
                    );
                    $send_message      = Wo_SendMessage($send_message_data);
                    if ($send_message) {
                        $data['status'] = 200;
                    }
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'decline_payment') {
        if (!empty($_GET['id']) && Wo_CheckSession($hash_id)) {
            $get_payment_info = Wo_GetPaymentHistory($_GET['id']);
            if (!empty($get_payment_info)) {
                $id     = $get_payment_info['id'];
                $update = mysqli_query($sqlConnect, "UPDATE " . T_A_REQUESTS . " SET status = '2' WHERE id = {$id}");
                if ($update) {
                    $body              = Wo_LoadPage('emails/payment-declined');
                    $body              = str_replace('{name}', $get_payment_info['user']['name'], $body);
                    $body              = str_replace('{amount}', $get_payment_info['amount'], $body);
                    $body              = str_replace('{site_name}', $config['siteName'], $body);
                    $send_message_data = array(
                        'from_email' => $wo['config']['siteEmail'],
                        'from_name' => $wo['config']['siteName'],
                        'to_email' => $get_payment_info['user']['email'],
                        'to_name' => $get_payment_info['user']['name'],
                        'subject' => 'Payment Declined | ' . $wo['config']['siteName'],
                        'charSet' => 'utf-8',
                        'message_body' => $body,
                        'is_html' => true
                    );
                    $send_message      = Wo_SendMessage($send_message_data);
                    if ($send_message) {
                        $data['status'] = 200;
                    }
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_new_page') {
        if (Wo_CheckSession($hash_id) === true && !empty($_POST['page_name']) && !empty($_POST['page_content']) && !empty($_POST['page_title'])) {
            $page_name    = Wo_Secure($_POST['page_name']);
            $page_content = Wo_Secure($_POST['page_content']);
            $page_title   = Wo_Secure($_POST['page_title']);
            $page_type    = 0;
            if (!empty($_POST['page_type'])) {
                $page_type = 1;
            }
            if (!preg_match('/^[\w]+$/', $page_name)) {
                $data = array(
                    'status' => 400,
                    'message' => 'Invalid page name characters'
                );
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
            $data_ = array(
                'page_name' => $page_name,
                'page_content' => $page_content,
                'page_title' => $page_title,
                'page_type' => $page_type
            );
            $add   = Wo_RegisterNewPage($data_);
            if ($add) {
                $data['status'] = 200;
            }
        } else {
            $data = array(
                'status' => 400,
                'message' => 'Please fill all the required fields'
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'edit_page') {
        if (Wo_CheckSession($hash_id) === true && !empty($_POST['page_id']) && !empty($_POST['page_name']) && !empty($_POST['page_content']) && !empty($_POST['page_title'])) {
            $page_name    = $_POST['page_name'];
            $page_content = $_POST['page_content'];
            $page_title   = $_POST['page_title'];
            $page_type    = 0;
            if (!empty($_POST['page_type'])) {
                $page_type = 1;
            }
            if (!preg_match('/^[\w]+$/', $page_name)) {
                $data = array(
                    'status' => 400,
                    'message' => 'Invalid page name characters'
                );
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
            $data_ = array(
                'page_name' => $page_name,
                'page_content' => $page_content,
                'page_title' => $page_title,
                'page_type' => $page_type
            );
            $add   = Wo_UpdateCustomPageData($_POST['page_id'], $data_);
            if ($add) {
                $data['status'] = 200;
            }
        } else {
            $data = array(
                'status' => 400,
                'message' => 'Please fill all the required fields'
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_new_field') {
        if (Wo_CheckSession($hash_id) === true && !empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['description'])) {
            $type              = Wo_Secure($_POST['type']);
            $name              = Wo_Secure($_POST['name']);
            $description       = Wo_Secure($_POST['description']);
            $registration_page = 0;
            if (!empty($_POST['registration_page'])) {
                $registration_page = 1;
            }
            $profile_page = 0;
            if (!empty($_POST['profile_page'])) {
                $profile_page = 1;
            }
            $length = 32;
            if (!empty($_POST['length'])) {
                if (is_numeric($_POST['length']) && $_POST['length'] < 1001) {
                    $length = Wo_Secure($_POST['length']);
                }
            }
            $placement_array = array(
                'profile',
                'general',
                'social',
                'none'
            );
            $placement       = 'profile';
            if (!empty($_POST['placement'])) {
                if (in_array($_POST['placement'], $placement_array)) {
                    $placement = Wo_Secure($_POST['placement']);
                }
            }
            $data_ = array(
                'name' => $name,
                'description' => $description,
                'length' => $length,
                'placement' => $placement,
                'registration_page' => $registration_page,
                'profile_page' => $profile_page,
                'active' => 1
            );
            if (!empty($_POST['options'])) {
                $options              = @explode("\n", $_POST['options']);
                $type                 = Wo_Secure(implode($options, ','));
                $data_['select_type'] = 'yes';
            }
            $data_['type'] = $type;
            $add           = Wo_RegisterNewField($data_);
            if ($add) {
                $data['status'] = 200;
            }
        } else {
            $data = array(
                'status' => 400,
                'message' => 'Please fill all the required fields'
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'edit_field') {
        if (Wo_CheckSession($hash_id) === true && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['id'])) {
            $name              = Wo_Secure($_POST['name']);
            $description       = Wo_Secure($_POST['description']);
            $registration_page = 0;
            if (!empty($_POST['registration_page'])) {
                $registration_page = 1;
            }
            $profile_page = 0;
            if (!empty($_POST['profile_page'])) {
                $profile_page = 1;
            }
            $active = 0;
            if (!empty($_POST['active'])) {
                $active = 1;
            }
            $length = 32;
            if (!empty($_POST['length'])) {
                if (is_numeric($_POST['length'])) {
                    $length = Wo_Secure($_POST['length']);
                }
            }
            $placement_array = array(
                'profile',
                'general',
                'social',
                'none'
            );
            $placement       = 'profile';
            if (!empty($_POST['placement'])) {
                if (in_array($_POST['placement'], $placement_array)) {
                    $placement = Wo_Secure($_POST['placement']);
                }
            }
            $data_ = array(
                'name' => $name,
                'description' => $description,
                'length' => $length,
                'placement' => $placement,
                'registration_page' => $registration_page,
                'profile_page' => $profile_page,
                'active' => $active
            );
            if (!empty($_POST['options'])) {
                $options              = @explode("\n", $_POST['options']);
                $data_['type']        = implode($options, ',');
                $data_['select_type'] = 'yes';
            }
            $add = Wo_UpdateField($_POST['id'], $data_);
            if ($add) {
                $data['status'] = 200;
            }
        } else {
            $data = array(
                'status' => 400,
                'message' => 'Please fill all the required fields'
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_field') {
        if (Wo_CheckMainSession($hash_id) === true && !empty($_GET['id'])) {
            $delete = Wo_DeleteField($_GET['id']);
            if ($delete) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_page') {
        if (Wo_CheckMainSession($hash_id) === true && !empty($_GET['id'])) {
            $delete = Wo_DeleteCustomPage($_GET['id']);
            if ($delete) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'new_backup') {
        $b = Wo_Backup($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name);
        if ($b) {
            $data['status'] = 200;
            $data['date']   = date('d-m-Y');
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'test_paypal') {
        $PayPal               = Wo_PayPal();
        $data['status']       = 200;
        $data['respond_code'] = $PayPal;
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_general_setting' && Wo_CheckSession($hash_id) === true) {
        $saveSetting = false;
        $delete_follow_table = 0;
        foreach ($_POST as $key => $value) {
            if (isset($wo['config'][$key]) || $key == 'googleAnalytics_en') {
                if ($key == 'googleAnalytics_en') {
                    $key = 'googleAnalytics';
                    $value = base64_decode($value);
                }
                if ($key == 'connectivitySystem') {
                    if (isset($_POST['connectivitySystem'])) {
                        if ($config['connectivitySystem'] == 1 && $_POST['connectivitySystem'] != 1) {
                            $delete_follow_table = 1;
                        } else if ($config['connectivitySystem'] != 1 && $_POST['connectivitySystem'] == 1) {
                            $delete_follow_table = 1;
                        }
                    }
                }
                $saveSetting = Wo_SaveConfig($key, $value);
            }
        }
        if ($saveSetting === true) {
            if ($delete_follow_table == 1) {
                mysqli_query($sqlConnect, "DELETE FROM " . T_FOLLOWERS);
                mysqli_query($sqlConnect, "DELETE FROM " . T_NOTIFICATION . " WHERE type='following'");
            }
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'test_s3') {
        try {
            $s3Client = S3Client::factory(array(
                'version' => 'latest',
                'region' => $wo['config']['region'],
                'credentials' => array(
                    'key' => $wo['config']['amazone_s3_key'],
                    'secret' => $wo['config']['amazone_s3_s_key']
                )
            ));
            $buckets  = $s3Client->listBuckets();
            if (!empty($buckets)) {
                if ($s3Client->doesBucketExist($wo['config']['bucket_name'])) {
                    $data['status'] = 200;
                    $array          = array(
                        'upload/photos/d-avatar.jpg',
                        'upload/photos/d-cover.jpg',
                        'upload/photos/d-group.jpg',
                        'upload/photos/d-page.jpg',
                        'upload/photos/d-blog.jpg',
                        'upload/photos/game-icon.png',
                        'upload/photos/d-film.jpg'
                    );
                    foreach ($array as $key => $value) {
                        $upload = Wo_UploadToS3($value, array(
                            'delete' => 'no'
                        ));
                    }
                } else {
                    $data['status'] = 300;
                }
            } else {
                $data['status'] = 500;
            }
        }
        catch (Exception $e) {
            $data['status']  = 400;
            $data['message'] = $e->getMessage();
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_terms_setting' && Wo_CheckSession($hash_id) === true) {
        $saveSetting = false;
        foreach ($_POST as $key => $value) {
            if ($key != 'hash_id') {
                $saveSetting = Wo_SaveTerm($key, base64_decode($value));
            }
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'test_message') {
        $send_message_data = array(
            'from_email' => $wo['config']['siteEmail'],
            'from_name' => $wo['config']['siteName'],
            'to_email' => $wo['user']['email'],
            'to_name' => $wo['user']['name'],
            'subject' => 'Test Message From ' . $wo['config']['siteName'],
            'charSet' => 'utf-8',
            'message_body' => 'If you can see this message, then your SMTP configuration is working fine.',
            'is_html' => false
        );
        $send_message      = Wo_SendMessage($send_message_data);
        if ($send_message === true) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
            $data['error']  = $mail->ErrorInfo;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_sms_setting' && Wo_CheckSession($hash_id) === true) {
        $saveSetting = false;
        foreach ($_POST as $key => $value) {
            if ($key != 'hash_id') {
                $saveSetting = Wo_SaveConfig($key, $value);
            }
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'test_sms_message') {
        $message      = 'This is a test message from ' . $wo['config']['siteName'];
        $send_message = Wo_SendSMSMessage($wo['config']['sms_phone_number'], $message);
        if ($send_message === true) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
            $data['error']  = $send_message;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_design_setting' && Wo_CheckSession($hash_id) === true) {
        $saveSetting = false;
        if (isset($_FILES['logo']['name'])) {
            $fileInfo = array(
                'file' => $_FILES["logo"]["tmp_name"],
                'name' => $_FILES['logo']['name'],
                'size' => $_FILES["logo"]["size"]
            );
            $media    = Wo_UploadLogo($fileInfo);
        }
        if (isset($_FILES['background']['name'])) {
            $fileInfo = array(
                'file' => $_FILES["background"]["tmp_name"],
                'name' => $_FILES['background']['name'],
                'size' => $_FILES["background"]["size"]
            );
            $media    = Wo_UploadBackground($fileInfo);
        }
        if (isset($_FILES['favicon']['name'])) {
            $fileInfo = array(
                'file' => $_FILES["favicon"]["tmp_name"],
                'name' => $_FILES['favicon']['name'],
                'size' => $_FILES["favicon"]["size"]
            );
            $media    = Wo_UploadFavicon($fileInfo);
        }
        foreach ($_POST as $key => $value) {
            if ($key != 'hash_id') {
                $saveSetting = Wo_SaveConfig($key, $value);
            }
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'updateTheme' && isset($_POST['theme']) && Wo_CheckSession($hash_id) === true) {
        $saveSetting = false;
        foreach ($_POST as $key => $value) {
            if ($key != 'hash_id') {
                $saveSetting = Wo_SaveConfig($key, $value);
            }
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_user' && isset($_GET['user_id']) && Wo_CheckSession($hash_id) === true) {
        if (Wo_DeleteUser($_GET['user_id']) === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_user_page' && isset($_GET['page_id']) && Wo_CheckSession($hash_id) === true) {
        if (Wo_DeletePage($_GET['page_id']) === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_group' && isset($_GET['group_id']) && Wo_CheckSession($hash_id) === true) {
        if (Wo_DeleteGroup($_GET['group_id']) === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'filter_all_users') {
        $html  = '';
        $after = (isset($_GET['after_user_id']) && is_numeric($_GET['after_user_id']) && $_GET['after_user_id'] > 0) ? $_GET['after_user_id'] : 0;
        foreach (Wo_GetAllUsers(20, 'ManageUsers', $_POST, $after) as $wo['userlist']) {
            $html .= Wo_LoadAdminPage('manage-users/list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_more_pages') {
        $html  = '';
        $after = (isset($_GET['after_page_id']) && is_numeric($_GET['after_page_id']) && $_GET['after_page_id'] > 0) ? $_GET['after_page_id'] : 0;
        foreach (Wo_GetAllPages(20, $after) as $wo['pagelist']) {
            $html .= Wo_LoadAdminPage('manage-pages/list');;
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_more_groups') {
        $html  = '';
        $after = (isset($_GET['after_group_id']) && is_numeric($_GET['after_group_id']) && $_GET['after_group_id'] > 0) ? $_GET['after_group_id'] : 0;
        foreach (Wo_GetAllGroups(20, $after) as $wo['grouplist']) {
            $html .= Wo_LoadAdminPage('manage-groups/list');;
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_users_setting' && isset($_POST['user_lastseen'])) {
        $delete_follow_table = 0;
        $saveSetting         = false;
        foreach ($_POST as $key => $value) {
            $saveSetting = Wo_SaveConfig($key, $value);
        }
        if ($saveSetting === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_more_posts') {
        $html      = '';
        $postsData = array(
            'limit' => 10,
            'after_post_id' => Wo_Secure($_GET['after_post_id'])
        );
        foreach (Wo_GetAllPosts($postsData) as $wo['story']) {
            $html .= Wo_LoadAdminPage('manage-posts/list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_post' && Wo_CheckSession($hash_id) === true) {
        if (!empty($_POST['post_id'])) {
            if (Wo_DeletePost($_POST['post_id'])) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode(Wo_DeletePost($_POST['post_id']));
        exit();
    }
    if ($s == 'delete_reported_content' && (Wo_IsAdmin() || Wo_IsModerator())) {
        if (!empty($_GET['id']) && !empty($_GET['type']) && !empty($_GET['report_id'])) {
            $type   = Wo_Secure($_GET['type']);
            $id     = Wo_Secure($_GET['id']);
            $report = Wo_Secure($_GET['report_id']);
            if ($type == 'post' && Wo_DeletePost($id) === true) {
                $deleteReport = Wo_DeleteReport($report);
                if ($deleteReport === true) {
                    $data = array(
                        'status' => 200,
                        'html' => Wo_CountUnseenReports()
                    );
                }
            }
            if ($type == 'user' && Wo_DeleteUser($id) === true) {
                $deleteReport = Wo_DeleteReport($report);
                if ($deleteReport === true) {
                    $data = array(
                        'status' => 200,
                        'html' => Wo_CountUnseenReports()
                    );
                }
            }
            if ($type == 'page' && Wo_DeletePage($id) === true) {
                $deleteReport = Wo_DeleteReport($report);
                if ($deleteReport === true) {
                    $data = array(
                        'status' => 200,
                        'html' => Wo_CountUnseenReports()
                    );
                }
            }
            if ($type == 'group' && Wo_DeleteGroup($id) === true) {
                $deleteReport = Wo_DeleteReport($report);
                if ($deleteReport === true) {
                    $data = array(
                        'status' => 200,
                        'html' => Wo_CountUnseenReports()
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'mark_as_safe') {
        if (!empty($_GET['report_id'])) {
            $deleteReport = Wo_DeleteReport($_GET['report_id']);
            if ($deleteReport === true) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_CountUnseenReports()
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_verification') {
        if (!empty($_GET['id'])) {
            if (Wo_DeleteVerificationRequest($_GET['id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_game') {
        if (!empty($_GET['game_id'])) {
            if (Wo_DeleteGame($_GET['game_id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'verify_user') {
        if (!empty($_GET['id'])) {
            $type = '';
            if (!empty($_GET['type'])) {
                $type = $_GET['type'];
            }
            if (Wo_VerifyUser($_GET['id'], $_GET['verification_id'], $type) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'send_mail_to_all_users') {
        $isset_test = 'off';
        if (empty($_POST['message']) || empty($_POST['subject'])) {
            $send_errors = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (!empty($_POST['test_message'])) {
                if ($_POST['test_message'] == 'on') {
                    $isset_test = 'on';
                }
            }
            if ($isset_test == 'on') {
                $send_message_data = array(
                    'from_email' => $wo['config']['siteEmail'],
                    'from_name' => $wo['config']['siteName'],
                    'to_email' => $wo['user']['email'],
                    'to_name' => $wo['user']['name'],
                    'subject' => $_POST['subject'],
                    'charSet' => 'utf-8',
                    'message_body' => $_POST['message'],
                    'is_html' => true
                );
                $send              = Wo_SendMessage($send_message_data);
            } else {
                $users_type = 'all';
                $users      = array();
                if (isset($_POST['selected_emails']) && strlen($_POST['selected_emails']) > 0) {
                    $user_ids = explode(',', $_POST['selected_emails']);
                    if (is_array($user_ids) && count($user_ids) > 0) {
                        foreach ($user_ids as $user_id) {
                            $users[] = Wo_UserData($user_id);
                        }
                    }
                } else if ($_POST['send_to'] == 'active') {
                    $users = Wo_GetAllUsersByType('active');
                } else if ($_POST['send_to'] == 'inactive') {
                    $users = Wo_GetAllUsersByType('inactive');
                }
                foreach ($users as $user) {
                    $send_message_data = array(
                        'from_email' => $wo['config']['siteEmail'],
                        'from_name' => $wo['config']['siteName'],
                        'to_email' => $user['email'],
                        'to_name' => $user['name'],
                        'subject' => $_POST['subject'],
                        'charSet' => 'utf-8',
                        'message_body' => $_POST['message'],
                        'is_html' => true
                    );
                    $send              = Wo_SendMessage($send_message_data);
                    $mail->ClearAddresses();
                }
            }
        }
        header("Content-type: application/json");
        if (!empty($send_errors)) {
            $send_errors_data = array(
                'status' => 400,
                'message' => $send_errors
            );
            echo json_encode($send_errors_data);
        } else {
            $data = array(
                'status' => 200
            );
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'get_users_emails' && isset($_GET['name'])) {
        $name  = Wo_Secure($_GET['name']);
        $html  = '';
        $users = Wo_GetUsersByName($name, false, 20);
        $data  = array(
            'status' => 404
        );
        if (count($users) > 0) {
            foreach ($users as $user) {
                $html .= "<p data-user='" . $user['user_id'] . "'>" . $user['username'] . "</p>";
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_new_announcement') {
        if (!empty($_POST['announcement_text'])) {
            $html = '';
            $id   = Wo_AddNewAnnouncement(base64_decode($_POST['announcement_text']));
            if ($id > 0) {
                $wo['activeAnnouncement'] = Wo_GetAnnouncement($id);
                $html .= Wo_LoadAdminPage('manage-announcements/active-list');
                $data = array(
                    'status' => 200,
                    'text' => $html
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_announcement') {
        if (!empty($_GET['id'])) {
            $DeleteAnnouncement = Wo_DeleteAnnouncement($_GET['id']);
            if ($DeleteAnnouncement === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'disable_announcement') {
        if (!empty($_GET['id'])) {
            $html                = '';
            $DisableAnnouncement = Wo_DisableAnnouncement($_GET['id']);
            if ($DisableAnnouncement === true) {
                $wo['inactiveAnnouncement'] = Wo_GetAnnouncement($_GET['id']);
                $html .= Wo_LoadAdminPage('manage-announcements/inactive-list');
                $data = array(
                    'status' => 200,
                    'html' => $html
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'activate_announcement') {
        if (!empty($_GET['id'])) {
            $html                 = '';
            $ActivateAnnouncement = Wo_ActivateAnnouncement($_GET['id']);
            if ($ActivateAnnouncement === true) {
                $wo['activeAnnouncement'] = Wo_GetAnnouncement($_GET['id']);
                $html .= Wo_LoadAdminPage('manage-announcements/active-list');
                $data = array(
                    'status' => 200,
                    'html' => $html
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_ads') {
        $updated = false;
        foreach ($_POST as $key => $ads) {
            if ($key != 'hash_id') {
                $ad_data = array(
                    'type' => $key,
                    'code' => base64_decode($ads),
                    'active' => (empty($ads)) ? 0 : 1
                );
                $update = Wo_UpdateAdsCode($ad_data);
                if ($update) {
                    $updated = true;
                }
            }
        }
        if ($updated == true) {
            $data = array(
                'status' => 200
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_ads_status') {
        if (!empty($_GET['type'])) {
            if (Wo_UpdateAdActivation($_GET['type']) == 'active') {
                $data = array(
                    'status' => 200
                );
            } else {
                $data = array(
                    'status' => 300
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'get_following_users') {
    $html = '';
    if (!empty($_GET['user_id'])) {
        foreach (Wo_GetFollowing($_GET['user_id'], 'sidebar', 12) as $wo['UsersList']) {
            $wo['UsersList']['user_name'] = $wo['UsersList']['name'];
            if (!empty($wo['UsersList']['last_name'])) {
                $wo['UsersList']['user_name'] = $wo['UsersList']['first_name'];
            }
            $html .= Wo_LoadPage('sidebar/profile-sidebar-user-list');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_followers_users') {
    $html = '';
    if (!empty($_GET['user_id'])) {
        foreach (Wo_GetFollowers($_GET['user_id'], 'sidebar', 12) as $wo['UsersList']) {
            $wo['UsersList']['user_name'] = $wo['UsersList']['name'];
            if (!empty($wo['UsersList']['last_name'])) {
                $wo['UsersList']['user_name'] = $wo['UsersList']['first_name'];
            }
            $html .= Wo_LoadPage('sidebar/profile-sidebar-user-list');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'posts') {
    if($s == 'rate_post') {
        $val  = Wo_Secure($_POST['val']);
        $id   = Wo_Secure($_POST['post_id']);
        $text = Wo_Secure($_POST['text']);
        if (Wo_RatePost($id, $val, $text)) {
        $data = array(
        'status' => 200,
        'html' => $val
    );
        }
    header("Content-type: application/json");
    echo json_encode($data);
    exit(); 
    }
    if ($s == 'fetch_url') {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $_POST["url"], $match)) {
            $youtube_video = Wo_Secure($match[1]);
            $api_request = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id=' . $youtube_video . '&key=AIzaSyDoOC41IwRzX5XvP7bNiCJXJfcK14HalM0&part=snippet,contentDetails,statistics,status');
            $thumbnail = '';
            if (!empty($api_request)) {
                $json_decode = json_decode($api_request);
                if (!empty($json_decode->items[0]->snippet)) {
                    if (!empty($json_decode->items[0]->snippet->thumbnails->maxres->url)) {
                        $thumbnail = $json_decode->items[0]->snippet->thumbnails->maxres->url;
                    }
                    if (!empty($json_decode->items[0]->snippet->thumbnails->medium->url)) {
                        $thumbnail = $json_decode->items[0]->snippet->thumbnails->medium->url;
                    }
                    $info = $json_decode->items[0]->snippet;
                    $title = $info->title;
                    $description = $info->description;
                    if (!empty($json_decode->items[0]->snippet->tags)) {
                        if (is_array($json_decode->items[0]->snippet->tags)) {
                            foreach ($json_decode->items[0]->snippet->tags as $key => $tag) {
                                $tags_array[] = $tag;
                            }
                            $tags = implode(',', $tags_array);
                        }
                    }
                }
                $output = array(
                    'title' => $title,
                    'images' => array($thumbnail),
                    'content' => $description,
                    'url' => $_POST["url"]
                );
                echo json_encode($output);
                exit();
            }
        } else if (isset($_POST["url"])) {
            $get_url = $_POST["url"];
            include_once("assets/import/simple_html_dom.inc.php");
            $get_content = file_get_html($get_url);
            foreach ($get_content->find('title') as $element) {
                @$page_title = $element->plaintext;
            }
            if (empty($page_title)) {
                $page_title = '';
            }
            @$page_body = $get_content->find("meta[name='description']", 0)->content;
            $page_body = mb_substr($page_body, 0, 250, "utf-8");
            if ($page_body === false) {
                $page_body = '';
            }
            if (empty($page_body)) {
                @$page_body = $get_content->find("meta[property='og:description']", 0)->content;
                $page_body = mb_substr($page_body, 0, 250, "utf-8");
                if ($page_body === false) {
                    $page_body = '';
                }
            }
            $image_urls = array();
            @$page_image = $get_content->find("meta[property='og:image']", 0)->content;
            if (!empty($page_image)) {
                if (preg_match('/[\w\-]+\.(jpg|png|gif|jpeg)/', $page_image)) {
                    $image_urls[] = $page_image;
                }
            } else {
                foreach ($get_content->find('img') as $element) {
                    if (!preg_match('/blank.(.*)/i', $element->src)) {
                        if (preg_match('/[\w\-]+\.(jpg|png|gif|jpeg)/', $element->src)) {
                            $image_urls[] = $element->src;
                        }
                    }
                }
            }
            $output = array(
                'title' => $page_title,
                'images' => $image_urls,
                'content' => $page_body,
                'url' => $_POST["url"]
            );
            echo json_encode($output);
            exit();
        }
    }
    if ($s == 'search_for_posts') {
        $html = '';
        if (!empty($_GET['search_query'])) {
            $search_data = Wo_SearchForPosts($_GET['id'], $_GET['search_query'], 20, $_GET['type']);
            if (count($search_data) == 0) {
                $html = Wo_LoadPage('story/filter-no-stories-found');
            } else {
                foreach ($search_data as $wo['story']) {
                    $html .= Wo_LoadPage('story/content');
                }
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_new_hashtag_posts') {
        $html = '';
        if (!empty($_GET['before_post_id']) && !empty($_GET['hashtagName'])) {
            $posts = Wo_GetHashtagPosts($_GET['hashtagName'], 0, 20, $_GET['before_post_id']);
            foreach ($posts as $wo['story']) {
                if (!empty($_GET['api'])) {
                    echo Wo_LoadPage('story/api-posts');
                } else {
                    echo Wo_LoadPage('story/content');
                }
            }
        }
        exit();
    }
    if ($s == 'insert_new_post') {   
        
        echo "we are here now";

        $media         = '';
        $mediaFilename = '';
        $mediaName     = '';
        $html          = '';
        $recipient_id  = 0;
        $page_id       = 0;
        $group_id      = 0;
        $event_id      = 0;
        $invalid_file  = false;
        $errors        = false;
        $image_array   = array();
        if (Wo_CheckSession($hash_id) === false) {
            return false;
            die();
        }
        if (isset($_POST['recipient_id']) && !empty($_POST['recipient_id'])) {
            $recipient_id = Wo_Secure($_POST['recipient_id']);
        } else if (isset($_POST['event_id']) && !empty($_POST['event_id'])) {
            $event_id = Wo_Secure($_POST['event_id']);
        } else if (isset($_POST['page_id']) && !empty($_POST['page_id'])) {
            $page_id = Wo_Secure($_POST['page_id']);
        } else if (isset($_POST['group_id']) && !empty($_POST['group_id'])) {
            $group_id = Wo_Secure($_POST['group_id']);
            $group    = Wo_GroupData($group_id);
            if (!empty($group['id'])) {
                if ($group['privacy'] == 1) {
                    $_POST['postPrivacy'] = 0;
                } else if ($group['privacy'] == 2) {
                    $_POST['postPrivacy'] = 2;
                }
            }
        }
        if (isset($_FILES['postFile']['name'])) {
            if ($_FILES['postFile']['size'] > $wo['config']['maxUpload']) {
                $invalid_file = 1;
            } else if (Wo_IsFileAllowed($_FILES['postFile']['name']) == false) {
                $invalid_file = 2;
            } else {
                $fileInfo = array(
                    'file' => $_FILES["postFile"]["tmp_name"],
                    'name' => $_FILES['postFile']['name'],
                    'size' => $_FILES["postFile"]["size"],
                    'type' => $_FILES["postFile"]["type"]
                );
                $media    = Wo_ShareFile($fileInfo);
                if (!empty($media)) {
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            }
        }
        if (isset($_FILES['postVideo']['name']) && empty($mediaFilename)) {

            if ($_FILES['postVideo']['size'] > $wo['config']['maxUpload']) {
                $invalid_file = 1;
            } else if (Wo_IsFileAllowed($_FILES['postVideo']['name']) == false) {
                $invalid_file = 2;
            } else {
                $fileInfo = array(
                    'file' => $_FILES["postVideo"]["tmp_name"],
                    'name' => $_FILES['postVideo']['name'],
                    'size' => $_FILES["postVideo"]["size"],
                    'type' => $_FILES["postVideo"]["type"],
                    'types' => 'mp4,m4v,webm,flv,mov,mpeg'
                );
                $media    = Wo_ShareFile($fileInfo);
                if (!empty($media)) {
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            }
        }
        if (isset($_FILES['postMusic']['name']) && empty($mediaFilename)) {
            if ($_FILES['postMusic']['size'] > $wo['config']['maxUpload']) {
                $invalid_file = 1;
            } else if (Wo_IsFileAllowed($_FILES['postMusic']['name']) == false) {
                $invalid_file = 2;
            } else {
                $fileInfo = array(
                    'file' => $_FILES["postMusic"]["tmp_name"],
                    'name' => $_FILES['postMusic']['name'],
                    'size' => $_FILES["postMusic"]["size"],
                    'type' => $_FILES["postMusic"]["type"],
                    'types' => 'mp3,wav'
                );
                $media    = Wo_ShareFile($fileInfo);
                if (!empty($media)) {
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            }
        }
        $multi = 0;
        if (isset($_FILES['postPhotos']['name']) && empty($mediaFilename) && empty($_POST['album_name'])) {
            if (count($_FILES['postPhotos']['name']) == 1) {
                if ($_FILES['postPhotos']['size'][0] > $wo['config']['maxUpload']) {
                    $invalid_file = 1;
                } else if (Wo_IsFileAllowed($_FILES['postPhotos']['name'][0]) == false) {
                    $invalid_file = 2;
                } else {
                    $fileInfo = array(
                        'file' => $_FILES["postPhotos"]["tmp_name"][0],
                        'name' => $_FILES['postPhotos']['name'][0],
                        'size' => $_FILES["postPhotos"]["size"][0],
                        'type' => $_FILES["postPhotos"]["type"][0]
                    );
                    $media    = Wo_ShareFile($fileInfo);
                    if (!empty($media)) {
                        $mediaFilename = $media['filename'];
                        $mediaName     = $media['name'];
                    }
                }
            } else {
                $multi = 1;
            }
        }
        if (empty($_POST['postPrivacy'])) {
            $_POST['postPrivacy'] = 0;
        }
        $post_privacy  = 0;
        $privacy_array = array(
            '0',
            '1',
            '2',
            '3'
        );
        if (isset($_POST['postPrivacy'])) {
            if (in_array($_POST['postPrivacy'], $privacy_array)) {
                $post_privacy = $_POST['postPrivacy'];
            }
        }
        $import_url_image = '';
        $url_link         = '';
        $url_content      = '';
        $url_title        = '';
        if (!empty($_POST['url_link']) && !empty($_POST['url_title'])) {
            $url_link  = $_POST['url_link'];
            $url_title = $_POST['url_title'];
            if (!empty($_POST['url_content'])) {
                $url_content = $_POST['url_content'];
            }
            if (!empty($_POST['url_image'])) {
                $import_url_image = @Wo_ImportImageFromUrl($_POST['url_image']);
            }
        }
        $post_text = '';
        $post_map  = '';
        if (!empty($_POST['postText']) && !ctype_space($_POST['postText'])) {
            $post_text = $_POST['postText'];
        }
        if (!empty($_POST['postMap'])) {
            $post_map = $_POST['postMap'];
        }
        $album_name = '';
        if (!empty($_POST['album_name'])) {
            $album_name = $_POST['album_name'];
        }
        if (!isset($_FILES['postPhotos']['name'])) {
            $album_name = '';
        }
        $traveling = '';
        $watching  = '';
        $playing   = '';
        $listening = '';
        $feeling   = '';
        if (!empty($_POST['feeling_type'])) {
            $array_types = array(
                'feelings',
                'traveling',
                'watching',
                'playing',
                'listening'
            );
            if (in_array($_POST['feeling_type'], $array_types)) {
                if ($_POST['feeling_type'] == 'feelings') {
                    if (!empty($_POST['feeling'])) {
                        if (array_key_exists($_POST['feeling'], $wo['feelingIcons'])) {
                            $feeling = $_POST['feeling'];
                        }
                    }
                } else if ($_POST['feeling_type'] == 'traveling') {
                    if (!empty($_POST['feeling'])) {
                        $traveling = $_POST['feeling'];
                    }
                } else if ($_POST['feeling_type'] == 'watching') {
                    if (!empty($_POST['feeling'])) {
                        $watching = $_POST['feeling'];
                    }
                } else if ($_POST['feeling_type'] == 'playing') {
                    if (!empty($_POST['feeling'])) {
                        $playing = $_POST['feeling'];
                    }
                } else if ($_POST['feeling_type'] == 'listening') {
                    if (!empty($_POST['feeling'])) {
                        $listening = $_POST['feeling'];
                    }
                }
            }
        }
        if (isset($_FILES['postPhotos']['name'])) {
            $allowed = array(
                'gif',
                'png',
                'jpg',
                'jpeg'
            );
            for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                $new_string = pathinfo($_FILES['postPhotos']['name'][$i]);
                if (!in_array(strtolower($new_string['extension']), $allowed)) {
                    $errors[] = $error_icon . $wo['lang']['please_check_details'];
                }
            }
        }
        if (!empty($_POST['answer']) && array_filter($_POST['answer'])) {
            if (!empty($_POST['postText'])) {
                foreach ($_POST['answer'] as $key => $value) {
                    if (empty($value) || ctype_space($value)) {
                        $errors = 'Answer #' . ($key + 1) . ' is empty.';
                    }
                }
            } else {
                $errors = 'Please write the question.';
            }
        }
        if (empty($errors)) {
            $is_option = false;
            if (!empty($_POST['answer']) && array_filter($_POST['answer'])) {
                $is_option = true;
            }
            $post_data = array(
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'page_id' => Wo_Secure($page_id),
                'group_id' => Wo_Secure($group_id),
                'event_id' => Wo_Secure($event_id),
                'postText' => Wo_Secure($post_text),
                'recipient_id' => Wo_Secure($recipient_id),
                'postRecord' => Wo_Secure($_POST['postRecord']),
                'postFile' => Wo_Secure($mediaFilename, 0),
                'postFileName' => Wo_Secure($mediaName),
                'postMap' => Wo_Secure($post_map),
                'postPrivacy' => Wo_Secure($post_privacy),
                'postLinkTitle' => Wo_Secure($url_title),
                'postLinkContent' => Wo_Secure($url_content),
                'postLink' => Wo_Secure($url_link),
                'postLinkImage' => Wo_Secure($import_url_image, 0),
                'album_name' => Wo_Secure($album_name),
                'multi_image' => Wo_Secure($multi),
                'postFeeling' => Wo_Secure($feeling),
                'postListening' => Wo_Secure($listening),
                'postPlaying' => Wo_Secure($playing),
                'postWatching' => Wo_Secure($watching),
                'postTraveling' => Wo_Secure($traveling),
                'time' => time()
            );
            if (isset($_POST['postSticker']) && Wo_IsUrl($_POST['postSticker']) && empty($_FILES) && empty($_POST['postRecord'])) {
                $post_data['postSticker'] = $_POST['postSticker'];
            }
            if (!empty($is_option)) {
                $post_data['poll_id'] = 1;
            }
            $id = Wo_RegisterPost($post_data);
            if ($id) {
                if ($is_option == true) {
                    foreach ($_POST['answer'] as $key => $value) {
                        $add_opition = Wo_AddOption($id, $value);
                    }
                }
                if (isset($_FILES['postPhotos']['name'])) {
                    if (count($_FILES['postPhotos']['name']) > 0) {
                        for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                            $fileInfo = array(
                                'file' => $_FILES["postPhotos"]["tmp_name"][$i],
                                'name' => $_FILES['postPhotos']['name'][$i],
                                'size' => $_FILES["postPhotos"]["size"][$i],
                                'type' => $_FILES["postPhotos"]["type"][$i],
                                'types' => 'jpg,png,jpeg,gif'
                            );
                            $file     = Wo_ShareFile($fileInfo, 1);
                            if (!empty($file)) {
                                $media_album = Wo_RegisterAlbumMedia($id, $file['filename']);
                            }
                        }
                    }
                }
                $wo['story'] = Wo_PostData($id);
                $html .= Wo_LoadPage('story/content');
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'invalid_file' => $invalid_file
                );
            } else {
                $data = array(
                    'status' => 400,
                    'invalid_file' => $invalid_file
                );
            }
        } else {
            header("Content-type: application/json");
            echo json_encode(array(
                'status' => 400,
                'errors' => $errors,
                'invalid_file' => $invalid_file
            ));
            exit();
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_post' && Wo_CheckMainSession($hash_id) === true) {
        if (!empty($_GET['post_id'])) {
            if (Wo_DeletePost($_GET['post_id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_new_posts') {
        if (!empty($_GET['before_post_id']) && isset($_GET['user_id'])) {
            $html      = '';
            $postsData = array(
                'before_post_id' => $_GET['before_post_id'],
                'publisher_id' => $_GET['user_id'],
                'limit' => 20
            );
            $posts     = Wo_GetPosts($postsData);
            foreach ($posts as $wo['story']) {
                if (!empty($_GET['api'])) {
                    echo Wo_LoadPage('story/api-posts');
                } else {
                    echo Wo_LoadPage('story/content');
                }
            }
        }
        exit();
    }
    if ($s == 'load_more_posts') {
        $html = '';
        if ($_GET['filter_by_more'] == 'story' && isset($_GET['story_id']) && isset($_GET['user_id'])) {
            $args           = array();
            $args['offset'] = Wo_Secure($_GET['story_id']);
            if ($_GET['user_id'] > 0) {
                $args['user'] = Wo_Secure($_GET['user_id']);
            }
            foreach (Wo_GetStroies($args) as $wo['story']) {
                echo Wo_LoadPage('status/content');
            }
        } else if (!empty($_GET['filter_by_more']) && !empty($_GET['after_post_id'])) {
            $page_id  = 0;
            $group_id = 0;
            $user_id  = 0;
            $story_id = 0;
            $event_id = 0;
            $ad_id    = 0;
            if (!empty($_GET['page_id']) && $_GET['page_id'] > 0) {
                $page_id = Wo_Secure($_GET['page_id']);
            }
            if (!empty($_GET['group_id']) && $_GET['group_id'] > 0) {
                $group_id = Wo_Secure($_GET['group_id']);
            }
            if (!empty($_GET['user_id']) && $_GET['user_id'] > 0) {
                $user_id = Wo_Secure($_GET['user_id']);
            }
            if (!empty($_GET['event_id']) && $_GET['event_id'] > 0) {
                $event_id = Wo_Secure($_GET['event_id']);
            }
            if (isset($_GET['ad_id']) && is_numeric($_GET['ad_id']) && $_GET['ad_id'] > 0) {
                $ad_id = Wo_Secure($_GET['ad_id']);
            }
            if (isset($_GET['story_id']) && is_numeric($_GET['story_id']) && $_GET['story_id'] > 0) {
                $story_id = Wo_Secure($_GET['story_id']);
            }
            $postsData = array(
                'filter_by' => Wo_Secure($_GET['filter_by_more']),
                'limit' => 6,
                'publisher_id' => $user_id,
                'group_id' => $group_id,
                'page_id' => $page_id,
                'event_id' => $event_id,
                'after_post_id' => Wo_Secure($_GET['after_post_id']),
                'ad-id' => $ad_id,
                'story_id' => $story_id
            );
            $get_posts = Wo_GetPosts($postsData);
            $is_api    = false;
            if (!empty($_GET['is_api'])) {
                $is_api = true;
            }
            if (!empty($_GET['posts_count']) && !empty($get_posts) && $is_api == false) {
                if ($_GET['posts_count'] > 9 && $_GET['posts_count'] < 15) {
                    echo Wo_GetAd('post_first', false);
                } else if ($_GET['posts_count'] > 20 && $_GET['posts_count'] < 28) {
                    echo Wo_GetAd('post_second', false);
                } else if ($_GET['posts_count'] > 29) {
                    echo Wo_GetAd('post_third', false);
                }
            }
            foreach ($get_posts as $wo['story']) {
                if ($is_api == true) {
                    echo Wo_LoadPage('story/api-posts');
                } else {
                    echo Wo_LoadPage('story/content');
                }
            }
        }
        exit();
    }
    if ($s == 'edit_post') {
        if (!empty($_POST['post_id']) && !empty($_POST['text'])) {
            $updatePost = Wo_UpdatePost(array(
                'post_id' => $_POST['post_id'],
                'text' => $_POST['text']
            ));
            if (!empty($updatePost)) {
                $data = array(
                    'status' => 200,
                    'html' => $updatePost
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == "update_post_privacy") {
        if (!empty($_GET['post_id']) && isset($_GET['privacy_type']) && Wo_CheckMainSession($hash_id) === true) {
            $updatePost = Wo_UpdatePostPrivacy(array(
                'post_id' => Wo_Secure($_GET['post_id']),
                'privacy_type' => Wo_Secure($_GET['privacy_type'])
            ));
            if (isset($updatePost)) {
                $data = array(
                    'status' => 200,
                    'privacy_type' => $updatePost
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    
     if ($s == 'count_like') {
          $data = array(
                    'status' => 200,
                    'likes' => Wo_CountLikes($_GET['post_id']),
                    
                );
                header("Content-type: application/json");
        echo json_encode($data);
        exit();
         
     }
      if ($s == 'count_dislike') {
          $data = array(
                    'status' => 200,
                    'wonders' => Wo_CountWonders($_GET['post_id']),
                    
                );
                header("Content-type: application/json");
        echo json_encode($data);
        exit();
         
     }
    if ($s == 'register_like') {
        if (!empty($_GET['post_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddLikes($_GET['post_id']) == 'unliked') {
                $data = array(
                    'status' => 300,
                    'likes' => Wo_CountLikes($_GET['post_id']),
                    'wonders' => Wo_CountWonders($_GET['post_id']),
                    'like_lang' => $wo['lang']['like']
                );
            } else {
                $rewarded = rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'likes' => Wo_CountLikes($_GET['post_id']),
                    'wonders' => Wo_CountWonders($_GET['post_id']),
                    'like_lang' => $wo['lang']['liked'],
                    'rewards' => $rewarded//($rewarded ? $wo['config']['rewardPostPoints'] : 0)
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike']              = 1;
                $data['default_lang_like']    = $wo['lang']['like'];
                $data['default_lang_dislike'] = $wo['lang']['dislike'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_wonder') {
        if (!empty($_GET['post_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddWonders($_GET['post_id']) == 'unwonder') {
                $data                = array(
                    'status' => 300,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountWonders($_GET['post_id']),
                    'likes' => Wo_CountLikes($_GET['post_id'])
                );
                $data['wonder_lang'] = ($config['second_post_button'] == 'dislike') ? $wo['lang']['dislike'] : $wo['lang']['wonder'];
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data                = array(
                    'status' => 200,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountWonders($_GET['post_id']),
                    'likes' => Wo_CountLikes($_GET['post_id'])
                );
                $data['wonder_lang'] = ($config['second_post_button'] == 'dislike') ? $wo['lang']['disliked'] : $wo['lang']['wondered'];
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike']              = 1;
                $data['default_lang_like']    = $wo['lang']['like'];
                $data['default_lang_dislike'] = $wo['lang']['dislike'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_share') {
        if (!empty($_GET['post_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddShare($_GET['post_id']) == 'unshare') {
                $data = array(
                    'status' => 300,
                    'shares' => Wo_CountShares($_GET['post_id'])
                );
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'shares' => Wo_CountShares($_GET['post_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_comment') {
        
        
        if (!empty($_POST['post_id']) && isset($_POST['text'])) {
            $html    = '';
            $page_id = '';
            if (!empty($_POST['page_id'])) {
                $page_id = $_POST['page_id'];
            }
        
            if (!empty($_POST['comment_image'])) {
            $comment_image =$_POST['c_image'];
                /*if (isset($_SESSION['file']) && $_SESSION['file'] == $_POST['comment_image']) {
                    $comment_image = $_POST['comment_image'];
                    unset($_SESSION['file']);
                }*/
            }

            if (empty($comment_image) && empty($_POST['text']) && empty($_POST['audio-filename'])) {
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
            $text_comment = '';
            if (!empty($_POST['text']) && !ctype_space($_POST['text'])) {
                $text_comment = $_POST['text'];
            }
            $prvcDrpDwnVal=$_POST['prvcDrpDwnVal'];
            $comment_image =$_POST['c_image'];
            $C_Data = array(
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'page_id' => Wo_Secure($_POST['page_id']),
                'post_id' => Wo_Secure($_POST['post_id']),
                'text' => $_POST['text'], 
                'c_file' => $comment_image,
                'time' => time(),
                'prvcDrpDwnVal'=>$prvcDrpDwnVal,
                'privacy' => Wo_Secure($_POST['comment_privacy'])
            );
            if (!empty($_POST['audio-filename']) && isset($_FILES["audio-blob"]["tmp_name"])) {
                $fileInfo         = array(
                    'file' => $_FILES["audio-blob"]["tmp_name"],
                    'name' => $_FILES['audio-blob']['name'],
                    'size' => $_FILES["audio-blob"]["size"],
                    'type' => $_FILES["audio-blob"]["type"],
                    'types' => 'mp3,wav'
                );
                $media            = Wo_ShareFile($fileInfo);
                $C_Data['record'] = $media['filename'];
            }
             $R_Comment     = Wo_RegisterPostComment($C_Data);
            $wo['comment'] = Wo_GetPostComment($R_Comment);
            $wo['story']   = Wo_PostData($_POST['post_id']);
         
               
                if (!empty($wo['comment'])) {
                    rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $html = Wo_LoadPage('comment/content');
                $data = array(
                    'status' => 200,
                    'html' => $R_Comment,
                    //'comments_num' => Wo_CountPostComment($_POST['post_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
               
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_post_record') {
        $data = array(
            'status' => 500,
            "url" => null
        );
        if (!empty($_POST['audio-filename']) && isset($_FILES["audio-blob"]["tmp_name"])) {
            $fileInfo       = array(
                'file' => $_FILES["audio-blob"]["tmp_name"],
                'name' => $_FILES['audio-blob']['name'],
                'size' => $_FILES["audio-blob"]["size"],
                'type' => $_FILES["audio-blob"]["type"],
                'types' => 'mp3,wav'
            );
            $media          = Wo_ShareFile($fileInfo);
            $data['url']    = $media['filename'];
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_reply') {
        if (!empty($_POST['comment_id']) && !empty($_POST['text']) && Wo_CheckMainSession($hash_id) === true) {
            $html    = '';
            $page_id = '';
            if (!empty($_POST['page_id'])) {
                $page_id = $_POST['page_id'];
            }
            $C_Data      = array(
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'page_id' => Wo_Secure($page_id),
                'comment_id' => Wo_Secure($_POST['comment_id']),
                'text' => Wo_Secure($_POST['text']),
                'time' => time()
            );
            $R_Comment   = Wo_RegisterCommentReply($C_Data);
            $wo['reply'] = Wo_GetCommentReply($R_Comment);
            if (!empty($wo['reply'])) {
                $html = Wo_LoadPage('comment/replies-content');
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'replies_num' => Wo_CountCommentReplies($_POST['comment_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update-reply') {
        if (!empty($_POST['id']) && !empty($_POST['text']) && Wo_CheckMainSession($hash_id) === true) {
            $id           = Wo_Secure($_POST['id']);
            $data         = array(
                'status' => 304
            );
            $update_datau = array(
                'text' => Wo_Secure($_POST['text'])
            );
            if (Wo_UpdateCommentReply($id, $update_datau)) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_comment') {
        if (!empty($_GET['comment_id']) && Wo_CheckMainSession($hash_id) === true) {
            $DeleteComment = Wo_DeletePostComment($_GET['comment_id']);
            if ($DeleteComment === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_comment_reply') {
        if (!empty($_GET['reply_id']) && Wo_CheckMainSession($hash_id) === true) {
            $DeleteComment = Wo_DeletePostReplyComment($_GET['reply_id']);
            if ($DeleteComment === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_more_comments') {
        if (!empty($_GET['post_id'])) {
            $html        = '';
            $wo['story'] = Wo_PostData($_GET['post_id']);
            foreach (Wo_GetPostComments($_GET['post_id'], Wo_CountPostComment($_GET['post_id'])) as $wo['comment']) {
                $html .= Wo_LoadPage('comment/content');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_more_replies') {
        if (!empty($_GET['comment_id'])) {
            $html = '';
            foreach (Wo_GetCommentReplies($_GET['comment_id'], Wo_CountCommentReplies($_GET['comment_id'])) as $wo['reply']) {
                $html .= Wo_LoadPage('comment/replies-content');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'edit_comment') {
        if (!empty($_POST['comment_id']) && !empty($_POST['text']) && Wo_CheckMainSession($hash_id) === true) {
            $updateComment = Wo_UpdateComment(array(
                'comment_id' => $_POST['comment_id'],
                'text' => $_POST['text']
            ));
            if (!empty($updateComment)) {
                $data = array(
                    'status' => 200,
                    'html' => $updateComment
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_comment_like') {
        if (!empty($_POST['comment_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddCommentLikes($_POST['comment_id'], $_POST['comment_text']) == 'unliked') {
                $data = array(
                    'status' => 300,
                    'likes' => Wo_CountCommentLikes($_POST['comment_id'])
                );
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'likes' => Wo_CountCommentLikes($_POST['comment_id'])
                );
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike']   = 1;
                $data['wonders_c'] = Wo_CountCommentWonders($_POST['comment_id']);
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_comment_wonder') {
        if (!empty($_POST['comment_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddCommentWonders($_POST['comment_id'], $_POST['comment_text']) == 'unwonder') {
                $data = array(
                    'status' => 300,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountCommentWonders($_POST['comment_id'])
                );
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountCommentWonders($_POST['comment_id'])
                );
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike'] = 1;
                $data['likes_c'] = Wo_CountCommentLikes($_POST['comment_id']);
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_comment_reply_like') {
        if (!empty($_POST['reply_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddCommentReplyLikes($_POST['reply_id'], $_POST['comment_text']) == 'unliked') {
                $data = array(
                    'status' => 300,
                    'likes' => Wo_CountCommentReplyLikes($_POST['reply_id'])
                );
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'likes' => Wo_CountCommentReplyLikes($_POST['reply_id'])
                );
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike']   = 1;
                $data['wonders_r'] = Wo_CountCommentReplyWonders($_POST['reply_id']);
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_comment_reply_wonder') {
        if (!empty($_POST['reply_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_AddCommentReplyWonders($_POST['reply_id'], $_POST['comment_text']) == 'unwonder') {
                $data = array(
                    'status' => 300,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountCommentReplyWonders($_POST['reply_id'])
                );
            } else {
                rewards_add($wo['user']['user_id'], $wo['config']['rewardPostPoints'], 'post_action');
                $data = array(
                    'status' => 200,
                    'icon' => $wo['second_post_button_icon'],
                    'wonders' => Wo_CountCommentReplyWonders($_POST['reply_id'])
                );
            }
            $data['dislike'] = 0;
            if ($wo['config']['second_post_button'] == 'dislike') {
                $data['dislike'] = 1;
                $data['likes_r'] = Wo_CountCommentReplyLikes($_POST['reply_id']);
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'save_post') {
        if (!empty($_GET['post_id']) && Wo_CheckMainSession($hash_id) === true) {
            $post_data = array(
                'post_id' => $_GET['post_id']
            );
            if (Wo_SavePosts($post_data) == 'unsaved') {
                $data = array(
                    'status' => 300,
                    'text' => $wo['lang']['save_post']
                );
            } else {
                $data = array(
                    'status' => 200,
                    'text' => $wo['lang']['unsave_post']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'pin_post') {
        if (!empty($_GET['post_id']) && Wo_CheckMainSession($hash_id) === true) {
            $type = 'profile';
            $id   = 0;
            if (!empty($_GET['type'])) {
                $types_array = array(
                    'profile',
                    'page',
                    'group',
                    'event'
                );
                if (in_array($_GET['type'], $types_array)) {
                    $type = $_GET['type'];
                }
            }
            if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];
            }
            if (Wo_PinPost($_GET['post_id'], $type, $id) == 'unpin') {
                $data = array(
                    'status' => 300,
                    'text' => $wo['lang']['pin_post']
                );
            } else {
                $data = array(
                    'status' => 200,
                    'text' => $wo['lang']['unpin_post']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'boost_post') {
        if (!empty($_GET['post_id']) && $wo['config']['pro'] == 1 && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_BoostPost($_GET['post_id']) == 'unboosted') {
                $data = array(
                    'status' => 300,
                    'text' => $wo['lang']['boost_post']
                );
            } else {
                $data = array(
                    'status' => 200,
                    'text' => $wo['lang']['unboost_post']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'mark_as_sold_post') {
        if (!empty($_GET['post_id']) && !empty($_GET['product_id']) && Wo_CheckMainSession($hash_id) === true) {
            if (Wo_MarkPostAsSold($_GET['post_id'], $_GET['product_id'])) {
                $data = array(
                    'status' => 200,
                    'text' => $wo['lang']['sold']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'report_post') {
        if (!empty($_GET['post_id'])) {
            $post_data = array(
                'post_id' => $_GET['post_id']
            );
            if (Wo_ReportPost($post_data) == 'unreport') {
                $data = array(
                    'status' => 300,
                    'text' => $wo['lang']['report_post']
                );
            } else {
                $data = array(
                    'status' => 200,
                    'text' => $wo['lang']['unreport_post']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_post_likes') {
        if (!empty($_GET['post_id'])) {
            $data       = array(
                'status' => 200,
                'html' => ''
            );
            $likedUsers = Wo_GetPostLikes($_GET['post_id']);
            if (count($likedUsers) > 0) {
                foreach ($likedUsers as $wo['WondredLikedusers']) {
                    $data['html'] .= Wo_LoadPage('story/post-likes-wonders');
                }
            } else {
                $data['message'] = $wo['lang']['no_likes'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_post_wonders') {
        if (!empty($_GET['post_id'])) {
            $data          = array(
                'status' => 200,
                'html' => ''
            );
            $WonderedUsers = Wo_GetPostWonders($_GET['post_id']);
            if (count($WonderedUsers) > 0) {
                foreach ($WonderedUsers as $wo['WondredLikedusers']) {
                    $data['html'] .= Wo_LoadPage('story/post-likes-wonders');
                }
            } else {
                $data['message'] = ($config['second_post_button'] == 'dislike') ? $wo['lang']['no_dislikes'] : $wo['lang']['no_wonders'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'filter_posts') {
        if (!empty($_GET['filter_by']) && isset($_GET['id'])) {
            $html    = '';
            $options = array(
                'filter_by' => Wo_Secure($_GET['filter_by'])
            );
            if (!empty($_GET['type'])) {
                if ($_GET['type'] == 'page') {
                    $options['page_id'] = $_GET['id'];
                } else if ($_GET['type'] == 'profile') {
                    $options['publisher_id'] = $_GET['id'];
                } else if ($_GET['type'] == 'group') {
                    $options['group_id'] = $_GET['id'];
                } else if ($_GET['type'] == 'event') {
                    $options['event_id'] = $_GET['id'];
                }
            }
            $stories = Wo_GetPosts($options);
            if (count($stories) > 0) {
                foreach ($stories as $wo['story']) {
                    $html .= Wo_LoadPage('story/content');
                }
            } else {
                $html .= Wo_LoadPage('story/filter-no-stories-found');
            }
            $loadMoreText = '<i class="fa fa-chevron-circle-down progress-icon" data-icon="chevron-circle-down"></i> ' . $wo['lang']['load_more_posts'];
            if (empty($stories)) {
                $loadMoreText = $wo['lang']['no_more_posts'];
            }
            $data = array(
                'status' => 200,
                'html' => $html,
                'text' => $loadMoreText
            );
        }
        echo $html;
        exit();
    }
    if ($s == 'add-video-view' && isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
        $post_id    = $_GET['post_id'];
        $data       = array(
            'status' => 300
        );
        $post_views = Wo_AddPostVideoView($post_id);
        if ($post_views && is_numeric($post_views)) {
            $data['status'] = 200;
            $data['views']  = $post_views;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'hide_post' && isset($_GET['post']) && is_numeric($_GET['post'])) {
        $data    = array(
            'status' => 304
        );
        $post_id = Wo_Secure($_GET['post']);
        if (Wo_HidePost($post_id)) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'share-post' && isset($_GET['id']) && is_numeric($_GET['id']) && isset($_GET['usr']) && is_numeric($_GET['usr'])) {
        $data    = array(
            'status' => 304
        );
        $post_id = Wo_Secure($_GET['id']);
        $owner   = Wo_Secure($_GET['usr']);
        if (Wo_SharePost($post_id, $owner)) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'activities') {
    if ($s == 'get_new_activities') {
        if (!empty($_POST['before_activity_id'])) {
            $html     = '';
            $activity = Wo_GetActivities(array(
                'before_activity_id' => Wo_Secure($_POST['before_activity_id'])
            ));
            foreach ($activity as $wo['activity']) {
                $wo['activity']['unread'] = 'unread';
                $html .= Wo_LoadPage('sidebar/activities-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_more_activities') {
        if (!empty($_POST['after_activity_id'])) {
            $html = '';
            foreach (Wo_GetActivities(array(
                'after_activity_id' => Wo_Secure($_POST['after_activity_id'])
            )) as $wo['activity']) {
                $html .= Wo_LoadPage('sidebar/activities-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
            if (empty($html)) {
                $data['message'] = $wo['lang']['no_more_actitivties'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'chat') {
    if ($s == 'count_online_users') {
        $html = Wo_CountOnlineUsers();
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'chat_side') {
        if (Wo_CheckMainSession($hash_id) === true) {
            $online_users  = '';
            $offline_users = '';
            $OnlineUsers   = Wo_GetChatUsers('online');
            $OfflineUsers  = Wo_GetChatUsers('offline');
            $count_chat    = Wo_CountOnlineUsers();
            foreach ($OnlineUsers as $wo['chatList']) {
                $online_users .= Wo_LoadPage('chat/online-user');
            }
            foreach ($OfflineUsers as $wo['chatList']) {
                $offline_users .= Wo_LoadPage('chat/offline-user');
            }
            $data = array(
                'status' => 200,
                'online_users' => $online_users,
                'offline_users' => $offline_users,
                'count_chat' => $count_chat
            );
            if (!empty($_GET['user_id'])) {
                $user_id = Wo_Secure($_GET['user_id']);
                if (!empty($user_id)) {
                    $user_id = $_GET['user_id'];
                    $status  = Wo_IsOnline($user_id);
                    if ($status === true) {
                        $data['chat_user_tab'] = 200;
                    } else {
                        $data['chat_user_tab'] = 300;
                    }
                }
            }
            $data['messages'] = 0;
            if (!empty($_GET['user_id']) && isset($_GET['message_id'])) {
                $html    = '';
                $user_id = Wo_Secure($_GET['user_id']);
                if (!empty($user_id)) {
                    $user_id  = $_GET['user_id'];
                    $messages = Wo_GetMessages(array(
                        'after_message_id' => $_GET['message_id'],
                        'user_id' => $user_id
                    ));
                    if (count($messages) > 0) {
                        $messages_html = '';
                        foreach ($messages as $wo['chatMessage']) {
                            $messages_html .= Wo_LoadPage('chat/chat-list');
                        }
                        $data['chat_user_tab'] = 200;
                        $data['messages']      = 200;
                        $data['messages_html'] = $messages_html;
                        $data['receiver']      = $wo['user']['user_id'];
                        $data['sender']        = $user_id;
                    }
                }
            }
            $wo['chat']['color'] = Wo_GetChatColor($wo['user']['user_id'], $_GET['user_id']);
            $data['chat_color']  = $wo['chat']['color'];
            $data['can_seen']    = 0;
            if (!empty($_GET['last_id']) && $wo['config']['message_seen'] == 1) {
                $message_id = Wo_Secure($_GET['last_id']);
                if (!empty($message_id) || is_numeric($message_id) || $message_id > 0) {
                    $seen = Wo_SeenMessage($message_id);
                    if ($seen > 0) {
                        $data['can_seen'] = 1;
                        $data['time']     = $seen['time'];
                        $data['seen']     = $seen['seen'];
                    }
                }
            }
            $data['is_typing'] = 0;
            if (!empty($_GET['user_id']) && $wo['config']['message_typing'] == 1) {
                $isTyping = Wo_IsTyping($_GET['user_id']);
                if ($isTyping === true) {
                    $img               = Wo_UserData($_GET['user_id']);
                    $data['is_typing'] = 200;
                    $data['img']       = $img['avatar'];
                    $data['typing']    = $wo['config']['theme_url'] . '/img/loading_dots.gif';
                }
            }
            if (isset($_GET['last_group']) && is_numeric($_GET['last_group'])) {
                $new_groups = Wo_GetChatGroups($_GET['last_group']);
                $groups     = '';
                if (is_array($new_groups) && count($new_groups) > 0) {
                    foreach ($new_groups as $wo['group']) {
                        $groups .= Wo_LoadPage('chat/group-list');
                    }
                }
                $data['chat_groups']         = $groups;
                $data['update_group_status'] = Wo_CheckLastGroupAction();
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'is_recipient_typing') {
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'recipient_is_typing') {
        if (!empty($_GET['recipient_id'])) {
            $isTyping = Wo_RegisterTyping($_GET['recipient_id'], 1);
            if ($isTyping === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'remove_typing') {
        if (!empty($_GET['recipient_id'])) {
            $isTyping = Wo_RegisterTyping($_GET['recipient_id'], 0);
            if ($isTyping === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_online_recipients') {
        $html        = '';
        $OnlineUsers = Wo_GetChatUsers('online');
        foreach ($OnlineUsers as $wo['chatList']) {
            $html .= Wo_LoadPage('chat/online-user');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_offline_recipients') {
        $html         = '';
        $OfflineUsers = Wo_GetChatUsers('offline');
        foreach ($OfflineUsers as $wo['chatList']) {
            $html .= Wo_LoadPage('chat/offline-user');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'set-chat-color') {
        $recipient_user = false;
        $color          = false;
        $user_id        = false;
        $data           = array(
            'status' => 500
        );
        if (isset($_GET['recipient_user']) && is_numeric($_GET['recipient_user']) && $_GET['recipient_user'] > 0) {
            $recipient_user = Wo_Secure($_GET['recipient_user']);
        }
        if (isset($_GET['color']) && in_array($_GET['color'], $colors)) {
            $color = $_GET['color'];
        }
        if (isset($wo['user']['id'])) {
            $user_id = $wo['user']['id'];
        }
        if ($user_id && $color && $recipient_user) {
            if (Wo_UpdateChatColor($user_id, $recipient_user, $color)) {
                $data = array(
                    'status' => 200,
                    'message' => "color added",
                    'color' => $color
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'search_for_recipients') {
        if (!empty($_POST['search_query'])) {
            $html   = '';
            $search = Wo_ChatSearchUsers($_POST['search_query']);
            foreach ($search as $wo['chatList']) {
                $html .= Wo_LoadPage('chat/search-result');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_chat_status') {
        if (!empty($_POST['status'])) {
            $html   = '';
            $status = Wo_UpdateStatus($_POST['status']);
            if ($status == 0) {
                $data = array(
                    'status' => $status
                );
            } else if ($status == 1) {
                $data = array(
                    'status' => $status
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_chat_tab') {
        if (!empty($_GET['recipient_id']) && is_numeric($_GET['recipient_id']) && $_GET['recipient_id'] > 0 && !empty($_GET['placement'])) {
            if (Wo_IsBlocked($_GET['recipient_id'])) {
                $data = array(
                    'status' => 400
                );
            } else {
                if ($_GET['recipient_id'] != 0) {
                    $recipient_id = Wo_Secure($_GET['recipient_id']);
                    $recipient    = Wo_UserData($recipient_id);
                    if (isset($recipient['user_id'])) {
                        $wo['chat']['recipient'] = $recipient;
                        $wo['chat']['color']     = Wo_GetChatColor($wo['user']['user_id'], $recipient['user_id']);
                        $data                    = array(
                            'status' => 200,
                            'html' => Wo_LoadPage('chat/chat-tab')
                        );
                        if (isset($_SESSION['chat_id'])) {
                            if (strpos($_SESSION['chat_id'], ',') !== false) {
                                $explode = @explode(',', $_SESSION['chat_id']);
                                if (count($explode) > 2) {
                                    if (strpos($_SESSION['chat_id'], $recipient['user_id']) === false) {
                                        $_SESSION['chat_id'] = substr($_SESSION['chat_id'], 0, strrpos($_SESSION['chat_id'], ','));
                                        $_SESSION['chat_id'] .= ',' . Wo_Secure($recipient['user_id']);
                                    }
                                } else {
                                    $_SESSION['chat_id'] .= ',' . Wo_Secure($recipient['user_id']);
                                }
                            } else if (strpos($_SESSION['chat_id'], $recipient['user_id']) === false) {
                                $_SESSION['chat_id'] .= ',' . Wo_Secure($recipient['user_id']);
                            } else {
                                $_SESSION['chat_id'] = Wo_Secure($recipient['user_id']);
                            }
                        } else {
                            $_SESSION['chat_id'] = Wo_Secure($recipient['user_id']);
                        }
                    }
                }
            }
        } else if (isset($_GET['group_id']) && is_numeric($_GET['group_id']) && $_GET['group_id'] > 0) {
            $group_id  = Wo_Secure($_GET['group_id']);
            $group_tab = Wo_GroupTabData($group_id);
            if ($group_tab && is_array($group_tab)) {
                $wo['chat']['group']  = $group_tab;
                $data                 = array(
                    'status' => 200,
                    'html' => Wo_LoadPage('chat/group-tab')
                );
                $_SESSION['group_id'] = $group_id;
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_chat_messages') {
        if (!empty($_GET['recipient_id']) && is_numeric($_GET['recipient_id']) && $_GET['recipient_id'] > 0 && Wo_CheckMainSession($hash_id) === true) {
            $recipient_id        = Wo_Secure($_GET['recipient_id']);
            $html                = '';
            $messages            = Wo_GetMessages(array(
                'user_id' => $recipient_id
            ));
            $wo['chat']['color'] = Wo_GetChatColor($wo['user']['user_id'], $recipient_id);
            foreach ($messages as $wo['chatMessage']) {
                $html .= Wo_LoadPage('chat/chat-list');
            }
            $data = array(
                'status' => 200,
                'messages' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'open_tab') {
        if (isset($_SESSION['open_chat'])) {
            if ($_SESSION['open_chat'] == 1) {
                $_SESSION['open_chat'] = 0;
            } else if ($_SESSION['open_chat'] == 0) {
                $_SESSION['open_chat'] = 1;
            }
        } else {
            $_SESSION['open_chat'] = 1;
        }
    }
    if ($s == 'send_message') {
        if (!empty($_POST['user_id']) && Wo_CheckMainSession($hash_id) === true) {
            $html          = '';
            $media         = '';
            $mediaFilename = '';
            $mediaName     = '';
            $invalid_file  = 0;
            if (isset($_FILES['sendMessageFile']['name'])) {
                if ($_FILES['sendMessageFile']['size'] > $wo['config']['maxUpload']) {
                    $invalid_file = 1;
                } else if (Wo_IsFileAllowed($_FILES['sendMessageFile']['name']) == false) {
                    $invalid_file = 2;
                } else {
                    $fileInfo      = array(
                        'file' => $_FILES["sendMessageFile"]["tmp_name"],
                        'name' => $_FILES['sendMessageFile']['name'],
                        'size' => $_FILES["sendMessageFile"]["size"],
                        'type' => $_FILES["sendMessageFile"]["type"]
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            } else if (!empty($_POST['message-record']) && !empty($_POST['media-name'])) {
                $mediaFilename = Wo_Secure($_POST['message-record']);
                $mediaName     = Wo_Secure($_POST['media-name']);
            }
            $message_text = '';
            if (!empty($_POST['textSendMessage'])) {
                $message_text = $_POST['textSendMessage'];
            }
            $messages = Wo_RegisterMessage(array(
                'from_id' => Wo_Secure($wo['user']['user_id']),
                'to_id' => Wo_Secure($_POST['user_id']),
                'text' => Wo_Secure($message_text),
                'media' => Wo_Secure($mediaFilename),
                'mediaFileName' => Wo_Secure($mediaName),
                'time' => time(),
                'stickers' => (isset($_POST['chatSticker']) && Wo_IsUrl($_POST['chatSticker']) && !$mediaFilename && !$mediaName) ? $_POST['chatSticker'] : ''
            ));
            if ($messages > 0) {
                $messages            = Wo_GetMessages(array(
                    'message_id' => $messages,
                    'user_id' => $_POST['user_id']
                ));
                $wo['chat']['color'] = Wo_GetChatColor($wo['user']['user_id'], $_POST['user_id']);
                foreach ($messages as $wo['chatMessage']) {
                    $html .= Wo_LoadPage('chat/chat-list');
                }
                $file = false;
                if (isset($_FILES['sendMessageFile']['name']) && $_FILES['sendMessageFile']['size'] <= $wo['config']['maxUpload']) {
                    $file = true;
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'file' => $file,
                    'invalid_file' => $invalid_file
                );
            }
            if ($invalid_file > 0 && empty($messages)) {
                $data['status']       = 500;
                $data['invalid_file'] = $invalid_file;
            }
        } else if (isset($_GET['group_id']) && is_numeric($_GET['group_id']) && Wo_CheckMainSession($hash_id) === true) {
            $html          = '';
            $media         = '';
            $mediaFilename = '';
            $mediaName     = '';
            $invalid_file  = 0;
            if (isset($_FILES['sendMessageFile']['name'])) {
                if ($_FILES['sendMessageFile']['size'] > $wo['config']['maxUpload']) {
                    $invalid_file = 1;
                } else if (Wo_IsFileAllowed($_FILES['sendMessageFile']['name']) == false) {
                    $invalid_file = 2;
                } else {
                    $fileInfo      = array(
                        'file' => $_FILES["sendMessageFile"]["tmp_name"],
                        'name' => $_FILES['sendMessageFile']['name'],
                        'size' => $_FILES["sendMessageFile"]["size"],
                        'type' => $_FILES["sendMessageFile"]["type"]
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $mediaName     = $media['name'];
                }
            }
            $message_text = '';
            if (!empty($_POST['textSendMessage'])) {
                $message_text = $_POST['textSendMessage'];
            }
            $last_id = Wo_RegisterGroupMessage(array(
                'from_id' => Wo_Secure($wo['user']['user_id']),
                'group_id' => Wo_Secure($_GET['group_id']),
                'text' => Wo_Secure($_POST['textSendMessage']),
                'media' => Wo_Secure($mediaFilename),
                'mediaFileName' => Wo_Secure($mediaName),
                'time' => time()
            ));
            if ($last_id && $last_id > 0) {
                $messages = Wo_GetGroupMessages(array(
                    'id' => $last_id,
                    'group_id' => $_GET['group_id']
                ));
                foreach ($messages as $wo['chatMessage']) {
                    $html .= Wo_LoadPage('chat/group-chat-list');
                }
                $file = false;
                if (isset($_FILES['sendMessageFile']['name'])) {
                    $file = true;
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'file' => $file,
                    'invalid_file' => $invalid_file
                );
            }
            if ($invalid_file > 0 && empty($last_id)) {
                $data['status']       = 500;
                $data['invalid_file'] = $invalid_file;
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'register_message_record') {
        if (isset($_POST['audio-filename']) && isset($_FILES['audio-blob']['name'])) {
            $fileInfo       = array(
                'file' => $_FILES["audio-blob"]["tmp_name"],
                'name' => $_FILES['audio-blob']['name'],
                'size' => $_FILES["audio-blob"]["size"],
                'type' => $_FILES["audio-blob"]["type"]
            );
            $media          = Wo_ShareFile($fileInfo);
            $data['url']    = $media['filename'];
            $data['status'] = 200;
            $data['name']   = $media['name'];
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'change_chat_color') {
        $recipient_id = (isset($_GET['recipient_id'])) ? Wo_Secure($_GET['recipient_id']) : false;
        $user_id      = (isset($wo['user']['id'])) ? $wo['user']['id'] : false;
        $color        = (isset($_GET['color'])) ? Wo_Secure($_GET['color']) : false;
        if ($recipient_id && $user_id && $color) {
            if (Wo_UpdateChatColor($recipient_id, $user_id, $color)) {
                $data = array(
                    'status' => 200
                );
            }
        } else {
            $data = array(
                'status' => 500
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_new_messages') {
        if (!empty($_GET['user_id']) && Wo_CheckMainSession($hash_id) === true) {
            $html    = '';
            $user_id = Wo_Secure($_GET['user_id']);
            if (!empty($user_id)) {
                $user_id  = $_GET['user_id'];
                $messages = Wo_GetMessages(array(
                    'after_message_id' => $_GET['message_id'],
                    'new' => true,
                    'user_id' => $user_id
                ));
                if (count($messages) > 0) {
                    foreach ($messages as $wo['chatMessage']) {
                        $html .= Wo_LoadPage('chat/chat-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html,
                        'receiver' => $user_id,
                        'sender' => $wo['user']['user_id']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_tab_status') {
        $html = '';
        if (!empty($_GET['user_id'])) {
            $user_id = Wo_Secure($_GET['user_id']);
            if (!empty($user_id)) {
                $user_id = $_GET['user_id'];
                $status  = Wo_IsOnline($user_id);
                if ($status === true) {
                    $data['status'] = 200;
                } else {
                    $data['status'] = 300;
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'close_chat') {
        if (isset($_SESSION['chat_id'])) {
            if (strpos($_SESSION['chat_id'], ',') !== false) {
                $_SESSION['chat_id'] = str_replace($_GET['id'] . ',', '', $_SESSION['chat_id']);
                $_SESSION['chat_id'] = str_replace(',' . $_GET['id'], '', $_SESSION['chat_id']);
            } else {
                unset($_SESSION['chat_id']);
            }
        }
        if (!empty($_GET['recipient_id'])) {
            $data = array(
                'url' => Wo_SeoLink('index.php?link1=messages&user=' . $_GET['recipient_id'])
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'close_group') {
        $data = array(
            'status' => 304
        );
        if (isset($_SESSION['group_id'])) {
            unset($_SESSION['group_id']);
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'is_chat_on') {
        if (!empty($_GET['recipient_id'])) {
            $data = array(
                'url' => Wo_SeoLink('index.php?link1=messages&user=' . $_GET['recipient_id']),
                'chat' => $wo['config']['chatSystem']
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_parts' && isset($_GET['name'])) {
        $name  = Wo_Secure($_GET['name']);
        $data  = array(
            'status' => 404
        );
        $parts = Wo_GetUsersByName($name,true);
        $html  = "";
        if (count($parts) > 0) {
            foreach ($parts as $wo['part']) {
                $html .= Wo_LoadPage('chat/chat-part-list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'search_parts' && isset($_GET['name']) && isset($_GET['group_id']) && Wo_IsGChatOwner($_GET['group_id'])) {
        $name  = Wo_Secure($_GET['name']);
        $group = Wo_Secure($_GET['group_id']);
        $data  = array(
            'status' => 404
        );
        $parts = Wo_GetUsersByName($name,true);
        $html  = "";
        if (count($parts) > 0) {
            foreach ($parts as $wo['part']) {
                $wo['part']['group_id'] = $group;
                $html .= Wo_LoadPage('chat/add-group-parts');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_gchat_user' && isset($_GET['user_id']) && isset($_GET['group_id']) && Wo_IsGChatOwner($_GET['group_id'])) {
        $data = array(
            'status' => 304
        );
        $code = Wo_AddGChatPart($_GET['group_id'], $_GET['user_id']);
        if ($code === 0) {
            $data['status'] = 200;
            $data['code']   = 0;
        } else if ($code === 1) {
            $data['status'] = 200;
            $data['code']   = 1;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_new_group_messages') {
        if (!empty($_GET['group_id']) && Wo_CheckMainSession($hash_id) === true) {
            $html     = '';
            $group_id = Wo_Secure($_GET['group_id']);
            if (!empty($group_id)) {
                $messages = Wo_GetGroupMessages(array(
                    'offset' => $_GET['message_id'],
                    'group_id' => $_GET['group_id'],
                    'new' => true
                ));
                if (count($messages) > 0) {
                    foreach ($messages as $wo['chatMessage']) {
                        $html .= Wo_LoadPage('chat/group-chat-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'clear_group_chat' && isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
        $id     = Wo_Secure($_GET['group_id']);
        $data   = array(
            'status' => 304
        );
        $result = Wo_ClearGChat($id);
        if ($result === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_group_chat' && isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
        $id     = Wo_Secure($_GET['group_id']);
        $data   = array(
            'status' => 304
        );
        $result = Wo_DeleteGChat($id);
        if ($result === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'exit_group_chat' && isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
        $id     = Wo_Secure($_GET['group_id']);
        $data   = array(
            'status' => 304
        );
        $result = Wo_ExitGChat($id);
        if ($result === true) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'group_parts' && isset($_GET['group_id']) && is_numeric($_GET['group_id'])) {
        $id    = Wo_Secure($_GET['group_id']);
        $data  = array(
            'status' => 304
        );
        $parts = Wo_GetGChatMemebers($id);
        $data  = array();
        if (is_array($parts)) {
            $wo['group']             = array();
            $wo['group']['owner']    = Wo_IsGChatOwner($id);
            $wo['group']['parts']    = $parts;
            $wo['group']['group_id'] = $id;
            $data['status']          = 200;
            $data['count']           = count($parts);
            ;
            $data['parts'] = Wo_LoadPage('chat/manage');
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'create_group' && isset($_POST['group_name']) && isset($_POST['parts'])) {
        $error = false;
        $data  = array(
            'status' => 500,
            'message' => $error_icon . $wo['lang']['please_check_details']
        );
        if (strlen($_POST['group_name']) < 4 || strlen($_POST['group_name']) > 15) {
            $error           = true;
            $data['message'] = $error_icon . $wo['lang']['group_name_limit'];
        }
        if (isset($_FILES["avatar"])) {
            if (file_exists($_FILES["avatar"]["tmp_name"])) {
                $image = getimagesize($_FILES["avatar"]["tmp_name"]);
                if (!in_array($image[2], array(
                    IMAGETYPE_GIF,
                    IMAGETYPE_JPEG,
                    IMAGETYPE_PNG,
                    IMAGETYPE_BMP
                ))) {
                    $error           = true;
                    $data['message'] = $error_icon . $wo['lang']['group_avatar_image'];
                }
            }
        }
        if (!$error) {
            $users   = explode(',', Wo_Secure($_POST['parts']));
            $users[] = $wo['user']['id'];
            $name    = Wo_Secure($_POST['group_name']);
            $id      = Wo_CreateGChat($name, $users);
            if ($id && is_numeric($id)) {
                $data = array(
                    'status' => 200,
                    'group_id' => $id
                );
            }
            if (isset($_FILES["avatar"]["tmp_name"])) {
                $fileInfo      = array(
                    'file' => $_FILES["avatar"]["tmp_name"],
                    'name' => $_FILES['avatar']['name'],
                    'size' => $_FILES["avatar"]["size"],
                    'type' => $_FILES["avatar"]["type"],
                    'types' => 'jpg,png,bmp,gif',
                    'compress' => false,
                    'crop' => array(
                        'width' => 70,
                        'height' => 70
                    )
                );
                $media         = Wo_ShareFile($fileInfo);
                $mediaFilename = $media['filename'];
                @Wo_UpdateGChat($id, array(
                    "avatar" => $mediaFilename
                ));
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'apps') {
    if ($s == 'create_app') {
        if (empty($_POST['app_name']) || empty($_POST['app_website_url']) || empty($_POST['app_description'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        }
        if (!filter_var($_POST['app_website_url'], FILTER_VALIDATE_URL)) {
            $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
        }
        if (empty($errors)) {
            $app_callback_url = '';
            if (!empty($_POST['app_callback_url'])) {
                if (!filter_var($_POST['app_callback_url'], FILTER_VALIDATE_URL)) {
                    $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
                } else {
                    $app_callback_url = $_POST['app_callback_url'];
                }
            }
            $re_app_data = array(
                'app_user_id' => Wo_Secure($wo['user']['user_id']),
                'app_name' => Wo_Secure($_POST['app_name']),
                'app_website_url' => Wo_Secure($_POST['app_website_url']),
                'app_description' => Wo_Secure($_POST['app_description']),
                'app_callback_url' => Wo_Secure($app_callback_url)
            );
            $app_id      = Wo_RegisterApp($re_app_data);
            if ($app_id != '') {
                if (!empty($_FILES["app_avatar"]["name"])) {
                    Wo_UploadImage($_FILES["app_avatar"]["tmp_name"], $_FILES['app_avatar']['name'], 'avatar', $_FILES['app_avatar']['type'], $app_id, 'app');
                }
                $data = array(
                    'status' => 200,
                    'location' => Wo_SeoLink('index.php?link1=app&app_id=' . $app_id)
                );
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'update_app') {
        if (empty($_POST['app_name']) || empty($_POST['app_website_url']) || empty($_POST['app_description'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        }
        if (!filter_var($_POST['app_website_url'], FILTER_VALIDATE_URL)) {
            $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
        }
        if (!filter_var($_POST['app_callback_url'], FILTER_VALIDATE_URL)) {
            $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
        }

        if (empty($errors)) {
            $app_id      = $_POST['app_id'];
            $re_app_data = array(
                'app_user_id' => Wo_Secure($wo['user']['user_id']),
                'app_name' => Wo_Secure($_POST['app_name']),
                'app_website_url' => Wo_Secure($_POST['app_website_url']),
                'app_callback_url' => Wo_Secure($_POST['app_callback_url']),
                'app_description' => Wo_Secure($_POST['app_description'])
            );
            if (Wo_UpdateAppData($app_id, $re_app_data) === true) {
                if (!empty($_FILES["app_avatar"]["name"])) {
                    Wo_UploadImage($_FILES["app_avatar"]["tmp_name"], $_FILES['app_avatar']['name'], 'avatar', $_FILES['app_avatar']['type'], $app_id, 'app');
                }
                $img  = Wo_GetApp($app_id);
                $data = array(
                    'status' => 200,
                    'message' => $wo['lang']['setting_updated'],
                    'name' => $_POST['app_name'],
                    'image' => $img['app_avatar']
                );
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'acceptPermissions') {
        $acceptPermissions = Wo_AcceptPermissions($_POST['id']);
        if ($acceptPermissions === true) {
            $import = Wo_GenrateCode($wo['user']['user_id'], $_POST['id']);
            $app    = urldecode($_POST['url']) . '?code=' . $import;
            $data   = array(
                'status' => 200,
                'location' => $app
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'pages') {
    if ($s == 'create_page') {
        if (empty($_POST['page_name']) || empty($_POST['page_title']) || Wo_CheckSession($hash_id) === false) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else {
            $is_exist = Wo_IsNameExist($_POST['page_name'], 0);
            if (in_array(true, $is_exist)) {
                $errors[] = $error_icon . $wo['lang']['page_name_exists'];
            }
            if (in_array($_POST['page_name'], $wo['site_pages'])) {
                $errors[] = $error_icon . $wo['lang']['page_name_invalid_characters'];
            }
            if (strlen($_POST['page_name']) < 5 OR strlen($_POST['page_name']) > 32) {
                $errors[] = $error_icon . $wo['lang']['page_name_characters_length'];
            }
            if (!preg_match('/^[\w]+$/', $_POST['page_name'])) {
                $errors[] = $error_icon . $wo['lang']['page_name_invalid_characters'];
            }
            if (empty($_POST['page_category'])) {
                $_POST['page_category'] = 1;
            }
        }
        if (empty($errors)) {
            $re_page_data  = array(
                'page_name' => Wo_Secure($_POST['page_name']),
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'page_title' => Wo_Secure($_POST['page_title']),
                'page_description' => Wo_Secure($_POST['page_description']),
                'page_category' => Wo_Secure($_POST['page_category']),
                'active' => '1'
            );
            $register_page = Wo_RegisterPage($re_page_data);
            if ($register_page) {
                $data = array(
                    'status' => 200,
                    'location' => Wo_SeoLink('index.php?link1=timeline&u=' . Wo_Secure($_POST['page_name']))
                );
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'update_information_setting') {
        if (!empty($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
            $PageData = Wo_PageData($_POST['page_id']);
            if (!empty($_POST['website'])) {
                if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
                    $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'website' => $_POST['website'],
                    'page_description' => $_POST['page_description'],
                    'company' => $_POST['company'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                );
                if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'update_sociallink_setting') {
        if (!empty($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
            $PageData = Wo_PageData($_POST['page_id']);
            if (empty($errors)) {
                $Update_data = array(
                    'facebook' => $_POST['facebook'],
                    'google' => $_POST['google'],
                    'twitter' => $_POST['twitter'],
                    'linkedin' => $_POST['linkedin'],
                    'vk' => $_POST['vk'],
                    'youtube' => $_POST['youtube']
                );
                if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    
    if ($s == 'update_images_setting') {
        if (isset($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
            $Userdata = Wo_PageData($_POST['page_id']);
            if (!empty($Userdata['page_id'])) {
                if (isset($_FILES['avatar']['name'])) {
                    if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['page_id'], 'page') === true) {
                        $page_data = Wo_PageData($_POST['page_id']);
                    }
                }
                if (isset($_FILES['cover']['name'])) {
                    if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['page_id'], 'page') === true) {
                        $page_data = Wo_PageData($_POST['page_id']);
                    }
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'active' => '1'
                    );
                    if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                        $userdata2 = Wo_PageData($_POST['page_id']);
                        $data      = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated'],
                            'cover' => $userdata2['cover'],
                            'avatar' => $userdata2['avatar']
                        );
                    }
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
    }
    if ($s == 'update_general_settings') {
        if (!empty($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
            $PageData = Wo_PageData($_POST['page_id']);
            if (empty($_POST['page_name']) OR empty($_POST['page_category']) OR empty($_POST['page_title'])) {
                $errors[] = $error_icon . $wo['lang']['please_check_details'];
            } else {
                if ($_POST['page_name'] != $PageData['page_name']) {
                    $is_exist = Wo_IsNameExist($_POST['page_name'], 0);
                    if (in_array(true, $is_exist)) {
                        $errors[] = $error_icon . $wo['lang']['page_name_exists'];
                    }
                }
                if (in_array($_POST['page_name'], $wo['site_pages'])) {
                    $errors[] = $error_icon . $wo['lang']['page_name_invalid_characters'];
                }
                if (strlen($_POST['page_name']) < 5 || strlen($_POST['page_name']) > 32) {
                    $errors[] = $error_icon . $wo['lang']['page_name_characters_length'];
                }
                if (!preg_match('/^[\w]+$/', $_POST['page_name'])) {
                    $errors[] = $error_icon . $wo['lang']['page_name_invalid_characters'];
                }
                if (empty($_POST['page_category'])) {
                    $_POST['page_category'] = 1;
                }
                $call_action_type = 0;
                if (!empty($_POST['call_action_type'])) {
                    if (array_key_exists($_POST['call_action_type'], $wo['call_action'])) {
                        $call_action_type = $_POST['call_action_type'];
                    }
                }
                if (!empty($_POST['call_action_type_url'])) {
                    if (!filter_var($_POST['call_action_type_url'], FILTER_VALIDATE_URL)) {
                        $errors[] = $error_icon . $wo['lang']['call_action_type_url_invalid'];
                    }
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'page_name' => $_POST['page_name'],
                        'page_title' => $_POST['page_title'],
                        'page_category' => $_POST['page_category'],
                        'call_action_type' => $call_action_type,
                        'call_action_type_url' => $_POST['call_action_type_url']
                    );
                    $array       = array(
                        'verified' => 1,
                        'notVerified' => 0
                    );
                    if (!empty($_POST['verified'])) {
                        if (array_key_exists($_POST['verified'], $array)) {
                            $Update_data['verified'] = $array[$_POST['verified']];
                        }
                    }
                    if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                        $data = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated']
                        );
                    }
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'delete_page') {
        if (!empty($_POST['page_id']) && Wo_CheckSession($hash_id) === true) {
            if (!Wo_HashPassword($_POST['password'], $wo['user']['password']) && !Wo_CheckPageAdminPassword($_POST['password'], $_POST['page_id'])) {
                $errors[] = $error_icon . $wo['lang']['current_password_mismatch'];
            }
            if (empty($errors)) {
                if (Wo_DeletePage($_POST['page_id']) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['page_deleted'],
                        'location' => Wo_SeoLink('index.php?link1=pages')
                    );
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'add_admin') {
        $data = array(
            'status' => 304
        );
        if (isset($_GET['page_id']) && isset($_GET['user_id'])) {
            $page = Wo_Secure($_GET['page_id']);
            $user = Wo_Secure($_GET['user_id']);
            $code = Wo_AddPageAdmin($user, $page);
            if ($code === 1) {
                $data['status'] = 200;
                $data['code']   = 1;
            } else if ($code === 0) {
                $data['status'] = 200;
                $data['code']   = 0;
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_mbr' && isset($_GET['name']) && isset($_GET['page']) && is_numeric($_GET['page'])) {
        $data      = array(
            'status' => 304
        );
        $name      = Wo_Secure($_GET['name']);
        $page      = Wo_Secure($_GET['page']);
        $users     = Wo_GetUsersByName($name);
        $html      = '';
        $page_data = Wo_PageData($page);
        if (is_array($users) && count($users) > 0) {
            foreach ($users as $wo['member']) {
                $wo['member']['page_id']       = $page;
                $wo['member']['is_page_onwer'] = $page_data['is_page_onwer'];
                $html .= Wo_LoadPage('page-setting/admin-list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_more_likes') {
        $html = '';
        if (isset($_GET['user_id']) && isset($_GET['after_last_id'])) {
            foreach (Wo_GetLikes($_GET['user_id'], 'profile', 10, $_GET['after_last_id']) as $wo['PageList']) {
                $html .= Wo_LoadPage('timeline/likes-list');
            }
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_next_page') {
        $html    = '';
        $page_id = (!empty($_GET['page_id'])) ? $_GET['page_id'] : 0;
        foreach (Wo_PageSug(1, $page_id) as $wo['PageList']) {
            $wo['PageList']['user_name'] = $wo['PageList']['name'];
            $html                        = Wo_LoadPage('sidebar/sidebar-home-page-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'get_likes') {
        $html = '';
        if (!empty($_GET['user_id'])) {
            foreach (Wo_GetLikes($_GET['user_id'], 'sidebar', 12) as $wo['PageList']) {
                $wo['PageList']['user_name'] = @mb_substr($wo['PageList']['name'], 0, 10, "utf-8");
                $html .= Wo_LoadPage('sidebar/sidebar-page-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'rate_page' && isset($_POST['page_id']) && isset($_POST['val'])) {
       echo $val  = Wo_Secure($_POST['val']);
        $id   = Wo_Secure($_POST['page_id']);
        $text = Wo_Secure($_POST['text']);
        $data = array(
            'status' => 304,
            'message' => $wo['lang']['page_rated']
        );
        if (Wo_RatePage($id, $val, $text)) {
            $data['status'] = 200;
            $data['val']    = $val;
            unset($data['message']);
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'load_reviews' && isset($_GET['page']) && isset($_GET['after_id'])) {
        $page_id = Wo_Secure($_GET['page']);
        $id      = Wo_Secure($_GET['after_id']);
        $data    = array(
            'status' => 404
        );
        $reviews = Wo_GetPageReviews($page_id, $id);
        $html    = '';
        if (count($reviews) > 0) {
            foreach ($reviews as $wo['review']) {
                $html .= Wo_LoadPage('page/review-list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'go_event') {
    if (!empty($_GET['event_id']) && Wo_CheckMainSession($hash_id) === true) {
        if (Wo_EventGoingExists($_GET['event_id']) === true) {
            if (Wo_UnsetEventGoingUsers($_GET['event_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetGoingButton($_GET['event_id'])
                );
            }
        } else {
            if (Wo_AddEventGoingUsers($_GET['event_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetGoingButton($_GET['event_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'interested_event') {
    if (!empty($_GET['event_id']) && Wo_CheckMainSession($hash_id) === true) {
        if (Wo_EventInterestedExists($_GET['event_id']) === true) {
            if (Wo_UnsetEventInterestedUsers($_GET['event_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetInterestedButton($_GET['event_id'])
                );
            }
        } else {
            if (Wo_AddEventInterestedUsers($_GET['event_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetInterestedButton($_GET['event_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'like_page') {
    if (!empty($_GET['page_id']) && Wo_CheckMainSession($hash_id) === true) {
        if (Wo_IsPageLiked($_GET['page_id'], $wo['user']['user_id']) === true) {
            if (Wo_DeletePageLike($_GET['page_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetLikeButton($_GET['page_id'])
                );
            }
        } else {
            if (Wo_RegisterPageLike($_GET['page_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => Wo_GetLikeButton($_GET['page_id'])
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_pagename') {
    if (isset($_GET['pagename']) && !empty($_GET['page_id'])) {
        $pagename  = Wo_Secure($_GET['pagename']);
        $page_data = Wo_PageData($_GET['page_id']);
        if ($pagename == $page_data['page_name']) {
            $data['status']  = 200;
            $data['message'] = $wo['lang']['available'];
        } else if (strlen($pagename) < 5) {
            $data['status']  = 400;
            $data['message'] = $wo['lang']['too_short'];
        } else if (strlen($pagename) > 32) {
            $data['status']  = 500;
            $data['message'] = $wo['lang']['too_long'];
        } else if (!preg_match('/^[\w]+$/', $_GET['pagename'])) {
            $data['status']  = 600;
            $data['message'] = $wo['lang']['username_invalid_characters_2'];
        } else {
            $is_exist = Wo_IsNameExist($_GET['pagename'], 0);
            if (in_array(true, $is_exist)) {
                $data['status']  = 300;
                $data['message'] = $wo['lang']['in_use'];
            } else {
                $data['status']  = 200;
                $data['message'] = $wo['lang']['available'];
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_groupname') {
    if (isset($_GET['groupname']) && !empty($_GET['group_id'])) {
        $group_name = Wo_Secure($_GET['groupname']);
        $group_data = Wo_GroupData($_GET['group_id']);
        if ($group_name == $group_data['group_name']) {
            $data['status']  = 200;
            $data['message'] = $wo['lang']['available'];
        } else if (strlen($group_name) < 5) {
            $data['status']  = 400;
            $data['message'] = $wo['lang']['too_short'];
        } else if (strlen($group_name) > 32) {
            $data['status']  = 500;
            $data['message'] = $wo['lang']['too_long'];
        } else if (!preg_match('/^[\w]+$/', $_GET['groupname'])) {
            $data['status']  = 600;
            $data['message'] = $wo['lang']['username_invalid_characters_2'];
        } else {
            $is_exist = Wo_IsNameExist($_GET['groupname'], 0);
            if (in_array(true, $is_exist)) {
                $data['status']  = 300;
                $data['message'] = $wo['lang']['in_use'];
            } else {
                $data['status']  = 200;
                $data['message'] = $wo['lang']['available'];
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_page_cover_picture') {
    if (isset($_FILES['cover']['name']) && !empty($_POST['page_id'])) {
        if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['page_id'], 'page')) {
            $img  = Wo_PageData($_POST['page_id']);
            $data = array(
                'status' => 200,
                'img' => $img['cover']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_event_cover_picture') {
    if (isset($_FILES['cover']['name']) && !empty($_POST['event_id']) && Is_EventOwner($_POST['event_id'])) {
        if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['event_id'], 'event')) {
            $img  = Wo_EventData($_POST['event_id']);
            $data = array(
                'status' => 200,
                'img' => $img['cover']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_page_avatar_picture') {
    if (isset($_FILES['avatar']['name']) && !empty($_POST['page_id'])) {
        if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['page_id'], 'page')) {
            $img  = Wo_PageData($_POST['page_id']);
            $data = array(
                'status' => 200,
                'img' => $img['avatar']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_group_cover_picture') {
    if (isset($_FILES['cover']['name']) && !empty($_POST['group_id'])) {
        if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['group_id'], 'group')) {
            $img  = Wo_GroupData($_POST['group_id']);
            $data = array(
                'status' => 200,
                'img' => $img['cover']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_group_avatar_picture') {
    if (isset($_FILES['avatar']['name']) && !empty($_POST['group_id'])) {
        if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['group_id'], 'group')) {
            $img  = Wo_GroupData($_POST['group_id']);
            $data = array(
                'status' => 200,
                'img' => $img['avatar']
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'join_group') {
    if (isset($_GET['group_id']) && Wo_CheckMainSession($hash_id) === true) {
        if (Wo_IsGroupJoined($_GET['group_id']) === true || Wo_IsJoinRequested($_GET['group_id'], $wo['user']['user_id']) === true) {
            if (Wo_LeaveGroup($_GET['group_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => ''
                );
            }
        } else {
            if (Wo_RegisterGroupJoin($_GET['group_id'], $wo['user']['user_id'])) {
                $data = array(
                    'status' => 200,
                    'html' => ''
                );
                if (Wo_CanSenEmails()) {
                    $data['can_send'] = 1;
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'popover') {
    $html        = '';
    $array_types = array(
        'user',
        'page',
        'group'
    );
    if (!empty($_GET['id']) && !empty($_GET['type']) && in_array($_GET['type'], $array_types)) {
        if ($_GET['type'] == 'page') {
            $wo['popover'] = Wo_PageData($_GET['id']);
            if (!empty($wo['popover'])) {
                $html = Wo_LoadPage('popover/page-content');
            }
        } else if ($_GET['type'] == 'user') {
            $wo['popover'] = Wo_UserData($_GET['id']);
            if (!empty($wo['popover'])) {
                $html = Wo_LoadPage('popover/content');
            }
        } else if ($_GET['type'] == 'group') {
            $wo['popover'] = Wo_GroupData($_GET['id']);
            if (!empty($wo['popover'])) {
                $html = Wo_LoadPage('popover/group-content');
            }
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'open_lightbox') {
    $html = '';
    if (!empty($_GET['post_id'])) {
        $wo['story'] = Wo_PostData($_GET['post_id']);
        if (!empty($wo['story'])) {
            $html = Wo_LoadPage('lightbox/content');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'open_album_lightbox') {
    $html = '';
    if (!empty($_GET['image_id'])) {
        $data_image = array(
            'id' => $_GET['image_id']
        );
        if ($_GET['type'] == 'album') {
            $wo['image'] = Wo_AlbumImageData($data_image);
            if (!empty($wo['image'])) {
                $html = Wo_LoadPage('lightbox/album-content');
            }
        }
        else {
            $wo['image'] = Wo_ProductImageData($data_image);
            if (!empty($wo['image'])) {
                $html = Wo_LoadPage('lightbox/product-content');
            }
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_next_album_image') {
    $html = '';
    if (!empty($_GET['after_image_id'])) {
        $data_image  = array(
            'post_id' => $_GET['post_id'],
            'after_image_id' => $_GET['after_image_id']
        );
        $wo['image'] = Wo_AlbumImageData($data_image);
        if (!empty($wo['image'])) {
            $html = Wo_LoadPage('lightbox/album-content');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_previous_album_image') {
    $html = '';
    if (!empty($_GET['before_image_id'])) {
        $data_image  = array(
            'post_id' => $_GET['post_id'],
            'before_image_id' => $_GET['before_image_id']
        );
        $wo['image'] = Wo_AlbumImageData($data_image);
        if (!empty($wo['image'])) {
            $html = Wo_LoadPage('lightbox/album-content');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}

if ($f == 'get_next_product_image') {
    $html = '';
    if (!empty($_GET['after_image_id'])) {
        $data_image  = array(
            'product_id' => $_GET['product_id'],
            'after_image_id' => $_GET['after_image_id']
        );
        $wo['image'] = Wo_ProductImageData($data_image);
        if (!empty($wo['image'])) {
            $html = Wo_LoadPage('lightbox/product-content');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_previous_product_image') {
    $html = '';
    if (!empty($_GET['before_image_id'])) {
        $data_image  = array(
            'product_id' => $_GET['product_id'],
            'before_image_id' => $_GET['before_image_id']
        );
        $wo['image'] = Wo_ProductImageData($data_image);
        if (!empty($wo['image'])) {
            $html = Wo_LoadPage('lightbox/product-content');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'open_multilightbox') {
    $html = '';
    if (!empty($_POST['url'])) {
        $wo['lighbox']['url'] = $_POST['url'];
        $html                 = Wo_LoadPage('lightbox/content-multi');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_next_image') {
    $html      = '';
    $postsData = array(
        'limit' => 1,
        'filter_by' => 'photos',
        'after_post_id' => Wo_Secure($_GET['post_id'])
    );
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        if ($_GET['type'] == 'profile') {
            $postsData['publisher_id'] = $_GET['id'];
        } else if ($_GET['type'] == 'page') {
            $postsData['page_id'] = $_GET['id'];
        } else if ($_GET['type'] == 'group') {
            $postsData['group_id'] = $_GET['id'];
        }
    }
    foreach (Wo_GetPosts($postsData) as $wo['story']) {
        $html .= Wo_LoadPage('lightbox/content');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_previous_image') {
    $html      = '';
    $postsData = array(
        'limit' => 1,
        'filter_by' => 'photos',
        'order' => 'ASC',
        'before_post_id' => Wo_Secure($_GET['post_id'])
    );
    if (!empty($_GET['type']) && !empty($_GET['id'])) {
        if ($_GET['type'] == 'profile') {
            $postsData['publisher_id'] = $_GET['id'];
        } else if ($_GET['type'] == 'page') {
            $postsData['page_id'] = $_GET['id'];
        } else if ($_GET['type'] == 'group') {
            $postsData['group_id'] = $_GET['id'];
        }
    }
    foreach (Wo_GetPosts($postsData) as $wo['story']) {
        $html .= Wo_LoadPage('lightbox/content');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'groups') {
    if ($s == 'create_group') {
        if (empty($_POST['group_name']) || empty($_POST['group_title']) || Wo_CheckSession($hash_id) === false) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else {
            $is_exist = Wo_IsNameExist($_POST['group_name'], 0);
            if (in_array(true, $is_exist)) {
                $errors[] = $error_icon . $wo['lang']['group_name_exists'];
            }
            if (in_array($_POST['group_name'], $wo['site_pages'])) {
                $errors[] = $error_icon . $wo['lang']['group_name_invalid_characters'];
            }
            if (strlen($_POST['group_name']) < 5 OR strlen($_POST['group_name']) > 32) {
                $errors[] = $error_icon . $wo['lang']['group_name_characters_length'];
            }
            if (!preg_match('/^[\w]+$/', $_POST['group_name'])) {
                $errors[] = $error_icon . $wo['lang']['group_name_invalid_characters'];
            }
            if (empty($_POST['category'])) {
                $_POST['category'] = 1;
            }
        }
        if (empty($errors)) {
            $re_group_data  = array(
                'group_name' => Wo_Secure($_POST['group_name']),
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'group_title' => Wo_Secure($_POST['group_title']),
                'about' => Wo_Secure($_POST['about']),
                'category' => Wo_Secure($_POST['category']),
                'active' => '1'
            );
            $register_group = Wo_RegisterGroup($re_group_data);
            if ($register_group) {
                $data = array(
                    'status' => 200,
                    'location' => Wo_SeoLink('index.php?link1=timeline&u=' . Wo_Secure($_POST['group_name']))
                );
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'update_information_setting') {
        if (!empty($_POST['page_id'])) {
            $PageData = Wo_PageData($_POST['page_id']);
            if (!empty($_POST['website'])) {
                if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
                    $errors[] = $error_icon . $wo['lang']['website_invalid_characters'];
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'website' => $_POST['website'],
                    'page_description' => $_POST['page_description'],
                    'company' => $_POST['company'],
                    'address' => $_POST['address'],
                    'phone' => $_POST['phone']
                );
                if (Wo_UpdatePageData($_POST['page_id'], $Update_data)) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'update_privacy_setting') {
        if (!empty($_POST['group_id']) && Wo_CheckSession($hash_id) === true) {
            $PageData     = Wo_PageData($_POST['group_id']);
            $privacy      = 1;
            $join_privacy = 1;
            $array        = array(
                1,
                2
            );
            if (!empty($_POST['privacy'])) {
                if (in_array($_POST['privacy'], $array)) {
                    $privacy = $_POST['privacy'];
                }
            }
            if (!empty($_POST['join_privacy'])) {
                if (in_array($_POST['join_privacy'], $array)) {
                    $join_privacy = $_POST['join_privacy'];
                }
            }
            if (empty($errors)) {
                $Update_data = array(
                    'privacy' => $privacy,
                    'join_privacy' => $join_privacy
                );
                if (Wo_UpdateGroupData($_POST['group_id'], $Update_data)) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['setting_updated']
                    );
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update_images_setting') {
        if (isset($_POST['group_id']) && Wo_CheckSession($hash_id) === true) {
            $Userdata = Wo_GroupData($_POST['group_id']);
            if (!empty($Userdata['id'])) {
                if (!empty($_FILES['avatar']['name'])) {
                    if (Wo_UploadImage($_FILES["avatar"]["tmp_name"], $_FILES['avatar']['name'], 'avatar', $_FILES['avatar']['type'], $_POST['group_id'], 'group') === true) {
                        $page_data = Wo_GroupData($_POST['group_id']);
                    }
                }
                if (!empty($_FILES['cover']['name'])) {
                    if (Wo_UploadImage($_FILES["cover"]["tmp_name"], $_FILES['cover']['name'], 'cover', $_FILES['cover']['type'], $_POST['group_id'], 'group') === true) {
                        $page_data = Wo_GroupData($_POST['group_id']);
                    }
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'active' => '1'
                    );
                    if (Wo_UpdateGroupData($_POST['group_id'], $Update_data)) {
                        $userdata2 = Wo_GroupData($_POST['group_id']);
                        $data      = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated'],
                            'cover' => $userdata2['cover'],
                            'avatar' => $userdata2['avatar']
                        );
                    }
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
    }
    if ($s == 'update_general_settings') {
        if (!empty($_POST['group_id']) && Wo_CheckSession($hash_id) === true) {
            $group_data = Wo_GroupData($_POST['group_id']);
            if (empty($_POST['group_name']) OR empty($_POST['group_category']) OR empty($_POST['group_title'])) {
                $errors[] = $error_icon . $wo['lang']['please_check_details'];
            } else {
                if ($_POST['group_name'] != $group_data['group_name']) {
                    $is_exist = Wo_IsNameExist($_POST['group_name'], 0);
                    if (in_array(true, $is_exist)) {
                        $errors[] = $error_icon . $wo['lang']['group_name_exists'];
                    }
                }
                if (in_array($_POST['group_name'], $wo['site_pages'])) {
                    $errors[] = $error_icon . $wo['lang']['group_name_invalid_characters'];
                }
                if (strlen($_POST['group_name']) < 5 || strlen($_POST['group_name']) > 32) {
                    $errors[] = $error_icon . $wo['lang']['group_name_characters_length'];
                }
                if (!preg_match('/^[\w]+$/', $_POST['group_name'])) {
                    $errors[] = $error_icon . $wo['lang']['group_name_invalid_characters'];
                }
                if (empty($_POST['group_category'])) {
                    $_POST['group_category'] = 1;
                }
                if (empty($errors)) {
                    $Update_data = array(
                        'group_name' => $_POST['group_name'],
                        'group_title' => $_POST['group_title'],
                        'category' => $_POST['group_category'],
                        'about' => $_POST['about']
                    );
                    if (Wo_UpdateGroupData($_POST['group_id'], $Update_data)) {
                        $data = array(
                            'status' => 200,
                            'message' => $success_icon . $wo['lang']['setting_updated']
                        );
                    }
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'delete_group') {
        if (!empty($_POST['group_id']) && Wo_CheckSession($hash_id) === true) {
            if (!Wo_HashPassword($_POST['password'], $wo['user']['password']) && !Wo_CheckGroupAdminPassword($_POST['password'], $_POST['group_id'])) {
                $errors[] = $error_icon . $wo['lang']['current_password_mismatch'];
            }
            if (empty($errors)) {
                if (Wo_DeleteGroup($_POST['group_id']) === true) {
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['group_deleted'],
                        'location' => Wo_SeoLink('index.php?link1=groups')
                    );
                }
            }
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'accept_request') {
        if (isset($_GET['user_id']) && !empty($_GET['group_id'])) {
            if (Wo_AcceptJoinRequest($_GET['user_id'], $_GET['group_id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_request') {
        if (isset($_GET['user_id']) && !empty($_GET['group_id'])) {
            if (Wo_DeleteJoinRequest($_GET['user_id'], $_GET['group_id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'delete_joined_user') {
        if (isset($_GET['user_id']) && !empty($_GET['group_id'])) {
            if (Wo_LeaveGroup($_GET['group_id'], $_GET['user_id']) === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'add_admin') {
        if (isset($_GET['user_id']) && isset($_GET['group_id'])) {
            $member = Wo_Secure($_GET['user_id']);
            $group  = Wo_Secure($_GET['group_id']);
            $data   = array(
                'status' => 304
            );
            $code   = Wo_AddGroupAdmin($member, $group);
            if ($code === 1) {
                $data['status'] = 200;
                $data['code']   = 1;
            } elseif ($code === 0) {
                $data['status'] = 200;
                $data['code']   = 0;
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'get_user_profile_image_post') {
    if (!empty($_POST['image'])) {
        $getUserImage = Wo_GetUserProfilePicture(Wo_Secure($_POST['image'], 0));
        if (!empty($getUserImage)) {
            $data = array(
                'status' => 200,
                'post_id' => $getUserImage
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_user_profile_cover_image_post') {
    if (!empty($_POST['image'])) {
        $getUserImage = Wo_GetUserProfilePicture(Wo_Secure($_POST['image'], 0));
        if (!empty($getUserImage)) {
            $data = array(
                'status' => 200,
                'post_id' => $getUserImage
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'register_recent_search') {
    $array_type = array(
        'user',
        'page',
        'group'
    );
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        if (in_array($_GET['type'], $array_type)) {
            if ($_GET['type'] == 'user') {
                $regsiter_recent = Wo_RegsiterRecent($_GET['id'], $_GET['type']);
                $user            = Wo_UserData($regsiter_recent);
            } else if ($_GET['type'] == 'page') {
                $regsiter_recent = Wo_RegsiterRecent($_GET['id'], $_GET['type']);
                $user            = Wo_PageData($regsiter_recent);
            } else if ($_GET['type'] == 'group') {
                $regsiter_recent = Wo_RegsiterRecent($_GET['id'], $_GET['type']);
                $user            = Wo_GroupData($regsiter_recent);
            }
            if (!empty($user['url'])) {
                $data = array(
                    'status' => 200,
                    'href' => $user['url']
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'clearChat') {
    $clear = Wo_ClearRecent();
    if ($clear === true) {
        $data = array(
            'status' => 200
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'album') {
    if ($s == 'create_album' && Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['album_name'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else if (empty($_FILES['postPhotos']['name'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        }
        if (isset($_FILES['postPhotos']['name'])) {
            $allowed = array(
                'gif',
                'png',
                'jpg',
                'jpeg'
            );
            for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                $new_string = pathinfo($_FILES['postPhotos']['name'][$i]);
                if (!in_array(strtolower($new_string['extension']), $allowed)) {
                    $errors[] = $error_icon . $wo['lang']['please_check_details'];
                }
            }
        }
        if (empty($errors)) {
            $post_data = array(
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'album_name' => Wo_Secure($_POST['album_name']),
                'postPrivacy' => Wo_Secure(0),
                'time' => time()
            );
            if (!empty($_POST['id'])) {
                if (is_numeric($_POST['id'])) {
                    $post_data = array(
                        'album_name' => Wo_Secure($_POST['album_name'])
                    );
                    $id        = Wo_UpdatePostData($_POST['id'], $post_data);
                }
            } else {
                $id = Wo_RegisterPost($post_data);
            }
            if (count($_FILES['postPhotos']['name']) > 0) {
                for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                    $fileInfo = array(
                        'file' => $_FILES["postPhotos"]["tmp_name"][$i],
                        'name' => $_FILES['postPhotos']['name'][$i],
                        'size' => $_FILES["postPhotos"]["size"][$i],
                        'type' => $_FILES["postPhotos"]["type"][$i],
                        'types' => 'jpg,png,jpeg,gif'
                    );
                    $file     = Wo_ShareFile($fileInfo, 1);
                    if (!empty($file)) {
                        $media_album = Wo_RegisterAlbumMedia($id, $file['filename']);
                    }
                }
            }
            $data = array(
                'status' => 200,
                'href' => Wo_SeoLink('index.php?link1=post&id=' . $id)
            );
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
}
if ($f == 'delete_album_image') {
    if (!empty($_GET['post_id']) && !empty($_GET['id'])) {
        if (Wo_DeleteImageFromAlbum($_GET['post_id'], $_GET['id']) === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'register_page_invite') {
    if (!empty($_GET['user_id']) && !empty($_GET['page_id'])) {
        $register_invite = Wo_RegsiterInvite($_GET['user_id'], $_GET['page_id']);
        if ($register_invite === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'register_group_add') {
    if (!empty($_GET['user_id']) && !empty($_GET['group_id'])) {
        $register_add = Wo_RegsiterGroupAdd($_GET['user_id'], $_GET['group_id']);
        if ($register_add === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'mention') {
    $html_data  = array();
    $data_finel = array();
    $following  = Wo_GetFollowingSug(5, $_GET['term']);
    header("Content-type: application/json");
    echo json_encode(array(
        $following
    ));
    exit();
}
if ($f == 'skip_step') {
    if (!empty($_GET['type'])) {
        $types = array(
            'start_up_info',
            'startup_image',
            'startup_follow'
        );
        if (in_array($_GET['type'], $types)) {
            $register_skip = Wo_UpdateUserData($wo['user']['user_id'], array(
                $_GET['type'] => 1
            ));
            if ($register_skip === true) {
                $data = array(
                    'status' => 200
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_user_information_startup') {
    if (isset($_POST['user_id'])) {
        $Userdata = Wo_UserData($_POST['user_id']);
        if (!empty($Userdata['user_id'])) {
            $age_data = '00-00-0000';
            if (!empty($_POST['age_year']) || !empty($_POST['age_day']) || !empty($_POST['age_month'])) {
                if (empty($_POST['age_year']) || empty($_POST['age_day']) || empty($_POST['age_month'])) {
                    $errors[] = $error_icon . $wo['lang']['please_choose_correct_date'];
                } else {
                    $age_data = $_POST['age_year'] . '-' . $_POST['age_month'] . '-' . $_POST['age_day'];
                }
            }
            $Update_data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'country_id' => $_POST['country'],
                'state_id' => $_POST['state'],
                'city_id' => $_POST['city'],
                'birthday' => $age_data,
                 'gender' => $_POST['gender'],
                'start_up_info' => 1
            );
            if (Wo_UpdateUserData($_POST['user_id'], $Update_data)) {
                $data = array(
                    'status' => 200
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'follow_users') {
    if (!empty($_POST['user'])) {
        $continue = false;
        $ids      = @explode(',', $_POST['user']);
        foreach ($ids as $id) {
            if (Wo_RegisterFollow($id, $wo['user']['user_id']) === true) {
                $continue = true;
            }
        }
        if ($continue == true) {
            if (Wo_UpdateUserData($wo['user']['user_id'], array(
                'startup_follow' => '1',
                'start_up' => '1'
            ))) {
                $data = array(
                    'status' => 200
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'send_mails') {
    if ($wo['config']['emailNotification'] == 0) {
        $data = array(
            'status' => 200
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    $send = Wo_SendMessageFromDB();
    if ($send) {
        $data = array(
            'status' => 200
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 're_cover') {
    if (isset($_POST['pos'])) {
        if (($_POST['cover_image'] != $wo['userDefaultCover']) && ($_POST['cover_image'] == $wo['user']['cover_org'] || Wo_IsAdmin())) {
            $from_top             = abs($_POST['pos']);
            $cover_image          = $_POST['cover_image'];
            $full_url_image       = Wo_GetMedia($_POST['cover_image']);
            $default_image        = $_POST['real_image'];
            $image_type           = $_POST['image_type'];
            $default_cover_width  = 918;
            $default_cover_height = 276;
            require_once("assets/import/thumbncrop.inc.php");
            $tb = new ThumbAndCrop();
            $tb->openImg($default_image);
            $newHeight = $tb->getRightHeight($default_cover_width);
            $tb->creaThumb($default_cover_width, $newHeight);
            $tb->setThumbAsOriginal();
            $tb->cropThumb($default_cover_width, 300, 0, $from_top);
            $tb->saveThumb($cover_image);
            $tb->resetOriginal();
            $tb->closeImg();
            $upload_s3 = Wo_UploadToS3($cover_image);
        }
        if (empty($full_url_image)) {
            $full_url_image = Wo_GetMedia($wo['userDefaultCover']);
        }
        $data = array(
            'status' => 200,
            'url' => $full_url_image
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'payment') {
    if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
        header("Location: " . Wo_SeoLink('index.php?link1=oops'));
        exit();
    }
    $is_pro = 0;
    $stop   = 0;
    $user   = Wo_UserData($wo['user']['user_id']);
    if ($user['is_pro'] == 1) {
        $stop = 1;
        if ($user['pro_type'] == 1) {
            $time_ = time() - $star_package_duration;
            if ($user['pro_time'] > $time_) {
                $stop = 1;
            }
        } else if ($user['pro_type'] == 2) {
            $time_ = time() - $hot_package_duration;
            if ($user['pro_time'] > $time_) {
                $stop = 1;
            }
        } else if ($user['pro_type'] == 3) {
            $time_ = time() - $ultima_package_duration;
            if ($user['pro_time'] > $time_) {
                $stop = 1;
            }
        } else if ($user['pro_type'] == 4) {
            if ($vip_package_duration > 0) {
                $time_ = time() - $vip_package_duration;
                if ($user['pro_time'] > $time_) {
                    $stop = 1;
                }
            }
        }
    }
    if ($stop == 0) {
        $pro_types_array = array(
            1,
            2,
            3,
            4
        );
        $pro_type        = 0;
        if (!isset($_GET['pro_type']) || !in_array($_GET['pro_type'], $pro_types_array)) {
            header("Location: " . Wo_SeoLink('index.php?link1=oops'));
            exit();
        }
        $pro_type = $_GET['pro_type'];
        $payment  = Wo_CheckPayment($_GET['paymentId'], $_GET['PayerID']);
        if (is_array($payment)) {
            if (isset($payment['name'])) {
                if ($payment['name'] == 'PAYMENT_ALREADY_DONE' || $payment['name'] == 'MAX_NUMBER_OF_PAYMENT_ATTEMPTS_EXCEEDED') {
                    $is_pro = 1;
                }
            }
        } else if ($payment === true) {
            $is_pro = 1;
        }
    }
    if ($stop == 0) {
        $time = time();
        if ($is_pro == 1) {
            $update_array   = array(
                'is_pro' => 1,
                'pro_time' => time(),
                'verified' => 1,
                'pro_' => 1,
                'pro_type' => $pro_type
            );
            $mysqli         = Wo_UpdateUserData($wo['user']['user_id'], $update_array);
            $create_payment = Wo_CreatePayment($pro_type);
            if ($mysqli) {
                header("Location: " . Wo_SeoLink('index.php?link1=upgraded'));
                exit();
            }
        } else {
            header("Location: " . Wo_SeoLink('index.php?link1=oops'));
            exit();
        }
    } else {
        header("Location: " . Wo_SeoLink('index.php?link1=oops'));
        exit();
    }
}
if ($f == 'wallet') {
    if ($s == 'replenish-user-account') {
        $error = "";
        if (!isset($_GET['amount']) || !is_numeric($_GET['amount']) || $_GET['amount'] < 1 || strpos($_GET['amount'], '.') != false) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        }
        if (empty($error)) {
            $data = Wo_ReplenishWallet($_GET['amount']);
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        } else {
            header("Content-type: application/json");
            echo json_encode(array(
                'status' => 500,
                'error' => $error
            ));
            exit();
        }
    }
    if ($s == 'get-paid') {
        if (isset($_GET['success']) && $_GET['success'] == 1 && isset($_GET['paymentId']) && isset($_GET['PayerID'])) {
            if (!is_array(Wo_GetWalletReplenishingDone($_GET['paymentId'], $_GET['PayerID']))) {
                if (Wo_ReplenishingUserBalance($_GET['amount'])) {
                    $_SESSION['replenished_amount'] = $_GET['amount'];
                    header("Location: " . Wo_SeoLink('index.php?link1=wallet'));
                    exit();
                } else {
                    header("Location: " . Wo_SeoLink('index.php?link1=wallet'));
                    exit();
                }
            } else {
                header("Location: " . Wo_SeoLink('index.php?link1=wallet'));
                exit();
            }
        } else if (isset($_GET['success']) && $_GET['success'] == 0) {
            header("Location: " . Wo_SeoLink('index.php?link1=wallet'));
            exit();
        } else {
            header("Location: " . Wo_SeoLink('index.php?link1=wallet'));
            exit();
        }
    }
    if ($s == 'remove' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $data['status'] = 304;
        if (Wo_DeleteUserAd($_GET['id'])) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'stripe_payment') {
    if (empty($_POST['stripeToken'])) {
        header("Location: " . Wo_SeoLink('index.php?link1=oops'));
        exit();
    }
    $token = $_POST['stripeToken'];
    try {
        $customer = \Stripe\Customer::create(array(
            'source' => $token
        ));
        $charge   = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount' => $_POST['amount'],
            'currency' => 'usd'
        ));
        if ($charge) {
            $is_pro = 0;
            $stop   = 0;
            $user   = Wo_UserData($wo['user']['user_id']);
            if ($user['is_pro'] == 1) {
                $stop = 1;
                if ($user['pro_type'] == 1) {
                    $time_ = time() - $star_package_duration;
                    if ($user['pro_time'] > $time_) {
                        $stop = 1;
                    }
                } else if ($user['pro_type'] == 2) {
                    $time_ = time() - $hot_package_duration;
                    if ($user['pro_time'] > $time_) {
                        $stop = 1;
                    }
                } else if ($user['pro_type'] == 3) {
                    $time_ = time() - $ultima_package_duration;
                    if ($user['pro_time'] > $time_) {
                        $stop = 1;
                    }
                } else if ($user['pro_type'] == 4) {
                    if ($vip_package_duration > 0) {
                        $time_ = time() - $vip_package_duration;
                        if ($user['pro_time'] > $time_) {
                            $stop = 1;
                        }
                    }
                }
            }
            if ($stop == 0) {
                $pro_types_array = array(
                    1,
                    2,
                    3,
                    4
                );
                $pro_type        = 0;
                if (!isset($_GET['pro_type']) || !in_array($_GET['pro_type'], $pro_types_array)) {
                    $data = array(
                        'status' => 200,
                        'error' => 'Pro type is not set'
                    );
                    header("Content-type: application/json");
                    echo json_encode($data);
                    exit();
                }
                $pro_type = $_GET['pro_type'];
                $is_pro   = 1;
            }
            if ($stop == 0) {
                $time = time();
                if ($is_pro == 1) {
                    $update_array   = array(
                        'is_pro' => 1,
                        'pro_time' => time(),
                        'verified' => 1,
                        'pro_' => 1,
                        'pro_type' => $pro_type
                    );
                    $mysqli         = Wo_UpdateUserData($wo['user']['user_id'], $update_array);
                    $create_payment = Wo_CreatePayment($pro_type);
                    if ($mysqli) {
                        if (!empty($_SESSION['ref']) && $wo['config']['affiliate_type'] == 1 && $wo['user']['referrer'] == 0) {
                            $ref_user_id = Wo_UserIdFromUsername($_SESSION['ref']);
                            if (!empty($ref_user_id) && is_numeric($ref_user_id)) {
                                $update_balance = Wo_UpdateBalance($ref_user_id, $wo['config']['amount_ref']);
                                $update_user    = Wo_UpdateUserData($wo['user']['user_id'], array(
                                    'referrer' => $ref_user_id,
                                    'src' => 'Referrer'
                                ));
                                unset($_SESSION['ref']);
                            }
                        }
                        $data = array(
                            'status' => 200,
                            'location' => Wo_SeoLink('index.php?link1=upgraded')
                        );
                        header("Content-type: application/json");
                        echo json_encode($data);
                        exit();
                    }
                } else {
                    $data = array(
                        'status' => 400,
                        'error' => 'Pro type is not set2'
                    );
                    header("Content-type: application/json");
                    echo json_encode($data);
                    exit();
                }
            } else {
                $data = array(
                    'status' => 400,
                    'error' => 'Pro type is not set3'
                );
                header("Content-type: application/json");
                echo json_encode($data);
                exit();
            }
        }
    }
    catch (Exception $e) {
        $data = array(
            'status' => 400,
            'error' => $e->getMessage()
        );
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'get_payment_method') {
    if (!empty($_GET['type'])) {
        $html            = '';
        $pro_types_array = array(
            1,
            2,
            3,
            4
        );
        if (in_array($_GET['type'], $pro_types_array)) {
            switch ($_GET['type']) {
                case 1:
                    $type        = 'week';
                    $description = 'Star package (1 week)';
                    if (strpos($wo['config']['weekly_price'], ".") !== false) {
                        $price = str_replace('.', "", $wo['config']['weekly_price']);
                    } else {
                        $price = $wo['config']['weekly_price'] . '00';
                    }
                    break;
                case 2:
                    $type        = 'month';
                    $description = 'Hot package (1 month)';
                    if (strpos($wo['config']['monthly_price'], ".") !== false) {
                        $price = str_replace('.', "", $wo['config']['monthly_price']);
                    } else {
                        $price = $wo['config']['monthly_price'] . '00';
                    }
                    break;
                case 3:
                    $type        = 'year';
                    $description = 'Ultima package (1 year)';
                    if (strpos($wo['config']['yearly_price'], ".") !== false) {
                        $price = str_replace('.', "", $wo['config']['yearly_price']);
                    } else {
                        $price = $wo['config']['yearly_price'] . '00';
                    }
                    break;
                case 4:
                    $type        = 'life-time';
                    $description = 'Vip package (life-time)';
                    if (strpos($wo['config']['lifetime_price'], ".") !== false) {
                        $price = str_replace('.', "", $wo['config']['lifetime_price']);
                    } else {
                        $price = $wo['config']['lifetime_price'] . '00';
                    }
                    break;
            }
            $load = Wo_LoadPage('modals/pay-go-pro');
            $load = str_replace('{pro_type}', $type, $load);
            $load = str_replace('{pro_type_id}', $_GET['type'], $load);
            $load = str_replace('{pro_type_description}', $description, $load);
            $load = str_replace('{pro_type_price}', $price, $load);
            if (!empty($load)) {
                $data = array(
                    'status' => 200,
                    'html' => $load
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_paypal_url') {
    $data = array(
        'status' => 400,
        'url' => ''
    );
    if (isset($_POST['type'])) {
        $type2 = '';
        if (!empty($_POST['type2'])) {
            $type2 = $_POST['type2'];
        }
        $url = Wo_PayPal($_POST['type'], $type2);
        if (!empty($url['type'])) {
            if ($url['type'] == 'SUCCESS' && !empty($url['type'])) {
                $data = array(
                    'status' => 200,
                    'url' => $url['url']
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'upgrade') {
    if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
        header("Location: " . Wo_SeoLink('index.php?link1=oops'));
        exit();
    }
    $is_pro = 0;
    $stop   = 0;
    $user   = Wo_UserData($wo['user']['user_id']);
    if ($user['is_pro'] == 0) {
        $stop = 1;
    }
    if ($stop == 0) {
        $pro_types_array = array(
            1,
            2,
            3,
            4
        );
        $pro_type        = 0;
        if (!isset($_GET['pro_type']) || !in_array($_GET['pro_type'], $pro_types_array)) {
            header("Location: " . Wo_SeoLink('index.php?link1=oops'));
            exit();
        }
        $pro_type = $_GET['pro_type'];
        $payment  = Wo_CheckPayment($_GET['paymentId'], $_GET['PayerID']);
        if (is_array($payment)) {
            if (isset($payment['name'])) {
                if ($payment['name'] == 'PAYMENT_ALREADY_DONE' || $payment['name'] == 'MAX_NUMBER_OF_PAYMENT_ATTEMPTS_EXCEEDED') {
                    $is_pro = 1;
                }
            }
        } else if ($payment === true) {
            $is_pro = 1;
        }
    }
    if ($stop == 0) {
        $time = time();
        if ($is_pro == 1) {
            $update_array   = array(
                'pro_time' => time(),
                'pro_type' => $pro_type
            );
            $mysqli         = Wo_UpdateUserData($wo['user']['user_id'], $update_array);
            $create_payment = Wo_CreatePayment($pro_type);
            if ($mysqli) {
                if (!empty($_SESSION['ref']) && $wo['config']['affiliate_type'] == 1 && $wo['user']['referrer'] == 0) {
                    $ref_user_id = Wo_UserIdFromUsername($_SESSION['ref']);
                    if (!empty($ref_user_id) && is_numeric($ref_user_id)) {
                        $update_user    = Wo_UpdateUserData($wo['user']['user_id'], array(
                            'referrer' => $ref_user_id,
                            'src' => 'Referrer'
                        ));
                        $update_balance = Wo_UpdateBalance($ref_user_id, $wo['config']['amount_ref']);
                        unset($_SESSION['ref']);
                    }
                }
                header("Location: " . Wo_SeoLink('index.php?link1=upgraded'));
                exit();
            }
        } else {
            header("Location: " . Wo_SeoLink('index.php?link1=oops'));
            exit();
        }
    } else {
        header("Location: " . Wo_SeoLink('index.php?link1=oops'));
        exit();
    }
}

if ($f == 'count_user') {
    $user_id=$_POST['num_user'];
     global $wo, $sqlConnect;
   
    $query_one = "SELECT `following_id` FROM " . T_FOLLOWERS . " WHERE `follower_id` = {$user_id}";
    $sql       = mysqli_query($sqlConnect, $query_one);
   $fetched_data = mysqli_num_rows($sql);
     if(empty($fetched_data)){
        $errors = $error_icon . "Please add Friend";
    }        
     else{
            $data = array(
                'status' => 200,
                'html' =>$fetched_data
            );
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
    
    
}
if ($f == 'feedback_user') {
    $numbers=$_POST['ph_number'];
    
    $res=Wo_Feedbackuser($numbers);
     $data = array(
                'status' => 200,

                'res'=>$res
            );
            
    echo json_encode($data);
}

if ($f == 'feedback') {
    $numbers=$_POST['ph_number'];
    $type=$_POST['p_number'];
    $recepient_id=Wo_UserIdFromPhone($numbers);
    $message=$_POST['feedback_msg'];
    $user_id=$wo['user']['user_id'];
    $phone=Wo_FeedbackPhone($user_id);
    $url="https://mitrah.in/index.php?link1=feedback#groups";
    $res=Wo_Feedback($user_id,$phone,$numbers,$message,$type);
    $user=Wo_Feedbackuser($numbers);
    if ($user!='1'){
    $notification=Wo_Feednotification($user_id,$recepient_id,$message,$url,$type);
    }
    $from_userid=Wo_FromUserId($phone);
    $username=Wo_FeedbackName($from_userid);
     $data = array(
                'status' => 200,
                'message' =>"Feedback Sent Successfully",
                'res'=>$res,
                'user_id'=>$user_id,
                'f_msg'=>$message,
                'phone'=>$phone,
                'from_userid'=> $from_userid,
                'username'=>$username
            );
            
    echo json_encode($data);
}

if ($f == 'invite_user') {
    if (empty($_POST['phone'])) {
        $errors[] = $error_icon . $wo['lang']['please_check_details'];
    } /*else if (!preg_match('/^\+?\d+$/', $_POST['phone'])) {
       // $errors[] = $error_icon . $wo['lang']['worng_phone_number'];
    }*/
  //pr($errors);
    $phone_op=1;
    $email_op=0;
    //-----Via Phone
    if($phone_op==1){
      require('textlocal.class.php');
    	$username = "demo";
    	$hash = "d179cdbf113fbdbad44e838edcdab5a35fadbab924a672703678af84dfb0f23e";
        $pass="test@123";
      $Textlocal = new Textlocal($username, $hash,$pass);
    	$test = "0";
    	$sender = "MITRAH"; // This is who the message appears to be from.
    	$numbers =$_POST['phone']; // A single number or a comma-seperated list of numbers
    	$u=explode(",",$numbers);
    	foreach($u as $val){
    	 
    	    $user=Wo_UserExistsViaPhone($val);
    	    if($user == 0){
    	      $not_user[] = $val;
    	    }
    	   
    	}
    if(!empty($not_user))
    {
        
       
        $user_id=$wo['user']['user_id'];
    	$message = "Hi, Your friend ".$wo['user']['name']." has invited you to be part of Indian Social Networking website www.mitrah.in. Lets celebrate friendship  with MITRAH.IN";// 612 chars or less
     Wo_Inviteuser($user_id,$numbers,$message);
    //	$message = urlencode($message);
    
 
 $number= implode(",",$not_user);
 $result=Wo_SelectInviteuser($user_id);
 if ($result==1){
     $response = $Textlocal->sendMessageCustom1($message,$sender,$number,$test);
 }
 else {
 $data = array(
                  'status' => 200,
                  'message' =>"You can send only one message per day"
              );
              echo json_encode($data);
 }
      //$res=json_decode($response);
      /* if ($response) {
              $data = array(
                  'status' => 200,
                  'message' =>"Invitation Sent Successfully"
              );
          } else {
             $errors[] = $error_icon . $wo['lang']['processing_error'];
          }*/
    
    }
    else {
         $data = array(
                  'status' => 200,
                  'message' =>"Number already exists"
              );
              echo json_encode($data);
        // $errors[] = $error_icon . "Number already exists";
    }
      
    }

    //-----Via Email
    if($email_op==1){
      $email=Wo_EmailExistsViaPhone($_POST['phone']);
      if($email=='0'){
        $errors[] = $error_icon . "This user doesnt have an email.";
      }
      if (empty($errors)) {
          $email             = Wo_Secure($email);
          $message           = Wo_LoadPage('emails/invite');
          $send_message_data = array(
              'from_email' => $wo['config']['siteEmail'],
              'from_name' => $wo['config']['siteName'],
              'to_email' => $email,
              'to_name' => '',
              'subject' => 'invitation request',
              'charSet' => 'utf-8',
              'message_body' => $message,
              'is_html' => true
          );
          $send              = Wo_SendMessage($send_message_data);
          if ($send) {
              $data = array(
                  'status' => 200,
                  'message' => $success_icon . $wo['lang']['email_sent']
              );
          } else {
              $errors[] = $error_icon . $wo['lang']['processing_error'];
          }
      }
    }
    header("Content-type: application/json");
    if (!empty($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        rewards_add($wo['user']['user_id'], $wo['config']['rewardInvitePoints'], 'invite');
        //echo json_encode($data);
    }

    exit();
}
if ($f == 'create_new_video_call') {
    if (empty($_GET['user_id2']) || empty($_GET['user_id1']) || Wo_CheckMainSession($hash_id) === false || $_GET['user_id1'] != $wo['user']['user_id']) {
        exit();
    }
    $user_1       = Wo_UserData($_GET['user_id1']);
    $user_2       = Wo_UserData($_GET['user_id2']);
    $room_script  = $user_1['username'] . '_' . $user_2['username'];
    $accountSid   = $wo['config']['video_accountSid'];
    $apiKeySid    = $wo['config']['video_apiKeySid'];
    $apiKeySecret = $wo['config']['video_apiKeySecret'];
    $call_id      = substr(md5(microtime()), 0, 15);
    $call_id_2    = substr(md5(time()), 0, 15);
    $token        = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, $call_id);
    $grant        = new VideoGrant();
    $grant->setRoom($room_script);
    $token->addGrant($grant);
    $token_ = $token->toJWT();
    $token2 = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, $call_id_2);
    $grant2 = new VideoGrant();
    $grant2->setRoom($room_script);
    $token2->addGrant($grant2);
    $token_2    = $token2->toJWT();
    $insertData = Wo_CreateNewVideoCall(array(
        'access_token' => Wo_Secure($token_),
        'from_id' => Wo_Secure($_GET['user_id1']),
        'to_id' => Wo_Secure($_GET['user_id2']),
        'access_token_2' => Wo_Secure($token_2)
    ));
    if ($insertData > 0) {
        $wo['calling_user'] = Wo_UserData($_GET['user_id2']);
        $data               = array(
            'status' => 200,
            'access_token' => $token_,
            'id' => $insertData,
            'url' => $wo['config']['site_url'] . '/video-call/' . $insertData,
            'html' => Wo_LoadPage('modals/calling'),
            'text_no_answer' => $wo['lang']['no_answer'],
            'text_please_try_again_later' => $wo['lang']['please_try_again_later']
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'create_new_audio_call') {
    if (empty($_GET['user_id2']) || empty($_GET['user_id1']) || Wo_CheckMainSession($hash_id) === false || $_GET['user_id1'] != $wo['user']['user_id']) {
        exit();
    }
    $user_1       = Wo_UserData($_GET['user_id1']);
    $user_2       = Wo_UserData($_GET['user_id2']);
    $room_script  = $user_1['username'] . '_' . $user_2['username'];
    $accountSid   = $wo['config']['video_accountSid'];
    $apiKeySid    = $wo['config']['video_apiKeySid'];
    $apiKeySecret = $wo['config']['video_apiKeySecret'];
    $call_id      = substr(md5(microtime()), 0, 15);
    $call_id_2    = substr(md5(time()), 0, 15);
    $token        = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, $call_id);
    $grant        = new VideoGrant();
    $grant->setRoom($room_script);
    $token->addGrant($grant);
    $token_ = $token->toJWT();
    $token2 = new AccessToken($accountSid, $apiKeySid, $apiKeySecret, 3600, $call_id_2);
    $grant2 = new VideoGrant();
    $grant2->setRoom($room_script);
    $token2->addGrant($grant2);
    $token_2    = $token2->toJWT();
    $insertData = Wo_CreateNewAudioCall(array(
        'access_token' => Wo_Secure($token_),
        'from_id' => Wo_Secure($_GET['user_id1']),
        'to_id' => Wo_Secure($_GET['user_id2']),
        'access_token_2' => Wo_Secure($token_2)
    ));
    if ($insertData > 0) {
        $wo['calling_user'] = Wo_UserData($_GET['user_id2']);
        $data               = array(
            'status' => 200,
            'access_token' => $token_,
            'id' => $insertData,
            'html' => Wo_LoadPage('modals/calling-audio'),
            'text_no_answer' => $wo['lang']['no_answer'],
            'text_please_try_again_later' => $wo['lang']['please_try_again_later']
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_for_audio_answer') {
    if (!empty($_GET['id'])) {
        $selectData = Wo_CheckAudioCallAnswer($_GET['id']);
        if ($selectData !== false) {
            $data  = array(
                'status' => 200,
                'text_answered' => $wo['lang']['answered'],
                'text_please_wait' => $wo['lang']['please_wait']
            );
            $id    = Wo_Secure($_GET['id']);
            $query = mysqli_query($sqlConnect, "SELECT * FROM " . T_AUDIO_CALLES . " WHERE `id` = '{$id}'");
            $sql   = mysqli_fetch_assoc($query);
            if (!empty($sql) && is_array($sql)) {
                $wo['incall']                 = $sql;
                $wo['incall']['in_call_user'] = Wo_UserData($sql['to_id']);
                if ($wo['incall']['to_id'] == $wo['user']['user_id']) {
                    $wo['incall']['user']         = 1;
                    $wo['incall']['access_token'] = $wo['incall']['access_token'];
                } else if ($wo['incall']['from_id'] == $wo['user']['user_id']) {
                    $wo['incall']['user']         = 2;
                    $wo['incall']['access_token'] = $wo['incall']['access_token_2'];
                }
                $user_1               = Wo_UserData($wo['incall']['from_id']);
                $user_2               = Wo_UserData($wo['incall']['to_id']);
                $wo['incall']['room'] = $user_1['username'] . '_' . $user_2['username'];
                $data['calls_html']   = Wo_LoadPage('modals/talking');
            }
        } else {
            $check_declined = Wo_CheckAudioCallAnswerDeclined($_GET['id']);
            if ($check_declined) {
                $data = array(
                    'status' => 400,
                    'text_call_declined' => $wo['lang']['call_declined'],
                    'text_call_declined_desc' => $wo['lang']['call_declined_desc']
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_for_answer') {
    if (!empty($_GET['id'])) {
        $selectData = Wo_CheckCallAnswer($_GET['id']);
        if ($selectData !== false) {
            $data = array(
                'status' => 200,
                'url' => $selectData['url'],
                'text_answered' => $wo['lang']['answered'],
                'text_please_wait' => $wo['lang']['please_wait']
            );
        } else {
            $check_declined = Wo_CheckCallAnswerDeclined($_GET['id']);
            if ($check_declined) {
                $data = array(
                    'status' => 400,
                    'text_call_declined' => $wo['lang']['call_declined'],
                    'text_call_declined_desc' => $wo['lang']['call_declined_desc']
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'answer_call') {
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        $id = Wo_Secure($_GET['id']);
        if ($_GET['type'] == 'audio') {
            $query = mysqli_query($sqlConnect, "UPDATE " . T_AUDIO_CALLES . " SET `active` = 1 WHERE `id` = '$id'");
        } else {
            $query = mysqli_query($sqlConnect, "UPDATE " . T_VIDEOS_CALLES . " SET `active` = 1 WHERE `id` = '$id'");
        }
        if ($query) {
            $data = array(
                'status' => 200
            );
            if ($_GET['type'] == 'audio') {
                $query = mysqli_query($sqlConnect, "SELECT * FROM " . T_AUDIO_CALLES . " WHERE `id` = '{$id}'");
                $sql   = mysqli_fetch_assoc($query);
                if (!empty($sql) && is_array($sql)) {
                    $wo['incall']                 = $sql;
                    $wo['incall']['in_call_user'] = Wo_UserData($sql['from_id']);
                    if ($wo['incall']['to_id'] == $wo['user']['user_id']) {
                        $wo['incall']['user']         = 1;
                        $wo['incall']['access_token'] = $wo['incall']['access_token'];
                    } else if ($wo['incall']['from_id'] == $wo['user']['user_id']) {
                        $wo['incall']['user']         = 2;
                        $wo['incall']['access_token'] = $wo['incall']['access_token_2'];
                    }
                    $user_1               = Wo_UserData($wo['incall']['from_id']);
                    $user_2               = Wo_UserData($wo['incall']['to_id']);
                    $wo['incall']['room'] = $user_1['username'] . '_' . $user_2['username'];
                    $data['calls_html']   = Wo_LoadPage('modals/talking');
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'decline_call') {
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        $id = Wo_Secure($_GET['id']);
        if ($_GET['type'] == 'video') {
            $query = mysqli_query($sqlConnect, "UPDATE " . T_VIDEOS_CALLES . " SET `declined` = '1' WHERE `id` = '$id'");
        } else {
            $query = mysqli_query($sqlConnect, "UPDATE " . T_AUDIO_CALLES . " SET `declined` = '1' WHERE `id` = '$id'");
        }
        if ($query) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'close_call') {
    if (!empty($_GET['id'])) {
        $id    = Wo_Secure($_GET['id']);
        $query = mysqli_query($sqlConnect, "UPDATE " . T_AUDIO_CALLES . " SET `declined` = '1' WHERE `id` = '$id'");
        if ($query) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'cancel_call') {
    $user_id = Wo_Secure($wo['user']['user_id']);
    $query   = mysqli_query($sqlConnect, "DELETE FROM " . T_VIDEOS_CALLES . " WHERE `from_id` = '$user_id'");
    if ($query) {
        $data = array(
            'status' => 200
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'get_no_posts_name') {
    $data = array(
        'name' => $wo['lang']['no_more_posts']
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'products') {
    if ($s == 'create' && Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['name']) || empty($_POST['category']) || empty($_POST['description'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else if (empty($_POST['price'])) {
            $errors[] = $error_icon . $wo['lang']['please_choose_price'];
        } else if (!is_numeric($_POST['price'])) {
            $errors[] = $error_icon . $wo['lang']['please_choose_c_price'];
        } else if ($_POST['price'] == '0.00') {
            $errors[] = $error_icon . $wo['lang']['please_choose_price'];
        } else if (empty($_FILES['postPhotos']['name'])) {
            $errors[] = $error_icon . $wo['lang']['please_upload_image'];
        }
        if (isset($_FILES['postPhotos']['name'])) {
            $allowed = array(
                'gif',
                'png',
                'jpg',
                'jpeg'
            );
            for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                $new_string = pathinfo($_FILES['postPhotos']['name'][$i]);
                if (!in_array(strtolower($new_string['extension']), $allowed)) {
                    $errors[] = $error_icon . $wo['lang']['please_check_details'];
                }
            }
        }
        $type = 0;
        if (!empty($_POST['type'])) {
            $type = 1;
        }
        $currency = 0;
        if (isset($_POST['currency'])) {
            if (in_array($_POST['currency'], array_keys($wo['currencies']))) {
                $currency = Wo_Secure($_POST['currency']);
            }
        }
        if (empty($errors)) {
            $price              = Wo_Secure($_POST['price']);
            $product_data_array = array(
                'user_id' => $wo['user']['user_id'],
                'name' => Wo_Secure($_POST['name']),
                'category' => Wo_Secure($_POST['category']),
                'description' => Wo_Secure($_POST['description']),
                'time' => Wo_Secure(time()),
                'price' => $price,
                'type' => $type,
                'location' => Wo_Secure($_POST['location']),
                'currency' => $currency,
                'active' => 1
            );
            $product_data       = Wo_RegisterProduct($product_data_array);
            $product_id         = 0;
            if (!$product_data) {
                $errors[] = $error_icon . $wo['lang']['please_check_details'];
                header("Content-type: application/json");
                echo json_encode(array(
                    'errors' => $errors
                ));
                exit();
            }
            $product_id = $product_data;
            $post_data  = array(
                'user_id' => Wo_Secure($wo['user']['user_id']),
                'product_id' => Wo_Secure($product_id),
                'postPrivacy' => Wo_Secure(0),
                'time' => time()
            );
            $id         = Wo_RegisterPost($post_data);
            if (count($_FILES['postPhotos']['name']) > 0 && !empty($id) && $id > 0) {
                for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                    $fileInfo = array(
                        'file' => $_FILES["postPhotos"]["tmp_name"][$i],
                        'name' => $_FILES['postPhotos']['name'][$i],
                        'size' => $_FILES["postPhotos"]["size"][$i],
                        'type' => $_FILES["postPhotos"]["type"][$i],
                        'types' => 'jpg,png,jpeg,gif'
                    );
                    $file     = Wo_ShareFile($fileInfo, 1);
                    if (!empty($file)) {
                        $media_album = Wo_RegisterProductMedia($product_id, $file['filename']);
                    }
                }
            }
            $data = array(
                'status' => 200,
                'href' => Wo_SeoLink('index.php?link1=post&id=' . $id)
            );
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
    if ($s == 'edit' && Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['name']) || empty($_POST['category']) || empty($_POST['description'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else if (empty($_POST['price'])) {
            $errors[] = $error_icon . $wo['lang']['please_choose_price'];
        } else if (!is_numeric($_POST['price'])) {
            $errors[] = $error_icon . $wo['lang']['please_choose_c_price'];
        } else if ($_POST['price'] == '0.00') {
            $errors[] = $error_icon . $wo['lang']['please_choose_price'];
        }
        if (isset($_FILES['postPhotos']['name'])) {
            $allowed = array(
                'gif',
                'png',
                'jpg',
                'jpeg'
            );
            for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                $new_string = pathinfo($_FILES['postPhotos']['name'][$i]);
                if (!in_array(strtolower($new_string['extension']), $allowed)) {
                    $errors[] = $error_icon . $wo['lang']['please_check_details'];
                }
            }
        }
        $type = 0;
        if (!empty($_POST['type'])) {
            $type = 1;
        }
        $currency = 0;
        if (isset($_POST['currency'])) {
            if (in_array($_POST['currency'], array_keys($wo['currencies']))) {
                $currency = Wo_Secure($_POST['currency']);
            }
        }
        if (empty($errors)) {
            $price              = Wo_Secure($_POST['price']);
            $product_data_array = array(
                'name' => $_POST['name'],
                'category' => $_POST['category'],
                'description' => $_POST['description'],
                'price' => $price,
                'location' => Wo_Secure($_POST['location']),
                'type' => $type,
                'currency' => $currency
            );
            $product_data       = Wo_UpdateProductData($_POST['product_id'], $product_data_array);
            $product_id         = $_POST['product_id'];
            if (!$product_data) {
                $errors[] = $error_icon . $wo['lang']['please_check_details'];
                header("Content-type: application/json");
                echo json_encode(array(
                    'errors' => $errors
                ));
                exit();
            }
            $id = Wo_GetPostIDFromProdcutID($product_id);
            if (isset($_FILES['postPhotos']['name'])) {
                if (count($_FILES['postPhotos']['name']) > 0 && !empty($id) && $id > 0) {
                    for ($i = 0; $i < count($_FILES['postPhotos']['name']); $i++) {
                        $fileInfo = array(
                            'file' => $_FILES["postPhotos"]["tmp_name"][$i],
                            'name' => $_FILES['postPhotos']['name'][$i],
                            'size' => $_FILES["postPhotos"]["size"][$i],
                            'type' => $_FILES["postPhotos"]["type"][$i],
                            'types' => 'jpg,png,jpeg,gif'
                        );
                        $file     = Wo_ShareFile($fileInfo, 1);
                        if (!empty($file)) {
                            $media_album = Wo_RegisterProductMedia($product_id, $file['filename']);
                        }
                    }
                }
            }
            $data = array(
                'status' => 200,
                'href' => Wo_SeoLink('index.php?link1=post&id=' . $id)
            );
        }
        header("Content-type: application/json");
        if (isset($errors)) {
            echo json_encode(array(
                'errors' => $errors
            ));
        } else {
            echo json_encode($data);
        }
        exit();
    }
}
if ($f == 'search_products') {
    $html  = '';
    $array = array(
        'limit' => 15
    );
    if (!empty($_POST['c_id'])) {
        $array['c_id'] = Wo_Secure($_POST['c_id']);
    }
    if (!empty($_POST['value'])) {
        $array['keyword'] = $_POST['value'];
    }
    $result = Wo_GetProducts($array);
    foreach ($result as $key => $wo['product']) {
        $html .= Wo_LoadPage('products/products-list');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'load_more_products') {
    $html  = '';
    $array = array(
        'limit' => 10
    );
    if (!empty($_POST['c_id'])) {
        $array['c_id'] = Wo_Secure($_POST['c_id']);
    }
    if (!empty($_POST['last_id'])) {
        $array['after_id'] = $_POST['last_id'];
    }
    $result = Wo_GetProducts($array);
    foreach ($result as $key => $wo['product']) {
        $html .= Wo_LoadPage('products/products-list');
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'vote_up') {
    if (!empty($_GET['id']) && Wo_CheckMainSession($hash_id) === true) {
        $post_id = Wo_GetPostIDFromOptionID($_GET['id']);
        if (Wo_IsPostVoted($post_id, $wo['user']['user_id'])) {
            $data = array(
                'status' => 400,
                'text' => $wo['lang']['you_have_already_voted']
            );
            header("Content-type: application/json");
            echo json_encode($data);
            exit();
        } else {
            $vote = Wo_VoteUp($_GET['id'], $wo['user']['user_id']);
            if ($vote) {
                $data = array(
                    'status' => 200,
                    'votes' => Ju_GetPercentageOfOptionPost($post_id)
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'upload_image') {
    if (isset($_FILES['image']['name'])) {
        $fileInfo = array(
            'file' => $_FILES["image"]["tmp_name"],
            'name' => $_FILES['image']['name'],
            'size' => $_FILES["image"]["size"],
            'type' => $_FILES["image"]["type"]
        );
        $media    = Wo_ShareFile($fileInfo);
        if (!empty($media)) {
            $mediaFilename    = $media['filename'];
            $mediaName        = $media['name'];
            $_SESSION['file'] = $mediaFilename;
            $data          = array(
                'status' => 200,
                'image' => Wo_GetMedia($mediaFilename),
                'image_src' => $mediaFilename
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'request_payment') {
    if (Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['paypal_email']) || empty($_POST['amount'])) {
            $errors[] = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (Wo_IsUserPaymentRequested($wo['user']['user_id']) === true) {
                $errors[] = $error_icon . $wo['lang']['you_have_pending_request'];
            } else if (!filter_var($_POST['paypal_email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = $error_icon . $wo['lang']['email_invalid_characters'];
            } else if (!is_numeric($_POST['amount'])) {
                $errors[] = $error_icon . $wo['lang']['invalid_amount_value'];
            } else if (($wo['user']['balance'] < $_POST['amount'])) {
                $errors[] = $error_icon . $wo['lang']['invalid_amount_value_your'] . ' $' . $wo['user']['balance'];
            } else if ($wo['config']['m_withdrawal'] > $_POST['amount']) {
                $errors[] = $error_icon . $wo['lang']['invalid_amount_value_withdrawal'] . ' $' . $wo['config']['m_withdrawal'];
            }
            if (empty($errors)) {
                $userU          = Wo_UpdateUserData($wo['user']['user_id'], array(
                    'paypal_email' => $_POST['paypal_email']
                ));
                $insert_payment = Wo_RequestNewPayment($wo['user']['user_id'], $_POST['amount']);
                if ($insert_payment) {
                    $update_balance = Wo_UpdateBalance($wo['user']['user_id'], $_POST['amount'], '-');
                    $data           = array(
                        'status' => 200,
                        'message' => $success_icon . $wo['lang']['you_request_sent']
                    );
                }
            }
        }
    }
    header("Content-type: application/json");
    if (isset($errors)) {
        echo json_encode(array(
            'errors' => $errors
        ));
    } else {
        echo json_encode($data);
    }
    exit();
}
if ($f == 'turn-off-sound') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $num     = 0;
        $message = '<i class="fa fa-volume-up progress-icon" data-icon="volume-up"></i> ' . $wo['lang']['turn_off_notification'] . '</span>';
        if ($wo['user']['notifications_sound'] == 0) {
            $num     = 1;
            $message = '<i class="fa fa-volume-off progress-icon" data-icon="volume-off"></i> ' . $wo['lang']['turn_on_notification'] . '</span>';
        }
        $update = Wo_UpdateUserData($wo['user']['user_id'], array(
            'notifications_sound' => $num
        ));
        if ($update) {
            $data = array(
                'status' => 200,
                'message' => $message
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_order_by') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $type = 0;
        if ($_GET['type'] == 1) {
            $type = 1;
        }
        $update = Wo_UpdateUserData($wo['user']['user_id'], array(
            'order_posts_by' => $type
        ));
        if ($update) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'check_for_updates') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false
            )
        );
        if (!empty($_GET['purchase_code'])) {
            $purchase_code = Wo_Secure($_GET['purchase_code']);
            $version       = Wo_Secure($wo['script_version']);
            $siteurl       = urlencode($_SERVER['SERVER_NAME']);
            $file          = file_get_contents("http://www.wowonder.com/check_for_updates.php?code={$purchase_code}&version=$version&url=$siteurl", false, stream_context_create($arrContextOptions));
            $check         = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    if (!empty($check['versions'])) {
                        $data['status']         = 200;
                        $data['script_version'] = $wo['script_version'];
                        $data['versions']       = $check['versions'];
                    } else {
                        $data['status'] = 300;
                    }
                } else {
                    $data['status']     = 400;
                    $data['ERROR_NAME'] = $check['ERROR_NAME'];
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'download_updates') {
    if (Wo_CheckMainSession($hash_id) === true) {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false
            )
        );
        if (!empty($_GET['purchase_code'])) {
            $purchase_code = Wo_Secure($_GET['purchase_code']);
            $version       = Wo_Secure($wo['script_version']);
            $siteurl       = urlencode($_SERVER['SERVER_NAME']);
            $file          = file_get_contents("http://www.wowonder.com/check_for_updates.php?code={$purchase_code}&version=$version&full=true&url=$siteurl", false, stream_context_create($arrContextOptions));
            $check         = json_decode($file, true);
            if (!empty($check['status'])) {
                if ($check['status'] == 'SUCCESS') {
                    if (!empty($check['versions'])) {
                        foreach ($check['versions'] as $key => $version) {
                            if (!file_exists('updates/' . $version)) {
                                @mkdir('updates/' . $version, 0777, true);
                            }
                            if (!file_exists("updates/index.html")) {
                                $f = @fopen("updates/index.html", "a+");
                                @fwrite($f, "");
                                @fclose($f);
                            }
                            if (!file_exists('updates/.htaccess')) {
                                $f = @fopen("updates/.htaccess", "a+");
                                @fwrite($f, "deny from all\nOptions -Indexes");
                                @fclose($f);
                            }
                            if (!file_exists('updates/index.html')) {
                                $f = @fopen("updates/index.html", "a+");
                                @fwrite($f, "");
                                @fclose($f);
                            }
                            $updater = file_put_contents('updates/' . $version . '/script.zip', file_get_contents("https://www.wowonder.com/get_update.php?code={$purchase_code}&version=$version&full=true", false, stream_context_create($arrContextOptions)));
                            if ($updater) {
                                $unzip_file = unzip_file('updates/' . $version . '/script.zip', 'updates/' . $version . '/');
                                if ($unzip_file) {
                                    $data['status'] = 200;
                                    unlink('updates/' . $version . '/script.zip');
                                }
                            } else {
                                $data['ERROR_NAME'] = 'Error found while downloading, please download & update your site manually from Envato market.';
                                $data['status']     = 400;
                            }
                        }
                    }
                } else {
                    $data['status']     = 400;
                    $data['ERROR_NAME'] = $check['ERROR_NAME'];
                }
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "insert-blog") {
    if (Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['blog_title']) || empty($_POST['blog_content']) || empty($_POST['blog_description'])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['blog_title']) < 10) {
                $error = $error_icon . $wo['lang']['title_more_than10'];
            }
            if (strlen($_POST['blog_description']) < 32) {
                $error = $error_icon . $wo['lang']['desc_more_than32'];
            }
            if (empty($_POST['blog_tags'])) {
                $error = $error_icon . $wo['lang']['please_fill_tags'];
            }
            if (!in_array($_POST['blog_category'], array_keys($wo['page_categories']))) {
                $error = $error_icon . $wo['lang']['error_found'];
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'user' => $wo['user']['id'],
                'title' => Wo_Secure($_POST['blog_title']),
                'content' => Wo_Secure($_POST['blog_content'], 0, false),
                'description' => substr(Wo_Secure($_POST['blog_description']), 0, 290),
                'posted' => time(),
                'category' => Wo_Secure($_POST['blog_category']),
                'tags' => Wo_Secure($_POST['blog_tags'])
            );
            $last_id           = Wo_InsertBlog($registration_data);
            if ($last_id && is_numeric($last_id)) {
                if (!empty($_FILES["thumbnail"]["tmp_name"])) {
                    $fileInfo      = array(
                        'file' => $_FILES["thumbnail"]["tmp_name"],
                        'name' => $_FILES['thumbnail']['name'],
                        'size' => $_FILES["thumbnail"]["size"],
                        'type' => $_FILES["thumbnail"]["type"],
                        'types' => 'jpg,png,bmp,gif',
                        'crop' => array(
                            'width' => 600,
                            'height' => 380
                        )
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    Wo_UpdateBlog($last_id, array(
                        "thumbnail" => $mediaFilename
                    ));
                }
                $tags     = '';
                $tags_all = explode(',', $_POST['blog_tags']);
                foreach ($tags_all as $key => $tag) {
                    $tags .= "#$tag ";
                }
                $register = Wo_RegisterPost(array(
                    'user_id' => Wo_Secure($wo['user']['user_id']),
                    'blog_id' => Wo_Secure($last_id),
                    'postText' =>  Wo_Secure($_POST['blog_title']) . ' | ' . $tags,
                    'time' => time(),
                    'postPrivacy' => '0'
                ));
                if ($register) {
                    $data = array(
                        'message' => $success_icon . $wo['lang']['article_added'],
                        'status' => 200,
                        'url' => Wo_SeoLink('index.php?link1=read-blog&id=' . $last_id)
                    );
                }
            }
        } else {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "update-blog") {
    if (Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['blog_title']) || empty($_POST['blog_content']) || empty($_POST['blog_description'])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['blog_title']) < 10) {
                $error = $error_icon . $wo['lang']['title_more_than10'];
            }
            if (strlen($_POST['blog_description']) < 32) {
                $error = $error_icon . $wo['lang']['desc_more_than32'];
            }
            if (empty($_POST['blog_tags'])) {
                $error = $error_icon . $wo['lang']['please_fill_tags'];
            }
            if (!in_array($_POST['blog_category'], array_keys($wo['page_categories']))) {
                $error = $error_icon . $wo['lang']['error_found'];
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'user' => $wo['user']['id'],
                'title' => $_POST['blog_title'],
                'content' => $_POST['blog_content'],
                'description' => $_POST['blog_description'],
                'category' => $_POST['blog_category'],
                'tags' => $_POST['blog_tags']
            );
            if (Wo_UpdateBlog($_GET['blog_id'], $registration_data)) {
                if (isset($_FILES["thumbnail"])) {
                    $fileInfo           = array(
                        'file' => $_FILES["thumbnail"]["tmp_name"],
                        'name' => $_FILES['thumbnail']['name'],
                        'size' => $_FILES["thumbnail"]["size"],
                        'type' => $_FILES["thumbnail"]["type"],
                        'types' => 'jpg,png,bmp,gif',
                        'crop' => array(
                            'width' => 600,
                            'height' => 380
                        )
                    );
                    $media              = Wo_ShareFile($fileInfo);
                    $mediaFilename      = $media['filename'];
                    $image              = array();
                    $image['user']      = $wo['user']['user_id'];
                    $image['thumbnail'] = $mediaFilename;
                    Wo_UpdateBlog($_GET['blog_id'], $image);
                }
                $data = array(
                    'message' => $success_icon . $wo['lang']['article_updated'],
                    'status' => 200,
                    'url' => Wo_SeoLink('index.php?link1=read-blog&id=' . $_GET['blog_id'])
                );
            }
        } else {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-my-blogs") {
    $html  = '';
    $blogs = Wo_GetMyBlogs($wo['user']['id'], $_GET['offset']);
    if (count($blogs) > 0) {
        foreach ($blogs as $key => $wo['blog']) {
            $html .= Wo_LoadPage('blog/blog-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-blogs") {
    $html   = '';
    $id     = (isset($_GET['id'])) ? $_GET['id'] : false;
    $offset = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $blogs  = Wo_GetBlogs(array(
        "category" => $id,
        "offset" => $offset
    ));
    if (count($blogs) > 0) {
        foreach ($blogs as $key => $wo['blog']) {
            $html .= Wo_LoadPage('blog/blog-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-recent-blogs") {
    $html   = '';
    $id     = (isset($_GET['id'])) ? $_GET['id'] : false;
    $offset = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $total  = (isset($_GET['total'])) ? $_GET['total'] : 10;
    $blogs  = Wo_GetBlogs(array(
        "category" => $id,
        "offset" => $offset,
        "limit" => $total
    ));
    if (count($blogs) > 0) {
        foreach ($blogs as $key => $wo['article']) {
            $html .= Wo_LoadPage('blog/blog-h-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-my-blog") {
    if (Wo_CheckMainSession($hash_id) === true) {
        if (isset($_GET['id'])) {
            $id = Wo_Secure($_GET['id']);
        }
        $result         = Wo_DeleteMyBlog($id);
        $data['status'] = 404;
        if ($result) {
            $data = array(
                'status' => 200,
                "id" => $id
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "search-art") {
    $category = (isset($_GET['cat'])) ? $_GET['cat'] : false;
    $keyword  = (isset($_GET['keyword'])) ? Wo_Secure($_GET['keyword']) : false;
    $result   = Wo_SearchBlogs(array(
        "keyword" => $keyword,
        "category" => $category
    ));
    $status   = 404;
    $html     = "";
    if ($result && count($result) > 0) {
        foreach ($result as $wo['blog']) {
            $html .= Wo_LoadPage('blog/blog-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 200,
            "warning" => $wo['lang']['no_blogs_found']
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-comm") {
    $html = "";
    if (isset($_POST['text']) && isset($_POST['blog']) && is_numeric(($_POST['blog'])) && strlen($_POST['text']) > 2) {
        $registration_data = array(
            'blog_id' => Wo_Secure($_POST['blog']),
            'user_id' => $wo['user']['id'],
            'text' => Wo_Secure($_POST['text']),
            'posted' => time()
        );
        $lastId            = Wo_RegisterBlogComment($registration_data);
        if ($lastId && is_numeric($lastId)) {
            $comment = Wo_GetBlogComments(array(
                'id' => $lastId
            ));
            if ($comment && count($comment) > 0) {
                foreach ($comment as $wo['comment']) {
                    $html .= Wo_LoadPage('blog/comment-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'comments' => Wo_GetBlogCommentsCount($_POST['blog'])
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-commreply") {
    $html = "";
    if (isset($_POST['text']) && isset($_POST['c_id']) && is_numeric(($_POST['c_id'])) && strlen($_POST['text']) > 2 && isset($_POST['b_id']) && is_numeric($_POST['b_id'])) {
        $registration_data = array(
            'comm_id' => Wo_Secure($_POST['c_id']),
            'blog_id' => Wo_Secure($_POST['b_id']),
            'user_id' => $wo['user']['id'],
            'text' => Wo_Secure($_POST['text']),
            'posted' => time()
        );
        $lastId            = Wo_RegisterBlogCommentReply($registration_data);
        if ($lastId && is_numeric($lastId)) {
            $comment = Wo_GetBlogCommentReplies(array(
                'id' => $lastId
            ));
            if ($comment && count($comment) > 0) {
                foreach ($comment as $wo['comm-reply']) {
                    $html .= Wo_LoadPage('blog/commreplies-list');
                }
                $data = array(
                    'status' => 200,
                    'html' => $html,
                    'comments' => Wo_GetBlogCommentsCount($_POST['b_id'])
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "del-blog-comment") {
    $data = array(
        'status' => 304
    );
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['b_id']) && is_numeric($_GET['b_id'])) {
        if (Wo_DeleteBlogComment($_GET['id'], $_GET['b_id'])) {
            $data['status']   = 200;
            $data['comments'] = Wo_GetBlogCommentsCount($_GET['b_id']);
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "del-blog-commreplies") {
    $data = array(
        'status' => 304
    );
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['b_id']) && is_numeric($_GET['b_id'])) {
        if (Wo_DeleteBlogCommReply($_GET['id'], $_GET['b_id'])) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-commlikes") {
    $data = array(
        'status' => 304
    );
    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['blog_id']) && is_numeric($_POST['blog_id'])) {
        $blogCommentLikes = Wo_AddBlogCommentLikes($_POST['id'], $_POST['blog_id']);
        $likes            = Wo_GetBlogCommLikes($_POST['id']);
        $dislikes         = Wo_GetBlogCommDisLikes($_POST['id']);
        if ($blogCommentLikes == true) {
            $data['status']   = 200;
            $data['likes']    = ($likes > 0) ? $likes : '';
            $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-commdislikes") {
    $data = array(
        'status' => 304
    );
    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['blog_id']) && is_numeric($_POST['blog_id'])) {
        $blogCommentDisLikes = Wo_AddBlogCommentDisLikes($_POST['id'], $_POST['blog_id']);
        $likes               = Wo_GetBlogCommLikes($_POST['id']);
        $dislikes            = Wo_GetBlogCommDisLikes($_POST['id']);
        if ($blogCommentDisLikes == true) {
            $data['status']   = 200;
            $data['likes']    = ($likes > 0) ? $likes : '';
            $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-crlikes") {
    $data = array(
        'status' => 304
    );
    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['blog_id']) && is_numeric($_POST['blog_id'])) {
        if (Wo_AddBlogCommReplyLikes($_POST['id'], $_POST['blog_id'])) {
            $likes            = Wo_GetBlogCommReplyLikes($_POST['id']);
            $dislikes         = Wo_GetBlogCommReplyDisLikes($_POST['id']);
            $data['status']   = 200;
            $data['likes']    = ($likes > 0) ? $likes : '';
            $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-blog-crdislikes") {
    $data = array(
        'status' => 304
    );
    if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['blog_id']) && is_numeric($_POST['blog_id'])) {
        if (Wo_AddBlogCommReplyDisLikes($_POST['id'], $_POST['blog_id'])) {
            $likes            = Wo_GetBlogCommReplyLikes($_POST['id']);
            $dislikes         = Wo_GetBlogCommReplyDisLikes($_POST['id']);
            $data['status']   = 200;
            $data['likes']    = ($likes > 0) ? $likes : '';
            $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-blog-comments") {
    $html = '';
    $data = array(
        'status' => 404,
        'html' => $wo['lang']['no_result']
    );
    if (isset($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] > 0 && isset($_GET['b_id']) && is_numeric($_GET['b_id'])) {
        $comments = Wo_GetBlogComments(array(
            "b_id" => $_GET['b_id'],
            "offset" => $_GET['offset']
        ));
        if (count($comments)) {
            foreach ($comments as $wo['comment']) {
                $html .= Wo_LoadPage('blog/comment-list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "search-forums") {
    $keyword = (isset($_GET['keyword'])) ? Wo_Secure($_GET['keyword']) : false;
    $result  = Wo_GetForumSec(array(
        "keyword" => $keyword,
        "search" => true,
        "forums" => true
    ));
    $html    = "";
    $data    = array(
        'status' => 404,
        'html' => $wo['lang']['no_forums_found']
    );
    if ($result && count($result) > 0) {
        foreach ($result as $wo['section']) {
            $html .= trim(Wo_LoadPage('forum/includes/section-list'));
        }
        $data['html']   = $html;
        $data['status'] = 200;
    }
    if (!$html) {
        $data['html']   = $wo['lang']['no_forums_found'];
        $data['status'] = 404;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "search-forum-mbrs") {
    $keyword = (isset($_GET['keyword'])) ? Wo_Secure($_GET['keyword']) : false;
    $result  = Wo_GetForumUsers(array(
        "name" => $keyword
    ));
    $html    = "";
    $data    = array(
        'status' => 404,
        'html' => $wo['lang']['no_members_found']
    );
    if ($result && count($result) > 0) {
        foreach ($result as $wo['member']) {
            $html .= trim(Wo_LoadPage('forum/includes/mbr-list'));
        }
        $data['html']   = $html;
        $data['status'] = 200;
    } else {
        $data['html']   = $wo['lang']['no_members_found'];
        $data['status'] = 404;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "forum-thread-search") {
    $keyword = (isset($_GET['keyword'])) ? Wo_Secure($_GET['keyword']) : false;
    $fid     = (isset($_GET['fid'])) ? Wo_Secure($_GET['fid']) : false;
    if ($fid && is_numeric($fid)) {
        $threads = Wo_GetForumThreads(array(
            "forum" => $fid,
            "subject" => $keyword,
            "search" => true,
            "order_by" => "DESC"
        ));
        $html    = "";
        $data    = array(
            'status' => 404,
            'html' => $wo['lang']['no_threads_found']
        );
        if ($threads && count($threads) > 0) {
            foreach ($threads as $wo['thread']) {
                $html .= trim(Wo_LoadPage('forum/includes/post-list'));
            }
            $data['html']   = $html;
            $data['status'] = 200;
        }
    } else {
        $data['html']   = $wo['lang']['no_threads_found'];
        $data['status'] = 404;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "forum-messages-search") {
    $keyword = (isset($_GET['keyword'])) ? Wo_Secure($_GET['keyword']) : false;
    $tid     = (isset($_GET['tid'])) ? Wo_Secure($_GET['tid']) : false;
    if ($tid) {
        $messages = Wo_SearchThreadReplies(array(
            "thread_id" => $tid,
            "reply" => $keyword
        ));
        $html     = "";
        $data     = array(
            'status' => 404,
            'html' => $wo['lang']['no_threads_found']
        );
        if ($messages && count($messages) > 0) {
            foreach ($messages as $wo['threadreply']) {
                $html .= trim(Wo_LoadPage('forum/includes/threadreply-list'));
            }
            $data['html']   = $html;
            $data['status'] = 200;
        }
    } else {
        $data['html']   = $wo['lang']['no_threads_found'];
        $data['status'] = 404;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "forum-mbrs-load") {
    $html    = '';
    $offset  = (isset($_GET['offset'])) ? $_GET['offset'] : 0;
    $members = Wo_GetForumUsers(array(
        "offset" => $offset
    ));
    if (count($members) > 0) {
        foreach ($members as $wo['member']) {
            $html .= Wo_LoadPage('forum/includes/mbr-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "addtopic" && Wo_CheckMainSession($hash_id) === true) {
    if (empty($_POST['headline']) || empty($_POST['topicpost'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['fid']) || !is_numeric($_GET['fid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['headline']) < 10) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
        if (strlen($_POST['topicpost']) < 32) {
            $error = $error_icon . $wo['lang']['desc_more_than32'];
        }
    }
    if (empty($error)) {
        $registration_data = array(
            'user' => $wo['user']['id'],
            'views' => 0,
            'headline' => Wo_Secure($_POST['headline']),
            'post' => Wo_Secure($_POST['topicpost']),
            'posted' => time(),
            'forum' => Wo_Secure($_GET['fid'])
        );
        if (Wo_AddTopic($registration_data)) {
            $data = array(
                'message' => $success_icon . $wo['lang']['forum_post_added'],
                'status' => 200,
                'url' => Wo_SeoLink('index.php?link1=forums&fid=' . $_GET['fid'])
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "new-forum-section" && Wo_IsAdmin() == true) {
    if (empty($_POST['name']) || empty($_POST['description'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['name']) < 5) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
        if (strlen($_POST['name']) > 145) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        }
        if (strlen($_POST['description']) < 5) {
            $error = $error_icon . $wo['lang']['desc_more_than32'];
        }
    }
    if (empty($error)) {
        $registration_data = array(
            'section_name' => Wo_Secure($_POST['name']),
            'description' => Wo_Secure($_POST['description'])
        );
        if (Wo_AddForumSection($registration_data)) {
            $data = array(
                'message' => $success_icon . $wo['lang']['forum_post_added'],
                'status' => 200
            );
        } else {
            $data = array(
                'status' => 500,
                'message' => $wo['lang']['please_check_details']
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "add-new-forum" && Wo_IsAdmin() == true && Wo_CheckSession($hash_id) === true) {
    if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['section'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['name']) < 5) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
        if (strlen($_POST['name']) > 100) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        }
        if (strlen($_POST['description']) < 5) {
            $error = $error_icon . $wo['lang']['desc_more_than32'];
        }
        if (strlen($_POST['description']) > 190) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        }
    }
    if (empty($error)) {
        $registration_data = array(
            'name' => Wo_Secure($_POST['name']),
            'description' => Wo_Secure($_POST['description']),
            'sections' => Wo_Secure($_POST['section'])
        );
        if (Wo_AddForum($registration_data)) {
            $data = array(
                'message' => $success_icon . $wo['lang']['forum_post_added'],
                'status' => 200
            );
        } else {
            $data = array(
                'status' => 500,
                'message' => $wo['lang']['please_check_details']
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "editopic" && Wo_CheckMainSession($hash_id) === true) {
    if (empty($_POST['headline']) || empty($_POST['topicpost'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['tid']) || !is_numeric($_GET['tid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['headline']) < 10) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
    }
    if (empty($error)) {
        $update_data = array(
            'headline' => Wo_Secure($_POST['headline']),
            'post' => Wo_BbcodeSecure($_POST['topicpost'])
        );
        if (Wo_UpdateTopic($_GET['tid'], $update_data)) {
            $data = array(
                'message' => $success_icon . $wo['lang']['forum_post_added'],
                'status' => 200,
                'url' => Wo_SeoLink('index.php?link1=showthread&tid=' . $_GET['tid'])
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "threadreply" && Wo_CheckMainSession($hash_id) === true) {
    if (empty($_POST['subject']) || empty($_POST['content'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['tid']) || !is_numeric($_GET['tid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['fid']) || !is_numeric($_GET['fid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['subject']) < 10) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
        if (strlen($_POST['content']) < 2) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        }
    }
    if (empty($error)) {
        $registration_data = array(
            'thread_id' => Wo_Secure($_GET['tid']),
            'forum_id' => Wo_Secure($_GET['fid']),
            'poster_id' => $wo['user']['id'],
            'post_subject' => Wo_Secure($_POST['subject']),
            'post_text' => Wo_BbcodeSecure($_POST['content']),
            'post_quoted' => Wo_Secure($_GET['q']),
            'posted_time' => time()
        );
        if (Wo_ThreadReply($registration_data)) {
            Wo_UpdateThreadLastPostTime($_GET['tid']);
            $data = array(
                'message' => $success_icon . $wo['lang']['reply_added'],
                'status' => 200,
                'url' => Wo_SeoLink('index.php?link1=showthread&tid=' . $_GET['tid'])
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "editreply" && Wo_CheckMainSession($hash_id) === true) {
    if (empty($_POST['subject']) || empty($_POST['content'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['rid']) || !is_numeric($_GET['rid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } elseif (!isset($_GET['tid']) || !is_numeric($_GET['tid'])) {
        $error = $error_icon . $wo['lang']['please_check_details'];
    } else {
        if (strlen($_POST['subject']) < 10) {
            $error = $error_icon . $wo['lang']['title_more_than10'];
        }
    }
    if (empty($error)) {
        $update_data = array(
            'post_subject' => Wo_Secure($_POST['subject']),
            'post_text' => Wo_BbcodeSecure($_POST['content'])
        );
        if (Wo_ThreadUpdate(Wo_Secure($_GET['rid']), $update_data)) {
            $data = array(
                'message' => $success_icon . $wo['lang']['reply_saved'],
                'status' => 200,
                'url' => Wo_SeoLink('index.php?link1=showthread&tid=' . $_GET['tid'])
            );
        }
    } else {
        $data = array(
            'status' => 500,
            'message' => $error
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "forum-posts-load" && Wo_CheckMainSession($hash_id) === true) {
    $html    = '';
    $fid     = (isset($_GET['forum'])) ? $_GET['forum'] : false;
    $offset  = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $threads = Wo_GetForumThreads(array(
        "forum" => $fid,
        "offset" => $offset
    ));
    if (count($threads) > 0) {
        foreach ($threads as $key => $wo['thread']) {
            $html .= Wo_LoadPage('forum/includes/post-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-thread-replies" && Wo_CheckMainSession($hash_id) === true) {
    $html    = '';
    $tid     = (isset($_GET['tid'])) ? $_GET['tid'] : false;
    $offset  = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $replies = Wo_GetThreadReplies(array(
        "thread_id" => $tid,
        "offset" => $offset,
        "limit" => 10
    ));
    if (count($replies) > 0) {
        foreach ($replies as $wo['threadreply']) {
            $html .= Wo_LoadPage('forum/includes/threadreply-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-my-thread-replies") {
    $html    = '';
    $offset  = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $replies = Wo_GetMyReplies(array(
        "offset" => $offset,
        "limit" => 10
    ));
    if (count($replies) > 0) {
        foreach ($replies as $wo['message']) {
            $html .= Wo_LoadPage('forum/includes/mymessage-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-my-forum-posts") {
    $html   = '';
    $offset = (isset($_GET['offset'])) ? $_GET['offset'] : false;
    $thrads = Wo_GetForumThreads(array(
        "offset" => $offset,
        "limit" => 10
    ));
    if (count($thrads) > 0) {
        foreach ($thrads as $key => $wo['thread']) {
            $html .= Wo_LoadPage('forum/includes/mythread-list');
        }
        $data = array(
            'status' => 200,
            'html' => $html
        );
    } else {
        $data = array(
            'status' => 404
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-forum-section" && Wo_CheckMainSession($hash_id) === true) {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (Wo_DeleteForumSection(Wo_Secure($_GET['id']))) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-forum" && Wo_CheckMainSession($hash_id) === true) {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (Wo_DeleteForum(Wo_Secure($_GET['id']))) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-reply" && Wo_CheckMainSession($hash_id) === true) {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (Wo_DeleteThreadReply(Wo_Secure($_GET['id']))) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-thread" && Wo_CheckMainSession($hash_id) === true) {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        if (Wo_DeleteForumThread(Wo_Secure($_GET['id']))) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "insert-event") {
    if (Wo_CheckSession($hash_id) === true) {
        if (empty($_POST['event-name']) || empty($_POST['event-locat']) || empty($_POST['event-description'])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['event-name']) < 10) {
                $error = $error_icon . $wo['lang']['title_more_than10'];
            }
            if (strlen($_POST['event-description']) < 10) {
                $error = $error_icon . $wo['lang']['desc_more_than32'];
            }
            if (empty($_POST['event-start-date'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-end-date'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-start-time'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-end-time'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['event-name']),
                'location' => Wo_Secure($_POST['event-locat']),
                'description' => Wo_Secure($_POST['event-description']),
                'start_date' => Wo_Secure($_POST['event-start-date']),
                'start_time' => Wo_Secure($_POST['event-start-time']),
                'end_date' => Wo_Secure($_POST['event-end-date']),
                'end_time' => Wo_Secure($_POST['event-end-time']),
                'poster_id' => $wo['user']['id']
            );
            $last_id           = Wo_InsertEvent($registration_data);
            if ($last_id && is_numeric($last_id)) {
                if (!empty($_FILES["event-cover"]["tmp_name"])) {
                    $temp_name = $_FILES["event-cover"]["tmp_name"];
                    $file_name = $_FILES["event-cover"]["name"];
                    $file_type = $_FILES['event-cover']['type'];
                    $file_size = $_FILES["event-cover"]["size"];
                    Wo_UploadImage($temp_name, $file_name, 'cover', $file_type, $last_id, 'event');
                }
                $data = array(
                    'message' => $success_icon . $wo['lang']['event_added'],
                    'status' => 200,
                    'url' => Wo_SeoLink("index.php?link1=show-event&eid=" . $last_id)
                );
            }
        } else {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "update-event") {
    if (true) {
        if (empty($_POST['event-name']) || empty($_POST['event-locat']) || empty($_POST['event-description'])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['event-name']) < 10) {
                $error = $error_icon . $wo['lang']['title_more_than10'];
            }
            if (strlen($_POST['event-description']) < 10) {
                $error = $error_icon . $wo['lang']['desc_more_than32'];
            }
            if (empty($_POST['event-start-date'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-end-date'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-start-time'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['event-end-time'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
        }
        if (empty($error) && isset($_GET['eid']) && is_numeric($_GET['eid'])) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['event-name']),
                'location' => Wo_Secure($_POST['event-locat']),
                'description' => Wo_Secure($_POST['event-description']),
                'start_date' => Wo_Secure($_POST['event-start-date']),
                'start_time' => Wo_Secure($_POST['event-start-time']),
                'end_date' => Wo_Secure($_POST['event-end-date']),
                'end_time' => Wo_Secure($_POST['event-end-time'])
            );
            $result            = Wo_UpdateEvent($_GET['eid'], $registration_data);
            if ($result) {
                if (!empty($_FILES["event-cover"]["tmp_name"])) {
                    $temp_name = $_FILES["event-cover"]["tmp_name"];
                    $file_name = $_FILES["event-cover"]["name"];
                    $file_type = $_FILES['event-cover']['type'];
                    $file_size = $_FILES["event-cover"]["size"];
                    Wo_UploadImage($temp_name, $file_name, 'cover', $file_type, $_GET['eid'], 'event');
                }
                $data = array(
                    'message' => $success_icon . $wo['lang']['event_saved'],
                    'status' => 200,
                    'url' => Wo_SeoLink("index.php?link1=show-event&eid=" . $_GET['eid'])
                );
            }
        } else {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "going-to-event") {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['eid']) && is_numeric($_GET['eid'])) {
        if (Wo_AddEventGoingUsers($_GET['eid'])) {
            $data['status'] = 200;
            $data['html']   = $wo['lang']['you_are_going'];
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "interested-in-event") {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['eid']) && is_numeric($_GET['eid'])) {
        if (Wo_AddEventInterestedUsers($_GET['eid'])) {
            $data['status'] = 200;
            $data['html']   = $wo['lang']['you_are_interested'];
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "notgoing-to-event") {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['eid']) && is_numeric($_GET['eid'])) {
        if (Wo_UnsetEventGoingUsers($_GET['eid'])) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "delete-event") {
    $data = array(
        'status' => 500
    );
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        if (Wo_DeleteEvent($_GET['id'])) {
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "load-more-events") {
    $html = "";
    $data = array(
        'status' => 404,
        "html" => $wo['lang']['no_result']
    );
    if (isset($_GET['offset']) && is_numeric($_GET['offset'])) {
        if ($s == "upcomming") {
            $events = Wo_GetEvents(array(
                "offset" => Wo_Secure($_GET['offset'])
            ));
            if (count($events) > 0) {
                foreach ($events as $wo['event']) {
                    $html .= Wo_LoadPage('events/includes/events-list');
                }
                $data = array(
                    'status' => 200,
                    "html" => $html
                );
            }
        } else if ($s == "going") {
            $events = Wo_GetGoingEvents(Wo_Secure($_GET['offset']));
            if (count($events) > 0) {
                foreach ($events as $wo['event']) {
                    $html .= Wo_LoadPage('events/includes/events-going-list');
                }
                $data = array(
                    'status' => 200,
                    "html" => $html
                );
            }
        } else if ($s == "invited") {
            $events = Wo_GetInvitedEvents(Wo_Secure($_GET['offset']));
            if (count($events) > 0) {
                foreach ($events as $wo['event']) {
                    $html .= Wo_LoadPage('events/includes/events-invited-list');
                }
                $data = array(
                    'status' => 200,
                    "html" => $html
                );
            }
        } else if ($s == "interested") {
            $events = Wo_GetInterestedEvents(Wo_Secure($_GET['offset']));
            if (count($events) > 0) {
                foreach ($events as $wo['event']) {
                    $html .= Wo_LoadPage('events/includes/events-interested-list');
                }
                $data = array(
                    'status' => 200,
                    "html" => $html
                );
            }
        } else if ($s == "past") {
            $events = Wo_GetPastEvents($_GET['offset']);
            if (count($events) > 0) {
                foreach ($events as $wo['event']) {
                    $html .= Wo_LoadPage('events/includes/events-past-list');
                }
                $data = array(
                    'status' => 200,
                    "html" => $html
                );
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'register_event_invite') {
    $data = array(
        'status' => 500
    );
    if (!empty($_GET['user_id']) && !empty($_GET['event_id'])) {
        $register_invite = Wo_RegsiterEventInvite($_GET['user_id'], $_GET['event_id']);
        if ($register_invite === true) {
            $data = array(
                'status' => 200
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "search-my-followers") {
    $html   = "";
    $data   = array(
        "status" => 404,
        "html" => $wo['lang']['no_result']
    );
    $filter = (isset($_GET['filter'])) ? Wo_Secure($_GET["filter"]) : false;
    if ($filter) {
        $users = Wo_SearchFollowers($wo['user']['id'], $filter, 10, $_GET['event_id']);
        if (count($users) > 0) {
            foreach ($users as $wo['user']) {
                $html .= Wo_LoadPage('events/includes/invitation-users-list');
            }
            $data = array(
                "status" => 200,
                "html" => $html
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "new-film") {
    if (Wo_IsAdmin() == true) {
        if (empty($_POST['name']) || empty($_POST['description']) || !isset($_FILES["cover"]["tmp_name"])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
            if (empty($_FILES["cover"]["tmp_name"]) || (!isset($_FILES["source"]["tmp_name"]) && empty($_POST['iframe']) && empty($_POST['other']))) {
                if (!empty($_FILES["cover"]["error"]) || !empty($_FILES["source"]["error"])) {
                    $error = $error_icon . 'The file is too big, please increase your server upload limit in php.ini';
                } else {
                    $error = $error_icon . $wo['lang']['please_check_details'];
                }
            }
        } else {
            if (strlen($_POST['name']) < 3) {
                $error = $error_icon . " Please enter a valid name";
            }
            if (empty($_POST['genre'])) {
                $error = $error_icon . " Please choose a genre";
            }
            if (empty($_POST['stars'])) {
                $error = $error_icon . "Please enter the names of the stars";
            }
            if (empty($_POST['producer'])) {
                $error = $error_icon . "Please enter the producer's name";
            }
            if (empty($_POST['country'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['quanlity'])) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if (empty($_POST['release']) || !is_numeric($_POST['release'])) {
                $error = $error_icon . "Please select movie release";
            }
            if (empty($_POST['duration']) || !is_numeric($_POST['duration'])) {
                $error = $error_icon . "Please select the duration of the movie";
            }
            if (strlen($_POST['description']) < 32) {
                $error = $error_icon . $wo['lang']['desc_more_than32'];
            }
            if (!isset($_FILES["source"]) && empty($_POST['iframe']) && empty($_POST['other'])) {
                $error = $error_icon . " Please select movie";
            }
            if (!file_exists($_FILES["cover"]["tmp_name"])) {
                $error = $error_icon . " Select the cover to the movie";
            }
        }
        if (!empty($_FILES["cover"]["tmp_name"])) {
            if (file_exists($_FILES["cover"]["tmp_name"])) {
                $cover = getimagesize($_FILES["cover"]["tmp_name"]);
                if ($cover[0] > 400 || $cover[1] > 570) {
                    $error = $error_icon . " Cover size should not be more than 400x570 ";
                }
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['name']),
                'genre' => Wo_Secure($_POST['genre']),
                'stars' => Wo_Secure($_POST['stars']),
                'producer' => Wo_Secure($_POST['producer']),
                'country' => Wo_Secure($_POST['country']),
                'release' => Wo_Secure($_POST['release']),
                'quality' => Wo_Secure($_POST['quanlity']),
                'duration' => Wo_Secure($_POST['duration']),
                'description' => Wo_Secure($_POST['description']),
                'iframe' => (!empty($_POST['iframe']) && Wo_IsUrl($_POST['iframe'])) ? $_POST['iframe'] : '',
                'video' => (!empty($_POST['other']) && Wo_IsUrl($_POST['other'])) ? $_POST['other'] : ''
            );
            $film_id           = Wo_InsertFilm($registration_data);
            if ($film_id && is_numeric($film_id)) {
                $update_film = array();
                if (!empty($_FILES["source"]["tmp_name"]) && empty($_POST['youtube']) && empty($_POST['other'])) {
                    $fileInfo              = array(
                        'file' => $_FILES["source"]["tmp_name"],
                        'name' => $_FILES['source']['name'],
                        'size' => $_FILES["source"]["size"],
                        'type' => $_FILES["source"]["type"],
                        'types' => 'mp4,mov,webm,flv'
                    );
                    $media                 = Wo_ShareFile($fileInfo);
                    $update_film['source'] = $media['filename'];
                }
                if (!empty($_FILES["cover"]["tmp_name"])) {
                    $fileInfo             = array(
                        'file' => $_FILES["cover"]["tmp_name"],
                        'name' => $_FILES['cover']['name'],
                        'size' => $_FILES["cover"]["size"],
                        'type' => $_FILES["cover"]["type"],
                        'types' => 'jpg,png,bmp,gif',
                        'compress' => false
                    );
                    $media                = Wo_ShareFile($fileInfo);
                    $update_film['cover'] = $media['filename'];
                }
                if (count($update_film) > 0) {
                    Wo_UpdateFilm($film_id, $update_film);
                    $data = array(
                        'status' => 200,
                        'message' => $success_icon . ' New movie was successfully added'
                    );
                }
            }
        } else {
            $data = array(
                'status' => 500,
                'message' => $error
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == "listen") {
    $t=$_GET['term'];
 $a_json = array();
$a_json_row = array();
$curl = curl_init();

curl_setopt_array($curl, array(
   CURLOPT_URL => "http://ws.audioscrobbler.com/2.0/?method=track.search&api_key=23557c599d35c9708c3b941c1abf4983&format=json&track=".$t,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  $my_array=json_decode($response);
 
 
   foreach ($my_array as $key=>$value){

	foreach ($value as $key1=>$value1){
	    foreach ($value1 as $key2=>$value2){
    
foreach ($value2 as $key3=>$value3){
    foreach ($value3->image as $k=>$val){
   foreach ($val as $n=>$kvalue){
   if($n=="#text"){
       $kvalue1=$kvalue;
   }
}

}
	     $a_json_row["id"] =$t;
		$a_json_row["label"] = $value3->name;
		$a_json_row["value"] =$kvalue1;
		array_push($a_json, $a_json_row);
	

	
} 
  
	    }
   }
}
 
 
}

       
		echo json_encode($a_json);
 
   
}
if ($f == "movie") {
    $t=$_GET['term'];
 $a_json = array();
$a_json_row = array();
	$query = http_build_query([
            "query" => $t,
]);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=294db12631e6c00aeeb2afba2e2f37ee&".$query,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  $my_array=json_decode($response);
  
 // print_r($a);
 /* https://image.tmdb.org/t/p/original/*/
 
   foreach ($my_array as $key=>$value){

	foreach ($value as $key1=>$value1){
	    
	  
	     $a_json_row["id"] =$t;
		$a_json_row["label"] = $value1->title;
		$a_json_row["value"] = $value1->poster_path;
		array_push($a_json, $a_json_row);

} 
} 
  
 
 
}

       
		echo json_encode($a_json);
 
   
}
if ($f == "movies") {
    $html      = "";
    $movies_ls = array();
    $data      = array(
        "status" => 404,
        "html" => $wo['lang']['no_result']
    );
    if ($s == 'rec') {
        $movies_ls = Wo_GetRecommendedFilms();
        if (count($movies_ls) > 0) {
            foreach ($movies_ls as $wo['film']) {
                $html .= Wo_LoadPage("movies/includes/films-list");
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    } else if ($s == 'new') {
        $movies_ls = Wo_GetNewFilms();
        if (count($movies_ls) > 0) {
            foreach ($movies_ls as $wo['film']) {
                $html .= Wo_LoadPage("movies/includes/films-list");
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    } else if ($s == 'mtw') {
        $movies_ls = Wo_GetMtwFilms();
        if (count($movies_ls) > 0) {
            foreach ($movies_ls as $wo['film']) {
                $html .= Wo_LoadPage("movies/includes/films-list");
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    } else if ($s == 'search' && isset($_GET['key'])) {
        $movies_ls = Wo_SearchFilms($_GET['key']);
        if (count($movies_ls) > 0) {
            foreach ($movies_ls as $wo['film']) {
                $html .= Wo_LoadPage("movies/includes/films-list-item");
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
    } else if ($s == 'load' && isset($_GET['offset']) && is_numeric($_GET['offset']) && isset($_GET['t'])) {
        $movies_ls = false;
        if ($_GET['t'] == 'a' && intval($_GET['offset']) > 0) {
            $movies_ls = Wo_GetMovies(array(
                'offset' => $_GET['offset']
            ));
            if (count($movies_ls) > 0) {
                foreach ($movies_ls as $wo['film']) {
                    $html .= Wo_LoadPage("movies/includes/films-list");
                }
                $data['status'] = 200;
                $data['html']   = $html;
            }
        } else if ($_GET['t'] == 'g' && intval($_GET['offset']) > 0 && isset($_GET['g'])) {
            $movies_ls = Wo_GetMovies(array(
                'offset' => $_GET['offset'],
                'genre' => $_GET['g']
            ));
            if (count($movies_ls) > 0) {
                foreach ($movies_ls as $wo['film']) {
                    $html .= Wo_LoadPage("movies/includes/films-list");
                }
                $data['status'] = 200;
                $data['html']   = $html;
            }
        } else if ($_GET['t'] == 'c' && intval($_GET['offset']) > 0 && isset($_GET['c'])) {
            $movies_ls = Wo_GetMovies(array(
                'offset' => $_GET['offset'],
                'country' => $_GET['c']
            ));
            if (count($movies_ls) > 0) {
                foreach ($movies_ls as $wo['film']) {
                    $html .= Wo_LoadPage("movies/includes/films-list");
                }
                $data['status'] = 200;
                $data['html']   = $html;
            }
        }
    } else if ($s == 'delete' && isset($_GET['id'])) {
        $result = Wo_DeleteFilm($_GET['id']);
        if ($result == true) {
            $data['status'] = 200;
            unset($data['html']);
        }
    } else if ($s == "add-movie-comm") {
        $html = "";
        if (isset($_POST['text']) && isset($_POST['movie']) && is_numeric(($_POST['movie'])) && strlen($_POST['text']) > 2) {
            $registration_data = array(
                'movie_id' => Wo_Secure($_POST['movie']),
                'user_id' => $wo['user']['id'],
                'text' => Wo_Secure($_POST['text']),
                'posted' => time()
            );
            $lastId            = Wo_RegisterMovieComment($registration_data);
            if ($lastId && is_numeric($lastId)) {
                $comment = Wo_GetMovieComments(array(
                    'id' => $lastId
                ));
                if ($comment && count($comment) > 0) {
                    foreach ($comment as $wo['comment']) {
                        $html .= Wo_LoadPage('movies/includes/comments-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html,
                        'comments' => Wo_GetMovieCommentsCount($_POST['movie'])
                    );
                }
            }
        }
    } else if ($s == "add-movie-commreply") {
        $html = "";
        if (isset($_POST['text']) && isset($_POST['c_id']) && is_numeric(($_POST['c_id'])) && strlen($_POST['text']) > 2 && isset($_POST['m_id']) && is_numeric($_POST['m_id'])) {
            $registration_data = array(
                'comm_id' => Wo_Secure($_POST['c_id']),
                'movie_id' => Wo_Secure($_POST['m_id']),
                'user_id' => $wo['user']['id'],
                'text' => Wo_Secure($_POST['text']),
                'posted' => time()
            );
            $lastId            = Wo_RegisterMovieCommentReply($registration_data);
            if ($lastId && is_numeric($lastId)) {
                $comment = Wo_GetMovieCommentReplies(array(
                    'id' => $lastId
                ));
                if ($comment && count($comment) > 0) {
                    foreach ($comment as $wo['comm-reply']) {
                        $html .= Wo_LoadPage('movies/includes/commreplies-list');
                    }
                    $data = array(
                        'status' => 200,
                        'html' => $html,
                        'comments' => Wo_GetMovieCommentsCount($_POST['m_id'])
                    );
                }
            }
        }
    }
    if ($s == "del-movie-comment") {
        $data = array(
            'status' => 304
        );
        if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['m_id']) && is_numeric($_GET['m_id'])) {
            if (Wo_DeleteMovieComment($_GET['id'], $_GET['m_id'])) {
                $data['status']   = 200;
                $data['comments'] = Wo_GetMovieCommentsCount($_GET['m_id']);
            }
        }
    }
    if ($s == "del-movie-commreplies") {
        $data = array(
            'status' => 304
        );
        if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['m_id']) && is_numeric($_GET['m_id'])) {
            if (Wo_DeleteMovieCommReply($_GET['id'], $_GET['m_id'])) {
                $data['status'] = 200;
            }
        }
    }
    if ($s == "add-movie-commlikes") {
        $data = array(
            'status' => 304
        );
        if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['m_id']) && is_numeric($_POST['m_id'])) {
            $blogCommentLikes = Wo_AddMovieCommentLikes($_POST['id'], $_POST['m_id']);
            $likes            = Wo_GetMovieCommLikes($_POST['id']);
            $dislikes         = Wo_GetMovieCommDisLikes($_POST['id']);
            if ($blogCommentLikes) {
                $data['status']   = 200;
                $data['likes']    = ($likes > 0) ? $likes : '';
                $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
            }
        }
    }
    if ($s == "add-movie-commdislikes") {
        $data = array(
            'status' => 304
        );
        if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['m_id']) && is_numeric($_POST['m_id'])) {
            $blogCommentLikes = Wo_AddMovieCommentDisLikes($_POST['id'], $_POST['m_id']);
            $likes            = Wo_GetMovieCommLikes($_POST['id']);
            $dislikes         = Wo_GetMovieCommDisLikes($_POST['id']);
            if ($blogCommentLikes) {
                $data['status']   = 200;
                $data['likes']    = ($likes > 0) ? $likes : '';
                $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
            }
        }
    }
    if ($s == "add-movie-crlikes") {
        $data = array(
            'status' => 304
        );
        if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['m_id']) && is_numeric($_POST['m_id'])) {
            $blogCommReplyLikes = Wo_AddMovieCommReplyLikes($_POST['id'], $_POST['m_id']);
            $likes              = Wo_GetMovieCommReplyLikes($_POST['id']);
            $dislikes           = Wo_GetMovieCommReplyDisLikes($_POST['id']);
            if ($blogCommReplyLikes) {
                $data['status']   = 200;
                $data['likes']    = ($likes > 0) ? $likes : '';
                $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
            }
        }
    }
    if ($s == "add-movie-crdislikes") {
        $data = array(
            'status' => 304
        );
        if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 && isset($_POST['m_id']) && is_numeric($_POST['m_id'])) {
            $blogCommReplyLikes = Wo_AddMovieCommReplyDisLikes($_POST['id'], $_POST['m_id']);
            $likes              = Wo_GetMovieCommReplyLikes($_POST['id']);
            $dislikes           = Wo_GetMovieCommReplyDisLikes($_POST['id']);
            if ($blogCommReplyLikes) {
                $data['status']   = 200;
                $data['likes']    = ($likes > 0) ? $likes : '';
                $data['dislikes'] = ($dislikes > 0) ? $dislikes : '';
            }
        }
    }
    if ($s == "load-comments") {
        if (isset($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] > 0 && isset($_GET['m_id']) && is_numeric($_GET['m_id'])) {
            $comments = Wo_GetMovieComments(array(
                "movie_id" => $_GET['m_id'],
                "offset" => $_GET['offset']
            ));
            if (count($comments)) {
                foreach ($comments as $wo['comment']) {
                    $html .= Wo_LoadPage('movies/includes/comments-list');
                }
                $data['status'] = 200;
                $data['html']   = $html;
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'ads') {
    if ($s == 'new') {
        if (!isset($_POST['name']) || !isset($_POST['website']) || !isset($_POST['headline']) || !isset($_POST['description']) || !isset($_POST['audience-list']) || !isset($_POST['gender']) || !isset($_POST['bidding']) || !isset($_FILES['image']) || !isset($_POST['location']) || !isset($_POST['appears']) || ($wo['user']['wallet'] == 0 || $wo['user']['wallet'] == '0.00')) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['name']) < 3 || strlen($_POST['name']) > 100) {
                $error = $error_icon . $wo['lang']['invalid_company_name'];
            }
            if (!filter_var($_POST['website'], FILTER_VALIDATE_URL) || $_POST['website'] > 3000) {
                $error = $error_icon . $wo['lang']['enter_valid_url'];
            }
            if (strlen($_POST['headline']) < 5 || strlen($_POST['headline']) > 200) {
                $error = $error_icon . $wo['lang']['enter_valid_title'];
            }
            if (file_exists($_FILES["image"]["tmp_name"])) {
                $image = getimagesize($_FILES["image"]["tmp_name"]);
                if (!in_array($image[2], array(
                    IMAGETYPE_GIF,
                    IMAGETYPE_JPEG,
                    IMAGETYPE_PNG,
                    IMAGETYPE_BMP
                ))) {
                    $error = $error_icon . $wo['lang']['invalid_ad_picture'];
                }
            }
            if (gettype($_POST['audience-list']) != 'array' || count($_POST['audience-list']) < 1) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if ($_POST['bidding'] != 'clicks' && $_POST['bidding'] != 'views') {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if ($_POST['appears'] != 'post' && $_POST['appears'] != 'sidebar') {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['name']),
                'url' => Wo_Secure($_POST['website']),
                'headline' => Wo_Secure($_POST['headline']),
                'description' => Wo_Secure($_POST['description']),
                'location' => Wo_Secure($_POST['location']),
                'audience' => Wo_Secure(implode(',', $_POST['audience-list'])),
                'gender' => Wo_Secure($_POST['gender']),
                'bidding' => Wo_Secure($_POST['bidding']),
                'posted' => time(),
                'appears' => Wo_Secure($_POST['appears']),
                'user_id' => Wo_Secure($wo['user']['user_id'])
            );
            $last_id           = Wo_RegisterUserAds($registration_data);
            if ($last_id && is_numeric($last_id)) {
                if (!empty($_FILES["image"]["tmp_name"])) {
                    $fileInfo      = array(
                        'file' => $_FILES["image"]["tmp_name"],
                        'name' => $_FILES['image']['name'],
                        'size' => $_FILES["image"]["size"],
                        'type' => $_FILES["image"]["type"],
                        'types' => 'jpg,png,bmp,gif',
                        'compress' => false
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $n             = Wo_UpdateUserAds($last_id, array(
                        "image" => $mediaFilename
                    ));
                    $data          = array(
                        'message' => $success_icon . $wo['lang']['ad_added'],
                        'status' => 200,
                        'url' => Wo_SeoLink('index.php?link1=ads')
                    );
                }
            }
        } else {
            $data = array(
                'message' => $error,
                'status' => 500
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update' && isset($_GET['ad-id']) && is_numeric($_GET['ad-id']) && $_GET['ad-id'] > 0) {
        if (!isset($_POST['name']) || !isset($_POST['website']) || !isset($_POST['headline']) || !isset($_POST['description']) || !isset($_POST['audience-list']) || !isset($_POST['gender']) || !isset($_POST['bidding']) || !isset($_POST['location'])) {
            $error = $error_icon . $wo['lang']['please_check_details'];
        } else {
            if (strlen($_POST['name']) < 3 || strlen($_POST['name']) > 100) {
                $error = $error_icon . $wo['lang']['invalid_company_name'];
            }
            if (!filter_var($_POST['website'], FILTER_VALIDATE_URL) || $_POST['website'] > 3000) {
                $error = $error_icon . $wo['lang']['enter_valid_url'];
            }
            if (strlen($_POST['headline']) < 5 || strlen($_POST['headline']) > 200) {
                $error = $error_icon . $wo['lang']['enter_valid_title'];
            }
            if (!empty($_FILES["image"]["tmp_name"])) {
                if (file_exists($_FILES["image"]["tmp_name"])) {
                    $image = getimagesize($_FILES["image"]["tmp_name"]);
                    if (!in_array($image[2], array(
                        IMAGETYPE_GIF,
                        IMAGETYPE_JPEG,
                        IMAGETYPE_PNG,
                        IMAGETYPE_BMP
                    ))) {
                        $error = $error_icon . $wo['lang']['invalid_ad_picture'];
                    }
                }
            }
            if (gettype($_POST['audience-list']) != 'array' || count($_POST['audience-list']) < 1) {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if ($_POST['bidding'] != 'clicks' && $_POST['bidding'] != 'views') {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
            if ($_POST['appears'] != 'post' && $_POST['appears'] != 'sidebar') {
                $error = $error_icon . $wo['lang']['please_check_details'];
            }
        }
        if (empty($error)) {
            $registration_data = array(
                'name' => Wo_Secure($_POST['name']),
                'url' => Wo_Secure($_POST['website']),
                'headline' => Wo_Secure($_POST['headline']),
                'description' => Wo_Secure($_POST['description']),
                'location' => Wo_Secure($_POST['location']),
                'audience' => Wo_Secure(implode(',', $_POST['audience-list'])),
                'gender' => Wo_Secure($_POST['gender']),
                'bidding' => Wo_Secure($_POST['bidding']),
                'posted' => time(),
                'appears' => Wo_Secure($_POST['appears'])
            );
            if (Wo_UpdateUserAds($_GET['ad-id'], $registration_data)) {
                if (!empty($_FILES["image"]["tmp_name"])) {
                    $fileInfo      = array(
                        'file' => $_FILES["image"]["tmp_name"],
                        'name' => $_FILES['image']['name'],
                        'size' => $_FILES["image"]["size"],
                        'type' => $_FILES["image"]["type"],
                        'types' => 'jpg,png,bmp,gif',
                        'compress' => false
                    );
                    $media         = Wo_ShareFile($fileInfo);
                    $mediaFilename = $media['filename'];
                    $n             = Wo_UpdateUserAds($_GET['ad-id'], array(
                        "image" => $mediaFilename
                    ));
                }
                $data = array(
                    'message' => $success_icon . $wo['lang']['ad_saved'],
                    'status' => 200,
                    'url' => Wo_SeoLink('index.php?link1=ads')
                );
                if (isset($_GET['a']) && $_GET['a'] == 1) {
                    $data['url'] = Wo_SeoLink('index.php?link1=admincp&page=user_ads');
                }
            }
        } else {
            $data = array(
                'message' => $error,
                'status' => 500
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'rads-c' && isset($_GET['ad_id']) && is_numeric($_GET['ad_id']) && $_GET['ad_id'] > 0) {
        $data = array(
            "status" => 304
        );
        $ad   = Wo_Secure($_GET['ad_id']);
        if (Wo_RegisterAdConversionClick($ad)) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'rads-v' && isset($_GET['ad_id']) && is_numeric($_GET['ad_id']) && $_GET['ad_id'] > 0) {
        $data = array(
            "status" => 304
        );
        $ad   = Wo_Secure($_GET['ad_id']);
        if (Wo_RegisterAdClick($ad)) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'ts' && isset($_GET['ad_id']) && is_numeric($_GET['ad_id']) && $_GET['ad_id'] > 0 && isset($_GET['status']) && is_numeric($_GET['status'])) {
        $data  = array(
            'status' => 304
        );
        $ad_id = Wo_Secure($_GET['ad_id']);
        $ad_st = Wo_Secure($_GET['status']);
        if (Wo_ToggleUserAdStatus($ad_id)) {
            $data['status'] = 200;
            if ($ad_st == 1) {
                $data['ad'] = $wo['lang']['not_active'];
            } else {
                $data['ad'] = $wo['lang']['active'];
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'lm' && isset($_GET['ad_id']) && is_numeric($_GET['ad_id'])) {
        $html    = '';
        $data    = array(
            'status' => 404,
            'html' => $wo['lang']['no_result']
        );
        $last_id = Wo_Secure($_GET['ad_id']);
        $ads     = Wo_GetMyAds(array(
            'offset' => $last_id
        ));
        if ($ads && count($ads) > 0) {
            foreach ($ads as $wo['ad']) {
                $html .= Wo_LoadPage('ads/includes/ads-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'alm' && isset($_GET['ad_id']) && is_numeric($_GET['ad_id'])) {
        $html    = '';
        $data    = array(
            'status' => 404,
            'html' => $wo['lang']['no_result']
        );
        $last_id = Wo_Secure($_GET['ad_id']);
        $ads     = Wo_GetAds($last_id);
        if ($ads && count($ads) > 0) {
            foreach ($ads as $wo['user_ad']) {
                $html .= Wo_LoadPage('admin/user_ads/ads-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'status') {
    if ($s == 'new') {
        $data  = array(
            'message' => $error_icon . $wo['lang']['please_check_details'],
            'status' => 500
        );
        $error = false;
        if (!isset($_FILES['statusMedia'])) {
            $error = true;
        } else {
            if (gettype($_FILES['statusMedia']) != 'array' || count($_FILES['statusMedia']) < 1 || count($_FILES['statusMedia']) > 20) {
                $error = true;
            }
            if (isset($_POST['title']) && strlen($_POST['title']) > 100) {
                $error = true;
            }
            if (isset($_POST['description']) && strlen($_POST['description']) > 300) {
                $error = true;
            }
            if (!Wo_IsValidMimeType($_FILES['statusMedia']['type'])) {
                $error = true;
            }
        }
        if (!$error) {
            $registration_data            = array();
            $registration_data['user_id'] = $wo['user']['id'];
            $registration_data['posted']  = time();
            $registration_data['expire']  = date('Y-m-d');
            if (isset($_POST['title']) && strlen($_POST['title']) >= 2) {
                $registration_data['title'] = Wo_Secure($_POST['title']);
            }
            if (isset($_POST['description']) && strlen($_POST['description']) >= 10) {
                $registration_data['description'] = Wo_Secure($_POST['description']);
            }
            if (count($registration_data) > 0) {
                $last_id = Wo_InsertUserStory($registration_data);
                if ($last_id && is_numeric($last_id) && !empty($_FILES["statusMedia"])) {
                    $files   = Wo_MultipleArrayFiles($_FILES["statusMedia"]);
                    $sources = array();
                    $thumb = '';
                    foreach ($files as $fileInfo) {
                        if ($fileInfo['size'] > 0) {
                            $fileInfo['file'] = $fileInfo['tmp_name'];
                            $media            = Wo_ShareFile($fileInfo);
                            $file_type        = explode('/', $fileInfo['type']);
                            if ($media['filename']) {
                                $sources[] = array(
                                    'story_id' => $last_id,
                                    'type' => $file_type[0],
                                    'filename' => $media['filename'],
                                    'expire' => date('Y-m-d')
                                );
                            }
                            if (empty($thumb)) {
                                if (in_array(strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                                    $thumb = $media['filename'];
                                    $explode2  = @end(explode('.', $thumb));
                                    $explode3  = @explode('.', $thumb);
                                    $last_file = $explode3[0] . '_small.' . $explode2;
                                    $arrContextOptions = array(
                                        "ssl" => array(
                                            "verify_peer" => false,
                                            "verify_peer_name" => false
                                        )
                                    );
                                    $fileget           = file_get_contents(Wo_GetMedia($thumb), false, stream_context_create($arrContextOptions));
                                    if (!empty($fileget)) {
                                        $importImage = @file_put_contents($thumb, $fileget);
                                    }
                                    $crop_image = Wo_Resize_Crop_Image(100, 100, $thumb, $last_file, 60);
                                    $upload_s3 = Wo_UploadToS3($last_file);
                                    $thumb = $last_file;
                                }
                            }
                        }
                    }
                    if (count($sources) > 0) {
                        foreach ($sources as $registration_data) {
                            Wo_InsertUserStoryMedia($registration_data);
                        }
                        if (!empty($thumb)) {
                            $thumb = Wo_Secure($thumb);
                            $mysqli_query = mysqli_query($sqlConnect, "UPDATE " . T_USER_STORY . " SET thumbnail = '$thumb' WHERE id = $last_id");
                        }
                        $data = array(
                            'message' => $success_icon . $wo['lang']['status_added'],
                            'status' => 200
                        );
                    }
                }
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'p' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $data    = array(
            "status" => 404
        );
        $id      = Wo_Secure($_GET['id']);
        $html    = '';
        $stories = Wo_GetStroies(array(
            'user' => $id
        ));
        if (count($stories) > 0) {
            foreach ($stories as $wo['story']) {
                $html .= Wo_LoadPage('status/content');
            }
            $data = array(
                "status" => 200,
                "html" => $html
            );
        } else {
            $html = Wo_LoadPage('status/no-stories');
            $data = array(
                "status" => 404,
                "html" => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'remove' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $data = array(
            "status" => 304
        );
        if (Wo_DeleteStatus($_GET['id'])) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'lm' && isset($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] > 0) {
        $data    = array(
            'status' => 404
        );
        $html    = '';
        $stories = Wo_GetAllStories($_GET['offset']);
        if ($stories && count($stories) > 0) {
            foreach ($stories as $wo['status']) {
                $html .= Wo_LoadPage('admin/status/status-list');
            }
            $data = array(
                'status' => 200,
                'html' => $html
            );
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'notifications') {
    if ($s == 'get-users') {
        $data  = array(
            'status' => 404,
            'html' => ''
        );
        $html  = '';
        $users = Wo_GetUsersByName($_POST['name']);
        if ($users && count($users) > 0) {
            foreach ($users as $wo['notificated-user']) {
                $html .= Wo_LoadAdminPage('mass-notifications/list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'send') {
        $data  = array(
            'status' => 304,
            'message' => $error_icon . $wo['lang']['please_check_details']
        );
        $error = false;
        $users = array();
        if (!isset($_POST['url']) || !isset($_POST['description'])) {
            $error = true;
        } else {
            if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                $error = true;
            }
            if (strlen($_POST['description']) < 5 || strlen($_POST['description']) > 300) {
                $error = true;
            }
        }
        if (!$error) {
            if (empty($_POST['notifc-users'])) {
                $users = Wo_GetUserIds();
            } elseif ($_POST['notifc-users'] && strlen($_POST['notifc-users']) > 0) {
                $users = explode(',', $_POST['notifc-users']);
            }
            $url               = Wo_Secure($_POST['url']);
            $message           = Wo_Secure($_POST['description']);
            $registration_data = array(
                'full_link' => $url,
                'text' => $message,
                'recipients' => $users
            );
            if (Wo_RegisterAdminNotification($registration_data)) {
                $data = array(
                    'status' => 200,
                    'message' => $success_icon . $wo['lang']['notification_sent']
                );
            }
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'request_verification') {
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        if (Wo_RequestVerification($_GET['id'], $_GET['type']) === true) {
            $data = array(
                'status' => 200,
                'html' => Wo_GetVerificationButton($_GET['id'], $_GET['type'])
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'delete_verification') {
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        if (Wo_DeleteVerification($_GET['id'], $_GET['type']) === true) {
            $data = array(
                'status' => 200,
                'html' => Wo_GetVerificationButton($_GET['id'], $_GET['type'])
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'remove_verification') {
    if (!empty($_GET['id']) && !empty($_GET['type'])) {
        if (Wo_RemoveVerificationRequest($_GET['id'], $_GET['type']) === true) {
            $data = array(
                'status' => 200,
                'html' => Wo_GetVerificationButton($_GET['id'], $_GET['type'])
            );
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'verificate-user') {
    $data  = array(
        'status' => 304,
        'message' => ($error_icon . $wo['lang']['please_check_details'])
    );
    $error = false;
    if (!isset($_POST['name']) || !isset($_POST['text']) || !isset($_FILES['passport']) || !isset($_FILES['photo'])) {
        $error = true;
    } else {
        if (strlen($_POST['name']) < 5 || strlen($_POST['name']) > 50) {
            $error           = true;
            $data['message'] = $error_icon . $wo['lang']['username_characters_length'];
        }
        if (strlen($_POST['text']) < 20 || strlen($_POST['text']) > 2000) {
            $error           = true;
            $data['message'] = $error_icon . $wo['lang']['please_check_details'];
        }
        if (!file_exists($_FILES['passport']['tmp_name']) || !file_exists($_FILES['photo']['tmp_name'])) {
            $error           = true;
            $data['message'] = $error_icon . $wo['lang']['please_select_passport_id'];
        }
        if (file_exists($_FILES["passport"]["tmp_name"])) {
            $image = getimagesize($_FILES["passport"]["tmp_name"]);
            if (!in_array($image[2], array(
                IMAGETYPE_GIF,
                IMAGETYPE_JPEG,
                IMAGETYPE_PNG,
                IMAGETYPE_BMP
            ))) {
                $error           = true;
                $data['message'] = $error_icon . $wo['lang']['passport_id_invalid'];
            }
        }
        /*if (file_exists($_FILES["photo"]["tmp_name"])) {
            $image = getimagesize($_FILES["photo"]["tmp_name"]);
            if (!in_array($image[2], array(
                IMAGETYPE_GIF,
                IMAGETYPE_JPEG,
                IMAGETYPE_PNG,
                IMAGETYPE_BMP
            ))) {
                $error           = true;
                $data['message'] = $error_icon . $wo['lang']['user_picture_invalid'];
            }
        }*/
    }
    if (!$error) {
        $registration_data = array(
            'user_id' => $wo['user']['id'],
            'message' => Wo_Secure($_POST['text']),
            'user_name' => Wo_Secure($_POST['name']),
            'passport' => '',
            'photo' => '',
            'type' => 'User',
            'seen' => 0
        );
        $last_id           = Wo_SendVerificationRequest($registration_data);
        if ($last_id && is_numeric($last_id)) {
            $files       = array(
                'passport' => $_FILES,
                'photo' => $_FILES
            );
            $update_data = array();
            foreach ($files as $key => $file) {
                $fileInfo          = array(
                    'file' => $file[$key]["tmp_name"],
                    'name' => $file[$key]['name'],
                    'size' => $file[$key]["size"],
                    'type' => $file[$key]["type"],
                    'types' => 'jpg,png,bmp,gif'
                );
                $media             = Wo_ShareFile($fileInfo);
                $update_data[$key] = $media['filename'];
            }
            if (Wo_UpdateVerificationRequest($last_id, $update_data)) {
                $data['status']  = 200;
                $data['message'] = $success_icon . $wo['lang']['verification_request_sent'];
                $data['url']     = $wo['config']['site_url'];
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'admincp') {
    if ($s == 'insert-invitation') {
        $data             = array(
            'status' => 200,
            'html' => ''
        );
        $wo['invitation'] = Wo_InsertAdminInvitation();
        if ($wo['invitation'] && is_array($wo['invitation'])) {
            $data['html']   = Wo_LoadAdminPage('manage-invitation-keys/list');
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'rm-invitation' && isset($_GET['id']) && is_numeric($_GET['id'])) {
        $data = array(
            'status' => 304
        );
        if (Wo_DeleteAdminInvitation('id', $_GET['id'])) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'update-sitemap') {
        $rate = (isset($_POST['rate']) && strlen($_POST['rate']) > 0) ? $_POST['rate'] : false;
        $data = array(
            'status' => 304
        );
        if (Wo_GenirateSiteMap($rate)) {
            $data['status'] = 200;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'reports') {
    if ($s == 'report_user' && isset($_POST['user']) && is_numeric($_POST['user']) && isset($_POST['text'])) {
        $user = Wo_Secure($_POST['user']);
        $text = Wo_Secure($_POST['text']);
        $code = Wo_ReportUser($user, $text);
        $data = array(
            'status' => 304
        );
        if ($code == 0) {
            $data['status'] = 200;
            $data['code']   = 0;
        } else if ($code == 1) {
            $data['status'] = 200;
            $data['code']   = 1;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'report_page' && isset($_POST['page']) && is_numeric($_POST['page']) && isset($_POST['text'])) {
        $page = Wo_Secure($_POST['page']);
        $text = Wo_Secure($_POST['text']);
        $code = Wo_ReportPage($page, $text);
        $data = array(
            'status' => 304
        );
        if ($code == 0) {
            $data['status'] = 200;
            $data['code']   = 0;
        } else if ($code == 1) {
            $data['status'] = 200;
            $data['code']   = 1;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
    if ($s == 'report_group' && isset($_POST['group']) && is_numeric($_POST['group']) && isset($_POST['text'])) {
        $group = Wo_Secure($_POST['group']);
        $text  = Wo_Secure($_POST['text']);
        $code  = Wo_ReportGroup($group, $text);
        $data  = array(
            'status' => 304
        );
        if ($code == 0) {
            $data['status'] = 200;
            $data['code']   = 0;
        } else if ($code == 1) {
            $data['status'] = 200;
            $data['code']   = 1;
        }
        header("Content-type: application/json");
        echo json_encode($data);
        exit();
    }
}
if ($f == 'family') {
    if ($s == 'add_member' && isset($_GET['member_id']) && isset($_GET['type'])) {
        $error = false;
        $data  = array(
            'status' => 304,
            'message' => $error_icon . $wo['lang']['please_check_details']
        );
        $html  = '';
        if (!is_numeric($_GET['member_id']) || $_GET['member_id'] < 1) {
            $error = true;
        }
        if (!is_numeric($_GET['type']) || $_GET['type'] < 1 || $_GET['type'] > 43) {
            $error = true;
        }
        if ($_GET['member_id'] == $wo['user']['id']) {
            $error = true;
        }
        if (!$error) {
            $relationship_type       = array(
                5,
                6,
                11,
                12,
                13,
                17,
                18,
                23,
                24,
                29,
                34,
                37,
                40
            );
            $registration_data_array = array(
                0 => array(
                    'member_id' => Wo_Secure($_GET['member_id']),
                    'member' => Wo_Secure($_GET['type']),
                    'active' => 0,
                    'user_id' => Wo_Secure($wo['user']['id']),
                    'requesting' => Wo_Secure($wo['user']['id'])
                )
            );
            if (in_array($_GET['type'], $relationship_type)) {
                $registration_data_array[] = array(
                    'member_id' => Wo_Secure($wo['user']['id']),
                    'member' => Wo_Secure($_GET['type']),
                    'active' => 0,
                    'user_id' => Wo_Secure($_GET['member_id']),
                    'requesting' => Wo_Secure($wo['user']['id'])
                );
            }
            foreach ($registration_data_array as $registration_data) {
                Wo_RegisterFamilyMember($registration_data);
            }
            $member_data = Wo_UserData($_GET['member_id']);
            if (!empty($member_data)) {
                $notification_data_array = array(
                    'recipient_id' => $_GET['member_id'],
                    'type' => 'added_u_as',
                    'user_id' => $wo['user']['id'],
                    'text' => $wo['lang']['sent_u_request'] . $wo['lang'][$wo['family'][Wo_Secure($_GET['type'])]],
                    'url' => 'index.php?link1=timeline&u=' . $member_data['username'] . '&type=requests'
                );
                $data['status']          = 200;
                $data['notification']    = boolval(Wo_RegisterNotification($notification_data_array));
                $data['message']         = $success_icon . $wo['lang']['request_sent'];
            }
        }
    }
    if ($s == 'delete_member' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
        $member_id = Wo_Secure($_GET['id']);
        $data      = array(
            'status' => 304
        );
        if (Wo_DeleteFamilyMember($member_id)) {
            $data['status'] = 200;
        }
    }
    if ($s == 'accept_member' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type'])) {
        $member_id   = Wo_Secure($_GET['id']);
        $data        = array(
            'status' => 304
        );
        $member_data = Wo_UserData($member_id);
        if (Wo_AcceptFamilyMember($member_id) && !empty($member_data)) {
            $notification_data_array = array(
                'recipient_id' => $member_id,
                'type' => 'accept_u_as',
                'user_id' => $wo['user']['id'],
                'text' => $wo['lang']['request_accepted'] . $wo['lang'][$wo['family'][Wo_Secure($_GET['type'])]],
                'url' => 'index.php?link1=timeline&u=' . $member_data['username'] . '&type=family_list'
            );
            Wo_RegisterNotification($notification_data_array);
            $data['status'] = 200;
        }
    }
    if ($s == 'accept_relation' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['type']) && isset($_GET['member'])) {
        $member_id   = Wo_Secure($_GET['member']);
        $id          = Wo_Secure($_GET['id']);
        $data        = array(
            'status' => 304
        );
        $member_data = Wo_UserData($member_id);
        if (Wo_AcceptRelationRequest($id, $member_id, Wo_Secure($_GET['type'])) && !empty($member_data)) {
            $notification_data_array = array(
                'recipient_id' => $member_id,
                'type' => 'accept_u_as',
                'user_id' => $wo['user']['id'],
                'text' => $wo['lang']['relhip_request_accepted'] . $wo['relationship'][Wo_Secure($_GET['type'])],
                'url' => 'index.php?link1=timeline&u=' . $member_data['username']
            );
            Wo_RegisterNotification($notification_data_array);
            $data['status'] = 200;
        }
    }
    if ($s == 'delete_relation' && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 && isset($_GET['user']) && isset($_GET['type'])) {
        if (is_numeric($_GET['user']) && $_GET['user'] > 0 && is_numeric($_GET['type']) && $_GET['type'] >= 1 && $_GET['type'] <= 4) {
            $id      = Wo_Secure($_GET['id']);
            $user_id = Wo_Secure($_GET['user']);
            $type    = Wo_Secure($_GET['type']);
            $data    = array(
                'status' => 304
            );
            if (Wo_DeleteRelationRequest($id)) {
                $data['status']          = 200;
                $notification_data_array = array(
                    'recipient_id' => $user_id,
                    'type' => 'rejected_u_as',
                    'user_id' => $wo['user']['id'],
                    'text' => $wo['lang']['relation_rejected'] . $wo['relationship'][$type],
                    'url' => 'index.php?link1=timeline&u=' . $wo['user']['username']
                );
                Wo_RegisterNotification($notification_data_array);
            }
        }
    }
    if ($s == 'search' && isset($_GET['name'])) {
        $name  = Wo_Secure($_GET['name']);
        $users = Wo_GetUsersByName($name);
        $data  = array(
            'status' => 404,
            'users' => array()
        );
        if ($users && count($users) > 0) {
            foreach ($users as $user) {
                $data['users'][] = array(
                    'user_id' => $user['user_id'],
                    'avatar' => $user['avatar'],
                    'name' => $user['name'],
                    'lastseen' => Wo_UserStatus($user['user_id'], $user['lastseen'])
                );
            }
            $data['status'] = 200;
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'nearby_users' && $wo['config']['find_friends'] == 1) {
    if ($s == 'load') {
        $name     = (isset($_GET['name'])) ? $_GET['name'] : false;
        $gender   = (isset($_GET['gender'])) ? $_GET['gender'] : false;
        $offset   = (isset($_GET['offset'])) ? $_GET['offset'] : false;
        $distance = (isset($_GET['distance'])) ? $_GET['distance'] : false;
        $relship  = (isset($_GET['relship'])) ? $_GET['relship'] : false;
        $status   = (isset($_GET['status'])) ? $_GET['status'] : false;
        $data     = array(
            'status' => 404
        );
        $html     = '';
        $filter   = array(
            'name' => $name,
            'gender' => $gender,
            'distance' => $distance,
            'offset' => $offset,
            'relship' => $relship,
            'status' => $status
        );
        $users    = Wo_GetNearbyUsers($filter);
        if ($users && count($users) > 0) {
            foreach ($users as $wo['UsersList']) {
                $html .= Wo_LoadPage('friends_nearby/includes/user-list');
            }
            $data['status'] = 200;
            $data['html']   = $html;
            $data['count']  = count($users);
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'upload-blog-image') {
  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])) {
    $fileInfo = array(
        'file' => $temp["tmp_name"],
        'name' => $temp['name'],
        'size' => $temp["size"],
        'type' => $temp["type"]
    );
    $media    = Wo_ShareFile($fileInfo);
    if (!empty($media)) {
        $mediaFilename = $media['filename'];
        $mediaName     = $media['name'];
    }
    if (!empty($mediaFilename)) {
        $filetowrite = Wo_GetMedia($mediaFilename);
        echo json_encode(array('location' => $filetowrite));
        exit();
    } else {
        header("HTTP/1.0 500 Server Error");
    }
  } else {
    header("HTTP/1.0 500 Server Error");
  }
}
if ($f == 'get_lang_key') {
    $html = '';
    $langs = Wo_GetLangDetails($_GET['id']);
    if (count($langs) > 0) {
        foreach ($langs as $key => $wo['langs']) {
            foreach ($wo['langs'] as $wo['key_'] => $wo['lang_vlaue']) {
                $wo['is_editale'] = 0;
                if ($_GET['lang_name'] == $wo['key_']) {
                    $wo['is_editale'] = 1;
                }
                $html .= Wo_LoadAdminPage('edit-lang/form-list');
            }
        }
    }  else {
        $html = "<h4>Keyword not found</h4>";
    }
    $data['status'] = 200;
    $data['html'] = $html;
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'update_user_device_id') {
    if (!empty($_GET['id'])) {
        $id = Wo_Secure($_GET['id']);
        if ($id != $wo['user']['web_device_id']) {
            $update = Wo_UpdateUserData($wo['user']['user_id'], array('web_device_id' => $id));
            if ($update) {
                $data = array('status' => 200);
            }
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'remove_user_device_id') {
    if (!empty($wo['user']['web_device_id'])) {
        $update = Wo_UpdateUserData($wo['user']['user_id'], array('web_device_id' => ''));
        if ($update) {
            $data = array('status' => 200);
        }
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_settings') {
    $saveSetting         = false;
    foreach ($_POST as $key => $value) {
        $saveSetting = Wo_SaveConfig($key, $value);
    }
    if ($saveSetting === true) {
        $data['status'] = 200;
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_load_requests') {
    if (!Wo_IsAdmin()) {
        http_response_code(403);
        exit();
    }
    $start = 0;
    $limit = 50;
    if (!empty($_POST['start']))
        $start = $_POST['start'];
    if (!empty($_POST['count']))
        $limit = $_POST['count'];

    $total_count = rewards_requests_count();
    $requests = rewards_load_requests($start, $limit);
    header("Content-type: application/json");
    if ($requests === false) {
        echo json_encode(array(
            'status' => 'success',
            'data' => array(
                'total_count' => $total_count,
                'items' => array()
            )
        ));
    } else {
        echo json_encode(array(
            'status' => 'success',
            'data' => array (
                'items' => $requests,
                'total_count' => $total_count
            )
        ));
    }
    exit();
}
if ($f == 'rewards_load') {
    $reward = rewards_get($wo['user']['user_id']);

    header("Content-type: application/json");
    if ($reward == false) {
        echo json_encode(array(
            'status' => 'success',
            'data' => array()
        ));
    } else {
        $pending_requests = rewards_requests_for_user($wo['user']['user_id'], 'pending');
        if ($pending_requests && is_array($pending_requests) && count($pending_requests) > 0) {
            $reward['request_pending'] = true;
            $reward['can_request'] = false;
        } else {
            $reward['request_pending'] = false;
            if (!empty($wo['config']['rewardsMinReq']) && $reward['balance'] >= $wo['config']['rewardsMinReq'])
                $reward['can_request'] = true;
            else if ($reward['balance'] > 0)
                $reward['can_request'] = true;
            else
                $reward['can_request'] = false;
        }
        echo json_encode(array(
            'status' => 'success',
            'data' => $reward
        ));
    }
    exit();
}
if ($f == 'rewards_request') {
    $r = rewards_request($wo['user']['user_id']);
    if ($r === true) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'error' => $r
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_request_cancel') {
    $r = rewards_request_cancel($wo['user']['user_id']);
    if ($r === true) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'error' => $r
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_request_reject') {
    if (!Wo_IsAdmin()) {
        http_response_code(403);
        exit();
    }
    if (empty($_POST['id'])) {
        http_response_code(400);
        exit();
    }
    $r = rewards_request_reject($_POST['id']);
    if ($r === true) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'error' => $r
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_request_accept') {
    if (!Wo_IsAdmin()) {
        http_response_code(403);
        exit();
    }
    if (empty($_POST['id'])) {
        http_response_code(400);
        exit();
    }
    $r = rewards_request_accept($_POST['id']);
    if ($r === true) {
        $data = array(
            'status' => 'success'
        );
    } else {
        $data = array(
            'error' => $r
        );
    }
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
if ($f == 'rewards_load_history') {
    $start = 0;
    $limit = 50;
    if (!empty($_POST['start']))
        $start = $_POST['start'];
    if (!empty($_POST['count']))
        $limit = $_POST['count'];

    $total_count = rewards_history_count();
    $items = rewards_load_history($wo['user']['user_id'], $start, $limit);
    header("Content-type: application/json");
    if ($items === false) {
        echo json_encode(array(
            'status' => 'success',
            'data' => array(
                'total_count' => $total_count,
                'items' => array()
            )
        ));
    } else {
        echo json_encode(array(
            'status' => 'success',
            'data' => array (
                'items' => $items,
                'total_count' => $total_count
            )
        ));
    }
    exit();
}

mysqli_close($sqlConnect);
unset($wo);
?>
