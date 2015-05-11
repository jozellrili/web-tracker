<!DOCTYPE html>
<html>
<head>
	<title></title>
<link href="css/bootstrap.min.css" rel="stylesheet">
</style>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


$to_crawl = "https://bestspace.co";
$c = array();
$i = 0;

function get_links($url) {
	global $c;
	$input  = @file_get_contents($url);
	$regexp = "<a\s[^>]*href=(\"??)([^\">]*?)\\1[^>]*>(.*)<\/a>";
	preg_match_all("/$regexp/siU", $input, $matches);
	$base_url = parse_url($url, PHP_URL_HOST);
	$l = $matches[2];
	
	foreach($l as $link) {
		
		if (strpos($link, "#")) {
			$link = substr($link, 0, strpos($link, "#"));
		}
		if (substr($link,0,1) == ".") {
			$link = substr($link, 1);
		}
		if (substr($link,0,7) == "http://") {
			$link = $link;
		}
		else if (substr($link,0,8) == "https://") {
			$link = $link;
		}
		else if (substr($link,0,2) == "//") {
			$link = substr($link, 2);
		}
		else if (substr($link,0,1) == "#") {
			$link = $url;
		}
		else if (substr($link,0,7) == "mailto:") {
			$link = "[".$link."]";
		}
		else {
			if (substr($link, 0, 1) != "/") {
				$link = $base_url."/".$link;
			}
			else {
				$link = $base_url.$link;
			}
		}

		if (substr($link, 0, 7) != "http://" && substr($link, 0, 8) != "https://" && substr($link, 0, 1) != "[") {
			if (substr($link, 0, 8) == "https://") {
				$link = "https://".$link;
			}
			else {
				$link = "http://".$link;
			}
		}
		//echo $link."<br/>";
		if (!in_array($link, $c)) {
			array_push($c, $link);
		}
		
	}
}
	
get_links($to_crawl);
//echo "ARRAY <br />";
foreach ($c as $page) {
	# code...
	get_links($page);
	//echo $page."<br />";
}


function get_domain($url)
{
    $host = @parse_url($url, PHP_URL_HOST);
    if (!$host)
        $host = $url;

    if (substr($host, 0, 4) == "www.")
        $host = substr($host, 4);

    if (strlen($host) > 50)
        $host = substr($host, 0, 47) . '...';

    return $host;
}

	echo "<table class = 'table table-striped'>";
	echo "<tbody>";
	echo "<tr>";
	echo "<th>#</th><th>DOMAIN NAME</th><th>URL</th>";
	echo "</tr>";
foreach ($c as $page) {
	$i++;
	echo "<tr>";
	echo "<td >".$i."</td><td>".get_domain($to_crawl)."</td><td>".$page;
	echo "</td>";

	echo "</tr>";
	}
	// foreach ($c as $domain) {
	// echo "<tr>";
	// echo "<td>".get_domain($to_crawl);
	// echo "</td>";
	// echo "</tr>";
	// }
	echo "</tbody>";
	echo "</table>";

?>
</body>
</html>