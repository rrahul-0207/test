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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'بواسطة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'تحميل المزيد من المقالات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'مدونة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'لم يتم العثور على أية مقالات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'أحدث المقالات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'إنشاء مقالة جديدة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'مقالاتي');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'عنوان');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'يحتوى');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'تحديد');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'العلامات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'صورة مصغرة');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'نشرت');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'الآراء');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'تم تحديث مقالتك بنجاح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'تمت إضافة مقالتك بنجاح');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'يجب أن يكون العنوان أكثر من 10 أحرف');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'يجب أن يكون الوصف أكثر من 32 حرفا');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'يرجى ملء حقل العلامات');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'حدث خطأ، يرجى إعادة المحاولة لاحقا');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'نشر {BLOG_TIME} في {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'إنشاء مقالة جديدة');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'creëerde nieuwe artikel');
    } else if ($value == 'french') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Par');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Chargez plus d\'articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Aucun article trouvé');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Articles les plus récents');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Créer un nouvel article');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Mes articles');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titre');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Contenu');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Sélectionner');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Mots clés');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'La vignette');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publié');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Vues');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Votre article a été mis à jour avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Votre article a été ajouté avec succès');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Le titre doit comporter plus de 10 caractères');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'La description doit comporter plus de 32 caractères');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Remplissez le champ tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Une erreur a été trouvée, réessayez plus tard');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Nouvel article créé');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Wählen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniaturansicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Veröffentlicht');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Ansichten');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Ihr Artikel wurde erfolgreich aktualisiert');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Ihr Artikel wurde erfolgreich hinzugefügt');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Titel sollte mehr als 10 Zeichen sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Beschreibung sollte mehr als 32 Zeichen sein');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Bitte füllen Sie das Etikettenfeld aus');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Fehler gefunden, bitte später nochmal versuchen');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Erstellt neuen Artikel');
    } else if ($value == 'italian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Di');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Carica altri articoli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Nessun articolo trovato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Articoli più recenti');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Crea un nuovo articolo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'I miei articoli');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Titolo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Soddisfare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Selezionare');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Thumbnail');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Pubblicato');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Visualizzazioni');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Il tuo articolo è stato aggiornato con successo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Il tuo articolo è stato aggiunto');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Il titolo dovrebbe essere più di 10 caratteri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Descrizione dovrebbe essere più di 32 caratteri');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Si prega di compilare il campo tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Errore trovato, si prega di riprovare più tardi');
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
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Título');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Conteúdo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Selecionar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Tag');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniatura');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publicados');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Visualizações');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Seu artigo foi atualizado com sucesso');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Seu artigo foi adicionado com êxito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'O título deve ter mais de 10 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'A descrição deve ter mais de 32 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Preencha o campo de tags');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Ocorreu um erro, tente novamente mais tarde');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Criou um novo artigo');
    } else if ($value == 'russian') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'От');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Загрузить другие статьи');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Блог');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Статьи не найдены');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Последние статьи');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Создать новую статью');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Мои статьи');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'заглавие');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Содержание');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Выбрать');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Теги');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Значок видео');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Опубликовано');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Просмотры');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Ваша статья успешно обновлена');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Ваша статья успешно добавлена');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Заголовок должен содержать более 10 символов.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Описание должно содержать более 32 символов.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Пожалуйста, заполните поле тегов');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Ошибка найдена. Повторите попытку позже.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Создал новую статью');
    } else if ($value == 'spanish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Por');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Cargar más artículos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'No se encontraron artículos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'Artículos más recientes');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Crear un nuevo artículo');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Mis artículos');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Título');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'Contenido');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Seleccionar');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Etiquetas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Miniatura');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Publicado');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Puntos de vista');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Su artículo ha sido actualizado con éxito');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Su artículo ha sido añadido correctamente');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'El título debe tener más de 10 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'La descripción debe tener más de 32 caracteres');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Por favor rellene el campo de etiquetas');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Error encontrado. Vuelve a intentarlo más tarde.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Creó nuevo artículo');
    } else if ($value == 'turkish') {
        $lang_update_queries[] = Wo_UpdateLangs($value, 'by', 'Tarafından');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'load_more_blogs', 'Daha fazla makale yükle');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'blog', 'Blog');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'no_blogs_found', 'Makale bulunamadı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'most_recent_art', 'En yeni makaleler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'create_new_article', 'Yeni makale oluştur');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'my_articles', 'Makalelerim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title', 'Başlık');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'content', 'İçerik');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'select', 'Seç');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'tags', 'Etiketler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'thumbnail', 'Küçük resim');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'published', 'Yayınlanan');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'views', 'Görüntüler');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_updated', 'Makaleniz başarıyla güncellendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'article_added', 'Makalen başarıyla eklendi');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'title_more_than10', 'Başlık en fazla 10 karakter olmalıdır');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'desc_more_than32', 'Açıklama 32 karakterden uzun olmalı');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'please_fill_tags', 'Lütfen etiketler alanını doldurun');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'error_found', 'Hata bulundu, lütfen daha sonra tekrar deneyin.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'posted_on_blog', 'Posted {BLOG_TIME} in {CATEGORY_NAME}.');
        $lang_update_queries[] = Wo_UpdateLangs($value, 'created_new_blog', 'Yeni makale yazdı');
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