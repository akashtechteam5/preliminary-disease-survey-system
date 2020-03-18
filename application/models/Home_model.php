<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

    function getMembers($login_id){
        $this->db->where('login_id', $login_id);
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    public function getTotalUsersCount(){
        return $this->db->count_all_results('users');
    }
    
    public function getTodaysUsersCount(){
        $date_from = date('Y-m-d 00:00:00');
        $date_to = date('Y-m-d 23:59:59');
        $where = "date_added BETWEEN '$date_from' AND '$date_to'";
        $this->db->where($where);
        return $this->db->count_all_results('users');
    }
    
    public function yellowUsersCount(){
        $this->db->where('health_status','Y');
        return $this->db->count_all_results('users');
    }
    
    public function redUsersCount(){
        $this->db->where('health_status','R');
        return $this->db->count_all_results('users');
    }

    function getMembersListByReg($login_id){
        $this->db->from('users AS us');
        $this->db->join("login AS lo", "us.refer_login_id=lo.login_id", 'INNER');
        $this->db->where('level_user_type', 0);
        $this->db->group_by('us.login_id');
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    function getUserId($user_name){
        $user_id = 0;
        $query = $this->db->select('login_id')
                ->where('mobile_no',$user_name)
                ->where('status','yes')
                ->get('login');
        foreach ($query->result_array() as $res){
            $user_id = $res['login_id'];
        }
        return $user_id;
    }
                
    
    function registerMember($array){
        $this->db->set('login_id ',$array['login_id']);
        $this->db->set('gender',$array['gender']);
        $this->db->set('name',$array['name']);
        $this->db->set('state_id',$array['state']);
        $this->db->set('district_id',$array['district']);
        $this->db->set('panchayat_id',$array['panchayat']);
        $this->db->set('chc_id',$array['chc']);
        $this->db->set('age',$array['age']);
        $this->db->set('registered_by',$array['registered_by']);
        $this->db->set('added_by',$array['registered_by']);
        $this->db->set('village_id',0);
        $this->db->set('address',$array['address']);
        $this->db->set('contact_1',$array['mobile_number_1']);
        $this->db->set('contact_2',$array['mobile_number_2']);
        $this->db->set('contact_3',$array['mobile_number_3']);
        $this->db->set('vulnerability_status', $array['vulnerability_status']);
        if($this->db->insert('users')){
            $this->db->trans_commit();
            $this->addVulnerabilityHistory($array);
            return TRUE;
        } else {
            $this->db->trans_rollback();
        }
    }

    function addVulnerabilityHistory($arr){
        $data = array();
        $this->load->model('Common_model');
        $vulnerability = $this->Common_model->getVulnerabilityId();
        foreach($vulnerability as $row){
            if(array_key_exists($row, $arr)){
                $data[$row] = $arr[$row];
            }
        }
        $data['user_id'] = $arr['login_id'];
        $data['date'] = date("Y-m-d");
        $this->db->insert('vulnerability_updation_history', $data);
    }


}

