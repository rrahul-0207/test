<?php 
include 'config.php';
$date=date('Y-m-d');
$sqlConnect =  mysqli_connect($sql_db_host,$sql_db_user,$sql_db_pass,$sql_db_name);
 $query = mysqli_query($sqlConnect, "SELECT * FROM `wo_users` WHERE `user_id` ='89'");
//print_r($query);
   while ($fetched_data = mysqli_fetch_assoc($query)) {

         $data= $fetched_data['phone_number'];
    }
    
  
    echo $data;
//$num_rows = mysqli_num_rows($query);

//echo "$num_rows Rows\n";
//print_r($query);
   /*while ($fetched_data = mysqli_fetch_assoc($query)) {

         // $data1= $fetched_data['following_id'];
         //$data2= $fetched_data['follower_id'];
        
        
    }*/
     //echo $query.'<br/>';


/*$number="8054558410";
$message="It has been a while you have not visited mitrah.in Please login and don't miss any update on mitrah.in (once in week)";
            $query = http_build_query([
 'user' => 'mitra',
 'password' => 'mitra',
 'senderid' => 'Mitrah',
 'channel' => 'Trans',
  'DCS' => '0',
   'flashsms' => '0',
   'number' => $number,
   'text' => $message,
    'route' => '4'
 ]);

$c = curl_init();
curl_setopt($c , CURLOPT_URL , 'http://panel.smsmessenger.in/api/mt/SendSMS?' . $query);
echo $result=curl_exec($c); 
curl_close($c);*/
?>