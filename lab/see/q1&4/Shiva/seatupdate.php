<?php
	extract($_GET);
	
	if(!isset($coll) || !isset($dept))
		die("Parameters not set!");
	
	$file = fopen("seats.txt", "r") or die("fopen() failed!");
	$seats = explode(';', fread($file, filesize("seats.txt")));
	fclose($file);
	
	print_r($seats);
	
	if($coll == 'PESIT'){
		if($dept == 'CSE' && $seats[0] > 0){
			$seats[0] -= 1;
		}
		else if($seats[1] > 0){
			$seats[1] -= 1;
		}
	}
	
	else if($coll == 'RVCE')
	{
		if($dept == 'CSE' && $seats[2] > 0)
		{
			$seats[2] -= 1;
		}
		else if($seats[3] > 0)
		{
			$seats[3] -= 1;
		}
	}

	$res = implode(";", $seats);
	$file = fopen("seats.txt", "w");
	fwrite($file, $res) or die("fwrite() failed!");
	fclose($file);
?>
