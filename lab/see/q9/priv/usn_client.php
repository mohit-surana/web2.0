<?php
	// This will act as a client to the Web Service
	// This script is invoked from the browser (who is my client)

	// The agreement between my clients and me (this script)
	// need not match the agreement between me and the Web Service

	// The web service needs me to make a "PUT" request
	// But I can ask my clients to invoke me with a GET or a POST

	extract($_GET);
	// Sample URL could be http://localhost/priv/usn_client.php?usn=98&grd=9.9

	$data_arr = array("usn" => $usn, "grd" => $grd);

	// Build the query string
	$data = http_build_query($data_arr);

	// Build the header fields
	$header = array("Content-type:application/x-www-form-urlencoded");

	// Build the request object
	$req = array(
		"http"=>array(
			"method"=>"PUT",
			"header"=>$header,
			"content"=>$data,
		)
	);

	// One more step before we actually fire the request

	$context = stream_context_create($req);

	// Refer php manual
	// file_get_contents(url, flag, context)
	$retval = file_get_contents("http://localhost/priv/updt", false, $context);
	// Change to 127.0.0.1 if necessary
	echo $retval;
?>
