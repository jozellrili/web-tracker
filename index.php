<?php
$to_crawl = "http://bestspace.co";
function get_links($url) {
	$input = @file_get_contents($url);
	echo $input;
}
get_links($to_crawl);

<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

</body>
</html>

?>