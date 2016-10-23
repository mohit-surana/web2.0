<?php
	extract($_GET);
	if(!isset($user))
	{
		$user = "Guest";
	}
	echo "<h2>Welcome $user</h2>";
	echo "<div>Please download <a href=\"abc.pdf\">HERE</a></div>";

/*
	Chrome:
		Blocks :D
		The XSS Auditor refused to execute a script in 'http://localhost/web2.0/hack.php?user=%3Cscript%20type=%27text/javascript%27%3Ealert(%27hi%27);%3C/script%3E' because its source code was found within the request. The auditor was enabled as the server sent neither an 'X-XSS-Protection' nor 'Content-Security-Policy' header.

	Firefox:
		Allows :'(
*/
?>
