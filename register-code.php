<?php
    require_once('updater.php');
    session_start();
    require 'myphpapp/myphpapp/vendor/autoload.php';
    use Plivo\RestClient;

    $phone = '+91'.$_POST['phone_num'];

    if( $_SESSION['otp'] == '' ) {
        echo 'message has sent';
        $otp = rand( 100000, 999999 );
   
        $_SESSION['otp'] = $otp;
        $message = "Welcome to Mitrah.in. Your one time password is ".$_SESSION['otp'];
        $client = new RestClient("MAMJBKMZY4Y2YZOWM1Y2","ZmJhOGJlODkyZDcxNGQ4ZjU0ZDhmODJhMDA4NWU1");
        $message_created = $client->messages->create(
            '+918810638147',
            [$phone],
            $message
        );
        if(empty( $message_created )){
            echo 'error';
        }
    }
    else {
        if( $_POST['otp'] == $_SESSION['otp'] ) {
            $_POST['username'] = rand(999,9999)."user".rand(10000,99999);
            $result = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE username='".$_POST['username']."'"); 
            $row = mysqli_num_rows($result);

            $result = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE phone_number='".$_POST['phone_num']."'");
            $row = mysqli_num_rows($result);
            if( $row > 0 ) {
                echo 'number exist';
            }
            else {
                $_POST['password'] = sha1($_POST['password']);
                $_POST['avatar'] = 'upload/photos/d-cover.jpg';
                $_POST['cover'] = 'upload/photos/d-cover.jpg';
                $_POST['email_code'] = md5($_POST['username']);
                $_POST['src'] = 'site';
                $_POST['lastseen'] = time();
                $_POST['active'] = '1';
                $_POST['birthday'] = '0000-00-00';
                $_POST['registered'] = date('n') . '/' . date("Y");
                $_POST['joined'] = time();
                $_POST['language'] = 'english';
                $_POST['order_posts_by'] = '1';
                $_POST['ip'] = get_client_ip();

                $gender = 'male';
                if (!empty($_POST['gender'])) {
                    if ($_POST['gender'] != 'male' && $_POST['gender'] != 'female') {
                        $gender = 'male';
                    } else {
                        $gender = $_POST['gender'];
                    }
                }
                
                if( $_POST['invited'] ) {
                    $sql = mysqli_query($sqlConnect, "insert into wo_users(username, first_name, last_name, password, email_code, src, gender, lastseen, active, birthday, phone_number, registered, joined, ip_address, language, order_posts_by) values('".$_POST['username']."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['password']."', '".$_POST['email_code']."', '".$_POST['src']."', '".$gender."', '".$_POST['lastseen']."', '".$_POST['active']."', '".$_POST['birthday']."', '".$_POST['phone_num']."', '".$_POST['registered']."', '".$_POST['joined']."', '".$_POST['ip']."', '".$_POST['language']."', '".$_POST['order_posts_by']."')");
					
                    if( $sql ) {
                        
                        $sql_result = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE username = '".$_POST['username']."'");
                        $data = mysqli_fetch_assoc( $sql_result );
                        $_SESSION['user_id'] = $data['user_id'];
						$user_id = $data['user_id'];
						// wo_userfields
						mysqli_query($sqlConnect, "insert into wo_userfields(user_id) values($user_id)");
						mysqli_query($sqlConnect, "delete from `wo_admininvitations` where code = '".$_POST['invited']."'");
                        unset($_SESSION['otp']);
                        echo 'success';
                    }
                }
                

                    // if( $sql ) {
                    //     $sql_result = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE username = '".$_POST['username']."'");
					
                    //     $data = mysqli_fetch_assoc( $sql_result );
                    //     $_SESSION['user_id'] = $data['user_id'];
                    //     // unset($_SESSION['otp']);
                    //     $datas = array(
                    //         'status' => 200,
                    //         'location' => 'http://mitrah.net/start-up'
                    //     );
                       
						
                    // }
            }
        }
        else {
            echo 'Your OTP is incorrect';
        }
    }

    function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

    exit();
?>

