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
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (file_exists('assets/init.php')) {
    require 'assets/init.php';
} else {
    die('Please put this file in the home directory !');
}
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'explore')");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '1.5.3.2' WHERE `name` = 'script_version'");
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'إستكشاف');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Onderzoeken');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Explorer');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Erforschen');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Esplorare');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Explorar');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Исследовать');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Explorar');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Keşfetmek');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Explore');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'explore', 'Explore');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.5.3.2!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
rename('htaccess.txt', '.htaccess');
exit();