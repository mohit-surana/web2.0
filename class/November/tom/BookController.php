<?php
	class BookController extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			// call a helper class form which helps us render form easily (don't need to write the markup)
			$this -> load -> helper('form');
		}

		public function index()
		{
			$this -> load -> view('BookView');
		}
	}
?>
