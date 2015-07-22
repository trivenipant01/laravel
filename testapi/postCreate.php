<?php
//extract($_POST);

$url = 'http://localhost/laravel/public/api/posts';
$fields = array(
						'name' => urlencode('test post6 using curl'),
						'slug' => urlencode('test-post6'),
						'body' => urlencode('this is simple post6 curl'),
						);

//url-ify the data for the POST
$fields_string='';
foreach($fields as $key=>$value) {
 $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');
//open connection
$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
//execute post
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
echo $result = curl_exec($ch);
//close connection
curl_close($ch);
?>