<?php
	header("Content-type:text/html");
	extract($_POST);

	$file = fopen("seats.in", "r");
	$line = trim(fgets($file));
	fclose($file);

	$index = ((int)$college) * 2 + ((int)$dept);
	$seats = explode(";", $line);
	$seat_reserved = 0;
	if($seats[$index] > 0)
	{
		$seat_reserved = 1;
		$seats[$index] -= 1;
	}
	$line = implode(";", $seats);

	$file = fopen("seats.in", "w");
	fputs($file, $line);
	fclose($file);

	echo "<script>parent.selectionResult(" . $seat_reserved . ");</script>";
?>
