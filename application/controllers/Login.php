<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Cov_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login_model');

    }
    
    function index() {
        $title = 'Login';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", 'Login');

        $is_logged_in = $this->checkSession();
        
        if ($is_logged_in) {
            $this->redirect("", 'home', true);
        }
        
        $this->setView();
    }
        
    function verifylogin() {
        $path = '';

        $user_name = $this->input->post('username', TRUE);

        $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags|min_length[3]|max_length[30]|htmlentities|callback_check_charaters');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[5]|max_length[30]|callback_check_database');
        $login_res = $this->form_validation->run();
        
        if ($login_res) {
            $this->redirect("", "home", true);
        } else {
            $path = "login/index";
            $msg = 'Invalid User Details';
            $this->redirect("$msg", "$path", false);
        }
    }
    
    function check_database($password) {
        $flag = false;

        $login_details = $this->input->post(NULL, TRUE);
        $login_details = $this->stripTagsPostArray($login_details);

        $username = $login_details['username'];

        $login_result = $this->login_model->login($username, $password);
        
        if ($login_result) {          
            $this->login_model->setUserSessionDatas($login_result);
            $flag = true;
        } else {
            $flag = false;
        }
        return $flag;
    }

    function logout() {
        $user_name_encode = '';
        $user_type = '';

        if ($this->checkSession()) {
            $user_name = $this->LOG_USER_NAME;
            $user_id = $this->LOG_USER_ID;
            $user_type = $this->LOG_USER_TYPE;
        }
        
        foreach ($this->session->userdata as $key => $value) {
            if (strpos($key, 'co_') === 0) {
                $this->session->unset_userdata($key);
            }
        }

        $path = "login/index";

        $msg = $this->lang->line('successfully_logged_out');
        $this->redirect("$msg", $path, true);
    }

    public function questionnaire_web_view()
    {
        $user_id = $this->input->get('user_id');
        $access_token = $this->input->get('access_token');
        $this->load->model('Api_model');
        $loggedInDetails = $this->Api_model->getLoggedDetailsOnToken($access_token);
        if (!count($loggedInDetails)) {
            redirect(BASE_URL . "/login/questionnaire_fail");
        }
        $array = [
            "login_id" => $loggedInDetails['login_id'],
            "mobile_no" => $loggedInDetails['login_mobile'],
            "level_user_type" => $loggedInDetails['login_type'],
        ];
        $this->load->model('Login_model');
        $this->Login_model->setUserSessionDatas($array);
        redirect(BASE_URL . "/questionnaire?user_id=$user_id");
    }

    public function questionnaire_fail()
    {
        
    }

}