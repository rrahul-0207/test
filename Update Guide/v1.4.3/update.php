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
@ini_set("memory_limit", "-1");
@set_time_limit(0);
if (empty($config['is_utf8'])) {
    $tables      = false;
    $backup_name = false;
    $mysqli      = new mysqli($sql_db_host, $sql_db_user, $sql_db_pass, $sql_db_name);
    $mysqli->select_db($sql_db_name);
    $mysqli->query('SET NAMES utf8');
    $queryTables = $mysqli->query('SHOW TABLES');
    while ($row = $queryTables->fetch_row()) {
        $target_tables[] = $row[0];
    }
    if ($tables !== false) {
        $target_tables = array_intersect($target_tables, $tables);
    }
    $content = "-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- Host Connection Info: " . $mysqli->host_info . "
-- Generation Time: " . date('F d, Y \a\t H:i A ( e )') . "
-- Server version: " . mysqli_get_server_info($mysqli) . "
-- PHP Version: " . PHP_VERSION . "
--\n
SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
SET time_zone = \"+00:00\";\n
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;\n\n";
    foreach ($target_tables as $table) {
        $result        = $mysqli->query('SELECT * FROM ' . $table);
        $fields_amount = $result->field_count;
        $rows_num      = $mysqli->affected_rows;
        $res           = $mysqli->query('SHOW CREATE TABLE ' . $table);
        $TableMLine    = $res->fetch_row();
        $content       = (!isset($content) ? '' : $content) . "
-- ---------------------------------------------------------
--
-- Table structure for table : `{$table}`
--
-- ---------------------------------------------------------
\n" . $TableMLine[1] . ";\n";
        for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
            while ($row = $result->fetch_row()) {
                if ($st_counter % 100 == 0 || $st_counter == 0) {
                    $content .= "\n--
-- Dumping data for table `{$table}`
--\n\nINSERT INTO " . $table . " VALUES";
                }
                $content .= "\n(";
                for ($j = 0; $j < $fields_amount; $j++) {
                    $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                    if (isset($row[$j])) {
                        $content .= '"' . $row[$j] . '"';
                    } else {
                        $content .= '""';
                    }
                    if ($j < ($fields_amount - 1)) {
                        $content .= ',';
                    }
                }
                $content .= ")";
                if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                    $content .= ";\n";
                } else {
                    $content .= ",";
                }
                $st_counter = $st_counter + 1;
            }
        }
        $content .= "";
    }
    $content .= "
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    $file_          = 'SQL-Backup-' . time() . '-' . date('d-m-Y') . '.sql';
    $folder_name    = 'update_backups';
    $last_file_name = $folder_name . '/' . $file_;
    if (!file_exists('update_backups')) {
        @mkdir('update_backups', 0777, true);
    }
    $put = @file_put_contents($last_file_name, $content);
    if ($put) {
        $result = mysqli_query($sqlConnect, 'SHOW TABLES;');
        while ($tables = mysqli_fetch_assoc($result)) {
            foreach ($tables as $key => $table) {
                if (file_exists($last_file_name)) {
                    $result_2 = mysqli_query($sqlConnect, "SHOW COLUMNS FROM $table;");
                    while ($column = mysqli_fetch_assoc($result_2)) {
                        $column1 = $column['Field'];
                        $query__ = "UPDATE
    $table

SET
    $column1 =
    CASE
        WHEN CONVERT(CAST(CONVERT($column1 USING latin1) AS BINARY) USING utf8) IS NULL THEN $column1
        ELSE CONVERT(CAST(CONVERT($column1 USING latin1) AS BINARY) USING utf8)
    END";
                        $query   = mysqli_query($sqlConnect, $query__);
                    }
                }
            }
        }
        if (file_exists($last_file_name)) {
            $query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'is_utf8', '1');");
        }
    }
}
if (!empty($config['updated_latest'])) {
    die('You have already run this file and updated the script to v1.4.3 !');
}

$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Apps_Hash` (
`id` int(11) NOT NULL,
`hash_id` varchar(200) NOT NULL DEFAULT '',
`user_id` int(11) NOT NULL DEFAULT '0',
`active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Apps_Hash`
ADD PRIMARY KEY (`id`),
ADD KEY `hash_id` (`hash_id`),
ADD KEY `active` (`active`);");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Apps_Hash`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");


$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'alipay', 'no');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'sms_t_phone_number', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'audio_chat', '0');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'sms_twilio_username', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'sms_twilio_password', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'sms_provider', 'bulksms');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'footer_background', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'footer_text_color', '');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'sms_provider', 'bulksms');");


$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Langs` (
  `id` int(11) NOT NULL,
  `lang_key` varchar(160) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `english` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Langs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang_key` (`lang_key`);");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Langs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");


$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_AudioCalls` (
  `id` int(11) NOT NULL,
  `call_id` varchar(30) NOT NULL DEFAULT '0',
  `access_token` text,
  `call_id_2` varchar(30) NOT NULL DEFAULT '',
  `access_token_2` text,
  `from_id` int(11) NOT NULL DEFAULT '0',
  `to_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `called` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `declined` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_AudioCalls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_id` (`to_id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `call_id` (`call_id`),
  ADD KEY `called` (`called`),
  ADD KEY `declined` (`declined`);");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_AudioCalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Products` ADD `location` TEXT NULL DEFAULT NULL AFTER `price`;");

