<?php
error_reporting(0);
require_once('config.php');
require_once('assets/includes/phpMailer_config.php');
require_once('assets/import/sitemap-php/Sitemap.php');
// require 'assets/import/ffmpeg-class/vendor/autoload.php';
$wo           = array();
// Connect to SQL Server
$sqlConnect   = $wo['sqlConnect'] = mysqli_connect($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name, 3306);
// Handling Server Errors
$ServerErrors = array();
if (mysqli_connect_errno()) {
    $ServerErrors[] = "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (!function_exists('curl_init')) {
    $ServerErrors[] = "PHP CURL is NOT installed on your web server !";
}
if (!extension_loaded('gd') && !function_exists('gd_info')) {
    $ServerErrors[] = "PHP GD library is NOT installed on your web server !";
}
if (!extension_loaded('zip')) {
    $ServerErrors[] = "ZipArchive extension is NOT installed on your web server !";
}
if (!version_compare(PHP_VERSION, '5.5.0', '>=')) {
    $ServerErrors[] = "Required PHP_VERSION >= 5.5.0 , Your PHP_VERSION is : " . PHP_VERSION . "\n";
}
if (!function_exists('exif_read_data')) {
    // $ServerErrors[] = "Exif reader extension is NOT installed on your web server !";
}
$query = mysqli_query($sqlConnect, "SET NAMES utf8");
if (isset($ServerErrors) && !empty($ServerErrors)) {
    foreach ($ServerErrors as $Error) {
        echo "<h3>" . $Error . "</h3>";
    }
    die();
}
$baned_ips = Wo_GetBanned('user');
if (in_array($_SERVER["REMOTE_ADDR"], $baned_ips)) {
    exit();
}
$config              = Wo_GetConfig();
// Config Url
$config['theme_url'] = $site_url . '/themes/' . $config['theme'];
$config['site_url']  = $site_url;
$wo['site_url']      = $site_url;
$s3_site_url         = 'https://test.s3.amazonaws.com';
if (!empty($config['bucket_name'])) {
    $s3_site_url = "https://{bucket}.s3.amazonaws.com";
    $s3_site_url = str_replace('{bucket}', $config['bucket_name'], $s3_site_url);
}
$config['s3_site_url'] = $s3_site_url;
$wo['config']          = $config;
$wo['site_pages']      = array(
    'home',
    'welcome',
    'activate',
    'search',
    'timeline',
    'pages',
    'page',
    'groups',
    'group',
    'create-group',
    'group-setting',
    'create-page',
    'setting',
    'page-setting',
    'messages',
    'logout',
    '404',
    'post',
    'games',
    'admincp',
    'saved-posts',
    'hashtag',
    'terms',
    'contact-us',
    'albums',
    'album',
    'game',
    'go_pro',
    'upgraded',
    'oops',
    'user_activation',
    'boosted-pages',
    'boosted-posts',
    'video-call',
    'read-blog',
    'blog',
    'My-Blogs',
    'edit-blog',
    'create_blog',
    'developers',
    'ads'
);
$wo['script_version']  = '1.5.2';
$http_header           = 'http://';
if (!empty($_SERVER['HTTPS'])) {
    $http_header = 'https://';
}
$wo['actual_link']   = $http_header . $_SERVER['HTTP_HOST'] . urlencode($_SERVER['REQUEST_URI']);
// Define Cache Vireble
$cache               = new Cache();
$wo['purchase_code'] = '';
if (!empty($purchase_code)) {
    $wo['purchase_code'] = $purchase_code;
}
// Login With Url
$wo['facebookLoginUrl']   = $config['site_url'] . '/login-with.php?provider=Facebook';
$wo['twitterLoginUrl']    = $config['site_url'] . '/login-with.php?provider=Twitter';
$wo['googleLoginUrl']     = $config['site_url'] . '/login-with.php?provider=Google';
$wo['linkedInLoginUrl']   = $config['site_url'] . '/login-with.php?provider=LinkedIn';
$wo['VkontakteLoginUrl']  = $config['site_url'] . '/login-with.php?provider=Vkontakte';
$wo['instagramLoginUrl']  = $config['site_url'] . '/login-with.php?provider=Instagram';
// Defualt User Pictures 
$wo['userDefaultAvatar']  = 'upload/photos/d-avatar.jpg';
$wo['userDefaultCover']   = 'upload/photos/d-cover.jpg';
$wo['pageDefaultAvatar']  = 'upload/photos/d-page.jpg';
$wo['groupDefaultAvatar'] = 'upload/photos/d-group.jpg';
// Get LoggedIn User Data
$wo['loggedin']           = false;
$langs                    = Wo_LangsNamesFromDB();
if (Wo_IsLogged() == true) {
    $session_id         = (!empty($_SESSION['user_id'])) ? $_SESSION['user_id'] : $_COOKIE['user_id'];
    $wo['user_session'] = Wo_GetUserFromSessionID($session_id);
    $wo['user']         = Wo_UserData($wo['user_session']);
    if (!empty($wo['user']['language'])) {
        if (in_array($wo['user']['language'], $langs)) {
            $_SESSION['lang'] = $wo['user']['language'];
        }
    }
    if ($wo['user']['user_id'] < 0 || empty($wo['user']['user_id']) || !is_numeric($wo['user']['user_id']) || Wo_UserActive($wo['user']['username']) === false) {
        header("Location: " . Wo_SeoLink('index.php?link1=logout'));
    }
    $wo['loggedin'] = true;
}
if (!empty($_GET['c_id']) && !empty($_GET['user_id'])) {
    $application = 'windows';
    if (!empty($_GET['application'])) {
        if ($_GET['application'] == 'phone') {
            $application = Wo_Secure($_GET['application']);
        }
    }
    $c_id             = Wo_Secure($_GET['c_id']);
    $user_id          = Wo_Secure($_GET['user_id']);
    $check_if_session = Wo_CheckUserSessionID($user_id, $c_id, $application);
    if ($check_if_session === true) {
        $wo['user'] = Wo_UserData($user_id);
        $session             = Wo_CreateLoginSession($user_id);
        $_SESSION['user_id'] = $session;
        setcookie("user_id", $session, time() + (10 * 365 * 24 * 60 * 60));
        if ($wo['user']['user_id'] < 0 || empty($wo['user']['user_id']) || !is_numeric($wo['user']['user_id']) || Wo_UserActive($wo['user']['username']) === false) {
            header("Location: " . Wo_SeoLink('index.php?link1=logout'));
        }
        $wo['loggedin'] = true;
    }
}
if (!empty($_POST['user_id']) && !empty($_POST['s'])) {
    $application = 'windows';
    if (!empty($_GET['application'])) {
        if ($_GET['application'] == 'phone') {
            $application = Wo_Secure($_GET['application']);
        }
    }
    if ($application == 'windows') {
        $_POST['s'] = md5($_POST['s']);
    }
    $s                = Wo_Secure($_POST['s']);
    $user_id          = Wo_Secure($_POST['user_id']);
    $check_if_session = Wo_CheckUserSessionID($user_id, $s, $application);
    if ($check_if_session === true) {
        $wo['user'] = Wo_UserData($user_id);
        if ($wo['user']['user_id'] < 0 || empty($wo['user']['user_id']) || !is_numeric($wo['user']['user_id']) || Wo_UserActive($wo['user']['username']) === false) {
            $json_error_data = array(
                'api_status' => '400',
                'api_text' => 'failed',
                'errors' => array(
                    'error_id' => '7',
                    'error_text' => 'User id is wrong.'
                )
            );
            header("Content-type: application/json");
            echo json_encode($json_error_data, JSON_PRETTY_PRINT);
            exit();
        }
        $wo['loggedin'] = true;
    } else {
        $json_error_data = array(
            'api_status' => '400',
            'api_text' => 'failed',
            'errors' => array(
                'error_id' => '6',
                'error_text' => 'Session id is wrong.'
            )
        );
        header("Content-type: application/json");
        echo json_encode($json_error_data, JSON_PRETTY_PRINT);
        exit();
    }
}
// Language Function
if (isset($_GET['lang']) AND !empty($_GET['lang'])) {
    $lang_name = Wo_Secure(strtolower($_GET['lang']));
    if (in_array($lang_name, $langs)) {
        $_SESSION['lang'] = $lang_name;
        if ($wo['loggedin'] == true) {
            mysqli_query($sqlConnect, "UPDATE " . T_USERS . " SET `language` = '" . $lang_name . "' WHERE `user_id` = " . Wo_Secure($wo['user']['user_id']));
        }
    }
}
if (empty($_SESSION['lang'])) {
    $_SESSION['lang'] = $wo['config']['defualtLang'];
}
$wo['language']      = $_SESSION['lang'];
$wo['language_type'] = 'ltr';
// Add rtl languages here.
$rtl_langs           = array(
    'arabic'
);
if (!isset($_COOKIE['ad-con'])) {
    setcookie('ad-con', htmlentities(serialize(array(
        'date' => date('Y-m-d'),
        'ads' => array()
    ))), time() + (10 * 365 * 24 * 60 * 60));
}
$wo['ad-con'] = array();
if (!empty($_COOKIE['ad-con'])) {
    $wo['ad-con'] = unserialize(html_entity_decode($_COOKIE['ad-con']));
}
if (!is_array($wo['ad-con']) || !isset($wo['ad-con']['date']) || !isset($wo['ad-con']['ads'])) {
    setcookie('ad-con', htmlentities(serialize(array(
        'date' => date('Y-m-d'),
        'ads' => array()
    ))), time() + (10 * 365 * 24 * 60 * 60));
}
if (is_array($wo['ad-con']) && isset($wo['ad-con']['date']) && strtotime($wo['ad-con']['date']) < strtotime(date('Y-m-d'))) {
    setcookie('ad-con', htmlentities(serialize(array(
        'date' => date('Y-m-d'),
        'ads' => array()
    ))), time() + (10 * 365 * 24 * 60 * 60));
}

