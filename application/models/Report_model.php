<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function getAllUsers($filters = [], $limit = "", $offset = "")
    {
        $this->db->select("u.*, st.state_name, di.district_name, pn.panchayat_name");
        $this->db->from("users as u");
        $this->db->join("states as st", "st.state_id = u.state_id", "left");
        $this->db->join("districts as di", "di.district_id = u.district_id", "left");
        $this->db->join("panchayat as pn", "pn.panchayat_id = u.panchayat_id", "left");

        $this->db->where("u.id >", 0);
        
        if(isset($filters['state_id']) && $filters['state_id']) {
            $this->db->where("u.state_id", $filters['state_id']);
        }

        if(isset($filters['district_id']) && $filters['district_id']) {
            $this->db->where("u.district_id", $filters['district_id']);
        }

        if(isset($filters['panchayat_id']) && $filters['panchayat_id']) {
            $this->db->where("u.panchayat_id", $filters['panchayat_id']);
        }

        if(isset($filters['name']) && $filters['name']) {
            $this->db->like("u.name", $filters['name']);
        }

        if(isset($filters['mobile']) && $filters['mobile']) {
            $this->db->group_start();
            $this->db->like("u.contact_1", $filters['mobile']);
            $this->db->or_like("u.contact_2", $filters['mobile']);
            $this->db->or_like("u.contact_3", $filters['mobile']);
            $this->db->group_end();
        }

        if(isset($filters['approve_3']) && $filters['approve_3']) {
            $this->db->like("u.approve_3", 1);
        }

        if(isset($filters['approve_2']) && $filters['approve_2']) {
            $this->db->like("u.approve_2", 1);
        }

        if(isset($filters['vulnerability_status']) && $filters['vulnerability_status']) {
            $this->db->where("u.vulnerability_status", $filters['vulnerability_status']);
        }

        if($limit && $offset) {
            $this->db->limit($limit, $offset);
        }

        $array = $this->db->get()->result_array();

        foreach ($array as $key => $value) {
            $array[$key]["vulnerability"] = "None";
            if($array[$key]["vulnerability_status"] == "yes")
                $array[$key]["vulnerability"] = $this->getUserVulnerability($array[$key]["id"]);
        }

        return $array;
    }

    public function getUserVulnerability($user_id)
    {
        $array = $this->db->from("vulnerability_updation_history")
                        ->where("user_id", $user_id)
                        ->order_by("id", "desc")->limit(1)
                        ->get()->result_array();
        if(!count($array))
            return "None";

        $vulnerabilities = "";
        $vulnerability_list = $this->db->where("status", 1)->get("vulnerability")->result_array();
        foreach ($vulnerability_list as $vl) {
            if($array[0]["vulnerability_{$vl["id"]}"] > 0) {
                $vulnerabilities .= $vl["name"]. ", ";
            }
        }
        return ($vulnerabilities)?substr($vulnerabilities, 0, -2):"None";
    }
    
}