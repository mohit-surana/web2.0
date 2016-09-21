<?php
	// Without using ob_functions, it will buffer and send only once
	ob_start();
	$count = 1;
	// echo str_pad('', 1024);
	// for Firefox
	while($count < 6)
	{
		echo "<h3>Say hello to Cow #$count</h3>";
		ob_flush();
		flush();
		$count++;
		sleep(3);
	}
?>
