<?php

	// This header MUST be set to let the browser know
	// what kind of compression has been used by the server.
	// The browser can then decompress accordingly.
	// You can also use header("Content-Encoding:gzip");
	// Then line 42 becomes gzencode($datastring,9);
	header("Content-Encoding:deflate");
	$headers = array();
	
	// The important thing for the server is to know
	// what kind of data the browser can decompress.
	// The browser therefore sends some header fields
	// to help the server. The most important among these
	// is "ACCEPT-ENCODING" which usually has the value "gzip,deflate".
	// The server can read this header and then decide
	// what kind of compression to employ.
	
	// The $_SERVER has header fields slightly modified.
	// If browser sent the header as "Accept-Encoding",
	// the $_SERVER will have it under the name "HTTP_ACCEPT_ENCODING".
	// Similarly "Accept" is "HTTP_ACCEPT". 
    // So we create a useful array for ourselves by stripping the HTTP_
    // wherever we find it.	
	foreach($_SERVER as $key=>$value)
	{
		if(strncmp($key,"HTTP_",5)==0)
		{
			$temp = str_replace("HTTP_",'',$key);
			$headers[$temp] = $value;
		}
	}
	
	// $headers now has good header field names. You can echo its contents 
	// and check out
	
	//Read a large file to compress it.
	$file = fopen("data.txt","r");
	$datastring = fread($file, filesize("data.txt"));
	
	//zip the contents before sending. 9 is max compression.
	$output = gzdeflate($datastring,9);
	
	echo $output;
?>