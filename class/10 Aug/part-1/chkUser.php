<?php
	// If you already have those images ready, use location() so that you force a redirect to the required images

	// Or create an image on the fly
	// phpinfo();
	// Need to configure so that gd (graphics display) is visible via phpinfo()
	// Details in 10 Aug.txt

	header("Content-type:image/png");
	extract($_GET);
	$used = 0;
	$usernames = ["doodh", "doodhwala", "doodhwa!a", "mohit", "pavan"];
	foreach ($usernames as $index => $username)
	{
		if($username == $user)
		{
			$used = 1;
			break;
		}
	}

	/*
	$img = imagecreate(200, 200); // ** width, height
	imagecolorallocate($img, 200, 150, 240); // fill image with colour
	imagepng($img); // equivalent of echo
	imagedestroy($img); // To deallocate the $img
	*/

	$img = 0;
	if($used) // width should be 2
	{
		$img = imagecreate(2, 1);
	}
	else
	{
		$img = imagecreate(1, 1);
	}
	imagecolorallocate($img, 0, 128, 255);
	imagepng($img);
	imagedestroy($img);
?>
