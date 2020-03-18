<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supercontrol_model extends CI_Model {

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

	public function show()
	{
		print_r($this->db->get("test")->result());
	}


	public function checkuser($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		return $this->db->count_all_results('users');	
	}
	
	public function checkusername($username)
	{
		$this->db->where('username',$username);
		return $this->db->count_all_results('users');	
	}

	public function getUserId($username)
	{
		$this->db->where('username',$username);
		$query = $this->db->get('users');
		$res = array();
		foreach ($query->result() as $row) {
            $res['id'] = $row->id;
            $res['user_type'] = $row->user_type;
        }
		
		return $res;	
	}
	
	public function getUserInfo($username)
	{
	    $this->db->select('id,user_type,name');
		$this->db->where('username',$username);
		$query = $this->db->get('users');	
		$result =  $query->result_array();
		return $result[0];	
	}
	
	
	

	public function cc_registration($input)
	{
		$this->db->insert('users',$input);

	}
	
	public function get_name_camp($input)
	{
		$this->db->where('id',$input);
        return $this->db->get('users')->row()->name;

	}
	
	public function get_name_item($input)
	{
		$this->db->where('item_id',$input);
        return $this->db->get('items')->row()->item_name;
	}
	

	public function add_area($input)
	{
		$this->db->insert('area',$input);	
	}

	public function add_cat($input)
	{
		$this->db->insert('categories',$input);	
	}

	public function get_area_list()
	{
		$this->db->select('*');
		$this->db->from('area');
		$query = $this->db->get();
		return $query->result_array();		
	}
	
	public function get_cat_list()
	{
		$this->db->select('*');
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result_array();		
	}

	public function get_ngo_list()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','ngo');
		$query = $this->db->get();
		return $query->result_array();		
	}
	
	public function get_camp_list()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','camp_coo');
		$this->db->order_by('username','ASC');
		$query = $this->db->get();
		return $query->result_array();		
	}


	public function check_item($name)
	{
		$this->db->select('*');
		$this->db->from('items');
		$query = $this->db->get();
		return $query->result_array();	
	}





