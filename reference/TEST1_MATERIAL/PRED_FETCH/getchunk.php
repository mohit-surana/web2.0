<?php
	extract($_GET);
	
	$file = fopen("data.txt", "r");
	
	$pos = 2000*$count;
	
	//We need to actually check if we are shooting past the end of file.
	// If so, then we need to echo back the last "chunk". This is left as 
	// an exercise for you. 

	//For ex: If we are reading in chunks of 2000 chars and the size of the
	// file is 11000, then after 5 reads we are left with 1000 chars. Now if
	// we seek again, we will shoot 1000 chars past EOF. We need to then 
	// back off and read the last 1000 chars only.
	fseek($file, $pos);
	
	$retstr = fread($file, 2000);
	
	echo $retstr;

?>