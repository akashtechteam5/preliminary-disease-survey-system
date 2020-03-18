<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

	 function __construct() {
        	parent::__construct();
        	$this->load->model('Add_model');

    	}

	public function add_custom_info()
	{
		if($this->input->post()){
			$input = $this->input->post(NULL,TRUE);
		}
		
		$this->load->view('add_custom_info');	
	}
	
	public function forge_column()
	{
			$this->Add_model->check_forge();
	}
}