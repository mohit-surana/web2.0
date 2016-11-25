<?php
	class BookModel extends CI_Model
	{
		public function __construct()
		{
			//Default database is configured in the "database.php"
			// in the "config" folder.
			$this->load->database();
		}
		
		public function getbooks($isbn)
		{
			$query_res = $this->db->get_where('BOOKS',array('ISBN'=>$isbn));
			return $query_res->result_array();	
		}	
	}

?>