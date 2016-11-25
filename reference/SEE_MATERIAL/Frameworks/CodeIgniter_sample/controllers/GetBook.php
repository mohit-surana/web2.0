<?php
	class GetBook extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			
			session_start();
			//Load the Model here
			$this->load->model('BookModel');
			
		}
	
		public function index()
		{
			$isbn = $this->input->post('isbn');
			$capt = $this->input->post('capt');
			
			$this->form_validation->set_rules('isbn',"ISBN NUMBER", 'required');
			//Validate
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('Failure');
			}
			
			else
			{
				//Check the CAPTCHA
				if(strcasecmp($capt, $_SESSION['captcha_word'])==0)
				{
					echo $capt;
					$ret['books'] = $this->BookModel->getbooks($isbn);
					//Launch the view to see the results
					
					$this->load->view('ShowBooks',$ret);
				}
				else
				{
					echo "Are you a machine??";
				}
			}
		}
	}



?>