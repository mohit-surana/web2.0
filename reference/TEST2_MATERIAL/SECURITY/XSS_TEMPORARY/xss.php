<!DOCTYPE html>
<?php
	// To set HTTP-only cookies. These cannot be accessed by the client 
	// by using document.cookie. This can provide a good 
	// defence against XSS threat. However the "TRACE" method still
	// remains a threat. "TRACE" was initially provided as a debugging tool.
	
	// In the TRACE method (a method similar to GET and POST), the server
	// merely echoes back whatever the client sends (including cookies).
	// So if a hacker can't read document.cookie, he can force a TRACE call
	// to the server. The http-only cookies will be sent to the server
	// because it is an HTTP call. The server echoes back the data
	// to the client. The hacker can then grab the cookie.
	// This is called XST or CROSS SITE TRACING threat.
	// To overcome this, browsers usually disable TRACE as an HTTP method.
	// Web servers can also be configured to reject TRACE requests.
	// Thus http-only cookies are a relatively safe way of writing 
	// cookies which contain important information.
	
	//The correct way is to use HTTP-ONLY cookies with SSL
	
	// Setting http-only cookies. See the last parameter set to TRUE
	// See the PHP documentation for details on other parameters.
	setcookie("mycookie","hello", time()+3600,NULL,NULL,NULL,TRUE);
	setcookie("impcookie","confidential", time()+3600,NULL,NULL,NULL,TRUE);
?>
<html>
<head>
<title>BENIGN PAGE</title>
</head>
<body>
<?php
	echo $_COOKIE['impcookie'] . "<br/>" . $_COOKIE['mycookie'];
	extract($_GET);
	echo "<a href='http://localhost/imaginary.pdf'>DOWNLOAD FILE HERE</a>";
	if(isset($usr))
	{
		echo "<h3>Thank you $usr</h3>";
	}
	else
	{
		echo "<h3>Thank you Guest</h3>";
	}
?>
</body>
</html>
