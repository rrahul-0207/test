<?php 
if ($wo['loggedin'] == false || !isset($_GET['film-id']) || !is_numeric($_GET['film-id']) || $wo['config']['movies'] == 0) {
  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
  exit();
}
$source = Wo_GetMovies(array('id' => Wo_Secure($_GET['film-id'])));
if (count($source) > 0) {
	$wo['description']   = $source[0]['description'];
	$wo['keywords']      = $wo['config']['siteKeywords'];
	$wo['page']          = 'movies';
	$wo['movie']         = $source[0];
	$wo['related-films'] = Wo_SearchFilms($wo['movie']['name']);
	$wo['title']         = $source[0]['name'];
	$wo['content']       = Wo_LoadPage('movies/watch');
}