if (!isset($_COOKIE['_us'])) {
    setcookie('_us', time() + (60 * 60 * 24) , time() + (10 * 365 * 24 * 60 * 60));
}

if (isset($_COOKIE['_us']) && $_COOKIE['_us'] < strtotime(date('Y-m-d')) ) {
    setcookie('_us', time() + (60 * 60 * 24) , time() + (10 * 365 * 24 * 60 * 60));
    @mysqli_query($sqlConnect, "DELETE FROM " . T_USER_STORY_MEDIA . " WHERE `expire` < CURDATE()");
    @mysqli_query($sqlConnect, "DELETE FROM " . T_USER_STORY . " WHERE `expire` < CURDATE()");
}



// checking if corrent language is rtl.
foreach ($rtl_langs as $lang) {
    if ($wo['language'] == strtolower($lang)) {
        $wo['language_type'] = 'rtl';
    }
}
// Icons Virables
$error_icon   = '<i class="fa fa-exclamation-circle"></i> ';
$success_icon = '<i class="fa fa-check"></i> ';
// Include Language File
$wo['lang']   = Wo_LangsFromDB($wo['language']);
if (file_exists('assets/languages/extra/' . $wo['language'] . '.php')) {
    require 'assets/languages/extra/' . $wo['language'] . '.php';
}
if (empty($wo['lang'])) {
    $wo['lang'] = Wo_LangsFromDB();
}
$wo['second_post_button_icon']  = ($config['second_post_button'] == 'wonder') ? 'exclamation-circle' : 'thumbs-down';
$wo['second_post_button_text']  = ($config['second_post_button'] == 'wonder') ? $wo['lang']['wonder'] : $wo['lang']['dislike'];
$wo['second_post_button_texts'] = ($config['second_post_button'] == 'wonder') ? $wo['lang']['wonders'] : $wo['lang']['dislikes'];
$wo['marker']                   = '?';
if ($wo['config']['seoLink'] == 0) {
    $wo['marker'] = '&';
}
$wo['feelingIcons']                  = array(
    'happy' => 'smile',
    'loved' => 'heart-eyes',
    'sad' => 'disappointed',
    'so_sad' => 'sob',
    'angry' => 'angry',
    'confused' => 'confused',
    'smirk' => 'smirk',
    'broke' => 'broken-heart',
    'expressionless' => 'expressionless',
    'cool' => 'sunglasses',
    'funny' => 'joy',
    'tired' => 'tired-face',
    'lovely' => 'heart',
    'blessed' => 'innocent',
    'shocked' => 'scream',
    'sleepy' => 'sleeping',
    'pretty' => 'relaxed',
    'bored' => 'unamused'
);
$emo                                 = array(
    ':)' => 'smile',
    '(&lt;' => 'joy',
    '**)' => 'relaxed',
    ':p' => 'stuck-out-tongue-winking-eye',
    ':_p' => 'stuck-out-tongue',
    'B)' => 'sunglasses',
    ';)' => 'wink',
    ':D' => 'grin',
    '/_)' => 'smirk',
    '0)' => 'innocent',
    ':_(' => 'cry',
    ':__(' => 'sob',
    ':(' => 'disappointed',
    ':*' => 'kissing-heart',
    '&lt;3' => 'heart',
    '&lt;/3' => 'broken-heart',
    '*_*' => 'heart-eyes',
    '&lt;5' => 'star',
    ':o' => 'open-mouth',
    ':0' => 'scream',
    'o(' => 'anguished',
    '-_(' => 'unamused',
    'x(' => 'angry',
    'X(' => 'rage',
    '-_-' => 'expressionless',
    ':-/' => 'confused',
    ':|' => 'neutral-face',
    '!_' => 'exclamation',
    ':|' => 'neutral-face',
    ':|' => 'neutral-face',
    ':yum:' => 'yum',
    ':triumph:' => 'triumph',
    ':imp:' => 'imp',
    ':hear_no_evil:' => 'hear-no-evil',
    ':alien:' => 'alien',
    ':yellow_heart:' => 'yellow-heart',
    ':sleeping:' => 'sleeping',
    ':mask:' => 'mask',
    ':no_mouth:' => 'no-mouth',
    ':weary:' => 'weary',
    ':dizzy_face:' => 'dizzy-face',
    ':рersevere:' => 'persevere',
    ':man:' => 'man',
    ':woman:' => 'woman',
    ':boy:' => 'boy',
    ':girl:' => 'girl',
    ':оlder_man:' => 'older-man',
    ':оlder_woman:' => 'older-woman',
    ':cop:' => 'cop',
    ':dancers:' => 'dancers',
    ':speak_no_evil:' => 'speak-no-evil',
    ':lips:' => 'lips',
    ':see_no_evil:' => 'see-no-evil',
    ':dog:' => 'dog',
    ':bear:' => 'bear',
    ':rose:' => 'rose',
    ':gift_heart:' => 'gift-heart',
    ':ghost:' => 'ghost',
    ':bell:' => 'bell',
    ':video_game:' => 'video-game',
    ':soccer:' => 'soccer',
    ':books:' => 'books',
    ':moneybag:' => 'moneybag',
    ':mortar_board:' => 'mortar-board',
    ':hand:' => 'hand',
    ':tiger:' => 'tiger',
    ':elephant:' => 'elephant',
    ':scream_cat:' => 'scream-cat',
    ':monkey:' => 'monkey',
    ':bird:' => 'bird',
    ':snowflake:' => 'snowflake',
    ':sunny:' => 'sunny',
    ':оcean:' => 'ocean',
    ':umbrella:' => 'umbrella',
    ':hibiscus:' => 'hibiscus',
    ':tulip:' => 'tulip',
    ':computer:' => 'computer',
    ':bomb:' => 'bomb',
    ':gem:' => 'gem',
    ':ring:' => 'ring'
);

