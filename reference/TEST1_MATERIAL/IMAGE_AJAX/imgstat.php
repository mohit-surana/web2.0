<?php
	header("Content-type:image/jpeg");
	
	//header("Location:hf.jpg");
	
	//Now process the request
	extract($_GET);
	
	if($uid == "USER1" || $uid == "USER2")
	{
		$img = imagecreate(1,1);
	}
	else
	{
		$img = imagecreate(2,1);
	}
	
	imagecolorallocate($img, 200,100,200);
	
	//This call will generate an image and send it to client
	imagejpeg($img);
	
	
?>