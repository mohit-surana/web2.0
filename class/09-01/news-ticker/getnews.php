<?php
	header("Content-type:text/xml");

	// Here we can get using any URL ## Cross check
	$data = file_get_contents("ajax.xml");
	echo $data;
?>
