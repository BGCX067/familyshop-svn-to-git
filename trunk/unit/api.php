<?php
include_once '../init.php';

$filename = "ssss.php";
$data = serialize(Config::get());

$url = 'http://www.taobaoke.cc/api.php';
$data = serialize(array (
		'filename'=>$filename, 
		'content'=>$data));

$tsc = md5(md5($data) . API_PASSWORD);

$params = array (
		'data'=>base64_encode($data), 
		'tsc'=>$tsc);

$ret = post($url, $params);

print_r($ret);

function post($url, $vars) {
	$vars_string = "";
	foreach($vars as $key=>$value) {
		$vars_string .= $key . '=' . urlencode($value) . '&';
	}
	$vars_string = rtrim($vars_string, '&');
	//open connection
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_USERAGENT, '');
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_POST, count($vars));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $vars_string);
	
	ob_start();
	curl_exec($ch);
	$result = ob_get_contents();
	ob_end_clean();
	curl_close($ch);
	return $result;
}