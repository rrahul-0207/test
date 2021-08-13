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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'حقوق النشر © {date} {site_name} . جميع الحقوق محفوظة');
    } else if ($value == 'dutch') {
       $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Copyright © {date} {site_name}. All rights reserved.');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Copyright © {date} {site_name}. All rights reserved.');
    } else if ($value == 'german') {
       $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Copyright © {date} {site_name}. Alle Rechte vorbehalten.');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Copyright © {date} {site_name}. Tutti i diritti riservati.');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Direitos reservados © {date} {site_name}. Todos os direitos reservados.');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Авторские права © {date} {site_name}. Все права защищены.');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Copyright © {date} {site_name}. Todos los derechos reservados.');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'copyrights', 'Telif hakkı © {date} {site_name}. Bütün haklar saklıdır.');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
$query = mysqli_query($sqlConnect, "INSERT INTO " . T_CONFIG . " (`id`, `name`, `value`) VALUES (NULL, 'classified_currency', 'USD');");
$query = mysqli_query($sqlConnect, "INSERT INTO " . T_CONFIG . " (`id`, `name`, `value`) VALUES (NULL, 'classified_currency_s', '$');");
$query = mysqli_query($sqlConnect, "INSERT INTO " . T_CONFIG . " (`id`, `name`, `value`) VALUES (NULL, 'mime_types', 'text/plain,video/mp4,video/mov,video/mpeg,video/flv,video/avi,video/webm,audio/wav,audio/mpeg,video/quicktime,audio/mp3,image/png,image/jpeg,image/gif,application/pdf,application/msword,application/zip,application/x-rar-compressed,text/pdf,application/x-pointplus,text/css');");
if (1 == 1) {
    if (is_dir('update_backups')) {
        if (!file_exists("update_backups/index.html")) {
            $f = @fopen("update_backups/index.html", "a+");
            @fwrite($f, "");
            @fclose($f);
        }
        if (!file_exists('update_backups/.htaccess')) {
            $f = @fopen("update_backups/.htaccess", "a+");
            @fwrite($f, "deny from all\nOptions -Indexes");
            @fclose($f);
        }
    }
    echo 'The script is successfully updated to v1.4.4!';
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
    exit();
}