$wo['countries']                     = array(
    'united-states' => "United States",
    'china' => "China",
    'india' => "India",
    'iran' => "Iiran",
    'japan' => "japan",
    'turkey' => "Turkey",
    'russia' => "Russia",
    'france' => "France",
    'united-kingdom' => "United Kingdom"
);
$wo['film-genres']                   = array(
    'action' => "Action",
    'comedy' => "Comedy",
    'drama' => "Drama",
    'horror' => "Horror",
    'mythological' => "Mythological",
    'war' => "War",
    'adventure' => "Adventure",
    'family' => "Family",
    'sport' => "Sport",
    'animation' => "Animation",
    'crime' => "Crime",
    'fantasy' => "Fantasy",
    'musical' => "Musical",
    'romance' => "Romance",
    'thriller' => "Thriller",
    'history' => "History",
    'documentary' => "Documentary",
    'tvshow' => "TV Show"
);
$emo_full                            = array(
    ':)' => '🙂',
    '(&lt;' => '😂',
    '**)' => '😊',
    ':p' => '😛',
    ':_p' => '😜',
    'B)' => '😎',
    ';)' => '😉',
    ':D' => '😁',
    '/_)' => 'smirk',
    '0)' => 'innocent',
    ':_(' => 'cry',
    ':__(' => 'sob',
    ':(' => 'disappointed',
    ':*' => 'kissing-heart',
    '&lt;3' => 'heart',
    '&lt;/3' => 'broken-heart',
    '*_*' => 'heart-eyes',
    '&lt;5' => 'star',
    ':o' => 'open-mouth',
    ':0' => 'scream',
    'o(' => 'anguished',
    '-_(' => 'unamused',
    'x(' => 'angry',
    'X(' => 'rage',
    '-_-' => 'expressionless',
    ':-/' => 'confused',
    ':|' => 'neutral-face',
    '!_' => 'exclamation',
    ':|' => 'neutral-face'
);
$wo['emo']                           = $emo;
$wo['profile_picture_width_crop']    = 150;
$wo['profile_picture_height_crop']   = 150;
$wo['profile_picture_image_quality'] = 70;
$wo['redirect']                      = 0;
$wo['footer_pages']                  = array(
    'terms',
    'oops',
    'messages',
    'start_up',
    '404',
    'search',
    'admin',
    'user_activation',
    'upgraded',
    'go_pro',
    'video',
    'custom_page',
    'products',
    'read-blog',
    'blog',
    'My-Blogs',
    'edit-blog',
    'create_blog',
    'developers',
    'movies',
    'ads'
);
$wo['update_cache']                  = '';
if (!empty($wo['config']['last_update'])) {
    $update_cache = time() - 21600;
    if ($update_cache < $wo['config']['last_update']) {
        $wo['update_cache'] = '?' . sha1(time());
    }
}
$wo['css_file_header']   = "
<style>
.navbar-default {
   height:45px !important;
   display: block !important;
   visibility: visible !important;
}
</style>
";
$colors                  = $wo['colors'] = shuffle_assoc(array(
    '#b582af',
    '#a84849',
    '#fc9cde',
    '#f9c270',
    '#70a0e0',
    '#56c4c5',
    '#51bcbc',
    '#f33d4c',
    '#a1ce79',
    '#a085e2',
    '#ed9e6a',
    '#2b87ce',
    '#f2812b',
    '#0ba05d',
    '#f9a722',
    '#8ec96c',
    '#01a5a5',
    '#5462a5',
    '#609b41',
    '#ff72d2',
    '#008484',
    '#c9605e',
    '#aa2294',
    '#056bba',
    '#0e71ea'
));

