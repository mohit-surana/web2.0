<?php
	header("Content-type:application/json");
	extract($_GET);
	echo "alert(sup);";
	if(isset($prop1))
	{
		echo $prop1;
	}
	/*
		$ret = array();
		$ret[] = "Hi";
		$ret[] = " there!";
		echo json_encode($ret);
	*/

	// echo "<root><first>Hi</first></root>";
?>
