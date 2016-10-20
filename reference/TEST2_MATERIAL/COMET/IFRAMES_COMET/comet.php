<?php
	ob_start();
	echo str_pad('',1012);
	ob_flush();
	flush();
	
	$count = 1;
	date_default_timezone_set('Asia/Calcutta');
	//Get the updation time of "data.txt"
	$oldtime = filemtime("data.txt");
	
	while(true)
	{
		//Get the modification time now (new)
		//Clear the cache now.
		clearstatcache();
		
		$newtime = filemtime("data.txt");
		if($newtime > $oldtime)
		{
			echo "<script type='text/javascript'>";
			$retstr = "File changed at: " . date('H i s', $newtime);
			echo "parent.obj.updateDiv('$retstr');";
			echo "</script>";
			ob_flush();
			flush();			
			$oldtime = $newtime;
		}
	
		else // If file is NOT updated, send heartbeat.
		{
			//Send the heartbeat to the client to let him know you are alive
			echo "<script type='text/javascript'>";
			echo "parent.obj.heartbeat();";
			echo "</script>";
			ob_flush();
			flush();
		}
		sleep(5);
	}
?>