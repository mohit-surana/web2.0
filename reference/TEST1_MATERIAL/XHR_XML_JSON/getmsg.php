<?php
	//header("Content-type:text/xml");
	
	//echo "<employees><employee><id>001</id><name>Srikanth1</name></employee><employee><id>001</id><name>Srikanth2</name></employee></employees>";
	
	$retarr = array(array("id"=>"001", "name"=>"Srikanth1"), array("id"=>"002", "name"=>"Srikanth2"));
	
	$retobj = json_encode($retarr);
	
	echo $retobj;

?>