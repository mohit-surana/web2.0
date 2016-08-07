<?php
	header("Content-type:text/html");
	extract($_GET);
	// extract($_POST);
	
	$used = 0;
	$usernames = ["doodh", "doodhwala", "doodhwa!a", "mohit", "pavan"];
	foreach ($usernames as $index => $username)
	{
		if($username == $user)
		{
			$used = 1;
			break;
		}
	}
	echo '<html><head><script>parent.usernameResponse( "' . $user . '", ' . $used . ')</script></head></html>';
?>
