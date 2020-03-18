<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


	function __construct() {
        	parent::__construct();
		$this->load->model('Supercontrol_model');
		
		$api_key = $this->input->post('api_key');    
		
		if($api_key!="7k]xYeLReZG"){
		    $json_response['status'] = "access denied";
		    echo json_encode($json_response);
            exit();
		}

	}

	public function login()
	{
	    $json_response['status'] = false;
	    $json_response['message'] = "Login Failed";
		if($this->input->post()){
		    $flag = FALSE;
		    $json_response['status'] = false;
			$input = $this->input->post(NULL,TRUE);
			$flag = $this->Supercontrol_model->checkuser($input['username'],$input['password']);
			
			if($flag){
				$id = $this->Supercontrol_model->getUserInfo($input['username']);
				$json_response['id'] = $id['id'];
				$json_response['user_type'] = $id['user_type'];
				if($id['user_type'] == 'camp_coo'){
				    $json_response['camp_name'] = $id['name'];
				}
				$json_response['status'] = true;
				$json_response['message'] = "Logged In!";
			}
		}
		
		  echo json_encode($json_response);
            exit();
	}
	
	
	
	
    
	public function dashboard(){
	    $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	   $json_response['cat_list'] = $this->Supercontrol_model->get_cat_list();
	   $json_response['measure_list'] = $this->Supercontrol_model->get_measure_list();
	    $json_response['status'] = true;
	   $json_response['message'] = "Success";
	    echo json_encode($json_response);
            exit();
	   
	}
	
	public function get_items(){
	     $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	    $input = $this->input->post(NULL,TRUE);
	    if(isset($input['cat_id'])){
	        $json_response['item_list'] = $this->Supercontrol_model->get_item_list($input['cat_id'],$input['user_id']);
	        $json_response['measure_list'] = $this->Supercontrol_model->get_measure_list();
	        $json_response['status'] = TRUE;
	        $json_response['message'] = "Success";
	    }
	    echo json_encode($json_response);
        exit();
	}
	
	public function material_post() {
	    
             $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	        $input = $this->input->post(NULL,TRUE);
	        $input['camp_id'] = $input['user_id'];
	        
	        if($input['existing'] == 0){
	            
	        /*if($input['is_new']==1){
	            $input['item_id'] = $this->Supercontrol_model->add_item($input);
	        }
	        */
	        
	        //if($input['shortage']==1){
	        
	        
	            $request = json_decode($input['request'],TRUE);
	            
	            $input['req_id'] = $this->Supercontrol_model->add_request($input);
	            
	            foreach($request as $item){
    	            $item['volume'] = -$item['volume'];
    	            $item['req_id'] = $input['req_id'];
    	            $item['user_id'] = $input['user_id'];
    	            $item_id = $this->Supercontrol_model->add_material($item);
	            }
	            
	            
	             $status = $item_id?TRUE:FALSE;
	            $json_response['status'] = $status;
	            $json_response['message'] = "Material Added Successfully";
	            
	       /* } else if($input['shortage']==0){
	             
	            $item_id = $this->Supercontrol_model->add_material($input);
	            $status = $item_id?TRUE:FALSE;
	            $json_response['status'] = $status;
	            $json_response['message'] = "Material Added Successfully";
	        }*/
	        
	        } else {
	            
	           //if($input['shortage']==1){
	                foreach($request as $item){
        	            $item['volume'] = -$item['volume'];
        	            $item_id = $this->Supercontrol_model->update_material($item);
	                }
    	            $status = $item_id?TRUE:FALSE;
    	            $json_response['status'] = $status;
    	            $json_response['message'] = "Material Added Successfully";
    	            
    	        /*} else if($input['shortage']==0){
    	             
    	            $item_id = $this->Supercontrol_model->update_material($input);
    	            $json_response['status'] = TRUE;
    	            $json_response['message'] = "Material Added Successfully";
    	        }*/
	        }
	        
	        echo json_encode($json_response);
            exit();
    }
    
    public function material_requests(){
        
        $json_response['status'] = false;
	    $json_response['message'] = "Failed";
        $input = $this->input->post(NULL,TRUE);
        
        if(isset($input['user_id'])){
	            $json_response['material_requests'] = $this->Supercontrol_model->get_req_camp_list($input['user_id']);
	            $json_response['status'] = TRUE;
	            $json_response['message'] = "Success";
        } else {
            $json_response['status'] = FALSE;
        }
        echo json_encode($json_response);
        exit();
    }
    
    public function approve(){
        $json_response['status'] = false;
	    $json_response['message'] = "Failed";
        $input = $this->input->post(NULL,TRUE);
        
        if(isset($input['offer_id'])){
                $status = $this->Supercontrol_model->approve_offer($input);
                
                if($status){
	            $json_response['status'] = TRUE;
	            $json_response['message'] = "Success";
                }
        } else {
            $json_response['status'] = FALSE;
        }
        echo json_encode($json_response);
        exit();
    }
    
    public function add_offer(){
        $json_response['status'] = false;
	    $json_response['message'] = "Failed";
        $input = $this->input->post(NULL,TRUE);
        
        if($input){
	            $status = $this->Supercontrol_model->add_offer($input);
	            if($status){
	            $json_response['status'] = TRUE;
	            $json_response['message'] = "Success";
	            }
        } else {
            $json_response['status'] = FALSE;
        }
        echo json_encode($json_response);
        exit();
    }
    
    
    public function get_all_requests(){
        $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	    $input = $this->input->post(NULL,TRUE);
	    
	    $result = $this->Supercontrol_model->get_material_requests($input);
	    $json_response['result'] = $result;
	    $json_response['status'] = TRUE;
        $json_response['message'] = "Success";
	    echo json_encode($json_response);
        exit();
        
    }
    
    public function get_all_pending_requests(){
        $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	    $input = $this->input->post(NULL,TRUE);
	    
	    $result = $this->Supercontrol_model->get_pending_requests_data_api($input);
	    $json_response['result'] = $result;
	    $json_response['status'] = TRUE;
        $json_response['message'] = "Success";
	    echo json_encode($json_response);
        exit();
        
    }
    
    
    public function ngo_dashboard(){
	    $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	   $json_response['cat_list'] = $this->Supercontrol_model->get_cat_list();
	   $json_response['camp_list'] = $this->Supercontrol_model->get_camp_list();
	    $json_response['status'] = true;
	   $json_response['message'] = "Success";
	    echo json_encode($json_response);
            exit();
	   
	}
	
	public function dc_dashboard(){
	    $json_response['status'] = false;
	    $json_response['message'] = "Failed";
	   $json_response['pending_count'] = $this->Supercontrol_model->get_pending_requests();
	   $json_response['active_count'] = $this->Supercontrol_model->get_active_requests();
	   $json_response['mis_match'] = $this->Supercontrol_model->get_total_mis_match();
	    $json_response['status'] = true;
	   $json_response['message'] = "Success";
	    echo json_encode($json_response);
            exit();
	   
	}
	
	public function cancel_item() {
	    
        $json_response['status'] = false;
        $json_response['message'] = "Failed";
        $input = $this->input->post(NULL,TRUE);
        $input['camp_id'] = $input['user_id'];
        if($this->Supercontrol_model->checkExist($input['camp_id'],$input['item_id'],$input['req_id'])){
            
            $status = $this->Supercontrol_model->cancel_material($input);
            $status = $item_id?TRUE:FALSE;
            $json_response['status'] = $status;
            $json_response['message'] = "Material Added Successfully";
        
        } 
        echo json_encode($json_response);
        exit();
    }
	
    
    
}
