<?php
	class bookmodel extends CI_Model
	{
		public function __construct()
		{
			$this -> load -> database();
		}

		public function getbooks($isbn)
		{
			// equivalent to: SELECT * FROM BOOKS
			//$query_res = $this -> db -> get('BOOKS');
			$query_res = $this -> db -> get_where('BOOKS', array('ISBN' => $isbn));

			// convert to an array and send
			return $query_res -> result_array();
		}
	}
?>
