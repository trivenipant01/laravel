<?php
//extract($_POST);
$url = 'http://localhost/laravel/public/api/tags/6';
//$url =$this->__url.$path;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
	//curl_setopt($ch,CURLOPT_POST, count($fields));
    
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept: application/json'));
	echo $result = curl_exec($ch);
    $result = json_decode($result);
    curl_close($ch);
    return $result;
?>