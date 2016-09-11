<?php
	extract($_GET);
	header("Content-type:text/xml");
	header("Access-Control-Allow-Origin:*");
	header("Access-Control-Allow-Methods:GET,PUT");
	$retarr = array();
	//echo "alert('hello');"
	if($movie=="Castaway")
	{
		$retarr['actor'] = "Tom Hanks";
		$retarr['actr'] = "bla bla";
		$retarr['director'] = "Robert Z";
		
	}
	if($movie == "Interstellar")
	{
		$retarr['actor'] = "Matthew McConnell";
		$retarr['actr'] = "2005";
		$retarr['director'] = "Ashutosh Gowarikar";
	}
	$movie = "<movie><title>Swadesh</title><lead>SRK</lead><actr>preity zinta</actr><director>AG</director></movie>";
	// $retstr = json_encode($retarr);
	// echo $retstr;
	echo $movie;
?>	