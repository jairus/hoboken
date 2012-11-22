<?php
//echo "<pre>";
//print_r($_SERVER);

$pieces = explode(".", $_SERVER['HTTP_HOST']);
$t = count($pieces);
//remove mommies247.com
unset($pieces[$t-1]);
unset($pieces[$t-2]);
$subdomain = implode(".", $pieces);
$dir = dirname(__FILE__)."/../sites/".$subdomain;
if(is_dir($dir)){
	if($_SERVER['HTTPS']){
		$location = "https://".$_SERVER['HTTP_HOST']."/index.php";
	}
	else{
		$location = "http://".$_SERVER['HTTP_HOST']."/index.php";
	}	
}
else{
	if($_SERVER['HTTPS']){
		$location = "https://hoboken.mommies247.com/index.php";
	}
	else{
		$location = "http://hoboken.mommies247.com/index.php";
	}
}

header ('HTTP/1.1 301 Moved Permanently');
header ('Location: '.$location);

?>