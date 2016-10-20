<?php
	header("Content-type:application/json");

	$conn = mysqli_connect("localhost","root","");
	if (!$conn) {
		die("Could not connect to MySQL" . mysqli_connect_error());
		// die sends a message to the browser and exits the script
	}

	$db = mysqli_select_db($conn, "books");
	if(!$db)
	{
		$sql = 'CREATE DATABASE books';
		if (mysqli_query($conn, $sql))
		{
			echo "Database books created successfully\n";
			$db = mysqli_select_db($conn, "books");
		}
		else
		{
			echo 'Error creating database: ' . mysqli_error($conn) . "\n";
		}
	}

	$query = "CREATE TABLE IF NOT EXISTS `book_details` (
		`isbn` varchar(255) NOT NULL default '',
		`name` varchar(255) NOT NULL default '',
		PRIMARY KEY  (`isbn`)
	)";

	if(!$conn->query($query)){
	    die("Table creation failed: (" . $conn->errno . ") " . $conn->error);
	}

/*
	// Use this to insert data
	extract($_GET);
	$query = "INSERT INTO `book_details` VALUES('$isbn', '$bname')";
	$res = mysqli_query($conn, $query);
	echo json_encode($res);
*/

	extract($_GET);
	$query = "SELECT * FROM book_details WHERE isbn = '$isbn'";
	$res = mysqli_query($conn, $query);
	if(!$res)
	{
		die("Query execution failed" . mysqli_error($conn) . "\n");
	}
	$row = mysqli_fetch_array($res);
	echo json_encode($row);

	mysqli_close($conn);
?>
