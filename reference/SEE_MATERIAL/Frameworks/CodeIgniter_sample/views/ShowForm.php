<?php
	session_start();
	
	$vals = array(
		'img_path' => './captcha/',
		'img_url'  => 'http://localhost/CI/captcha/',
		'img_width' => 200,
		'img_height' => 100
	);

	$cap = create_captcha($vals);
	
	echo $cap['image'];
	echo "<br/>";
	echo $cap['word'];
	$_SESSION['captcha_word'] = $cap['word'];
	
	//We have the "form" helper loaded. We will use it to generate ALL markup
	// related to forms
	echo form_open('http://localhost/CI/index.php/GetBook');
	echo form_label('ISBN');
	echo form_input(array('type'=>'text', 'id'=>'isbn', 'name'=>'isbn'));
	echo "<br/>";
	echo form_label('CAPTCHA');
	echo form_input(array('type'=>'text', 'id'=>'capt', 'name'=>'capt'));
	echo "<br/>";
	echo form_submit(array('value'=>'GET BOOK'));
	echo form_close();

?>