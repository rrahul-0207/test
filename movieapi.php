<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=294db12631e6c00aeeb2afba2e2f37ee&query=dil",
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
 // print_r($a);
 /* https://image.tmdb.org/t/p/original/*/
 
   foreach ($my_array as $key=>$value){
echo "<pre>";
print_r($value);
	foreach ($value as $key1=>$value1){

//echo	'<div>'.$value1->title.'</div><img src="https://image.tmdb.org/t/p/original/'.$value1->poster_path.'" width="50" height="50"/>';
} 
} 
  
 
 
}