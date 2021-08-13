<?php
$t="kabhi";
	$query = http_build_query([
            "track" => $t,
]);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://ws.audioscrobbler.com/2.0/?method=track.search&api_key=23557c599d35c9708c3b941c1abf4983&format=json&track=".$t,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{}",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
  $my_array=json_decode($response);
  echo "<pre>";
 //print_r($my_array);
 /* https://image.tmdb.org/t/p/original/*/
 foreach ($my_array as $key=>$value){

	foreach ($value as $key1=>$value1){
	       
foreach ($value1 as $key2=>$value2){
    
foreach ($value2 as $key3=>$value3){
   
//echo $value3->artist.'<br/>';
foreach ($value3->image as $k=>$val){
   foreach ($val as $n=>$kvalue){
   if($n=="#text"){
       echo $kvalue.'<br/>';
   }
   }
}
//echo	'<div>'.$value1->title.'</div><img src="https://image.tmdb.org/t/p/original/'.$value1->poster_path.'" width="50" height="50"/>';
} 
} 
}
 } 
 
 
}
?>