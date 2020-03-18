<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Approve_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Approve_model');
    }

    public function get_l3_approve_count() {
        $this->db->where('approve_3', '0');
        return $this->db->count_all_results('users');
    }

    public function get_l3_approve_list($page, $limit) {
        $key = 'IOSS#z0!6';
        $data = array();
        $i = 1;
        $this->db->select('us.name,us.approve_3,us.gender,us.address,lo.mobile_no');
        $this->db->from('users as us');
        $this->db->join("login AS lo", "us.login_id=lo.login_id", 'INNER');
        $this->db->where('us.approve_3', 0);
        $query = $this->db->get();
        foreach ($query->result_array() as $res) {
            $data[$i] = $res;
            $data[$i]['user_enc'] = $this->encrypt($key,$res['mobile_no']);
            $i++;
        }
        return $data;
    }

    public function update_l3_status($id, $status) {
        $this->db->where('login_id', $id);
        $this->db->set('approve_3', $status);
        $query = $this->db->update('users');
        return $query;
    }

    public function getUserId($mobile_no) {
        $user_id = 0;
        $this->db->select('login_id');
        $this->db->where('mobile_no', $mobile_no);
        $query = $this->db->get('login');
        $res = array();
        foreach ($query->result_array() as $row) {
            $user_id = $row['login_id'];
        }
        return $user_id;
    }

    public function get_l2_approve_count() {
        $this->db->where('approve_3', '1');
        $this->db->where('approve_2', '0');
        return $this->db->count_all_results('users');
    }

    public function get_l2_approve_list($page, $limit) {
        $data = array();
        $i = 1;
        $this->db->select('us.name,us.approve_2,us.gender,us.address,lo.mobile_no');
        $this->db->from('users as us');
        $this->db->join("login AS lo", "us.login_id=lo.login_id", 'INNER');
        $this->db->where('us.approve_3', 1);
        $this->db->where('us.approve_2', 0);
        $query = $this->db->get();
        foreach ($query->result_array() as $res) {
            $data[$i] = $res;
            $i++;
        }
        return $data;
    }

    public function update_l2_status($id, $status) {
        $this->db->where('login_id', $id);
        $this->db->set('approve_2', $status);
        $query = $this->db->update('users');
        return $query;
    }

    public function encrypt($key, $toEncrypt) {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $toEncrypt, MCRYPT_MODE_CBC, md5(md5($key))));
    }

    function decrypt($key, $toDecrypt) {
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($toDecrypt), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    }
    
    public function getPendingSymptomsCount($user_level) {
        if ($user_level == 2) {
            $this->db->where('approval_l3', 1);
            $this->db->where('approval_l2', 0);
        } else {
            $this->db->where('approval_l3', 0);
        }
        $this->db->group_by('user_id');
        $count = $this->db->count_all_results('symptoms_updation_history');
        return $count;
    }
    
    public function getPendingSymptoms($page, $limit, $user_level) {
        $key = 'IOSS#z0!6';
        $details = array();
        $i = 0;
        $this->db->select('MAX(sy.id) as symp_id,sy.user_id,sy.date,ud.name,ud.contact_1,ud.address');
        $this->db->from('symptoms_updation_history as sy');
        $this->db->join('users as ud', 'sy.user_id = ud.id');
        if ($user_level == 2) {
            $this->db->where('sy.approval_l3', 1);
            $this->db->where('sy.approval_l2', 0);
        } else {
            $this->db->where('sy.approval_l3', 0);
        }
        $this->db->group_by('sy.user_id', 'DESC');
        $query = $this->db->get();
        foreach ($query->result_array() as $row){
            $details[$i] = $row;
            $details[$i]['id_enc'] = urlencode($this->encrypt($key,$row['symp_id']));
            $i++;
        }
        return $details;
    }
    
    public function getSymptomUserById($symp_id, $user_level) {
        $user_id = 0;
        $this->db->select('user_id');
        if ($user_level == 2) {
            $this->db->where('approval_l3', 1);
            $this->db->where('approval_l2', 0);
        } else {
            $this->db->where('approval_l3', 0);
        }
        $this->db->where('id', $symp_id);
        $query =  $this->db->get('symptoms_updation_history');
        foreach ($query->result() as $row) {
            $user_id = $row->user_id;
        }
        return $user_id;
    }
    
    public function updateUserSymptoms($sym_id, $data) {
        $this->db->where('id', $sym_id);
        $query = $this->db->update('symptoms_updation_history', $data);
        return $query;
    }
    
    public function insertSymptomApprovalHistory($user_id, $user_type, $sym_id) {
        $this->db->set('user_id', $user_id);
        $this->db->set('user_type', $user_type);
        $this->db->set('sym_id', $sym_id);
        $this->db->set('date', date('Y-m-d H:i:s'));
        $query = $this->db->insert('symptom_approval_history');
        return $query;
    }

}
