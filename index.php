<?php
echo "Welcome to Web Crawler!\n";


$to_crawl = "http://animefreak.tv";

function get_links($url) {
	$input = @file_get_contents($url);
	$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU",$input, $matches);
	
	$l = $matches[2];
	
	foreach($l as $link) {
		
		
		
		if (strpos($link, "#")) {
			$link = substr($link, 0 , strpos($link, "#"));
		}
		 
		if (substr($link,0,1) == ".") {
			$link = substr($link, 1);
		}
		
		echo $link."<br />";

	}
}

get_links($to_crawl);

?>