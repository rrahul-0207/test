<?php
include 'config.php';
$sqlConnect =  mysqli_connect($sql_db_host,$sql_db_user,$sql_db_pass,$sql_db_name);
$date=date('Y-m-d');
$Toaday = '%'.date('n-j').'%';//here my date format in my DB is 2010/09/30
    $grabBday = "SELECT * FROM wo_users WHERE birthday like '$Toaday'";
	//here it will take the name of the person whose bday is on a particular date
    if($rs = mysqli_query($sqlConnect, $grabBday))
    {
        
        while($row=mysqli_fetch_array($rs))
        {
           
            $number= $row['phone_number'];
            $name=$row['first_name'];
      mysqli_query($sqlConnect, "INSERT INTO `wo_birthday` (`id`, `username`, `phone_number`,`date`) VALUES (NULL, '$name', '$number','$date')");
        
     echo $messages="From all our MITRAH team we wish you a very happy birthday ". $name;
  
  // $m=implode(',',$number);
    $query = http_build_query([
 'user' => 'mitra',
 'password' => 'mitra',
 'senderid' => 'Mitrah',
 'channel' => 'Trans',
  'DCS' => '0',
   'flashsms' => '0',
   'number' => $number,
   'text' => $messages,
    'route' => '4'
 ]);

$c = curl_init();
curl_setopt($c , CURLOPT_URL , 'http://panel.smsmessenger.in/api/mt/SendSMS?' . $query);
$result=curl_exec($c); 
curl_close($c); 
   
}

}

  ?>