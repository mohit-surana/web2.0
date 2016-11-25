<?php
	class Mymsg extends CI_Controller
	{
		public function greet($user)
		{
			//The controller's job is to PUSH data to the view
			$this->load->view('GreetView');
		}
	}
?>