<?php 
include ('yourls-widget-config.php');

// EDIT THIS: the query parameters
$url = $_REQUEST['url']; // URL to shrink
$keyword = $_REQUEST['key'];				// optional keyword
$format = 'simple';				// output format: 'json', 'xml' or 'simple'

// EDIT THIS: the URL of the API file
$api_url = $_REQUEST['api_url'];

// Init the CURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
curl_setopt($ch, CURLOPT_POST, 1);              // This is a POST request
curl_setopt($ch, CURLOPT_POSTFIELDS, array(     // Data to POST
		'url'      => $url,
		'keyword'  => $keyword,
		'format'   => $format,
		'action'   => 'shorturl',
		'username' => $username,
		'password' => $password
	));

// Fetch and return content
$data = curl_exec($ch);
curl_close($ch);

// Do something with the result. Here, we just echo it.
echo <<<SHOWTIME
	<a href='$data'>$data</a>
SHOWTIME;
?>

