<?php
	session_start();
	sleep(6);
	
	$_SESSION['myprop'] = "REQ1";
	echo $_SESSION['myprop'];
?>