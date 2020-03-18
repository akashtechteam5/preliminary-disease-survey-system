<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cov_Controller extends CI_Controller
{

    public $IP_ADDR;                        //IP ADDRESS
    public $SERVER_TIME;                    //SERVER TIME
    public $CURRENT_CTRL = null;            //CURRENT CONTROLLER CLASS
    public $CURRENT_MTD = null;             //CURRENT CONTROLLER METHOD
    public $BASE_URL;                       //BASE URL
    public $CURRENT_URL;                    //CURRENT URL
    public $CURRENT_URL_FULL;               //CURRENT URL WITH URL ARGUEMENTS
    public $REDIRECT_URL_FULL;               //CURRENT URL WITH URL ARGUEMENTS
    public $VIEW_DATA_ARR = [];        //DATA ARRAY FOR VIEW FILES
    public $ARR_SCRIPT = [];           //SCRPT ARRAY FOR VIEW FILES
    public $COMPANY_NAME;                   //COMAPNY NAME
    public $SESS_STATUS;                    //SESS STATUS
    public $LOG_USER_NAME = null;           //LOGGED USER NAME
    public $LOG_USER_ID = null;             //LOGGED USER ID
    public $LOG_USER_TYPE = null;           //LOGGED USER TYPE admin/distributer/employee
    public $FROM_MOBILE;                    //ACCESS FROM MOBILE
    public $C_TOKEN;                        // TOKEN TO ACCESS  
    public $USER_DATA;
    public $PROJECT_NAME;
    public $PUBLIC_URL;
    public $MENU_ARR;

    function __construct()
    {

        parent::__construct();

        if (substr(uri_string(), 0, strlen('app/')) === 'app/') {
            return;
        }

        $this->initialize_public_variables();

        $this->set_session_time_out();

        $this->load_default_model_classes();

        $this->check_request_from_mobile();

        if (!$this->FROM_MOBILE) {
            $this->set_logged_user_data();
        }
        
        $this->check_url_permitted();
        
        $this->check_logged();
        
        $this->set_menu_array();
        
        $this->set_flash_message();

    }
    
    function initialize_public_variables()
    {
        $this->SESS_STATUS = false;
        $this->FROM_MOBILE = false;
        $this->CURRENT_CTRL = $this->router->class;
        $this->CURRENT_MTD = $this->router->method;
        $this->CURRENT_URL_FULL = $this->CURRENT_CTRL . "/" . $this->CURRENT_MTD;
        $this->REDIRECT_URL_FULL = $this->CURRENT_CTRL . "/" . $this->CURRENT_MTD;
        $this->CURRENT_URL = $this->CURRENT_CTRL . "/" . $this->CURRENT_MTD;
        $this->IP_ADDR = $this->input->server('REMOTE_ADDR');
        $this->BASE_URL = base_url();
        $this->PUBLIC_URL = $this->BASE_URL . "public_html/";
        $this->PROJECT_NAME = 'PDSS';
    }
    
    function set_session_time_out()
    {
        $this->session->set_userdata("inf_user_page_load_time", time());
        
    }
    
    function load_default_model_classes()
    {
        $this->load->model('Common_model', '', true);
        $this->load->model('Co_model', '', true);
        $this->load->model('Search_model', '', true);
    }
    
    function check_request_from_mobile()
    {
        $post_array = [];
        if ($this->input->post()) {
            $post_array = $this->input->post(null, true);
        }
        
        $post_array = $this->stripTagsPostArray($post_array);

        if (isset($post_array["from_mobile"]) && $post_array["from_mobile"]) {
            $this->FROM_MOBILE = true;
        }
    }
    
    public function stripTagsPostArray($post_arr = array()) {
        $temp_arr = array();
        if (is_array($post_arr) && count($post_arr)) {
            foreach ($post_arr AS $key => $value) {
                if (is_string($value)) {
                    $temp_arr["$key"] = strip_tags($value);
                } else {
                    $temp_arr["$key"] = $value;
                }
            }
        }
        return $temp_arr;
    }
    
    function set_public_variables()
    {
        $this->set("IP_ADDR", $this->IP_ADDR);
        $this->set("BASE_URL", $this->BASE_URL);
        $this->set("SESS_STATUS", $this->SESS_STATUS);
        $this->set("CURRENT_CTRL", $this->CURRENT_CTRL);
        $this->set("CURRENT_MTD", $this->CURRENT_MTD);
        $this->set("CURRENT_URL", $this->CURRENT_URL);
        $this->set("CURRENT_URL_FULL", $this->CURRENT_URL_FULL);
        $this->set('LOG_USER_ID', $this->LOG_USER_ID);
        $this->set('LOG_USER_NAME', $this->LOG_USER_NAME);
        $this->set('LOG_USER_TYPE', $this->LOG_USER_TYPE);
        $this->set('SERVER_TIME', date("H:i:s"));
        $this->set('SERVER_DATE', date("l\, F jS\, Y "));
        $this->set('C_TOKEN', $this->C_TOKEN);
        $this->set('USER_DATA', $this->USER_DATA);
        $this->set('PROJECT_NAME', $this->PROJECT_NAME);
        $this->set('PUBLIC_URL', $this->PUBLIC_URL);
        $this->set('MENU_ARR', $this->MENU_ARR);
        if($this->session->userdata('co_from_mobile')){
	        $this->set('FROM_MOBILE', TRUE);
		}else{
	        $this->set('FROM_MOBILE', FALSE);
		}
    }
    
    function update_session_status()
    {
        if ($this->checkSession()) {
            $this->SESS_STATUS = true;
        }
    }
    
    function set_logged_user_data()
    {
        if ($this->checkSession()) {
            $logged_in_arr = $this->session->userdata('co_logged_in');
            $this->LOG_USER_NAME = $logged_in_arr['user_name'];
            $this->LOG_USER_ID = $logged_in_arr['user_id'];
            $this->LOG_USER_TYPE = $logged_in_arr['user_type'];
        }
    }
    
    function checkSession()
    {
        $flag = !empty($this->session->userdata('co_logged_in')) ? true : false;
        return $flag;
    }
    
    function set_flash_message()
    {
        $FLASH_ARR_MSG = $this->session->flashdata('MSG_ARR');
        if ($FLASH_ARR_MSG) {
            $this->set("MESSAGE_DETAILS", $FLASH_ARR_MSG["MESSAGE"]["DETAIL"]);
            $this->set("MESSAGE_TYPE", $FLASH_ARR_MSG["MESSAGE"]["TYPE"]);
            $this->set("MESSAGE_STATUS", $FLASH_ARR_MSG["MESSAGE"]["STATUS"]);
        } else {
            $this->set("MESSAGE_STATUS", false);
            $this->set("MESSAGE_DETAILS", false);
            $this->set("MESSAGE_TYPE", false);
        }
    }

    function set($set_key, $set_value)
    {
        $this->VIEW_DATA_ARR[$set_key] = $set_value;
    }

    function setView()
    {
        $this->set_public_variables();
        $this->load->view($this->CURRENT_CTRL.'/'.$this->CURRENT_MTD, $this->VIEW_DATA_ARR);
    }

    function redirect($msg, $page, $message_type = false, $MSG_ARR = array())
    {
        $MSG_ARR["MESSAGE"]["DETAIL"] = $msg;
        $MSG_ARR["MESSAGE"]["TYPE"] = $message_type;
        $MSG_ARR["MESSAGE"]["STATUS"] = true;
        $this->session->set_flashdata('MSG_ARR', $MSG_ARR);

        $path = base_url();

        $split_pages = explode("/", $page);
        $controller_name = $split_pages[0];
        $method = isset($split_pages[1]) ? $split_pages[1] : '';
        $page = (count($split_pages) == 1 || $controller_name == 'login') ? $page : preg_replace("/($controller_name)\//i", "", $page, 1);

        $path .= $controller_name . '/' . $method ;
        redirect("$path", 'refresh');
        exit();
        
    }

    public function deny_permission()
    {
        $msg = lang('permission_denied');
        $this->redirect($msg, 'home/index', false);
    }

    public function check_url_permitted()
    {

        if ($this->checkSession()) {
            
        }
    }
    
    function check_logged() {
        if(!$this->checkSession() && $this->CURRENT_CTRL != 'login'){
            $this->setLoginLink();
        }
    }
    
    public function setLoginLink()
    {
        $base_url = base_url();
        $login_link = $base_url . "login";
        echo "You don't have permission to access this page. <a href='$login_link'>Login</a>";
        exit();
    }
    
    public function set_menu_array(){
        $this->MENU_ARR = array();
        if($this->checkSession()){
            $this->MENU_ARR = $this->Co_model->getMenuArray($this->LOG_USER_TYPE);
        }
    }

}
