<?php
	header("Content-type:text/event-stream");
	ob_start();

	echo "event:myevent\n";
	echo "data:hello\n\n";
	
	/*
	echo "data:{\n";
	echo "data:'p1':'v1'\n";
	echo "data:'p2':'v2'\n";
	echo "data:}\n\n";
	*/

	ob_flush();
	flush();
?>
