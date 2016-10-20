<?php
	ob_start();
	header("Content-type:text/event-stream");
	
	$count = 1;
	
	while(true)
	{
		echo "event:myevent\n";
		echo "retry:10000\n";
		echo "data:<h2>Count is: $count</h2>\n\n";
		ob_flush();
		flush();
		
		$count++;
		sleep(3);
	}
?>