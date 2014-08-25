<?php
/**
 * Created by PhpStorm.
 * User: smartosc
 * Date: 8/25/14
 * Time: 3:28 PM
 */
$serverList = trim(file_get_contents('pingList.txt'));
$serverList = str_replace("\r\n","\n",$serverList);
$pingServers = explode("\n",$serverList);
foreach($pingServers AS $k=>$s){
	$s = trim($s);
	if($s) $pingServers[$k] = $s;
	else unset($pingServers[$k]);
}