$wo['currencies'] = array(
    array (
        'text' => 'USD',
        'symbol' => '$'
    ),
    array (
        'text' => 'EUR',
        'symbol' => '€'
    ),
    array (
        'text' => 'TRY',
        'symbol' => '₺'
    ),
);

$wo['family'] = array(
    1  => 'mother',
    2  => 'father',
    3  => 'daughter',
    4  => 'son',
    5  => 'sister',
    6  => 'brother',
    7  => 'auntie',
    8  => 'uncle',
    10 => 'niece' ,
    11 => 'nephew',
    12 => 'cousin_female',
    13 => 'cousin_male',
    14 => 'grandmother',
    15 => 'grandfather',
    16 => 'granddaughter',
    17 => 'grandson',
    18 => 'stepsister',
    19 => 'stepbrother',
    20 => 'stepmother',
    21 => 'stepfather',
    22 => 'stepdaughter',
    23 => 'sister_in_law',
    24 => 'brother_in_law',
    25 => 'mother_in_law',
    26 => 'father_in_law',
    27 => 'daughter_in_law',
    28 => 'son_in_law',
    29 => 'sibling_gender_neutral',
    30 => 'parent_gender_neutral',
    31 => 'child_gender_neutral',
    32 => 'sibling_of_parent_gender_neutral',
    33 => 'child_of_sibling_gender_neutral',
    34 => 'cousin_gender_neutral',
    35 => 'grandparent_gender_neutral',
    36 => 'grandchild_gender_neutral',
    37 => 'step_sibling_gender_neutral',
    38 => 'step_parent_gender_neutral',
    39 => 'stepchild_gender_neutral',
    40 => 'sibling_in_law_gender_neutral',
    41 => 'parent_in_law_gender_neutral',
    42 => 'child_in_law_gender_neutral',
);

$star_package_duration   = 604800; // week in seconds
$hot_package_duration    = 2629743; // month in seconds
$ultima_package_duration = 31556926; // year in seconds
$vip_package_duration    = 0; // life time package
require_once('assets/includes/paypal_config.php');
require_once('assets/includes/stripe_config.php');
require_once('assets/import/s3/aws-autoloader.php');
require_once('assets/import/twilio/vendor/autoload.php');
require_once('assets/includes/onesignal_config.php');
?>