<?php 
if ($wo['loggedin'] == false || $wo['config']['user_ads'] == 0) {
  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
  exit();

}

if (isset($_SESSION['replenished_amount']) && $_SESSION['replenished_amount'] > 0){
	$wo['replenishment_notif']  = $wo['lang']['replenishment_notif'] . ' $' .  $_SESSION['replenished_amount'];
	unset($_SESSION['replenished_amount']);
}

$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'ads';
$wo['title']       = 'Wallet';
$wo['ads']         = Wo_GetMyAds();
$wo['content']     = Wo_LoadPage('ads/wallet');
 ?>