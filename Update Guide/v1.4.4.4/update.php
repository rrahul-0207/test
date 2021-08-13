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

$query = mysqli_query($sqlConnect, "INSERT INTO Wo_Langs (`lang_key`) VALUE ('comment_post_label');") or die(mysqli_error($sqlConnect));

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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'علق');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Aanvulling');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Complement');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Complément');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Ergänzen');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Commento');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Comentario');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Комментарий');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Comentario');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Yorum Yap');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'comment_post_label', 'Complement');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}

echo 'The script is successfully updated to v1.4.4.4!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();
?>