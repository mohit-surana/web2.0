<?php
	/*
	foreach ($_SERVER as $key => $value) {
		echo "$key..$value<br>/";
	}
	*/
	header("Content-encoding:gzip");
	// Without this, the client will not know that this is compressed

	$file = file_get_contents("data");
	$retdata = gzencode($file, 9);
	echo $retdata;
?>
