<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Cov_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->checkSession()){
            $this->redirect('','login',false);
        }
        $this->load->model('Home_model');
        $this->load->model('Common_model');
    }
    
    function index() {
        $title = 'Home';
        $this->set("title", $this->PROJECT_NAME . " | $title");
//        $this->set("main_heading", $title);
//        $members = $this->Home_model->getMembersListByReg($this->LOG_USER_ID);
        $total_users_count = $this->Home_model->getTotalUsersCount();
        $today_users_count = $this->Home_model->getTodaysUsersCount();
        $yellow_users = $this->Home_model->yellowUsersCount();
        $red_users = $this->Home_model->redUsersCount();
        $this->set('total_users_count',$total_users_count);
        $this->set('today_users_count',$today_users_count);
        $this->set('yellow_users',$yellow_users);
        $this->set('red_users',$red_users);
        $this->setView();
    }
    
    function registered_users() {
        $title = 'Home';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);
        $members = $this->Home_model->getMembersListByReg($this->LOG_USER_ID);
        $this->set('members',$members);
        $this->setView();
    }
    
    function list_users($user_name = ''){
        $title = 'Home';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);
        $user_id = $this->Home_model->getUserId($user_name);
        if(!$user_id){
            $this->redirect('member not found', 'home/index', false);
        }
        
        $members = $this->Home_model->getMembers($user_id);
        
        $this->set('members',$members);
        $this->set('user_name',$user_name);
        $this->setView();
    }
    
    function add_member($user_name = ''){
        $title = 'Add Member';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);
        
        $states = $this->Common_model->getStates();
        $validation_failed = false;
        $is_logged = $this->LOG_USER_ID;
        
        $add_user_id = $this->Home_model->getUserId($user_name);
        if(!$add_user_id){
            $this->redirect('member not found', 'home/index', false);
        }
        
        if ($this->input->post('submit')) {
            $post_array = $this->security->xss_clean($this->input->post());
            
            if ($this->validate_member_register()) {

                $post_array['registered_by'] = $this->LOG_USER_ID;
                $add_user_id = $this->Home_model->getUserId($post_array['add_user_name']);
                $post_array['login_id'] = $add_user_id ?? $this->LOG_USER_ID;
                $res = $this->Home_model->registerMember($post_array);
                if ($res) {
                    $this->redirect('Member registration success', 'home', TRUE);
                } else {
                    $this->redirect('Member registration failed', 'home/add_member', FALSE);
                }
            } else {

                $districts = $this->getDistricts($post_array['state'],
                        $post_array['district']);
                $panchayaths = $this->getPanchayaths($post_array['district'],
                        $post_array['panchayat']);
                $chcs = $this->getChcs($post_array['panchayat'],
                        $post_array['district'],
                        $post_array['chc']);
                $validation_failed = true;
                
                $this->set('districts', $districts);
                $this->set('panchayaths', $panchayaths);
                $this->set('chcs', $chcs);
            }
        }
        
        $this->set('validation_failed',$validation_failed);
        $this->set('is_logged',$is_logged);
        $this->set('states',$states);
        $this->set('user_name',$user_name);
        $this->set('vulnerability', $this->Common_model->getVulnerabilityInfo());
        $this->setView();
    }
    
    function validate_member_register(){
        $this->form_validation->set_rules('vulnerability_status', 'Vulnerability Status', 'trim|required|in_list[yes,no]|callback_validate_vulnerablity', ['in_list' => 'Vulnerability Status is required']);
          
        $this->form_validation->set_rules('name',
                'Name',
                'required');
        $this->form_validation->set_rules('age',
                'Age',
                'required|integer');
        $this->form_validation->set_rules('gender',
                'Gender',
                'required|callback_gender_check');
        $this->form_validation->set_rules('state',
                'State',
                'required');
        $this->form_validation->set_rules('district',
                'District',
                'required');
        $this->form_validation->set_rules('panchayat',
                'Panchayat/Block',
                'required');
        if($this->LOG_USER_ID){
            $this->form_validation->set_rules('chc',
                'CHC',
                'required');
        }
        $this->form_validation->set_rules('address',
                'Address',
                'required');
        $this->form_validation->set_rules('mobile_number_1',
                'Alternate Contact 1',
                'callback_valid_number');
        $this->form_validation->set_rules('mobile_number_2',
                'Alternate Contact 2',
                'callback_valid_number');
        $this->form_validation->set_rules('mobile_number_3',
                'Alternate Contact 3',
                'callback_valid_number');
        $res = $this->form_validation->run();
        return $res;

    }
    
    function validate_vulnerablity($str_in = ''){
        if($str_in == "yes"){
            $vulnerablity = $this->Common_model->getVulnerabilityId();
            foreach($vulnerablity as $row){
                if(array_key_exists($row, $_POST)){
                    return TRUE;
                }
            }
            $this->form_validation->set_message('validate_vulnerablity', 'Vulnerablity State not Mentioned');
            return FALSE;
        }
        return true;
    }
    
    function valid_number($number) {
        if ($number) {
            if (strlen($number) != 10) {
                $this->form_validation->set_message('valid_number',
                        'Alternate contact must have 10 digits');
                return FALSE;
            }
            if (!preg_match('/^\d+$/',
                            $number)) {
                $this->form_validation->set_message('valid_number',
                        'Alphabets are not allowed');
                return FALSE;
            }
        }
        return TRUE;
    }

    function gender_check($gender) {
        if ($gender != 'other' && $gender != 'female' && $gender != 'male') {
            $this->form_validation->set_message('gender_check',
                    'Gender error');
            return FALSE;
        }
        return TRUE;
    }


    public function password_check($c_password) {
        $password = $this->input->post('password');
        if (strlen($password) < 6) {
            $this->form_validation->set_message('password_check',
                    'Password must have 6 charectors legth');
            return FALSE;
        }
        if (!preg_match("/^[a-zA-Z0-9]+$/i",
                        $password)) {
            $this->form_validation->set_message('password_check',
                    'Please use alphanumeric password');
            return FALSE;
        }
        if ($c_password != $password) {
            $this->form_validation->set_message('password_check',
                    'Passwords does not match');
            return FALSE;
        }
        return TRUE;
    }
    

    function getDistricts($state_id = '',
            $district_id = '') {
        $options = "<option value=''>Select District</option>";
        if (!$state_id)
            $state_id = $this->input->post('state_id');
        if ($state_id) {
            $districts = $this->Common_model->getStateDistricts($state_id);

            foreach ($districts as $district) {
                if ($district['district_id'] == $district_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $options.="<option value={$district['district_id']} {$selected}>{$district['district_name']}</option>";
            }
        }
        if ($district_id) {
            return $options;
        }
        echo $options;
        exit();
    }

    function getPanchayaths($district_id = '',
            $panchayat_id = '') {
        $options = "<option value=''>Select Panchayath/Block</option>";
        if (!$district_id)
            $district_id = $this->input->post('district_id');
        if ($district_id) {
            $panchayaths = $this->Common_model->getDistrictPanchayaths($district_id);

            foreach ($panchayaths as $panchayath) {
                if ($panchayath['panchayat_id'] == $panchayat_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $options.="<option value={$panchayath['panchayat_id']} {$selected}>{$panchayath['panchayat_name']}</option>";
            }
        }
        if ($panchayat_id) {
            return $options;
        }
        echo $options;
        exit();
    }

    function getVillages() {
        $options = "<option value=''>Select Village</option>";
        $panchayat_id = $this->input->post('panchayat_id');
        if ($panchayat_id) {
            $panchayaths = $this->Common_model->getPanchayathVillages($panchayat_id);

            foreach ($panchayaths as $panchayath) {
                $options.="<option value={$panchayath['village_id']}>{$panchayath['village_name']}</option>";
            }
        }
        echo $options;
        exit();
    }

    function getPhcs() {
        $options = "<option value=''>Select PHC</option>";
        $panchayat_id = $this->input->post('panchayat_id');
        $district_id = $this->input->post('district_id');
        if ($panchayat_id || $district_id) {
            $phcs = $this->Common_model->getPHCs($panchayat_id,
                    $district_id);

            foreach ($phcs as $phc) {
                $options.="<option value={$phc['phc_id']}>{$phc['phc_name']}</option>";
            }
        }
        echo $options;
        exit();
    }

    function getChcs($panchayat_id = '',
            $district_id = '',
            $chc_id = '') {
        $options = "<option value=''>Select CHC</option>";
        if (!$panchayat_id)
            $panchayat_id = $this->input->post('panchayat_id');
        if (!$district_id)
            $district_id = $this->input->post('district_id');
        if ($panchayat_id || $district_id) {
            $phcs = $this->Common_model->getCHCs($panchayat_id,
                    $district_id);

            foreach ($phcs as $phc) {
                if ($chc_id == $phc['chc_id']) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $options.="<option value={$phc['chc_id']} {$selected}>{$phc['chc_name']}</option>";
            }
        }
        if ($chc_id) {
            return $options;
        }
        echo $options;
        exit();
    }
    
        
    
}