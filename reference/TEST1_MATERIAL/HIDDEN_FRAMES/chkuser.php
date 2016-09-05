<!DOCTYPE html>
<html>
<head><title></title><script type="text/javascript">
<?php
	//header("Content-type:text/plain");
	
	extract($_GET);
	
	if($uid == "USER1" || $uid == "USER2" || $uid == "USER3")
	{
		echo "parent.setStat('$uid;User already taken');";
	}
	else
	{
		echo "parent.setStat('$uid;User available');";
	}

?>
</script>
</head>
<body></body></html>