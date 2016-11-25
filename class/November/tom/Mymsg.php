<?php
	class Mymsg extends CI_Controller
	{
		// constructor function
		public function __construct()
		{
			// invoke the parent's constructor
			parent::__construct();
		}

		// by default looks for the index function
		public function greet($user='Guest')
		{
			//echo "<h2>Welcome to My Message controller!</h2>";	// check

			// filename of view = greetview.php
			$this -> load -> view('greetview');
		}
	}
?>
