<?php
//extract($_POST);
$url = 'http://localhost/laravel/public/api/posts/5';
//$url =$this->__url.$path;
$fields = array(
				'name' => urlencode('triveni post'),
				'body' => urlencode('this is my test laravel api')
				);

//url-ify the data for the POST
$fields_string='';
foreach($fields as $key=>$value) {
 $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    echo $result = curl_exec($ch);
    $result = json_decode($result);
    curl_close($ch);
    return $result;
?>