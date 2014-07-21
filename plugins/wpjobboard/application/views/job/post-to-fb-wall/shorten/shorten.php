<?php

$url = 'http://codecri.me/case/261/shorten-a-url-with-goo-gl-using-php';

// Optional values
$email    = ''; // GMail or Google Apps email address
$password = '';

$api_key  = '';

require 'class.xhttp.php';

// -------------------------------------------------------------------
// Arvin Castro | January 11, 2011
// http://codecri.me/case/261/shorten-a-url-with-goo-gl-using-php

if($email and $password) {
	$data = array();
	$data['post'] = array(
		'accountType' => 'HOSTED_OR_GOOGLE',
		'Email'       => $email,
		'Passwd'      => $password,
		'service'     => 'urlshortener',
		'source'      => 'codecri.me-example' // Application's name, e.g. companyName-applicationName-versionID
		);

	$response = xhttp::fetch('https://www.google.com/accounts/ClientLogin', $data);

	// Check if login failed
	if(!$response['successful']) {
		echo "Login Failed\n";
		print_r($response);
		die();
	}

	preg_match('/Auth=(.+)/', $response['body'], $matches);
	$auth = $matches[1];
}

$data = array();
if(isset($auth)) $data['headers']['Authorization'] = "GoogleLogin auth=$auth";
if($api_key) $data['get']['key'] = $api_key;

$data['headers']['Content-Type'] = "application/json";
$data['post'] = array(
	'longUrl' => $url,
	);

$response = xhttp::fetch("https://www.googleapis.com/urlshortener/v1/url", $data);

if($response['successful']) {
	$var = json_decode($response['body'], true);
	$shortURL = $var['id'];
	echo $shortURL;

} else {
	print_r($response);
}

?>