<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Book Search</title>
	</head>
	<body>
		<?php
			/* You can use plain markup if you want.
			 * We will use the helper class here.
			*/

			// form_open - takes one or two parameter
			// if only one is given, it must be the `action'
			echo form_open('http://localhost/CI/index.php/BookSearch/fetchbooks', array('method' => 'GET'));
			echo form_label('ISBN');
			echo form_input(array('type' => 'text', 'name' => 'isbn'));
			echo "<br />";
			echo form_submit(array('value' => 'Get Book'));
			echo form_close();
		?>
	</body>
</html>
