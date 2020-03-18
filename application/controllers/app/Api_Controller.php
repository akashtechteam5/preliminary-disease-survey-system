<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_API_Controller.php';
require APPPATH . 'libraries/API_Format.php';

class Api_Controller extends Cov_Controller
{
    public $DATE_FORMAT = 'd-m-Y';
    public $TIME_FORMAT = 'd-m-Y h:i a';
    public $MODULE_STATUS;
    public $NATIVE_APPS = false;
    public $IP_ADDR;
    protected $ERROR_CODES = [
        401 => 'Unauthorized',
        403 => 'Forbidden',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        429 => 'Too Many Requests',
        1001 => 'Invalid API Key',
        1002 => 'Invalid Access Token',
        1003 => 'Invalid Credentials / Invalid Username or Password',
        1004 => 'Incorrect Input Format / Validation Error',
        1005 => 'Login Blocked',
        1006 => 'Registration Blocked',
        1007 => 'Username Not Available / Username Already Exists',
        1008 => 'Invalid Username / Username Not Found',
        1009 => 'File Type Not Supported',
        1010 => 'File Size Exceeded',
        1011 => 'Incorrect Password',
        1012 => 'Error While Uploading File',
    ];
    public $LOGIN_ID = '';
    public $LOGIN_TYPE = '';
    public $LOGIN_MOBILE = '';

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {

        parent::__construct();
        
        $this->__resTraitConstruct();
        
        $this->load_default_model_classes();
        
        $this->check_api_key_credentials();

        $this->setPublicVariables();

        $this->methods["{$this->router->method}_{$this->input->method()}"]['limit'] = $this->config->item('rest_max_limit');

    }

    public function check_api_key_credentials()
    {
        $api_key = $this->input->get_request_header('api-key');
        $api_details = $this->Api_model->getApiDetails($api_key);
        if ($api_details) {
            $this->IP_ADDR = $this->input->ip_address();
            $this->PUBLIC_URL = base_url() . "public_html/";
        } else {
            $this->response(["status" => false, "message" => "Invalid API Key!"], 403);
            // $this->set_error_response(422, 1001, false);
        }
    }

    public function set_error_response($status_code, $error_code = null, $default = true, $message = null)
    {
        if (empty($error_code)) {
            $error_code = $status_code;
        }
        $description = $error_code;
        $description = $this->ERROR_CODES[$error_code] ?? null;
        $response = [
            'status' => false,
        //    'error' => [
        //        'code' => $error_code,
        //        'description' => $description,
        //        // 'description' => $this->ERROR_CODES[$error_code] ?? null,
        //    ],
            'message' => $message ?? $description
        ];
        if ($error_code == 1004) {
            $response['error']['fields'] = $this->form_validation->error_array();
        }
        if ($default) {
            $this->response($response, $status_code);
        } else {
            http_response_code($status_code);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }
    }

    public function set_success_response($status_code, $data = '', $msg = '')
    {
        $response = [
            'status' => true
        ];
        if ($data || $data >= 0) {
            $response['data'] = $data;
        }
        if($msg != ''){
            $response['message'] = $msg;
        }
        $this->response($response, $status_code);
    }

    function load_default_model_classes()
    {
        $this->load->model('Api_model');
    }

    public function setPublicVariables()
    {
        // this function wont(should not) prevent users without access tokens
        $access_token = $this->input->get_request_header('access-token');
        $loggedInDetails = $this->Api_model->getLoggedDetailsOnToken($access_token);
        // print_r($loggedInDetails);die;
        if(count($loggedInDetails)) {
            $this->LOGIN_ID = $loggedInDetails["login_id"] * 1;
            $this->LOGIN_TYPE = $loggedInDetails["login_type"] * 1;
            $this->LOGIN_MOBILE = $loggedInDetails["login_mobile"];
        }
    }

    public function setApiUsagePermissionForUserTypes($denied = [], $allowed = [])
    {
        if(count($allowed)) {
            if(!in_array($this->LOGIN_TYPE, $allowed) || !$this->LOGIN_ID) {
                $this->response([
                    "status" => false,
                    "message" => "You are not authorized to perform this action!!"
                ], 401);
            }
        }
        if(in_array($this->LOGIN_TYPE, $denied) && $this->LOGIN_ID) {
            $this->response([
                "status" => false,
                "message" => "You are not authorized to perform this action!"
            ], 401);
        }
    }
    
}
