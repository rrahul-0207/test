<?php 
if ($wo['loggedin'] == false || $wo['config']['user_ads'] == 0) {
  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
  exit();

}

$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'ads';
$wo['title']       = 'Manage ads';
$wo['ads']         = Wo_GetMyAds();
$wo['content']     = Wo_LoadPage('ads/content');
 ?>