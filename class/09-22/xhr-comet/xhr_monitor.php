<?php
	date_default_timezone_set("Asia/Calcutta");
	ob_start();
	$oldtime = filemtime("chat.txt");
	// Monitor the file perpetually
	while(true)
	{
		clearstatcache();
		$newtime = filemtime("chat.txt");
		if($newtime > $oldtime)
		{
			echo "File modified at " . date('H:i:s', $newtime);
			ob_flush();
			flush();
			$oldtime = $newtime;
		}
		// sleep(5);
		sleep(3);
	}
?>
