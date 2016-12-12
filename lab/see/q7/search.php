<?php
	header("Content-type:text/xml");
	extract($_GET);
	// The pluses on the query string automatically get converted to space separated words
	// We must send it again as plus separated words
	$query = implode("+", explode(" ", $query));
	$url = "http://www.bing.com/search?q=" . $query . "&format=rss";
	echo file_get_contents($url);
?>
