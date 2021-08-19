<?php

require_once('updater.php');

session_start();
	require 'myphpapp/myphpapp/vendor/autoload.php';
	use Plivo\RestClient;

$phone = '+91'.$_POST['recoveremail'];

$result = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE phone_number='".$_POST['recoveremail']."'"); 

$row = mysqli_num_rows($result);


if($row > 0){


	$otp = rand( 100000, 999999 );

	$_SESSION['otp'] = $otp;
	$message = "Your OTP Verification Code for Mitrah account is ".$_SESSION['otp'].". OTP valid for 10 minutes. Do not share this OTP with anyone.";

	$client = new RestClient("MAMJBKMZY4Y2YZOWM1Y2","ZmJhOGJlODkyZDcxNGQ4ZjU0ZDhmODJhMDA4NWU1");
	$message_created = $client->messages->create(
		'+918810638147',
		[$phone],
		$message
	);
	if(empty($message_created )){
		echo 'error';
	}else{
		echo 'success';
	}
}
else{
	echo 'error';
}
exit();
?>