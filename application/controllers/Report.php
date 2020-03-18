<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Cov_Controller {

    function __construct() {
        parent::__construct();
        if(!$this->checkSession()){
            $this->redirect('','login',false);
        }
        $this->load->model('Common_model');
        $this->load->model('Report_model');
    }

    public function user_report()
    {
        $title = 'Users Report';
        $this->set("title", $this->PROJECT_NAME . " | $title");
        $this->set("main_heading", $title);

        $users = $this->Report_model->getAllUsers();
        
        $this->set('users',$users);
        $this->setView();
    }
}