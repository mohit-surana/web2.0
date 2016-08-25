<?php
	extract($_GET);

	// Open a file and do a case-insensitive search
	$file = fopen("Players.txt", "r");
	$players = array();

	while($line = fgets($file))
	{
		// Use strncasecmp for case insensitive search with limited (n) characters
		$line = trim($line);
		if(strncasecmp($player, $line, strlen($player)) == 0)
		{
			$players[] = $line;
		}
	}
	fclose($file);
	echo json_encode($players);
?>
