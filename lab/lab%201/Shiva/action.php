<?php
	$usn = $_GET['usn'];

	$f = fopen("usns.txt", "r") or die("Unable to open file!");
	$found = 0;
	
	while(!feof($f))
	{
		$str = fgets($f);
		$temp = explode(",", $str);
	
		if($usn == $temp[0])
		{
			$retval = "$temp[1],$temp[2]," . trim($temp[3]);
			echo "<html><script>parent.setFields('$retval');</script></html>";
			$found = 1;
		}
	}

	if($found == 0)
		echo "<html><head><script>parent.error()</script></head></html>";
?>

