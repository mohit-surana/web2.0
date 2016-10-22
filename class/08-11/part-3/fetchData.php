<?php
	header("Content-type:application/json");
	extract($_GET);
	$data = array('error' => 'Not found!');
	if(isset($title))
	{
		$file = fopen("movies.in", "r");
		while(!feof($file))
		{
			$line = trim(fgets($file));
			$info = explode(";", $line);
			if($info[0] == $title)
			{
				$data = array('title' => $info[0], 'lead' => $info[1], 'year' => $info[2], 'dir' => $info[3]);
				break;
			}
		}
		fclose($file);
	}
	echo json_encode($data);
?>
