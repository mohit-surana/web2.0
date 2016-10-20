<?php
	extract($_POST);
	
	if($msg)
	{
		echo "$msg";
		//You actually need to save it to a datastore (db or file)
	}
	else
	{
		echo "";
	}
?>