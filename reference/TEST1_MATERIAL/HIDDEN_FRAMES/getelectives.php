<!DOCTYPE html>
<html>
<head>
<title>AJAX RESPONSE</title>
<script type="text/javascript">
<?php
	extract($_GET);

	$file = fopen("electives.txt","r");
	while($line = fgets($file))
	{
		$modline = trim($line);
		
		$arr = explode(";",$modline);
		$found = false;
		if($dept == $arr[0])
		{
			$found = true;
			break;
		}
	}
	
	if($found == true)
	{
	
		echo "parent.obj.populateElectives('$modline');";
	}
?>
</script>
</head>
<body>
</body>
</html>