if ($query) {
    require 'assets/languages/english.php';
    $insert_value = "INSERT INTO `Wo_Langs` (`lang_key`, `english`) VALUE ";
    $data         = array();
    foreach ($wo['lang'] as $lang_key => $lang_value) {
        $lang_value = Wo_Secure($lang_value);
        $lang_key   = Wo_Secure($lang_key);
        $data[]     = "('$lang_key', '$lang_value')";
    }
    $insert_value .= implode(', ', $data);
    $query_select     = mysqli_query($sqlConnect, "SELECT COUNT(*) as count FROM Wo_Langs");
    $sql_query_select = mysqli_fetch_assoc($query_select);
    if ($sql_query_select['count'] < 10) {
        $query = mysqli_query($sqlConnect, $insert_value);
    }
    if (!file_exists('assets/languages/extra')) {
        @mkdir('assets/languages/extra', 0777, true);
    }
    $query = mysqli_query($sqlConnect, "SET NAMES utf8");
    foreach (Wo_GetLanguages() as $key => $value) {
        $lang    = $value;
        $explode = explode('.', $lang);
        if (!empty($explode[0])) {
            if ($explode[0] != 'english' && $explode[0] != 'extra') {
                $lang_name = Wo_Secure($explode[0]);
                require 'assets/languages/' . $lang_name . '.php';
                $query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Langs` ADD `$lang_name` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;");
                if ($query) {
                    foreach ($wo['lang'] as $lang_key => $lang_value) {
                        $lang_key     = Wo_Secure($lang_key);
                        $lang_value   = Wo_Secure($lang_value);
                        $insert_value = "UPDATE `Wo_Langs` SET `$lang_name` = '$lang_value' WHERE `lang_key` = '$lang_key'";
                        $query        = mysqli_query($sqlConnect, $insert_value);
                    }
                }
                if (!file_exists('assets/languages/extra/' . $lang_name . '.php')) {
                    $content = file_get_contents('assets/languages/extra/english.php');
                    $fp      = fopen("assets/languages/extra/$lang_name.php", "wb");
                    fwrite($fp, $content);
                    fclose($fp);
                }
            }
        }
    }
    $data = array();
    $query = mysqli_query($sqlConnect, "SHOW COLUMNS FROM `Wo_Langs`");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data['Field'];
    }
    unset($data[0]);
    unset($data[1]);
    function Wo_UpdateLangs($lang, $key, $value) {
        $update_query = "UPDATE Wo_Langs SET `{lang}` = '{lang_text}' WHERE `lang_key` = '{lang_key}'";
        $update_replace_array = array("{lang}", "{lang_text}", "{lang_key}");
        return str_replace(
            $update_replace_array,
            array($lang, $value, $key),
            $update_query
        );
    }
    $lang_update_queries = array();
    
    foreach ($data as $key => $value) {
        $value = Wo_Secure($value);
        if ($value == 'arabic') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'إتصال جديد');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'مكالمة صوتية');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'يتحدث مع');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'يريد التحدث معك.');
        } else if ($value == 'dutch') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Nieuwe audiogesprek');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'audio oproep');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'praten met');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'wil met je praten.');
        } else if ($value == 'french') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Nouveau appel audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Appel audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'parler avec');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'Veut parler avec vous');
        } else if ($value == 'german') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Neuer Audioanruf');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Audioanruf');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'sprechen mit');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'Möchte mit Ihnen sprechen.');
        } else if ($value == 'italian') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Nuova chiamata audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'chiamata audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'parlando con');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'vuole parlare con te.');
        } else if ($value == 'portuguese') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Nova chamada de áudio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Chamada de áudio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'conversando com');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'Quer falar com você');
        } else if ($value == 'russian') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Новый аудио вызов');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Аудиовызов');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'говорить с');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'хочет поговорить с вами.');
        } else if ($value == 'spanish') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Nueva llamada de audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'llamada de audio');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'Hablando con');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'Quiere hablar contigo');
        } else if ($value == 'turkish') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'Yeni sesli çağrı');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Sesli arama');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'ile konuşmak');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'Seninle konuşmak istiyor.');
        } else if ($value != 'english') {
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call', 'New audio call');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call', 'Audio call');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'audio_call_desc', 'talking with');
            $lang_update_queries[] = Wo_UpdateLangs($value, 'new_audio_call_desc', 'wants to talk with you.');
        }
    }
    if (!empty($lang_update_queries)) {
        foreach ($lang_update_queries as $key => $query) {
            $sql = mysqli_query($sqlConnect, $query);
        }
    }
    $query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'updated_latest', '1');");
    echo 'The script is successfully updated to v1.4.3!';
    $name = md5(microtime()) . '_updated.php';
    rename('update.php', $name);
    exit();
}
?>