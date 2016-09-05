<?php
	extract($_GET);
	
	//Now we got a part of the movie. We need to read the file
	// line by line, compare with the "part" and add the matching movies
	
	$file = fopen("Movies.txt", "r");
	
	//The array we will be populating
	$ret = array();
	
	//Send it back 
	//$ret[] = $moviepart;
	
	while($line = fgets($file))
	{
		$lin = trim($line);
	
		//Compare..case insensitive
		//strncasecmp(haystack, needle, count)
		
		if(strncasecmp($lin, $moviepart, strlen($moviepart)) == 0)
		{
			$ret[] = $lin; //array index autoincrement
		}
	}
		
	$moviesarr = json_encode($ret);
	
	echo $moviesarr;
?>