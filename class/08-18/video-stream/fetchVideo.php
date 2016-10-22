<?php
	$file = fopen("Moo.mp4", "rb");
	// $ret = fread($file, filesize("Moo.mp4")); // entire file
	$ret = fread($file, 1024*1024*3); // segment
	echo $ret;

	/*
	// We can do this and receive @ client end using readyState == 3
	while(!feof($file))
	{
		$ret = fread($file, 1024*1024*1);
		echo $ret;
		sleep(2);
	}
	*/

	fclose($file);
?>
