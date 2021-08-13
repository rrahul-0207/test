<?php

function verify_captcha($response) {
    global $wo;
    $fields = "response=" . urlencode($response) . "&secret=" . urlencode($wo['config']['reCaptchaSecret']);
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HEADER, false);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        'Content-Length' => strlen($fields)
    ));
    curl_setopt($c, CURLOPT_POSTFIELDS, $fields);
    $res = curl_exec($c);
    if ($res) {
        $data = json_decode($res, true);
        return $data['success'];
    }

    return false;
}

function rewards_eligible($user_id, $value, $type) {
    global $sqlConnect;
    if ($type != 'post_action')
        return true;

    $dateStr = date("Y-m-d");
    $r = mysqli_query($sqlConnect, "SELECT * FROM wo_rewards_props WHERE user_id = $user_id AND `name` = '$type' AND `value` = '$dateStr'");
    if ($r && $r->num_rows > 0)
        return false;
    return true;
}

function rewards_add($user_id, $value, $type) {
    global $sqlConnect;
    if (!rewards_eligible($user_id, $value, $type))
        return false;

    $r = mysqli_query($sqlConnect, "INSERT INTO wo_rewards (user_id, balance, lifetime) VALUES($user_id, $value, $value) ON DUPLICATE KEY UPDATE balance = balance + VALUES(balance), lifetime = lifetime + VALUES(lifetime)");
    if ($r && mysqli_affected_rows($sqlConnect) > 0) {
        $dateStr = date("Y-m-d");
        $r1 = mysqli_query($sqlConnect, "SELECT * FROM wo_rewards_props WHERE user_id = $user_id AND `name` = '$type'");
        if ($r1 && $r1->num_rows > 0)
            mysqli_query($sqlConnect, "UPDATE wo_rewards_props SET `value` = '$dateStr' WHERE user_id = $user_id AND `name` = '$type'");
        else
            mysqli_query($sqlConnect, "INSERT INTO wo_rewards_props (`name`, `value`, user_id) VALUES('$type', '$dateStr', $user_id)");
    }
    return mysqli_error($sqlConnect);
}

function rewards_history_count() {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "SELECT COUNT(*) as history_count FROM wo_rewards_requests WHERE status = 'success'");
    if ($r && $r->num_rows > 0) {
        $row = $r->fetch_assoc();
        return $row['history_count'];
    }
    return 0;
}

function rewards_requests_count() {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "SELECT COUNT(*) as pending_count FROM wo_rewards_requests WHERE status = 'pending'");
    if ($r && $r->num_rows > 0) {
        $row = $r->fetch_assoc();
        return $row['pending_count'];
    }
    return 0;
}

function rewards_load_requests($start = 0, $count = 50) {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "SELECT t1.*, t2.first_name, t2.last_name, t2.user_id, t3.user_id, t3.balance FROM wo_rewards_requests t1 LEFT JOIN wo_users t2 ON t1.user_id=t2.user_id LEFT JOIN wo_rewards t3 ON t1.user_id=t3.user_id WHERE t1.status = 'pending' ORDER BY t1.created LIMIT $start, $count");
    if ($r && $r->num_rows > 0) {
        return $r->fetch_all(MYSQLI_ASSOC);
    }
    return false;
}

function rewards_requests_for_user($user_id, $status, $start = 0, $count = 0) {
    global $sqlConnect;

    $q = "SELECT * FROM wo_rewards_requests WHERE user_id = $user_id";
    if (!empty($status))
        $q = $q . "  AND status = '$status'";

    if (!empty($status) && $status == 'success')
        $q = $q . " ORDER BY created DESC";
    else
        $q = $q . " ORDER BY created";

    if ($start > 0 && $count > 0)
        $q = $q . " LIMIT $start, $count";
    else if ($count > 0)
        $q = $q . " LIMIT $count";

    $r = mysqli_query($sqlConnect, $q);

    if ($r && $r->num_rows > 0)
        return $r->fetch_all(MYSQLI_ASSOC);

    return false;
}

function rewards_load_history($user_id, $start = 0, $count = 50) {
    return rewards_requests_for_user($user_id, 'success', $start, $count);
}

function rewards_get($user_id) {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "SELECT * FROM wo_rewards WHERE user_id = $user_id");
    if ($r && $r->num_rows > 0)
        return $r->fetch_assoc();
    return false;
}

function rewards_request($user_id, $value = 0) {
    global $sqlConnect;

    $rewards = rewards_get($user_id);
    if (!empty($wo['config']['rewards_min_request']) && $rewards['balance'] < $wo['config']['rewards_min_request'])
        return "You don't have enoogh rewards";

    $pending = rewards_requests_for_user($user_id, 'pending');
    if ($pending && is_array($pending) && count($pending) > 0) {
        return "A request is pending";
    }

    $r = mysqli_query($sqlConnect, "INSERT INTO wo_rewards_requests (user_id, `value`) VALUES($user_id, $value)");
    if ($r) {
        return true;
    }
    return "Something went wrong";
}

function rewards_request_reject($id) {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "UPDATE wo_rewards_requests SET status = 'rejected' WHERE id = $id AND status = 'pending'");
    if ($r && mysqli_affected_rows($sqlConnect) == 1)
        return true;
    return "Request not found " . "UPDATE wo_rewards_requests SET status = 'rejected' WHERE id = $id AND status = 'pending'";
}

function rewards_request_accept($id)
{
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "SELECT t1.*, t2.id as reward_id, t2.balance, t2.lifetime, t2.user_id FROM wo_rewards_requests t1 LEFT JOIN wo_rewards t2 ON t1.user_id = t2.user_id WHERE t1.id = $id ");
    if (!$r || $r->num_rows == 0)
        return "Request not found";
    $request = $r->fetch_assoc();

    if (empty($request['balance']))
        return "No balance";

    $reward_id = $request['reward_id'];
    $value = 0;
    if (!empty($request['value']))
        $value = $request['value'];
    else
        $value = $request['balance'];

    $transaction = mysqli_begin_transaction($sqlConnect);
    if ($transaction) {
        $r1 = mysqli_query($sqlConnect, "UPDATE wo_rewards_requests SET status = 'success', `value` = $value WHERE id = $id");
        $transaction = $r1 && mysqli_affected_rows($sqlConnect) == 1;

        $r2 = mysqli_query($sqlConnect, "UPDATE wo_rewards SET balance = balance - $value WHERE id = $reward_id");
        $transaction = $transaction && $r2 && mysqli_affected_rows($sqlConnect) == 1;

        if ($transaction) {
            mysqli_commit($sqlConnect);
            return true;
        }

        mysqli_rollback($sqlConnect);
    }

    return "Something went wrong";
}

function rewards_request_cancel($user_id) {
    global $sqlConnect;

    $r = mysqli_query($sqlConnect, "UPDATE wo_rewards_requests SET status = 'cancelled' WHERE user_id = $user_id AND status = 'pending'");
    if ($r && mysqli_affected_rows($sqlConnect) > 0)
        return true;
    return "Request not found";
}

