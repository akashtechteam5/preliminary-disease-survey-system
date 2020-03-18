<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_model extends CI_Model {
    private $obj_xml;
    public function __construct() {
        parent::__construct();
        $this->load->model('supercontrol_model');
        require_once 'excel/class-excel-xml.inc.php';
        $this->obj_xml = new Excel_XML();
    }

	public function get_dashboard_data(){
	    $data = $this->supercontrol_model->get_dashboard_data();
	    $data = $data['table_data'];
	    $count = count($data);
        $excel_array[1] = array('Categories', 'Item', 'Camp', 'Shortage/Excess','Date');
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            $excel_array[$i][0] = $data[$j]["category_name"];
            $excel_array[$i][1] = $data[$j]["item_name"];
            $excel_array[$i][2] = $data[$j]["name"];
            $excel_array[$i][3] = $data[$j]["needed"];
            $excel_array[$i][4] = $data[$j]["date"];
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
	}
	
	public function get_ngo_list(){
	    $data = $this->supercontrol_model->get_ngo_list();
	    $count = count($data);
        $excel_array[1] = array('No', 'Username', 'Name', 'Landmark','State','District','Pin','Mobile 1','Mobile 2','Mobile 3','Date');
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            $excel_array[$i][0] = $j+1;
            $excel_array[$i][1] = $data[$j]["username"];
            $excel_array[$i][2] = $data[$j]["name"];
            $excel_array[$i][3] = $data[$j]["landmark"];
            $excel_array[$i][4] = $data[$j]["state"];
            $excel_array[$i][5] = $data[$j]["district"];
            $excel_array[$i][6] = $data[$j]["pin"];
            $excel_array[$i][7] = $data[$j]["mobile_number_1"];
            $excel_array[$i][8] = $data[$j]["mobile_number_2"];
            $excel_array[$i][9] = $data[$j]["mobile_number_3"];
            $excel_array[$i][10] = $data[$j]["date"];
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
	}
	
	public function get_camp_list(){
	    $data = $this->supercontrol_model->get_camp_list();
	    $count = count($data);
        $excel_array[1] = array('No', 'Username', 'Name', 'Landmark','State','District','Pin','Mobile 1','Mobile 2','Mobile 3','Date');
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            $excel_array[$i][0] = $j+1;
            $excel_array[$i][1] = $data[$j]["username"];
            $excel_array[$i][2] = $data[$j]["name"];
            $excel_array[$i][3] = $data[$j]["landmark"];
            $excel_array[$i][4] = $data[$j]["state"];
            $excel_array[$i][5] = $data[$j]["district"];
            $excel_array[$i][6] = $data[$j]["pin"];
            $excel_array[$i][7] = $data[$j]["mobile_number_1"];
            $excel_array[$i][8] = $data[$j]["mobile_number_2"];
            $excel_array[$i][9] = $data[$j]["mobile_number_3"];
            $excel_array[$i][10] = $data[$j]["date"];
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
	}
	
	public function get_all_item(){
	    $data = $this->supercontrol_model->get_all_item();
	    $count = count($data);
        $excel_array[1] = array('No', 'Item name');
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            $excel_array[$i][0] = $j+1;
            $excel_array[$i][1] = $data[$j]["item_name"];
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
	}
	
	public function get_material_requests($input){
	    $data = $this->supercontrol_model->get_material_requests($input);
	    $count = count($data);
        $excel_array[1] = array('Categories', 'Item', 'Camp', 'Shortage/Excess','Offered');
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            $excel_array[$i][0] = $data[$j]["category_name"];
            $excel_array[$i][1] = $data[$j]["item_name"];
            $excel_array[$i][2] = $data[$j]["name"];
            $excel_array[$i][3] = $data[$j]["needed"];
            $excel_array[$i][4] = $data[$j]["total_offers"];
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
	}
	
	public function replaceNullFromArray($user_detail, $replace = '') {
        if ($replace == '') {
            $replace = "NA";
        }
        $len = count($user_detail);
        $key_up_arr = array_keys($user_detail);
        for ($i = 1; $i <= $len; $i++) {
            $k = $i - 1;
            $fild = $key_up_arr[$k];
            $arr_key = array_keys($user_detail["$fild"]);
            $key_len = count($arr_key);
            for ($j = 0; $j < $key_len; $j++) {
                $key_field = $arr_key[$j];
                if ($user_detail["$fild"]["$key_field"] == "") {
                    $user_detail["$fild"]["$key_field"] = $replace;
                }
            }
        }
        return $user_detail;
    }
    
    public function writeToExcel($doc_arr, $file_name) {
        $this->obj_xml->addArray($doc_arr);
        $this->obj_xml->generateXML("$file_name");
    }
    
    function get_user_data() {
        
        $this->db->select('ud.id,l.mobile_no as User,ud.name as Name,ud.gender as Gender,ud.age as Age,s.state_name as State,d.district_name as District,p.panchayat_name as Panchayath,c.chc_name as CHC,ud.date_added as Registered Date');
        $this->db->from('users as ud');
        $this->db->join('states as s','ud.state_id=s.state_id','inner');
        $this->db->join('districts as d','ud.district_id=d.district_id','inner');
        $this->db->join('panchayat as p','ud.panchayat_id=p.panchayat_id','inner');
        $this->db->join('login as l','ud.login_id=l.login_id','inner');
        $this->db->join('chcs as c','c.chc_id=ud.chc_id','left');
        $query = $this->db->get();
        $users = $query->result_array();

        $titles = ['User','Name','Gender','Age','State','District','Panchayath','CHC','Registered Date','Updated Date'];
        $symptoms_array = $this->db->select("id, symptom")->where("status", 1)->get("symptoms")->result_array();
        $symptoms = [];
        if(count($symptoms_array)) {
            $symptoms = array_column($symptoms_array, "symptom");
        }
        $titles = array_merge($titles, $symptoms);
        
        foreach ($users as $key => $user){
            $symtomps_updation = $this->getSymptomps($user['id']);
            $users[$key]["Updated Date"] = 'NA';
            
            foreach ($symptoms_array as $value2){
                
                $users[$key][$value2['symptom']] = 'NA';
                if(isset($symtomps_updation[0]["symptom_{$value2['id']}"])){
                    $users[$key][$value2['symptom']] = $symtomps_updation[0]["symptom_{$value2['id']}"]==1?'Yes':'No';
                }
                
            }
            if(isset($symtomps_updation[0]["date"])){
                $users[$key]["Updated Date"] = $symtomps_updation[0]["date"];
            }
        }

        $count = count($users);

        $excel_array[1] = $titles;
        for ($i = 2; $i <= $count + 1; $i++) {
            $j = $i - 2;
            foreach ($titles as $key=>$value3){
                $excel_array[$i][$key] = $users[$j][$value3]??'NA';
            }
        }
        $excel_array = $this->replaceNullFromArray($excel_array);
        return $excel_array;
    }
    
    function getSymptomps($user_id){
        $this->db->where('user_id',$user_id);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get('symptoms_updation_history');
        
        return $query->result_array();
    }
    function getSymptomName($id){
        $this->db->where('id',$id);
        $query = $this->db->get('symptoms');
        return $query->row_array()['symptom']??'';
    }
    
    function getDefaultSymptomps(){
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get('symptoms_updation_history');
        $i=1;
        $arr = [];
        foreach ($query->row_array() as $key=>$value){
            if($i>5 || $i==3){ 
            $symptom = $this->getSymptomName($i-5);
            $arr[$symptom] = '';
            }
            $i++;
        }
        
        return $arr;
    }
    
}