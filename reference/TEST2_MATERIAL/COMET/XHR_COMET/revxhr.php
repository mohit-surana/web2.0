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
			$retstr = "File changed at: " . date('H i s', $newtime);
			echo "$retstr";
			ob_flush();
			flush();			
			$oldtime = $newtime;
		}
		sleep(5);
	}
?>