<?php
	// Not handling xml
	header("Content-type:application/json");
	extract($_GET);
	$result = array();
	if($usn == 92)
	{
		$result["usn"] = "1PI13CS092";
		$result["name"] = "Mohit Surana";
		$result["username"] = "doodhwala";
	}
	else
	{
		$result["error"] = "Not found bro!";
	}
	echo json_encode($result);

	// Test using http://localhost/priv/get/usn/92.json
?>
