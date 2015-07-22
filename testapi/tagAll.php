<?php
$url = 'http://localhost/laravel/public/api/tags';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_HEADER, false); 
echo $output=curl_exec($ch);
curl_close($ch);
//print_r(json_decode($output));
?>