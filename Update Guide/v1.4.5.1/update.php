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

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `videoViews` INT NOT NULL DEFAULT '0' AFTER `blog_id`, ADD INDEX (`videoViews`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Messages` ADD `type_two` VARCHAR(32) NOT NULL DEFAULT '' AFTER `notification_id`;");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'last_update', '" . time() . "');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'movies', '1');");

$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Movies` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `genre` varchar(50) NOT NULL DEFAULT '',
  `stars` varchar(300) NOT NULL DEFAULT '',
  `producer` varchar(100) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL DEFAULT '',
  `release` year(4) DEFAULT NULL,
  `quality` varchar(10) DEFAULT '',
  `duration` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `cover` varchar(500) NOT NULL DEFAULT 'upload/photos/d-film.jpg',
  `source` varchar(1000) NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `genre` (`genre`),
  ADD KEY `country` (`country`),
  ADD KEY `release` (`release`);");
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'yandex_translation_api', 'trnsl.1.1.20170601T212421Z.5834b565b8d47a18.2620528213fbf6ee3335f750659fc342e0ea7923');");

$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'movies')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'translate')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'genre')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'recommended')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'most_watched')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'stars')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'more')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_movies_found')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'producer')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'release')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'quality')");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'more_like_this')");

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
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','??????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','??????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','?????? ????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','???????? ????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','???????????? ????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','??????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','???? ?????? ???????????? ?????? ??????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','???????? ???? ?????? ????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','????????');
	} else if ($value == 'dutch') {
	    $lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Dioscoop');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Vertalen');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Aanbevolen');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Meest bekeken');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Stars');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Producent');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','Meer');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Vrijlating');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','Geen films gevonden');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','Meer in deze trant');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Kwaliteit');
    } else if ($value == 'french') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Films');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Traduire');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Recommand??');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Le plus regard??');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Etoiles');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Producteur');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','Plus');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Sortie');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','Pas de films trouv??s');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','Plus darticles');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Qualit??');
    } else if ($value == 'german') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Kino');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','??bersetzen');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','empfohlen');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Die meisten angeschaut ');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Sterne');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Produzent');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','mehr');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Ver??ffentlichung');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','Keine Filme gefunden');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','??hnliche Titel');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Qualit??t');
    } else if ($value == 'italian') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Film');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Tradurre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genere');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Raccomandato');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Pi?? visto');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Stars');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Produttore');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','Pi??');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Rilascio');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','Nessun film trovato');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','Altri risultati simili');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Qualit??');
    } else if ($value == 'portuguese') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Filmes');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Traduzir');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','G??nero');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Recomendado');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Mais visto');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Estrelas');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Produtor');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','Mais');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Lan??amento');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','N??o h?? filmes encontrados');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','Mais como este');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Qualidade');
    } else if ($value == 'russian') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','??????????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','??????????????????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','??????????????????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','????????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','??????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','??????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','???????????? ???? ??????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','?????????????? ????????????');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','????????????????');
    } else if ($value == 'spanish') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Pel??culas');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Traducciones');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Se recomienda');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','M??s informaci??n');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Estrellas');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Producer');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','M??s informaci??n');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Versi??n');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','No movies found');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','M??s informaci??n');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Calidad');
    } else if ($value == 'turkish') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Filmler');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','??evirmek');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','tarz');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Tavsiye');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','En ??ok izlenen');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','y??ld??z');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','yap??mc??');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','daha');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','sal??verme');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','Filmlerde Bulunan');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','Buna benzer');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','kalite');
    } else if ($value == 'english') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Movies');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Translate');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Recommended');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Most watched');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Stars');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Producer');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','More');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Release');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','No movies found');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','More like this');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Quality');
    } else if ($value != 'english') {
    	$lang_update_queries[] = Wo_UpdateLangs($value, 'movies','Movies');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'translate','Translate');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'genre','Genre');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'recommended','Recommended');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'most_watched','Most watched');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'stars','Stars');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'producer','Producer');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more','More');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'release','Release');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'no_movies_found','No movies found');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'more_like_this','More like this');
		$lang_update_queries[] = Wo_UpdateLangs($value, 'quality','Quality');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
$upload_s3            = Wo_UploadToS3('upload/photos/d-film.jpg');

echo 'The script is successfully updated to v1.4.5.1!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();