/*
	public function sendFcm($message, $title, $arr_fcm_id = [])
    {

        $fcm_key = "AAAAXsAAkv8:APA91bF6nsoXUCro0OcHurRkvfTSGiJ5gQ2H9rUgLJujCr66Hs0XTL5vTYywBXOa-6FfRLBMnJtI9MCpLCerGY6HSe6iiQMyF2jncxQF5NHexW4mZaK0ndbxlELBM298aBuahU6EZyxd";
        $url = "https://fcm.googleapis.com/fcm/send";

        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $fcm_key
        ];

        $arr_fcm_id = [];
        $arr_fcm_id[] = "eTxEZIwH6bc:APA91bFE5dB4UWKg8jyzYPnucDt0Bdi9zEp9xA68VRtVKqANTK_lyHnzJ-aXkh1qokx-T3JprEwNRYH8w2TDN-WzuSg-Gpkh87sPN4CXOniefc7t6ZRKTCczrj8YGDhx_WYswqXUA2nT";

        $input_data = [
            'registration_ids' => $arr_fcm_id,
            'priority' => 'high',
            'content_available' => true,          
            'data' => [
                'msg_type' => 'trip_request',
            ]
        ];

        $input_data = [
            'registration_ids' => $arr_fcm_id,
            'priority' => 'high',
            'content_available' => true,          
            'notification' => [
                "body" => $message,
                "title" => $title,
                "icon" => "myicon"
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        echo ($response);
        curl_close($ch);

    }
 */   
    public function sendFcm($message, $title, $arr_fcm_id = [])
    {

        $fcm_key = "AAAAXsAAkv8:APA91bF6nsoXUCro0OcHurRkvfTSGiJ5gQ2H9rUgLJujCr66Hs0XTL5vTYywBXOa-6FfRLBMnJtI9MCpLCerGY6HSe6iiQMyF2jncxQF5NHexW4mZaK0ndbxlELBM298aBuahU6EZyxd";
        $url = "https://fcm.googleapis.com/fcm/send";

        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $fcm_key
        ];

        //$arr_fcm_id = [];
        //$arr_fcm_id[] = "eTxEZIwH6bc:APA91bFE5dB4UWKg8jyzYPnucDt0Bdi9zEp9xA68VRtVKqANTK_lyHnzJ-aXkh1qokx-T3JprEwNRYH8w2TDN-WzuSg-Gpkh87sPN4CXOniefc7t6ZRKTCczrj8YGDhx_WYswqXUA2nT";

        /*$input_data = [
            'registration_ids' => $arr_fcm_id,
            'priority' => 'high',
            'content_available' => true,          
            'data' => [
                'msg_type' => 'trip_request',
            ]
        ];*/

        $input_data = [
            'registration_ids' => $arr_fcm_id,
            'priority' => 'high',
            'content_available' => true,          
            'notification' => [
                "body" => $message,
                "title" => $title,
                "icon" => "myicon"
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        //echo ($response);
        curl_close($ch);

    }
    
	public function get_item_list($cat_id,$userid)
	{
		$this->db->select('*');
		$this->db->from('items');
		$this->db->where('cat_id',$cat_id);
		$query = $this->db->get();
		$result = array();
		foreach($query->result_array() as $row){
		    /*$exists = $this->checkRequests($row['item_id'],$userid);
		    if($exists){
		        $row['volume'] = $exists[0]['needed'];
		    }*/
		    $result[] = $row;
		}	
		
		return $result;
	}
	
	public function checkRequests($itemid,$userid)
	{
		$this->db->select('*');
		$this->db->from('materials');
		$this->db->where('camp_id',$userid);
		$this->db->where('item_id',$itemid);
		$query = $this->db->get();
		return $query->result_array();
	}
    
    public function add_item($input)
	{
		$this->db->set('item_name',$input['item_name']);
		//$this->db->set('item_desc',$input['item_desc']);
		$this->db->set('cat_id',$input['cat_id']);
		$this->db->insert('items');
		return $this->db->insert_id();
	}
    
    public function add_material($input)
	{
	    $this->db->set('req_id',$input['req_id']);
		$this->db->set('item_id',$input['item_id']);
		$this->db->set('camp_id',$input['user_id']);
		$this->db->set('needed',$input['volume']);
		$this->db->set('unit',$input['measure_id']);
		$this->db->set('priority',$input['priority']);
		$this->db->set('req_desc',$input['req_desc']);
		$this->db->insert('materials');
		return $this->db->insert_id();
	}
	
	public function update_material($input)
	{
	    $this->db->where('req_id',$input['req_id']);
		$this->db->where('item_id',$input['item_id']);
		$this->db->where('camp_id',$input['camp_id']);
		$this->db->set('needed','needed +'.$input['volume'],FALSE);
		$this->db->set('priority',$input['priority']);
		$query = $this->db->update('materials');
		
		return $query;
	}
	
	public function get_item_camp_list($user_id)
	{
	    $this->db->select('*');
		$this->db->from('materials as mt');
		$this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
		$this->db->join("items AS it", "mt.item_id=it.item_id", 'INNER');
		$this->db->where('mt.camp_id',$user_id);
		$this->db->where('mt.needed !=',0);
		$query = $this->db->get();
		$result = array();
		foreach($query->result_array() as $row){
		    $offers = $this->get_offer_camp_item_list($row['item_id'],$row['camp_id']);
		    $total_offers = 0;
		    foreach($offers as $offer){
		        $total_offers += $offer['offered'];
		    }
		    $row['total_offers'] = $total_offers;
		    $row['offers'] = $offers;
		    $result[]=$row;
		}
		print_r($result);die;
	    return $result;
	}
	
	public function get_req_camp_list($user_id)
	{
	    $this->db->select('rq.req_id,rq.date');
		$this->db->from('requests as rq');
		$this->db->join("materials AS mt", "rq.req_id=mt.req_id", 'INNER');
		$this->db->where('mt.camp_id',$user_id);
		$this->db->where('mt.needed !=',0);
		$this->db->group_by('rq.req_id');
		$query = $this->db->get();
		$result = array();
		$i=0;
		foreach($query->result_array() as $row){
		    $result[$i]['req_id'] = $row['req_id'];
		    $result[$i]['items'] = $this->get_item_camp_req_list($row['req_id']);
		    $result[$i]['date'] = $row['date'];
		    $i++;
		}

	    return $result;
	}
	
	public function get_item_camp_req_list($req_id)
	{
	    $this->db->select('*');
		$this->db->from('materials as mt');
		$this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
		$this->db->join("items AS it", "mt.item_id=it.item_id", 'INNER');
		$this->db->where('mt.req_id',$req_id);
		$this->db->where('mt.needed !=',0);
		$query = $this->db->get();
		$result = array();
		foreach($query->result_array() as $row){
		    $offers = $this->get_offer_camp_item_list($row['item_id'],$row['camp_id']);
		    $total_offers = 0;
		    foreach($offers as $offer){
		        $total_offers += $offer['offered'];
		    }
		    $row['total_offers'] = $total_offers;
		    $row['offers'] = $offers;
		    $result[]=$row;
		}
	    return $result;
	}
	
	
	
	
	public function get_offer_camp_item_list($item_id,$camp_id)
	{
	    $this->db->select('ngo.*,f1.name,f1.mobile_number_1,f1.mobile_number_2,f1.mobile_number_3');
		$this->db->from('ngo_offers as ngo');
		$this->db->join("users AS f1", "ngo.ngo_id=f1.id", 'INNER');
		
		$this->db->where('ngo.camp_id',$camp_id);
		$this->db->where('ngo.item_id',$item_id);
		$this->db->where('approved',"no");
		$query = $this->db->get();
		return $query->result_array();
  
	}
	
	public function get_dashboard_data(){
	    $this->db->where('user_type','camp_coo');
	    $result['camp_count'] = $this->db->count_all_results('users');	
	    
	    $this->db->where('user_type','ngo');
	    $result['ngo_count'] = $this->db->count_all_results('users');
	    
        
        $result['active_count'] = $this->get_active_requests();
        
        $result['pending_count'] = $this->get_pending_requests();
        
        $result['missing_count'] = $this->get_total_mis_match();
        
	    $this->db->select('*');
	    $this->db->from('materials as mt');
	    $this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
	    $this->db->join("items AS it", "it.item_id=mt.item_id", 'INNER');
	    $this->db->join("users AS f1", "mt.camp_id=f1.id", 'INNER');
	    $this->db->join("categories AS ct", "ct.cat_id=it.cat_id", 'INNER');
	    $this->db->where('needed <',0);
        $query = $this->db->get();
	    $result['table_data'] = $query->result_array();
	    return $result;
	}
	
	
	
	public function approve_offer($input)
	{
	    
	    $this->db->where('offer_id',$input['offer_id']);
        $offered = $this->db->get('ngo_offers')->row()->offered;
	    
	    $remaining_offered = $offered - $input['volume'];
	    

	        $this->db->set("approved",'yes');
    	    $this->db->set("offered",$input['volume']);
    	    $this->db->where("offer_id", $input['offer_id']);
    	    $query = $this->db->update("ngo_offers"); 
	    
	    
	    if($query){
	        
	        $this->db->select('item_id,camp_id,req_id,offered');
	        $this->db->from('ngo_offers');
	        $this->db->where("offer_id", $input['offer_id']);
	        $query = $this->db->get();
	        foreach($query->result_array() as $row){
	            $input['item_id'] =  $row['item_id'];
	            $input['camp_id'] =  $row['camp_id'];
	            $input['req_id'] =  $row['req_id'];
	        }
	        
	        
	        $this->db->set('needed','needed +'.$input['volume'],FALSE);
	        $this->db->where('item_id',$input['item_id']);
	        $this->db->where('camp_id',$input['camp_id']);
	        $this->db->where('req_id',$input['req_id']);
		    $status = $this->db->update('materials');
		    return $status;
	    }
	    return FALSE;
	}
	
	public function add_offer($input)
	{
	    $this->db->set("ngo_id",$input['user_id']);
	    $this->db->set("offered",$input['offered']);
	    $this->db->set("initial_offered",$input['offered']);
	    $this->db->set("camp_id",$input['camp_id']);
	    $this->db->set("item_id",$input['item_id']);
	    $this->db->set("req_id",$input['req_id']);
	    $this->db->insert('ngo_offers');
	    return $this->db->insert_id();
	}
	
	public function get_material_requests($input) {
	    $this->db->select('mt.*,it.*,us.*,ct.*');
	    $this->db->from('materials as mt');
	    $this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
	    $this->db->join("items AS it", "it.item_id=mt.item_id", 'INNER');
	    $this->db->join("categories AS ct", "it.cat_id=ct.cat_id", 'INNER');
	    $this->db->join("users AS us", "mt.camp_id=us.id", 'INNER');
	    $this->db->where('mt.needed <',0);
	    if(isset($input['cat_id'])&&$input['cat_id']!=0&&$input['cat_id']!=''){
	        
	        $this->db->where('it.cat_id',$input['cat_id']);
	    }
	    if(isset($input['item_id'])&&$input['item_id']!=0&&$input['item_id']!=''){
	        $this->db->where('mt.item_id',$input['item_id']);
	    }
	    if(isset($input['camp_id'])&&$input['camp_id']!=0&&$input['camp_id']!=''){
	        $this->db->where('mt.camp_id',$input['camp_id']);
	    }
	    
	    $query = $this->db->get();
		//return $query->result_array();
		$result = array();
		foreach($query->result_array() as $row){
		    $offers = $this->getTotalOffers($row['item_id'],$row['camp_id'],$row['req_id']);
		    $total_offers = $offers[0]['total_offers'];
		    if($total_offers == ''){
		        $total_offers = 0;
		    }
		    /*foreach($offers as $offer){
		        $total_offers += $offer['offered'];
		    }*/
		    $row['total_offers'] = $total_offers;
		    //$row['offers'] = $offers;
		    $result[]=$row;
		}
		return $result;
		
	    
	}
	
	public function getTotalOffers($item_id,$camp_id,$req_id){
	    $this->db->select_sum('offered','total_offers');
	    $this->db->from('ngo_offers');
		$this->db->where('camp_id',$camp_id);
		$this->db->where('item_id',$item_id);
		$this->db->where('req_id',$req_id);
		$this->db->where('approved',"no");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	
	public function get_all_item()
	{
	    $i = 0;
	    $data = array();
		$this->db->select('c.category_name,i.item_id,i.item_name');
		$this->db->from('items as i');
		$this->db->join("categories AS c", "c.cat_id=i.cat_id", 'INNER');
		$this->db->order_by('i.item_name','ASC');
		$query = $this->db->get();
		foreach($query->result_array() as $res){
		    $data[$i] = $res;
		    $data[$i]['request_count'] = $this->get_request_count_by_item($res['item_id']);
		    $i++;
		}
		return $data;
	}
	
	function get_request_count_by_item($item_id){
	    return $this->db->where('needed <',0)->where('item_id',$item_id)->count_all_results('materials');
	}
	
	public function get_measure_list()
	{
		$this->db->select('measure_id,unit');
		$this->db->from('quantity_unit');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function get_dashboard_data_count(){

	    $this->db->select('*');
	    $this->db->from('materials as mt');
	    $this->db->join("items AS it", "it.item_id=mt.item_id", 'INNER');
	    $this->db->join("users AS f1", "mt.camp_id=f1.id", 'INNER');
	    $this->db->join("categories AS ct", "ct.cat_id=it.cat_id", 'INNER');
        $query = $this->db->get();
        $count = $query->num_rows();
	    return $count;
	}
	
	public function insertOfferedItem($item_id,$req_id,$ngo_id,$offer){
	    $camp_id = 0;
	    $this->db->select('camp_id');
	    $this->db->from('materials');
	    $this->db->where('item_id',$item_id);
	    $this->db->where('req_id',$req_id);
	    $query = $this->db->get();
	    foreach($query->result() as $row){
	        $camp_id = $row->camp_id;
	    }
	    $res = false;
	    if($camp_id){
	        $data = array('user_id'=>$ngo_id,
	                   'offered'=>$offer,
	                   'initial_offered'=>$offer,
	                   'camp_id'=>$camp_id,
	                   'item_id'=>$item_id,
	                   'req_id'=>$req_id
	                   );
	                   $res = $this->add_offer($data);
	    }
	    return $res;
	}
	
	public function get_pending_requests(){
	    $this->db->select('COUNT(DISTINCT(camp_id)) as pending_count');
	    $this->db->from('ngo_offers');
	    $this->db->where("approved","no");
	    $query = $this->db->get();
	    //print_r($query->result_array());die;
	    foreach($query->result() as $row){
	        $count = $row->pending_count;
	    }
	    ///print_r($count);die;
	    return $count;
	}
	
	public function get_active_requests(){
	    $this->db->select('COUNT(DISTINCT(camp_id)) as active_count');
	    $this->db->from('materials');
	    $this->db->where("needed <",0);
	    $query = $this->db->get();
	    //print_r($query->result_array());die;
	    foreach($query->result() as $row){
	        $count = $row->active_count;
	    }
	    ///print_r($count);die;
	    return $count;
	}
	
	public function get_pending_requests_data(){
	    $this->db->select('*');
	    $this->db->from('materials as mt');
	    $this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
	    $this->db->join("items AS it", "it.item_id=mt.item_id", 'INNER');
	    $this->db->join("users AS f1", "mt.camp_id=f1.id", 'INNER');
	    $this->db->join("categories AS ct", "ct.cat_id=it.cat_id", 'INNER');
	    $this->db->join("ngo_offers AS ngo", "ngo.item_id=mt.item_id", 'INNER');
	    $this->db->where('approved','no');
        $query = $this->db->get();
$result = array();
        foreach($query->result_array() as $row){
		    $offers = $this->getTotalOffers($row['item_id'],$row['camp_id'],$row['req_id']);
		    $total_offers = $offers[0]['total_offers'];
		    if($total_offers == ''){
		        $total_offers = 0;
		    }
		    /*foreach($offers as $offer){
		        $total_offers += $offer['offered'];
		    }*/
		    $row['total_offers'] = $total_offers;
		    //$row['offers'] = $offers;
		    $result[]=$row;
		}
		
	    $result['table_data'] = $result;
	    
	    return $result;
	}
	
	
	public function get_pending_requests_data_api($input){
	    $this->db->select('*');
	    $this->db->from('materials as mt');
	    $this->db->join("requests AS rq", "rq.req_id=mt.req_id", 'INNER');
	    $this->db->join("items AS it", "it.item_id=mt.item_id", 'INNER');
	    $this->db->join("users AS f1", "mt.camp_id=f1.id", 'INNER');
	    $this->db->join("categories AS ct", "ct.cat_id=it.cat_id", 'INNER');
	    $this->db->join("ngo_offers AS ngo", "ngo.item_id=mt.item_id", 'INNER');
	    $this->db->where('approved','no');
	    
	    if(isset($input['cat_id'])&&$input['cat_id']!=0&&$input['cat_id']!=''){
	        
	        $this->db->where('it.cat_id',$input['cat_id']);
	    }
	    if(isset($input['item_id'])&&$input['item_id']!=0&&$input['item_id']!=''){
	        $this->db->where('mt.item_id',$input['item_id']);
	    }
	    if(isset($input['camp_id'])&&$input['camp_id']!=0&&$input['camp_id']!=''){
	        $this->db->where('mt.camp_id',$input['camp_id']);
	    }
	    
        $query = $this->db->get();
        $result = array();
        foreach($query->result_array() as $row){
		    $offers = $this->getTotalOffers($row['item_id'],$row['camp_id'],$row['req_id']);
		    $total_offers = $offers[0]['total_offers'];
		    if($total_offers == ''){
		        $total_offers = 0;
		    }
		    /*foreach($offers as $offer){
		        $total_offers += $offer['offered'];
		    }*/
		    $row['total_offers'] = $total_offers;
		    //$row['offers'] = $offers;
		    $result[]=$row;
		}
		

	    
	    return $result;
	}
	
	public function add_request($input)
	{
		$this->db->set('status',"requested");
		$this->db->insert('requests');
		return $this->db->insert_id();
	}
	
	public function get_camp_count(){
	    return $this->db->where('user_type','camp_coo')->count_all_results('users');
	}
	
	public function get_camp_list_new($page,$limit)
	{
	    $i = 0;
	    $data = array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_type','camp_coo');
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		foreach($query->result_array() as $res){
		    $data[$i] = $res;
		    $data[$i]['request_count'] = $this->get_request_count($res['id']);
		    $i++;
		}
		
		return $data;		
	}
	
	function get_request_count($camp_id){
	    return $this->db->where('needed <',0)->where('camp_id',$camp_id)->count_all_results('materials');
	}
	
	function checkExist($camp_id,$item_id,$req_id){
	    return $this->db->where('needed <',0)->where('camp_id',$camp_id)->where('item_id',$item_id)->where('req_id',$req_id)->count_all_results('materials');
	}

	public function cancel_material($input)
	{
	    $this->db->set('req_id',$input['req_id']);
		$this->db->set('item_id',$input['item_id']);
		$this->db->set('camp_id',$input['user_id']);
		$this->db->set('needed',0);
		return $this->db->update('materials');
	}
	
	public function get_total_mis_match(){
	    $received = 0;
	    $send = 0;
	    $this->db->select_sum('offered','received');
	    $this->db->select_sum('initial_offered','send');
	    $query = $this->db->where('approved','yes')->get('ngo_offers');
	    foreach($query->result_array() as $res){
	        $received = $res['received'];
	        $send = $res['send'];
	    }
	    $missing = $send - $received;
	    return $missing;
	    
	}
	
	public function get_ngo_missing_list($page,$limit)
	{
	    $i = 0;
	    $data = array();
		$this->db->select('*,(initial_offered - offered) as mis');
		$this->db->from('ngo_offers');
		$this->db->where('approved','yes');
		$this->db->where('(initial_offered - offered) >',0);
		$this->db->limit($limit,$page);
		$query = $this->db->get();
		foreach($query->result_array() as $res){
		    $data[$i] = $res;
		    $data[$i]['item_name'] = $this->get_name_item($res['item_id']);
		    $data[$i]['camp_name'] = $this->get_name_camp($res['camp_id']);
		    $i++;
		}
		
		return $data;		
	}
}