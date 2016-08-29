<?php
	header("Content-type:text/plain");
	$file = fopen("seats.in", "r");
	$line = trim(fgets($file));
	fclose($file);
	echo $line;
?>
