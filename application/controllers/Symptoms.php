<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Symptoms extends Cov_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct() {
        	parent::__construct();
		$this->load->model('Symptoms_model');

    	}
//	public function index()
//	{
//		$this->session->unset_userdata('logged_in');
//		$this->session->unset_userdata('id');
//		print_r($this->session->userdata());die;
//		$this->load->view('welcome_message');
//	}

    public function add_symptoms() {
        $title = 'Syptoms';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $user_id = $this->session->userdata('co_selected_user_id');
        $data['flag'] = FALSE;
        $data['msg'] = '';
//            echo '<pre>';print_r($data['symptoms']);die; 
        if ($this->input->post()) {
            $post = $this->input->post(NULL, TRUE);
            $post['user_id'] = $user_id;
            $post['date'] = date('Y-m-d H:i:s');
            $flag = $this->Symptoms_model->addUserSymptoms($post);
            //$flag = TRUE;
            if ($flag) {
                $data['flag'] = TRUE;
                $data['msg'] = 'SYMPTOMS UPDATED SUCESSFULLY';
            } else {
                $data['flag'] = FALSE;
                $data['msg'] = 'FAILED TO UPDATE SYMPTOMPS';
            }
        }

        $data['symptoms'] = $this->Symptoms_model->getAllSymptoms($user_id);
        foreach ($data as $k => $v){
            $this->set($k,$v);
        }
        $this->setView();
    }

}