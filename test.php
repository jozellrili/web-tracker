<?php
$to_crawl = "ubuntuforums.org/clientscript/vbulletin-core.js";
/*
function get_links($url) {

	$input  = @file_get_contents($url);
	$regexp = "<a\s[^>]*href=(\"??)([^\">]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU", $input, $matches);
	

	echo "<pre>";
	print_r($matches[2]);
	echo "</pre>";
}

get_links($to_crawl);*/
function content_type($url) {

$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
$content = curl_exec($ch);
if(!curl_errno($ch))
{
	$info = curl_getinfo($ch);
	echo 'Content type of returned data: ' . $info['content_type'];
	$info = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	echo '<br>'. $info;
}
curl_close($ch);

}

print content_type($to_crawl);
?>