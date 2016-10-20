<?php
	extract($_GET); 
	echo "<a href='http://localhost/abc.pdf'>DOWNLOAD HERE</a><br/>";
	if(isset($usr))
	{
		// Again a devastating mistake by the server. 
		// Merely checking whether the input parameter is empty or not
		// is no good. The $usr variable must be sanitised.
		
		// Otherwise the value is blindly sent back to the client.
		// If this is a script, then it will be delivered to the client
		// and will execute on his window, which is what is exploited 
		// by the hacker (see evilmind.html)
		echo "Thank you!! $usr!!!";
	}
	else
	{
		echo "Thank you!! Guest!!!";
	}
?>