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
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'share_my_location')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'enter_valid_title')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_click')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'pay_per_imprssion')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'top_up')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'balance_is_0')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'messages_delete_confirmation')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'currency')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'friends_stories')");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `share_my_location` INT NOT NULL DEFAULT '1' AFTER `last_location_update`;");
$query = mysqli_query($sqlConnect, "UPDATE Wo_Config SET value = '1' WHERE name = 'age';");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'update_db_152', '" . time() . "');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'script_version', '" . $wo['script_version'] . "');");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Products` ADD `currency` VARCHAR(40) NOT NULL DEFAULT 'USD' AFTER `type`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_UserStory` ADD `thumbnail` VARCHAR(100) NOT NULL DEFAULT '' AFTER `expire`;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `share_my_location` INT NOT NULL DEFAULT '1' AFTER `last_location_update`;");
$query = mysqli_query($sqlConnect, "UPDATE `Wo_Config` SET `value` = '" . time() . "' WHERE `name` = 'last_update'");
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', '???? ???????? ???????????? ?????????? ???? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', '???????? ?????????? ?????????? ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', '?????????? ?????? ???????? (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', '?????????? ?????? ???????? (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', '?????? ??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', '???????? ?????????????? ???????????? ????: 0?? ???????? ???????????? ???????????? ????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', '???? ???????? ???????????????? ?????? ?????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', '??????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', '?????? ????????????????');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Deel mijn locatie met publiek?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Vul alstublieft een geldige titel in');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Betaal per klik (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Betaal per indruk (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Top up');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Uw huidige portemonneebalans is: 0, vul uw portemonnee aan om door te gaan.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Weet u zeker dat u dit gesprek wilt verwijderen?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Valuta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Vriendenverhalen');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Partagez mon emplacement avec le public?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Entrez un titre valide');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pay per Impression (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Remplir');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Votre solde de portefeuille actuel est: 0, veuillez compl??ter votre portefeuille pour continuer.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', '??tes-vous s??r de vouloir supprimer cette conversation?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Devise');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Histoires d\'amis');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Teilen Sie meinen Standort mit der ??ffentlichkeit?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Bitte geben Sie einen g??ltigen Titel ein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pay per Impression (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Nachf??llen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Ihre aktuelle Brieftasche Gleichgewicht ist: 0, bitte nach oben Ihre Brieftasche, um fortzufahren.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Sind Sie sicher, dass Sie diese Konversation l??schen m??chten?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'W??hrung');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Freunde Geschichten');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Condividi la mia posizione con il pubblico?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Si prega di inserire un titolo valido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Riempire');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Il tuo saldo attuale del portafoglio ??: 0, ti preghiamo di riempire il portafoglio per continuare.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Sei sicuro di voler eliminare questa conversazione?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Moneta');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Storie di amici');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Compartilhe minha localiza????o com o p??blico?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Insira um t??tulo v??lido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pague por impress??o (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Completar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Seu saldo de carteira atual ??: 0, por favor, complete sua carteira para continuar.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Tem certeza de que deseja excluir esta conversa?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Moeda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Hist??rias de amigos');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', '???????????????????? ?????????? ?????????????????????????????? ?? ?????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', '?????????????? ???????????????????????????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', '?????????????? ???? ???????? (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', '?????????????? ???? ?????????? (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', '?????? ?????????????? ???????????? ????????????????: 0, ????????????????????, ?????????????????? ???????? ??????????????, ?????????? ????????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', '???? ?????????????????????????? ???????????? ?????????????? ???????? ?????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', '?????????????? ????????????');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Compartir mi ubicaci??n con p??blico?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Ingrese un t??tulo v??lido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pago por clic (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pago por impresi??n (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Completar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Su saldo de cartera actual es: 0, por favor, recargue su cartera para continuar.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', '??Seguro que quieres eliminar esta conversaci??n?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Moneda');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Historias de amigos');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Konumumu halkla payla??mak m?? istiyorsunuz?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'L??tfen ge??erli bir ba??l??k girin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'T??klama ba????na ??de (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'G??sterim Ba????na ??deme (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Ekleyin');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Mevcut c??zdan bakiyeniz: 0, devam etmek i??in l??tfen c??zdan??n??z?? doldurun.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Bu sohbeti silmek istedi??inizden emin misiniz?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Para birimi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Arkada?? Hikayeleri');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Share my location with public?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Please enter a valid title');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Top up');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Your current wallet balance is: 0, please top up your wallet to continue.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Are you sure you want to delete this conversation?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Currency');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Friends Stories');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'share_my_location', 'Share my location with public?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'enter_valid_title', 'Please enter a valid title');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_click', 'Pay Per Click (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'pay_per_imprssion', 'Pay Per Impression (${{PRICE}})');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'top_up', 'Top up');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'balance_is_0', 'Your current wallet balance is: 0, please top up your wallet to continue.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'messages_delete_confirmation', 'Are you sure you want to delete this conversation?');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'currency', 'Currency');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'friends_stories', 'Friends Stories');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.5.2!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
rename('htaccess.txt', '.htaccess');
exit();