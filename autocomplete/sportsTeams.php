<?php

$a_json = array();
$a_json_row = array();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=294db12631e6c00aeeb2afba2e2f37ee&query=Kill+Dil",
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
  
 // print_r($a);
 /* https://image.tmdb.org/t/p/original/*/
 
   foreach ($my_array as $key=>$value){

	foreach ($value as $key1=>$value1){
	     $a_json_row["id"] =$value1->id;
		$a_json_row["label"] = $value1->title;
		$a_json_row["value"] = $value1->poster_path;
		array_push($a_json, $a_json_row);

} 
} 
  
 
 
}

       
		echo json_encode($a_json);
		
		?>