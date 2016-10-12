<?php
	/*
	header("Content-type:application/json");

	echo json_encode($result);
	*/

	$conn = mysqli_connect("localhost","root","");
	if (!$conn) {
		die("Could not connect to MySQL" . mysqli_connect_error());
		// die sends a message to the browser and exits the script
	}

	$db = mysqli_select_db($conn, "students");
	if(!$db)
	{
		$sql = 'CREATE DATABASE students';
		if (mysqli_query($conn, $sql))
		{
			echo "Database my_db created successfully\n";
		}
		else
		{
			echo 'Error creating database: ' . mysqli_error($conn) . "\n";
		}
	}

	$query = "CREATE TABLE IF NOT EXISTS `student_details` (
		`usn` varchar(255) NOT NULL default '',
		`name` varchar(255) NOT NULL default '',
		`dept` varchar(255) NOT NULL default '',
		`grade` decimal(5, 3),
	    PRIMARY KEY  (`USN`)
	)";
	// Reference for the DECIMAL data type
	// http://stackoverflow.com/questions/6999582/how-to-insert-decimal-into-mysql-database

	if(!$conn->query($query)){
	    die("Table creation failed: (" . $conn->errno . ") " . $conn->error);
	}

	$method = $_SERVER['REQUEST_METHOD'];

	if($method == 'POST')
	{
		// Create
		$str = file_get_contents("php://input");
		parse_str($str, $post_vars);
		extract($post_vars);
		$grade = (float) $grade;
		$query = "INSERT INTO `student_details` VALUES('$usn', '$sname', '$dept', $grade)";
		$res = mysqli_query($conn, $query);
		echo json_encode($res);
	}
	else if($method == 'GET')
	{
		// Read
		extract($_GET);
		$query = "SELECT * FROM student_details WHERE usn = '$usn'";
		$res = mysqli_query($conn, $query);
		if(!$res)
		{
			die("Query execution failed" . mysqli_error($conn) . "\n");
		}
		$row = mysqli_fetch_array($res);
		echo json_encode($row);
	}
	else if($method == 'PUT')
	{
		// Update
		$str = file_get_contents("php://input");
		parse_str($str, $put_vars);
		extract($put_vars);
		$grade = (float) $grade;
		$query = "UPDATE `student_details` SET name = '$sname', dept = '$dept', grade = $grade WHERE usn = '$usn'";
		$res = mysqli_query($conn, $query);
		echo json_encode($res);
	}
	else if($method == 'DELETE')
	{
		// Delete
		extract($_GET);
		$query = "DELETE FROM `student_details` WHERE usn = '$usn'";
		$res = mysqli_query($conn, $query);
		echo json_encode($res);
	}
	mysqli_close($conn);
?>
