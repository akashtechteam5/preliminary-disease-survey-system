<?php

require_once 'Api_Controller.php';

class Register extends Api_Controller
{

    public $validate_error;


    function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->model('Common_model');
    }

    public function register_post()
    {
        $this->setApiUsagePermissionForUserTypes([0]); // deny for user type 0 [normal users]

        $post_array = $this->security->xss_clean($this->post());
        if ($this->validate_register($post_array)) {
            $post_array['registered_by'] = $this->LOGIN_ID;
            $res = $this->Register_model->registerUser($post_array);
            if ($res) {
                if (!$this->LOGIN_ID) {
                    $this->response([
                        "status" => true,
                        "message" => 'Registration Success'
                    ]);
                } else {
                    $access_token = $this->Api_model->setAccessToken($res);
                    $this->response([
                        "status" => true,
                        "message" => 'Registration Success',
                        "data" => ['access_token' => $access_token]
                    ]);
                }
            } else {
                $msg = 'Registration Failed';
                // $this->set_error_response(200, 1003, TRUE, $msg);
                $this->response([
                    "status" => false,
                    "message" => $msg
                ]);
            }
        } else {
            $msg = $this->validate_error;
            // $this->set_error_response(200, 1003, TRUE, $msg);
            $this->response([
                "status" => false,
                "message" => $msg
            ]);
        }
    }

    function validate_register($post_array)
    {
        if (!isset($post_array['mobile']) || $post_array['mobile'] == '' || !$this->mobile_check($post_array['mobile'])) {
            $this->validate_error = 'Invalid Mobile or Mobile Already Registered.';
            return false;
        }
        if (!isset($post_array['password']) || $post_array['password'] == '' || !$this->password_check($post_array['password'])) {
            if ($this->validate_error == '') {
                $this->validate_error = 'Invalid Password.';
            }
            return false;
        }

        if (!isset($post_array['confirm_password']) || $post_array['confirm_password'] == '') {
            $this->validate_error = 'Confirm Password Required.';
            return false;
        }

        if (!isset($post_array['name']) || $post_array['name'] == '') {
            $this->validate_error = 'Name Required.';
            return false;
        }

        if (!isset($post_array['age']) || !($post_array['age'] * 1)) {
            $this->validate_error = 'Invalid Age';
            return false;
        }

        if (!isset($post_array['gender']) || $post_array['gender'] == '' || !$this->gender_check($post_array['gender'])) {
            $this->validate_error = 'Invalid gender';
            return false;
        }

        if (!isset($post_array['gender']) || $post_array['gender'] == '' || !$this->gender_check($post_array['gender'])) {
            $this->validate_error = 'Invalid gender';
            return false;
        }

        if (!isset($post_array['state']) || $post_array['state'] == '') {
            $this->validate_error = 'State required';
            return false;
        }

        if (!isset($post_array['district']) || $post_array['district'] == '') {
            $this->validate_error = 'District required';
            return false;
        }

        if (!isset($post_array['panchayat']) || $post_array['panchayat'] == '') {
            $this->validate_error = 'Panchayat/Block Required';
            return false;
        }

        // if(!isset($post_array['chc']) || $post_array['chc'] == ''){
        //     $this->validate_error = 'CHC Required';
        //     return false;
        // }

        if (!isset($post_array['address']) || $post_array['address'] == '') {
            $this->validate_error = 'Address Required';
            return false;
        }

        if (isset($post_array['mobile_number_1']) && !$this->valid_number($post_array['mobile_number_1'])) {
            $this->validate_error = 'Invalid Alternate Contact 1';
            return false;
        }
        if (isset($post_array['mobile_number_2']) && !$this->valid_number($post_array['mobile_number_2'])) {
            $this->validate_error = 'Invalid Alternate Contact 2';
            return false;
        }
        if (isset($post_array['mobile_number_3']) && !$this->valid_number($post_array['mobile_number_3'])) {
            $this->validate_error = 'Invalid Alternate Contact 3';
            return false;
        }

        return true;
    }

    function valid_number($number)
    {
        if ($number) {
            if (strlen($number) != 10) {
                $this->form_validation->set_message('valid_number', 'Alternate contact must have 10 digits');
                return FALSE;
            }
            if (!preg_match('/^\d+$/', $number)) {
                $this->form_validation->set_message('valid_number', 'Alphabets are not allowed');
                return FALSE;
            }
        }
        return TRUE;
    }

    function gender_check($gender)
    {
        if ($gender != 'other' && $gender != 'female' && $gender != 'male') {
            $this->form_validation->set_message('gender_check', 'Gender error');
            return FALSE;
        }
        return TRUE;
    }

    public function mobile_check($number)
    {
        $res = $this->Register_model->isAlreadyregistered($number);
        if ($res) {
            return FALSE;
        } else {
            if (strlen($number) != 10) {
                return FALSE;
            }
            if (!preg_match('/^\d+$/', $number)) {
                return FALSE;
            }
            return TRUE;
        }
    }

    public function password_check($c_password)
    {
        $password = $this->input->post('password');
        // if (strlen($password) < 6) {
        //     return FALSE;
        // }
        if ($c_password != $password) {
            $this->validate_error = 'Passwords does not match';
            return FALSE;
        }
        return TRUE;
    }


    function states_post()
    {
        $states = array();
        $states = $this->Common_model->getStates();

        $data = ['states' => $states];
        $this->set_success_response(200, $data, 'states');
        exit();
    }

    function districts_post()
    {
        $districts = array();
        $state_id = $this->post('state_id');
        if ($state_id) {
            $districts = $this->Common_model->getStateDistricts($state_id);
        }
        $data = ['districts' => $districts];
        $this->set_success_response(200, $data, 'district');
        exit();
    }

    function panchayaths_post()
    {
        $panchayaths = array();
        $district_id = $this->post('district_id');
        if ($district_id) {
            $panchayaths = $this->Common_model->getDistrictPanchayaths($district_id);
        }
        $data = ['panchayath' => $panchayaths];
        $this->set_success_response(200, $data, 'panchayath');
    }

    function chcs_post()
    {
        $chcs = array();
        $panchayat_id = $this->post('panchayat_id');
        $district_id = $this->post('district_id');
        if ($panchayat_id || $district_id)
            $chcs = $this->Common_model->getCHCs($panchayat_id, $district_id);
        $data = ['chc' => $chcs];
        $this->set_success_response(200, $data, 'chc');
    }

    //    function villages_post() {
    //        $panchayat_id = $this->post('panchayat_id');
    //        if ($panchayat_id) {
    //            $panchayaths = $this->Common_model->getPanchayathVillages($panchayat_id);

    //            foreach ($panchayaths as $panchayath) {
    //                $options.="<option value={$panchayath['village_id']}>{$panchayath['village_name']}</option>";
    //            }
    //        }
    //        echo $options;
    //        exit();
    //    }

    //    function phcs_post() {
    //        $options = "<option value=''>Select PHC</option>";
    //        $panchayat_id = $this->post('panchayat_id');
    //        $district_id = $this->post('district_id');
    //        if ($panchayat_id || $district_id) {
    //            $phcs = $this->Common_model->getPHCs($panchayat_id,
    //                    $district_id);

    //            foreach ($phcs as $phc) {
    //                $options.="<option value={$phc['phc_id']}>{$phc['phc_name']}</option>";
    //            }
    //        }
    //        echo $options;
    //        exit();
    //    }

    public function add_user_post()
    {
        $this->form_validation->set_rules('name', '', 'required|max_length[250]');
        $this->form_validation->set_rules('age', '', 'required|greater_than[0]|less_than[150]');
        $this->form_validation->set_rules('gender', '', 'required|callback_gender_check');
        $this->form_validation->set_rules('state', '', 'required');
        $this->form_validation->set_rules('district', '', 'required');
        $this->form_validation->set_rules('panchayat', '', 'required');
        $this->form_validation->set_rules('address', '', 'required');
        $this->form_validation->set_rules('mobile_number_1', '', 'callback_valid_number');
        $this->form_validation->set_rules('mobile_number_2', '', 'callback_valid_number');
        $this->form_validation->set_rules('mobile_number_3', '', 'callback_valid_number');
        if (($this->LOGIN_TYPE != 0)) {
            $this->form_validation->set_rules('login_id', '', 'required|numeric');
        }
        if (!$this->form_validation->run()) {
            $this->response([
                "status" => false,
                "message" => "Invalid Inputs!"
            ]);
        }

        $reg_array = [
            'login_id' => ($this->LOGIN_TYPE == 0) ? $this->LOGIN_ID : $this->post("login_id"),
            'gender' => $this->post("gender"),
            'name' => $this->post("name"),
            'state' => $this->post("state"),
            'district' => $this->post("district"),
            'panchayat' => $this->post("panchayat"),
            'age' => $this->post("age"),
            'registered_by' => $this->LOGIN_ID,
            'address' => $this->post("address"),
            'mobile_number_1' => $this->post("mobile_number_1"),
            'mobile_number_2' => $this->post("mobile_number_2"),
            'mobile_number_3' => $this->post("mobile_number_3"),
            'vulnerability_status' => ($this->post("vulnerability_details")) ? "yes" : "no"
        ];
        if($reg_array["vulnerability_status"] == "yes") {
            $vulnerabilitiesIndices = array_column($this->Api_model->getVulnerabilities(), "id");
            $postIndices = json_decode($this->post("vulnerability_details"), true);
            if(!count($postIndices) || (count($postIndices) == count(array_diff($postIndices, $vulnerabilitiesIndices)))) {
                $this->response([
                    "status" => false,
                    "message" => "No vulnerabilities are marked!"
                ]);
            }
            foreach ($postIndices as $key) {
                $reg_array[$key] = 1;
            }
        }
        $this->load->model('Home_model');
        if ($this->Home_model->registerMember($reg_array)) {
            $users = $this->Api_model->getUserListOnLoginId($reg_array['login_id']);
            $this->response([
                "status" => true,
                "message" => "success",
                "data" => array(
                    "login_id" => $reg_array['login_id'],
                    "users" => $users
                )
            ]);
        }
        $this->response([
            "status" => false,
            "message" => "Error occured while updation! Please try again!"
        ]);
    }

    public function vulnerabilities_get()
    {
        $vulnerabilities = $this->Api_model->getVulnerabilities();
        $this->response([
            "status" => true,
            "message" => 'success',
            "data" => $vulnerabilities
        ]);
    }
}
