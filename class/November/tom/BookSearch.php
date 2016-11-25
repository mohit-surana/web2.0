<?php
	class BookSearch extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this -> load -> model('bookmodel');
		}

		// client will send a parameter from textbox
		public function fetchbooks()
		{
			// to read input, do this:
			$isbn = $this -> input -> get('isbn');	// in case of POST, do input -> POST
			
			// call the Model to get the data (model name case insensitive)
			$data['bookresult'] = $this -> bookmodel -> getbooks($isbn);

			// send data array as a parameter to showresults.php
			$this -> load -> view('showresults', $data);
		}
	}
?>
