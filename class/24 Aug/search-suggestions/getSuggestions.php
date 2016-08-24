<?php
	// Get the chunk number needed by the class_implements
	extract($_GET);

	// Open the file for reading
	$file = fopen("Players.txt", "r");
	$data = fread($file, 500);
	echo implode("<br><br>", $data);
	fclose($file);
?>
