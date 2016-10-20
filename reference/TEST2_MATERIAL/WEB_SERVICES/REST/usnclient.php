<?php
	//Web Service client. This will invoke the Web Service.
	// This itself is fired by a browser (through a page)
	
	//Normally the client (browser) makes a request to THIS page
	// through a PUT or a POST (because thats what the Web Service is asking for)
	// This file will extract the contents and create a NEW http request to
	// call the Web Service.
	
	//But for this exercise, we will assume the client used "GET"
	//(It avoids writing client side html/js code)
	
	extract($_GET);
	
	//Build the Query String for the HTTP request we are about to make
	//We need a lot of arrays :)
	
	$data = array("usn"=>$usn, "grd"=>$grd);
	$datatosend  = http_build_query($data); //BUild the query string
	
	//The header fields. There could be multiple. Separated each string from the
	// next by a comma
	
	$header = array("Content-type:application/x-www-form-urlencoded");
	
	//Create the request
	$request = array('http'=>array('method'=>"PUT", 'header'=>$header, 'content'=>$datatosend));
	
	// Create a "context". This is PHP specific
	$context = stream_context_create($request);
	
	//Fire the http request on the Web Service
	$retval = file_get_contents("http://127.0.0.1/CONF/update/usn.json",FALSE, $context);
	
	
	echo $retval;
	
?>