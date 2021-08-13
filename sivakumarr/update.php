<?php
error_reporting( E_ALL );
ini_set('display_errors', '1');

require('../assets/init.php');

$r = mysqli_query($sqlConnect, "CREATE TABLE IF NOT EXISTS wo_rewards (
    id INTEGER NOT NULL PRIMARY KEY,
    user_id INTEGER NOT NULL UNIQUE,
    balance INTEGER NOT NULL DEFAULT 0,
    lifetime INTEGER NOT NULL DEFAULT 0
) ENGINE=InnoDB");
if ($r /**&& mysqli_affected_rows($sqlConnect) > 0*/)
    echo "wo_rewards created";
else
    echo "wo_rewards failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "CREATE TABLE IF NOT EXISTS wo_rewards_requests (
    id INTEGER NOT NULL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    `value` INTEGER NOT NULL DEFAULT 0,
    status ENUM('pending', 'success', 'rejected', 'cancelled') NOT NULL DEFAULT 'pending',
    admin_id INTEGER,
    created DATETIME NOT NULL NOW(),
    action_on DATETIME
) ENGINE=InnoDB");
if ($r /**&& mysqli_affected_rows($sqlConnect) > 0*/)
    echo "wo_rewards_requests created";
else
    echo "wo_rewards_requests failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "CREATE TABLE IF NOT EXISTS wo_rewards_props (
    id INTEGER NOT NULL PRIMARY KEY,
    user_id INTEGER NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `value` VARCHAR(1000) NOT NULL
) ENGINE=InnoDB");
if ($r /**&& mysqli_affected_rows($sqlConnect) > 0*/)
    echo "wo_rewards_props created";
else
    echo "wo_rewards_props failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('reCaptchaKey', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI')");
if ($r && mysqli_affected_rows($sqlConnect) > 0)
    echo "reCaptcha key set";
else
    echo "reCaptcha key failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('reCaptchaSecret', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe')");
if ($r && mysqli_affected_rows($sqlConnect) > 0)
    echo "reCaptcha secret set";
else
    echo "reCaptcha secret failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('rewards', '1')");
if ($r && mysqli_affected_rows($sqlConnect) > 0)
    echo "rewards enabled set";
else
    echo "rewards enabld failed : " . mysqli_error($sqlConnect);

$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('rewardPostPoints', '10')");
$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('rewardInvitePoints', '10')");
$r = mysqli_query($sqlConnect, "INSERT INTO wo_config (`name`, `value`) VALUES ('rewardMinReq', '')");
