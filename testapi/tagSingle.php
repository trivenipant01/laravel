<?php
$url = 'http://localhost/laravel/public/api/tags/5';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
echo $output=curl_exec($ch);
curl_close($ch);
//print_r(json_decode($output));
?>