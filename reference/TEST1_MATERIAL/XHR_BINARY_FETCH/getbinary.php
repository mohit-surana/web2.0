<?php
	//header("Content-type:video/mp4");
	$file = fopen("sample.mp4", "rb");
	
	$retstr = fread($file, 1000000);
	
	echo $retstr;

?>