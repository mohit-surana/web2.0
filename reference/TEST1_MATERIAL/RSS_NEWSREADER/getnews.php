<?php
	header("Content-type:text/xml");
	
	$news = file_get_contents("olympics.xml"); //this can get FROM ANY SERVER

	echo $news;
?>