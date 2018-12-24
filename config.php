<?php
header('X-XSS-Protection:0');
$hostname = "localhost";
$db_username = "root";
$db_password = "usbw";
$db_name = 'blog';

if(!@mysql_connect($hostname,$db_username, $db_password)) die(mysql_error());
if(!@mysql_select_db($db_name)) die(mysql_error());

mysql_query("SET NAMES 'UTF8'");
mysql_query("SET character_set_connection = 'UTF8'");
mysql_query("SET character_set_client = 'UTF8'");
mysql_query("SET character_set_results = 'UTF8'");

$ayarlar=mysql_fetch_object(mysql_query("select * from ayarlar"));
define("Site_url","$ayarlar->site_url");

$per_page=6; 

$sayfa="";
$sayfa= isset($_GET['sayfa']) ? $_GET['sayfa'] : "anasayfa";  
$url=$sayfa;
 if($url != null){
	$url = rtrim($url, "/");
	$url = explode("/", $url);
}else{
   unset($url); 
}

function url_duzenle($text){ 
	$search = array(' ','ö','ü','ı','ğ','ç','ş','/','?','Ö','Ü','I','Ğ','Ç','Ş','&');
	$replace = array('_','o','u','i','g','c','s','_','_','o','u','i','g','c','s','_');
	$new_text = str_replace($search,$replace,trim($text));
	return $new_text;
}
function kucuk($text2){ 
	$search2 = array('A','B','C','Ç','D','E','F','G','H','I','İ','J','K','L','M','N','O','Ö','P','R','S','Ş','T','U','Ü','V','Y','Z','X','W');
	$replace2 = array('a','b','c','ç','d','e','f','g','h','ı','i','j','k','l','m','n','o','ö','p','r','s','ş','t','u','ü','v','y','z','x','w');
	$new_text2 = str_replace($search2,$replace2,trim($text2));
	return $new_text2;
}