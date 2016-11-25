<!DOCTYPE html>
<html>
<head><title>BOOK SEARCH</title></head>
<body>
<?php
	echo form_open('http://localhost/CI/index.php/BSController', array('method'=>'GET'));
	echo form_label('ISBN');
	echo form_input(array('type'=>'text', 'id'=>'isbn', 'name'=>'isbn'));
	echo "<br/>";
	echo form_submit(array('value'=>'GET BOOK'));
	echo form_close();
?>
</body>
</html>