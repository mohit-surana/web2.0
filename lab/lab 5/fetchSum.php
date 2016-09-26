<?php
	extract($_GET);
	$data = "No summary available.";
	if(isset($title))
	{
		$file = fopen("summaries.in", "r");
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
