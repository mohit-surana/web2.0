<?php
	ob_start();

	// Set the header for the events
	header("Content-type:text/event-stream");

	$oldtime = filemtime("chat-history.txt");
	// Monitor the file perpetually
	while(true)
	{
		clearstatcache();
		$newtime = filemtime("chat-history.txt");
		if($newtime > $oldtime)
		{
			// Assume that the last line is the updated one
			$lines = file("chat-history.txt");
			// file function will read entire file as an array of lines
			// array_pop function will give the last line
			$newmsg = array_pop($lines);

			echo "event:chatmsg\n";
			echo "retry:10\n";
			echo "data:$newmsg\n\n";

			ob_flush();
			flush();
			$oldtime = $newtime;
		}
		sleep(1);
	}
?>
