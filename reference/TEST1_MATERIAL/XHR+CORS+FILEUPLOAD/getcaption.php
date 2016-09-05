<?php
	header("Content-type:text/plain");
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT");
	echo "This is a Koala bear";
	
	//Please refer classnotes on how Access-control headers work.
	// In a nutshell, the Access-Control-Allow-Origin specifies whether a
	// particular domain is allowed access or not.
	// The Access-Control-Allow-Methods specifies whether a particular METHOD
	// is allowed or not (even if the domain is allowed, some request methods
	// may NOT be allowed

?>