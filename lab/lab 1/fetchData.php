<?php
	
	extract($_GET);
	$data = "Please enter a valid USN";
	
	if(isset($usn))
	{
		$file = fopen("students.in", "r");
		while(!feof($file))
		{
			$line = fgets($file);
			$info = explode(";", $line);
			if($info[0] == $usn)
			{
				$data = $line;
				break;
			}
		}
		fclose($file);
	}
	
	// Trailing newline character needs to be removed. So we use trim.
	echo '<html><head><script>parent.setFields("' . trim($data) . '")</script></head></html>';
?>
