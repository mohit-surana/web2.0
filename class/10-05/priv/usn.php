<?php
	// Not handling xml
	header("Content-type:application/json");

	if($_SERVER["REQUEST_METHOD"] == 'GET')
	{
		// Test using http://localhost/priv/get/usn/92.json
		extract($_GET);
		print_r($_GET);
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
	}

	elseif ($_SERVER["REQUEST_METHOD"] == 'PUT')
	{
		// For PUT and DELETE, php does not allow extract
		// Only option is to read from the stream that came in
		$data = file_get_contents("php://input"); // Use only for PUT and DELETE - nothing happens for GET
		$data_arr = explode("&", $data);

		$usn = explode("=", $data_arr[0])[1];
		$grd = explode("=", $data_arr[1])[1];
		$str = $usn . ":" . $grd;

		// This is trivial. Need to actually update the database!
		$file = fopen("usn.txt", "w");
		fwrite($file, $str);

		$retarr = array();
		$retarr["status"] = 200;
		$retarr["message"] = "Successfully saved";
		$retarr["data"] = null;
		echo json_encode($retarr);
	}


?>
