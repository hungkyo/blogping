<?php
include_once "pingServers.php";
include_once "include/functions.php";
include_once "include/http.php";
include_once('include/class-http.php');
include_once('include/class-IXR.php');
include_once('include/class-wp-http-ixr-client.php');

function weblog_ping($server = '', $path = '')
{
	var_dump($server);
	global $wp_version, $blogName,$homeURL, $rss2URL;
// using a timeout of 3 seconds should be enough to cover slow servers
	$client = new WP_HTTP_IXR_Client($server, ((!strlen(trim($path)) || ('/' == $path)) ? false : $path));
	$client->timeout = 3;
	$client->useragent .= ' -- WordPress/' . $wp_version;

// when set to true, this outputs debug messages by itself
	$client->debug = false;
	$home = trailingslashit($homeURL);
	var_dump($client->query('weblogUpdates.extendedPing', $blogName, $home, $rss2URL));
	if (!$client->query('weblogUpdates.extendedPing', $blogName, $home, $rss2URL)) // then try a normal ping
		$client->query('weblogUpdates.ping', $blogName, $home);
}

$blogName = "test ping!";
$homeURL = "http://matrixcyber.org";
$rss2URL = "http://matrixcyber.org/feed/";

$blogInfo = array(
	'url' => $homeURL,
);

weblog_ping($pingServers[0]);