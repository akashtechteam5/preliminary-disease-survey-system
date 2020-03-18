<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    
    public function login($username, $password) {

        if ($username && $password) {
            $password = sha1($password);
            $this->db->select('login_id, mobile_no, password, level_user_type');
            $this->db->where('mobile_no', $username);
            $this->db->where('password', $password);
            $this->db->where('status', "yes");
            $this->db->limit(1);
            $query = $this->db->get('login');
            $count = $query->num_rows();
        } else {
            return false;
        }
        
        if ($count == 1) {
            $user_details = $query->result_array()[0];
            $login_id = $user_details['login_id'];
            $this->db->set('last_login',date('Y-m-d H:i:s'))->where('login_id',$login_id)->update('login');
            return $user_details;
        } else {
            return false;
        }
    }
    
    public function setUserSessionDatas($login_result) {
        $sess_array = array();
            
        $sess_array = array(
            'user_id' => $login_result['login_id'],
            'user_name' => $login_result['mobile_no'],
            'user_type' => $login_result['level_user_type'],
            'is_logged_in' => true
        );
        
        $this->session->set_userdata('co_logged_in', $sess_array);
    }

}