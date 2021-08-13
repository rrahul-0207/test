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
/* Script Main Functions (File 3) */
function Wo_RegisterProductMedia($id, $media) {
    global $wo, $sqlConnect;
    if (empty($id) or !is_numeric($id) or $id < 1) {
        return false;
    }
    if (empty($media)) {
        return false;
    }
    $query_one = mysqli_query($sqlConnect, "INSERT INTO " . T_PRODUCTS_MEDIA . " (`product_id`,`image`) VALUES ({$id}, '{$media}')");
    if ($query_one) {
        return true;
    }
}
function Wo_RegisterProduct($registration_data) {
    global $wo, $sqlConnect;
    if (empty($registration_data)) {
        return false;
    }
    if (!empty($registration_data['description'])) {
        $link_regex = '/(http\:\/\/|https\:\/\/|www\.)([^\ ]+)/i';
        $i          = 0;
        preg_match_all($link_regex, $registration_data['description'], $matches);
        foreach ($matches[0] as $match) {
            $match_url                        = strip_tags($match);
            $syntax                           = '[a]' . urlencode($match_url) . '[/a]';
            $registration_data['description'] = str_replace($match, $syntax, $registration_data['description']);
        }
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_PRODUCTS . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return mysqli_insert_id($sqlConnect);
    }
    return false;
}
function Wo_GetProduct($id = 0) {
    global $wo, $sqlConnect;
    $data = array();
    if (empty($id) or !is_numeric($id) or $id < 1) {
        return false;
    }
    $query_one    = " SELECT * FROM " . T_PRODUCTS . " WHERE `id` = '{$id}' ORDER BY `id` DESC";
    $sql          = mysqli_query($sqlConnect, $query_one);
    $fetched_data = mysqli_fetch_assoc($sql);
    if (empty($fetched_data)) {
        return array();
    }
    $fetched_data['images']           = Wo_GetProductImages($fetched_data['id']);
    $fetched_data['time_text']        = Wo_Time_Elapsed_String($fetched_data['time']);
    $fetched_data['post_id']          = Wo_GetPostIDFromProdcutID($fetched_data['id']);
    $fetched_data['edit_description'] = Wo_EditMarkup(br2nl($fetched_data['description'], true, false, false));
    $fetched_data['description']      = Wo_Markup($fetched_data['description'], true, false, false);
    $fetched_data['url']              = Wo_SeoLink('index.php?link1=post&id=' . $fetched_data['post_id']);
    return $fetched_data;
}
function Wo_GetProductImages($id = 0) {
    global $wo, $sqlConnect;
    $data      = array();
    $id        = Wo_Secure($id);
    $query_one = "SELECT `id`,`image`,`product_id` FROM " . T_PRODUCTS_MEDIA . " WHERE `product_id` = {$id} ORDER BY `id` DESC";
    $sql       = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql)) {
        $explode2                  = @end(explode('.', $fetched_data['image']));
        $explode3                  = @explode('.', $fetched_data['image']);
        $fetched_data['image_org'] = $explode3[0] . '_small.' . $explode2;
        $fetched_data['image_org'] = Wo_GetMedia($fetched_data['image_org']);
        $fetched_data['image']     = Wo_GetMedia($fetched_data['image']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_ProductImageData($data = array()) {
    global $wo, $sqlConnect;
    if (!empty($data['id'])) {
        $id = Wo_Secure($data['id']);
    }
    $order_by = '';
    if (!empty($data['after_image_id']) && is_numeric($data['after_image_id'])) {
        $data['after_image_id'] = Wo_Secure($data['after_image_id']);
        $subquery               = " `id` <> " . $data['after_image_id'] . " AND `id` < " . $data['after_image_id'];
        $order_by               = 'DESC';
    } else if (!empty($data['before_image_id']) && is_numeric($data['before_image_id'])) {
        $data['before_image_id'] = Wo_Secure($data['before_image_id']);
        $subquery                = " `id` <> " . $data['before_image_id'] . " AND `id` > " . $data['before_image_id'];
        $order_by                = 'ASC';
    } else {
        $subquery = " `id` = {$id}";
    }
    if (!empty($data['post_id']) && is_numeric($data['post_id'])) {
        $data['post_id'] = Wo_Secure($data['post_id']);
        $subquery .= " AND `post_id` = " . $data['post_id'];
    }
    $query_one    = "SELECT * FROM " . T_PRODUCTS_MEDIA . " WHERE $subquery ORDER by `id` {$order_by}";
    $sql          = mysqli_query($sqlConnect, $query_one);
    $fetched_data = mysqli_fetch_assoc($sql);
    if (!empty($fetched_data)) {
        $fetched_data['image_org'] = Wo_GetMedia($fetched_data['image']);
    }
    return $fetched_data;
}
function Wo_GetWelcomeFileds() {
    global $wo, $sqlConnect;
    $data      = array();
    $query_one = " SELECT * FROM " . T_FIELDS . " WHERE `registration_page` = '1' ORDER BY `id` ASC";
    $sql       = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql)) {
        $fetched_data['fid'] = 'fid_' . $fetched_data['id'];
        $fetched_data['name'] = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($wo) {
            return (isset($wo['lang'][$m[1]])) ? $wo['lang'][$m[1]] : '';
        }, $fetched_data['name']);
        $fetched_data['description'] = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($wo) {
            return (isset($wo['lang'][$m[1]])) ? $wo['lang'][$m[1]] : '';
        }, $fetched_data['description']);
        $fetched_data['type'] = preg_replace_callback("/{{LANG (.*?)}}/", function($m) use ($wo) {
            return (isset($wo['lang'][$m[1]])) ? $wo['lang'][$m[1]] : '';
        }, $fetched_data['type']);
        $data[]               = $fetched_data;
    }
    return $data;
}
function Wo_MarkPostAsSold($post_id = 0, $product_id = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $user_id = Wo_Secure($wo['user']['user_id']);
    $post_id = Wo_Secure($post_id);
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 1) {
        return false;
    }
    if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
        return false;
    }
    if (empty($post_id) || !is_numeric($post_id) || $post_id < 1) {
        return false;
    }
    if (Wo_PostExists($post_id) === false) {
        return false;
    }
    if (Wo_IsPostOnwer($post_id, $user_id) === false) {
        return false;
    }
    if (Wo_IsProductSold($product_id)) {
        return false;
    }
    $query_text = "UPDATE " . T_PRODUCTS . " SET `status` = '1' WHERE `id` = '{$product_id}'";
    $query_two  = mysqli_query($sqlConnect, $query_text);
    if ($query_two) {
        return true;
    }
}
function Wo_IsProductSold($id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($id) || !is_numeric($id) || $id < 1) {
        return false;
    }
    $id            = Wo_Secure($id);
    $query_one     = mysqli_query($sqlConnect, "SELECT COUNT(`id`) as `count` FROM " . T_PRODUCTS . " WHERE `id` = {$id} AND `status` = '1'");
    $sql_query_one = mysqli_fetch_assoc($query_one);
    return ($sql_query_one['count'] == 1) ? true : false;
}
function Wo_GetPostIDFromProdcutID($id) {
    global $sqlConnect;
    if (empty($id) or !is_numeric($id) or $id < 1) {
        return false;
    }
    $id            = Wo_Secure($id);
    $query_one     = "SELECT `id` FROM " . T_POSTS . " WHERE `product_id` = '{$id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $sql_fetch_one = mysqli_fetch_assoc($sql_query_one);
    return $sql_fetch_one['id'];
}
function Wo_UpdateProductData($product_id, $update_data) {
    global $wo, $sqlConnect;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($product_id) || !is_numeric($product_id) || $product_id < 0) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    $product_id = Wo_Secure($product_id);
    $post_id    = Wo_GetPostIDFromProdcutID($product_id);
    if (empty($post_id)) {
        return false;
    }
    if (Wo_IsPostOnwer($post_id, $wo['user']['user_id']) === false) {
        return false;
    }
    $update = array();
    if (!empty($update_data['description'])) {
        $link_regex = '/(http\:\/\/|https\:\/\/|www\.)([^\ ]+)/i';
        $i          = 0;
        preg_match_all($link_regex, $update_data['description'], $matches);
        foreach ($matches[0] as $match) {
            $match_url                  = strip_tags($match);
            $syntax                     = '[a]' . urlencode($match_url) . '[/a]';
            $update_data['description'] = str_replace($match, $syntax, $update_data['description']);
        }
    }
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = " UPDATE " . T_PRODUCTS . " SET {$impload} WHERE `id` = {$product_id}";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_GetProducts($filter_data = array()) {
    global $wo, $sqlConnect;
    $data      = array();
    $query_one = " SELECT `id`, `user_id` FROM " . T_PRODUCTS . " WHERE status <> '1'";
    if (!empty($filter_data['c_id'])) {
        $category = $filter_data['c_id'];
        $query_one .= " AND `category` = '{$category}'";
    }
    if (!empty($filter_data['after_id'])) {
        if (is_numeric($filter_data['after_id'])) {
            $after_id = Wo_Secure($filter_data['after_id']);
            $query_one .= " AND `id` < '{$after_id}' AND `id` <> $after_id";
        }
    }
    if (!empty($filter_data['keyword'])) {
        $keyword = Wo_Secure($filter_data['keyword']);
        $query_one .= " AND `name` LIKE '%{$keyword}%'";
    }
    if (!empty($filter_data['user_id'])) {
        $user_id = Wo_Secure($filter_data['user_id']);
        $query_one .= " AND `user_id` = '{$user_id}'";
    }
    $query_one .= " ORDER BY `id` DESC";
    if (!empty($filter_data['limit'])) {
        if (is_numeric($filter_data['limit'])) {
            $limit = Wo_Secure($filter_data['limit']);
            $query_one .= " LIMIT {$limit}";
        }
    }
    $sql = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql)) {
        $products           = Wo_GetProduct($fetched_data['id']);
        $products['seller'] = Wo_UserData($fetched_data['user_id']);
        $data[]             = $products;
    }
    return $data;
}
function Wo_AddOption($post_id, $text) {
    global $wo, $sqlConnect;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($post_id) || !is_numeric($post_id) || $post_id < 0) {
        return false;
    }
    if (empty($text)) {
        return false;
    }
    $post_id   = Wo_Secure($post_id);
    $text      = Wo_Secure($text);
    $time      = time();
    $query_one = "INSERT INTO " . T_POLLS . " (`post_id`, `text`, `time`) VALUES ('{$post_id}', '{$text}', '{$time}')";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_GetPostOptions($post_id = 0) {
    global $sqlConnect;
    if (empty($post_id) or !is_numeric($post_id) or $post_id < 1) {
        return false;
    }
    $data          = array();
    $post_id       = Wo_Secure($post_id);
    $query_one     = "SELECT * FROM " . T_POLLS . " WHERE `post_id` = '{$post_id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data[] = $fetched_data;
    }
    return $data;
}
function Wo_GetPostIDFromOptionID($id) {
    global $sqlConnect;
    if (empty($id) or !is_numeric($id) or $id < 1) {
        return false;
    }
    $id            = Wo_Secure($id);
    $query_one     = "SELECT `post_id` FROM " . T_POLLS . " WHERE `id` = '{$id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $sql_fetch_one = mysqli_fetch_assoc($sql_query_one);
    return $sql_fetch_one['post_id'];
}
function Wo_VoteUp($option_id = 0, $user_id = 0) {
    global $sqlConnect;
    if (empty($user_id) or !is_numeric($user_id) or $user_id < 1) {
        return false;
    }
    if (empty($option_id) or !is_numeric($option_id) or $option_id < 1) {
        return false;
    }
    $user_id   = Wo_Secure($user_id);
    $option_id = Wo_Secure($option_id);
    $post_id   = Wo_GetPostIDFromOptionID($option_id);
    if (empty($post_id)) {
        return false;
    }
    if (Wo_IsPostVoted($post_id, $user_id)) {
        return false;
    }
    if (Wo_IsOptionVoted($option_id, $user_id)) {
        return false;
    }
    $fields    = '(`option_id`, `user_id`, `post_id`)';
    $query_one = "INSERT INTO " . T_VOTES . " {$fields} VALUES ('{$option_id}', '{$user_id}', '{$post_id}')";
    $sql       = mysqli_query($sqlConnect, $query_one);
    if ($sql) {
        return true;
    }
}
function Wo_IsOptionVoted($option_id, $user_id) {
    global $wo, $sqlConnect;
    if (empty($user_id) || empty($option_id)) {
        return false;
    }
    if (!is_numeric($option_id)) {
        return false;
    }
    $user_id   = Wo_Secure($user_id);
    $option_id = Wo_Secure($option_id);
    $query_one = "SELECT COUNT(id) as count FROM " . T_VOTES . " WHERE `option_id` = '{$option_id}' AND `user_id` = '{$user_id}'";
    $sql       = mysqli_query($sqlConnect, $query_one);
    $sql_fetch = mysqli_fetch_assoc($sql);
    if ($sql_fetch['count'] > 0) {
        return true;
    }
    return false;
}
function Wo_IsPostVoted($post_id, $user_id) {
    global $wo, $sqlConnect;
    if (empty($user_id) || empty($post_id)) {
        return false;
    }
    if (!is_numeric($post_id)) {
        return false;
    }
    $user_id   = Wo_Secure($user_id);
    $post_id   = Wo_Secure($post_id);
    $query_one = "SELECT COUNT(id) as count FROM " . T_VOTES . " WHERE `post_id` = '{$post_id}' AND `user_id` = '{$user_id}'";
    $sql       = mysqli_query($sqlConnect, $query_one);
    $sql_fetch = mysqli_fetch_assoc($sql);
    if ($sql_fetch['count'] > 0) {
        return true;
    }
    return false;
}
function Ju_GetPercentageOfOptionPost($post_id) {
    global $wo, $sqlConnect;
    if (empty($post_id)) {
        return false;
    }
    if (!is_numeric($post_id)) {
        return false;
    }
    $data          = array();
    $post_id       = Wo_Secure($post_id);
    $query_one     = "SELECT * FROM " . T_POLLS . " WHERE `post_id` = '{$post_id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $all           = 0;
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $fetched_data['option_votes'] = Wo_GetVotes($fetched_data['id']);
        $data[]                       = $fetched_data;
    }
    foreach ($data as $key => $value) {
        $all += $value['option_votes'];
    }
    $percentage_total = $all;
    foreach ($data as $key => $value) {
        $percentage                   = 0;
        $data[$key]['percentage']     = '0%';
        $data[$key]['percentage_num'] = 0;
        $data[$key]['all']            = $all;
        if ($percentage_total > 0) {
            $data[$key]['percentage']     = number_format(($value['option_votes'] / $percentage_total) * 100) . '%';
            $data[$key]['percentage_num'] = number_format(($value['option_votes'] / $percentage_total) * 100);
            $data[$key]['all']            = $all;
        }
    }
    return $data;
}
function Wo_GetVotes($option_id) {
    global $wo, $sqlConnect;
    if (empty($option_id) || !is_numeric($option_id)) {
        return false;
    }
    $data         = array();
    $option_id    = Wo_Secure($option_id);
    $query_one    = "SELECT COUNT(id) as count FROM " . T_VOTES . " WHERE `option_id` = {$option_id}";
    $sql          = mysqli_query($sqlConnect, $query_one);
    $fetched_data = mysqli_fetch_assoc($sql);
    if (empty($fetched_data)) {
        return array();
    }
    return $fetched_data['count'];
}
function Wo_GetCustomPages() {
    global $sqlConnect;
    $data          = array();
    $query_one     = "SELECT * FROM " . T_CUSTOM_PAGES . " ORDER BY `id` DESC";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data[] = Wo_GetCustomPage($fetched_data['page_name']);
    }
    return $data;
}
function Wo_GetCustomPage($page_name) {
    global $sqlConnect;
    if (empty($page_name)) {
        return false;
    }
    $data          = array();
    $page_name     = Wo_Secure($page_name);
    $query_one     = "SELECT * FROM " . T_CUSTOM_PAGES . " WHERE `page_name` = '{$page_name}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $fetched_data  = mysqli_fetch_assoc($sql_query_one);
    return $fetched_data;
}
function Wo_RegisterNewPage($registration_data) {
    global $wo, $sqlConnect;
    if (empty($registration_data)) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_CUSTOM_PAGES . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return true;
    }
    return false;
}
function Wo_DeleteCustomPage($id) {
    global $wo, $sqlConnect;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (Wo_IsAdmin() === false) {
        return false;
    }
    $id    = Wo_Secure($id);
    $query = mysqli_query($sqlConnect, "DELETE FROM " . T_CUSTOM_PAGES . " WHERE `id` = {$id}");
    if ($query) {
        return true;
    }
    return false;
}
function Wo_UpdateCustomPageData($id, $update_data) {
    global $wo, $sqlConnect, $cache;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($id) || !is_numeric($id) || $id < 0) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    $id = Wo_Secure($id);
    if (Wo_IsAdmin() === false) {
        return false;
    }
    $update = array();
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_CUSTOM_PAGES . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_GetReferrers($user_id = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($user_id)) {
        $user_id = Wo_Secure($wo['user']['user_id']);
    } else {
        $user_id = Wo_Secure($user_id);
    }
    $data          = array();
    $query_one     = "SELECT * FROM " . T_USERS . " WHERE `referrer` = '{$user_id}' ORDER BY `user_id` DESC";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data[] = Wo_UserData($fetched_data['user_id']);
    }
    return $data;
}
function Wo_UpdateBalance($user_id = 0, $balance = 0, $type = '+') {
    global $wo, $sqlConnect;
    if (empty($user_id) || !is_numeric($user_id) || $user_id < 0) {
        return false;
    }
    if (empty($balance)) {
        return false;
    }
    $user_id   = Wo_Secure($user_id);
    $balance   = Wo_Secure($balance);
    $user_data = Wo_UserData($user_id);
    if ($type == '+') {
        $balance = ($user_data['balance'] + $balance);
    } else {
        $balance = ($user_data['balance'] - $balance);
    }
    $query_one = "UPDATE " . T_USERS . " SET `balance` = '{$balance}' WHERE `user_id` = {$user_id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_RequestNewPayment($user_id = 0, $amount = 0) {
    global $sqlConnect;
    if (empty($user_id)) {
        return false;
    }
    if (empty($amount)) {
        return false;
    }
    $user_id = Wo_Secure($user_id);
    $amount  = Wo_Secure($amount);
    if (Wo_IsUserPaymentRequested($user_id) === true) {
        return false;
    }
    $user_data   = Wo_UserData($user_id);
    $full_amount = Wo_Secure($user_data['balance']);
    $time        = time();
    $query_text  = "INSERT INTO " . T_A_REQUESTS . " (`user_id`, `amount`, `full_amount`, `time`) VALUES ('$user_id', '$amount', '$full_amount', '$time')";
    $query       = mysqli_query($sqlConnect, $query_text);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_IsUserPaymentRequested($user_id = 0) {
    global $sqlConnect;
    if (empty($user_id)) {
        return false;
    }
    $user_id = Wo_Secure($user_id);
    $query   = mysqli_query($sqlConnect, "SELECT COUNT(`user_id`) FROM " . T_A_REQUESTS . " WHERE `user_id` = '{$user_id}' AND status = '0'");
    return (Wo_Sql_Result($query, 0) == 1) ? true : false;
}
function Wo_GetPaymentsHistory($user_id = 0) {
    global $sqlConnect;
    if (empty($user_id)) {
        return false;
    }
    $user_id       = Wo_Secure($user_id);
    $data          = array();
    $query_one     = "SELECT `id` FROM " . T_A_REQUESTS . " WHERE `user_id` = '{$user_id}' ORDER BY `id` DESC";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data[] = Wo_GetPaymentHistory($fetched_data['id']);
    }
    return $data;
}
function Wo_GetAllPaymentsHistory($type = 0) {
    global $sqlConnect;
    $type  = Wo_Secure($type);
    $data  = array();
    $where = "";
    if ($type != 'all') {
        $where = "WHERE `status` = '{$type}'";
    }
    $query_one     = "SELECT * FROM " . T_A_REQUESTS . " {$where} ORDER BY `id` DESC";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data[] = Wo_GetPaymentHistory($fetched_data['id']);
    }
    return $data;
}
function Wo_CountPaymentHistory($id) {
    global $sqlConnect;
    $data          = array();
    $id            = Wo_Secure($id);
    $query_one     = "SELECT COUNT(`id`) as count FROM " . T_A_REQUESTS . " WHERE `status` = '{$id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $fetched_data  = mysqli_fetch_assoc($sql_query_one);
    return $fetched_data['count'];
}
function Wo_GetPaymentHistory($id) {
    global $sqlConnect, $wo;
    if (empty($id)) {
        return false;
    }
    $data                         = array();
    $id                           = Wo_Secure($id);
    $query_one                    = "SELECT * FROM " . T_A_REQUESTS . " WHERE `id` = '{$id}'";
    $sql_query_one                = mysqli_query($sqlConnect, $query_one);
    $fetched_data                 = mysqli_fetch_assoc($sql_query_one);
    $fetched_data['user']         = Wo_UserData($fetched_data['user_id']);
    $fetched_data['total_refs']   = Wo_CountRefs($fetched_data['user_id']);
    $fetched_data['time_text']    = Wo_Time_Elapsed_String($fetched_data['time']);
    $fetched_data['callback_url'] = $wo['config']['site_url'] . '/' . 'requests.php?f=admincp&paid_user_id=' . $fetched_data['user_id'] . '&paid_ref_id=' . $fetched_data['id'];
    return $fetched_data;
}
function Wo_CountRefs($user_id = 0) {
    global $sqlConnect;
    $data          = array();
    $user_id       = Wo_Secure($user_id);
    $query_one     = "SELECT COUNT(`user_id`) as count FROM " . T_USERS . " WHERE `referrer` = '{$user_id}'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    $fetched_data  = mysqli_fetch_assoc($sql_query_one);
    return $fetched_data['count'];
}
// Blog SYSYTEM
function Wo_InsertBlog($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_BLOG . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return mysqli_insert_id($sqlConnect);
    }
    return false;
}
function Wo_IsBlogOwner($blog_id = 0, $user_id = 0) {
    global $sqlConnect, $wo;
    if (empty($blog_id)) {
        return false;
    }
    if (empty($user_id)) {
        $user_id = $wo['user']['user_id'];
    }
    $user_id = Wo_Secure($user_id);
    $blog_id = Wo_Secure($blog_id);
    $query   = mysqli_query($sqlConnect, "SELECT COUNT(`id`) as count FROM " . T_BLOG . " WHERE `user` = {$user_id} AND `id` = $blog_id");
    $query_  = mysqli_fetch_assoc($query);
    return ($query_['count'] > 0) ? true : false;
}
function Wo_UpdateBlog($id = 0, $update_data = array()) {
    global $sqlConnect, $wo;
    $update = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    $id = Wo_Secure($id);
    if (Wo_IsBlogOwner($id) === false) {
        return false;
    }
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0, false) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_BLOG . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    return $query;
}
function Wo_GetMyBlogs($user = 0, $offset = 0) {
    global $sqlConnect, $wo;
    $data = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    $after_blogs = '';
    if ($offset > 0) {
        $after_blogs = " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    $user   = Wo_Secure($user);
    $offset = Wo_Secure($offset);
    $query  = mysqli_query($sqlConnect, "SELECT * FROM  " . T_BLOG . " WHERE `user` = '$user' {$after_blogs} ORDER BY `id` DESC LIMIT 10");
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = Wo_GetArticle($fetched_data['id']);
    }
    return $data;
}
function Wo_GetBlogs($args = array()) {
    global $sqlConnect, $wo;
    $options   = array(
        "category" => false,
        "offset" => 0,
        "limit" => 10,
        'order_by' => 'DESC',
        'id' => '0'
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $limit     = Wo_Secure($args['limit']);
    $category  = Wo_Secure($args['category']);
    $order_by  = Wo_Secure($args['order_by']);
    $id        = Wo_Secure($args['id']);
    $query_one = 'WHERE posted > 0';
    if ($offset > 0) {
        $query_one .= " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if ($category) {
        $query_one .= " AND `category` = '$category' ";
    }
    if ($category && $offset > 0) {
        $query_one .= " AND `category` = '$category' AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if (!empty($id)) {
        $query_one .= " AND `id` <> '$id' ";
    }
    $order_by_text = '';
    if ($order_by == 'DESC') {
        $order_by_text = '`id` DESC';
    } else if ($order_by == 'RAND') {
        $order_by_text = 'RAND()';
    }
    $query_two = "SELECT * FROM  " . T_BLOG . " {$query_one} ORDER BY $order_by_text LIMIT {$limit} ";
    $query     = mysqli_query($sqlConnect, $query_two);
    $data      = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = Wo_GetArticle($fetched_data['id']);
    }
    return $data;
}
function Wo_DeleteMyBlog($id = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    if (Wo_IsBlogOwner($id) === false) {
        if (Wo_IsAdmin() === false) {
            return false;
        }
    }
    $id            = Wo_Secure($id);
    $query_one     = "DELETE FROM " . T_BLOG . " WHERE `id` = '$id'";
    $sql_query_one = mysqli_query($sqlConnect, $query_one);
    if ($sql_query_one) {
        $sql_query_two = mysqli_query($sqlConnect, "SELECT `id` FROM " . T_POSTS . " WHERE `blog_id` = '$id' LIMIT 1");
        $mysqli        = mysqli_fetch_assoc($sql_query_two);
        $delete_post   = Wo_DeletePost($mysqli['id']);
    }
    return $sql_query_one;
}
function Wo_GetArticle($id = 0) {
    global $sqlConnect, $wo;
    if (empty($id)) {
        return false;
    }
    $id            = Wo_Secure($id);
    $sql_query_one = mysqli_query($sqlConnect, "SELECT * FROM " . T_BLOG . " WHERE `id` = '$id'");
    $fetched_data  = mysqli_fetch_assoc($sql_query_one);
    if (!empty($fetched_data)) {
        $fetched_data['author']        = Wo_UserData($fetched_data['user']);
        $fetched_data['thumbnail']     = Wo_GetMedia($fetched_data['thumbnail']);
        $fetched_data['tags_array']    = @explode(',', $fetched_data['tags']);
        $fetched_data['url']           = Wo_SeoLink('index.php?link1=read-blog&id=' . $fetched_data['id'] . '_' . Wo_SlugPost($fetched_data['title']));
        $fetched_data['author']        = Wo_UserData($fetched_data['user']);
        $fetched_data['category_link'] = Wo_SeoLink('index.php?link1=blog-category&id=' . $fetched_data['category']);
        $fetched_data['category_name'] = '';
        $fetched_data['is_post_admin'] = false;
        if ($wo['loggedin'] == true) {
            $fetched_data['is_post_admin'] = ($fetched_data['user'] == $wo['user']['id']) ? true : false;
        }
        if (!empty($wo['page_categories'][$fetched_data['category']])) {
            $fetched_data['category_name'] = $wo['page_categories'][$fetched_data['category']];
        }
    }
    return $fetched_data;
}
function Wo_SearchBlogs($args = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $options  = array(
        "category" => false,
        "keyword" => false
    );
    $args     = array_merge($options, $args);
    $category = Wo_Secure($args['category']);
    $keyword  = Wo_Secure($args['keyword']);
    if (!$keyword || !$category) {
        return false;
    }
    $query_two = "SELECT * FROM " . T_BLOG . " WHERE  `category` = '$category' AND  `title` LIKE '%$keyword%' OR `description` LIKE '%$keyword%' ";
    $query     = mysqli_query($sqlConnect, $query_two);
    $data      = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = Wo_GetArticle($fetched_data['id']);
    }
    return $data;
}
// *** Wo_Wonder Forum ***  //
function Wo_GetForumSec($args = array()) {
    global $sqlConnect, $wo;
    $options   = array(
        "id" => false,
        "offset" => 0,
        "limit" => false,
        "search" => false,
        "keyword" => false,
        "forums" => false,
        "order_by" => 'ASC'
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $id        = Wo_Secure($args['id']);
    $limit     = Wo_Secure($args['limit']);
    $search    = Wo_Secure($args['search']);
    $keyword   = Wo_Secure($args['keyword']);
    $forums    = Wo_Secure($args['forums']);
    $order_by  = Wo_Secure($args['order_by']);
    $query_one = "";
    if ($offset > 0) {
        $query_one .= " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if ($id) {
        $query_one .= " AND `id` = '$id' ";
    }
    if ($order_by) {
        $query_one .= " ORDER BY `id` $order_by";
    }
    if ($limit) {
        $query_one .= " LIMIT {$limit} ";
    }
    $sql_query_one = mysqli_query($sqlConnect, "SELECT * FROM " . T_FORUM_SEC . " WHERE `id` > 0 {$query_one}");
    $data          = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        if ($forums) {
            $fetched_data['forums'] = Wo_GetForums(array(
                "section" => $fetched_data['id'],
                "search" => $search,
                "keyword" => $keyword
            ));
            if (count($fetched_data['forums']) > 0) {
                $data[] = $fetched_data;
            }
        } else {
            $data[] = $fetched_data;
        }
    }
    return $data;
}
function Wo_GetForums($args = array()) {
    global $sqlConnect;
    $options   = array(
        "section" => false,
        "offset" => 0,
        "limit" => false,
        "search" => false,
        "keyword" => false,
        'order_by' => 'ASC'
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $section   = Wo_Secure($args['section']);
    $limit     = Wo_Secure($args['limit']);
    $search    = Wo_Secure($args['search']);
    $keyword   = Wo_Secure($args['keyword']);
    $order_by  = Wo_Secure($args['order_by']);
    $sql_query = "";
    if ($section) {
        $sql_query .= " AND `sections` = '$section' ";
    }
    if ($search) {
        $sql_query .= " AND `name` LIKE '%$keyword%' ";
    }
    if ($order_by) {
        $sql_query .= " ORDER BY `id` $order_by";
    }
    if ($limit) {
        $sql_query .= " LIMIT {$limit} ";
    }
    $sql_queryset = mysqli_query($sqlConnect, "SELECT * FROM " . T_FORUMS . " WHERE `id` > 0 {$sql_query} ");
    $data         = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_queryset)) {
        $fetched_data['posts'] = Wo_GetTotalThreads(array(
            'forum' => $fetched_data['id']
        ));
        $data[]                = $fetched_data;
    }
    return $data;
}
function Wo_GetShortTitle($text = false, $preview = false, $len = 40) {
    if (!$text) {
        return false;
    }
    if (strlen($text) > $len && !$preview) {
        $text = substr($text, 0, $len) . "..";
    }
    return $text;
}
function Wo_GetForumInfo($fid) {
    global $sqlConnect;
    if (!$fid || !is_numeric($fid)) {
        return array();
    }
    $sql_query_one = mysqli_query($sqlConnect, "SELECT * FROM " . T_FORUMS . " WHERE `id` = '$fid'");
    $data          = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_query_one)) {
        $data['threads'] = Wo_GetForumThreads(array(
            "forum" => $fetched_data['id'],
            "limit" => 10
        ));
        $data['forum']   = $fetched_data;
        $data['forums']  = Wo_GetForums();
    }
    return $data;
}
function Wo_GetForum($fid) {
    global $sqlConnect;
    if (!$fid || !is_numeric($fid)) {
        return array();
    }
    $sql_query_one = mysqli_query($sqlConnect, "SELECT * FROM " . T_FORUMS . " WHERE `id` = '$fid'");
    $fetched_data  = mysqli_fetch_assoc($sql_query_one);
    if (!empty($fetched_data)) {
        $fetched_data['name'] = Wo_GetShortTitle($fetched_data['name'], true);
    }
    return $fetched_data;
}
function Wo_GetForumThreads($args = array()) {
    global $sqlConnect;
    $options   = array(
        "forum" => false,
        "offset" => 0,
        "limit" => 10,
        "id" => false,
        "search" => false,
        "subject" => false,
        "post" => false,
        "user" => false,
        "preview" => false,
        "order_by" => "DESC"
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $search    = Wo_Secure($args['search']);
    $subject   = Wo_Secure($args['subject']);
    $post      = Wo_Secure($args['post']);
    $limit     = Wo_Secure($args['limit']);
    $forum     = Wo_Secure($args['forum']);
    $order_by  = Wo_Secure($args['order_by']);
    $id        = Wo_Secure($args['id']);
    $user      = Wo_Secure($args['user']);
    $preview   = Wo_Secure($args['preview']);
    $query_one = "";
    $ordering  = "";
    if ($offset > 0) {
        $query_one .= " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if ($id) {
        $query_one .= " AND `id` = '$id' ";
    }
    if ($user) {
        $query_one .= " AND `user` = '$user' ";
    }
    if ($forum) {
        $query_one .= " AND `forum` = '$forum' ";
    }
    if ($search) {
        if ($subject) {
            $query_one .= " AND `headline` LIKE '%$subject%' ";
        }
        if ($post) {
            $query_one .= " AND `post` LIKE '%$post%' ";
        }
    }
    if ($order_by == "DESC" || $order_by == "ASC") {
        $query_one .= " ORDER BY `id` $order_by ";
    }
    if ($limit && $limit > 0) {
        $query_one .= " LIMIT {$limit} ";
    }
    $sql_query = "SELECT * FROM " . T_FORUM_THREADS . " WHERE `posted` > 0 {$query_one} ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $data         = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_queryset)) {
        $fetched_data['user_data']     = Wo_UserData($fetched_data['user']);
        $fetched_data['url']           = Wo_SeoLink("index.php?link1=showthread&tid=" . $fetched_data['id']);
        $fetched_data['author_url']    = Wo_SeoLink("index.php?link1=timeline&u=" . $fetched_data['user_data']['username']);
        $fetched_data['headline']      = Wo_GetShortTitle($fetched_data['headline'], $preview);
        $fetched_data['edit_url']      = Wo_SeoLink('index.php?link1=edithread&tid=' . $fetched_data['id']);
        if (empty($args['threadreplies'])) {
            $fetched_data['threadreplies'] = Wo_GetThreadReplies(array(
                "thread_id" => $fetched_data['id']
            ));
        }
        $fetched_data['replies']       = Wo_GetTotalReplies(array(
            "thread" => $fetched_data['id']
        ));
        $data[]                        = $fetched_data;
    }
    return $data;
}
function Wo_GetMyReplies($args = array()) {
    global $sqlConnect, $wo;
    $options   = array(
        "offset" => 0,
        "limit" => 10
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $limit     = Wo_Secure($args['limit']);
    $query_one = "";
    if ($offset > 0) {
        $query_one .= " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if ($limit) {
        $query_one .= " ORDER BY `id` DESC LIMIT {$limit} ";
    }
    $user_id      = $wo['user']['id'];
    $sql_query    = "SELECT * FROM " . T_FORUM_THREAD_REPLIES . " WHERE `poster_id` = '$user_id' {$query_one} ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $data         = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_queryset)) {
        $fetched_data['user_data']    = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['forum']        = Wo_GetForum($fetched_data['forum_id']);
        $fetched_data['edit_url']     = Wo_SeoLink("index.php?link1=editreply&tid=" . $fetched_data['id']);
        $fetched_data['url']          = Wo_SeoLink("index.php?link1=showthread&tid=" . $fetched_data['thread_id']);
        $fetched_data['post_subject'] = Wo_GetShortTitle($fetched_data['post_subject']);
        $data[]                       = $fetched_data;
    }
    return $data;
}
function Wo_GetThreadReplies($args = array()) {
    global $sqlConnect, $wo;
    $options   = array(
        "thread_id" => false,
        "offset" => 0,
        "search" => false,
        "forum" => false,
        "subject" => false,
        "reply" => false,
        "user" => false,
        "limit" => 10,
        "id" => false,
        "order_by" => "ASC"
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $forum     = Wo_Secure($args['forum']);
    $limit     = Wo_Secure($args['limit']);
    $thread_id = Wo_Secure($args['thread_id']);
    $limit     = Wo_Secure($args['limit']);
    $order_by  = Wo_Secure($args['order_by']);
    $id        = Wo_Secure($args['id']);
    $poster_id = Wo_Secure($args['user']);
    $query_one = "";
    if ($thread_id) {
        $query_one .= " AND `thread_id` = '$thread_id' ";
    }
    if ($offset > 0) {
        $query_one .= " AND `id` > {$offset} AND `id` <> {$offset} ";
    }
    if ($id) {
        $query_one .= " AND `id` = '$id' ";
    }
    if ($poster_id) {
        $query_one .= " AND `poster_id` = '$poster_id' ";
    }
    if ($order_by == "DESC" || $order_by == "ASC") {
        $query_one .= " ORDER BY `id` $order_by ";
    }
    if ($limit) {
        $query_one .= " LIMIT {$limit} ";
    }
    $sql_query    = "SELECT * FROM " . T_FORUM_THREAD_REPLIES . " WHERE  `posted_time` > 0 {$query_one} ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $data         = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_queryset)) {
        $fetched_data['user_data'] = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['is_owner']  = ($fetched_data['poster_id'] == $wo['user']['id']) ? true : false;
        $fetched_data['is_admin']  = ($wo['user']['admin'] == 1) ? true : false;
        $fetched_data['reply-url'] = Wo_SeoLink("index.php?link1=threadquote&tid=" . $fetched_data['id']);
        $fetched_data['edit-url']  = Wo_SeoLink("index.php?link1=editreply&tid=" . $fetched_data['id']);
        if ($forum) {
            $fetched_data['forum'] = Wo_GetForum($fetched_data['forum_id']);
        }
        $data[] = $fetched_data;
    }
    return $data;
}
function Wo_SearchThreadReplies($args = array()) {
    global $sqlConnect, $wo;
    $options   = array(
        "thread_id" => false,
        "offset" => 0,
        "subject" => false,
        "reply" => false,
        "user" => false,
        "limit" => 10
    );
    $args      = array_merge($options, $args);
    $subject   = Wo_Secure($args['subject']);
    $reply     = Wo_Secure($args['reply']);
    $thread_id = Wo_Secure($args['thread_id']);
    $limit     = Wo_Secure($args['limit']);
    $poster_id = Wo_Secure($args['user']);
    $query_one = "";
    if ($subject && $reply) {
        $search_q = "(`post_subject` LIKE '%$subject%' OR `post_text` LIKE '%$reply%')";
    } else if ($subject) {
        $search_q = " `post_subject` LIKE '%$subject%' ";
    } else if ($reply) {
        $search_q = " `post_text` LIKE '%$reply%' ";
    }
    if ($thread_id) {
        $query_one .= " AND `thread_id` = '$thread_id' ";
    }
    if ($poster_id) {
        $query_one .= " AND `poster_id` = '$poster_id' ";
    }
    if ($limit) {
        $query_one .= " LIMIT {$limit} ";
    }
    $sql_query    = "SELECT * FROM " . T_FORUM_THREAD_REPLIES . " WHERE {$search_q} AND `posted_time` > 0 {$query_one} ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $data         = array();
    while ($fetched_data = mysqli_fetch_assoc($sql_queryset)) {
        $fetched_data['user_data'] = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['is_owner']  = ($fetched_data['poster_id'] == $wo['user']['id']) ? true : false;
        $fetched_data['is_admin']  = ($wo['user']['admin'] == 1) ? true : false;
        $fetched_data['reply-url'] = Wo_SeoLink("index.php?link1=threadquote&tid=" . $fetched_data['id']);
        $fetched_data['edit-url']  = Wo_SeoLink("index.php?link1=editreply&tid=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_IsReplyOwner($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $sql_query    = "SELECT * FROM " . T_FORUM_THREAD_REPLIES . " WHERE `id` = '$id' ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    if (!empty($fetched_data)) {
        if ($fetched_data['poster_id'] == $wo['user']['id'] || $wo['user']['admin'] == 1) {
            return true;
        }
    }
    return false;
}
function Wo_GetForumUsers($args = array()) {
    global $wo, $sqlConnect;
    $data      = array();
    $options   = array(
        "key" => false,
        "offset" => 0,
        "name" => false,
        "id" => false,
        "limit" => false
    );
    $args      = array_merge($options, $args);
    $offset    = Wo_Secure($args['offset']);
    $limit     = Wo_Secure($args['limit']);
    $key       = Wo_Secure($args['key']);
    $name      = Wo_Secure($args['name']);
    $id        = Wo_Secure($args['id']);
    $query_one = "";
    if ($offset > 0) {
        $query_one .= " AND `user_id` < {$offset} AND `user_id` <> {$offset} ";
    }
    if ($key) {
        $query_one .= " AND `username` LIKE '$key%'";
    }
    if ($name) {
        $query_one .= " AND `username` LIKE '%$name%'";
    }
    $sql = mysqli_query($sqlConnect, " SELECT `user_id` FROM " . T_USERS . " WHERE `type` = 'user' {$query_one} ORDER BY `user_id` DESC LIMIT 10 ");
    while ($fetched_data = mysqli_fetch_assoc($sql)) {
        $data_user                = Wo_UserData($fetched_data['user_id']);
        $data_user['forum_posts'] = Wo_GetTotalThreads(array(
            'user' => $fetched_data['user_id']
        ));
        $data[]                   = $data_user;
    }
    return $data;
}
function Wo_IsThreadOwner($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $sql_query    = "SELECT * FROM " . T_FORUM_THREADS . " WHERE `id` = '$id' ";
    $sql_queryset = mysqli_query($sqlConnect, $sql_query);
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    if (!empty($fetched_data)) {
        if ($fetched_data['user'] == $wo['user']['id'] || $wo['user']['admin'] == 1) {
            return true;
        }
    }
    return false;
}
function Wo_AddTopic($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_FORUM_THREADS . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return true;
    }
    return false;
}
function Wo_AddForumSection($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false || Wo_IsAdmin() == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_FORUM_SEC . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return true;
    }
    return false;
}
function Wo_AddForum($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false || Wo_IsAdmin() == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_FORUMS . " ({$fields}) VALUES ({$data})");
    if ($query) {
        return true;
    }
    return false;
}
function Wo_ThreadReply($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $fields    = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data      = '\'' . implode('\', \'', $registration_data) . '\'';
    $query_one = "INSERT INTO " . T_FORUM_THREAD_REPLIES . " ({$fields}) VALUES ({$data})";
    $query     = mysqli_query($sqlConnect, $query_one);
    if ($query) {
        $thread = Wo_GetForumThreads(array('threadreplies' => true));
        $notification_data_array = array(
            'recipient_id' => $thread[0]['user_data']['user_id'],
            'type' => 'forum_reply',
            'thread_id' => $registration_data['thread_id'],
            'url' => 'index.php?link1=showthread&tid=' . $registration_data['thread_id']
        );
        Wo_RegisterNotification($notification_data_array);
        return true;
    }
    return false;
}
function Wo_BbcodeToHtml($bbtext) {
    $bbtags     = array(
        '[paragraph]' => '<p>',
        '[/paragraph]' => '</p>',
        '[left]' => '<p style="text-align:left;">',
        '[/left]' => '</p>',
        '[right]' => '<p style="text-align:right;">',
        '[/right]' => '</p>',
        '[center]' => '<p style="text-align:center;">',
        '[/center]' => '</p>',
        '[quote]' => '<blockquote class="quote">',
        '[/quote]' => '</blockquote>',
        '[justify]' => '<p style="text-align:justify;">',
        '[/justify]' => '</p>',
        '[bold]' => '<span style="font-weight:bold;">',
        '[/bold]' => '</span>',
        '[italic]' => '<span style="font-weight:bold;">',
        '[/italic]' => '</span>',
        '[underline]' => '<span style="text-decoration:underline;">',
        '[/underline]' => '</span>',
        '[b]' => '<span style="font-weight:bold;">',
        '[/b]' => '</span>',
        '[i]' => '<span style="font-weight:bold;">',
        '[/i]' => '</span>',
        '[u]' => '<span style="text-decoration:underline;">',
        '[/u]' => '</span>',
        '[sm]' => '<small>',
        '[/sm]' => '</small>',
        '[nl]' => '<br>',
        '[s]' => '<s>',
        '[/s]' => '</s>',
        '[unordered_list]' => '<ul>',
        '[/unordered_list]' => '</ul>',
        '[ordered_list]' => '<ol style="list-style-type:decimal;">',
        '[/ordered_list]' => '</ol>',
        '[*]' => '<li>',
        '[/*]' => '</li>',
        '[pre]' => '<pre>',
        '[/pre]' => '</pre>',
        '[code]' => '<code>',
        '[/code]' => '</code>'
    );
    $bbtext     = str_ireplace(array_keys($bbtags), array_values($bbtags), $bbtext);
    $bbextended = array(
        "/\[url](.*?)\[\/url]/i" => "<a href=\"http://$1\" title=\"$1\">$1</a>",
        "/\[url=(.*?)\](.*?)\[\/url\]/i" => "<a href=\"$1\" title=\"$1\">$2</a>",
        "/\[email=(.*?)\](.*?)\[\/email\]/i" => "<a href=\"mailto:$1\">$2</a>",
        "/\[mail=(.*?)\](.*?)\[\/mail\]/i" => "<a href=\"mailto:$1\">$2</a>",
        "/\[img\]([^[]*)\[\/img\]/i" => "<img src=\"$1\" alt=\" \" />",
        "/\[image\]([^[]*)\[\/image\]/i" => "<img src=\"$1\" alt=\" \" />",
        "/\[image_left\]([^[]*)\[\/image_left\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_left\" />",
        "/\[image_right\]([^[]*)\[\/image_right\]/i" => "<img src=\"$1\" alt=\" \" class=\"img_right\" />"
    );
    foreach ($bbextended as $match => $replacement) {
        $bbtext = preg_replace($match, $replacement, $bbtext);
    }
    return $bbtext;
}
function Wo_ThreadUpdate($id = 0, $update_data = array()) {
    global $sqlConnect, $wo;
    $update = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . $data . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_FORUM_THREAD_REPLIES . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    return $query;
}
function Wo_UpdateTopic($id = 0, $update_data = array()) {
    global $sqlConnect, $wo;
    $update = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . $data . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_FORUM_THREADS . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    return $query;
}
function Wo_DeleteThreadReply($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    if (!Wo_IsReplyOwner($id)) {
        if (Wo_IsAdmin() == false) {
            return false;
        }
    }
    $query_one = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_THREAD_REPLIES . " WHERE `id` = '$id'");
    if ($query_one) {
        return true;
    }
    return false;
}
function Wo_DeleteForumThread($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    if (!Wo_IsThreadOwner($id)) {
        if (Wo_IsAdmin() == false) {
            return false;
        }
    }
    $query_one = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_THREADS . " WHERE `id` = '$id'");
    $query_two = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_THREAD_REPLIES . " WHERE `thread_id` = '$id'");
    $query_two = mysqli_query($sqlConnect, "DELETE FROM " . T_NOTIFICATION . " WHERE `thread_id` = '{$id}'");
    if ($query_one && $query_two) {
        return true;
    }
    return false;
}
function Wo_DeleteForum($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false && Wo_IsAdmin() == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $query_one   = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUMS . " WHERE `id` = '$id'");
    $query_two   = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_THREADS . " WHERE `forum` = '$id'");
    $query_three = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_THREAD_REPLIES . " WHERE `forum_id` = '$id'");
    if ($query_one && $query_two && $query_three) {
        return true;
    }
    return false;
}
function Wo_DeleteForumSection($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false && Wo_IsAdmin() == false) {
        return false;
    }
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $section = Wo_GetForumSec(array(
        'id' => $id,
        'forums' => true
    ));
    $query_0 = mysqli_query($sqlConnect, "DELETE FROM " . T_FORUM_SEC . " WHERE `id` = '$id'");
    if (count($section) > 0) {
        foreach ($section[0]['forums'] as $forum) {
            Wo_DeleteForum($forum['id']);
        }
        if ($query_0) {
            return true;
        }
    } else {
        return true;
    }
    return false;
}
function Wo_AddThreadView($id = false) {
    global $sqlConnect;
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $query     = "UPDATE " . T_FORUM_THREADS . " SET `views` = `views` + 1 WHERE `id` = '$id'";
    $query_one = mysqli_query($sqlConnect, $query);
    if ($query_one) {
        return true;
    }
    return false;
}
function Wo_UpdateThreadLastPostTime($id = false) {
    global $sqlConnect;
    if (!$id || !is_numeric($id)) {
        return false;
    }
    $time      = time();
    $query     = "UPDATE " . T_FORUM_THREADS . " SET `last_post` = '$time' WHERE `id` = '$id'";
    $query_one = mysqli_query($sqlConnect, $query);
    if ($query_one) {
        return true;
    }
    return false;
}
function Wo_GetTotalForums() {
    global $sqlConnect;
    $sql_queryset = mysqli_query($sqlConnect, "SELECT COUNT(`id`) AS total FROM " . T_FORUMS);
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    return $fetched_data['total'];
}
function Wo_GetTotalThreads($args = array()) {
    global $sqlConnect;
    $options = array(
        "forum" => false,
        "user" => false
    );
    $args    = array_merge($options, $args);
    $forum   = Wo_Secure($args['forum']);
    $user    = Wo_Secure($args['user']);
    $query   = "";
    if ($forum) {
        $query .= " AND `forum` = '$forum' ";
    }
    if ($user) {
        $query .= " AND `user` = '$user' ";
    }
    $sql_queryset = mysqli_query($sqlConnect, "SELECT COUNT(`id`) AS total FROM " . T_FORUM_THREADS . " WHERE `id` > 0 {$query} ");
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    return $fetched_data['total'];
}
function Wo_GetTotalReplies($args = array()) {
    global $sqlConnect;
    $options = array(
        "thread" => false,
        "user" => false
    );
    $args    = array_merge($options, $args);
    $thread  = Wo_Secure($args['thread']);
    $user    = Wo_Secure($args['user']);
    $query   = "";
    if ($thread) {
        $query .= " AND `thread_id` = '$thread' ";
    }
    if ($user) {
        $query .= " AND `poster_id` = '$user' ";
    }
    $sql_queryset = mysqli_query($sqlConnect, "SELECT COUNT(`id`) AS total FROM " . T_FORUM_THREAD_REPLIES . " WHERE `id` > 0 {$query} ");
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    return $fetched_data['total'];
}
function Wo_GetTotalUsers() {
    global $sqlConnect;
    $sql_queryset = mysqli_query($sqlConnect, "SELECT COUNT(`user_id`) AS total FROM " . T_USERS);
    $fetched_data = mysqli_fetch_assoc($sql_queryset);
    return $fetched_data['total'];
}
function Wo_MessagesPushNotifier() {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if ($wo['config']['push'] == 0) {
        return false;
    }
    $user_id   = Wo_Secure($wo['user']['user_id']);
    $to_ids    = array();
    $query_get = mysqli_query($sqlConnect, "SELECT * FROM " . T_MESSAGES . " WHERE `from_id` = '$user_id' AND `seen` = '0' AND `sent_push` = '0' ORDER BY `id` DESC");
    if (mysqli_num_rows($query_get) > 0) {
        while ($sql_get_messages_for_push = mysqli_fetch_assoc($query_get)) {
            if (!in_array($sql_get_messages_for_push['to_id'], $to_ids)) {
                $get_session_data = Wo_GetSessionDataFromUserID($sql_get_messages_for_push['to_id']);
                if (empty($get_session_data)) {
                    $message_id = $sql_get_messages_for_push['id'];
                    $to_id      = $sql_get_messages_for_push['to_id'];
                    $to_data    = Wo_UserData($sql_get_messages_for_push['to_id']);
                    if (!empty($to_data['device_id'])) {
                        $send_array = array(
                            'send_to' => array(
                                $to_data['device_id']
                            ),
                            'notification' => array(
                                'notification_content' => $sql_get_messages_for_push['text'],
                                'notification_title' => $wo['user']['name'],
                                'notification_image' => $wo['user']['avatar'],
                                'notification_data' => array(
                                    'user_id' => $user_id
                                )
                            )
                        );
                        $send       = Wo_SendPushNotification($send_array);
                        if ($send) {
                            $query_get_messages_for_push = mysqli_query($sqlConnect, "UPDATE " . T_MESSAGES . " SET `notification_id` = '$send' WHERE `id` = '$message_id'");
                        }
                    }
                    $query_get_messages_for_push = mysqli_query($sqlConnect, "UPDATE " . T_MESSAGES . " SET `sent_push` = '1' WHERE `from_id` = '$user_id' AND `to_id` = '$to_id' AND `sent_push` = '0'");
                }
            }
            $to_ids[] = $sql_get_messages_for_push['to_id'];
        }
    }
    return true;
}
function Is_EventOwner($id, $user = false, $admin = true) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false || !$id) {
        return false;
    }
    $user         = ($user && is_numeric($user)) ? $user : $wo['user']['id'];
    $query        = mysqli_query($sqlConnect, "SELECT * FROM " . T_EVENTS . "  WHERE `id` = '$id'");
    $fetched_data = mysqli_fetch_assoc($query);
    $result       = false;
    if (!empty($fetched_data)) {
        if ($fetched_data['poster_id'] == $user) {
            if ($admin == true) {
                if (Wo_IsAdmin($user)) {
                    $result = true;
                }
            }
            $result = true;
        }
    }
    return $result;
}
function Wo_InsertEvent($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $query  = mysqli_query($sqlConnect, "INSERT INTO " . T_EVENTS . " ({$fields}) VALUES ({$data})");
    if ($query) {
        $id = mysqli_insert_id($sqlConnect);
        $register_post = Wo_RegisterPost(array(
            'user_id' => Wo_Secure($wo['user']['user_id']),
            'time' => time(),
            'postPrivacy' => '0',
            'page_event_id' => $id
        ));
        return $id;
    }
    return false;
}
function Wo_UpdateEvent($id = 0, $update_data = array()) {
    global $sqlConnect, $wo;
    $update = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    $id = Wo_Secure($id);
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_EVENTS . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    return $query;
}
function Wo_EventGoingExists($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    $event_id = Wo_Secure($event_id);
    $user_id  = $wo['user']['id'];
    $data     = array();
    $sql      = "SELECT `id` FROM " . T_EVENTS_GOING . "  WHERE `event_id` = '$event_id' AND `user_id` = '$user_id ' ";
    $query    = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data;
    }
    if (count($data) > 0) {
        return true;
    }
    return false;
}
function Wo_EventInterestedExists($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    $event_id = Wo_Secure($event_id);
    $user_id  = $wo['user']['id'];
    $data     = array();
    $sql      = "SELECT `id` FROM " . T_EVENTS_INT . "  WHERE `event_id` = '$event_id' AND `user_id` = '$user_id' ";
    $query    = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data;
    }
    if (count($data) > 0) {
        return true;
    }
    return false;
}
function Wo_EventInvitedExists($event_id, $user_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    if (!$user_id || !is_numeric($user_id)) {
        return false;
    }
    $event_id = Wo_Secure($event_id);
    $user_id  = Wo_Secure($user_id);
    $data     = array();
    $sql      = "SELECT `id` FROM " . T_EVENTS_INV . "  WHERE `event_id` = '$event_id' AND `invited_id` = '$user_id' ";
    $query    = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $data[] = $fetched_data;
    }
    if (count($data) > 0) {
        return true;
    }
    return false;
}
function Wo_TotalInvitedUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return 0;
    }
    $event_id     = Wo_Secure($event_id);
    $user_id      = $wo['user']['id'];
    $data         = array();
    $sql          = "SELECT COUNT(`id`) AS count FROM " . T_EVENTS_INV . " WHERE `event_id` = '$event_id'";
    $query        = mysqli_query($sqlConnect, $sql);
    $fetched_data = mysqli_fetch_assoc($query);
    return $fetched_data['count'];
}
function Wo_TotalGoingUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return 0;
    }
    $event_id     = Wo_Secure($event_id);
    $user_id      = $wo['user']['id'];
    $data         = array();
    $sql          = "SELECT COUNT(`id`) AS count FROM " . T_EVENTS_GOING . " WHERE `event_id` = '$event_id'";
    $query        = mysqli_query($sqlConnect, $sql);
    $fetched_data = mysqli_fetch_assoc($query);
    return $fetched_data['count'];
}
function Wo_TotalInterestedUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return 0;
    }
    $event_id     = Wo_Secure($event_id);
    $user_id      = $wo['user']['id'];
    $data         = array();
    $sql          = "SELECT COUNT(`id`) AS count FROM " . T_EVENTS_INT . " WHERE `event_id` = '$event_id'";
    $query        = mysqli_query($sqlConnect, $sql);
    $fetched_data = mysqli_fetch_assoc($query);
    return $fetched_data['count'];
}
function Wo_AddEventGoingUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    if (Wo_EventGoingExists($event_id)) {
        return false;
    }
    $user_id  = $wo['user']['id'];
    $event_id = Wo_Secure($event_id);
    $event_data = Wo_EventData($event_id);
    $sql      = "INSERT INTO " . T_EVENTS_GOING . " (`id`, `event_id`, `user_id`) VALUES (NULL, '$event_id', '$user_id')";
    $query    = mysqli_query($sqlConnect, $sql);
    if ($query) {
        $result = mysqli_query($sqlConnect, "DELETE FROM " . T_EVENTS_INV . "  WHERE `event_id` = '$event_id' AND `invited_id` = '$user_id'");
        $notification_data_array = array(
            'recipient_id' => $event_data['poster_id'],
            'type' => 'going_event',
            'event_id' => $event_id,
            'url' => 'index.php?link1=timeline&u=' . $wo['user']['username']
        );
        Wo_RegisterNotification($notification_data_array);
    }
    return $query;
}
function Wo_AddEventInvitedUsers($event_id, $user_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    if (!$user_id || !is_numeric($user_id)) {
        return false;
    }
    if (Wo_EventInvitedExists($event_id, $user_id)) {
        return false;
    }
    $invited_id = Wo_Secure($user_id);
    $inviter_id = $wo['user']['id'];
    $event_id   = Wo_Secure($event_id);
    $sql        = "INSERT INTO " . T_EVENTS_INV . " (`id`, `event_id`, `inviter_id`,`invited_id`) 
                                      VALUES (NULL, '$event_id', '$inviter_id','$invited_id')";
    return mysqli_query($sqlConnect, $sql);
}
function Wo_AddEventInterestedUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    if (Wo_EventInterestedExists($event_id)) {
        return false;
    }
    $user_id  = $wo['user']['id'];
    $event_id = Wo_Secure($event_id);
    $event_data = Wo_EventData($event_id);
    $sql      = "INSERT INTO " . T_EVENTS_INT . " (`id`, `event_id`, `user_id`) VALUES (NULL, '$event_id', '$user_id')";
    $query =  mysqli_query($sqlConnect, $sql);
    if ($query) {
         $notification_data_array = array(
            'recipient_id' => $event_data['poster_id'],
            'type' => 'interested_event',
            'event_id' => $event_id,
            'url' => 'index.php?link1=timeline&u=' . $wo['user']['username']
        );
        Wo_RegisterNotification($notification_data_array);
    }
    return $query;
}
function Wo_UnsetEventInterestedUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    $event_id = Wo_Secure($event_id);
    $user_id  = $wo['user']['id'];
    $sql     = "DELETE FROM " . T_EVENTS_INT . "  WHERE `user_id` = '$user_id' AND `event_id` = '$event_id'";
    $query    = mysqli_query($sqlConnect, $sql);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_UnsetEventGoingUsers($event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!$event_id || !is_numeric($event_id)) {
        return false;
    }
    $event_id = Wo_Secure($event_id);
    $user_id  = $wo['user']['id'];
    $sql      = "DELETE FROM " . T_EVENTS_GOING . "  WHERE `user_id` = '$user_id' AND `event_id` = '$event_id'";
    $sql2     = "DELETE FROM " . T_EVENTS_INT . "  WHERE `user_id` = '$user_id' AND `event_id` = '$event_id'";
    $query    = mysqli_query($sqlConnect, $sql);
    $query2   = mysqli_query($sqlConnect, $sql2);
    if ($query) {
        return true;
    }
    return false;
}
function Wo_GetEvents($args = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $options = array(
        "offset" => 0,
        "limit" => 10,
        'is_admin' => 0,
    );
    $args    = array_merge($options, $args);
    $sub_q   = "";
    $total   = "";
    $offset  = $args['offset'];
    $limit   = $args['limit'];
    $user    = $wo['user']['id'];
    if ($offset > 0) {
        $sub_q .= " AND `id` < {$offset} AND `id` <> {$offset}  ";
    }
    if ($limit && is_numeric($limit)) {
        $total = " LIMIT $limit  ";
    }
    $sql   = "SELECT * FROM " . T_EVENTS;
    if (empty($args['is_admin'])) {
        $sql .= " WHERE `id` NOT IN 
    (SELECT `event_id` FROM " . T_EVENTS_GOING . " WHERE `user_id` = '$user') 
    AND `id` NOT IN (SELECT `event_id` FROM " . T_EVENTS_INT . " WHERE `user_id` = '$user') {$sub_q} ORDER BY `id` DESC {$total} ";
    }
    $query = mysqli_query($sqlConnect, $sql);
    $data  = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['user_data']  = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['start_date'] = date('F j Y, g:i a', strtotime($fetched_data['start_date'] . $fetched_data['start_time']));
        $fetched_data['cover']      = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['url']        = Wo_SeoLink("index.php?link1=show-event&eid=" . $fetched_data['id']);
        $data[]                     = $fetched_data;
    }
    return $data;
}
function Wo_GetSuggestedEvents($args = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $options = array(
        "limit" => 5
    );
    $args    = array_merge($options, $args);
    $limit   = $args['limit'];
    $user    = $wo['user']['id'];
    $sql     = "SELECT * FROM " . T_EVENTS . " WHERE `id` NOT IN 
    (SELECT `event_id` FROM " . T_EVENTS_GOING . " WHERE `user_id` = '$user') 
    AND `id` NOT IN (SELECT `event_id` FROM " . T_EVENTS_INT . " WHERE `user_id` = '$user') ORDER BY RAND()";
    if ($limit && is_numeric($limit)) {
        $sql .= " LIMIT $limit  ";
    }
    $query = mysqli_query($sqlConnect, $sql);
    $data  = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['user_data']  = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['start_date'] = date('F j Y, g:i a', strtotime($fetched_data['start_date'] . $fetched_data['start_time']));
        $fetched_data['url']        = Wo_SeoLink("index.php?link1=show-event&eid=" . $fetched_data['id']);
        $data[]                     = $fetched_data;
    }
    return $data;
}
function Wo_GetGoingEvents($offset = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $sub_q = "";
    if ($offset > 0) {
        $sub_q = " AND `event_id` < {$offset} AND `event_id` <> {$offset} ";
    }
    $user_id = $wo['user']['id'];
    $sql     = "SELECT `event_id` FROM " . T_EVENTS_GOING . "  WHERE `user_id` = '$user_id' {$sub_q}  ORDER BY `event_id` DESC LIMIT 10";
    $query   = mysqli_query($sqlConnect, $sql);
    $data    = array();
    if ($query && !empty($query)) {
        while ($fetched_data = mysqli_fetch_assoc($query)) {
            $data[] = Wo_EventData($fetched_data['event_id']);
        }
    }
    return $data;
}
function Wo_GetInvitedEvents($offset = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $sub_q = "";
    if ($offset > 0) {
        $sub_q = " AND `event_id` < {$offset} AND `event_id` <> {$offset} ";
    }
    $user_id = $wo['user']['id'];
    $sql     = "SELECT `event_id` FROM " . T_EVENTS_INV . "  WHERE `invited_id` = '$user_id' {$sub_q}  ORDER BY `event_id` DESC LIMIT 10";
    $query   = mysqli_query($sqlConnect, $sql);
    $data    = array();
    if ($query && !empty($query)) {
        while ($fetched_data = mysqli_fetch_assoc($query)) {
            $data[] = Wo_EventData($fetched_data['event_id']);
        }
    }
    return $data;
}
function Wo_GetInterestedEvents($offset = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $sub_q = "";
    if ($offset > 0) {
        $sub_q = " AND `event_id` < {$offset} AND `event_id` <> {$offset} ";
    }
    $user_id = $wo['user']['id'];
    $sql     = "SELECT `event_id` FROM " . T_EVENTS_INT . " WHERE `user_id` = '$user_id' {$sub_q} ORDER BY `event_id` DESC LIMIT 10";
    $query   = mysqli_query($sqlConnect, $sql);
    $data    = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $event = Wo_EventData($fetched_data['event_id']);
        if ($event && !empty($event)) {
            $data[] = $event;
        }
    }
    return $data;
}
function Wo_GetPastEvents($offset = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $sub_q = "";
    if ($offset > 0) {
        $sub_q = " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    $sql   = "SELECT * FROM " . T_EVENTS . "  WHERE `end_date` < CURDATE() {$sub_q} ORDER BY `id` DESC LIMIT 10";
    $query = mysqli_query($sqlConnect, $sql);
    $data  = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['user_data'] = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['is_owner']  = Is_EventOwner($fetched_data['id']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=show-event&eid=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_GetMyEvents($offset = 0) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $sub_q = "";
    if ($offset > 0) {
        $sub_q = " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    $user_id = $wo['user']['user_id'];
    $sql   = "SELECT * FROM " . T_EVENTS . "  WHERE `poster_id` = '$user_id' {$sub_q} ORDER BY `id` DESC LIMIT 10";
    $query = mysqli_query($sqlConnect, $sql);
    $data  = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['user_data'] = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['is_owner']  = Is_EventOwner($fetched_data['id']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=show-event&eid=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}

function Wo_DeleteEvent($id = false) {
    global $sqlConnect, $wo;
    $result = false;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (!Is_EventOwner($id)) {
        if (Wo_IsAdmin() == false) {
            return false;
        }
    }
    $result = mysqli_query($sqlConnect, "DELETE FROM " . T_EVENTS . "  WHERE `id` = '$id'");
    if ($result) {
        $result               = mysqli_query($sqlConnect, "DELETE FROM " . T_EVENTS_INT . "  WHERE `event_id` = '$id'");
        $result               = mysqli_query($sqlConnect, "DELETE FROM " . T_EVENTS_GOING . "  WHERE `event_id` = '$id'");
        $result               = mysqli_query($sqlConnect, "DELETE FROM " . T_EVENTS_INV . "  WHERE `event_id` = '$id'");
        $result               = mysqli_query($sqlConnect, "DELETE FROM " . T_NOTIFICATION . " WHERE `event_id` = {$id}");
        $query_9_delete_media = mysqli_query($sqlConnect, "SELECT `id` FROM " . T_POSTS . " WHERE `event_id` = {$id}");
        if (mysqli_num_rows($query_9_delete_media) > 0) {
            while ($fetched_data = mysqli_fetch_assoc($query_9_delete_media)) {
                $delete_posts = Wo_DeletePost($fetched_data['id']);
            }
        }
        $query_10_delete_media = mysqli_query($sqlConnect, "SELECT `id` FROM " . T_POSTS . " WHERE `page_event_id` = {$id}");
        if (mysqli_num_rows($query_10_delete_media) > 0) {
            while ($fetched_data = mysqli_fetch_assoc($query_10_delete_media)) {
                $delete_posts = Wo_DeletePost($fetched_data['id']);
            }
        }
        return true;
    }
    return false;
}
function Wo_EventData($id = false) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false || !$id || !is_numeric($id)) {
        return false;
    }
    $query        = mysqli_query($sqlConnect, "SELECT * FROM " . T_EVENTS . "  WHERE `id` = '$id'");
    $fetched_data = mysqli_fetch_assoc($query);
    if (!empty($fetched_data)) {
        $fetched_data['user_data'] = Wo_UserData($fetched_data['poster_id']);
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['is_owner']  = Is_EventOwner($fetched_data['id']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=show-event&eid=" . $fetched_data['id']);
        return $fetched_data;
    }
    return array();
}
function Wo_RegsiterEventInvite($user_id, $event_id) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($user_id) || !is_numeric($user_id)) {
        return false;
    }
    if (empty($event_id) || !is_numeric($event_id)) {
        return false;
    }
    if (!Is_EventOwner($event_id, $user_id) && Wo_AddEventInvitedUsers($event_id, $user_id)) {
        $notification_data_array = array(
            'recipient_id' => $user_id,
            'type' => 'invited_event',
            'event_id' => $event_id,
            'url' => 'index.php?link1=show-event&eid=' . $event_id
        );
        Wo_RegisterNotification($notification_data_array);
        return true;
    }
    return false;
}
function DetermineUserLang(){
   global  $wo; 
   if ($wo['loggedin'] == false) {
        return false;
   }
   $lang     = $wo['user']['language'];
   $language = false;
   $wo_langs = array(
    'english' => 'en',
    'arabic'  => 'ar',
    'dutch'   => 'nl',
    'french'  => 'fr',
    'german'  => 'de',
    'italian' => 'it',
    'portuguese' => 'pt',
    'russian' => 'ru',
    'spanish' => 'es',
    'turkish' => 'tr'
    );
   if (array_key_exists($lang, $wo_langs)) {
       $language = $wo_langs[$lang];
   }
   return $language;
    
}
// *** Movies ***
function Wo_InsertFilm($registration_data = array()) {
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $fields = '`' . implode('`, `', array_keys($registration_data)) . '`';
    $data   = '\'' . implode('\', \'', $registration_data) . '\'';
    $sql    = "INSERT INTO " . T_MOVIES . " ({$fields}) VALUES ({$data})";
    $query  = mysqli_query($sqlConnect, $sql) or die(mysqli_error($sqlConnect));
    if ($query) {
        $id = mysqli_insert_id($sqlConnect);
        return $id;
    }
    return false;
}
function Wo_UpdateFilm($id = 0, $update_data = array()) {
    global $sqlConnect, $wo;
    $update = array();
    if ($wo['loggedin'] == false) {
        return false;
    }
    if (empty($update_data)) {
        return false;
    }
    if (empty($id)) {
        return false;
    }
    $id = Wo_Secure($id);
    foreach ($update_data as $field => $data) {
        $update[] = '`' . $field . '` = \'' . Wo_Secure($data, 0) . '\'';
    }
    $impload   = implode(', ', $update);
    $query_one = "UPDATE " . T_MOVIES . " SET {$impload} WHERE `id` = {$id} ";
    $query     = mysqli_query($sqlConnect, $query_one);
    return $query;
}
function Wo_GetMovies($args = array()){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $options     = array(
    "offset"     => 0,
    "limit"      => 26,
    "id"         => false,
    "genre"      => false,
    "country"    => false,
    );
    $args        = array_merge($options, $args);
    $offset      = $args['offset'];
    $limit       = $args['limit'];
    $genre       = Wo_Secure($args['genre']);
    $id          = Wo_Secure($args['id']);
    $country     = Wo_Secure($args['country']);
    $sub_sql     = "";
    $total       = "";
    if ($offset && $offset > 0) {
        $sub_sql .= " AND `id` < {$offset} AND `id` <> {$offset} ";
    }
    if ($id && is_numeric($id)) {
        $sub_sql .= " AND `id` = '$id' ";
    }
    if ($genre && is_string($genre)) {
        $sub_sql .= " AND `genre` = '$genre' ";
    }
    if ($country && is_string($country)) {
        $sub_sql .= " AND `country` = '$country' ";
    }
    if ($limit && is_numeric($limit)) {
        $total = " LIMIT $limit ";
    }
    $query = mysqli_query($sqlConnect, "SELECT * FROM " . T_MOVIES . " WHERE `id` > 0 {$sub_sql} ORDER BY `id` DESC {$total}");
    $data  = array();
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['source']    = Wo_GetMedia($fetched_data['source']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=watch-film&film-id=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_GetRecommendedFilms(){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $data  = array();
    $year  = date('Y');
    $sql   = "SELECT * FROM " . T_MOVIES . " WHERE `release` = '$year' OR `quality` IN ('hd','dvd','hd-tv') ORDER BY `id` DESC LIMIT 26";
    $query = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['source']    = Wo_GetMedia($fetched_data['source']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=watch-film&film-id=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_GetNewFilms(){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $data  = array();
    $year  = date('Y');
    $sql   = "SELECT * FROM " . T_MOVIES . " WHERE `release` = '$year' ORDER BY `id` DESC LIMIT 26";
    $query = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['source']    = Wo_GetMedia($fetched_data['source']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=watch-film&film-id=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_GetMtwFilms(){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false) {
        return false;
    }
    $data  = array();
    $year  = date('Y');
    $sql   = "SELECT * FROM " . T_MOVIES . "  ORDER BY `views` DESC LIMIT 26";
    $query = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['cover']     = Wo_GetMedia($fetched_data['cover']);
        $fetched_data['source']    = Wo_GetMedia($fetched_data['source']);
        $fetched_data['url']       = Wo_SeoLink("index.php?link1=watch-film&film-id=" . $fetched_data['id']);
        $data[]                    = $fetched_data;
    }
    return $data;
}
function Wo_SearchFilms($key){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false  || !$key) {
        return false;
    }
    $data  = array();
    $key   = Wo_Secure($key);
    $sql   = "SELECT  *  FROM 
             " . T_MOVIES . "  
             WHERE `name` LIKE '%$key%' 
              OR `description` LIKE '%$key%'
               OR `genre` LIKE '%$key%'
                OR `stars` LIKE '%$key%'
                 OR `stars` LIKE '%$key%'
                  LIMIT 10";
    $query = mysqli_query($sqlConnect, $sql);
    while ($fetched_data = mysqli_fetch_assoc($query)) {
        $fetched_data['url']   = Wo_SeoLink("index.php?link1=watch-film&film-id=" . $fetched_data['id']);
        $fetched_data['name']  = Wo_GetShortTitle($fetched_data['name']);
        $fetched_data['cover'] = Wo_GetMedia($fetched_data['cover']);
        $data[]                = $fetched_data;
    }
    return $data;
}
function Wo_DeleteFilm($id){
    global $sqlConnect, $wo;
    if ($wo['loggedin'] == false  || !is_numeric($id) || $wo['user']['admin'] != 1) {
        return false;
    }
    $id    = Wo_Secure($id);
    $sql   = "DELETE FROM ".T_MOVIES." WHERE `id` = '$id'";
    return mysqli_query($sqlConnect, $sql);
}