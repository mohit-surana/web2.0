<?php
	header("Content-type:application/json");
	extract($_GET);
	$data = array('error' => 'Not found!');
	if(isset($isbn))
	{
		$file = fopen("books.in", "r");
		while(!feof($file))
		{
			$line = trim(fgets($file));
			$info = explode(";", $line);
			if($info[0] == $isbn)
			{
				$data = array('isbn' => $info[0], 'title' => $info[1], 'author' => $info[2], 'publisher' => $info[3], 'price' => $info[4]);
				break;
			}
		}
		fclose($file);
	}
	echo json_encode($data);
?>
