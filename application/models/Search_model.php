<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

    public $dbforge;

    function __construct() {
            parent::__construct();
            $this->dbforge = $this->load->dbforge($this->db, TRUE);

    }
    
    public function check_forge(){
        $fields = array(
            'sample_1' => array('type' => 'TEXT')
        );
        $this->dbforge->add_column('user_custom_info', $fields);
    }


    function getLoginId($mobile_no){
        $login_id = 0;
        $this->db->select('login_id');
        $this->db->where('mobile_no',$mobile_no);
        $this->db->where('level_user_type',0);
        $query = $this->db->get('login');
        //print_r($this->db->last_query());die;
        foreach($query->result() as $row){
            $login_id = $row->login_id;
        }
        return $login_id;
    }

    function getUsers($login_id){
            $this->db->select('id,name,gender,age');
            $this->db->where('login_id',$login_id);
            $query = $this->db->get('users');
            return $query->result_array();
    }

    function getLoginIdFromUserID($user_id){
            $login_id = 0;
            $this->db->select('login_id');
            $this->db->where('id',$user_id);
            $query = $this->db->get('users');
            foreach($query->result() as $row){
                $login_id = $row->login_id;
            }
            return $login_id;
    }
    
    function getUsernameById($user_id){
            $mobile = '';
            $this->db->select('mobile_no');
            $this->db->where('login_id',$user_id);
            $query = $this->db->get('login');
            foreach($query->result() as $row){
                $mobile = $row->mobile_no;
            }
            return $mobile;
    }

    function getUserDetails($user_id){
            $this->db->select('id,name,gender,age');
            $this->db->where('id',$user_id);
            $query = $this->db->get('users');
            return $query->result_array()[0];
    }
}