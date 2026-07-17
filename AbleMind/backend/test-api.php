<?php

$apiKey="sk-or-v1-c025a1e42fc994de4d0d22b62c91e40660e3abb42dd7b3d25680b7c71841eaf3Y";


$ch=curl_init();


curl_setopt($ch,CURLOPT_URL,
"https://openrouter.ai/api/v1/models");


curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);


curl_setopt($ch,CURLOPT_HTTPHEADER,[

"Authorization: Bearer ".$apiKey

]);


$response=curl_exec($ch);


curl_close($ch);


echo $response;

?>