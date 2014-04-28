<?php

$prime_url = "http://interfacelift.com/wallpaper/downloads/date/widescreen/2560x1440/";
$images = array();


function get_url_contents($url){
	$crl = curl_init();
	$timeout = 5;
	curl_setopt($crl, CURLOPT_URL, $url);
	curl_setopt($crl, CURLOPT_HEADER, 0);
	curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.2 Safari/537.36');
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	$ret = curl_exec($crl);
	curl_close($crl);
	return $ret;
}

for ($i = 0; $i<332; $i++)
{
	$url = $prime_url."index".$i.".html";
	
	// get the first page
	$page = get_url_contents($url);
	
	preg_match_all('/<a href="(.*?)"><img src="\/img_NEW\/button_download.png"/', $page, $matches);
	
	foreach ( $matches[1] as $image )
	{
		$file_name = basename($image);
		if (!file_exists("/Volumes/Storage/Users/tkensiski/Sites/testing/backgrounds/".$file_name))
			exec("wget -U mozilla --directory-prefix=/Volumes/Storage/Users/tkensiski/Sites/testing/backgrounds/ " . "http://interfacelift.com" . $image);
	}
}
