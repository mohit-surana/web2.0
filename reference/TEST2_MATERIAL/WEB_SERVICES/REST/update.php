<?php
	if($_SERVER['REQUEST_METHOD'] == "PUT")
	{
		//Unfortunately no $_PUT or $_DELETE (for obvious reasons)
		// PHP and the Browsers have dutifully obeyed W3C's restriction
		// on PUT and DELETE requests
		
		// So whats the alternative???
		$params = file_get_contents("php://input");

		//Get the grades and the USN
		$data_arr = explode("&",$params);
		
		$usnarr = explode("=",$data_arr[0]);
		$usn = $usnarr[1];
		$grdarr = explode("=",$data_arr[1]);
		$grd = $grdarr[1];
		
		//Blindly write into a file for now
		$file = fopen("usn.txt", "w");
		fwrite($file, $usn . ":" . $grd);
		fclose($file);

		//Send the JSON...
		$retarr = array("status"=>"200", "message"=>"success", "data"=>null);
		
		echo json_encode($retarr);
	}

?>