<?php
$wo['content']     = '';
$wo['description'] = '';
$wo['keywords']    = '';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $placement = '';
    if ($wo['loggedin'] == true) {
        if (Wo_IsAdmin()) {
            $placement = 'admin';
        }
    }
    $id          = Wo_GetPostIdFromUrl($_GET['id']);
    $wo['story'] = Wo_PostData($id, $placement, 'not_limited');
    if (empty($wo['story'])) {
        header("Location: " . $wo['config']['site_url']);
        exit();
    } else if (empty($wo['story']['post_id'])) {
        header("Location: " . $wo['config']['site_url']);
        exit();
    } else if (Wo_PostExists($wo['story']['post_id']) === false) {
        header("Location: " . $wo['config']['site_url']);
        exit();
    }
    $wo['story']['page'] = 1;
    $wo['content']       = Wo_LoadPage('story-content/content');
    $wo['description']   = Wo_Secure(mb_substr($wo['story']['Orginaltext'], 0, 156, "utf-8"));
    $wo['keywords']      = '';
} else {
    header("Location: " . $wo['config']['site_url']);
    exit();
}
$wo['page']  = 'story';
$wo['title'] = '';
if (!empty($wo['description'])) {
    $wo['title'] = substr($wo['story']['Orginaltext'], 0, 50) . '...';
} else {
    $wo['title'] = 'Post';
}
$wo['title'] .= ' | ' . $wo['config']['siteName'];
?>