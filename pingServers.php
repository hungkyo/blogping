<?php
/**
 * Created by PhpStorm.
 * User: smartosc
 * Date: 8/25/14
 * Time: 3:28 PM
 */
$serverListTxt = trim(file_get_contents('pingList.txt'));
$serverListTxt = str_replace("\r\n", "\n", $serverListTxt);
$pingServers = explode("\n", $serverListTxt);
$temp = array();
foreach ($pingServers AS $k => $s) {
	$s = trim($s);
	if ($s && !$temp[$s]) {
		$pingServers[$k] = $s;
		$temp[$s] = $k;
	} else unset($pingServers[$k]);
}

$testImplode = implode("\n", $pingServers);
if ($testImplode <> $serverListTxt) {
	file_put_contents('pingList.txt', $testImplode);
}