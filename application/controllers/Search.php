<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Cov_Controller {

    function __construct() {
           parent::__construct();
           $this->load->model('Search_model');

    }
	
    public function index(){
        $this->set('title', 'Search');
        $data['flag'] = FALSE;
        $data['msg'] = '';

        $user_id = $this->LOG_USER_ID;
        $selected_user_id = $this->session->userdata('co_selected_user_id');

        if($this->input->post()){
            $input = $this->input->post(NULL,TRUE);

            $login_id = $this->Search_model->getLoginId($input['mobile_no']);

            if($login_id) {
                    $this->Search_model->getUsers($login_id);
                    $this->session->set_userdata('co_selected_login_id',$login_id);
                    $this->redirect('','search/select_member');
            }
        }
        foreach ($data as $k => $v){
            $this->set($k,$v);
        }
        $this->setView();
    }
    

    function select_member() {
        $title = 'Member List';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);
        $user_id = $this->session->userdata('co_selected_login_id');
        $members = $this->Search_model->getUsers($user_id);
        $user_name = $this->Search_model->getUsernameById($user_id);
        $this->set('user_name',$user_name);
        $this->set('members',$members);
        $this->setView();
    }


    function member_options($user_id='') {
        $title = 'Member Option';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        if($user_id!=''){
            if($this->LOG_USER_TYPE == 0){
                    $login_id = $this->Search_model->getLoginIdFromUserID($user_id);
                    if($login_id!=$this->LOG_USER_ID){
                            die("Invalid");
                    }
            }
        } else {
                die("Invalid. Press Back");
        }

        $this->session->set_userdata('co_selected_user_id',$user_id);

        $title = 'Member Options';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);

        $member_details = $this->Search_model->getUserDetails($user_id);

        $this->set('member',$member_details);
        $this->set('user_id',$user_id);
        $this->setView();
    }

}
