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
if (file_exists('assets/init.php')) {
    require 'assets/init.php';
} else {
    die('Please put this file in the home directory !');
}
$query = mysqli_query($sqlConnect, "INSERT INTO " . T_CONFIG . " (`id`, `name`, `value`) VALUES (NULL, 'footer_background_2', '');");
if ($query) {
    echo 'The script is successfully updated to v1.4.4.2!';
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
    exit();
}