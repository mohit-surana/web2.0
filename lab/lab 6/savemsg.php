<?php
	extract($_POST);

	if(isset($msg) && isset($username))
	{
		$temp = "$username;$msg";
		$file = file_put_contents('chat-history.txt', $temp.PHP_EOL , FILE_APPEND | LOCK_EX);
		echo "success";
	}
	else
	{
		echo "failure";
	}
?>
