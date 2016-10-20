<?php
	extract($_GET);
	
	//Checking whether $grd is set is well and good. But this is not
	// of much use because the field will come anyway, due to the client
	// side markup. Even if the user leaves it empty, the parameter
	// will arrive, albeit having an empty string as value.
	// So in reality, the next 4 lines are needless.
	if(!isset($grd))
	{
		die("I was expecting a grade to be input");
	}
	
	//There was a grade.
	//Let us search. If there are no matching rows, we will
	// dump a "No results" output
	// This is the crux of all problem. The server is not
	// sanitizing input. It is straightaway sending it to the
	// query. This is what the hacker exploits.
	// The hacker always tries wrong inputs and looks at the output
	// to guess what might be going on at the server end.
	// In this case, he will get a lot of information 
	// from the error string sent by the server (see further down)
	
	// In the current query, if the user sends the following string
	// as value, then the entire table is dumped. You should be
	// especially careful when running queries in privileged mode.
	// Because in privileged mode, complete tables can be dropped.
	
	// uservalue: 9.8' or 2=2;# (note the lone single quote character)
	// This sets the query as: 
	// "SELECT * FROM STUDENT WHERE GRADE='9.8' or 2=2;#';";
	// As you can see, everything starting from the # character 
	// is treated as comments. So the query effectively becomes
	// "SELECT * FROM STUDENT WHERE GRADE='9.8' or 2=2;"
	// This is a perfectly legitimate query and dumps the table because
	// of the 2=2 condition.
	
	// However there is a bigger danger. The hacker can first try to find
	// out which user is running the queries by using..
	// Input from hacker: 9.4' and 2=1 UNION SELECT user(),null,null,null
	// (because a normal query with just 9.4 as input returned 4 columns).
	// This would send back "root" as the reply and the hacker now knows
	// that he can execute any query on the database. He can get the names
	// of all tables by querying the meta db INFORMATION_SCHEMA. He can
	// then get all passwords, credit card numbers etc and wreak havoc.
	$query = "SELECT * FROM STUDENT WHERE GRADE='$grd';";
	
	//Open a database connection
	$conn = mysql_connect('127.0.0.1','root','root');
	if(!$conn)
	{	
		die("Could not connect to database server");
	}
	
	//Else, we have connected. We select the "test" database
	$db = mysql_select_db('test');
	if(!$db)
	{
		die("Could not select database");
	}
	
	//We are ready now. Execute the query
	$results = mysql_query($query);
	if(!$results)
	{
		// If an error resulted in query execution (which is 
		// very likely because the server is not sanitizing the input),
		// the server dumps back the error string. This gives away
		// two crucial pieces of information to the front end user.
		// The first is that the server is blindly sending the input
		// string into the query. The second is even more telling. That
		// is the fact that the database being used is MYSQL.
		// This is how the hacker finds out that "#" can be used as an 
		// input because # is a comment in MYSQL.
		
		// NEVER GIVE OUT PIN-POINT ERRORS TO THE CLIENT.
		// BE AS VAGUE AS YOU CAN. SANITISE ALL INPUT. IF ANY INPUT
		// IS EVEN SLIGHTLY DIFFERENT FROM WHAT YOU EXPECT, REJECT IT.
		// BE VERY CAREFUL IF YOU ARE RUNNING QUERIES IN PRIVILEGED
		// MODE (a mode where you can remove tables or even cleanup
		// databases)
		die("Problem in querying.." . mysql_error());
	}
	
	//We have the data
	//We probably have more than one row. We need to fetch one
	// row at a time
	$found = false;
	while($row = mysql_fetch_array($results,MYSQL_ASSOC))
	{
		$found = true;
		echo "<ol>";
		foreach($row as $key=>$value)
		{
			echo "<li>";
			echo "$key----------------$value";
			echo "</li>";
		}
		echo "</ol>";
	}
	if(!$found)
	{
		echo '<h2>NO RESULTS..SORRY :( </h2>';
	}
	
?>