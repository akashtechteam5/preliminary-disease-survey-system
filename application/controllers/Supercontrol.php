<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Supercontrol extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct() {
        	parent::__construct();
		$this->load->model('Supercontrol_model');
		if($this->session->userdata('logged_in') == NULL){
			redirect('login/login');
		}
    	}

	
	public function home($page_id = '')
	{
	    //$this->Supercontrol_model->get_req_camp_list(8);

      /*  $baseurl = base_url() . 'supercontrol/home';
        $config = $this->pagination->customize_style();
        $config['base_url'] = $baseurl;
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['uri_segment'] = 4;
        $total_row = $this->Supercontrol_model->get_dashboard_data_count();
        $config['total_rows'] = ($total_row > 0)?$total_row:0;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $result_per_page = $this->pagination->create_links();*/
        //$this->Supercontrol_model->get_active_requests();
        
        $data = $this->Supercontrol_model->get_dashboard_data();
		$this->load->view('home',$data);
	}
	
	
	public function active_requests()
	{
        $data = $this->Supercontrol_model->get_dashboard_data();
		$this->load->view('active_requests',$data);
	}
	
	public function pending_requests()
	{
        $data = $this->Supercontrol_model->get_pending_requests_data();
		$this->load->view('pending_requests',$data);
	}

	public function index()
	{
		if($this->input->post()){
			$input = $this->input->post(NULL,TRUE);
			$flag = $this->Supercontrol_model->checkuser($input['username'],$input['password']);
			//$flag = TRUE;
			if($flag){
				$res = $this->Supercontrol_model->getUserId($input['username']);
				$this->session->set_userdata('logged_in',TRUE);
				$this->session->set_userdata('id',$res['id']);
				if($res['user_type']=="admin"){
				redirect('supercontrol/home');
				} else if($res['user_type']=="super_admin"){
				    redirect('supercontrol/superadmin_home');
				}
			}
		}
		
		$this->load->view('login');	
	}
	
	
	public function superadmin_home()
	{
		$data = $this->Supercontrol_model->get_dashboard_data();
       // print_r($data);die;
		$this->load->view('superadmin_home',$data);
	}


	public function admin_show()
	{
		//print_r($this->session->userdata());
		print_r($this->input->post());die;
		echo base_url();
		
		$this->Supercontrol_model->show();
		die("hii");
	}




	

	public function admin_cc_registration(){

		$data['area'] = $this->Supercontrol_model->get_area_list();
		$data['flag'] = FALSE;
		$data['msg'] = '';
			
		if($this->input->post()){

			//print_r($this->input->post());die;
			$error = FALSE;
		
			$input_array = $this->input->post(NULL,TRUE);
			
            $username = $input_array['username'];
			$exists = $this->Supercontrol_model->checkusername($username);
			if($exists){
			$data['flag'] = FALSE;
		    $data['msg'] = 'USERNAME ALREADY EXISTS, TRY A DIFFERENT USERNAME';
			} else {
			    $data['flag'] = TRUE;
		        $data['msg'] = 'YOU CAN REGISTER USING THIS USERNAME!';  
			
			
			
    			if($input_array['password']!=$input_array['confirm_password']){
    				$error = TRUE;
    			}
    		
    			if(!$error){
    			unset($input_array['confirm_password']);
    
    			$input_array['user_type'] = "camp_coo";	
    			$input_array['password'] = md5($input_array['password']);
    			$this->Supercontrol_model->cc_registration($input_array);
    	
    			$data['msg'] = "REGISTRATION SUCCESSFUL";
    			$data['flag'] = TRUE;
    			} else {
    				$data['msg'] = "REGISTRATION FAILED";
    				$data['flag'] = FALSE;
    			}
			}
		}
		

		$this->load->view('camp_reg',$data);

	  }




	public function admin_ngo_registration(){

		$data['area'] = $this->Supercontrol_model->get_area_list();
		$data['flag'] = FALSE;
		$data['msg'] = '';
			
		if($this->input->post()){

			//print_r($this->input->post());die;
			$error = FALSE;
		
			$input_array = $this->input->post(NULL,TRUE);
            
            $username = $input_array['username'];
			$exists = $this->Supercontrol_model->checkusername($username);
			if($exists){
			$data['flag'] = FALSE;
		    $data['msg'] = 'USERNAME ALREADY EXISTS, TRY A DIFFERENT USERNAME';
			} else {
            
			if($input_array['password']!=$input_array['confirm_password']){
				$error = TRUE;
			}
		
			if(!$error){
			unset($input_array['confirm_password']);

			$input_array['user_type'] = "ngo";	
			$input_array['password'] = md5($input_array['password']);
			$this->Supercontrol_model->cc_registration($input_array);
	
			$data['msg'] = "REGISTRATION SUCCESSFUL";
			$data['flag'] = TRUE;
			} else {
				$data['msg'] = "REGISTRATION FAILED";
				$data['flag'] = FALSE;
			}
			}
		
		}
		

		$this->load->view('ngo_reg',$data);

	  }


	public function check_item(){

		if($this->input->post()){
			$name = $this->input->post('name');
			$this->Supercontrol_model->check_item($name);
		}

		$this->load->view('check_item');
	}


	public function admin_add_area(){
		
		$data['flag'] = FALSE;
		$data['msg'] = '';

		if($this->input->post()){
			$input_array = $this->input->post(NULL,TRUE);

			$this->Supercontrol_model->add_area($input_array);
			$data['flag'] = TRUE;
		$data['msg'] = 'ADDED SUCCESSFULLY';
		}
		$data['area'] = $this->Supercontrol_model->get_area_list();
		$this->load->view('add_area',$data);
	}

	public function admin_add_cat(){
		
		$data['flag'] = FALSE;
		$data['msg'] = '';

		if($this->input->post()){
			$input_array = $this->input->post(NULL,TRUE);

			$this->Supercontrol_model->add_cat($input_array);
			$data['flag'] = TRUE;
		$data['msg'] = 'ADDED SUCCESSFULLY';
		}
		$data['category'] = $this->Supercontrol_model->get_cat_list();
		$this->load->view('add_category',$data);
	}
	
	
	public function admin_add_item(){
		
		$data['flag'] = FALSE;
		$data['msg'] = '';
    
		if($this->input->post()){
			$input_array = $this->input->post(NULL,TRUE);
            $status = $this->Supercontrol_model->add_item($input_array);
            if($status){
			$data['flag'] = TRUE;
		    $data['msg'] = 'ADDED SUCCESSFULLY';
            } else {
                	$data['flag'] = FALSE;
		            $data['msg'] = 'Failed';
            }
		}
		$data['item_report'] = $this->Supercontrol_model->get_all_item();
		$data['category'] = $this->Supercontrol_model->get_cat_list();
		$this->load->view('add_item',$data);
	}
	
	
	public function admin_check_username(){
	    
		$data['flag'] = FALSE;
		$data['msg'] = '';

		if($this->input->post()){
			$input_array = $this->input->post(NULL,TRUE);
            $username = $input_array['username'];
			$exists = $this->Supercontrol_model->checkusername($username);
			if($exists){
			$data['flag'] = FALSE;
		    $data['msg'] = 'USERNAME ALREADY EXISTS, TRY A DIFFERENT USERNAME';
			} else {
			    $data['flag'] = TRUE;
		        $data['msg'] = 'YOU CAN REGISTER USING THIS USERNAME!';  
			}
		}
		$this->load->view('check_username',$data);
		
	}


	public function ngo_report(){
		

		$data['ngo_report'] = $this->Supercontrol_model->get_ngo_list();
		$this->load->view('ngo_report',$data);
	}
	
	public function camp_list(){
		

		$this->load->library('pagination');
        $config['base_url'] = base_url() . 'supercontrol/camp_list';
        $config['total_rows'] = $this->Supercontrol_model->get_camp_count();
        $config['uri_segment'] = $this->uri->total_segments();
        $config['per_page'] = 20;
        if ($this->uri->segment(3) != "") {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $this->pagination->initialize($config);
        $data['page'] = $page;
        $data['link'] = $this->pagination->create_links();
		$data['camp_report'] = $this->Supercontrol_model->get_camp_list_new($page,$config['per_page']);
		$this->load->view('camp_report',$data);
	}


    public function show_camp($camp=''){
		$data['flag'] = FALSE;
        $data['msg'] = '';
        $input['camp_id'] = $camp;
		$data['table_data'] = $this->Supercontrol_model->get_material_requests($input);
		$data['name'] = $this->Supercontrol_model->get_name_camp($camp);
		$data['camp_id'] = $camp;
		if ($this->input->post()) {
            $input_array = $this->input->post(NULL, TRUE);
            
            foreach ($input_array as $key => $offer) {
                if ($offer > 0) {
                    $key_arr = explode("_", $key);
                    if (isset($key_arr[0]) && isset($key_arr[1])  && isset($key_arr[2])) {
                        if ($key_arr[0] == 'send') {
                            $req_id = $key_arr[1];
                            $item_id = $key_arr[2];
                            $ngo_id = $this->session->userdata['id'];
                            $res = $this->Supercontrol_model->insertOfferedItem($item_id, $req_id, $ngo_id, $offer);
                            if ($res) {
                                $data['flag'] = TRUE;
                                $data['msg'] = 'OFFER ADDED SUCCESSFULLY!';
                            } else {
                                $data['flag'] = FALSE;
                                $data['msg'] = 'OFFER ADDITION FAILED!';
                            }
                        }
                    }
                }
            }
            $data['table_data'] = $this->Supercontrol_model->get_material_requests($input);
        }
		$this->load->view('camp_view',$data);
	}
	
	public function item_list(){
		$data['item_report'] = $this->Supercontrol_model->get_all_item();
		$this->load->view('item_report',$data);
	}
	
	public function show_item($item_id = '') {

        $input['item_id'] = $item_id;
        $data['table_data'] = $this->Supercontrol_model->get_material_requests($input);
        
        
        $data['name'] = $this->Supercontrol_model->get_name_item($item_id);
        $data['item_id'] = $item_id;
        $data['flag'] = FALSE;
        $data['msg'] = '';
        if ($this->input->post()) {
            $input_array = $this->input->post(NULL, TRUE);
            $item_id = $input_array['item_id'];
            foreach ($input_array as $key => $offer) {
                if ($offer > 0) {
                    $key_arr = explode("_", $key);
                    if (isset($key_arr[0]) && isset($key_arr[1])) {
                        if ($key_arr[0] == 'send') {
                            $req_id = $key_arr[1];
                            $ngo_id = $this->session->userdata['id'];
                            $res = $this->Supercontrol_model->insertOfferedItem($item_id, $req_id, $ngo_id, $offer);
                            if ($res) {
                                $data['flag'] = TRUE;
                                $data['msg'] = 'OFFER ADDED SUCCESSFULLY!';
                            } else {
                                $data['flag'] = FALSE;
                                $data['msg'] = 'OFFER ADDITION FAILED!';
                            }
                        }
                    }
                }
            }
            $data['table_data'] = $this->Supercontrol_model->get_material_requests($input);
        }
        $this->load->view('item_view', $data);
    }

    public function send(){
        $arra = array('eTxEZIwH6bc:APA91bFE5dB4UWKg8jyzYPnucDt0Bdi9zEp9xA68VRtVKqANTK_lyHnzJ-aXkh1qokx-T3JprEwNRYH8w2TDN-WzuSg-Gpkh87sPN4CXOniefc7t6ZRKTCczrj8YGDhx_WYswqXUA2nT');
        $this->Supercontrol_model->sendFcm("hii","titlke",$arra);
    }


    public function admin_registration(){
        $data['area'] = $this->Supercontrol_model->get_area_list();
		$data['flag'] = FALSE;
		$data['msg'] = '';
			
		if($this->input->post()){

			//print_r($this->input->post());die;
			$error = FALSE;
		
			$input_array = $this->input->post(NULL,TRUE);
            
            $username = $input_array['username'];
			$exists = $this->Supercontrol_model->checkusername($username);
			if($exists){
			$data['flag'] = FALSE;
		    $data['msg'] = 'USERNAME ALREADY EXISTS, TRY A DIFFERENT USERNAME';
			} else {
            
			if($input_array['password']!=$input_array['confirm_password']){
				$error = TRUE;
			}
		
			if(!$error){
			unset($input_array['confirm_password']);


			$input_array['password'] = md5($input_array['password']);
			$this->Supercontrol_model->cc_registration($input_array);
	
			$data['msg'] = "REGISTRATION SUCCESSFUL";
			$data['flag'] = TRUE;
			} else {
				$data['msg'] = "REGISTRATION FAILED";
				$data['flag'] = FALSE;
			}
			}
		
		}
		

		$this->load->view('admin_register',$data);
    }
	
	public function camp_list_new(){
		$this->load->library('pagination');
        $config['base_url'] = base_url() . 'supercontrol/camp_list_new';
        $config['total_rows'] = $this->Supercontrol_model->get_camp_count();
        $config['uri_segment'] = $this->uri->total_segments();
        $config['per_page'] = 5;
        if ($this->uri->segment(3) != "") {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $this->pagination->initialize($config);
        
        $data['link'] = $this->pagination->create_links();
		$data['camp_report'] = $this->Supercontrol_model->get_camp_list_new($page,$config['per_page']);
		$this->load->view('camp_report',$data);
	}
	
	public function missing_item(){
		
		$this->load->library('pagination');
        $config['base_url'] = base_url() . 'supercontrol/missing_item';
        $config['total_rows'] = $this->Supercontrol_model->get_camp_count();
        $config['uri_segment'] = $this->uri->total_segments();
        $config['per_page'] = 20;
        if ($this->uri->segment(3) != "") {
            $page = $this->uri->segment(3);
        } else {
            $page = 0;
        }
        $this->pagination->initialize($config);
        $data['page'] = $page;
        $data['link'] = $this->pagination->create_links();
		$data['missing_item'] = $this->Supercontrol_model->get_ngo_missing_list($page,$config['per_page']);
		$this->load->view('missing_report',$data);
	}
	
	public function cc_edit($camp_id){

		$data['area'] = $this->Supercontrol_model->get_area_list();
		$data['flag'] = FALSE;
		$data['msg'] = '';
			
		if($this->input->post()){
			$error = FALSE;
			$input_array = $this->input->post(NULL,TRUE);
            $username = $input_array['username'];
			$exists = $this->Supercontrol_model->checkusername($username);
			if($exists){
			   // $update_array['name'] = $input_array[''];
    			$this->Supercontrol_model->cc_update($update_array,$camp_id);
    	
    			$data['msg'] = "REGISTRATION SUCCESSFUL";
    			$data['flag'] = TRUE;
			} else {
			    $data['flag'] = FALSE;
    		    $data['msg'] = 'User not exist';
			}
		}
		
        //$user_details = $this->Supercontrol_model->get_camp_details($camp_id);
		$this->load->view('camp_update',$data);

	  }

}