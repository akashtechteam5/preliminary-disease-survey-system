<?php

require_once 'Api_Controller.php';

class Auth extends Api_Controller {

    function __construct() {
        parent::__construct();
        
    }

    function user_access_post() {
        $username = $this->post('username');
        $password = $this->post('password');
        $res = $this->Api_model->verifyLoginCredentialsUser($username, $password);
        if ($res) {
            $access_token = $this->Api_model->setAccessToken($res);
            $data = ['access_token' => $access_token];
            $this->set_success_response(200, $data, 'Login Success');
        } else {
            $this->set_error_response(200, 1003);
        }
    }
    
    function main_access_post() {
        $username = $this->post('username');
        $password = $this->post('password');
        $res = $this->Api_model->verifyLoginCredentialsLevels($username, $password);
        if ($res) {
            $access_token = $this->Api_model->setAccessToken($res);
            $data = ['access_token' => $access_token];
            $this->set_success_response(200, $data, 'Login Success');
        } else {
            $this->set_error_response(200, 1003);
        }
    }

}
