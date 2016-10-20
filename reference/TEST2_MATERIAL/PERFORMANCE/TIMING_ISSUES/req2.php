<?php
	session_start();

	$_SESSION['myprop'] = "REQ2";
	echo $_SESSION['myprop'];
?>