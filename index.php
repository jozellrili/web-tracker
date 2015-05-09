<?php
echo "Welcome to Web Crawler!\n";


$to_crawl = "http://animefreak.tv";

function get_links($url) {
	$input = @file_get_contents($url);
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU",$input, $matches);
	
	/* echo "<pre>";
	print_r($matches[2]);
	echo "</pre>"; 
	*/
	
	$l = $matches[2];
	
	foreach($l as $link) {
		echo $link."<br />";
	}
}

get_links($to_crawl);

?>