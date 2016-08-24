<?php
	// Get the chunk number needed by the class_implements
	extract($_GET);

	// Open the file for reading
	$file = fopen("Movies.txt", "r");
	$position = 500 * $chunk;
	if($position > filesize("Movies.txt"))
	{
		echo "EOF";
	}
	else
	{
		// Move the file pointer to "position" inside the file and read from there
		fseek($file, $position);
		$data = fread($file, 500);
		$data = explode("\n", $data);
		echo implode("<br><br>", $data);
	}
	fclose($file);
?>
