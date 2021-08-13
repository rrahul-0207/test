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

$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '1.5.3' WHERE `name` = 'script_version'");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'push_notifications', '0'), (NULL, 'push_messages', '0'), (NULL, 'update_db_153', 'updated');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Notifications` ADD `sent_push` INT NOT NULL DEFAULT '0' AFTER `seen`, ADD INDEX (`sent_push`);");

$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_messages_here_yet')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'conver_deleted')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'group_name_limit')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'group_avatar_image')");

$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order1 (user_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order2 (page_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order3 (group_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order4 (recipient_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order5 (event_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Posts ADD INDEX order6 (parent_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Activities ADD INDEX order1 (user_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Activities ADD INDEX order2 (post_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Albums_Media ADD INDEX order1 (post_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_BlogCommentReplies ADD INDEX order1 (comm_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_BlogCommentReplies ADD INDEX order2 (blog_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_BlogCommentReplies ADD INDEX order3 (user_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Comments ADD INDEX order1 (user_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Comments ADD INDEX order2 (page_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Comments ADD INDEX order3 (post_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Comments ADD INDEX order4 (user_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Comments ADD INDEX order5 (post_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Events ADD INDEX order1 (poster_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Events ADD INDEX order2 (id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Followers ADD INDEX order1 (following_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Followers ADD INDEX order2 (follower_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order1 (from_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order2 (group_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order3 (to_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order7 (seen, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order8 (time, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order4 (from_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order5 (group_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Messages ADD INDEX order6 (to_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Users ADD INDEX order1 (username, user_id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Users ADD INDEX order2 (email, user_id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Users ADD INDEX order3 (lastseen, user_id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Users ADD INDEX order4 (active, user_id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order1 (seen, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order2 (notifier_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order3 (recipient_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order4 (post_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order5 (page_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order6 (group_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_Notifications ADD INDEX order7 (time, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_UsersChat ADD INDEX order1 (user_id, id DESC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_UsersChat ADD INDEX order2 (user_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_UsersChat ADD INDEX order3 (conversation_user_id, id ASC);");
$query = mysqli_query($sqlConnect, "ALTER TABLE Wo_UsersChat ADD INDEX order4 (conversation_user_id, id DESC);");

if (file_exists('.htaccess') && file_exists('htaccess.txt')) {
    $put = @file_put_contents('.htaccess', file_get_contents('htaccess.txt'));
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
    $value = ($value);
    if ($value == 'arabic') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'لا توجد رسائل حتى الآن.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'تم حذف المحادثة.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'يجب أن يكون اسم المجموعة 4/15 حرفا');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'يجب أن تكون الصورة الرمزية للمجموعة صورة');
        
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Nog geen berichten hier.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Conversatie is verwijderd.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'De groepsnaam moet 4/15 karakters zijn');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Groep avatar moet een afbeelding zijn');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Aucun message n\'est encore ici.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'La conversation a été supprimée.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Le nom du groupe doit comporter 4/15 caractères');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'L\'avatar du groupe doit être une image');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Noch keine Mitteilungen.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Konversation wurde gelöscht.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Der Gruppenname muss 4/15 Zeichen lang sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Gruppen-Avatar muss ein Bild sein');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Non ci sono ancora messaggi qui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'La conversazione è stata eliminata.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Il nome del gruppo deve essere di 4/15 caratteri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'L\'avatar del gruppo deve essere un\'immagine');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Ainda não há mensagens aqui.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'A conversa foi excluída.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'O nome do grupo deve ser de 4/15 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'O avatar do grupo deve ser uma imagem');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Пока сообщений нет.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Разговор удален.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Имя группы должно быть 4/15 символов');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Групповой аватар должен быть изображением');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Aún no hay mensajes.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Se ha eliminado la conversación.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'El nombre del grupo debe tener 4/15 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'El avatar del grupo debe ser una imagen');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'Henüz mesaj yok.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Sohbet silindi.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Grup adı 4/15 karakter olmalıdır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Grup avatar bir resim olmalı');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'No messages yet here.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Conversation has been deleted.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Group name must be 4/15 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Group avatar must be an image');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_messages_here_yet', 'No messages yet here.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'conver_deleted', 'Conversation has been deleted.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_name_limit', 'Group name must be 4/15 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'group_avatar_image', 'Group avatar must be an image');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.5.3!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();