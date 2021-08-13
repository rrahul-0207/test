<?php
include 'config.php';
$sqlConnect =  mysqli_connect($sql_db_host,$sql_db_user,$sql_db_pass,$sql_db_name);
function convertDateTime($unixTime) {
   $dt = new DateTime("@$unixTime");
   return $dt->format('Y-m-d');
}

    $grabBday = "SELECT * FROM wo_users";
	//here it will take the name of the person whose bday is on a particular date
    if($rs = mysqli_query($sqlConnect, $grabBday))
    {
        
        while($row=mysqli_fetch_array($rs))
        {
           
           
            $lastseen=$row['lastseen'];
            $number=$row['phone_number'];
           $dateVarName = convertDateTime($lastseen);
           
       $now = date("Y-m-d");
       $date1=date_create($dateVarName);
       $date2=date_create($now);
       $diff=date_diff($date1,$date2);
       $days=$diff->format("%a");

        if($days==7){
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
$result=curl_exec($c); 
curl_close($c);
            
        }
        }
       
    }



?>