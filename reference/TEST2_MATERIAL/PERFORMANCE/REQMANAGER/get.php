<?php
	echo "got";
	foreach($_SERVER as $key=>$value)
	{
		echo "<h3>$key...........$value</h3>";
	}
?>