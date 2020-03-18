<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {

    function isAlreadyregistered($number){
        $this->db->where('mobile_no', $number);
        $this->db->from('login');
        return $this->db->count_all_results();
    }

    function registerUser($array){
        //print_r($array);die;
        $this->db->trans_begin();

        $this->db->set('mobile_no',$array['mobile']);
        $this->db->set('password',sha1($array['password']));
        if(isset($array['registered_by']))
            $this->db->set('registered_by',$array['registered_by']);
        $this->db->insert('login');
        $login_id = $this->db->insert_id();

        if($login_id){
            $this->db->set('login_id ',$login_id);
            $this->db->set('gender',$array['gender']);
            $this->db->set('name',$array['name']);
            $this->db->set('state_id',$array['state']);
            $this->db->set('district_id',$array['district']);
            $this->db->set('panchayat_id',$array['panchayat']);
            if(isset($array['chc'])){
                $this->db->set('chc_id',$array['chc']);
            }
            $this->db->set('age',$array['age']);
            $this->db->set('refer_login_id',$login_id);
            if(isset($array['registered_by'])){
                $this->db->set('registered_by',$array['registered_by']);
                $this->db->set('added_by',$array['registered_by']);
            }
            $this->db->set('village_id',0);
            $this->db->set('address',$array['address']);
            $this->db->set('contact_1',$array['mobile_number_1']);
            $this->db->set('contact_2',$array['mobile_number_2']);
            $this->db->set('contact_3',$array['mobile_number_3']);
            if($this->db->insert('users')){
                $this->db->trans_commit();
                return $login_id;
            } else {
                $this->db->trans_rollback();
            }
        } else {
            $this->db->trans_rollback();
        }

        return FALSE;
    }

    function registerLevelUser($array){
        //print_r($array);die;
        $this->db->trans_begin();

        $this->db->set('mobile_no',$array['login_id']);
        $this->db->set('password',sha1($array['password']));
        $this->db->set('level_user_type',$array['level']);
        $this->db->insert('login');
        $login_id = $this->db->insert_id();

        if($login_id){
            $this->db->set('login_id ',$login_id);
            $this->db->set('gender','');
            $this->db->set('name','');
            $this->db->set('state_id',$array['state']);
            $this->db->set('district_id',$array['district']);
            $this->db->set('panchayat_id',$array['panchayat']);
            $this->db->set('chc_id',$array['chc']);
            $this->db->set('age',$array['age']);
            $this->db->set('registered_by',$array['registered_by']);
            $this->db->set('village_id',0);
            $this->db->set('address','');
            $this->db->set('contact_1',$array['mobile_number_1']);
            $this->db->set('contact_2',$array['mobile_number_2']);
            $this->db->set('contact_3',$array['mobile_number_3']);
            if($this->db->insert('users')){
                $this->db->trans_commit();
                return TRUE;
            } else {
                $this->db->trans_rollback();
            }
        } else {
            $this->db->trans_rollback();
        }

        return FALSE;
    }

}