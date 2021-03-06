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
$query = mysqli_query($sqlConnect, "CREATE TABLE `Wo_Blog` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL DEFAULT '',
  `content` text,
  `description` text,
  `posted` varchar(300) DEFAULT '0',
  `category` int(255) DEFAULT '0',
  `thumbnail` varchar(100) DEFAULT 'upload/photos/d-blog.jpg',
  `view` int(11) DEFAULT '0',
  `shared` int(11) DEFAULT '0',
  `tags` varchar(300) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Blog` ADD PRIMARY KEY (`id`);") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Blog` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Users` ADD `social_login` ENUM('0','1') NOT NULL DEFAULT '0' AFTER `order_posts_by`;") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'footer_background_n', '');") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'blogs', '1');") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Blog` ADD INDEX(`user`);") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Blog` ADD INDEX(`title`);") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "ALTER TABLE `Wo_Posts` ADD `blog_id` INT NOT NULL DEFAULT '0' AFTER `poll_id`;") or die(mysqli_error($sqlConnect));
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Config` (`id`, `name`, `value`) VALUES (NULL, 'can_blogs', '0');") or die(mysqli_error($sqlConnect));

$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'by');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'load_more_blogs');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'blog');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'no_blogs_found');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'most_recent_art');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'create_new_article');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'my_articles');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'title');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'content');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'select');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'tags');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'thumbnail');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'published');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'views');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'article_updated');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'article_added');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'title_more_than10');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'desc_more_than32');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'please_fill_tags');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'error_found');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'posted_on_blog');");
$query = mysqli_query($sqlConnect, "INSERT INTO `Wo_Langs` (`id`, `lang_key`) VALUES (NULL, 'created_new_blog');");

$upload_s3 = @Wo_UploadToS3('upload/photos/d-blog.jpg');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', '?????????? ???????????? ???? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', '???? ?????? ???????????? ?????? ?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', '???????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', '?????????? ?????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', '??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', '???????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', '????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', '???? ?????????? ???????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', '?????? ?????????? ???????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', '?????? ???? ???????? ?????????????? ???????? ???? 10 ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', '?????? ???? ???????? ?????????? ???????? ???? 32 ????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', '???????? ?????? ?????? ????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', '?????? ???????? ???????? ?????????? ???????????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', '?????? {BLOG_TIME} ???? {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', '?????????? ?????????? ??????????');
    } else if ($value == 'dutch') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Door');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Laad meer artikelen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Geen artikelen gevonden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Meest recente artikelen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Nieuwe artikel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'mijn artikelen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Inhoud');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'kiezen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'thumbnail');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Gepubliceerd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Uitzichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Uw artikel is bijgewerkt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Uw artikel is succesvol toegevoegd');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Titel moet meer zijn dan 10 tekens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Beschrijving moet meer zijn dan 32 tekens');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Vul het veld labels');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Fout gevonden, probeer het later opnieuw');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'cre??erde nieuwe artikel');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Par');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Chargez plus d\'articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Aucun article trouv??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Articles les plus r??cents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Cr??er un nouvel article');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Mes articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Contenu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'S??lectionner');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Mots cl??s');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'La vignette');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publi??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Vues');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Votre article a ??t?? mis ?? jour avec succ??s');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Votre article a ??t?? ajout?? avec succ??s');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Le titre doit comporter plus de 10 caract??res');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'La description doit comporter plus de 32 caract??res');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Remplissez le champ tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Une erreur a ??t?? trouv??e, r??essayez plus tard');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Nouvel article cr????');
    } else if ($value == 'german') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Durch');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Laden Sie weitere Artikel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Keine Artikel gefunden');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Die neuesten Artikel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Erstellen Sie einen neuen Artikel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Meine Artikel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titel');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Inhalt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'W??hlen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniaturansicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Ver??ffentlicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Ansichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Ihr Artikel wurde erfolgreich aktualisiert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Ihr Artikel wurde erfolgreich hinzugef??gt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Titel sollte mehr als 10 Zeichen sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Beschreibung sollte mehr als 32 Zeichen sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Bitte f??llen Sie das Etikettenfeld aus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Fehler gefunden, bitte sp??ter nochmal versuchen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Erstellt neuen Artikel');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Di');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Carica altri articoli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Nessun articolo trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Articoli pi?? recenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Crea un nuovo articolo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'I miei articoli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titolo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Soddisfare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Selezionare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Thumbnail');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Pubblicato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Visualizzazioni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Il tuo articolo ?? stato aggiornato con successo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Il tuo articolo ?? stato aggiunto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Il titolo dovrebbe essere pi?? di 10 caratteri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Descrizione dovrebbe essere pi?? di 32 caratteri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Si prega di compilare il campo tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Errore trovato, si prega di riprovare pi?? tardi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'nuovo articolo creato');
    } else if ($value == 'portuguese') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'De');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Carregar mais artigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Nenhum artigo encontrado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Artigos mais recentes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Criar novo artigo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Meus artigos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'T??tulo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Conte??do');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Selecionar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniatura');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publicados');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Visualiza????es');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Seu artigo foi atualizado com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Seu artigo foi adicionado com ??xito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'O t??tulo deve ter mais de 10 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'A descri????o deve ter mais de 32 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Preencha o campo de tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Ocorreu um erro, tente novamente mais tarde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Criou um novo artigo');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', '????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', '?????????????????? ???????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', '???????????? ???? ??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', '?????????????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', '?????????????? ?????????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', '?????? ????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', '????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', '????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', '??????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', '????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', '???????????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', '????????????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', '??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', '???????? ???????????? ?????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', '???????? ???????????? ?????????????? ??????????????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', '?????????????????? ???????????? ?????????????????? ?????????? 10 ????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', '???????????????? ???????????? ?????????????????? ?????????? 32 ????????????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', '????????????????????, ?????????????????? ???????? ??????????');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', '???????????? ??????????????. ?????????????????? ?????????????? ??????????.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', '???????????? ?????????? ????????????');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Cargar m??s art??culos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'No se encontraron art??culos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Art??culos m??s recientes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Crear un nuevo art??culo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Mis art??culos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'T??tulo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Contenido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Seleccionar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Etiquetas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniatura');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publicado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Puntos de vista');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Su art??culo ha sido actualizado con ??xito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Su art??culo ha sido a??adido correctamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'El t??tulo debe tener m??s de 10 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'La descripci??n debe tener m??s de 32 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Por favor rellene el campo de etiquetas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Error encontrado. Vuelve a intentarlo m??s tarde.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Cre?? nuevo art??culo');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Taraf??ndan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Daha fazla makale y??kle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Makale bulunamad??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'En yeni makaleler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Yeni makale olu??tur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Makalelerim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Ba??l??k');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', '????erik');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Se??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Etiketler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'K??????k resim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Yay??nlanan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'G??r??nt??ler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Makaleniz ba??ar??yla g??ncellendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Makalen ba??ar??yla eklendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Ba??l??k en fazla 10 karakter olmal??d??r');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'A????klama 32 karakterden uzun olmal??');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'L??tfen etiketler alan??n?? doldurun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Hata bulundu, l??tfen daha sonra tekrar deneyin.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Yeni makale yazd??');
    } else if ($value == 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'By');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Load more articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'No articles found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Most recent articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Create new article');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'My articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Title');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Content');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Select');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Thumbnail');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Published');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Views');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Your article has been successfully updated');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Your article has been successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Title should be more than 10 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Description should be more than 32 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Please fill the tags field');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Error found, please try again later');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'created new article');
    } else if ($value != 'english') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'By');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Load more articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'No articles found');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Most recent articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Create new article');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'My articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Title');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Content');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Select');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Thumbnail');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Published');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Views');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Your article has been successfully updated');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Your article has been successfully added');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Title should be more than 10 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Description should be more than 32 characters');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Please fill the tags field');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Error found, please try again later');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'created new article');
    }
}
if (!empty($lang_update_queries)) {
    foreach ($lang_update_queries as $key => $query) {
        $sql = mysqli_query($sqlConnect, $query);
    }
}
echo 'The script is successfully updated to v1.4.4.5!';
$name = md5(microtime()) . '_updated.php';
rename('update.php', $name);
exit();
?>