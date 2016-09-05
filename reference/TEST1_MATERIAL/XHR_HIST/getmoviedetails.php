<?php
	extract($_GET);
	
	$retarr = array();
	switch($movie)
	{
		case "dead pool":
			$retarr["lead"]= "Ryan Reynolds";
			$retarr["year"]= "2016";
			$retarr["dir"]= "Tim Miller";
			break;
		
		case "Dead Poets' Society":
			$retarr["lead"]= "Robin Williams";
			$retarr["year"]= "1980";
			$retarr["dir"]= "Anonymous";
			break;
		
		case "Godfather":
			$retarr["lead"]= "Al pacino";
			$retarr["year"]= "1972";
			$retarr["dir"]= "???";
			break;
	}
	
	echo json_encode($retarr);
?>