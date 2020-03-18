<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Cov_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->model('Common_model');
    }

    public function index() {
        $title = 'Register';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", 'Register');

        $data['states'] = $this->Common_model->getStates();
        $data['validation_failed'] = false;
        $data['flag'] = $this->session->flashdata('flag');
        $data['msg'] = $this->session->flashdata('msg');
        $data['is_logged'] = $this->LOG_USER_ID;

        if ($this->input->post('submit')) {
            $post_array = $this->security->xss_clean($this->input->post());
            
            if ($this->validate_register()) {

                $post_array['registered_by'] = $this->LOG_USER_ID;
                $res = $this->Register_model->registerUser($post_array);
                if ($res) {
                    $this->session->set_flashdata('flag',
                            TRUE);
                    $this->session->set_flashdata('msg',
                            'Registration Success');
                    redirect('register',
                            'refresh');
                } else {
                    $this->session->set_flashdata('flag',
                            FALSE);
                    $this->session->set_flashdata('msg',
                            'Registration Failed');
                    redirect('register',
                            'refresh');
                }
            } else {

                $data['districts'] = $this->getDistricts($post_array['state'],
                        $post_array['district']);
                $data['panchayaths'] = $this->getPanchayaths($post_array['district'],
                        $post_array['panchayat']);
                $data['chcs'] = $this->getChcs($post_array['panchayat'],
                        $post_array['district'],
                        $post_array['chc']);
                $data['validation_failed'] = true;
            }
        }
        foreach ($data as $k => $v){
            $this->set($k,$v);
        }
        $this->setView();
    }

    function validate_register() {

        $this->form_validation->set_rules('mobile',
                'Mobile No',
                'required|callback_mobile_check');
        $this->form_validation->set_rules('password',
                'Password',
                'required|callback_password_check');
        $this->form_validation->set_rules('confirm_password',
                'Confirm Password',
                'required');
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
    
    function level_user(){
        $data['states'] = $this->Common_model->getStates();
        $data['levels'] = $this->Common_model->getLevels();
        $data['validation_failed'] = false;
        $data['flag'] = $this->session->flashdata('flag');
        $data['msg'] = $this->session->flashdata('msg');
        $data['is_logged'] = $this->LOG_USER_ID;
        
        if ($this->input->post('submit')) {
            $post_array = $this->security->xss_clean($this->input->post());
            if ($this->validate_level_user_register()) {

                $post_array['registered_by'] = $this->LOG_USER_ID;
                $res = $this->Register_model->registerLevelUser($post_array);
                if ($res) {
                    $this->session->set_flashdata('flag',
                            TRUE);
                    $this->session->set_flashdata('msg',
                            'Registration Success');
                    redirect('register/level_user',
                            'refresh');
                } else {
                    $this->session->set_flashdata('flag',
                            FALSE);
                    $this->session->set_flashdata('msg',
                            'Registration Failed');
                    redirect('register/level_user',
                            'refresh');
                }
            } else {

                $data['districts'] = $this->getDistricts($post_array['state'],
                        $post_array['district']);
                $data['panchayaths'] = $this->getPanchayaths($post_array['district'],
                        $post_array['panchayat']);
                $data['chcs'] = $this->getChcs($post_array['panchayat'],
                        $post_array['district'],
                        $post_array['chc']);
                $data['validation_failed'] = true;
            }
        }
        foreach ($data as $k => $v){
            $this->set($k,$v);
        }
        $this->setView();
    }
    
    function validate_level_user_register() {


        $this->form_validation->set_rules('login_id',
                'Login ID',
                'required|callback_login_id_check');
        $this->form_validation->set_rules('password',
                'Password',
                'required|callback_password_check');
        $this->form_validation->set_rules('confirm_password',
                'Confirm Password',
                'required');
        
        $this->form_validation->set_rules('level',
                'Level',
                'required');
        
        /*$this->form_validation->set_rules('state',
                'State',
                'required');
        $this->form_validation->set_rules('district',
                'District',
                'required');
        $this->form_validation->set_rules('panchayat',
                'Panchayat/Block',
                'required');
        $this->form_validation->set_rules('chc',
                'CHC',
                'required');*/

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

    public function mobile_check($number) {
        $res = $this->Register_model->isAlreadyregistered($number);
        if ($res) {
            $this->form_validation->set_message('mobile_check',
                    'User already registered with this number');
            return FALSE;
        } else {
            if (strlen($number) != 10) {
                $this->form_validation->set_message('mobile_check',
                        'Mobile No must have 10 digits');
                return FALSE;
            }
            if (!preg_match('/^\d+$/',
                            $number)) {
                $this->form_validation->set_message('mobile_check',
                        'Alphabets are not allowed');
                return FALSE;
            }
            return TRUE;
        }
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
    
    public function login_id_check($login_id) {
        $res = $this->Register_model->isAlreadyregistered($login_id);
        if ($res) {
            $this->form_validation->set_message('mobile_check',
                    'User already registered with this Login ID');
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
