<?php
include_once "pingServers.php";
include_once "include/functions.php";
include_once "include/http.php";
include_once('include/class-http.php');
include_once('include/class-IXR.php');
include_once('include/class-wp-http-ixr-client.php');


Class Ping
{
	public function setInfo($key, $value)
	{
		global $blogInfo;
		$blogInfo[$key] = $value;
		return $this;
	}

	public function getInfo($key)
	{
		global $blogInfo;
		return $blogInfo[$key];
	}

	public function ping($server = '', $path = '')
	{
		var_dump($server);
		if (!$server) return;
		global $wp_version;
// using a timeout of 3 seconds should be enough to cover slow servers
		$client = new WP_HTTP_IXR_Client($server, ((!strlen(trim($path)) || ('/' == $path)) ? false : $path));
		$client->timeout = 3;
		$client->useragent .= ' -- WordPress/' . $wp_version;

// when set to true, this outputs debug messages by itself
		$client->debug = false;
		$home = trailingslashit($this->getInfo('url'));
		if (!$client->query('weblogUpdates.extendedPing', $this->getInfo('blogname'), $home, $this->getInfo('rss2_url'))) // then try a normal ping
			$client->query('weblogUpdates.ping', $this->getInfo('blogname'), $home);
		var_dump($client->response());

	}


}

$ping = new Ping();
$ping->setInfo('url', "http://matrixcyber.org")
	->setInfo('blogname', 'test ping!')
	->setInfo('rss2_url', 'http://matrixcyber.org/feed/');
foreach ($pingServers AS $pingServer) {
	$ping->ping($pingServer);
}