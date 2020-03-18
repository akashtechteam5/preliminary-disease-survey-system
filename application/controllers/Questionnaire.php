<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Questionnaire extends Cov_Controller {

	 function __construct() {
        	parent::__construct();
        	$this->load->model('Questionnaire_model');

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
	
	public function index(){
                $title = 'Questionnaire';
                $this->set('title', $title);
		$questions = $this->Questionnaire_model->getAllQuestions();

		$user_id = $this->LOG_USER_ID;
		$selected_user_id = $this->session->userdata('co_selected_user_id');
		if(!$selected_user_id)
			$selected_user_id = $this->input->get('user_id');
		$member_details = $this->Search_model->getUserDetails($selected_user_id);

        $this->set('member',$member_details);

        $answers = $this->Questionnaire_model->getAnswers($selected_user_id);

		if($this->input->post()){
			$input = $this->input->post(NULL,TRUE);

			foreach($questions as $q){
				if($q['type'] == "radio"){
					$key= "question_".$q['id'];
					if($input[$key] == ''){
						$this->redirect('Answer all questions','questionnaire/index',FALSE);
					}
				} else if($q['type'] == "checkbox") {
					$key= "question_".$q['id'];
					if($input[$key] == ''||$input[$key] == array()){
						$this->redirect('Answer all questions','questionnaire/index',FALSE);
					}
				}
			}
			

			$this->Questionnaire_model->insertAnswers($input,$user_id,$selected_user_id);
			$this->redirect('Success','questionnaire/index',TRUE);
		}
		if($answers != array()){
		$this->set('ans',$answers[0]);
		}	
		$this->set('questions',$questions);
		$this->set('selected_user_name',$selected_user_id);
		$this->set('user_name',$user_id);
		$this->setView();
	}

}
