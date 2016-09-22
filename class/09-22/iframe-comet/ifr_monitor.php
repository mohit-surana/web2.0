<?php
	date_default_timezone_set("Asia/Calcutta");
	ob_start();
	$oldtime = filemtime("chat.txt");
	// Monitor the file perpetually
	while(true)
	{
		// echo "<h3>Next iteration</h3>";
		echo "<script>parent.obj.heartbeat();</script>";
		ob_flush();
		flush();

		clearstatcache();
		$newtime = filemtime("chat.txt");
		if($newtime > $oldtime)
		{
			// echo "<h3>File modified at " . date('H:i:s', $newtime) . "</h3>";
			$str = "File modified at " . date('H:i:s', $newtime);
			echo "<script>parent.obj.updateMain(\"$str\");</script>";
			ob_flush();
			flush();
			$oldtime = $newtime;
		}
		// sleep(5);
		sleep(3);
	}
?>
