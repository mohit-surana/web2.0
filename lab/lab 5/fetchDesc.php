<?php
	extract($_GET);
	$data = "No description available.";
	if(isset($title))
	{
		$file = fopen("descriptions.in", "r");
		while(!feof($file))
		{
			$line = trim(fgets($file));
			$info = explode(";", $line);
			if($info[0] == $title)
			{
				$data = $info[1];
				break;
			}
		}
		fclose($file);
	}
	echo $data;
?>
