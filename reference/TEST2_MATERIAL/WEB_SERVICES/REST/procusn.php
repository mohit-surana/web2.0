<?php
	extract($_GET);
	
	if($method == "get")
	{
		if($usn == "99")
		{
			if($type == "xml")
			{
				header("Content-type:text/xml");
				echo "<stud><usn>99</usn><name>STUDENT99</name></stud>";
			}
			else
			{
				header("Content-type:text/json");
				$studarr = array(4,5,6);
				$studarr["usn"] = "99";
				$studarr["name"] = "STUDENT99";
				
				echo json_encode($studarr);
			}
		}
	}


?>